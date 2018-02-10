<template>

    <div class="lecteur pr">

        <div class="lecteur__fond pr">
            <template v-if="currentSaga.images.cover.main">
                <img :src="currentSaga.images.cover.main" alt="" width="340px" height="340px" class="img__filtre-grayscale">
                <div class="lecteur__filtre-rouge"></div>
                <img :src="currentSaga.images.cover.main" alt="" width="340px" height="340px" class="img__filtre-grayscale lecteur__masque-image">
                <div class="lecteur__filtre-bleu"></div>
            </template>
            <template v-else>
                <img src="/static/dev/images/platine.jpg" alt="" width="340px" height="340px" class="img__filtre-grayscale">
                <div class="lecteur__filtre-rouge"></div>
            </template>
        </div>

        <div class="lecteur__bouton-lecture" :class="{'lecteur__bouton-recherche': !currentTrack.id}">
            <template v-if="!currentTrack.id">
                <router-link :to="{ name: 'search' }" tag="button" class="btn-blanc btn-grand-rond">
                    <i aria-hidden="true" class="fa fa-search"></i>
                </router-link>
            </template>
            <template v-else>
                <button class="btn-blanc btn-grand-rond" @click="toggle">
                    <i aria-hidden="true" class="fa fa-play" :class="{'fa-play': !isPlaying, 'fa-pause': isPlaying}"></i>
                </button>
            </template>
        </div>

        <div class="lecteur__interface d-flex flex-column" :class="{ 'justify-content-center': !currentTrack.id }">
            <div v-if="!currentTrack.id" class="text-center">
                <div class="fill--blanc">
                    <svg width="300px" height="50px">
                        <use xlink:href="#logo"/>
                    </svg>
                </div>
                <span class="titre-episode-lecteur text-300 mb-5">
                    Toutes vos sagas au même endroit !
                </span>
            </div>
            <div v-else class="lecteur__titre text-center texte-blanc">
                <div>
                    <p class="titre-episode-lecteur">
                        <text-ellispis :text="currentTrack.title" :size="32"></text-ellispis>
                    </p>
                    <p class="texte-blanc">
                        <router-link :to="{ name: 'listen.sagas.show', params: { idOrSlug: currentSaga.slug } }">
                            <i>{{ currentSaga.name }}</i>
                        </router-link>
                    </p>
                    <p class="texte-blanc">
                        <template v-if="currentSaga.stats.collections > 1">
                            Saison {{ currentCollection.number }} épisode {{ currentTrack.number }}
                        </template>
                        <template v-else>
                            Épisode {{ currentTrack.number }}
                        </template>
                    </p>
                </div>
            </div>

            <template v-if="currentTrack.id">
                <div class="lecteur__info pr">
                    <div class="lecteur__barre-progression" v-if="currentTrack.id">

                        <!--f2c09e-->
                        <radial-progress-bar :diameter="230"
                                             :completed-steps="currentPercentage"
                                             :total-steps="totalSteps"
                                             start-color="#3a4651"
                                             stop-color="#3a4651"
                                             inner-stroke-color="#ffffff"
                                             :animate-speed="10"
                                             :stroke-width="3">
                        </radial-progress-bar>

                    </div>

                    <div v-if="currentTrack.id" class="lecteur__info__btn">
                        <button class="lecteur__bouton--btn" @click="previous">
                            <i aria-hidden="true" class="fa fa-backward"></i>
                        </button>
                    </div>
                    <div v-if="currentTrack.id" class="col text-center texte-blanc">
                        <div class="texte-tres-grand lecteur__temps">{{ time }}</div>
                        <button class="lecteur__bouton--btn">
                            <i aria-hidden="true" class="fa fa-heart"></i>
                        </button>
                    </div>
                    <div v-if="currentTrack.id" class="lecteur__info__btn">
                        <button class="lecteur__bouton--btn" @click="next">
                            <i aria-hidden="true" class="fa fa-forward"></i>
                        </button>
                    </div>
                </div>
            </template>
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
