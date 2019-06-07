import {AxiosInstance} from "axios";

interface Params {
    [key: string]: any;
}

class ApiService {
    protected axios: AxiosInstance;

    constructor(axios: AxiosInstance) {
        this.axios = axios;
    }

    static url(url: string, vars: Params): string {
        for (let key in vars) {
            if (vars.hasOwnProperty(key)) {
                let value = vars[key];

                url = url.replace(':' + key, value);
            }
        }

        return url;
    }
}

export default ApiService;
