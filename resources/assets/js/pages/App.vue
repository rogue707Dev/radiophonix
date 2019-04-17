<template>
    <div v-page-title="pageTitle">
        <b-modal ref="modal-must-register" :hide-header="true" footer-class="modal-must-register-footer">
            <h2 class="text-center display-4 mb-4 mt-4">S'inscrire sur Radiophonix</h2>
            <div class="text-center mb-3">
                <p class="mb-4">
                    {{ mustRegisterModalText }}
                </p>

                <router-link :to="{ name: 'register' }" class="btn btn-primary">
                    Inscription
                </router-link>
            </div>

            <template slot="modal-footer">
                <div>
                    Vous avez déjà un compte ?
                    <router-link :to="{ name: 'login' }" class="lien-paragraphe">
                        Connexion
                    </router-link>
                </div>
            </template>
        </b-modal>

        <router-view></router-view>
    </div>
</template>

<script>
    import {mapGetters, mapState} from 'vuex';
    import api from "~/lib/api/site";
    import ticks from '~/lib/services/storage/ticks';
    import storage from '~/lib/services/storage';

    export default {
        computed: {
            ...mapState('ui', [
                'pageTitle',
                'mustRegisterModalText',
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

        mounted() {
            this.$store.subscribe((mutation, state) => {
                if (mutation.type === 'ui/setMustRegisterModal'
                    && mutation.payload === true
                ) {
                    this.$refs['modal-must-register'].show();
                }
            });
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
