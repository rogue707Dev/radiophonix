<template>
    <div class="header-mobile">

        <button class="btn-navigation var--menu" @click="toggleMenu" :class="{ 'var--actif': isMenuOpen}">
            <svg class="burger" viewBox="0 0 30 22" width="30" :class="{ 'var--actif': isMenuOpen}">
                <path
                        class="burger__line burger__top"
                        d="M24.5,3.1h-19c0,0-4-0.1-4,4s4,4,4,4H15V1.6" />
                <path
                        class="burger__line burger__middle"
                        d="M24.5,11.2h-19" />
                <path
                        class="burger__line burger__bottom"
                        d="M5.5,19.3h19c0,0,4,0.1,4-4s-4-4-4-4H15v9.5" />
            </svg>
            <span class="h6">Menu</span>
        </button>

        <router-link :to="{ name: 'home' }">
            <svg width="150px" height="25px" class="fill--blanc mb-1">
                <use xlink:href="#logo-part2of2"></use>
                <use class="fill--logo-orange" xlink:href="#logo-part1of2"></use>
            </svg>
        </router-link>

    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex';

    export default {
        computed: mapState('ui', [
            'isMenuOpen',
            'isPlayerOpen',
        ]),

        methods: {
            ...mapActions('ui', [
                'toggleMenu',
                'togglePlayer',
            ]),
        }
    }
</script>
