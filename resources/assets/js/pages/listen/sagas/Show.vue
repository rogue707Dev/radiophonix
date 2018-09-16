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

            <ul class="reset-ul mt-3">
                <li class="cartouche">
                    <span>{{ saga.stats.bravos }} <i aria-hidden="true" class="fa fa-heart"></i></span>
                </li>
                <li v-if="saga.stats.collections == 1" class="cartouche">
                    {{ saga.stats.tracks }} épisodes
                </li>
                <li v-else class="cartouche-groupe">
                    <div class="cartouche">
                        {{ saga.stats.collections }} saisons
                    </div>
                    <div class="cartouche">
                        {{ saga.stats.tracks }} épisodes
                    </div>
                </li>
                <router-link tag="li"
                             class="cartouche lien"
                             v-if="genre"
                             :to="{ name: 'listen.genres.show', params: { id: genre.id } }">
                    {{ genre.name }}
                </router-link>
                <li v-if="saga.finished" class="cartouche">Terminé</li>

            </ul>

            <div v-if="saga.licence">
                <a :href="licenceUrl" class="banniere__icon-cc">
                    <licence-icon :licence="saga.licence"></licence-icon>
                </a>
            </div>

        </banner>

        <div class="layout-conteneur__main">

            <div class="row">
                <div class="col-md-6 col-xl-8">
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
                <div class="col-md-6 col-xl-4">

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
                            <p><text-ellispis :text="saga.author.bio" :size="200"></text-ellispis></p>
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


            <div class="row mt-5">
                <div class="col">
                    <h2 class="h1 mt-5 mb-3">
                        <template v-if="collections.length > 1">Saisons</template>
                        <template v-else>Épisodes</template>
                    </h2>

                    <div class="row mb-5" v-for="collection in collections" :key="collection.id">
                        <div class="col">
                            <h3 class="h3 mb-4"
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
                                <div class="col-8 col-md-7 col-lg-7 order-lg-2">
                                    <span class="font-weight-bold">{{ track.title }}</span>
                                    <p>{{ track.synopsis }}</p>
                                </div>
                                <div class="col-2 col-md-2 col-lg-1 order-lg-4">
                                    <div class="d-flex align-items-center h-100 justify-content-center">
                                        <div v-if="track.id == currentTrack.id" class="hfa-cercle-blanc-fonce text-primary">
                                            <i aria-hidden="true" class="fa fa-volume-up"></i>
                                        </div>
                                        <div v-else class="hfa-cercle-blanc-fonce">
                                            <i aria-hidden="true" class="fa fa-play"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10 offset-2 col-md-2 offset-md-0 col-lg-3 order-lg-3">
                                    <div class="d-flex align-items-center h-100">
                                        <span class="text-primary">
                                            <i aria-hidden="true" class="fa fa-clock-o"></i>
                                            <track-length :seconds="track.seconds" type="short"></track-length>
                                        </span>
                                    </div>
                                </div>
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
import TrackLength from '~/components/track/Length.vue';
import Banner from '~/components/content/Banner.vue';
import LicenceIcon from '~/components/licence/LicenceIcon.vue';
import TextEllispis from '~/components/text/TextEllipsis.vue';

export default {
    components: {
        TrackLength,
        Banner,
        LicenceIcon,
        TextEllispis,
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
            collections: []
        };
    },

    computed: {
        ...mapState('player', [
            'currentTrack'
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
