import {AxiosInstance, AxiosResponse} from "axios";
import ApiService from "./ApiService";

interface ResourceMethods {
    all?: string;
    get?: string;
    create?: string;
    update?: string;
    delete?: string;
}

interface All<T> {
    (params?: object): Promise<T[]>;
}

interface Get<T> {
    (id: number, params?: object): Promise<T>;
}

interface Create<T> {
    (data: object): Promise<T>;
}

interface Update<T> {
    (id: number, data: object): Promise<T>;
}

interface Delete {
    (id: number): Promise<any>;
}

class ApiResource<T> extends ApiService {
    all?: All<T>;
    get?: Get<T>;
    create?: Create<T>;
    update?: Update<T>;
    delete?: Delete;

    constructor(axios: AxiosInstance, methods: ResourceMethods) {
        super(axios);

        if (typeof methods.all !== 'undefined') {
            this.all = (params?: object): Promise<T[]> => {
                return this.axios
                    .get(<string>methods.all, params)
                    .then((res: AxiosResponse<T[]>) => res.data);
            };
        }

        if (methods.get) {
            this.get = (id: number, params?: object): Promise<T> => {
                let url = ApiService.url(<string>methods.get, {
                    id: id
                });

                return this.axios
                    .get(url, params)
                    .then(res => res.data);
            };
        }

        if (methods.create) {
            this.create = (data: object): Promise<T> => {
                return this.axios
                    .post(<string>methods.create, data)
                    .then(res => res.data);
            };
        }

        if (methods.update) {
            this.update = (id: number, data: object): Promise<T> => {
                let url = ApiService.url(<string>methods.update, {
                    id: id
                });

                return this.axios
                    .put(url, data)
                    .then(res => res.data);
            };
        }

        if (methods.delete) {
            this.delete = (id: number): Promise<T> => {
                let url = ApiService.url(<string>methods.delete, {
                    id: id
                });

                return this.axios
                    .delete(url)
                    .then(res => res.data);
            };
        }
    }
}

export default ApiResource;
