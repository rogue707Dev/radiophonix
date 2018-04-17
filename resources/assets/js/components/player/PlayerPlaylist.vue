<template>
    <div class="lecteur__playlist justify-content-around">

        <!--//////////////////////////////////////////////////////////////
        PLAYLIST NON UTILISER
        //////////////////////////////////////////////////////////////-->
        <template v-if="!currentTrack.id">

            <div class="row text-center mb-5">
                <div class="col-12">
                    <i class="fa fa-bullhorn fa--sidebar fa--aide"></i>
                    <p class="titre-sidebar">
                        Selectionnez une saga puis un épisode pour l'ajouter à votre playlist
                    </p>
                </div>
            </div>

        </template>


        <!--//////////////////////////////////////////////////////////////
        PLAYLIST
        //////////////////////////////////////////////////////////////-->
        <template v-else>

            <template v-for="collection in currentCollections">

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
                        <text-ellispis :text="track.title" :size="27"></text-ellispis>
                        <p class="texte-tres-petit" v-if="currentCollections.length > 1">
                            Saison {{ collection.number }} - {{ collection.name }}
                        </p>
                    </div>
                    <div class="col-auto pr-4">
                        <track-length :seconds="track.seconds" :short="true" class="texte-petit"></track-length>
                    </div>

                </div>

            </template>

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

    methods: mapActions('player', [
        'play'
    ])
}
</script>

