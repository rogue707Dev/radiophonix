import api from '~/lib/api';
import storage from '~/lib/services/storage';

const totalResults = (results) => {
    if (!results) {
        return 0;
    }

    results.sagas = results.sagas || [];
    results.authors = results.authors || [];
    results.genres = results.genres || [];
    results.tracks = results.tracks || [];

    return results.sagas.length
        + results.authors.length
        + results.genres.length
        + results.tracks.length;
};

const getDefaultState = () => {
    return {
        isSearching: false,

        // Le contenu du champ de recherche
        currentQuery: null,

        // La dernière recherche (même si aucun résultat)
        lastQuery: null,
        hasFoundNoResult: false,
        queries: [],
        results: {
            sagas: [],
            authors: [],
            genres: [],
            tracks: [],
        },
    };
};

const state = getDefaultState();

const getters = {
    hasResults(state) {
        return totalResults(state.results) > 0;
    },

    highlights(state) {
        return {
            saga: state.results.sagas[0] || {},
            author: state.results.authors[0] || {},
            genre: state.results.genres[0] || {},
            track: state.results.tracks[0] || {},
        };
    },

    otherResults(state) {
        return {
            sagas: state.results.sagas.slice(1, 5),
            authors: state.results.authors.slice(1, 5),
            genres: state.results.genres.slice(1, 5),
            tracks: state.results.tracks.slice(1, 5),
        };
    },

    hasOtherResults(state) {
        return state.results.sagas.length > 1
            || state.results.authors.length > 1
            || state.results.genres.length > 1
            || state.results.tracks.length > 1;
    },
};

const actions = {
    async doSearch({ commit }, query) {
        commit('setCurrentQuery', query);
        commit('setLastQuery', query);
        commit('setIsSearching', true);

        try {
            let result = await api.search(query);

            commit('setResults', result.data);

            if (totalResults(result.data) > 0) {
                commit('addQuery', query);
            }
        } catch (e) {
            commit('setResults', {});

        } finally {
            commit('setIsSearching', false);
        }
    },

    clearQueries({commit}) {
        commit('setQueries', []);
        commit('setCurrentQuery', null);
        commit('setLastQuery', null);
        storage.remove('search');
    }
};

const mutations = {
    setCurrentQuery: (state, query) => state.currentQuery = query,
    setLastQuery: (state, query) => state.lastQuery = query,
    setQueries: (state, queries) => state.queries = Object.assign([], queries),

    addQuery(state, query) {
        if (!query) {
            return;
        }


        if (query === state.queries[0]) {
            return;
        }

        state.queries.unshift(query);
        state.currentQuery = query;
        state.lastQuery = query;

        state.queries = Object.assign(state.queries.slice(-10));

        storage.set('search', state.queries);
    },

    setResults(state, results) {
        state.results.sagas = Object.assign([], results.sagas || []);
        state.results.authors = Object.assign([], results.authors || []);
        state.results.genres = Object.assign([], results.genres || []);
        state.results.tracks = Object.assign([], results.tracks || []);

        state.hasFoundNoResult = totalResults(results) === 0;
    },

    setIsSearching: (state, isSearching) => state.isSearching = isSearching,
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
