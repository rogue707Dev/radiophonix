// First we import the default layout
import DefaultLayout from '~/pages/Layout.vue';

// Error pages
import NotFoundView from '~/pages/errors/404.vue';

// Root level pages
import HomeView from '~/pages/Home.vue';
import LoginView from '~/pages/Login.vue';
import ContributeView from '~/pages/Contribute.vue';
import HelpView from '~/pages/Help.vue';
import SearchView from '~/pages/Search.vue';

// Listen pages
import ListenLayout from '~/pages/listen/Layout.vue';
import ListenSagaIndexView from '~/pages/listen/sagas/Index.vue';
import ListenSagaShowView from '~/pages/listen/sagas/Show.vue';
import ListenAuthorIndexView from '~/pages/listen/authors/Index.vue';
import ListenAuthorShowView from '~/pages/listen/authors/Show.vue';
import ListenTeamShowView from '~/pages/listen/teams/Show.vue';
import ListenGenreShowView from '~/pages/listen/genres/Show.vue';

// Publish pages
import PublishLayout from '~/pages/publish/Layout.vue';
import PublishHomeView from '~/pages/publish/Home.vue';

import PublishSagaDashboardView from '~/pages/publish/saga/Dashboard.vue';
import PublishSagaTracksView from '~/pages/publish/saga/Tracks.vue';
import PublishSagaCalendarView from '~/pages/publish/saga/Calendar.vue';
import PublishSagaInformationsView from '~/pages/publish/saga/Informations.vue';
import PublishSagaLinksView from '~/pages/publish/saga/Links.vue';
import PublishSagaImagesView from '~/pages/publish/saga/Images.vue';
import PublishSagaAuthorsView from '~/pages/publish/saga/Authors.vue';
import PublishSagaCollectionsView from '~/pages/publish/saga/Collections.vue';
import PublishSagaSettingsView from '~/pages/publish/saga/Settings.vue';

import PublishTrackDashboardView from '~/pages/publish/track/Dashboard.vue';
import PublishTrackPublishingView from '~/pages/publish/track/Publishing.vue';
import PublishTrackInformationsView from '~/pages/publish/track/Informations.vue';
import PublishTrackFileView from '~/pages/publish/track/File.vue';
import PublishTrackDateView from '~/pages/publish/track/Date.vue';
import PublishTrackPercentagesView from '~/pages/publish/track/Percentages.vue';
import PublishTrackChaptersView from '~/pages/publish/track/Chapters.vue';

// Documentation views
import DocumentationBootstrapView from '~/pages/doc/Bootstrap.vue';

