<template>
    <ul class="layout-conteneur__menu">
        <!--Afficher si connecter-->
        <li class="layout-menu__item var--logout" v-feature="'login'">
            <img class="layout-menu__item__avatar" alt="" src="/static/home/avatar-defaut.png">
            <div class="layout-menu__navigation">
                <a href="#profil" class="layout-menu__navigation__img">
                    <div class="cover var--petit var--faiseur">
                        <div class="cover__mask">
                            <img src="/static/home/avatar-defaut.png">
                        </div>
                    </div>
                </a>
                <div class="layout-menu__navigation__lien">
                    <a href="#profil" class="layout-menu__navigation__lien__profil">
                        <i aria-hidden="true" class="fa fa-user"></i> Profil
                    </a>
                    <a href="#deco">
                        <i aria-hidden="true" class="fa fa-lock"></i> Deconnexion
                    </a>
                </div>
            </div>
        </li>
        <!--Afficher si non déconnecter-->
        <main-menu-item name="login"
                        route="login"
                        icon="login"
                        class="layout-menu__item var--login"
                        v-feature="'login'">
            Connexion
        </main-menu-item>
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
