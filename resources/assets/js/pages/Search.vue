<template>
    <div>

        <headband
            v-if="!hasResults"
            urlImage="/static/home/recherche.jpg"
            title="Rechercher">
            <div class="search-headband">
                <search-form></search-form>
            </div>
        </headband>

        <headband
            v-if="hasResults"
            urlImage="/static/home/resultat.jpg"
            title="Résultats"
            subtitle="">
            <div class="search-headband">
                <search-form></search-form>
            </div>
        </headband>

        <div class="container">

            <div v-if="hasResults">
                <h1 class="h1 mb-4">Meilleurs résultats</h1>
                <div class="list-card">
                    <Card
                            v-if="highlights.saga.id"
                            :link="{ name: 'listen.sagas.show', params: { idOrSlug: highlights.saga.slug } }"
                            :urlImage="highlights.saga.images.cover.main"
                            :altImage="highlights.saga.name"
                            :title="highlights.saga.name"
                            :badge="true"
                            type="saga"
                            size="moyen">

                        <template slot="stats">
                            <saga-stats
                                    :stats="highlights.saga.stats"
                                    :with-icon="true">
                            </saga-stats>
                        </template>
                    </Card>
                    <Card
                            v-if="highlights.author.id"
                            :link="{ name: 'listen.authors.show', params: { id: highlights.author.slug } }"
                            :urlImage="highlights.author.picture.thumb"
                            :altImage="highlights.author.name"
                            :title="highlights.author.name"
                            :badge="true"
                            type="faiseur"
                            size="moyen">

                        <template slot="stats">
                            <i aria-hidden="true" class="fa fa-file-audio-o"></i>
                            {{ highlights.author.stats.sagas }} Séries
                        </template>
                    </Card>
                    <Card
                            v-if="highlights.track.id"
                            :link="{ name: 'home' }"
                            :urlImage="highlights.track.collection.saga.images.cover.thumb"
                            :altImage="highlights.track.title"
                            :title="highlights.track.title"
                            :badge="true"
                            type="episode"
                            size="moyen">

                        <template slot="stats">
                            <i aria-hidden="true" class="fa fa-clock-o"></i>
                            <track-length :seconds="highlights.track.seconds" type="number"></track-length>
                        </template>
                    </Card>
                    <Card
                            v-if="highlights.genre.id"
                            :link="{ name: 'listen.genres.show', params: { id: highlights.genre.id } }"
                            :urlImage="highlights.genre.image.main"
                            :altImage="highlights.genre.name"
                            :title="highlights.genre.name"
                            :badge="true"
                            type="genre"
                            size="moyen">

                        <template slot="stats">
                            <i aria-hidden="true" class="fa fa-file-audio-o"></i>
                            {{ highlights.genre.stats.sagas }} Séries
                        </template>
                    </Card>
                </div>

                <h1 class="h1 mt-5 mb-4" v-if="hasOtherResults">Mais aussi ...</h1>
                <!-- tous les résultat de tout type a classer par ordre alphabétique ou mieux encore qui correspondent le mieux a la recherche -->
                <div class="list-card-horizontal" v-if="hasOtherResults">
                    <template class="list-card-horizontal" v-if="otherResults.sagas.length > 0">
                        <Card
                                v-for="saga in otherResults.sagas"
                                :key="saga.id"
                                :link="{ name: 'listen.sagas.show', params: { idOrSlug: saga.slug } }"
                                :cardHorizontal="true"
                                :urlImage="saga.images.cover.main"
                                :altImage="saga.name"
                                :title="saga.name"
                                :badge="true"
                                type="saga"
                                size="petit">
                            <template slot="stats">
                                <saga-stats
                                        :stats="saga.stats"
                                        :with-icon="true">
                                </saga-stats>
                            </template>
                        </Card>
                    </template>
                    <template v-if="otherResults.authors.length > 0">
                        <Card
                                v-for="author in otherResults.authors"
                                :key="author.id"
                                :link="{ name: 'listen.authors.show', params: { id: author.slug } }"
                                :cardHorizontal="true"
                                :urlImage="author.picture.thumb"
                                :altImage="author.name"
                                :title="author.name"
                                :badge="true"
                                type="faiseur"
                                size="petit">
                            <template slot="stats">
                                <i aria-hidden="true" class="fa fa-file-audio-o"></i> {{ author.stats.sagas }} Séries
                            </template>
                        </Card>
                    </template>
                    <template v-if="otherResults.tracks.length > 0">
                        <Card
                                v-for="track in otherResults.tracks"
                                :key="track.id"
                                :link="{ name: 'home' }"
                                :cardHorizontal="true"
                                :urlImage="track.collection.saga.images.cover.thumb"
                                :altImage="track.title"
                                :title="track.title"
                                :badge="true"
                                type="episode"
                                size="petit">
                            <template slot="stats">
                                <i aria-hidden="true" class="fa fa-clock-o"></i>
                                <track-length :seconds="track.seconds" type="number"></track-length>
                            </template>
                        </Card>
                    </template>
                    <template v-if="otherResults.genres.length > 0">
                        <Card
                                v-for="genre in otherResults.genres"
                                :key="genre.id"
                                :link="{ name: 'listen.genres.show', params: { id: genre.id } }"
                                :cardHorizontal="true"
                                :urlImage="genre.image.main"
                                :altImage="genre.name"
                                :title="genre.name"
                                :badge="true"
                                type="genre"
                                size="petit">
                            <template slot="stats">
                                <i aria-hidden="true" class="fa fa-file-audio-o"></i> {{ genre.stats.sagas }} Séries
                            </template>
                        </Card>
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
import TrackLength from '~/components/track/TrackLength.vue';
import SagaStats from '~/components/saga/SagaStats.vue';
import Card from '~/components/content/Card.vue';
import Headband from '~/components/content/Headband.vue';
import SearchForm from '~/components/search/SearchForm';

export default {
    components: {
        SagaList,
        TrackLength,
        SagaStats,
        Card,
        Headband,
        SearchForm,
    },

    data() {
        return {
            popular: [],
        }
    },

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
