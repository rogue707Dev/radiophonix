<template>

    <div class="layout-global">

        <div class="layout-global__header">
            <header-mobile></header-mobile>
        </div>

        <div class="layout-global__menu" :class="{actif: isMenuOpen}">
            <rp-menu></rp-menu>
        </div>

        <!--TODO "isPlaylistOpen" toggle de la class "inactif"  -->
        <div class="layout-global__lecteur">
            <player-normal></player-normal>
        </div>

        <!--TODO "isPlaylistOpen" toggle de la class "actif"  -->
        <div class="layout-global__playlist">
            <player-playlist></player-playlist>
        </div>

        <div class="layout-global__main">
            <router-view></router-view>
        </div>

    </div>

</template>

<script>
import { mapState, mapActions } from 'vuex';
import HeaderMobile from '~/components/menu/HeaderMobile.vue';
import PlayerNormal from '~/components/player/PlayerNormal.vue';
import PlayerPlaylist from '~/components/player/PlayerPlaylist.vue';

export default {
    components: {
        HeaderMobile,
        'player-normal': PlayerNormal,
        'player-playlist': PlayerPlaylist,
    },

    data() {
        return {
            isPlayerOpen: false,
        };
    },

    computed: {
        ...mapState('menu', [
            'isMenuOpen',
        ])
    },

    methods: {
        ...mapActions('menu', [
            'toggle',
        ]),

        togglePlayer() {
            if (this.isPlayerOpen) {
                this.$router.back();
            } else {
                this.$router.push({ name: 'listen.sagas.index' });
            }

            this.isPlayerOpen = !this.isPlayerOpen;
        }
    }
}
</script>
