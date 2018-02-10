<template>
    <div class="layout-conteneur__main" :class="{'h-100': !hasResults}">


        <template v-if="hasResults">


            <div class="layout-resultat-recherche">

                <!-- 4max : mise en avant -->
                <div class="layout-resultat-recherche__zoom">

                    <span class="titre--bloc mb-4">Meilleurs résultats</span>



                    <ul class="liste-resultat">

                        <li class="liste-resultat__item-zoom" v-if="highlights.saga.id">
                            <router-link :to="{ name: 'listen.sagas.show', params: { idOrSlug: highlights.saga.slug } }" class="text-center">
                                <div class="zone-interactive__border d-flex">
                                    <div class="flex-grow-1">
                                        <div class="jaquette--moyen jaquette--saga">
                                            <img :src="highlights.saga.images.cover.main" :alt="highlights.saga.name" width="340px" height="340px">
                                        </div>
                                    </div>
                                </div>
                                <div class="zone-interactive border-top-0">
                                    <div class="zone-interactive__action">
                                        <a href="" class="zone-interactive__bouton">
                                            <i aria-hidden="true" class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                    <div class="zone-interactive__info p-1">
                                        <p class="titre-resultat-recherche">{{ highlights.saga.name }}</p>
                                        <p class="texte-orange-fonce">
                                            <saga-stats
                                                :stats="highlights.saga.stats"
                                                :with-icon="true">
                                            </saga-stats>
                                        </p>
                                    </div>
                                    <div class="zone-interactive__action">
                                        <a href="" class="zone-interactive__bouton">
                                            <i aria-hidden="true" class="fa fa-heart actif"></i>
                                        </a>
                                    </div>
                                </div>
                            </router-link>
                        </li>


                        <li class="liste-resultat__item-zoom" v-if="highlights.author.id">
                            <router-link :to="{ name: 'listen.authors.show', params: { id: highlights.author.slug } }" class="text-center">
                                <div class="zone-interactive__border d-flex">
                                    <div class="flex-grow-1">
                                        <div class="jaquette--moyen jaquette--faiseur">
                                            <img :src="highlights.author.picture.thumb" :alt="highlights.author.name" width="340px" height="340px">
                                        </div>
                                    </div>
                                </div>
                                <div class="zone-interactive border-top-0">
                                    <div class="zone-interactive__action">
                                        <a href="" class="zone-interactive__bouton">
                                            <i aria-hidden="true" class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                    <div class="zone-interactive__info p-1">
                                        <p class="titre-resultat-recherche">{{ highlights.author.name }}</p>
                                        <p class="texte-orange-fonce">
                                            <i aria-hidden="true" class="fa fa-file-audio-o"></i>
                                            {{ highlights.author.stats.sagas }} Séries
                                        </p>
                                    </div>
                                    <div class="zone-interactive__action">
                                        <a href="" class="zone-interactive__bouton">
                                            <i aria-hidden="true" class="fa fa-heart"></i>
                                        </a>
                                    </div>
                                </div>
                            </router-link>
                        </li>


                        <li class="liste-resultat__item-zoom" v-if="highlights.track.id">
                            <a href="/ecouter/sagas/le-donjon-de-naheulbeuk" class="text-center">
                                <div class="zone-interactive__border d-flex">
                                    <div class="flex-grow-1">
                                        <div class="jaquette--moyen jaquette--episode">
                                            <img :src="highlights.track.collection.saga.images.cover.thumb" :alt="highlights.track.title" width="340px" height="340px">
                                        </div>
                                    </div>
                                </div>
                                <div class="zone-interactive border-top-0">
                                    <div class="zone-interactive__action">
                                        <a href="" class="zone-interactive__bouton">
                                            <i aria-hidden="true" class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                    <div class="zone-interactive__info p-1">
                                        <p class="titre-resultat-recherche">{{ highlights.track.title }}</p>
                                        <p class="texte-orange-fonce">
                                            <i aria-hidden="true" class="fa fa-clock-o"></i>
                                            <track-length :seconds="highlights.track.seconds" :short="true"></track-length>
                                        </p>
                                    </div>
                                    <div class="zone-interactive__action">
                                        <a href="" class="zone-interactive__bouton">
                                            <i aria-hidden="true" class="fa fa-heart"></i>
                                        </a>
                                    </div>
                                </div>
                            </a>
                        </li>


                        <li class="liste-resultat__item-zoom" v-if="highlights.genre.id">
                            <router-link :to="{ name: 'listen.genres.show', params: { id: highlights.genre.id } }" class="text-center">
                                <div class="zone-interactive__border d-flex">
                                    <div class="flex-grow-1">
                                        <div class="jaquette--moyen jaquette--genre">
                                            <img :src="highlights.genre.image.main" :alt="highlights.genre.name" width="340px" height="340px">
                                        </div>
                                    </div>
                                </div>
                                <div class="zone-interactive border-top-0">
                                    <div class="zone-interactive__action">
                                        <a href="" class="zone-interactive__bouton">
                                            <i aria-hidden="true" class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                    <div class="zone-interactive__info p-1">
                                        <p class="titre-resultat-recherche">{{ highlights.genre.name }}</p>
                                        <p class="texte-orange-fonce">
                                            <i aria-hidden="true" class="fa fa-file-audio-o"></i> 2 Séries
                                        </p>
                                    </div>
                                    <div class="zone-interactive__action">
                                        <a href="" class="zone-interactive__bouton">
                                            <i aria-hidden="true" class="fa fa-heart"></i>
                                        </a>
                                    </div>
                                </div>
                            </router-link>
                        </li>


                    </ul>





                </div>

                <!-- reste en vrac -->
                <div class="layout-resultat-recherche__vrac" v-if="otherResults.sagas.length > 0">

                    <!-- mélanger -->
                    <span class="titre--bloc mb-4">Sagas</span>

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
                                                <p class="titre-resultat-recherche">{{ saga.name }}</p>
                                                <p class="texte-orange-fonce">
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
                    <span class="titre--bloc mb-4">Faiseurs</span>

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
                                                <p class="titre-resultat-recherche">{{ author.name }}</p>
                                                <p class="texte-orange-fonce">
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
                    <span class="titre--bloc mb-4">Episodes</span>

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
                                                <p class="titre-resultat-recherche">{{ track.title }}</p>
                                                <p class="texte-orange-fonce">
                                                    <i aria-hidden="true" class="fa fa-clock-o"></i>
                                                    <track-length :seconds="track.seconds" :short="true"></track-length>
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="zone-interactive__action">
                                        <a class="zone-interactive__bouton" href="">
                                            <i aria-hidden="true" class="fa fa-heart actif"></i>
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
                    <span class="titre--bloc mb-4">Genres</span>

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
                                                <p class="titre-resultat-recherche">{{ genre.name }}</p>
                                                <p class="texte-orange-fonce">
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
                <div class="text-center texte-bleu-fonce">
                    <i class="fa fa-bullhorn" style="font-size: 100px;"></i>
                    <span class="titre--bloc mb-4">Lancez une recherche...</span>
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
