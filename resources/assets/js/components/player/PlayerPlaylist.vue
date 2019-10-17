<template>
    <div class="playlist justify-content-around">

        <!--//////////////////////////////////////////////////////////////
        PLAYLIST
        //////////////////////////////////////////////////////////////-->
        <template v-if="currentTrack.id">

            <div class="lecteur-mini">

                <!----------------------------------------
                Navigation
                ------------------------------------------>
                <div class="lecteur-mini__navigation">
                    <button type="button" class="btn btn-theme btn-carre btn-sm" @click="hidePlaylist">
                        <i aria-hidden="true" class="fa fa-angle-down"></i>
                    </button>

                    <button type="button" class="btn btn-theme btn-carre btn-sm" @click="closePlaylist">
                        <i aria-hidden="true" class="fa fa-times"></i>
                    </button>
                </div>

                <!----------------------------------------
                Cover
                ------------------------------------------>
                <div class="lecteur-mini__cover">
                    <div class="lecteur-mini__cover__visuel">
                        <img :src="currentSaga.images.cover.main" alt="" width="68px" height="68px">

                        <div class="pa-center" v-if="isLoading">
                            <i class="fa fa-fw fa-spinner fa-spin"></i>
                        </div>

                        <button type="button"
                                v-if="!isLoading"
                                class="btn btn-theme btn-carre btn-sm border-0 lecteur-mini__cover__play"
                                @click="toggle">
                            <i aria-hidden="true" class="fa fa-play" :class="{'fa-play': !isPlaying, 'fa-pause': isPlaying}"></i>
                        </button>
                    </div>
                </div>

                <!----------------------------------------
                Info
                ------------------------------------------>
                <div class="lecteur-mini__info text-dark">
                    <p class="lead">
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

                <!----------------------------------------
                Progression
                ------------------------------------------>
                <div class="lecteur-mini__progression">
                    <div class="progression text-dark h5">
                        <span class="text-left">{{ currentTime }}</span>
                        <progress class="progression__barre var--lecteur"
                                  @click="seek"
                                  :value="currentPercentage"
                                  max="100"></progress>
                        <track-length class="text-right" :seconds="currentTrack.seconds"></track-length>
                    </div>
                </div>

                <!----------------------------------------
                Bouton secaondaire
                ------------------------------------------>
                <div class="lecteur-mini__bouton">
                    <div class="lecteur-mini__bouton__disposition">
                        <button type="button" class="btn-picto lecteur-mini__bouton__fermer" @click="closePlaylist">
                            <i aria-hidden="true" class="fa fa-times"></i>
                        </button>
                        <like-button class="btn-picto"
                                     likeable-type="saga"
                                     :likeable-id="currentSaga.id"></like-button>

                        <router-link :to="{ name: 'listen.sagas.show', params: { idOrSlug: currentSaga.slug } }"
                                     class="btn-picto">
                            <i aria-hidden="true" class="fa fa-info"></i>
                        </router-link>
                    </div>
                </div>

                <!----------------------------------------
                Controle  player
                ------------------------------------------>
                <div class="lecteur-mini__controle">
                    <button type="button" class="btn-picto" @click="previous">
                        <i aria-hidden="true" class="fa fa-step-backward"></i>
                    </button>
                    <button type="button" class="btn-picto" @click="next">
                        <i aria-hidden="true" class="fa fa-step-forward"></i>
                    </button>
                </div>


            </div>

            <div class="playlist__liste">
                <template v-for="album in currentAlbums">
                    <!-- Le nom de la saison n'est affiché que s'il y en a plusieurs -->
                    <div class="playlist__grille playlist__saison"
                        v-if="currentSaga.stats.albums > 1">

                        <i aria-hidden="true" class="fa fa-book"></i>
                        <template v-if="'Saison ' + album.number == album.name">
                            <text-ellispis :text="album.name" :size="24"></text-ellispis>
                        </template>
                        <template v-else>
                            <text-ellispis :text="'Saison ' + album.number + ' : ' + album.name" :size="24"></text-ellispis>
                        </template>

                    </div>

                    <div class="playlist__grille playlist__morceau a-curseur"
                         v-for="track in album.tracks"
                         :key="track.id"
                         :class="{'actif': track.id == currentTrack.id}"
                         @click="play({track, autoStart: true})">

                        <div>
                            {{ track.number }}
                        </div>
                        <text-ellispis :text="track.title" :size="25"></text-ellispis>
                        <div>
                            <i v-if="track.id == currentTrack.id && isLoading"
                               class="fa fa-fw fa-spinner fa-spin"></i>
                            <track-length v-else :seconds="track.seconds" class="h5"></track-length>
                        </div>

                    </div>

                </template>
            </div>


        </template>



    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import TrackLength from '~/components/track/TrackLength.vue';
import TextEllispis from '~/components/text/TextEllipsis.vue';
import LikeButton from "~/components/Like/LikeButton";
import Player from '~/lib/Player';

export default {
    components: {
        TrackLength,
        TextEllispis,
        LikeButton,
    },

    computed: mapState('player', [
        'isPlaying',
        'currentTrack',
        'currentAlbum',
        'currentAlbums',
        'currentSaga',
        'currentPercentage',
        'currentTime',
        'isLoading',
    ]),

    methods: {
        ...mapActions('player', [
            'toggle',
            'next',
            'previous',
            'play',
        ]),

        ...mapActions('ui', [
            'closePlaylist',
            'togglePlayer',
        ]),

        hidePlaylist() {
            this.togglePlayer();
            this.closePlaylist();
        },

        seek(e) {
            // @todo fusionner avec PlayerNormal.vue

            let percent = (e.offsetX / e.target.offsetWidth) * 100;

            this.$store.dispatch('player/seek', percent);
            Player.storePercentage();
        },
    }
}
</script>
