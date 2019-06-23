<template>
    <div>

        <banner :title='profile.name'>

            <template slot="image">
                <cover
                        size="banniere"
                        type="auteur"
                        :urlImage="profile.avatar">
                </cover>
            </template>

            <div class="mt-3" v-if="isProfileOfCurrentUser">
                <router-link class="btn btn-outline-secondary btn-sm mb-2" :to="{ name: 'settings.profile' }">
                    <fa-icon icon="fa-cog" label="Éditer le profil" />
                    Éditer le profil
                </router-link>
            </div>
        </banner>

        <div class="container">

            <div class="row">
                <div class="col">
                    <h2 class="h1 mb-2">Badges</h2>

                    <div v-if="loading.profile">
                        <fa-icon icon="fa-spinner fa-spin fa-5x" label="Chargement" />
                    </div>

                    <div class="layout-badge mb-4">

                        <div class="cover var--petit var--badge layout-badge__item"
                             v-for="badge in profile.badges"
                             :id="'badge-popover-' + badge.key">
                            <b-popover :target="'badge-popover-' + badge.key"
                                       triggers="hover focus"
                                       placement="top"
                                       :title="badge.title">
                                <template slot="default">
                                    <template v-if="badge.isOwned">{{badge.description}}</template>
                                    <template v-else>
                                        <i>Vous n'avez pas encore obtenu ce badge.</i>
                                    </template>
                                </template>
                            </b-popover>

                            <svg><use xlink:href="#contour-badge"></use></svg>
                            <div class="cover__mask">
                                <img :class="{'var--actif': badge.isOwned}"
                                     :src="'/static/badge/' + badge.key + '.svg'"
                                     :alt="badge.title">
                            </div>
                        </div>

                    </div>

                </div>
            </div>



            <nav-list class="mb-2">
                <nav-item :active="tab === 'ticks'"
                          @click="tab = 'ticks'"
                          v-if="isProfileOfCurrentUser">
                    En cours
                </nav-item>
                <nav-item :active="tab === 'favorites'"
                          @click="tab = 'favorites'">
                    Favoris
                </nav-item>
            </nav-list>

            <div v-if="tab === 'ticks' && isProfileOfCurrentUser">
                <template v-if="loading.ticks">
                    <fa-icon icon="fa-spinner fa-spin fa-5x" label="Chargement" />
                </template>
                <template v-else>
                    <template v-if="ticks.length === 0">
                        Pas d'écoute en cours
                    </template>
                    <template v-else>
                        <div class="episode-item var--en-cours" v-for="tick in ticks">
                            <div class="episode-item__cover">
                                <div class="cover var--petit var--episode">
                                    <div class="cover__mask">
                                        <img :src="tick.saga.images.cover.thumb" :alt="tick.saga.name">
                                    </div>
                                </div>
                            </div>
                            <div class="episode-item__content align-content-center h-100 d-grid">
                                <div>
                                    {{ tick.saga.name }}&nbsp;•&nbsp;<span class="font-weight-bold">{{ tick.track.title }}</span>
                                    <div class="progression text-dark h5 mt-1">
                                        <track-length :seconds="tickCurrentSeconds(tick)"></track-length>
                                        <progress :value="tick.progress" max="100000" class="progression__barre"></progress>
                                        <track-length :seconds="tick.track.seconds" class="text-right"></track-length>
                                    </div>
                                </div>
                            </div>
                            <div class="episode-item__etat-lecture">
                                <button class="btn btn-sm btn-outline-secondary"
                                        @click="play({track: tick.track, saga: tick.saga, autoStart: true, seekPercentage: tick.progress / 1000})">
                                    <i aria-hidden="true" class="fa fa-play pr-1"></i><span>Écouter</span>
                                </button>
                            </div>
                            <div class="episode-item__download">
                                <a :href="tick.track.file" target="_blank" class="btn btn-outline-secondary btn-sm mr-xl-3">
                                    <i aria-hidden="true" class="fa fa-download"></i>Télécharger
                                </a>
                            </div>
                        </div>
                    </template>
                </template>
            </div>

            <div v-if="tab === 'favorites'">
                <template v-if="loading.likes">
                    <fa-icon icon="fa-spinner fa-spin fa-5x" label="Chargement" />
                </template>
                <template v-else>
                    <div v-if="!hasFavorites">
                        Pas de favoris
                    </div>
                    <div class="list-card-horizontal" v-if="likes">
                        <template v-if="likes.saga.length > 0">
                            <card-saga v-for="saga in likes.saga"
                                       :key="saga.id"
                                       :saga="saga"
                                       :badge="true"
                                       :horizontal="true"
                                       :with-author="false"></card-saga>
                        </template>
                    </div>
                </template>
            </div>

        </div>

    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex';
    import api from '~/lib/api';
    import Banner from '~/components/content/Banner.vue';
    import Cover from '~/components/content/Cover.vue';
    import TrackLength from "../../components/track/TrackLength";
    import NavList from '~/components/Ui/Nav/NavList';
    import NavItem from '~/components/Ui/Nav/NavItem';
    import CardSaga from '~/components/content/Card/CardSaga';
    import FaIcon from "~/components/Ui/Icon/FaIcon";

    export default {
        data: () => ({
            profile: {
                author: {},
                badges: [],
            },
            ticks: [],
            tab: '',
            likes: null,
            loading: {
                profile: false,
                ticks: false,
                likes: false,
            },
        }),

        components: {
            FaIcon,
            TrackLength,
            Banner,
            Cover,
            NavList,
            NavItem,
            CardSaga,
        },

        computed: {
            ...mapGetters('auth', [
                'isAuthenticated',
            ]),

            isProfileOfCurrentUser() {
                if (!this.isAuthenticated) {
                    return false;
                }

                if (!this.$store.state.auth.user) {
                    return false;
                }

                if (!this.$store.state.auth.user.name) {
                    return false;
                }

                return this.$store.state.auth.user.name === this.$route.params.user;
            },

            hasFavorites() {
                if (!this.likes) {
                    return false;
                }

                if (!this.likes.saga) {
                    return false;
                }

                return this.likes.saga.length > 0;
            },
        },

        methods: {
            ...mapActions('player', [
                'play'
            ]),

            async loadProfile() {
                try {
                    this.loading.profile = true;

                    let result = await api.profile.get(this.$route.params.user);
                    this.profile = result.data;

                    this.loading.profile = false;
                } catch (e) {
                    this.$router.push({
                        name: '404',
                    });
                }
            },

            async loadLikes() {
                this.loading.likes = true;

                let result = await api.profile.likes(this.$route.params.user);
                this.likes = result.data;

                this.loading.likes = false;
            },

            async loadTicks() {
                this.loading.ticks = true;

                let result = await api.ticks.all();

                this.ticks = result.data;

                this.loading.ticks = false;
            },

            tickCurrentSeconds(tick) {
                return Math.floor(tick.track.seconds * tick.progress / 100000);
            },

            initComponent() {
                this.loadProfile();
                this.loadLikes();

                if (this.isProfileOfCurrentUser) {
                    this.tab = 'ticks';

                    this.loadTicks();
                } else {
                    this.tab = 'favorites';
                }
            }
        },

        created() {
            this.initComponent();
        },

        watch: {
            '$route': 'initComponent',
        }
    }
</script>
