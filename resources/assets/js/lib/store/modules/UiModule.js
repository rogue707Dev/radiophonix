const UiModule = {
    namespaced: true,

    state: {
        isMainOpen: true,
        isMenuOpen: false,
        isPlayerOpen: true,
        isPlaylistOpen: true,
    },

    mutations: {
        openMain: (state) => state.isMainOpen = true,
        closeMain: (state) => state.isMainOpen = false,

        openMenu: (state) => state.isMenuOpen = true,
        closeMenu: (state) => state.isMenuOpen = false,

        openPlayer: (state) => state.isPlayerOpen = true,
        closePlayer: (state) => state.isPlayerOpen = false,

        openPlaylist: (state) => state.isPlaylistOpen = true,
        closePlaylist: (state) => state.isPlaylistOpen = false,
    },

    actions: {
        openMain: ({ commit }) => commit('openMain'),
        closeMain: ({ commit }) => commit('closeMain'),

        toggleMenu({ commit, state }) {
            if (state.isMenuOpen) {
                commit('closeMenu');
            } else {
                commit('openMenu');
            }
        },
        closeMenu: ({ commit }) => commit('closeMenu'),

        openPlayer: ({ commit }) => commit('openPlayer'),
        closePlayer: ({ commit }) => commit('closePlayer'),

        openPlaylist: ({ commit }) => commit('openPlaylist'),
        closePlaylist: ({ commit }) => commit('closePlaylist'),
    }
};

export default UiModule;
