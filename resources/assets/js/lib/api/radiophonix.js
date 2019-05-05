import store from '~/lib/store';
import AuthorResource from './resources/AuthorResource';
import CollectionResource from './resources/CollectionResource';
import GenreResource from './resources/GenreResource';
import SagaResource from './resources/SagaResource';
import TrackResource from './resources/TrackResource';
import TeamResource from './resources/TeamResource';
import ProfileResource from './resources/ProfileResource';
import BadgeResource from "~/lib/api/resources/BadgeResource";
import TickResource from "~/lib/api/resources/TickResource";
import SiteInviteResource from "./resources/SiteInviteResource";

class Radiophonix {
    constructor(axios) {
        this.axios = axios;

        this.authors = AuthorResource(axios);
        this.collections = CollectionResource(axios);
        this.genres = GenreResource(axios);
        this.sagas = SagaResource(axios);
        this.tracks = TrackResource(axios);
        this.teams = TeamResource(axios);

        this.profile = ProfileResource(axios);
        this.badges = BadgeResource(axios);
        this.ticks = TickResource(axios);

        this.invites = {
            site: SiteInviteResource(axios),
        };
    }

    get likes() {
        return {
            all: () => this.axios.get('/likes'),
            saga: {
                add: (sagaId) => this.axios.post('/likes/saga/' + sagaId),
                remove: (sagaId) => this.axios.delete('/likes/saga/' + sagaId),
            },
        };
    }

    get auth() {
        let afterAuth = function (res) {
            store.dispatch('auth/setToken', res.data.access_token);
            store.dispatch('auth/setUser', res.data.user);
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
            deleteAccount: () => this.axios.delete('/account'),
        };
    }

    get feedback() {
        return {
            send: (type, title, description, url) => {
                return this.axios.post('/feedback', { type, title, description, url });
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
//     collections: CollectionResource,
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
