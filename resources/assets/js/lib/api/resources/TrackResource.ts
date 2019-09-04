import ApiResource, {Create, Delete, Get, Update} from './ApiResource';
import {AxiosInstance} from "axios";
import {Track} from "~types/Track";
import ApiService from "./ApiService";

class TrackResource extends ApiResource<Track> {
    get: Get<Track>;
    create: Create<Track>;
    update: Update<Track>;
    delete: Delete;

    constructor(axios: AxiosInstance) {
        super(axios);

        this.get = this.buildGet('/tracks/:id');
        this.create = this.buildCreate('/tracks');
        this.update = this.buildUpdate('/tracks/:id');
        this.delete = this.buildDelete('/tracks/:id');
    }

    all(albumId: string): Promise<Track[]> {
        let url = ApiService.url('/tracks/:albumId/tracks', {
            albumId: albumId
        });

        return this.axios.get(url).then(res => res.data);
    }
}

export default TrackResource;
