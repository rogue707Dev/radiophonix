<template>
    <div class="lecteur-footer-navigation"
         :class="{'d-none': isPlayerOpen}"
         v-if="currentSaga.images.cover.main">

        <button type="button" class="btn btn-theme btn-carre btn-sm" @click="togglePlayer">
            <i aria-hidden="true" class="fa fa-angle-up"></i>
        </button>

        <div class="text-dark" @click="togglePlayer">
            <text-ellispis class="font-weight-bold" :text="currentTrack.title" :size="28"></text-ellispis>
            <router-link :to="{ name: 'listen.sagas.show', params: { idOrSlug: currentSaga.slug } }">
                - <text-ellispis class="font-italic" :text="currentSaga.name" :size="15"></text-ellispis>
            </router-link>
        </div>

        <button type="button" class="btn btn-theme btn-carre btn-sm" @click="toggle">
            <i aria-hidden="true" class="fa fa-play" :class="{'fa-play': !isPlaying, 'fa-pause': isPlaying}"></i>
        </button>

    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import Player from '~/lib/Player';
import TextEllispis from '~/components/text/TextEllipsis.vue';


export default {
    components: {
        TextEllispis,
    },

    computed: {
        ...mapState('player', [
            'isPlaying',
            'currentTrack',
            'currentAlbums',
            'currentSaga',
        ]),

        ...mapState('ui', [
            'isPlayerOpen',
        ]),
    },

    methods: {
        ...mapActions('player', [
            'toggle',
            'play',
        ]),

        ...mapActions('ui', [
            'togglePlayer',
        ]),
    }
}
</script>

