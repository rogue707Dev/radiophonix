import ApiResource, {All, Create, Delete, Get, Update} from './ApiResource';
import {AxiosInstance, AxiosPromise} from "axios";
import {Saga} from "~types/Saga";
import ApiService from "./ApiService";

class SagaResource extends ApiResource<Saga> {
    all: All<Saga>;
    get: Get<Saga>;
    create: Create<Saga>;
    update: Update<Saga>;
    delete: Delete;

    constructor(axios: AxiosInstance) {
        super(axios);

        this.all = this.buildAll('/sagas');
        this.get = this.buildGet('/sagas/:id');
        this.create = this.buildCreate('/sagas');
        this.update = this.buildUpdate('/sagas/:id');
        this.delete = this.buildDelete('/sagas/:id');
    }

    likes(id: string): AxiosPromise {
        let url = ApiService.url('/sagas/:id/likes', {
            id: id,
        });

        return this.axios.get(url);
    }
}

export default (axios: AxiosInstance): SagaResource => {
    return new SagaResource(axios);
}
