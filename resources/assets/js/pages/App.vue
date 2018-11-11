<template>
    <div v-page-title="pageTitle">
        <router-view></router-view>
    </div>
</template>

<script>
    import {mapState} from 'vuex';
    import api from '~/lib/api';
    import ticks from '~/lib/services/storage/ticks';
    import storage from '~/lib/services/storage';

    export default {
        computed: {
            ...mapState('ui', [
                'pageTitle',
            ]),
        },
        created: function () {
            this.loadCurrentTrack();
            this.loadLastSearchQueries();
        },

        methods: {
            async loadCurrentTrack() {
                let currentTick = await ticks.current();

                if (!currentTick) {
                    return;
                }

                let currentTrackId = currentTick.track;
                let currentSagaId = currentTick.saga;

                if (!currentTrackId || !currentSagaId) {
                    return;
                }

                let currentPercentage = currentTick.percentage;

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

            loadLastSearchQueries() {
                let queries = storage.get('search', []);

                if (!queries) {
                    return;
                }

                this.$store.commit('search/setQueries', queries);
            },
        }
    }
</script>
