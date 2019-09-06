import ApiResource, {All} from '../ApiResource';
import {AxiosInstance} from "axios";
import {Saga} from "~types/Saga";

class UserSagaResource extends ApiResource<Saga> {
    all: All<Saga>;

    constructor(axios: AxiosInstance) {
        super(axios);

        this.all = this.buildAll('/user/sagas');
    }
}

export default UserSagaResource;
