<template>
    <ul class="layout-conteneur__menu">
        <menu-item name="login"
                        route="login"
                        icon="login2"
                        class="layout-menu__item layout-menu__item-log3"
                        v-feature="'login'">
            Connexion
        </menu-item>
        <menu-item name="home" route="home" icon="maison" class="layout-menu__item">
            Accueil
        </menu-item>
        <menu-item name="search" route="search" icon="rechercher" class="layout-menu__item">
            Rechercher
        </menu-item>
        <menu-item name="listen" route="listen.home" icon="play" class="layout-menu__item">
            Écouter
        </menu-item>
        <menu-item name="publish" route="publish" icon="edit" class="layout-menu__item">
            Publier
        </menu-item>
        <menu-item name="contribute" route="contribute" icon="contribuer" class="layout-menu__item">
            Contribuer
        </menu-item>
        <menu-item name="help" route="help" icon="info" class="layout-menu__item">
            Aide
        </menu-item>
    </ul>
</template>

<script>
    import MenuItem from '~/components/Ui/Menu/MenuItem';

    export default {
        components: {
            MenuItem,
        }
    }
</script>
