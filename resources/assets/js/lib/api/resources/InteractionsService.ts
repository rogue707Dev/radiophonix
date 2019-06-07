import {AxiosInstance, AxiosPromise} from "axios";
import ApiService from "./ApiService";
import {Track} from "~types/Track";
import {Route} from "vue-router";

class InteractionsService extends ApiService {
    play(track: Track): AxiosPromise {
        let url = ApiService.url('/interactions/play/:track', {
            track: track.id
        });

        return this.axios.post(url);
    }

    pageView(route: Route): AxiosPromise {
        return this.axios
            .post(
                '/interactions/page-view',
                {
                    path: route.fullPath
                }
            );
    }

    // @todo déplacer les like/unlike des sagas ici
}

export default (axios: AxiosInstance): InteractionsService => {
    return new InteractionsService(axios);
}
