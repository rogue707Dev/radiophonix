import Storage from '~/lib/services/storage';
import api from '~/lib/api';

const getDefaultState = () => {
    return {
        likes: Storage.get('user.likes'),
    };
};

const state = getDefaultState();

const getters = {
    isLiked: (state) => (type, id) => {
        if (!state.likes) {
            return false;
        }

        if (!state.likes[type]) {
            return false;
        }

        return state.likes[type].includes(id);
    },
};

const actions = {
    resetState ({ commit }) {
        commit('resetState');
    },

    setAll({ commit }, likes) {
        if (!likes) {
            return;
        }

        commit('setAll', likes);
        Storage.set('user.likes', likes);
    },

    persist({ state }) {
        Storage.set('user.likes', state.likes);
    },

    async add({ commit, dispatch }, { type, id }) {
        await api.interactions.like(type, id);

        commit('add', { type, id });

        dispatch('persist');
    },

    async remove({ commit, dispatch }, { type, id }) {
        await api.interactions.unlike(type, id);

        commit('remove', { type, id });

        dispatch('persist');
    },
};

const mutations = {
    resetState (state) {
        Object.assign(state, getDefaultState());
    },

    setAll: (state, likes) => state.likes = Object.assign({}, likes),

    add: (state, { type, id }) => {
        if (!state.likes[type]) {
            state.likes[type] = [];
        }

        state.likes[type].push(id);
    },

    remove: (state, { type, id }) => {
        if (!state.likes[type]) {
            state.likes[type] = [];
        }

        let index = state.likes[type].indexOf(id);

        if (index !== -1) {
            state.likes[type].splice(index, 1);
        }
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
