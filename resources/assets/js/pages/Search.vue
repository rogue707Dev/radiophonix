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

            <div v-if="hasResults">
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
                <h1 class="h1 mb-4">Les plus populaires</h1>

                <saga-list :sagas="popular"></saga-list>
            </template>

        </div>


    </div>
</template>

<script>
import { mapState, mapGetters } from 'vuex';
import api from '~/lib/api';
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

    data: () => ({
        popular: [],
    }),

    computed: {
        ...mapState('search', [
            'results',
            'isSearching',
        ]),

        ...mapGetters('search', [
            'hasResults',
            'hasOtherResults',
            'highlights',
            'otherResults',
        ]),
    },

    methods: {
        async fetchPopular() {
            if (this.isSearching) {
                return;
            }

            if (this.hasResults) {
                return;
            }

            let result = await api.sagas.popular();

            this.popular = result.data;
        }
    },

    mounted() {
        this.fetchPopular();
    },
}
</script>
