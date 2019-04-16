import env from '~/lib/services/env';
import Radiophonix from './radiophonix';
import store from '~/lib/store';
import http from "~/lib/api/http";

export default () => {
    let axios = http();
    let radiophonix = new Radiophonix(axios);

    radiophonix.config.setBaseUrl(env.get('API_URL'));

    radiophonix.config.onRequest((config) => {
        let token = store.state.auth.token;

        if (token) {
            // If we have a token, we add it to all requests
            config.headers['Authorization'] = 'Bearer ' + token;
        }

        // @todo gérer le CSRF
        // let csrf = document.querySelector("meta[name='csrf-token']")
        //     .getAttribute("content");
        //
        // if (csrf) {
        //     config.headers['X-CSRF-TOKEN'] = csrf;
        // }

        return config;
    }, (error) => {
        return Promise.reject(error);
    });

    radiophonix.config.onResponse((response) => {
        if (response.headers['Authorization']) {
            store.dispatch(
                'auth/setToken',
                response.headers['Authorization'].replace('Bearer ', '')
            );
        }

        return response;
    }, (error) => {
        if (error.config
            && error.response
            && error.response.status === 401
        ) {
            return radiophonix.auth.refreshToken()
                .then(res => {
                    let token = res.data.access_token;

                    error.config.headers.Authorization = 'Bearer ' + token;

                    store.dispatch('auth/setToken', token);

                    // Rerun the same request with the new token
                    return axios.request(error.config);
                });
        }

        return Promise.reject(error);
    });

    return radiophonix;
};
