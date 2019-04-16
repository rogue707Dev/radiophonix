<template>
    <div v-page-title="pageTitle">
        <router-view></router-view>
    </div>
</template>

<script>
    import { mapState, mapGetters } from 'vuex';
    import api from "~/lib/api/site";
    import ticks from '~/lib/services/storage/ticks';
    import storage from '~/lib/services/storage';

    export default {
        computed: {
            ...mapState('ui', [
                'pageTitle',
            ]),

            ...mapGetters('auth', [
                'isAuthenticated',
            ]),
        },
        created: function () {
            this.loadCurrentTrack();
            this.loadLastSearchQueries();

            if (this.isAuthenticated) {
                this.loadLikes();
            }
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

            async loadLikes() {
                let res = await api.likes.all();

                this.$store.dispatch('likes/setAll', res.data);
            },
        }
    }
</script>
