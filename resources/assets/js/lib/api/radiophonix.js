import store from '~/lib/store';
import AuthorResource from './resources/AuthorResource';
import AlbumResource from './resources/AlbumResource';
import GenreResource from './resources/GenreResource';
import SagaResource from './resources/SagaResource';
import TrackResource from './resources/TrackResource';
import TeamResource from './resources/TeamResource';
import ProfileResource from './resources/ProfileResource';
import BadgeResource from "~/lib/api/resources/BadgeResource";
import TickResource from "~/lib/api/resources/TickResource";
import SiteInviteResource from "./resources/SiteInviteResource";
import InteractionsService from "./resources/InteractionsService";

class Radiophonix {
    constructor(axios) {
        this.axios = axios;

        this.authors = new AuthorResource(axios);
        this.albums = AlbumResource(axios);
        this.genres = new GenreResource(axios);
        this.sagas = new SagaResource(axios);
        this.tracks = TrackResource(axios);
        this.teams = TeamResource(axios);

        this.profile = ProfileResource(axios);
        this.badges = BadgeResource(axios);
        this.ticks = new TickResource(axios);

        this.invites = {
            site: SiteInviteResource(axios),
        };

        this.interactions = InteractionsService(axios);
    }

    get likes() {
        return {
            // @todo grouper avec profile.likes
            all: () => this.axios.get('/likes'),
        };
    }

    get auth() {
        let afterAuth = function (res) {
            store.dispatch('auth/setToken', res.data.access_token);
            store.dispatch('auth/setUser', res.data.user);
            store.dispatch('auth/stopLoading');
            store.dispatch('likes/setAll', res.data.likes);

            return res;
        };

        return {
            login: (email, password) => {
                return this.axios.post('/auth/login', {
                    email: email,
                    password: password
                }).then(afterAuth);
            },
            register: (data) => {
                return this.axios.post('/auth/register', data)
                    .then(afterAuth);
            },
            logout: () => this.axios.post('/auth/logout'),
            refreshToken: () => this.axios.get('/auth/refresh'),
            askPasswordReset: (email) => this.axios.post('/auth/password/email', {email}),
            resetPassword: (data) => this.axios.post('/auth/password/reset', data),
        };
    }

    get settings() {
        return {
            profile: (data) => {
                return this.axios.patch('/settings/profile', data)
                    .then(res => {
                        store.dispatch('auth/setUser', res.data);
                    });
            },
            password: (data) => this.axios.patch('/settings/password', data),
            deleteAccount: (password) => this.axios.delete('/account?password=' + password),
        };
    }

    get feedback() {
        return {
            send: (type, description, url) => {
                return this.axios.post('/feedback', { type, description, url });
            },
        };
    }

    get config() {
        return {
            onRequest: (success, error) => {
                this.axios.interceptors.request.use(success, error);
            },
            onResponse: (success, error) => {
                this.axios.interceptors.response.use(success, error);
            },
            setBaseUrl: (url) => {
                this.axios.defaults.baseURL = url;
            },
        };
    }

    search(query) {
        return this.axios.post('/search', {
            query: query
        });
    }
}

export default Radiophonix;
//
// export default {
//     authors: AuthorResource,
//     albums: AlbumResource,
//     genres: GenreResource,
//     sagas: SagaResource,
//     tracks: TrackResource,
//     profile: ProfileResource,
//
//     likes: {
//         all: () => http.get('/likes'),
//         saga: {
//             add: (sagaId) => http.post('/likes/saga/' + sagaId),
//             remove: (sagaId) => http.delete('/likes/saga/' + sagaId),
//         },
//     },
//
//     teams: {
//         all: () => http.get('/teams'),
//         get: (teamId) => http.get('/teams/' + teamId),
//         create: (data) => http.post('/teams', data),
//         update: (teamId, data) => http.put('/teams/' + teamId, data),
//         delete: (teamId) => http.delete('/teams/' + teamId),
//     },
//
//     invites: {
//         all: () => http.get('/invites'),
//         inTeam: (teamId) => http.get('/teams/' + teamId + '/invites'),
//         create: (teamId, invitedId) => http.post('/teams/' + teamId + '/invites', {
//             invitedId: invitedId
//         }),
//         accept: (inviteId) => http.put('/invites/' + inviteId),
//         decline: (inviteId) => http.delete('/invites/' + inviteId),
//     },
//
//     search: (query) => http.post('/search', {
//         query: query
//     }),
//
//     auth: {
//         login: (email, password) => {
//             return http.post('/auth/login', {
//                 email: email,
//                 password: password
//             }).then((res) => {
//                 store.dispatch('auth/setToken', res.data.access_token);
//                 store.dispatch('auth/setUser', res.data.user);
//                 store.dispatch('likes/setAll', res.data.likes);
//
//                 return res;
//             });
//         },
//         register: (data) => http.post('/auth/register', data),
//         logout: () => http.post('/auth/logout'),
//     },
//
//     me: () => http.get('/me'),
//
//     notifications: {
//         all: () => http.get('/notifications'),
//         read: (notificationId) => http.delete('/notifications/' + notificationId)
//     },
//
//     ticks: {
//         all: () => http.get('/ticks'),
//         current: () => http.get('/ticks/current'),
//         saga: (sagaId) => http.get('/ticks/' + sagaId),
//         tick: (trackId) => http.post('/ticks/' + trackId)
//     },
//
//     upload: (trackId, file) => {
//         return http.post('/upload/track/' + trackId)
//             .then((res) => {
//
//             });
//     },
//
//     config: {
//         onRequest: function (success, error) {
//             http.interceptors.request.use(success, error);
//         },
//         onResponse: function (success, error) {
//             http.interceptors.response.use(success, error);
//         },
//         setBaseUrl: function (url) {
//             http.defaults.baseURL = url;
//         }
//     }
// }
