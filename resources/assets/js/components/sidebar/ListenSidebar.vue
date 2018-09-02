<template>
    <div>
        <!-- TODO a quoi sert ce fichier ? le template na pas l'air d'etre utiliser -->

        <div class="layout-sidebar__lecteur">
            <player-normal></player-normal>
        </div>

        <div class="layout-sidebar__contenu">
            <player-playlist></player-playlist>
        </div>


    </div>
</template>

<script>
import { mapState } from 'vuex';
import PlayerNormal from '~/components/player/PlayerNormal.vue';
import PlayerPlaylist from '~/components/player/PlayerPlaylist.vue';

export default {
    components: {
        'player-normal': PlayerNormal,
        'player-playlist': PlayerPlaylist,
    },

    computed: {
        ...mapState('player', [
            'currentSaga',
        ]),

        style() {
            if (!this.currentSaga.images.cover.meta) {
                return {};
            }

            return {
                backgroundColor: this.currentSaga.images.cover.meta.color
            };
        }
    },
}
</script>
