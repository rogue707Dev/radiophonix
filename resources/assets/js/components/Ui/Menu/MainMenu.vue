<template>
    <ul class="layout-conteneur__menu">
<!--
        <li class="layout-menu__item-log">
            <svg width="30px" height="30px">
                <use xlink:href="#login2"></use>
            </svg>
            Connexion
        </li>

        <main-menu-item name="home" route="home" icon="login2" class="layout-menu__item layout-menu__item-log2">
            Connexion
        </main-menu-item>
-->
        <main-menu-item name="login"
                        route="login"
                        icon="login2"
                        class="layout-menu__item layout-menu__item-log3"
                        v-feature="'login'">
            Connexion
        </main-menu-item>
         <!--
        <main-menu-item name="home" route="home" icon="login2" class="layout-menu__item layout-menu__item-log4">
            Connexion
        </main-menu-item>
-->

        <main-menu-item name="home" route="home" icon="maison" class="layout-menu__item">
            Accueil
        </main-menu-item>
        <main-menu-item name="search" route="search" icon="rechercher" class="layout-menu__item">
            Rechercher
        </main-menu-item>
        <main-menu-item name="listen" route="listen.home" icon="play" class="layout-menu__item">
            Écouter
        </main-menu-item>
        <main-menu-item name="publish" route="publish" icon="edit" class="layout-menu__item">
            Publier
        </main-menu-item>
        <main-menu-item name="contribute" route="contribute" icon="contribuer" class="layout-menu__item">
            Contribuer
        </main-menu-item>
        <main-menu-item name="help" route="help" icon="info" class="layout-menu__item">
            Aide
        </main-menu-item>
        <main-menu-item name="news"
                        route="news"
                        icon="puzzle"
                        class="layout-menu__item"
                        :class="{'var--nouveau': hasUnreadNews}">
            Nouveautés
            <i class="fa fa-circle" v-if="hasUnreadNews"></i>
        </main-menu-item>
    </ul>
</template>

<script>
    import { mapState } from 'vuex';
    import MainMenuItem from '~/components/Ui/Menu/MainMenuItem';
    import news from '~/lib/services/storage/news';

    export default {
        components: {
            MainMenuItem,
        },

        computed: {
            ...mapState('ui', [
                'hasUnreadNews',
            ]),
        },

        mounted() {
            news.loadLastRead();
        }
    }
</script>
