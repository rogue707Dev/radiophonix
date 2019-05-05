import api from '~/lib/api';

const getDefaultState = () => {
    return {
        ticks: {},
    };
};

const state = getDefaultState();

const getters = {};

const actions = {
    async refreshTicks({ commit }) {
        let result = await api.ticks.all();
        let ticks = {};

        for (let i = 0; i < result.data.length; i++) {
            let tick = result.data[i];

            ticks[tick.track_id] = tick.seconds;
        }

        commit('setTicks', ticks);
    },
};

const mutations = {
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
