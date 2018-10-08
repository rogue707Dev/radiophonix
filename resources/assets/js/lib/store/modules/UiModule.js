import env from '~/lib/services/env';

let changeClasses = (state, classes) => {
    for (const classesKey in classes) {
        if (!classes.hasOwnProperty(classesKey)) {
            continue;
        }

        state[classesKey] = classes[classesKey];
    }
};

let buildTitle = (text = null) => {
    let title = 'Radiophonix ALPHA';

    if (text) {
        title = text + ' — ' + title;
    }

    let envName = env.get('ENV');

    if (envName) {
        title = `[${envName.toUpperCase()}] ${title}`;
    }

    return title;
};

const UiModule = {
    namespaced: true,

    state: {
        isMenuOpen: false,
        isPlayerOpen: false,
        mainClass: '',
        playerClass: '',
        playlistClasses: {},
        pageTitle: 'Radiophonix ALPHA',
    },

    mutations: {
        openMenu: (state) => state.isMenuOpen = true,
        closeMenu: (state) => state.isMenuOpen = false,

        togglePlayer: (state) => state.isPlayerOpen = !state.isPlayerOpen,
        openPlayer: (state) => state.isPlayerOpen = true,
        closePlayer: (state) => state.isPlayerOpen = false,

        setMainClass: (state, className) => state.mainClass = className,
        setPlayerClass: (state, className) => state.playerClass = className,
        setPlaylistClasses: (state, classes) => changeClasses(state.playlistClasses, classes),

        openPlaylist: (state) => state.playlistClasses.actif = true,
        closePlaylist: (state) => state.playlistClasses.actif = false,

        setPageTitle: (state, title) => state.pageTitle = title,
    },

    actions: {
        toggleMenu({ commit, state }) {
            if (state.isMenuOpen) {
                commit('closeMenu');
            } else {
                commit('setPlaylistClasses', {actif: false});
                commit('setPlayerClass', '');
                commit('setMainClass', '');
                commit('closePlayer');

                commit('openMenu');
            }
        },
        closeMenu: ({ commit }) => commit('closeMenu'),

        openPlaylist: ({ commit }) => {
            commit('setPlayerClass', 'inactif');
            commit('setPlaylistClasses', {'actif': true});
        },
        closePlaylist: ({ commit }) => {
            commit('setPlayerClass', 'actif');
            commit('setPlaylistClasses', {'actif': false});
        },

        togglePlayer: ({ commit, state }) => {
            commit('setPlaylistClasses', {actif: false});

            if (state.isPlayerOpen) {
                commit('setPlayerClass', '');
                commit('setMainClass', '');
            } else {
                commit('setPlayerClass', 'actif');
                commit('setMainClass', 'inactif');

                commit('closeMenu');
            }

            commit('togglePlayer');
        },

        resetPageTitle: ({ commit }) => {
            commit('setPageTitle', buildTitle());
        },

        setPageTitle: ({ commit }, title) => {
            commit('setPageTitle', buildTitle(title));
        },
    }
};

export default UiModule;
