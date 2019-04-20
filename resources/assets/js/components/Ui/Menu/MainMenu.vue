<template>
    <ul class="menu">
        <li class="menu__item var--profil"
            :class="{actif: $route.meta.menu === 'profile'}"
            v-feature="'login'"
            v-if="isAuthenticated && user">
            <router-link :to="{ name: 'profile', params: { user: user.name } }" class="menu__item--profil__avatar">
                <div class="cover var--petit var--auteur">
                    <div class="cover__mask">
                        <img alt="Avatar" :src="user.avatar" />
                    </div>
                </div>
            </router-link>
            <div class="menu__nivo2">
                <router-link :to="{ name: 'profile', params: { user: user.name } }" class="menu__nivo2__profil">
                    <i aria-hidden="true" class="fa fa-user"></i> Profil
                </router-link>
                <button @click="logout" class="menu__nivo2__deconnexion">
                    <i aria-hidden="true" class="fa fa-lock"></i> Déconnexion
                </button>
            </div>
        </li>
        <template v-else>
            <main-menu-item name="login" route="login" class="menu__item var--sans-icon" v-feature="'login'">
                Connexion
            </main-menu-item>
            <main-menu-item name="register" route="register" class="menu__item var--sans-icon" v-feature="'login'">
                Inscription
            </main-menu-item>
        </template>
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
        <main-menu-item name="contribute" route="contribute" icon="contribuer" class="menu__item">
            Contribuer
        </main-menu-item>
    </ul>
</template>

<script>
    import { mapState, mapGetters } from 'vuex';
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

            ...mapGetters('auth', [
                'isAuthenticated',
            ]),

            ...mapState('auth', [
                'user',
            ]),
        },

        mounted() {
            news.loadLastRead();
        },

        methods: {
            logout() {
                this.$store.dispatch('auth/logout');
                this.$router.push({name: 'home'});
            },
        },
    }
</script>
