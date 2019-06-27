import Storage from '~/lib/services/storage';

const getDefaultState = () => {
    return {
        isLoading: true,
        token: Storage.get('token'),
        user: Storage.get('user'),
    };
};

const state = getDefaultState();

const getters = {
    isAuthenticated(state) {
        return state.token !== undefined
            && state.token !== null
            && (state.token + '').length > 0;
    },
};

const actions = {
    resetState ({ commit }) {
        commit('resetState');
    },

    setToken({ commit }, token) {
        if (!token) {
            return;
        }

        commit('setToken', token);
        Storage.set('token', token);
    },

    logout({ commit }) {
        commit('setToken', null);
        Storage.remove('token');
        Storage.remove('user');
        Storage.remove('user.likes');
    },

    setUser({ commit }, user) {
        commit('setUser', user);
        Storage.set('user', user);
    },

    stopLoading({commit}) {
        commit('setIsLoading', false);
    },
};

const mutations = {
    resetState (state) {
        Object.assign(state, getDefaultState());
    },

    setToken: (state, token) => state.token = token,
    setUser: (state, user) => state.user = user,
    setIsLoading: (state, isLoading) => state.isLoading = isLoading,
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
