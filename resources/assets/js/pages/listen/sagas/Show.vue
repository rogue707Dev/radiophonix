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
                <span v-if="saga.team">
                    &bull;
                    <router-link :to="{ name: 'listen.teams.show', params: { id: saga.team.slug } }">
                        {{ saga.team.name }}
                    </router-link>
                </span>
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

            <ul class="banniere__zone-contenu__bande">
                <li class="banniere__zone-contenu__bande__item">
                    {{ saga.stats.likes }} <i aria-hidden="true" class="fa fa-heart"></i>
                </li>
                <template v-if="saga.stats.collections == 1">
                    <li class="banniere__zone-contenu__bande__item">
                        {{ saga.stats.tracks }} épisodes
                    </li>
                </template>
                <template v-else>
                    <li class="banniere__zone-contenu__bande__item">
                        {{ saga.stats.collections }} saisons
                    </li>
                    <li class="banniere__zone-contenu__bande__item">
                        {{ saga.stats.tracks }} épisodes
                    </li>
                </template>
                <li class="banniere__zone-contenu__bande__item"
                    v-b-tooltip.hover.top title="Date de création">
                    <i aria-hidden="true" class="fa fa-calendar"></i> {{ saga.creation_date | formatDate }}
                </li>
                <li class="banniere__zone-contenu__bande__item" v-if="saga.finished">
                    Saga terminée
                </li>
                <li class="banniere__zone-contenu__bande__item"
                    v-b-tooltip.hover.top title="Genre">
                    <router-link tag="a"
                                 class="text-primary"
                                 v-if="genre"
                                 :to="{ name: 'listen.genres.show', params: { id: genre.slug } }">
                        {{ genre.name }}
                    </router-link>
                </li>
            </ul>

            <div class="mt-3">
                <licence-link :licence="saga.licence"
                              class="btn btn-outline-secondary btn-sm mb-2"
                              v-if="saga.licence" />
                <a class="btn btn-outline-secondary btn-sm mb-2" :href="saga.links.rss" v-if="saga.links.rss">
                    <i aria-hidden="true" class="fa fa-rss"></i>&nbsp;Flux RSS
                </a>
                <button class="btn btn-outline-secondary btn-sm mb-2"
                        v-if="currentTick"
                        @click="playSaga">
                    <i class="fa fa-play" aria-hidden="true"></i>
                    Reprendre la lecture
                </button>
            </div>

        </banner>

        <div class="container">

            <div class="row">
                <div class="col-md-6">
                    <h2 class="h1 mb-2">Synopsis</h2>
                    <blockquote class="blockquote">
                        <p>{{ saga.synopsis }}</p>
                        <footer class="blockquote-footer">
                            <a
                                class="lien-paragraphe"
                                title="Encyclopédie communautaire sur les sagas MP3"
                                :href="saga.links.netowiki"
                                v-b-tooltip.hover.top
                                v-if="saga.links.netowiki">
                                Netowiki
                            </a>
                        </footer>
                    </blockquote>

                    <h2 class="h1 mt-4 mb-2" v-if="saga.links">Liens officiels</h2>
                    <a class="btn btn-outline-secondary btn-sm mb-2" :href="saga.links.site" v-if="saga.links.site">
                        <i aria-hidden="true" class="fa fa-globe"></i>&nbsp&nbsp;Site web
                    </a>
                    <a class="btn btn-outline-secondary btn-sm mb-2" :href="saga.links.facebook" title="Facebook" v-if="saga.links.facebook">
                        <i aria-hidden="true" class="fa fa-facebook"></i>&nbsp;Facebook
                    </a>
                    <a class="btn btn-outline-secondary btn-sm mb-2" :href="saga.links.twitter" title="Twitter" v-if="saga.links.twitter">
                        <i aria-hidden="true" class="fa fa-twitter"></i>&nbsp;Twitter
                    </a>
                </div>
                <div class="col-md-6">

                    <h2 class="h1 mb-2" v-if="saga.authors.length > 1">Faiseurs</h2>
                    <h2 class="h1 mb-2" v-else>Faiseur</h2>



                    <div class="d-flex flex-row"
                         v-for="author in saga.authors"
                         :key="author.id"
                         v-if="author.id">
                        <div>
                            <router-link
                                         :to="{ name: 'listen.authors.show', params: { id: author.slug } }">
                                <cover
                                        size="petit"
                                        type="faiseur"
                                        :urlImage="author.picture.thumb"
                                        :altImage="author.name">
                                </cover>
                            </router-link>
                        </div>
                        <div>
                            <p>
                                <router-link :to="{ name: 'listen.authors.show', params: { id: author.slug } }"
                                             class="text-primary">
                                    {{ author.name }}
                                </router-link>
                            </p>
                            <p class="mb-3">
                                <text-ellipsis :text="author.bio" :size="200"></text-ellipsis>
                                <br>
                                <router-link :to="{ name: 'listen.authors.show', params: { id: author.slug } }"
                                             class="lien-paragraphe">
                                    Voir la biographie
                                </router-link>
                            </p>
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
                                <span class="font-weight-bold">
                                    {{ track.title }}
                                </span>
                                <span v-if="isCurrentTick(track)">
                                    (épisode en cours)
                                </span>
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
import ticks from '~/lib/services/storage/ticks';
import TrackLength from '~/components/track/TrackLength.vue';
import Banner from '~/components/content/Banner.vue';
import LicenceLink from '~/components/licence/LicenceLink.vue';
import TextEllipsis from '~/components/text/TextEllipsis.vue';
import CollectionType from '~/components/collection/CollectionType';
import NavList from '~/components/Ui/Nav/NavList';
import NavItem from '~/components/Ui/Nav/NavItem';
import Cover from '~/components/content/Cover.vue';

export default {
    components: {
        TrackLength,
        Banner,
        LicenceLink,
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
        currentTick: null,
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

            this.currentTick = await ticks.get(this.saga.id);
        },

        async playSaga() {
            let tick = await ticks.get(this.saga.id);
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
        },

        isCurrentTick(track) {
            if (null === this.currentTick) {
                return false;
            }

            let currentSaga = this.$store.state.player.currentSaga;

            if (!currentSaga.id) {
                return false;
            }

            // Si la saga en cours de lecture est celle de la page en cours
            // alors on n'affiche pas le tick car l'épisode est déjà affiché
            // comme étant celui en cours de lecture.
            if (currentSaga.id == this.currentTick.saga) {
                return false;
            }

            if (track.id == this.currentTick.track) {
                return true;
            }

            return false;
        },
    },

    created: function () {
        this.fetchData();
    },

    watch: {
        '$route': 'fetchData'
    }
}
</script>
