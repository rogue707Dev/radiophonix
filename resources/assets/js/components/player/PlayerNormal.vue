<template>

    <div class="lecteur pr">

        <template v-if="!currentTrack.id">
            <div class="text-center texte-blanc my-4">
                <div class="fill--blanc">
                    <svg width="300px" height="50px">
                        <use xlink:href="#logo"/>
                    </svg>
                </div>
                <span class="titre-episode-lecteur text-300 mb-5">
                    Toutes vos sagas au même endroit !
                </span>
            </div>
        </template>

        <div class="row justify-content-center">
            <template v-if="currentSaga.images.cover.main">
                <img :src="currentSaga.images.cover.main" alt="" width="280px" height="280px">
            </template>
            <template v-else>
                <div class="pr">
                    <img src="/static/dev/images/platine.jpg" alt="" width="280px" height="280px" class="img__filtre-grayscale">
                    <div class="lecteur__filtre-bleu"></div>
                </div>
            </template>
        </div>

        <div class="text-center texte-blanc mt-4" v-if="currentTrack.id">
            <p class="titre-episode-lecteur">
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




        <div class="row justify-content-center align-items-center no-gutters texte-blanc texte-petit mt-5" v-if="currentTrack.id">
            <div class="col-auto">
                {{ currentTrack.seconds }}
            </div>
            <div class="col-auto">
                <div class="progress lecteur__barre-progression">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="col-auto">
                {{ time }}
            </div>
        </div>





        <div class="lecteur__bouton-playlist-petite-hauteur" v-if="currentTrack.id">
            <button class="btn-blanc btn-rond-moyen" @click="previous">
                <i aria-hidden="true" class="fa fa-list"></i>
            </button>
        </div>




        <div class="row justify-content-center align-items-center mt-4">
            <template v-if="currentSaga.images.cover.main">
                <div class="col-auto d-block d-lg-none">
                    <button class="btn-blanc btn-rond-moyen" @click="previous">
                        <i aria-hidden="true" class="fa fa-list"></i>
                    </button>
                </div>
                <div class="col-auto">
                    <button class="btn-blanc btn-rond-moyen" @click="previous">
                        <i aria-hidden="true" class="fa fa-backward"></i>
                    </button>
                </div>
                <div class="col-auto">
                    <button class="btn-blanc btn-rond-grand" @click="toggle">
                        <i aria-hidden="true" class="fa fa-play" :class="{'fa-play': !isPlaying, 'fa-pause': isPlaying}"></i>
                    </button>
                </div>
                <div class="col-auto">
                    <button class="btn-blanc btn-rond-moyen" @click="next">
                        <i aria-hidden="true" class="fa fa-forward"></i>
                    </button>
                </div>
                <div class="col-auto d-block d-lg-none">
                    <button class="btn-blanc btn-rond-moyen" @click="next">
                        <i aria-hidden="true" class="fa fa-heart"></i>
                    </button>
                </div>
            </template>
            <template v-else>
                <div class="col-auto">
                    <router-link :to="{ name: 'search' }" tag="button" class="btn-blanc btn-rond-grand">
                        <i aria-hidden="true" class="fa fa-search"></i>
                    </router-link>
                </div>
            </template>
        </div>
        <div class="row justify-content-center mt-2 mb-2 d-none d-md-flex" v-if="currentTrack.id">
            <div class="col-auto">
                <button class="btn-blanc btn-rond-petit">
                    <i aria-hidden="true" class="fa fa-heart"></i>
                </button>
            </div>
        </div>

    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import api from '~/lib/api'
import RadialProgressBar from '~/components/RadialProgressBar.vue';
import TextEllispis from '~/components/text/TextEllipsis.vue';
import Player from '~/lib/Player';

export default {
    components: {
        RadialProgressBar,
        TextEllispis,
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
    }
}
</script>
