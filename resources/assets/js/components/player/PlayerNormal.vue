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
                <button class="btn-blanc btn-rond-grand pa-centrer lecteur__bouton-masque">
                    <i aria-hidden="true" class="fa fa-heart"></i>
                </button>

            </div>



            <!----------------------------------------
            Info du morceau
            ------------------------------------------>
            <div class="text-center texte-blanc mt-4">
                <p class="titre-sidebar">
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
            <div class="lecteur__progression texte-blanc texte-petit mt-4">
                {{ time }}
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
                <button class="btn-blanc btn-rond-moyen lecteur__bouton-affichage" @click="openPlaylist">
                    <i aria-hidden="true" class="fa fa-list"></i>
                </button>
                <button class="btn-blanc btn-rond-moyen" @click="previous">
                    <i aria-hidden="true" class="fa fa-backward"></i>
                </button>
                <button class="btn-blanc btn-rond-grand" @click="toggle">
                    <i aria-hidden="true" class="fa fa-play" :class="{'fa-play': !isPlaying, 'fa-pause': isPlaying}"></i>
                </button>
                <button class="btn-blanc btn-rond-moyen" @click="next">
                    <i aria-hidden="true" class="fa fa-forward"></i>
                </button>
                <button class="btn-blanc btn-rond-moyen lecteur__bouton-affichage">
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
            <div class="text-center texte-blanc">
                <svg width="280px" height="50px" class="fill--blanc">
                    <use xlink:href="#logo-part1of2"></use>
                    <use xlink:href="#logo-part2of2"></use>
                </svg>
                <span class="titre-sidebar">
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
                    <router-link :to="{ name: 'search' }" tag="button" class="btn-blanc btn-rond-grand">
                        <i aria-hidden="true" class="fa fa-search"></i>
                    </router-link>
                </div>
            </div>

        </template>

    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import api from '~/lib/api'
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
            time: '',
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
