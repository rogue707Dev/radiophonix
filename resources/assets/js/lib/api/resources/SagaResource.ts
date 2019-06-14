import ApiResource from './ApiResource';
import {AxiosInstance, AxiosPromise} from "axios";
import {Saga} from "~types/Saga";
import ApiService from "./ApiService";

class SagaResource extends ApiResource<Saga> {
    likes(id: string): AxiosPromise {
        let url = ApiService.url('/sagas/:id/likes', {
            id: id,
        });

        return this.axios.get(url);
    }
}

export default (axios: AxiosInstance): SagaResource => {
    return new SagaResource(axios, {
        all: '/sagas',
        get: '/sagas/:id',
        create: '/sagas',
        update: '/sagas/:id',
        delete: '/sagas/:id'
    });
}
