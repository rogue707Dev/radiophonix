import ApiResource, {All, Create, Delete, Get, Update} from "./ApiResource";
import {Genre} from "~types/Genre";
import {AxiosInstance} from "axios";

class GenreResource extends ApiResource<Genre> {
    all: All<Genre>;
    get: Get<Genre>;
    create: Create<Genre>;
    update: Update<Genre>;
    delete: Delete;

    constructor(axios: AxiosInstance) {
        super(axios);

        this.all = this.buildAll('/genres');
        this.get = this.buildGet('/genres/:id');
        this.create = this.buildCreate('/genres');
        this.update = this.buildUpdate('/genres/:id');
        this.delete = this.buildDelete('/genres/:id');
    }
}

export default GenreResource;
