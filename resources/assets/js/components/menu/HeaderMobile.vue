<template>
    <div class="layout-header">

        <i class="fa" aria-hidden="true" @click="toggle"
           :class="{ 'fa-close': isMenuOpen, 'fa-bars': !isMenuOpen }"></i>

        <div class="fill--blanc">
            <svg width="150px" height="25px">
                <use xlink:href="#logo"/>
            </svg>
        </div>

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

        computed: mapState('menu', [
            'isMenuOpen'
        ]),

        methods: {
            ...mapActions('menu', [
                'toggle',
            ]),

            togglePlayer() {
                if (this.isPlayerOpen) {
                    this.$router.back();
                } else {
                    this.$router.push({ name: 'listen.sagas.index' });
                }

                this.isPlayerOpen = !this.isPlayerOpen;
            }
        }
    }
</script>
