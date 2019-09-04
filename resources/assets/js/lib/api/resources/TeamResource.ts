import ApiResource, {All, Create, Delete, Get, Update} from './ApiResource';
import {AxiosInstance} from "axios";
import {Team} from "~types/Team";

class TeamResource extends ApiResource<Team> {
    all: All<Team>;
    get: Get<Team>;
    create: Create<Team>;
    update: Update<Team>;
    delete: Delete;

    constructor(axios: AxiosInstance) {
        super(axios);

        this.all = this.buildAll('/teams');
        this.get = this.buildGet('/teams/:id');
        this.create = this.buildCreate('/teams');
        this.update = this.buildUpdate('/teams/:id');
        this.delete = this.buildDelete('/teams/:id');
    }
}

export default TeamResource;
