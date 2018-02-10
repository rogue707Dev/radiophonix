import api from '~/lib/api';

const SearchModule = {
    namespaced: true,

    state: {
        queries: [],
        results: {
            sagas: [],
            authors: [],
            genres: [],
            tracks: [],
        }
    },

    mutations: {
        addQuery(state, query) {
            state.queries.push(query);

            // todo garder les 10 derniers
        },

        setResults(state, results) {
            state.results.sagas = Object.assign([], results.sagas || []);
            state.results.authors = Object.assign([], results.authors || []);
            state.results.genres = Object.assign([], results.genres || []);
            state.results.tracks = Object.assign([], results.tracks || []);
        }
    },

    actions: {
        async doSearch({ commit }, query) {
            commit('addQuery', query);

            let result = await api.search(query);

            commit('setResults', result.data);
        }
    },

    getters: {
        lastQuery(state) {
            return state.queries[state.queries.length - 1] || null;
        },

        hasResults(state) {
            return state.results.sagas.length > 0
                || state.results.authors.length > 0
                || state.results.genres.length > 0
                || state.results.tracks.length > 0;
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
        }
    }
};

export default SearchModule;
