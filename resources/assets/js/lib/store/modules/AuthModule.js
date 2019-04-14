import storage from '~/lib/services/storage';

const state = {
    token: storage.get('token'),
    user: storage.get('user'),
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
        storage.remove('user');
        storage.remove('user.likes');
    },

    setUser({ commit }, user) {
        commit('setUser', user);
        storage.set('user', user);
    },
};

const mutations = {
    setToken: (state, token) => state.token = token,
    setUser: (state, user) => state.user = user,
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
