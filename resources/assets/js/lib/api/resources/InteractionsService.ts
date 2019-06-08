import {AxiosInstance, AxiosPromise} from "axios";
import ApiService from "./ApiService";
import {Track} from "~types/Track";
import {Route} from "vue-router";

type LikeType = 'saga';

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

    likes(): AxiosPromise {
        return this.axios.get('/likes');
    }

    like(type: LikeType, id: string): AxiosPromise {
        return this.axios
            .post(
                '/interactions/like',
                {
                    type: type,
                    id: id,
                }
            );
    }

    unlike(type: LikeType, id: string): AxiosPromise {
        return this.axios
            .delete(
                '/interactions/like',
                {
                    data: {
                        type: type,
                        id: id,
                    }
                }
            );
    }
}

export default (axios: AxiosInstance): InteractionsService => {
    return new InteractionsService(axios);
}
