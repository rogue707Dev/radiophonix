<template>
    <div>

        <headband
            v-if="!hasResults"
            urlImage="/static/home/recherche.jpg"
            title="Rechercher">
            <div class="search-headband">
                <search-form algolia="dark"></search-form>
            </div>
        </headband>

        <headband
            v-if="hasResults"
            urlImage="/static/home/resultat.jpg"
            title="Résultats"
            subtitle="">
            <div class="search-headband">
                <search-form algolia="dark"></search-form>
            </div>
        </headband>

        <div class="container">

            <p class="lead text-center mt-md-5 mt-5"
               v-if="isSearching">
                <i class="fa fa-spinner fa-spin fa-5x mt-md-5 mb-md-5 mb-4"></i>
                <br/>
                Recherche en cours...
            </p>

            <div v-else-if="hasResults">
                <h1 class="h1 mb-4">Meilleurs résultats</h1>
                <div class="list-card">
                    <card-saga v-if="highlights.saga.id"
                               :saga="highlights.saga"
                               :badge="true"
                               :with-author="false"></card-saga>

                    <card-author v-if="highlights.author.id"
                                 :author="highlights.author"
                                 :badge="true"></card-author>

                    <card-track v-if="highlights.track.id"
                                :track="highlights.track"
                                :badge="true"></card-track>

                    <card-genre v-if="highlights.genre.id"
                                :genre="highlights.genre"
                                :badge="true"></card-genre>
                </div>

                <h1 class="h1 mt-5 mb-4" v-if="hasOtherResults">Mais aussi ...</h1>
                <!-- tous les résultat de tout type a classer par ordre alphabétique ou mieux encore qui correspondent le mieux a la recherche -->
                <div class="list-card-horizontal" v-if="hasOtherResults">
                    <template v-if="otherResults.sagas.length > 0">
                        <card-saga v-for="saga in otherResults.sagas"
                                   :key="saga.id"
                                   :saga="saga"
                                   :badge="true"
                                   :horizontal="true"
                                   :with-author="false"></card-saga>
                    </template>
                    <template v-if="otherResults.authors.length > 0">
                        <card-author v-for="author in otherResults.authors"
                                     :key="author.id"
                                     :author="author"
                                     :badge="true"
                                     :horizontal="true"></card-author>
                    </template>
                    <template v-if="otherResults.tracks.length > 0">
                        <card-track v-for="track in otherResults.tracks"
                                    :key="track.id"
                                    :track="track"
                                    :badge="true"
                                    :horizontal="true"></card-track>
                    </template>
                    <template v-if="otherResults.genres.length > 0">
                        <card-genre v-for="genre in otherResults.genres"
                                    :key="genre.id"
                                    :genre="genre"
                                    :badge="true"
                                    :horizontal="true"></card-genre>
                    </template>
                </div>
            </div>

            <template v-else>
                <p class="lead text-center mt-md-5 mt-5" v-if="queries.length === 0">
                    <i class="fa fa-fw fa-search fa-5x mt-md-5 mb-md-5 mb-4"></i>
                    <br/>
                    <span v-if="hasFoundNoResult">
                        Aucun résultat pour &laquo; {{ lastQuery }} &raquo;
                    </span>
                    <span v-else>
                        Rechercher des sagas, des épisodes, des auteurs, des genres...
                    </span>
                </p>
                <div v-else>
                    <h1 class="h1 mb-4">Recherches récentes</h1>

                    <div class="list-group list-group-flush">
                        <button class="list-group-item list-group-item-action"
                                v-for="(query, index) in queries"
                                :key="index"
                                @click="search(query)">
                            {{ query }}
                        </button>
                    </div>

                    <button class="btn btn-outline-secondary btn-sm mt-4"
                            @click="clearQueries">
                        Effacer les recherches récentes
                    </button>
                </div>
            </template>

        </div>


    </div>
</template>

<script>
import { mapState, mapGetters, mapActions } from 'vuex';
import SagaList from '~/components/saga/SagaList.vue';
import Headband from '~/components/content/Headband.vue';
import SearchForm from '~/components/search/SearchForm';
import CardSaga from '~/components/content/Card/CardSaga';
import CardAuthor from '~/components/content/Card/CardAuthor';
import CardTrack from '~/components/content/Card/CardTrack';
import CardGenre from '~/components/content/Card/CardGenre';

export default {
    components: {
        SagaList,
        Headband,
        SearchForm,
        CardSaga,
        CardAuthor,
        CardTrack,
        CardGenre,
    },

    computed: {
        ...mapState('search', [
            'results',
            'isSearching',
            'queries',
            'hasFoundNoResult',
            'lastQuery',
        ]),

        ...mapGetters('search', [
            'hasResults',
            'hasOtherResults',
            'highlights',
            'otherResults',
        ]),
    },

    methods: {
        ...mapActions('search', [
            'clearQueries',
        ]),

        search(query) {
            this.$store.dispatch('search/doSearch', query);
        },
    },
}
</script>
