// First we import the default layout
import DefaultLayout from '~/pages/Layout.vue';

// Error pages
import NotFoundView from '~/pages/errors/404.vue';

// Root level pages
import HomeView from '~/pages/Home.vue';
import HelpView from '~/pages/Help.vue';
import MentionsLegalesView from '~/pages/Legal/MentionsLegales.vue';
import SearchView from '~/pages/Search.vue';
import NewsView from '~/pages/News.vue';

// Contribute pages
import ContributeLayoutView from '~/pages/Contribute/Layout.vue';
import ContributeView from '~/pages/Contribute/Contribute.vue';
import RoadmapView from '~/pages/Contribute/Roadmap.vue';

// Listen pages
import ListenLayout from '~/pages/listen/Layout.vue';

import ListenIndexLayout from '~/pages/listen/Index/Layout.vue';
import ListenIndexSagasView from '~/pages/listen/Index/Sagas.vue';
import ListenIndexAuthorsView from '~/pages/listen/Index/Authors.vue';
import ListenIndexTeamsView from '~/pages/listen/Index/Teams.vue';
import ListenIndexGenresView from '~/pages/listen/Index/Genres.vue';

import ListenSagaShowView from '~/pages/listen/sagas/Show.vue';
import ListenAuthorShowView from '~/pages/listen/authors/Show.vue';
import ListenTeamShowView from '~/pages/listen/teams/Show.vue';
import ListenGenreShowView from '~/pages/listen/genres/Show.vue';

// Auth pages
import AuthLayoutView from '~/pages/auth/Layout.vue';
import LoginView from '~/pages/auth/Login.vue';
import RegisterView from '~/pages/auth/Register.vue';

// Password reset
import PasswordForgotView from '~/pages/auth/Password/Forgot';
import PasswordResetView from '~/pages/auth/Password/Reset';

// Settings
import SettingsLayoutView from '~/pages/user/Settings/Layout';
import SettingsProfileView from '~/pages/user/Settings/Profile';
import SettingsPasswordView from '~/pages/user/Settings/Password';
import SettingsAccountView from '~/pages/user/Settings/Account';

import UserProfile from '~/pages/user/Profile.vue';

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
import PublishSagaAlbumsView from '~/pages/publish/saga/Albums.vue';
import PublishSagaSettingsView from '~/pages/publish/saga/Settings.vue';

import PublishTrackDashboardView from '~/pages/publish/track/Dashboard.vue';
import PublishTrackPublishingView from '~/pages/publish/track/Publishing.vue';
import PublishTrackInformationsView from '~/pages/publish/track/Informations.vue';
import PublishTrackFileView from '~/pages/publish/track/File.vue';
import PublishTrackDateView from '~/pages/publish/track/Date.vue';

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
                                path: 'auteurs',
                                name: 'publish.saga.authors',
                                component: PublishSagaAuthorsView,
                                meta: { auth: true }
                            },
                            {
                                path: 'albums',
                                name: 'publish.saga.albums',
                                component: PublishSagaAlbumsView,
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
                            }
                        ]
                    }
                ]
            },

            {
                path: 'settings',
                component: SettingsLayoutView,
                name: 'settings',
                meta: { menu: 'profile', auth: true },
                children: [
                    {
                        path: 'profile',
                        component: SettingsProfileView,
                        name: 'settings.profile',
                        meta: { menu: 'profile', auth: true }
                    },
                    {
                        path: 'password',
                        component: SettingsPasswordView,
                        name: 'settings.password',
                        meta: { menu: 'profile', auth: true },
                    },
                    {
                        path: 'account',
                        component: SettingsAccountView,
                        name: 'settings.account',
                        meta: { menu: 'profile', auth: true },
                    },
                ]
            },

            {
                path: '',
                component: AuthLayoutView,
                name: 'auth',
                meta: { menu: 'auth' },
                children: [
                    {
                        path: 'connexion',
                        component: LoginView,
                        name: 'login',
                        meta: { menu: 'login' }
                    },
                    {
                        path: 'inscription',
                        component: RegisterView,
                        name: 'register',
                        meta: { menu: 'register' }
                    },
                    {
                        path: 'password-reset',
                        component: PasswordForgotView,
                        name: 'password.forgot',
                        meta: { menu: 'login' }
                    },
                    {
                        path: 'password-reset/:token',
                        component: PasswordResetView,
                        name: 'password.reset',
                        meta: { menu: 'login' }
                    },
                ]
            },
            {
                path: 'profil/:user',
                component: UserProfile,
                name: 'profile',
                meta: { menu: 'profile' }
            },
            {
                path: 'aide',
                component: HelpView,
                name: 'help',
                meta: { menu: 'help' }
            },
            {
                path: 'mentions-legales',
                component: MentionsLegalesView,
                name: 'mentions-legales',
                meta: { menu: 'help' }
            },
            {
                path: '',
                component: ContributeLayoutView,
                name: 'contribute-index',
                children: [
                    {
                        path: 'contribuer',
                        component: ContributeView,
                        name: 'contribute',
                        meta: { menu: 'contribute' }
                    },
                    {
                        path: 'roadmap',
                        component: RoadmapView,
                        name: 'roadmap',
                        meta: { menu: 'contribute' }
                    },
                ]
            },
            {
                path: 'nouveautes',
                component: NewsView,
                name: 'news',
                meta: { menu: 'news' }
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
                        component: ListenIndexLayout,
                        name: 'listen.sagas.index',
                        meta: { menu: 'listen' },
                        children: [
                            {
                                path: '',
                                component: ListenIndexSagasView,
                                name: 'listen.home',
                                meta: { menu: 'listen' }
                            },
                            {
                                path: 'sagas',
                                component: ListenIndexSagasView,
                                name: 'listen.sagas.index',
                                meta: { menu: 'listen' },
                            },
                            {
                                path: 'auteurs',
                                component: ListenIndexAuthorsView,
                                name: 'listen.authors.index',
                                meta: { menu: 'listen' },
                            },
                            {
                                path: 'equipes',
                                component: ListenIndexTeamsView,
                                name: 'listen.teams.index',
                                meta: { menu: 'listen' },
                            },
                            {
                                path: 'genres',
                                component: ListenIndexGenresView,
                                name: 'listen.genres.index',
                                meta: { menu: 'listen' },
                            },
                        ],
                    },

                    {
                        path: 'sagas/:idOrSlug',
                        component: ListenSagaShowView,
                        name: 'listen.sagas.show',
                        meta: { menu: 'listen' }
                    },
                    {
                        path: 'auteurs/:id',
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
                ]
            },
        ]
    },
    {
        path: '*',
        component: NotFoundView,
        name: '404',
    }
];

export default routes;
