import ApiResource, {All} from "./ApiResource";
import {Tick} from "~types/Tick";
import {AxiosInstance, AxiosPromise} from "axios";
import ApiService from "./ApiService";

class TickResource extends ApiResource<Tick> {
    all: All<Tick>;

    constructor(axios: AxiosInstance) {
        super(axios);

        this.all = this.buildAll('/ticks');
    }

    savePercentage(trackId: string, percentage: number): AxiosPromise {
        let url = ApiService.url('/ticks/:track', {
            track: trackId,
        });

        return this.axios.post(url, {
            progress: Math.round(percentage * 1000),
        });
    }

    current(): Promise<Tick> {
        return this.axios
            .get('/ticks/current')
            .then(res => res.data);
    }
}

export default TickResource;
