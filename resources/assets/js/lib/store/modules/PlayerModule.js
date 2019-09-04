import AudioPlayer from '~/lib/Player';
import api from '~/lib/api';
import ticks from '~/lib/services/storage/ticks';
import store from "~/lib/store/index";

const pageTitle = (saga, track) => track.title + ' ⊙ ' + saga.name;

const getDefaultState = () => {
    return {
        currentTrack: {},
        currentAlbums: [],
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
        currentAlbum: {},
        currentPercentage: 0,
        currentTime: '00:00',
        playlist: [],
        index: 0,
        isPlaying: false,
        isLoading: false,
    };
};

const state = getDefaultState();

const getters = {};

const actions = {
    resetState ({ commit }) {
        commit('resetState');
    },

    async play({ state, commit }, payload) {
        if (payload.track.id === state.currentTrack.id) {

            if (!state.isPlaying) {
                commit('play');
            }
            return;
        }

        commit('setCurrentTrack', payload.track);
        AudioPlayer.load(state.currentTrack, payload.seekPercentage);
        commit('setPercentage', payload.seekPercentage || 0);

        if (payload.autoStart) {
            commit('setTime', '00:00');
            commit('play');
        }

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

        ticks.saveTrack(
            state.currentSaga.id,
            state.currentTrack.id,
            payload.seekPercentage || 0
        );

        // Albums are fetch every time a track is played to make
        // sure we are up to date.
        let albums = await api.albums.all(slug);

        commit('setCurrentAlbums', albums);

        let playlist = [];
        let indexTrack = 0;

        // We will loop through all albums and all tracks to put
        // them in an array for easier navigation.
        for (let iAlbum = 0; iAlbum < albums.length; iAlbum++) {
            const album = albums[iAlbum];

            for (let iTrack = 0; iTrack < album.tracks.length; iTrack++) {
                const track = album.tracks[iTrack];

                playlist.push(track);

                if (track.id == payload.track.id) {
                    commit('setIndex', indexTrack);
                    commit('setCurrentAlbum', album);
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

    seek({ commit, dispatch }, percentage) {
        AudioPlayer.seekPercentage(percentage);
        dispatch('refresh');
    },

    refresh({commit}) {
        commit('setPercentage', AudioPlayer.percentage());
        commit('setTime', AudioPlayer.time());
    },

    next({ state, dispatch, commit }) {
        let nextIndex = state.index + 1;

        let nextTrack = state.playlist[nextIndex] || null;

        if (nextTrack) {
            dispatch('play', {
                track: nextTrack,
                autoStart: true,
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
                track: nextTrack,
                autoStart: true,
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
};

const mutations = {
    resetState (state) {
        Object.assign(state, getDefaultState());
    },

    setCurrentTrack(state, track) {
        state.currentTrack = Object.assign({}, track);
    },

    setCurrentAlbums(state, albums) {
        state.currentAlbums = Object.assign([], albums);
    },

    setCurrentAlbum(state, album) {
        state.currentAlbum = Object.assign({}, album);
    },

    setCurrentSaga(state, saga) {
        state.currentSaga = Object.assign({}, saga);
    },

    setPercentage(state, percentage) {
        state.currentPercentage = percentage;
    },

    setTime: (state, time) => state.currentTime = time,

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
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
