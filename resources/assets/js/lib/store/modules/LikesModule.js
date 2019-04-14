import storage from '~/lib/services/storage';
import api from '~/lib/api';

const state = {
    likes: storage.get('user.likes'),
};

const getters = {
    isLiked: (state) => (type, id) => {
        if (!state.likes[type]) {
            return false;
        }

        return state.likes[type].includes(id);
    },
};

const actions = {
    setAll({ commit }, likes) {
        if (!likes) {
            return;
        }

        commit('setAll', likes);
        storage.set('user.likes', likes);
    },

    persist({ state }) {
        storage.set('user.likes', state.likes);
    },

    async add({ commit, dispatch }, { type, id }) {
        await api.likes[type].add(id);

        commit('add', { type, id });

        dispatch('persist');
    },

    async remove({ commit, dispatch }, { type, id }) {
        await api.likes[type].remove(id);

        commit('remove', { type, id });

        dispatch('persist');
    },
};

const mutations = {
    setAll: (state, likes) => state.likes = likes,

    add: (state, { type, id }) => {
        if (!state.likes[type]) {
            state.likes[type] = [];
        }

        state.likes[type].push(id);
    },

    remove: (state, { type, id }) => {
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
