<template>
    <ul class="menu">
        <!--Afficher si connecter-->
        <li class="menu__item var--logout" v-feature="'login'">
            <img class="menu__item__avatar" alt="" src="/static/home/avatar-defaut.png">
            <div class="menu__nivo2">
                <a href="#profil" class="menu__nivo2__img">
                    <div class="cover var--petit var--auteur">
                        <div class="cover__mask">
                            <img src="/static/home/avatar-defaut.png">
                        </div>
                    </div>
                </a>
                <div class="menu__nivo2__lien">
                    <a href="#profil" class="menu__nivo2__lien__profil">
                        <i aria-hidden="true" class="fa fa-user"></i> Profil
                    </a>
                    <a href="#deco">
                        <i aria-hidden="true" class="fa fa-lock"></i> Deconnexion
                    </a>
                </div>
            </div>
        </li>
        <!--Afficher si non déconnecter-->
        <main-menu-item name="login" route="login" class="menu__item var--sans-icon" v-feature="'login'">
            Connexion
        </main-menu-item>
        <main-menu-item name="register" route="register" class="menu__item var--sans-icon" v-feature="'login'">
            Inscription
        </main-menu-item>
        <main-menu-item name="home" route="home" icon="maison" class="menu__item">
            Accueil
        </main-menu-item>
        <main-menu-item name="search" route="search" icon="rechercher" class="menu__item">
            Rechercher
        </main-menu-item>
        <main-menu-item name="listen" route="listen.home" icon="play" class="menu__item">
            Écouter
        </main-menu-item>
        <main-menu-item name="publish" route="publish" icon="edit" class="menu__item">
            Publier
        </main-menu-item>
        <main-menu-item name="help" route="help" icon="info" class="menu__item">
            FAQ
        </main-menu-item>
        <main-menu-item name="news"
                        route="news"
                        icon="puzzle"
                        class="menu__item"
                        :class="{'var--nouveau': hasUnreadNews}">
            Nouveautés
            <i class="fa fa-circle" v-if="hasUnreadNews"></i>
        </main-menu-item>
        <main-menu-item name="roadmap" route="roadmap" icon="directions" class="menu__item">
            Roadmap
        </main-menu-item>
        <main-menu-item name="contribute" route="contribute" icon="contribuer" class="menu__item">
            Contribuer
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
