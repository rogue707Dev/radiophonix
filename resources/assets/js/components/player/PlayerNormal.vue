<template>
    <div class="lecteur pr"
         :class="{
            'var--playlist-inactif': !currentSaga.id,
            'd-flex flex-column': currentSaga.images.cover.main,
            'd-flex flex-column':!currentSaga.images.cover.main
         }">

        <!--//////////////////////////////////////////////////////////////
        LECTEUR EN COURS
        //////////////////////////////////////////////////////////////-->
        <template v-if="currentSaga.images.cover.main">


            <!----------------------------------------
            Navigation
            ------------------------------------------>
            <div class="lecteur__navigation">
                <button type="button" class="btn btn-theme btn-carre btn-sm lecteur__navigation__fermer-lecteur" @click="togglePlayer">
                    <i aria-hidden="true" class="fa fa-angle-down text-dark"></i>
                </button>

                <button type="button" class="btn btn-theme btn-carre btn-sm lecteur__navigation__affichage-playlist" @click="openPlaylist">
                    <i aria-hidden="true" class="fa fa-list"></i>
                </button>
            </div>


            <!----------------------------------------
            Jaquette et bouton supplémentaire
            ------------------------------------------>
            <div class="lecteur__cover">
                <img :src="currentSaga.images.cover.main" alt="" width="280px" height="280px">

                <div class="lecteur__cover__loader" v-if="isLoading">
                    <i class="fa fa-fw fa-spinner fa-spin"></i>
                    <span class="mt-2 lead text-dark">Chargement</span>
                </div>

                <div class="lecteur__cover__bouton">
                    <button type="button" class="btn btn-theme btn-carre btn-sm mb-3 lecteur__cover__bouton__affichage-playlist" @click="openPlaylist">
                        <i aria-hidden="true" class="fa fa-list"></i>
                    </button>

                    <like-button class="btn btn-theme btn-carre btn-sm mb-3"
                                 likeable-type="saga"
                                 :likeable-id="currentSaga.id"></like-button>

                    <router-link :to="{ name: 'listen.sagas.show', params: { idOrSlug: currentSaga.slug } }"
                                 class="btn btn-theme btn-carre btn-sm mb-3">
                        <i aria-hidden="true" class="fa fa-info"></i>
                    </router-link>
                </div>

            </div>


            <div class="lecteur__contenu">

                <!----------------------------------------
                Progession
                ------------------------------------------>
                <div class="progression text-dark h5 mt-4">
                    <span class="text-left">{{ currentTime }}</span>
                    <progress class="progression__barre var--lecteur"
                              @click="seek"
                              :value="currentPercentage"
                              max="100"></progress>
                    <track-length class="text-right" :seconds="currentTrack.seconds"></track-length>
                </div>

                <!----------------------------------------
                Controle
                ------------------------------------------>
                <div class="lecteur__controle">
                    <button type="button" class="btn btn-theme btn-carre" @click="previous">
                        <i aria-hidden="true" class="fa fa-step-backward"></i>
                    </button>
                    <button type="button" class="btn btn-theme btn-carre btn-lg" @click="toggle">
                        <i aria-hidden="true" class="fa fa-play" :class="{'fa-play': !isPlaying, 'fa-pause': isPlaying}"></i>
                    </button>
                    <button type="button" class="btn btn-theme btn-carre" @click="next">
                        <i aria-hidden="true" class="fa fa-step-forward"></i>
                    </button>
                </div>

                <!----------------------------------------
                Info du morceau
                ------------------------------------------>
                <div class="text-center text-dark">
                    <p class="lead text-dark">
                        <text-ellispis :text="currentTrack.title" :size="28"></text-ellispis>
                    </p>
                    <p>
                        <router-link :to="{ name: 'listen.sagas.show', params: { idOrSlug: currentSaga.slug } }">
                            <i>{{ currentSaga.name }}</i>
                        </router-link>
                    </p>
                    <p>
                        <template v-if="currentSaga.stats.albums > 1">
                            Saison {{ currentAlbum.number }} épisode {{ currentTrack.number }}
                        </template>
                        <template v-else>
                            Épisode {{ currentTrack.number }}
                        </template>
                    </p>
                </div>
            </div>

        </template>




        <!--//////////////////////////////////////////////////////////////
        LECTEUR PAR DEFAUT
        //////////////////////////////////////////////////////////////-->
        <template v-else>

            <!----------------------------------------
            Logo et baseline
            ------------------------------------------>
            <div class="text-center text-dark">
                <svg width="280px" height="50px" class="fill--logo-bleu">
                    <use xlink:href="#logo-part1of2"></use>
                    <use xlink:href="#logo-part2of2"></use>
                </svg>
                <br>
                <span class="lead text-dark">
                    Toutes vos sagas au même endroit
                </span>
            </div>

            <!----------------------------------------
            image
            ------------------------------------------>
            <img class="img-cover-aside" src="/static/dev/images/radio.png" alt="" width="307px" height="290px">

            <!----------------------------------------
            Recherche
            ------------------------------------------>
            <div class="row justify-content-center mb-5">
                <div class="col-auto">
                    <router-link :to="{ name: 'search' }" tag="button" class="btn btn-theme btn-carre btn-lg">
                        <i aria-hidden="true" class="fa fa-search"></i>
                    </router-link>
                </div>
            </div>

        </template>

    </div>
