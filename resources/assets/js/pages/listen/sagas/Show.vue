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
            </template>

            <ul class="banniere__contenu__bande">
                <b-tooltip target="saga-like-count-button"
                           placement="top">
                    <div class="text-left">
                        <div v-if="likes.firstLoad">
                            Chargement...
                        </div>

                        <div v-else v-for="name in likes.names">
                            {{ name }}
                        </div>
                        <div v-if="likes.more > 0">
                            et {{ likes.more }} de plus...
                        </div>

                        <div v-if="saga.stats.likes === 0 && !likes.firstLoad">
                            Ajouter aux favoris
                        </div>
                    </div>
                </b-tooltip>

                <li class="banniere__contenu__bande__item"
                    id="saga-like-count-button"
                    @mouseenter="showLikesTooltip">
                    {{ saga.stats.likes }}
                    <like-button likeable-type="saga"
                                 :likeable-id="saga.id"/>
                </li>
                <template v-if="saga.stats.albums == 1">
                    <li class="banniere__contenu__bande__item">
                        {{ saga.stats.tracks }} épisodes
                    </li>
                </template>
                <template v-else>
                    <li class="banniere__contenu__bande__item">
                        {{ saga.stats.albums }} saisons
                    </li>
                    <li class="banniere__contenu__bande__item">
                        {{ saga.stats.tracks }} épisodes
                    </li>
                </template>
                <li class="banniere__contenu__bande__item"
                    v-b-tooltip.hover.top title="Date de création">
                    <i aria-hidden="true" class="fa fa-calendar"></i> {{ saga.creation_date | formatDate }}
                </li>
                <li class="banniere__contenu__bande__item" v-if="saga.finished">
                    Saga terminée
                </li>
                <li class="banniere__contenu__bande__item"
                    v-b-tooltip.hover.top title="Genre">
                    <router-link class="text-primary"
                                 v-if="genre"
                                 :to="{ name: 'listen.genres.show', params: { id: genre.slug } }">
                        {{ genre.name }}
                    </router-link>
                </li>
            </ul>

            <div class="mt-3">
                <button class="btn btn-outline-secondary btn-sm mb-2" @click="playSaga">
                    <i class="fa fa-play" aria-hidden="true"></i>
                    <span v-if="currentTick">Reprendre la lecture</span>
                    <span v-else>Écouter</span>
                </button>
                <licence-link :licence="saga.licence"
                              class="btn btn-outline-secondary btn-sm mb-2"
                              v-if="saga.licence" />
                <a class="btn btn-outline-secondary btn-sm mb-2" :href="saga.rss.url" v-if="saga.rss.url">
                    <i aria-hidden="true" class="fa fa-rss"></i>&nbsp;Flux RSS
                </a>
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

                    <h2 class="h1 mb-2" v-if="saga.authors.length > 1">Auteurs</h2>
                    <h2 class="h1 mb-2" v-else>Auteur</h2>



                    <div class="d-flex flex-row"
                         v-for="author in saga.authors"
                         :key="author.id"
                         v-if="author.id">
                        <div>
                            <router-link
                                         :to="{ name: 'listen.authors.show', params: { id: author.slug } }">
                                <cover
                                        size="petit"
                                        type="auteur"
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
                    <nav-list v-if="albums.length > 1">
                        <nav-item v-for="(albums, type, index) in albumTypes"
                                  :key="index"
                                  :active="currentAlbumType === type"
                                  @click="currentAlbumType = type">
                            <album-type :type="type"/>
                        </nav-item>
                    </nav-list>
                    <nav-list v-else>
                        <nav-item :active="true">Épisodes</nav-item>
                    </nav-list>
                </div>
                <div class="col-12"
                     v-for="album in albumTypes[currentAlbumType]"
                     :key="album.id">
                        <h3 class="h3 mb-2 mt-3"
                            v-if="albums.length > 1">
                            {{ album.name }}
                        </h3>

                        <div class="episode-item"
                             v-for="track in album.tracks" :key="track.id">
                            <div class="ml-xl-3 text-right" v-html="formatTrackNumber(track.number)"></div>

                            <div class="episode-item__content">
                                <span class="font-weight-bold">
                                    {{ track.title }}
                                </span>
                                &nbsp;•&nbsp;<track-length :seconds="track.seconds"></track-length>
                                <p>{{ track.synopsis }}</p>
                            </div>

                            <div class="episode-item__etat-lecture">
                                <span
                                        v-if="track.id == currentTrack.id"
                                        class="text-primary border border-primary rounded p-1">
                                Épisode en cours
                            </span>
                                <button
                                        v-else
                                        class="btn btn-sm"
                                        :class="{'btn-outline-primary': isCurrentTick(track), 'btn-outline-secondary': !isCurrentTick(track)}"
                                        @click="play({track, saga, autoStart: true})">
                                    <i class="fa fa-play pr-1" aria-hidden="true"></i>
                                    <span v-if="isCurrentTick(track)">Reprendre la lecture</span>
                                    <span v-else>Écouter</span>
                                </button>
                            </div>

                            <div class="episode-item__download">
                                <a :href="track.file"
                                   target="_blank"
                                   class="btn btn-outline-secondary btn-sm mr-xl-3">
                                    <i aria-hidden="true" class="fa fa-download"></i>
                                    Télécharger
                                </a>
                            </div>

                        </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
    import {mapActions, mapGetters, mapState} from 'vuex';
    import api from '~/lib/api';
    import ticks from '~/lib/services/storage/ticks';
    import TrackLength from '~/components/track/TrackLength.vue';
    import Banner from '~/components/content/Banner.vue';
    import LicenceLink from '~/components/licence/LicenceLink.vue';
    import TextEllipsis from '~/components/text/TextEllipsis.vue';
    import AlbumType from '~/components/album/AlbumType';
    import NavList from '~/components/Ui/Nav/NavList';
    import NavItem from '~/components/Ui/Nav/NavItem';
    import Cover from '~/components/content/Cover.vue';
    import FaIcon from '~/components/Ui/Icon/FaIcon.vue';
    import LikeButton from '~/components/Like/LikeButton.vue';
    import rss from '~/lib/services/rss';

    export default {
    components: {
        TrackLength,
        Banner,
        LicenceLink,
        TextEllipsis,
        AlbumType,
        NavList,
        NavItem,
        Cover,
        FaIcon,
        LikeButton,
    },

    data: () => ({
        saga: {
            id: '',
            stats: {
                likes: 0,
            },
            links: {},
            rss: {},
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
        albums: [],
        currentAlbumType: null,
        currentTick: null,
        likeButtonLoading: false,
        likes: {
            firstLoad: true,
            loading: null,
            names: [],
            more: 0,
        },
    }),

    computed: {
        ...mapState('player', [
            'currentTrack',
            'isLoading',
        ]),

        ...mapGetters('likes', [
            'isLiked',
        ]),

        genre() {
            if (!this.saga.genres) {
                return null;
            }

            return this.saga.genres[0] || null;
        },

        albumTypes() {
            let albums = {};

            for (const album of this.albums) {
                albums[album.type] = albums[album.type] || [];

                albums[album.type].push(album);
            }

            return albums;
        },

        likeButtonClass() {
            if (this.likeButtonLoading) {
                return 'fa-circle-o-notch fa-spin';
            }

            if (this.isLiked('saga', this.saga.id)) {
                return 'var--actif';
            }
        },
    },

    methods: {
        ...mapActions('player', [
            'play'
        ]),

        async fetchData() {
            let sagaResult = api.sagas.get(this.$route.params.idOrSlug);
            let albumResult = api.albums.all(this.$route.params.idOrSlug);

            [sagaResult, albumResult] = [await sagaResult, await albumResult];

            this.saga = sagaResult;
            this.albums = albumResult;

            if (this.albums.length > 0) {
                this.currentAlbumType = this.albums[0].type;
            }

            this.currentTick = await ticks.get(this.saga.id);

            rss.setLinkTag(this.saga.rss.url);
        },

        async playSaga() {
            let tick = await ticks.get(this.saga.id);
            let track = {};
            let percentage = 0;

            if (tick) {
                for (const albumKey in this.albums) {
                    if (!this.albums.hasOwnProperty(albumKey)) {
                        continue;
                    }

                    const tracks = this.albums[albumKey].tracks || [];

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
                track = this.albums[0].tracks[0];
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

        async showLikesTooltip() {
            if (this.likes.loading) {
                return;
            }

            this.likes.loading = true;

            let res = await api.sagas.likes(this.saga.id);

            this.saga.stats.likes = res.data.total;
            this.likes.names = res.data.names;
            this.likes.more = res.data.more;
            this.likes.firstLoad = false;

            setTimeout(
                () => {
                    this.likes.loading = false;
                },
                2000
            );
        },
    },

    created: function () {
        this.fetchData();
    },

    mounted() {
        this.$store.subscribe((mutation) => {
            if ((mutation.type === 'likes/add' || mutation.type === 'likes/remove')
                && mutation.payload.type === 'saga'
                && mutation.payload.id === this.saga.id
            ) {
                mutation.type === 'likes/add'
                    ? this.saga.stats.likes++
                    : this.saga.stats.likes--;
            }
        });
    },

    watch: {
        '$route': 'fetchData'
    }
}
</script>
