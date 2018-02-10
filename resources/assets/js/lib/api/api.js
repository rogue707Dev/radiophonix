import radiophonix from './radiophonix';
import mock from './mock';
import Auth from './auth';

radiophonix.config.setBaseUrl(process.env.RADIOPHONIX_API_URL);

if (process.env.RADIOPHONIX_API_MOCK == 1) {
    mock(radiophonix);
}

radiophonix.config.onRequest((config) => {
    let token = Auth.getToken();

    if (token) {
        // If we have a token, we add it to all requests
        config.headers['Authorization'] = 'Bearer ' + token;
    }

    return config;
}, (error) => {
    return Promise.reject(error);
});

radiophonix.config.onResponse((response) => {
    if (response.headers['Authorization']) {
        // If we get a new token, we save it for future requests

        Auth.setToken(response.headers['Authorization'].replace('Bearer ', ''));
    }

    // TODO gérer les tokens expirés et incorrects

    return response;
}, (error) => {
    // app.$Progress.fail();
    return Promise.reject(error);
});

export default radiophonix;
