import storage from '~/lib/services/storage';

const state = {
    token: storage.get('token'),
};

const getters = {
    isAuthenticated(state) {
        return state.token !== null && (state.token + '').length > 0;
    },
};

const actions = {
    setToken({ commit }, token) {
        if (!token) {
            return;
        }

        commit('setToken', token);
        storage.set('token', token);
    },

    logout({ commit }) {
        commit('setToken', null);
        storage.remove('token');
    },
};

const mutations = {
    setToken: (state, token) => state.token = token,
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
