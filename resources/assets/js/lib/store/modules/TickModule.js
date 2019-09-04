const getDefaultState = () => {
    return {
        ticks: {},
    };
};

const state = getDefaultState();

const getters = {};

const actions = {
    resetState({commit}) {
        commit('resetState');
    },
};

const mutations = {
    resetState(state) {
        Object.assign(state, getDefaultState());
    },

    setTicks(state, ticks) {
        state.ticks = Object.assign([], ticks);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
