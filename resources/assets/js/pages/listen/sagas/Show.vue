<template>
    <div>

        <banner
            :title="saga.name"
            :subtitle="saga.author.name">

            <template slot="image">
                <div class="jaquette--banniere jaquette--saga">
                    <img :src="saga.images.cover.main" alt="" />
                </div>
                <button class="pa-centrer btn btn-outline-theme btn-round btn-lg" @click="playSaga">
                    <i aria-hidden="true" class="fa fa-play"></i>
                </button>
            </template>

            <div class="btn-toolbar mt-3">
                <div class="statistic-container btn-group btn-group-sm mr-2">
                    <button type="button" class="btn btn-outline-secondary disabled">
                        {{ saga.stats.bravos }} <i aria-hidden="true" class="fa fa-heart"></i>
                    </button>
                </div>
                <div class="statistic-container btn-group btn-group-sm mr-2">
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
                <div class="statistic-container btn-group btn-group-sm mr-2">
                    <router-link tag="button"
                                 class="btn btn-outline-primary"
                                 v-if="genre"
                                 :to="{ name: 'listen.genres.show', params: { id: genre.id } }">
                        {{ genre.name }}
                    </router-link>
                </div>
                <div class="statistic-container btn-group btn-group-sm" v-if="saga.finished">
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
                    <p>{{ saga.synopsis }}</p>
                    <ul class="liste-bouton mt-3">
                        <li v-if="saga.links.site">
                            <a class="btn btn-outline-secondary btn-sm" :href="saga.links.site">
                                <i aria-hidden="true" class="fa fa-globe"></i>&nbsp;Site officiel
                            </a>
                        </li>
                        <li v-if="saga.links.facebook">
                            <a class="btn btn-outline-secondary btn-sm" :href="saga.links.facebook" title="Facebook">
                                <i aria-hidden="true" class="fa fa-facebook"></i> Facebook
                            </a>
                        </li>
                        <li v-if="saga.links.twitter">
                            <a class="btn btn-outline-secondary btn-sm" :href="saga.links.twitter" title="Twitter">
                                <i aria-hidden="true" class="fa fa-twitter"></i> Twitter
                            </a>
                        </li>
                        <li v-if="saga.links.netowiki">
                            <a class="btn btn-outline-secondary btn-sm" :href="saga.links.netowiki">
                                <i aria-hidden="true" class="fa fa-globe"></i>&nbsp;Netowiki
                            </a>
                        </li>
                        <li v-if="saga.links.topic">
                            <a class="btn btn-outline-secondary btn-sm" :href="saga.links.topic">
                                <i aria-hidden="true" class="fa fa-globe"></i>&nbsp;Netophonix
                            </a>
                        </li>
                        <li v-if="saga.links.rss">
                            <a class="btn btn-outline-secondary btn-sm" :href="saga.links.rss">
                                <i aria-hidden="true" class="fa fa-globe"></i>&nbsp;{{ saga.links.rss }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">

                    <h2 class="h1 mb-4">Faiseur</h2>
                    <div class="d-flex flex-row">
                        <div>
                            <router-link class="jaquette--petite jaquette--faiseur"
                                         v-if="saga.author.id"
                                         :to="{ name: 'listen.authors.show', params: { id: saga.author.slug } }">
                                <img :src="saga.author.picture.thumb"
                                     :alt="saga.author.name"
                                     height="100px" width="100px"/>
                            </router-link>
                        </div>
                        <div>
                            <p class="text-primary">
                                <i v-if="saga.author.type === 'user'" aria-hidden="true" class="fa fa-user"></i>
                                {{ saga.author.name }}
                            </p>
                            <p><text-ellipsis :text="saga.author.bio" :size="200"></text-ellipsis></p>
                            <router-link v-if="saga.author.id"
                                         :to="{ name: 'listen.authors.show', params: { id: saga.author.slug } }"
                                         class="btn btn-outline-primary btn-sm mt-3">
                                Voir la biographie
                            </router-link>

                            <ul class="liste-bouton mt-3">
                                <li v-if="saga.author.links.site">
                                    <a class="btn btn-outline-secondary btn-sm" :href="saga.author.links.site">
                                        <i aria-hidden="true" class="fa fa-globe"></i>&nbsp;Site officiel
                                    </a>
                                </li>
                                <li v-if="saga.author.links.facebook">
                                    <a class="btn btn-outline-secondary btn-sm" :href="saga.author.links.facebook" title="Facebook">
                                        <i aria-hidden="true" class="fa fa-facebook"></i> Facebook
                                    </a>
                                </li>
                                <li v-if="saga.author.links.twitter">
                                    <a class="btn btn-outline-secondary btn-sm" :href="saga.author.links.twitter" title="Twitter">
                                        <i aria-hidden="true" class="fa fa-twitter"></i> Twitter
                                    </a>
                                </li>
                                <li v-if="saga.author.links.netowiki">
                                    <a class="btn btn-outline-secondary btn-sm" :href="saga.author.links.netowiki">
                                        <i aria-hidden="true" class="fa fa-globe"></i>&nbsp;Netowiki
                                    </a>
                                </li>
                                <li v-if="saga.author.links.topic">
                                    <a class="btn btn-outline-secondary btn-sm" :href="saga.author.links.topic">
                                        <i aria-hidden="true" class="fa fa-globe"></i>&nbsp;Netophonix
                                    </a>
                                </li>
                            </ul>
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

                        <div class="row episode-item"
                             @click="play({track, saga})"
                             :class="{'actif': track.id == currentTrack.id}"
                             v-for="track in collection.tracks" :key="track.id">
                            <div class="col-2 col-md-1 col-lg-1 order-lg-1">
                                <div class="d-flex align-items-center h-100 justify-content-center"
                                     v-html="formatTrackNumber(track.number)">
                                </div>
                            </div>
                            <div class="col-8 col-md-7 col-lg-8 order-lg-2">
                                <span class="font-weight-bold">{{ track.title }}</span>
                                <p>{{ track.synopsis }}</p>
                            </div>
                            <div class="col-2 col-md-2 col-lg-1 order-lg-4">
                                <div class="d-flex align-items-center h-100 justify-content-center">
                                    <div v-if="track.id == currentTrack.id" class="skin-icon-fa__cercle text-primary">
                                        <i aria-hidden="true" class="fa fa-spin fa-refresh" v-if="isLoading"></i>
                                        <i aria-hidden="true" class="fa fa-volume-up" v-else></i>
                                    </div>
                                    <div v-else class="skin-icon-fa__cercle">
                                        <i aria-hidden="true" class="fa fa-play"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-10 offset-2 col-md-2 offset-md-0 col-lg-2 order-lg-3">
                                <div class="d-flex align-items-center h-100">
                                    <span class="text-primary">
                                        <i aria-hidden="true" class="fa fa-clock-o"></i>
                                        <track-length :seconds="track.seconds" type="number"></track-length>
                                    </span>
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
import TrackLength from '~/components/track/TrackLength.vue';
import Banner from '~/components/content/Banner.vue';
import LicenceIcon from '~/components/licence/LicenceIcon.vue';
import TextEllipsis from '~/components/text/TextEllipsis.vue';
import CollectionType from '~/components/collection/CollectionType';
import NavList from '~/components/nav/NavList';
import NavItem from '~/components/nav/NavItem';

export default {
    components: {
        TrackLength,
        Banner,
        LicenceIcon,
        TextEllipsis,
        CollectionType,
        NavList,
        NavItem,
    },

    data() {
        return {
            saga: {
                stats: {},
                links: {},
                author: {
                    links: {},
                    picture: {},
                    bio: '',
                },
                images: {
                    cover: {}
                },
                genres: [],
            },
            collections: [],
            currentCollectionType: null,
        };
    },

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
            this.play({
                track: this.collections[0].tracks[0],
                saga: this.saga,
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
