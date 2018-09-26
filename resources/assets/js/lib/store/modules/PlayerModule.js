import AudioPlayer from '~/lib/Player';
import api from '~/lib/api';
import store from "~/lib/store/index";

const pageTitle = (saga, track) => track.title + ' - ' + saga.name;

const PlayerModule = {
    namespaced: true,

    state: {
        currentTrack: {},
        currentCollections: [],
        currentSaga: {
            stats: {},
            links: {},
            author: {
                links: {},
                picture: {}
            },
            images: {
                cover: {}
            }
        },
        currentCollection: {},
        currentPercentage: 0,
        playlist: [],
        index: 0,
        isPlaying: false,
        isLoading: false,
    },

    mutations: {
        setCurrentTrack(state, track) {
            state.currentTrack = Object.assign({}, track);
        },

        setCurrentCollections(state, collections) {
            state.currentCollections = Object.assign([], collections);
        },

        setCurrentCollection(state, collection) {
            state.currentCollection = Object.assign({}, collection);
        },

        setCurrentSaga(state, saga) {
            state.currentSaga = Object.assign({}, saga);
        },

        setPercentage(state, percentage) {
            state.currentPercentage = percentage;
        },

        setPlaylist(state, playlist) {
            state.playlist = playlist;
        },

        play(state) {
            state.isPlaying = true;
            AudioPlayer.play(state.currentTrack);
        },

        pause(state) {
            state.isPlaying = false;
            AudioPlayer.pause();
        },

        stop(state) {
            state.isPlaying = false;
            AudioPlayer.stop();
        },

        setIndex(state, index) {
            state.index = index;
        },

        isLoading(state, isLoading) {
            state.isLoading = isLoading;
        },
    },

    actions: {
        async play({ state, commit }, payload) {
            if (payload.track.id === state.currentTrack.id) {
                return;
            }

            commit('setCurrentTrack', payload.track);
            commit('setPercentage', 0);
            commit('play');

            let slug = null;

            if (payload.saga) {
                // If a saga is provided we use it as the current one
                commit('setCurrentSaga', payload.saga);
                slug = payload.saga.slug;
            } else if (state.currentSaga.slug) {
                slug = state.currentSaga.slug;
            }

            store.dispatch(
                'ui/setPageTitle',
                pageTitle(state.currentSaga, state.currentTrack)
            );

            // Collections are fetch every time a track is played to make
            // sure we are up to date.
            let result = await api.collections.all(slug);
            let collections = result.data;

            commit('setCurrentCollections', collections);

            let playlist = [];
            let indexTrack = 0;

            // We will loop through all collections and all tracks to put
            // them in an array for easier navigation.
            for (let iCollection = 0; iCollection < collections.length; iCollection++) {
                const collection = collections[iCollection];

                for (let iTrack = 0; iTrack < collection.tracks.length; iTrack++) {
                    const track = collection.tracks[iTrack];

                    playlist.push(track);

                    if (track.id == payload.track.id) {
                        commit('setIndex', indexTrack);
                        commit('setCurrentCollection', collection);
                    }

                    indexTrack++;
                }
            }

            commit('setPlaylist', playlist);
        },

        toggle({ state, commit }) {
            if (!state.currentTrack.id) {
                return;
            }

            if (state.isPlaying) {
                commit('pause');
                store.dispatch('ui/resetPageTitle');
            } else {
                commit('play');
                store.dispatch(
                    'ui/setPageTitle',
                    pageTitle(state.currentSaga, state.currentTrack)
                );
            }
        },

        seek({ commit }, percentage) {
            commit('setPercentage', percentage);
            AudioPlayer.seekPercentage(percentage);
        },

        next({ state, dispatch, commit }) {
            let nextIndex = state.index + 1;

            let nextTrack = state.playlist[nextIndex] || null;

            if (nextTrack) {
                dispatch('play', {
                    track: nextTrack
                });
            } else {
                commit('stop');
            }
        },

        previous({ state, dispatch }) {
            let nextIndex = state.index - 1;

            let nextTrack = state.playlist[nextIndex] || null;

            if (nextTrack) {
                dispatch('play', {
                    track: nextTrack
                });
            }

        },

        stop({ commit }) {
            commit('stop');
            store.dispatch('ui/resetPageTitle');
        },

        startLoading({ commit }) {
            commit('isLoading', true);
        },

        stopLoading({ commit }) {
            commit('isLoading', false);
        },
    }
};

export default PlayerModule;
