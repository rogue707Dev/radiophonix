import {AxiosResponse} from "axios";
import ApiService from "./ApiService";

export interface All<T> {
    (params?: object): Promise<T[]>;
}

export interface Get<T> {
    (id: number, params?: object): Promise<T>;
}

export interface Create<T> {
    (data: object): Promise<T>;
}

export interface Update<T> {
    (id: number, data: object): Promise<T>;
}

export interface Delete {
    (id: number): Promise<any>;
}

class ApiResource<T> extends ApiService {
    buildAll(path: string): All<T> {
        return (params?: object): Promise<T[]> => {
            return this.axios
                .get(path, params)
                .then((res: AxiosResponse<T[]>) => res.data);
        };
    }

    buildGet(path: string): Get<T> {
        return (id: number, params?: object): Promise<T> => {
            let url = ApiService.url(path, {
                id: id
            });

            return this.axios
                .get(url, params)
                .then(res => res.data);
        };
    }

    buildCreate(path: string): Create<T> {
        return (data: object): Promise<T> => {
            return this.axios
                .post(path, data)
                .then(res => res.data);
        };
    }

    buildUpdate(path: string): Update<T> {
        return (id: number, data: object): Promise<T> => {
            let url = ApiService.url(path, {
                id: id
            });

            return this.axios
                .put(url, data)
                .then(res => res.data);
        };
    }

    buildDelete(path: string): Delete {
        return (id: number): Promise<T> => {
            let url = ApiService.url(path, {
                id: id
            });

            return this.axios
                .delete(url)
                .then(res => res.data);
        };
    }
}

export default ApiResource;
