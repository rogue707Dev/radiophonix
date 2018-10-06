<template>
    <div class="layout-header-mobile">

        <button class="btn-header-mobile var--menu" @click="toggleMenu" :class="{ 'var--actif': isMenuOpen}">
            <i class="fa" aria-hidden="true"
               :class="{ 'fa-close': isMenuOpen, 'fa-bars': !isMenuOpen }"></i>
            <span class="h6">Menu</span>
        </button>


        <svg width="150px" height="25px" class="fill--blanc mb-1">
            <use class="fill--logo-orange" xlink:href="#logo-part1of2"></use>
            <use xlink:href="#logo-part2of2"></use>
        </svg>


        <button class="btn-header-mobile var--aside" @click="togglePlayer" :class="{ 'var--actif': isPlayerOpen}">
            <template v-if="isPlayerOpen">
                <i class="fa fa-close" aria-hidden="true"></i>
            </template>
            <template v-else>
                <svg width="25px" height="25px" class="fill--blanc">
                    <use xlink:href="#radio"></use>
                </svg>
            </template>
        </button>

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
