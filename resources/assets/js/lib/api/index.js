import factory from './factory';
import router from '~/routing/router';

let api = factory();

api.config.onResponse((response) => {
    return response;
}, (error) => {
    router.push({ name: 'login' });

    return Promise.reject(error);
});

export default api;
