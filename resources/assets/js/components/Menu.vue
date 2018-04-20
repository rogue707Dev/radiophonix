<template>
    <ul class="layout-conteneur__menu">
<!--
        <li class="layout-menu__item-log">
            <svg width="30px" height="30px">
                <use xlink:href="#login2"></use>
            </svg>
            Connexion
        </li>

        <rp-menu-item name="home" route="home" icon="login2" class="layout-menu__item layout-menu__item-log2">
            Connexion
        </rp-menu-item>
-->
        <rp-menu-item name="home" route="home" icon="login2" class="layout-menu__item layout-menu__item-log3">
            Connexion
        </rp-menu-item>
         <!--
        <rp-menu-item name="home" route="home" icon="login2" class="layout-menu__item layout-menu__item-log4">
            Connexion
        </rp-menu-item>
-->

        <rp-menu-item name="home" route="home" icon="maison" class="layout-menu__item">
            Accueil
        </rp-menu-item>
        <rp-menu-item name="search" route="search" icon="rechercher" class="layout-menu__item">
            Rechercher
        </rp-menu-item>
        <rp-menu-item name="listen" route="listen.sagas.index" icon="play" class="layout-menu__item">
            Écouter
        </rp-menu-item>
        <rp-menu-item name="publish" route="publish" icon="edit" class="layout-menu__item">
            Publier
        </rp-menu-item>
        <rp-menu-item name="contribute" route="contribute" icon="contribuer" class="layout-menu__item">
            Contribuer
        </rp-menu-item>
        <rp-menu-item name="help" route="help" icon="info" class="layout-menu__item">
            Aide
        </rp-menu-item>
    </ul>
</template>
