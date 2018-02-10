import axios from 'axios';

const http = axios.create({
    baseURL: 'https://api.radiophonix.org/api/v1/',
    timeout: 10000
});

export default http;
