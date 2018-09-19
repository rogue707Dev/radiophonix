<template>
    <div class="lecteur__playlist justify-content-around">

        <!--//////////////////////////////////////////////////////////////
        PLAYLIST NON UTILISER
        //////////////////////////////////////////////////////////////-->
        <template v-if="!currentTrack.id">

            <div class="row text-center mb-5">
                <div class="col-12">
                    <i class="fa fa-bullhorn var--sidebar var--aide"></i>
                    <p class="lead text-white">
                        Selectionnez une saga puis un épisode pour l'ajouter à votre playlist
                    </p>
                </div>
            </div>

        </template>


        <!--//////////////////////////////////////////////////////////////
        PLAYLIST
        //////////////////////////////////////////////////////////////-->
        <template v-else>

            <div class="lecteur__playlist__menu" @click="closePlaylist">
                Revenir au player
                <i aria-hidden="true" class="fa fa-close"></i>
            </div>

            <div class="lecteur__playlist__liste">
                <template v-for="collection in currentCollections">
                    <!-- Le nom de la saison n'est affiché que s'il y en a plusieurs -->
                    <div class="row"
                        v-if="currentSaga.stats.collections > 1">
                        <div class="col h1">
                            {{ collection.name }}
                        </div>
                    </div>

                    <div class="row lecteur__playlist__morceau a-curseur"
                         v-for="track in collection.tracks"
                         :key="track.id"
                         :class="{'actif': track.id == currentTrack.id}"
                         @click="play({track})">

                        <div class="col-1 text-center">
                            <i v-if="track.id == currentTrack.id" class="fa fa-volume-up"></i>
                            <template v-else>{{ track.number }}</template>
                        </div>
                        <div class="col">
                            <text-ellispis :text="track.title" :size="25"></text-ellispis>
                            <p class="h6" v-if="currentCollections.length > 1">
                                Saison {{ collection.number }} - {{ collection.name }}
                            </p>
                        </div>
                        <div class="col-auto pr-4">
                            <track-length :seconds="track.seconds" type="number" class="h5"></track-length>
                        </div>

                    </div>

                </template>
            </div>


        </template>



    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import TrackLength from '~/components/track/Length.vue';
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
        'currentSaga'
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

