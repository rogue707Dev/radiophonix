<template>
    <div class="layout-player-footer" v-if="currentSaga.images.cover.main">

        <button type="button" class="btn-navigation var--player" @click="togglePlayer" :class="{ 'var--actif': isPlayerOpen}">
            <template v-if="isPlayerOpen">
                <i aria-hidden="true" class="fa fa-angle-down text-dark"></i>
            </template>
            <template v-else>
                <i aria-hidden="true" class="fa fa-angle-up"></i>
            </template>
        </button>

        <div class="text-center text-white py-2">
            <strong>
                <text-ellispis :text="currentTrack.title" :size="28"></text-ellispis>
            </strong>
            <router-link :to="{ name: 'listen.sagas.show', params: { idOrSlug: currentSaga.slug } }">
                - <i>{{ currentSaga.name }}</i>
            </router-link>
        </div>

        <button type="button" class="btn-navigation var--play-pause" @click="toggle">
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
            'currentCollections',
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

