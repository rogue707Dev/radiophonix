// First we import the default layout
import * as DefaultLayout from '~/pages/Layout.vue';

// Error pages
import * as NotFoundView from '~/pages/errors/404.vue';

// Root level pages
import * as HomeView from '~/pages/Home.vue';
import * as LoginView from '~/pages/Login.vue';
import * as ContributeView from '~/pages/Contribute.vue';
import * as HelpView from '~/pages/Help.vue';
import * as SearchView from '~/pages/Search.vue';

// Listen pages
import * as ListenLayout from '~/pages/listen/Layout.vue';
import * as ListenSagaIndexView from '~/pages/listen/sagas/Index.vue';
import * as ListenSagaShowView from '~/pages/listen/sagas/Show.vue';
import * as ListenAuthorIndexView from '~/pages/listen/authors/Index.vue';
import * as ListenAuthorShowView from '~/pages/listen/authors/Show.vue';
import * as ListenGenreShowView from '~/pages/listen/genres/Show.vue';

// Publish pages
import * as PublishLayout from '~/pages/publish/Layout.vue';
import * as PublishHomeView from '~/pages/publish/Home.vue';

import * as PublishSagaDashboardView from '~/pages/publish/saga/Dashboard.vue';
import * as PublishSagaTracksView from '~/pages/publish/saga/Tracks.vue';
import * as PublishSagaCalendarView from '~/pages/publish/saga/Calendar.vue';
import * as PublishSagaInformationsView from '~/pages/publish/saga/Informations.vue';
import * as PublishSagaLinksView from '~/pages/publish/saga/Links.vue';
import * as PublishSagaImagesView from '~/pages/publish/saga/Images.vue';
import * as PublishSagaAuthorsView from '~/pages/publish/saga/Authors.vue';
import * as PublishSagaCollectionsView from '~/pages/publish/saga/Collections.vue';
import * as PublishSagaSettingsView from '~/pages/publish/saga/Settings.vue';

import * as PublishTrackDashboardView from '~/pages/publish/track/Dashboard.vue';
import * as PublishTrackPublishingView from '~/pages/publish/track/Publishing.vue';
import * as PublishTrackInformationsView from '~/pages/publish/track/Informations.vue';
import * as PublishTrackFileView from '~/pages/publish/track/File.vue';
import * as PublishTrackDateView from '~/pages/publish/track/Date.vue';
import * as PublishTrackPercentagesView from '~/pages/publish/track/Percentages.vue';
import * as PublishTrackChaptersView from '~/pages/publish/track/Chapters.vue';

// Documentation views
import * as DocumentationBootstrapView from '~/pages/doc/Bootstrap.vue';

// Dev views
// import * as MaquetteView from '~/pages/Maquette.vue';
// import * as FooView from '~/pages/Foo.vue';

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
