import env from '~/lib/services/env';
import radiophonix from './radiophonix';
import store from '~/lib/store';

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
        // If we get a new token, we save it for future requests
        store.dispatch(
            'auth/setToken',
            response.headers['Authorization'].replace('Bearer ', '')
        );
    }

    // TODO gérer les tokens expirés et incorrects

    return response;
}, (error) => {
    return Promise.reject(error);
});

export default radiophonix;
