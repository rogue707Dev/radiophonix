import axios, {AxiosInstance} from 'axios';

export default (): AxiosInstance => {
    return axios.create({
        baseURL: 'https://api.radiophonix.org/api/v1/',
        timeout: 10000
    });
};