const routes = [
    {
        path: '',
        component: DefaultLayout,
        children: [
            {
                path: '',
                name: 'home',
                components: {
                    default: HomeView,
                },
                meta: { menu: 'home' },
            },
            {
                path: 'publier',
                component: PublishLayout,
                meta: { menu: 'publish' },
                children: [
                    {
                        path: '',
                        name: 'publish',
                        component: PublishHomeView,
                        meta: { menu: 'publish' },
                    },
                    {
                        path: 'sagas/:id',
                        name: 'publish.saga.dashboard',
                        component: PublishSagaDashboardView,
                        meta: { auth: true },
                        children: [
                            {
                                path: 'episodes',
                                name: 'publish.saga.tracks',
                                component: PublishSagaTracksView,
                                meta: { auth: true }
                            },
                            {
                                path: 'calendrier',
                                name: 'publish.saga.calendar',
                                component: PublishSagaCalendarView,
                                meta: { auth: true }
                            },
                            {
                                path: 'informations',
                                name: 'publish.saga.informations',
                                component: PublishSagaInformationsView,
                                meta: { auth: true }
                            },
                            {
                                path: 'liens',
                                name: 'publish.saga.links',
                                component: PublishSagaLinksView,
                                meta: { auth: true }
                            },
                            {
                                path: 'images',
                                name: 'publish.saga.images',
                                component: PublishSagaImagesView,
                                meta: { auth: true }
                            },
                            {
                                path: 'faiseurs',
                                name: 'publish.saga.authors',
                                component: PublishSagaAuthorsView,
                                meta: { auth: true }
                            },
                            {
                                path: 'collections',
                                name: 'publish.saga.collections',
                                component: PublishSagaCollectionsView,
                                meta: { auth: true }
                            },
                            {
                                path: 'parametres',
                                name: 'publish.saga.settings',
                                component: PublishSagaSettingsView,
                                meta: { auth: true }
                            }
                        ]
                    },
                    {
                        path: 'episode/:id',
                        name: 'publish.track.dashboard',
                        component: PublishTrackDashboardView,
                        meta: { auth: true },
                        children: [
                            {
                                path: 'publication',
                                name: 'publish.track.publishing',
                                component: PublishTrackPublishingView,
                                meta: { auth: true }
                            },
                            {
                                path: 'informations',
                                name: 'publish.track.informations',
                                component: PublishTrackInformationsView,
                                meta: { auth: true }
                            },
                            {
                                path: 'fichier',
                                name: 'publish.track.file',
                                component: PublishTrackFileView,
                                meta: { auth: true }
                            },
                            {
                                path: 'date-de-publication',
                                name: 'publish.track.date',
                                component: PublishTrackDateView,
                                meta: { auth: true }
                            },
                            {
                                path: 'pourcentages',
                                name: 'publish.track.percentages',
                                component: PublishTrackPercentagesView,
                                meta: { auth: true }
                            },
                            {
                                path: 'chapitres',
                                name: 'publish.track.chapters',
                                component: PublishTrackChaptersView,
                                meta: { auth: true }
                            }
                        ]
                    }
                ]
            },
            {
                path: 'connexion',
                component: LoginView,
                name: 'login',
                meta: { menu: 'listen' }
            },
            {
                path: 'contribuer',
                component: ContributeView,
                name: 'contribute',
                meta: { menu: 'contribute' }
            },
            {
                path: 'aide',
                component: HelpView,
                name: 'help',
                meta: { menu: 'help' }
            },
            {
                path: 'recherche',
                component: SearchView,
                name: 'search',
                meta: { menu: 'search' }
            },
            {
                path: 'bootstrap',
                component: DocumentationBootstrapView,
                name: 'bootstrap',
                meta: { menu: 'help' }
            },
            {
                path: 'ecouter',
                component: ListenLayout,
                meta: { menu: 'listen' },
                children: [
                    {
                        path: '',
                        component: ListenSagaIndexView,
                        name: 'listen.home',
                        meta: { menu: 'listen' }
                    },

                    {
                        path: 'sagas',
                        component: ListenSagaIndexView,
                        name: 'listen.sagas.index',
                        meta: { menu: 'listen' }
                    },
                    {
                        path: 'sagas/:idOrSlug',
                        component: ListenSagaShowView,
                        name: 'listen.sagas.show',
                        meta: { menu: 'listen' }
                    },

                    {
                        path: 'faiseurs',
                        component: ListenAuthorIndexView,
                        name: 'listen.authors.index',
                        meta: { menu: 'listen' }
                    },
                    {
                        path: 'faiseurs/:id',
                        component: ListenAuthorShowView,
                        name: 'listen.authors.show',
                        meta: { menu: 'listen' }
                    },
                    {
                        path: 'equipes/:id',
                        component: ListenTeamShowView,
                        name: 'listen.teams.show',
                        meta: { menu: 'listen' }
                    },

                    {
                        path: 'genres/:id',
                        component: ListenGenreShowView,
                        name: 'listen.genres.show',
                        meta: { menu: 'listen' }
                    },

                    // {
                    //     path: '/me',
                    //     component: UserShowView,
                    //     name: 'listen.authors.show'
                    // }
                ]
            },
        ]
    },
    {
        path: '*',
        component: NotFoundView
    }
];

export default routes;
