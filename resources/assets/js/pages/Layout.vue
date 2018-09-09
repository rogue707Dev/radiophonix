<template>

    <div class="layout-global">

        <div class="layout-global__header">
            <header-mobile></header-mobile>
        </div>

        <div class="layout-global__menu" :class="{actif: isMenuOpen, inactif: !isMenuOpen}">
            <main-menu></main-menu>
        </div>

        <div class="layout-global__lecteur" :class="playerClass">
            <player-normal></player-normal>
        </div>

        <div class="layout-global__playlist" :class="playlistClass">
            <player-playlist></player-playlist>
        </div>

        <div class="layout-global__main" :class="mainClass">
            <router-view></router-view>
        </div>

    </div>

</template>

<script>
import { mapState } from 'vuex';
import MainMenu from '~/components/Menu.vue';
import HeaderMobile from '~/components/menu/HeaderMobile.vue';
import PlayerNormal from '~/components/player/PlayerNormal.vue';
import PlayerPlaylist from '~/components/player/PlayerPlaylist.vue';

export default {
    components: {
        MainMenu,
        HeaderMobile,
        'player-normal': PlayerNormal,
        'player-playlist': PlayerPlaylist,
    },

    computed: {
        ...mapState('ui', [
            'isMenuOpen',
            'mainClass',
            'playerClass',
            'playlistClass',
        ])
    },
}
</script>
