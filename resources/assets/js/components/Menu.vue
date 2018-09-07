<template>
    <ul class="layout-conteneur__menu">
<!--
        <li class="layout-menu__item-log">
            <svg width="30px" height="30px">
                <use xlink:href="#login2"></use>
            </svg>
            Connexion
        </li>

        <menu-item name="home" route="home" icon="login2" class="layout-menu__item layout-menu__item-log2">
            Connexion
        </menu-item>
-->
        <menu-item name="login" route="login" icon="login2" class="layout-menu__item layout-menu__item-log3">
            Connexion
        </menu-item>
         <!--
        <menu-item name="home" route="home" icon="login2" class="layout-menu__item layout-menu__item-log4">
            Connexion
        </menu-item>
-->

        <menu-item name="home" route="home" icon="maison" class="layout-menu__item">
            Accueil
        </menu-item>
        <menu-item name="search" route="search" icon="rechercher" class="layout-menu__item">
            Rechercher
        </menu-item>
        <menu-item name="listen" route="listen.sagas.index" icon="play" class="layout-menu__item">
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
    import MenuItem from '~/components/menu/MenuItem.vue';

    export default {
        components: {
            MenuItem,
        }
    }
</script>
