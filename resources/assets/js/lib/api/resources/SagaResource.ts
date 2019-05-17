import ApiResource from './ApiResource';
import {AxiosInstance} from "axios";
import {Saga} from "~types/Saga";

class SagaResource extends ApiResource<Saga> {

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
