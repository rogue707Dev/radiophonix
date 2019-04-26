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
                <button class="btn btn-outline-secondary btn-sm mb-2">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    Éditer le profil
                </button>
            </div>
        </banner>

        <div class="container">

            <h2 class="h1 mb-2">Badge</h2>

            <div class="layout-badge">

                <div class="cover var--petit var--badge layout-badge__item"
                     v-for="badge in profile.badges"
                     :id="'badge-popover-' + badge.key">
                    <b-popover :target="'badge-popover-' + badge.key"
                               triggers="hover focus"
                               placement="top"
                               :title="badge.title"
                                :content="badge.description"></b-popover>

                    <div class="cover__mask">
                        <img src="https://dev.radiophonix.org/storage/1930664737/conversions/zylann-thumb.jpg" alt="Zylann">
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
            </div>

            <div v-if="tab === 'favorites'">
                Todo...
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

    export default {
        data: () => ({
            profile: {
                author: {},
                badges: [],
            },
            ticks: [],
            tab: '',
        }),

        components: {
            TrackLength,
            Banner,
            Cover,
            NavList,
            NavItem,
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
        },

        methods: {
            ...mapActions('player', [
                'play'
            ]),

            async loadProfile() {
                try {
                    let result = await api.profile.get(this.$route.params.user);
                    this.profile = result.data;
                } catch (e) {
                    this.$router.push({
                        name: '404',
                    });
                }
            },

            async loadTicks() {
                let result = await api.ticks.all();

                this.ticks = result.data;
            },

            tickCurrentSeconds(tick) {
                return Math.floor(tick.track.seconds * tick.progress / 100000);
            },
        },

        created() {
            this.loadProfile();

            if (this.isProfileOfCurrentUser) {
                this.tab = 'ticks';

                this.loadTicks();
            } else {
                this.tab = 'favorites';
            }
        },
    }
</script>
