<template>
    <div class="layout-conteneur__main" :class="{'h-100': !hasResults}">


        <template v-if="hasResults">


            <div class="layout-resultat-recherche">

                <!-- 4max : mise en avant -->
                <div class="layout-resultat-recherche__zoom">

                    <h1 class="h1 mb-4">Meilleurs résultats</h1>

                    <div class="list-card">

                        <router-link class="card"
                                     v-if="highlights.saga.id"
                                     :to="{ name: 'listen.sagas.show', params: { idOrSlug: highlights.saga.slug } }">
                            <div class="card-jacket var--saga">
                                <div class="jaquette--card">
                                    <img :src="highlights.saga.images.cover.main" :alt="highlights.saga.name">
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="h3 text-body">
                                    {{ highlights.saga.name }}
                                    <span class="badge badge-light badge-sm">Saga</span>
                                </p>
                                <p class="text-primary h5">
                                    <saga-stats
                                            :stats="highlights.saga.stats"
                                            :with-icon="true">
                                    </saga-stats>
                                </p>
                            </div>
                        </router-link>


                        <router-link class="card"
                             v-if="highlights.author.id"
                             :to="{ name: 'listen.authors.show', params: { id: highlights.author.slug } }">
                            <div class="card-jacket var--faiseur">
                                <div class="jaquette--moyen jaquette--faiseur">
                                    <img :src="highlights.author.picture.thumb" :alt="highlights.author.name">
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="h3 text-body">
                                    {{ highlights.author.name }}
                                    <span class="badge badge-light badge-sm">Faiseur</span>
                                </p>
                                <p class="text-primary h5">
                                    <i aria-hidden="true" class="fa fa-file-audio-o"></i>
                                    {{ highlights.author.stats.sagas }} Séries
                                </p>
                            </div>
                        </router-link>


                        <div class="card"
                                     v-if="highlights.track.id">
                            <div class="card-jacket var--episode">
                                <div class="jaquette--moyen jaquette--episode">
                                    <img :src="highlights.track.collection.saga.images.cover.thumb" :alt="highlights.track.title">
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="h3 text-body">
                                    {{ highlights.track.title }}
                                    <span class="badge badge-light badge-sm">Episode</span>
                                </p>
                                <p class="text-primary h5">
                                    <i aria-hidden="true" class="fa fa-file-audio-o"></i>
                                    <track-length :seconds="highlights.track.seconds" type="short"></track-length>
                                </p>
                            </div>
                        </div>


                        <router-link class="card"
                                     v-if="highlights.genre.id"
                                     :to="{ name: 'listen.genres.show', params: { id: highlights.genre.id } }">
                            <div class="card-jacket var--genre">
                                <div class="jaquette--moyen jaquette--genre">
                                    <img :src="highlights.genre.image.main" :alt="highlights.genre.name">
                                </div>
                                <div class="pa-centrer">
                                    <svg width="167px" height="145px">
                                        <use xlink:href="#contour-genre"></use>
                                    </svg>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="h3 text-body">
                                    {{ highlights.genre.name }}
                                    <span class="badge badge-light badge-sm">Genre</span>
                                </p>
                                <p class="text-primary h5">
                                    <i aria-hidden="true" class="fa fa-file-audio-o"></i>
                                    XXX Séries
                                </p>
                            </div>
                        </router-link>

                    </div>





                </div>

                <!-- reste en vrac -->
                <div class="layout-resultat-recherche__vrac" v-if="otherResults.sagas.length > 0">

                    <!-- mélanger -->
                    <h2 class="h1 mt-4 mb-2">Sagas</h2>

                    <div class="list-card-horizontal">
                        <Card
                            v-for="saga in otherResults.sagas"
                            :key="saga.id"
                            :link="{ name: 'listen.sagas.show', params: { idOrSlug: saga.slug } }"
                            :cardHorizontal="true"
                            :urlImage="saga.images.cover.main"
                            :altImage="saga.name"
                            :title="saga.name"
                            type="saga">

                            <template slot="stats">
                                <saga-stats
                                        :stats="saga.stats"
                                        :with-icon="true">
                                </saga-stats>
                            </template>
                        </Card>
                    </div>

                </div>

                <div class="layout-resultat-recherche__vrac" v-if="otherResults.authors.length > 0">
                    <h2 class="h1 mt-4 mb-2">Faiseurs</h2>

                    <div class="list-card-horizontal">
                        <Card
                            v-for="author in otherResults.authors"
                            :key="author.id"
                            :link="{ name: 'listen.authors.show', params: { id: author.slug } }"
                            :cardHorizontal="true"
                            :urlImage="author.picture.thumb"
                            :altImage="author.name"
                            :title="author.name"
                            type="faiseur">

                            <template slot="stats">
                                <i aria-hidden="true" class="fa fa-file-audio-o"></i> {{ author.stats.sagas }} Séries
                            </template>
                        </Card>
                    </div>

                </div>

                <div class="layout-resultat-recherche__vrac" v-if="otherResults.tracks.length > 0">
                    <h2 class="h1 mt-4 mb-2">Episodes</h2>
                    <!--TODO lien a faire -> page episode a créer ?-->

                    <div class="list-card-horizontal">
                        <Card
                            v-for="track in otherResults.tracks"
                            :key="track.id"
                            :link="{ name: 'home' }"
                            :cardHorizontal="true"
                            :urlImage="track.collection.saga.images.cover.thumb"
                            :altImage="track.title"
                            :title="track.title"
                            type="episode">

                            <template slot="stats">
                                <i aria-hidden="true" class="fa fa-clock-o"></i>
                                <track-length :seconds="track.seconds" type="short"></track-length>
                            </template>

                        </Card>
                    </div>

                </div>

                <div class="layout-resultat-recherche__vrac" v-if="otherResults.genres.length > 0">
                    <h2 class="h1 mt-4 mb-2">Genres</h2>
                    <div class="list-card-horizontal">
                        <Card
                            v-for="genre in otherResults.genres"
                            :key="genre.id"
                            :link="{ name: 'listen.genres.show', params: { id: genre.id } }"
                            :cardHorizontal="true"
                            :urlImage="genre.image.main"
                            :altImage="genre.name"
                            :title="genre.name"
                            type="genre">

                            <template slot="stats">
                                <i aria-hidden="true" class="fa fa-file-audio-o"></i> XXX Séries
                            </template>
                        </Card>
                    </div>
                </div>

            </div>


        </template>



        <template v-else>
            <div class="d-flex align-items-center h-100 justify-content-center">
                <div class="text-center text-blue-500">
                    <i class="fa fa-bullhorn" style="font-size: 100px;"></i>
                    <span class="h1 mb-4">Lancez une recherche...</span>
                </div>
            </div>
        </template>


    </div>
</template>

<script>
import { mapState, mapGetters } from 'vuex';
import api from '~/lib/api';
import SagaPreview from '~/components/saga/SagaPreview';
import SagaZoom from '~/components/saga/SagaZoom';
import AuthorPreview from '~/components/author/AuthorPreview';
import GenrePreview from '~/components/genre/GenrePreview';
import TrackPreview from '~/components/track/TrackPreview';
import TrackLength from '~/components/track/Length.vue';
import SagaStats from '~/components/saga/SagaStats.vue';
import Card from '~/components/content/Card.vue';

export default {
    components: {
        SagaPreview,
        SagaZoom,
        AuthorPreview,
        GenrePreview,
        TrackPreview,
        TrackLength,
        SagaStats,
        Card,
    },

    data() {
        return {
            query: '',
        }
    },

    computed: {
        ...mapState('search', [
            'results',
        ]),

        ...mapGetters('search', [
            'hasResults',
            'highlights',
            'otherResults',
        ])
    }
}
</script>
