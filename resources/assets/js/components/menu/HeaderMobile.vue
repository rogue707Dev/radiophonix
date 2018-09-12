<template>
    <div class="layout-header">

        <i class="fa" aria-hidden="true" @click="toggleMenu"
           :class="{ 'fa-close': isMenuOpen, 'fa-bars': !isMenuOpen }"></i>


        <svg width="150px" height="25px" class="fill--blanc">
            <use xlink:href="#logo-part1of2"></use>
            <use xlink:href="#logo-part2of2"></use>
        </svg>


        <!-- TODO : au clic
         Ajouter class "actif" a layout-global__lecteur et layout-global__playlist
         ajouter la class "inactif" à layout-global__main
         -->
        <i class="fa" aria-hidden="true"
           :class="{ 'fa-close': isPlayerOpen, 'fa-volume-up': !isPlayerOpen }"
           @click="togglePlayer"></i>
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
