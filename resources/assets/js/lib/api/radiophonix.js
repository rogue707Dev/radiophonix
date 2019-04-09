import http from './http';
import AuthorResource from './resources/AuthorResource';
import CollectionResource from './resources/CollectionResource';
import GenreResource from './resources/GenreResource';
import SagaResource from './resources/SagaResource';
import TrackResource from './resources/TrackResource';
import ProfileResource from './resources/ProfileResource';
import store from '~/lib/store';

export default {
    authors: AuthorResource,
    collections: CollectionResource,
    genres: GenreResource,
    sagas: SagaResource,
    tracks: TrackResource,
    profile: ProfileResource,

    likes: {
        all: () => http.get('/likes'),
        add: (sagaId) => http.post('/sagas/' + sagaId + '/likes'),
        remove: (sagaId) => http.delete('/sagas/' + sagaId + '/likes'),
    },

    teams: {
        all: () => http.get('/teams'),
        get: (teamId) => http.get('/teams/' + teamId),
        create: (data) => http.post('/teams', data),
        update: (teamId, data) => http.put('/teams/' + teamId, data),
        delete: (teamId) => http.delete('/teams/' + teamId),
    },

    invites: {
        all: () => http.get('/invites'),
        inTeam: (teamId) => http.get('/teams/' + teamId + '/invites'),
        create: (teamId, invitedId) => http.post('/teams/' + teamId + '/invites', {
            invitedId: invitedId
        }),
        accept: (inviteId) => http.put('/invites/' + inviteId),
        decline: (inviteId) => http.delete('/invites/' + inviteId),
    },

    search: (query) => http.post('/search', {
        query: query
    }),

    auth: {
        login: (email, password) => {
            return http.post('/auth/login', {
                email: email,
                password: password
            }).then((res) => {
                store.dispatch('auth/setToken', res.data.access_token);
                store.dispatch('auth/setUser', res.data.user);

                return res;
            });
        },
        register: (data) => http.post('/auth/register', data),
        logout: () => http.post('/auth/logout'),
    },

    me: () => http.get('/me'),

    notifications: {
        all: () => http.get('/notifications'),
        read: (notificationId) => http.delete('/notifications/' + notificationId)
    },

    ticks: {
        all: () => http.get('/ticks'),
        current: () => http.get('/ticks/current'),
        saga: (sagaId) => http.get('/ticks/' + sagaId),
        tick: (trackId) => http.post('/ticks/' + trackId)
    },

    upload: (trackId, file) => {
        return http.post('/upload/track/' + trackId)
            .then((res) => {

            });
    },

    config: {
        onRequest: function (success, error) {
            http.interceptors.request.use(success, error);
        },
        onResponse: function (success, error) {
            http.interceptors.response.use(success, error);
        },
        setBaseUrl: function (url) {
            http.defaults.baseURL = url;
        }
    }
}
