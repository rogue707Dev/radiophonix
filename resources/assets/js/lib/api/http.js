import axios from 'axios';

export default () => {
    return axios.create({
        baseURL: 'https://api.radiophonix.org/api/v1/',
        timeout: 10000
    });
};
