const MenuModule = {
    namespaced: true,

    state: {
        isMenuOpen: false,
    },

    mutations: {
        open(state) {
            state.isMenuOpen = true;
        },

        close(state) {
            state.isMenuOpen = false;
        }
    },

    actions: {
        toggle({ commit, state }) {
            if (state.isMenuOpen) {
                commit('close');
            } else {
                commit('open');
            }
        },

        close({ commit }) {
            commit('close');
        }
    }
};

export default MenuModule;
