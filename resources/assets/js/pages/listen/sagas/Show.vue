<template>
    <div>

        <banner
            :title="saga.name"
            type="saga">

            <template slot="subtitle">
                <router-link v-if="saga.authors[0].id"
                             :to="{ name: 'listen.authors.show', params: { id: saga.authors[0].slug } }">
                    {{ saga.authors[0].name }}
                </router-link>
                <router-link v-if="saga.team"
                             :to="{ name: 'listen.teams.show', params: { id: saga.team.slug } }">
                    ({{ saga.team.name }})
                </router-link>
            </template>

            <template slot="image">
                <cover
                        size="banniere"
                        type="saga"
                        :urlImage="saga.images.cover.main"
                        :altImage="saga.name">
                </cover>
                <div class="fitre--bleu"></div>
                <button class="pa-centrer btn btn-outline-theme btn-round btn-lg" @click="playSaga">
                    <i aria-hidden="true" class="fa fa-play"></i>
                </button>
            </template>

            <div class="btn-toolbar mt-3 justify-content-center justify-content-md-start">
                <div class="statistic-container btn-group btn-group-sm mb-2 mr-2">
                    <button type="button" class="btn btn-outline-secondary disabled">
                        {{ saga.stats.likes }} <i aria-hidden="true" class="fa fa-heart"></i>
                    </button>
                </div>
                <div class="statistic-container btn-group btn-group-sm mb-2 mr-2">
                    <template v-if="saga.stats.collections == 1">
                        <button type="button" class="btn btn-outline-secondary disabled">
                            {{ saga.stats.tracks }} épisodes
                        </button>
                    </template>
                    <template v-else>
                        <button type="button" class="btn btn-outline-secondary disabled">
                            {{ saga.stats.collections }} saisons
                        </button>
                        <button type="button" class="btn btn-outline-secondary disabled">
                            {{ saga.stats.tracks }} épisodes
                        </button>
                    </template>
                </div>
                <div class="statistic-container btn-group btn-group-sm mb-2 mr-2">
                    <router-link tag="button"
                                 class="btn btn-outline-primary"
                                 v-if="genre"
                                 :to="{ name: 'listen.genres.show', params: { id: genre.slug } }">
                        {{ genre.name }}
                    </router-link>
                </div>
                <div class="statistic-container btn-group btn-group-sm mb-2" v-if="saga.finished">
                    <button type="button" class="btn btn-outline-secondary disabled">
                        Terminée
                    </button>
                </div>
            </div>

            <div v-if="saga.licence">
                <a :href="licenceUrl" class="skin-icon-cc">
                    <licence-icon :licence="saga.licence"></licence-icon>
                </a>
            </div>

        </banner>

        <div class="container">

            <div class="row">
                <div class="col-md-6">
                    <h2 class="h1 mb-4">Synopsis</h2>
                    <p class="text-primary"><i aria-hidden="true" class="fa fa-calendar"></i>
                        {{ saga.creation_date | formatDate }}</p>
                    <p class="mb-3">{{ saga.synopsis }}</p>
                    <a class="btn btn-outline-secondary btn-sm mb-2" :href="saga.links.site" v-if="saga.links.site">
                        <i aria-hidden="true" class="fa fa-globe"></i>&nbsp;Site officiel
                    </a>
                    <a class="btn btn-outline-secondary btn-sm mb-2" :href="saga.links.facebook" title="Facebook" v-if="saga.links.facebook">
                        <i aria-hidden="true" class="fa fa-facebook"></i> Facebook
                    </a>
                    <a class="btn btn-outline-secondary btn-sm mb-2" :href="saga.links.twitter" title="Twitter" v-if="saga.links.twitter">
                        <i aria-hidden="true" class="fa fa-twitter"></i> Twitter
                    </a>
                    <a class="btn btn-outline-secondary btn-sm mb-2" :href="saga.links.netowiki" v-if="saga.links.netowiki">
                        <i aria-hidden="true" class="fa fa-globe"></i>&nbsp;Netowiki
                    </a>
                    <a class="btn btn-outline-secondary btn-sm mb-2" :href="saga.links.topic" v-if="saga.links.topic">
                        <i aria-hidden="true" class="fa fa-globe"></i>&nbsp;Netophonix
                    </a>
                    <a class="btn btn-outline-secondary btn-sm mb-2" :href="saga.links.rss" v-if="saga.links.rss">
                        <i aria-hidden="true" class="fa fa-rss"></i>&nbsp;Flux RSS
                    </a>
                </div>
                <div class="col-md-6">

                    <h2 class="h1 mb-4">Faiseur</h2>



                    <div class="d-flex flex-row">
                        <div>
                            <router-link v-if="saga.authors[0].id"
                                         :to="{ name: 'listen.authors.show', params: { id: saga.authors[0].slug } }">
                                <cover
                                        size="petit"
                                        type="faiseur"
                                        :urlImage="saga.authors[0].picture.thumb"
                                        :altImage="saga.authors[0].name">
                                </cover>
                            </router-link>
                        </div>
                        <div>
                            <p>
                                <router-link v-if="saga.authors[0].id"
                                             :to="{ name: 'listen.authors.show', params: { id: saga.authors[0].slug } }"
                                             class="text-primary">
                                    {{ saga.authors[0].name }}
                                </router-link>
                                <router-link v-if="saga.team"
                                             :to="{ name: 'listen.teams.show', params: { id: saga.team.slug } }">
                                    (<span class="text-primary">{{ saga.team.name }}</span>)
                                </router-link>
                            </p>
                            <p v-if="saga.authors[0].id">
                                <text-ellipsis :text="saga.authors[0].bio" :size="200"></text-ellipsis>
                            </p>
                            <router-link v-if="saga.authors[0].id"
                                         :to="{ name: 'listen.authors.show', params: { id: saga.authors[0].slug } }"
                                         class="btn btn-outline-primary btn-sm my-3">
                                Voir la biographie
                            </router-link>

                            <a class="btn btn-outline-secondary btn-sm mb-2" :href="saga.authors[0].links.site" v-if="saga.authors[0].links.site">
                                <i aria-hidden="true" class="fa fa-globe"></i>&nbsp;Site officiel
                            </a>
                            <a class="btn btn-outline-secondary btn-sm mb-2" :href="saga.authors[0].links.facebook" title="Facebook" v-if="saga.authors[0].links.facebook">
                                <i aria-hidden="true" class="fa fa-facebook"></i> Facebook
                            </a>
                            <a class="btn btn-outline-secondary btn-sm mb-2" :href="saga.authors[0].links.twitter" title="Twitter" v-if="saga.authors[0].links.twitter">
                                <i aria-hidden="true" class="fa fa-twitter"></i> Twitter
                            </a>
                            <a class="btn btn-outline-secondary btn-sm mb-2" :href="saga.authors[0].links.netowiki" v-if="saga.authors[0].links.netowiki">
                                <i aria-hidden="true" class="fa fa-globe"></i>&nbsp;Netowiki
                            </a>
                            <a class="btn btn-outline-secondary btn-sm mb-2" :href="saga.authors[0].links.topic" v-if="saga.authors[0].links.topic">
                                <i aria-hidden="true" class="fa fa-globe"></i>&nbsp;Netophonix
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <nav-list v-if="collections.length > 1">
                        <nav-item v-for="(collections, type, index) in collectionTypes"
                                  :key="index"
                                  :active="currentCollectionType === type"
                                  @click="currentCollectionType = type">
                            <collection-type :type="type"/>
                        </nav-item>
                    </nav-list>
                    <nav-list v-else>
                        <nav-item :active="true">Épisodes</nav-item>
                    </nav-list>
                </div>
                <div class="col-12 mb-5"
                     v-for="collection in collectionTypes[currentCollectionType]"
                     :key="collection.id">
                        <h3 class="h3 mb-2 mt-3"
                            v-if="collections.length > 1">
                            {{ collection.name }}
                        </h3>

                        <div class="episode-item"
                             @click="play({track, saga, autoStart: true})"
                             :class="{'actif': track.id == currentTrack.id}"
                             v-for="track in collection.tracks" :key="track.id">
                            <div class="ml-3 text-right" v-html="formatTrackNumber(track.number)"></div>
                            <div>
                                <span class="font-weight-bold">{{ track.title }}</span>
                                <p>{{ track.synopsis }}</p>
                            </div>
                            <span class="episode-item--temps text-primary">
                                <i aria-hidden="true" class="fa fa-clock-o"></i>
                                <track-length :seconds="track.seconds"></track-length>
                            </span>
                            <div class="mr-lg-3">
                                <div v-if="track.id == currentTrack.id" class="skin-icon-fa__cercle text-primary">
                                    <i aria-hidden="true" class="fa fa-spin fa-refresh" v-if="isLoading"></i>
                                    <i aria-hidden="true" class="fa fa-volume-up" v-else></i>
                                </div>
                                <div v-else class="skin-icon-fa__cercle">
                                    <i aria-hidden="true" class="fa fa-play"></i>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
