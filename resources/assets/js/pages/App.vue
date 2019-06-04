<template>
    <div v-page-title="pageTitle">
        <b-modal ref="modal-must-register" :hide-header="true" footer-class="modal-must-register-footer">
            <b-button-close @click="closeMustRegisterModal"></b-button-close>

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

        <feedback-modal></feedback-modal>

        <b-alert show
                 dismissible
                 v-feature="'feedback'"
                 class="push"
                 variant="primary">
            <span class="a-curseur" @click="openFeedbackModal">
                <fa-icon aria-hidden="true" icon="fa-bug" label="Signaler un bug"/> Signaler un bug
            </span>
        </b-alert>

        <router-view></router-view>
    </div>
</template>

<script>
    import {mapGetters, mapState} from 'vuex';
    import api from "~/lib/api/site";
    import ticks from '~/lib/services/storage/ticks';
    import Storage from '~/lib/services/storage';
    import FeedbackModal from '~/components/Modal/FeedbackModal';
    import FaIcon from "~/components/Ui/Icon/FaIcon";

    export default {
        components: {
            FaIcon,
            FeedbackModal,
        },

        computed: {
            ...mapState('ui', [
                'pageTitle',
                'mustRegisterModalText',
            ]),

            ...mapGetters('auth', [
                'isAuthenticated',
            ]),
        },

        created() {
            this.loadCurrentTrack();
            this.loadLastSearchQueries();

            if (this.isAuthenticated) {
                this.loadLikes();
            }
        },

        mounted() {
            this.$store.subscribe((mutation) => {
                if (mutation.type === 'ui/setMustRegisterModal'
                    && mutation.payload === true
                ) {
                    this.$refs['modal-must-register'].show();
                }
            });
        },

        methods: {
            async loadCurrentTrack() {
                let currentTick;

                try {
                    currentTick = await ticks.current();
                } catch (e) {
                    return;
                }

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
                        saga: sagaResult,
                        track: trackResult.data,
                        seekPercentage: currentPercentage,
                    }
                );
            },

            loadLastSearchQueries() {
                let queries = Storage.get('search', []);

                if (!queries) {
                    return;
                }

                this.$store.commit('search/setQueries', queries);
            },

            async loadLikes() {
                // @todo ajouter un spinner sur l'avatar dans le menu
                // @todo le temps de charger les likes.

                try {
                    let res = await api.likes.all();

                    this.$store.dispatch('likes/setAll', res.data);
                } catch (e) {
                    this.$store.dispatch('auth/logout');
                }
            },

            closeMustRegisterModal() {
                // On ferme la modal avec un petit délai pour qu'elle se
                // ferme une fois sur la page de connexion ou inscription.
                setTimeout(
                    () => {
                        this.$refs['modal-must-register'].hide();
                    },
                    130
                );
            },

            openFeedbackModal() {
                this.$store.dispatch('ui/setFeedbackModalDefaultType', 'bug');
                this.$bvModal.show('js--modal-feedback');
            },
        },

        watch: {
            '$route': 'closeMustRegisterModal'
        },
    }
</script>
