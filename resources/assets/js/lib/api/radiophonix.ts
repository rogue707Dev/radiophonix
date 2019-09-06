import store from '~/lib/store';
import AuthorResource from './resources/AuthorResource';
import AlbumResource from './resources/AlbumResource';
import GenreResource from './resources/GenreResource';
import SagaResource from './resources/SagaResource';
import TrackResource from './resources/TrackResource';
import TeamResource from './resources/TeamResource';
import ProfileResource from './resources/ProfileResource';
import TickResource from "./resources/TickResource";
import SiteInviteResource from "./resources/SiteInviteResource";
import InteractionsService from "./resources/InteractionsService";
import UserSagaResource from "./resources/User/UserSagaResource";
import {AxiosInstance, AxiosResponse} from "axios";

class Radiophonix {
    private axios: AxiosInstance;

    authors: AuthorResource;
    albums: AlbumResource;
    genres: GenreResource;
    sagas: SagaResource;
    tracks: TrackResource;
    teams: TeamResource;
    profile: ProfileResource;
    ticks: TickResource;
    interactions: InteractionsService;

    invites: {
        site: SiteInviteResource;
    };

    user: {
        sagas: UserSagaResource;
    };

    constructor(axios: AxiosInstance) {
        this.axios = axios;

        this.authors = new AuthorResource(axios);
        this.albums = new AlbumResource(axios);
        this.genres = new GenreResource(axios);
        this.sagas = new SagaResource(axios);
        this.tracks = new TrackResource(axios);
        this.teams = new TeamResource(axios);
        this.interactions = new InteractionsService(axios);

        this.profile = new ProfileResource(axios);
        this.ticks = new TickResource(axios);

        this.invites = {
            site: new SiteInviteResource(axios),
        };

        this.user = {
            sagas: new UserSagaResource(axios),
        };
    }

    get likes() {
        return {
            // @todo grouper avec profile.likes
            all: () => this.axios.get('/likes'),
        };
    }

    get auth() {
        let afterAuth = function (res: AxiosResponse) {
            store.dispatch('auth/setToken', res.data.access_token);
            store.dispatch('auth/setUser', res.data.user);
            store.dispatch('auth/stopLoading');
            store.dispatch('likes/setAll', res.data.likes);

            return res;
        };

        return {
            login: (email: string, password: string) => {
                return this.axios.post('/auth/login', {
                    email: email,
                    password: password
                }).then(afterAuth);
            },
            register: (data: any) => {
                return this.axios.post('/auth/register', data)
                    .then(afterAuth);
            },
            logout: () => this.axios.post('/auth/logout'),
            refreshToken: () => this.axios.get('/auth/refresh'),
            askPasswordReset: (email: string) => this.axios.post('/auth/password/email', {email}),
            resetPassword: (data: any) => this.axios.post('/auth/password/reset', data),
        };
    }

    get settings() {
        return {
            profile: (data: any) => {
                return this.axios.patch('/settings/profile', data)
                    .then(res => {
                        store.dispatch('auth/setUser', res.data);
                    });
            },
            password: (data: any) => this.axios.patch('/settings/password', data),
            deleteAccount: (password: string) => this.axios.delete('/account?password=' + password),
        };
    }

    get feedback() {
        return {
            send: (type: 'bug' | 'suggestion', description: string, url: string) => {
                return this.axios.post('/feedback', {type, description, url});
            },
        };
    }

    get config() {
        interface handler {
            (data: any): any;
        }

        return {
            onRequest: (success: handler, error: handler) => {
                this.axios.interceptors.request.use(success, error);
            },
            onResponse: (success: handler, error: handler) => {
                this.axios.interceptors.response.use(success, error);
            },
            setBaseUrl: (url: string) => {
                this.axios.defaults.baseURL = url;
            },
        };
    }

    search(query: string) {
        return this.axios.post('/search', {
            query: query,
        });
    }
}

export default Radiophonix;