import { mapActions, mapState } from 'vuex';
import api from '~/lib/api';
import { licenceUrl } from '~/lib/services/licence';
import ticks from '~/lib/services/storage/ticks';
import TrackLength from '~/components/track/TrackLength.vue';
import Banner from '~/components/content/Banner.vue';
import LicenceIcon from '~/components/licence/LicenceIcon.vue';
import TextEllipsis from '~/components/text/TextEllipsis.vue';
import CollectionType from '~/components/collection/CollectionType';
import NavList from '~/components/Ui/Nav/NavList';
import NavItem from '~/components/Ui/Nav/NavItem';
import Cover from '~/components/content/Cover.vue';

export default {
    components: {
        TrackLength,
        Banner,
        LicenceIcon,
        TextEllipsis,
        CollectionType,
        NavList,
        NavItem,
        Cover,
    },

    data: () => ({
        saga: {
            stats: {},
            links: {},
            authors: [
                {
                    name: '',
                    links: {},
                    picture: {},
                    bio: '',
                },
            ],
            images: {
                cover: {}
            },
            genres: [],
        },
        collections: [],
        currentCollectionType: null,
    }),

    computed: {
        ...mapState('player', [
            'currentTrack',
            'isLoading',
        ]),

        genre() {
            if (!this.saga.genres) {
                return null;
            }

            return this.saga.genres[0] || null;
        },

        licenceUrl() {
            if (!this.saga.licence) {
                return null;
            }

            return licenceUrl(this.saga.licence);
        },

        collectionTypes() {
            let collections = {};

            for (const collection of this.collections) {
                collections[collection.type] = collections[collection.type] || [];

                collections[collection.type].push(collection);
            }

            return collections;
        }
    },

    methods: {
        ...mapActions('player', [
            'play'
        ]),

        async fetchData() {
            let sagaResult = api.sagas.get(this.$route.params.idOrSlug);
            let collectionResult = api.collections.all(this.$route.params.idOrSlug);

            [sagaResult, collectionResult] = [await sagaResult, await collectionResult];

            this.saga = sagaResult.data;
            this.collections = collectionResult.data;

            if (this.collections.length > 0) {
                this.currentCollectionType = this.collections[0].type;
            }
        },

        playSaga() {
            let tick = ticks.get(this.saga.id);
            let track = {};
            let percentage = 0;

            if (tick) {
                for (const collectionKey in this.collections) {
                    if (!this.collections.hasOwnProperty(collectionKey)) {
                        continue;
                    }

                    const tracks = this.collections[collectionKey].tracks || [];

                    for (const trackKey in tracks) {
                        if (!tracks.hasOwnProperty(trackKey)) {
                            continue;
                        }

                        const trackItem = tracks[trackKey];

                        if (trackItem.id == tick.track) {
                            track = trackItem;
                            break;
                        }
                    }
                }

                percentage = tick.percentage;
            } else {
                track = this.collections[0].tracks[0];
            }

            this.play({
                autoStart: true,
                saga: this.saga,
                track: track,
                seekPercentage: percentage,
            });
        },

        formatTrackNumber(trackNumber) {
            return trackNumber.replace(/\s/g, '&nbsp;');
        }
    },

    created: function () {
        this.fetchData();
    },

    watch: {
        '$route': 'fetchData'
    }
}
</script>
