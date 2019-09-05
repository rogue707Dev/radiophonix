import factory from './factory';
import router from '~/routing/router';
import Radiophonix from "~/lib/api/radiophonix";

let api: Radiophonix = factory();

api.config.onResponse((response) => {
    return response;
}, (error) => {
    if (error.config
        && error.response
        && error.response.status === 401
    ) {
        router.push({ name: 'login' });
    }

    return Promise.reject(error);
});

export default api;
