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

        <div class="layout-global__playlist" :class="classes">
            <player-playlist></player-playlist>
        </div>

        <div class="layout-global__main" :class="mainClass">
            <slot></slot>
        </div>

        <div class="layout-global__lecteur-footer">
            <player-footer></player-footer>
        </div>

    </div>

</template>

<script>
    import { mapState } from 'vuex';
    import MainMenu from '~/components/Ui/Menu/MainMenu';
    import HeaderMobile from '~/components/menu/HeaderMobile.vue';
    import PlayerNormal from '~/components/player/PlayerNormal.vue';
    import PlayerPlaylist from '~/components/player/PlayerPlaylist.vue';
    import PlayerFooter from '~/components/player/PlayerFooter.vue';

    export default {
        components: {
            MainMenu,
            HeaderMobile,
            PlayerNormal,
            PlayerPlaylist,
            PlayerFooter,
        },

        computed: {
            ...mapState('ui', [
                'isMenuOpen',
                'mainClass',
                'playerClass',
            ]),

            classes() {
                let classes = this.$store.state.ui.playlistClasses;

                classes['var--inactif'] = !this.$store.state.player.currentSaga.id;

                return classes;
            }
        },
    }
</script>
