import {AxiosInstance, AxiosPromise} from "axios";
import ApiService from "./ApiService";
import {Track} from "~types/Track";

class InteractionsService extends ApiService {
    play(track: Track): AxiosPromise {
        let url = ApiService.url('/interactions/play/:track', {
            track: track.id
        });

        return this.axios.post(url);
    }

    // @todo déplacer les like/unlike des sagas ici
}

export default (axios: AxiosInstance): InteractionsService => {
    return new InteractionsService(axios);
}