</template>

<script>
import { mapState, mapActions, mapGetters } from 'vuex';
import Player from '~/lib/Player';
import TextEllispis from '~/components/text/TextEllipsis.vue';
import TrackLength from '~/components/track/TrackLength.vue';
import LikeButton from "~/components/Like/LikeButton";
import api from '~/lib/api';

export default {
    components: {
        LikeButton,
        TextEllispis,
        TrackLength,
    },

    data: () => ({
        totalSteps: 100,
    }),

    computed: {
        ...mapState('player', [
            'isPlaying',
            'currentTrack',
            'currentSaga',
            'currentAlbum',
            'currentAlbums',
            'currentPercentage',
            'currentTime',
            'isLoading',
        ]),

        ...mapGetters('auth', [
            'isAuthenticated',
        ]),
    },

    methods: {
        ...mapActions('player', [
            'toggle',
            'next',
            'previous',
        ]),

        ...mapActions('ui', [
            'openPlaylist',
            'togglePlayer',
        ]),

        // Confirmation de fermeture de la page si un épisode est
        // en cours de lecture.
        beforeClosing(event) {
            if (false === this.$store.state.player.isPlaying
                && !this.$store.state.player.currentTrack.id
            ) {
                return;
            }

            event.preventDefault();

            // https://developer.mozilla.org/en-US/docs/Web/Events/beforeunload#Example
            event.returnValue = "\o/";

            return '';
        },

        seek(e) {
            let percent = (e.offsetX / e.target.offsetWidth) * 100;

            this.$store.dispatch('player/seek', percent);
            Player.storePercentage();
        },

        startLoops() {
            let vm = this;

            let doLoop = () => {
                vm.$store.dispatch('player/refresh');
            };

            if (!this.isAuthenticated) {
                doLoop = () => {
                    vm.$store.dispatch('player/refresh');
                    Player.storePercentage();
                };
            }

            let loopForView = setInterval(function () {
                doLoop();

                if (!vm.$store.state.player.isPlaying) {
                    clearInterval(loopForView);
                }
            }, 1000);

            if (!this.isAuthenticated) {
                return;
            }

            let tickIsSending = false;

            let loopForTicks = setInterval(function () {
                if (tickIsSending) {
                    return;
                }

                tickIsSending = true;

                api.ticks
                    .savePercentage(
                        vm.$store.state.player.currentTrack.id,
                        Player.percentage()
                    )
                    .then(() => {
                        tickIsSending = false;
                    });

                if (!vm.$store.state.player.isPlaying) {
                    clearInterval(loopForTicks);
                }
            }, 5000);
        },
    },

    watch: {
        'isPlaying': 'startLoops',
    },

    created() {
        this.$store.dispatch('player/refresh');
        // window.addEventListener('beforeunload', this.beforeClosing);
    }
}
</script>
