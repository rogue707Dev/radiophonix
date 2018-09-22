<template>
    <div class="layout-conteneur__main" :class="{'h-100': !hasResults}">


        <template v-if="hasResults">


            <div class="layout-resultat-recherche">

                <!-- 4max : mise en avant -->
                <div class="layout-resultat-recherche__zoom">

                    <h1 class="h1 mb-4">Meilleurs résultats</h1>

                    <div class="list-card">

                        <router-link class="card border-saga"
                                     v-if="highlights.saga.id"
                                     :to="{ name: 'listen.sagas.show', params: { idOrSlug: highlights.saga.slug } }">
                            <div class="card-jacket--saga bg-saga">
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


                        <router-link class="card border-saga"
                             v-if="highlights.author.id"
                             :to="{ name: 'listen.authors.show', params: { id: highlights.author.slug } }">
                            <div class="card-jacket--faiseur bg-saga">
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


                        <div class="card border-saga"
                                     v-if="highlights.track.id">
                            <div class="card-jacket--episode bg-saga">
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


                        <router-link class="card border-saga"
                                     v-if="highlights.genre.id"
                                     :to="{ name: 'listen.genres.show', params: { id: highlights.genre.id } }">
                            <div class="card-jacket--genre bg-saga">
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
                    <span class="h1 mb-4">Sagas</span>

                    <ul class="liste-resultat">
                        <li class="liste-resultat__item-vrac"
                            v-for="saga in otherResults.sagas"
                            :key="saga.id">
                            <router-link :to="{ name: 'listen.sagas.show', params: { idOrSlug: saga.slug } }">

                                <div class="zone-interactive">
                                    <div class="zone-interactive__info">

                                        <div class="d-flex">
                                            <div class="liste-resultat__visuel">
                                                <div class="jaquette--petite jaquette--saga">
                                                    <img :src="saga.images.cover.main" :alt="saga.name" height="340px" width="340px">
                                                </div>
                                            </div>
                                            <div class="liste-resultat__info">
                                                <p class="h3">{{ saga.name }}</p>
                                                <p class="text-orange-300">
                                                    <saga-stats
                                                        :stats="saga.stats"
                                                        :with-icon="true">
                                                    </saga-stats>
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="zone-interactive__action">
                                        <a class="zone-interactive__bouton" href="">
                                            <i aria-hidden="true" class="fa fa-heart"></i>
                                        </a>
                                        <a class="zone-interactive__bouton" href="">
                                            <i aria-hidden="true" class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>

                            </router-link>
                        </li>
                    </ul>

                </div>

                <div class="layout-resultat-recherche__vrac" v-if="otherResults.authors.length > 0">
                    <span class="h1 mb-4">Faiseurs</span>

                    <ul class="liste-resultat">
                        <li class="liste-resultat__item-vrac"
                            v-for="author in otherResults.authors" :key="author.id">
                            <router-link :to="{ name: 'listen.authors.show', params: { id: author.slug } }">

                                <div class="zone-interactive">
                                    <div class="zone-interactive__info">

                                        <div class="d-flex">
                                            <div class="liste-resultat__visuel">
                                                <div class="jaquette--petite jaquette--faiseur">
                                                    <img :src="author.picture.thumb" :alt="author.name" height="340px" width="340px">
                                                </div>
                                            </div>
                                            <div class="liste-resultat__info">
                                                <p class="h3">{{ author.name }}</p>
                                                <p class="text-orange-300">
                                                    <i aria-hidden="true" class="fa fa-file-audio-o"></i> {{ author.stats.sagas }} Séries
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="zone-interactive__action">
                                        <a class="zone-interactive__bouton" href="">
                                            <i aria-hidden="true" class="fa fa-heart"></i>
                                        </a>
                                        <a class="zone-interactive__bouton" href="">
                                            <i aria-hidden="true" class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>

                            </router-link>
                        </li>
                    </ul>

                </div>

                <div class="layout-resultat-recherche__vrac" v-if="otherResults.tracks.length > 0">
                    <span class="h1 mb-4">Episodes</span>

                    <ul class="liste-resultat">

                        <li class="liste-resultat__item-vrac"
                            v-for="track in otherResults.tracks" :key="track.id">
                            <a href="/ecouter/sagas/le-donjon-de-naheulbeuk">

                                <div class="zone-interactive">
                                    <div class="zone-interactive__info">

                                        <div class="d-flex">
                                            <div class="liste-resultat__visuel">
                                                <div class="jaquette--petite jaquette--episode">
                                                    <img :src="track.collection.saga.images.cover.thumb" :alt="track.title" height="340px" width="340px">
                                                </div>
                                            </div>
                                            <div class="liste-resultat__info">
                                                <p class="h3">{{ track.title }}</p>
                                                <p class="text-orange-300">
                                                    <i aria-hidden="true" class="fa fa-clock-o"></i>
                                                    <track-length :seconds="track.seconds" type="short"></track-length>
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="zone-interactive__action">
                                        <a class="zone-interactive__bouton" href="">
                                            <i aria-hidden="true" class="fa fa-heart var--actif"></i>
                                        </a>
                                        <a class="zone-interactive__bouton" href="">
                                            <i aria-hidden="true" class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>

                            </a>
                        </li>
                    </ul>

                </div>

                <div class="layout-resultat-recherche__vrac" v-if="otherResults.genres.length > 0">
                    <span class="h1 mb-4">Genres</span>

                    <ul class="liste-resultat">

                        <li class="liste-resultat__item-vrac"
                            v-for="genre in otherResults.genres" :key="genre.id">
                            <router-link :to="{ name: 'listen.genres.show', params: { id: genre.id } }">

                                <div class="zone-interactive">
                                    <div class="zone-interactive__info">

                                        <div class="d-flex">
                                            <div class="liste-resultat__visuel">
                                                <div class="jaquette--petite jaquette--genre">
                                                    <img :src="genre.image.main" :alt="genre.name" height="340px" width="340px">
                                                </div>
                                            </div>
                                            <div class="liste-resultat__info">
                                                <p class="h3">{{ genre.name }}</p>
                                                <p class="text-orange-300">
                                                    <i aria-hidden="true" class="fa fa-file-audio-o"></i> 2 Séries
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="zone-interactive__action">
                                        <a class="zone-interactive__bouton" href="">
                                            <i aria-hidden="true" class="fa fa-heart"></i>
                                        </a>
                                        <a class="zone-interactive__bouton" href="">
                                            <i aria-hidden="true" class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>

                            </router-link>
                        </li>



                    </ul>

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

export default {
    components: {
        SagaPreview,
        SagaZoom,
        AuthorPreview,
        GenrePreview,
        TrackPreview,
        TrackLength,
        SagaStats,
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
