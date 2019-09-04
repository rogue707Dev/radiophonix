import ApiResource, {Get} from "./ApiResource";
import {SiteInvite} from "~types/SiteInvite";
import {AxiosInstance} from "axios";

class SiteInviteResource extends ApiResource<SiteInvite> {
    get: Get<SiteInvite>;

    constructor(axios: AxiosInstance) {
        super(axios);

        this.get = this.buildGet('/invites/site/:id');
    }
}

export default SiteInviteResource;
