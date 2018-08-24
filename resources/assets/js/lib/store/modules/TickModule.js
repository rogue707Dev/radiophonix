import api from '~/lib/api';

const TickModule = {
    namespaced: true,

    state: {
        ticks: {},
    },

    mutations: {
        setTicks(state, ticks) {
            state.ticks = Object.assign([], ticks);
        },
    },

    actions: {
        async refreshTicks({ commit }) {
            let result = await api.ticks.all();
            let ticks = {};

            for (let i = 0; i < result.data.length; i++) {
                let tick = result.data[i];

                ticks[tick.track_id] = tick.seconds;
            }

            commit('setTicks', ticks);
        },
    }
};

export default TickModule;
