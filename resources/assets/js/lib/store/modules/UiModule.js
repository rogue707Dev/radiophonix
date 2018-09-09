const UiModule = {
    namespaced: true,

    state: {
        isMenuOpen: false,
        isPlayerOpen: false,
        mainClass: '',
        playerClass: '',
        playlistClass: '',
    },

    mutations: {
        openMenu: (state) => state.isMenuOpen = true,
        closeMenu: (state) => state.isMenuOpen = false,

        togglePlayer: (state) => state.isPlayerOpen = !state.isPlayerOpen,

        setMainClass: (state, className) => state.mainClass = className,
        setPlayerClass: (state, className) => state.playerClass = className,
        setPlaylistClass: (state, className) => state.playlistClass = className,

        openPlaylist: (state) => state.playlistClass = 'actif',
        closePlaylist: (state) => state.playlistClass = '',
    },

    actions: {
        toggleMenu({ commit, state }) {
            if (state.isMenuOpen) {
                commit('closeMenu');
            } else {
                commit('openMenu');
            }
        },
        closeMenu: ({ commit }) => commit('closeMenu'),

        openPlaylist: ({ commit }) => {
            commit('setPlayerClass', 'inactif');
            commit('setPlaylistClass', 'actif');
        },
        closePlaylist: ({ commit }) => {
            commit('setPlayerClass', 'actif');
            commit('setPlaylistClass', '');
        },

        togglePlayer: ({ commit, state }) => {
            if (state.isPlayerOpen) {
                commit('setPlayerClass', '');
                commit('setPlaylistClass', '');
                commit('setMainClass', '');
            } else {
                commit('setPlayerClass', 'actif');
                commit('setPlaylistClass', '');
                commit('setMainClass', 'inactif');
            }

            commit('togglePlayer');
        },
    }
};

export default UiModule;
