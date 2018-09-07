<template>
    <div class="layout-header">

        <i class="fa" aria-hidden="true" @click="toggleMenu"
           :class="{ 'fa-close': isMenuOpen, 'fa-bars': !isMenuOpen }"></i>

        <div class="fill--blanc">
            <svg width="150px" height="25px">
                <use xlink:href="#logo"/>
            </svg>
        </div>

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

        data() {
            return {
                isPlayerOpen: false,
            };
        },

        computed: mapState('ui', [
            'isMenuOpen'
        ]),

        methods: {
            ...mapActions('ui', [
                'toggleMenu',
            ]),

            togglePlayer() {
                if (this.isPlayerOpen) {
                    // Fermeture du player
                    this.$store.dispatch('ui/closePlayer');
                    this.$store.dispatch('ui/closePlaylist');
                    this.$store.dispatch('ui/openMain');
                } else {
                    // Ouverture du player
                    this.$store.dispatch('ui/openPlayer');
                    this.$store.dispatch('ui/closeMain');
                }

                this.isPlayerOpen = !this.isPlayerOpen;
            }
        }
    }
</script>
