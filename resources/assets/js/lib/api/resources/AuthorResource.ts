import ApiResource, {All, Create, Delete, Get, Update} from './ApiResource';
import {AxiosInstance} from "axios";
import {Author} from "~types/Author";

class AuthorResource extends ApiResource<Author> {
    all: All<Author>;
    get: Get<Author>;
    create: Create<Author>;
    update: Update<Author>;
    delete: Delete;

    constructor(axios: AxiosInstance) {
        super(axios);

        this.all = this.buildAll('/authors');
        this.get = this.buildGet('/authors/:id');
        this.create = this.buildCreate('/authors');
        this.update = this.buildUpdate('/authors/:id');
        this.delete = this.buildDelete('/authors/:id');
    }
}

export default AuthorResource;
