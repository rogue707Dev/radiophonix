<template>
    <div class="playlist justify-content-around">

        <!--//////////////////////////////////////////////////////////////
        PLAYLIST
        //////////////////////////////////////////////////////////////-->
        <template v-if="currentTrack.id">

            <div class="playlist__menu" @click="closePlaylist">
                <i aria-hidden="true" class="fa fa-angle-down text-dark font-weight-bold mr-2"></i>
                <span class="text-dark">Revenir au lecteur</span>
            </div>

            <div class="playlist__liste">
                <template v-for="collection in currentCollections">
                    <!-- Le nom de la saison n'est affiché que s'il y en a plusieurs -->
                    <div class="row"
                        v-if="currentSaga.stats.collections > 1">
                        <div class="col-1"></div>
                        <div class="col h1">
                            {{ collection.name }}
                        </div>
                    </div>

                    <div class="row playlist__morceau a-curseur"
                         v-for="track in collection.tracks"
                         :key="track.id"
                         :class="{'actif': track.id == currentTrack.id}"
                         @click="play({track, autoStart: true})">

                        <div class="col-1 text-center">
                            {{ track.number }}
                        </div>
                        <div class="col">
                            <text-ellispis :text="track.title" :size="25"></text-ellispis>
                            <p class="h6" v-if="currentCollections.length > 1">
                                Saison {{ collection.number }} - {{ collection.name }}
                            </p>
                        </div>
                        <div class="col-auto pr-4">
                            <template v-if="track.id == currentTrack.id">
                                <i v-if="isLoading"  class="fa fa-fw fa-spinner fa-spin"></i>
                                <track-length v-else :seconds="track.seconds" class="h5"></track-length>
                            </template>
                            <tempplate v-else>
                                <track-length :seconds="track.seconds" class="h5"></track-length>
                            </tempplate>
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

export default {
    components: {
        TrackLength,
        TextEllispis,
    },

    computed: mapState('player', [
        'isPlaying',
        'currentTrack',
        'currentCollections',
        'currentSaga',
        'isLoading',
    ]),

    methods: {
        ...mapActions('player', [
            'play'
        ]),

        ...mapActions('ui', [
            'closePlaylist',
        ]),
    }
}
</script>
