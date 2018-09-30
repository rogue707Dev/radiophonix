<template>
    <div v-page-title="pageTitle">
        <router-view></router-view>
    </div>
</template>

<script>
    import {mapState} from 'vuex';
    import api from '~/lib/api';
    import storage from '~/lib/services/storage';

    export default {
        computed: {
            ...mapState('ui', [
                'pageTitle',
            ]),
        },
        created: function () {
            this.loadCurrentTrack();
        },

        methods: {
            async loadCurrentTrack() {
                let currentTrackId = storage.get('currentTrackId');
                let currentSagaId = storage.get('currentSagaId');

                if (!currentTrackId || !currentSagaId) {
                    return;
                }

                let currentPercentage = storage.get('currentPercentage', 0);

                let sagaResult = api.sagas.get(currentSagaId);
                let trackResult = api.tracks.get(currentTrackId);

                [sagaResult, trackResult] = [await sagaResult, await trackResult];

                this.$store.dispatch(
                    'player/play',
                    {
                        autoStart: false,
                        saga: sagaResult.data,
                        track: trackResult.data,
                        seekPercentage: currentPercentage,
                    }
                );
            },
        }
    }
</script>

<style lang="sass">
    /////////////////////////////////////////////////////////////////////////////////
    // $ VARIABLE & MIXIN
    /////////////////////////////////////////////////////////////////////////////////
    @import "../../sass/variable/__index"
    @import "../../sass/function/__index"
    @import "../../sass/mixin/__index"

    /////////////////////////////////////////////////////////////////////////////////
    // $ OVERRIDE BOOTSTRAP
    /////////////////////////////////////////////////////////////////////////////////
    @import "../../sass/override-bootstrap"

    /////////////////////////////////////////////////////////////////////////////////
    // $ BOOTSTRAP
    /////////////////////////////////////////////////////////////////////////////////
    @import "~bootstrap/scss/bootstrap"

    /////////////////////////////////////////////////////////////////////////////////
    // $ FONT AWESOME
    /////////////////////////////////////////////////////////////////////////////////
    $fa-font-path: "~font-awesome/fonts"
    @import "~font-awesome/scss/font-awesome"

    /////////////////////////////////////////////////////////////////////////////////
    // $ RADIOPHONIX
    /////////////////////////////////////////////////////////////////////////////////
    @import "../../sass/app"
</style>
