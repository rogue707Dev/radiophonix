import ApiResource, {Create, Delete, Get, Update} from './ApiResource';
import {AxiosInstance} from "axios";
import {Album} from "~types/Album";
import ApiService from "./ApiService";

class AlbumResource extends ApiResource<Album> {
    get: Get<Album>;
    create: Create<Album>;
    update: Update<Album>;
    delete: Delete;

    constructor(axios: AxiosInstance) {
        super(axios);

        this.get = this.buildGet('/albums/:id');
        this.create = this.buildCreate('/albums');
        this.update = this.buildUpdate('/albums/:id');
        this.delete = this.buildDelete('/albums/:id');
    }

    all(sagaId: string): Promise<Album[]> {
        let url = ApiService.url('/sagas/:sagaId/albums', {
            sagaId: sagaId
        });

        return this.axios.get(url).then(res => res.data);
    }
}

export default AlbumResource;
