<template>
    <div class="lecteur pr"
         :class="{
            'd-flex flex-column justify-content-around': currentSaga.images.cover.main,
            'd-flex flex-column justify-content-around':!currentSaga.images.cover.main}
        ">

        <!--//////////////////////////////////////////////////////////////
        LECTEUR EN COURS
        //////////////////////////////////////////////////////////////-->
        <template v-if="currentSaga.images.cover.main">



            <!----------------------------------------
            Jaquette et bouton supplémentaire
            ------------------------------------------>
            <div class="pr">
                <img :src="currentSaga.images.cover.main" alt="" width="280px" height="280px">

                <!--Bouton ajouter en favoris-->
                <button class="btn btn-outline-theme btn-round btn-lg pa-centrer lecteur__bouton-masque">
                    <i aria-hidden="true" class="fa fa-heart"></i>
                </button>

            </div>



            <!----------------------------------------
            Info du morceau
            ------------------------------------------>
            <div class="text-center text-white mt-4">
                <p class="lead text-white">
                    <text-ellispis :text="currentTrack.title" :size="32"></text-ellispis>
                </p>
                <p>
                    <router-link :to="{ name: 'listen.sagas.show', params: { idOrSlug: currentSaga.slug } }">
                        <i>{{ currentSaga.name }}</i>
                    </router-link>
                </p>
                <p>
                    <template v-if="currentSaga.stats.collections > 1">
                        Saison {{ currentCollection.number }} épisode {{ currentTrack.number }}
                    </template>
                    <template v-else>
                        Épisode {{ currentTrack.number }}
                    </template>
                </p>
            </div>

            <!----------------------------------------
            Progession
            ------------------------------------------>
            <div class="lecteur__progression text-white h5 mt-4">
                <span>{{ time }}</span>
                <progress class="lecteur__progression__barre"
                          @click="seek"
                          :value="currentPercentage"
                          max="100"></progress>
                <track-length class="text-right" :seconds="currentTrack.seconds" type="number"></track-length>
            </div>

            <!----------------------------------------
            Controle
            ------------------------------------------>
            <div class="lecteur__disposition mt-5">
                <button class="btn btn-outline-theme btn-round lecteur__bouton-affichage" @click="openPlaylist">
                    <i aria-hidden="true" class="fa fa-list"></i>
                </button>
                <button class="btn btn-outline-theme btn-round" @click="previous">
                    <i aria-hidden="true" class="fa fa-backward"></i>
                </button>
                <button class="btn btn-outline-theme btn-round btn-lg" @click="toggle">
                    <i aria-hidden="true" class="fa fa-play" :class="{'fa-play': !isPlaying, 'fa-pause': isPlaying}"></i>
                </button>
                <button class="btn btn-outline-theme btn-round" @click="next">
                    <i aria-hidden="true" class="fa fa-forward"></i>
                </button>
                <button class="btn btn-outline-theme btn-round lecteur__bouton-affichage">
                    <i aria-hidden="true" class="fa fa-heart"></i>
                </button>
            </div>

        </template>




        <!--//////////////////////////////////////////////////////////////
        LECTEUR PAR DEFAUT
        //////////////////////////////////////////////////////////////-->
        <template v-else>

            <!----------------------------------------
            Logo et baseline
            ------------------------------------------>
            <div class="text-center text-white">
                <svg width="280px" height="50px" class="fill--blanc">
                    <use xlink:href="#logo-part1of2"></use>
                    <use xlink:href="#logo-part2of2"></use>
                </svg>
                <span class="lead text-white">
                    Toutes vos sagas au même endroit !
                </span>
            </div>

            <!----------------------------------------
            image
            ------------------------------------------>
            <img class="img-cover-aside" src="/static/dev/images/radio.png" alt="" width="307px" height="290px">

            <!----------------------------------------
            Recherche
            ------------------------------------------>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <router-link :to="{ name: 'search' }" tag="button" class="btn btn-outline-theme btn-round btn-lg">
                        <i aria-hidden="true" class="fa fa-search"></i>
                    </router-link>
                </div>
            </div>

        </template>

    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import RadialProgressBar from '~/components/RadialProgressBar.vue';
import TextEllispis from '~/components/text/TextEllipsis.vue';
import TrackLength from '~/components/track/Length.vue';
import Player from '~/lib/Player';

export default {
    components: {
        RadialProgressBar,
        TextEllispis,
        TrackLength,
    },

    data() {
        return {
            time: '00:00',
            totalSteps: 100,
            currentPercentage: 0,
        }
    },

    computed: mapState('player', [
        'isPlaying',
        'currentTrack',
        'currentSaga',
        'currentCollection',
        'currentCollections',
    ]),

    methods: {
        ...mapActions('player', [
            'toggle',
            'next',
            'previous',
        ]),

        ...mapActions('ui', [
            'openPlaylist',
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
            let percent = e.offsetX / e.target.offsetWidth;

            Player.seekPercentage(percent * 100);

            this.currentPercentage = Player.percentage();
            this.time = Player.time();
        },

        startLoop() {
            let vm = this;

            let loop = setInterval(function () {
                vm.currentPercentage = Player.percentage();
                vm.time = Player.time();

                if (!vm.$store.state.player.isPlaying) {
                    clearInterval(loop);
                }
            }, 1000);
        },
    },

    watch: {
        'isPlaying': 'startLoop'
    },

    created() {
        this.startLoop();
        window.addEventListener('beforeunload', this.beforeClosing);
    }
}
</script>
