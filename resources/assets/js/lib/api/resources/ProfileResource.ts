import ApiResource, {Get} from './ApiResource';
import {AxiosInstance} from "axios";
import {Profile} from "~types/Profile";
import ApiService from "./ApiService";
import {Likes} from "~types/Likes";

class ProfileResource extends ApiResource<Profile> {
    get: Get<Profile>;

    constructor(axios: AxiosInstance) {
        super(axios);

        this.get = this.buildGet('/profile/:id');
    }

    likes(username: string): Promise<Likes> {
        let url = ApiService.url('/profile/:username/likes', {
            username: username
        });

        return this.axios.get(url).then(res => res.data);
    }
}

export default ProfileResource;
