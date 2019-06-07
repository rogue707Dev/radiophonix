import Vue from 'vue';
import VueRouter from 'vue-router';

import routes from '~/routing/routes';
import store from '~/lib/store';
import news from '~/lib/services/storage/news';
import api from "~/lib/api";

Vue.use(VueRouter);

let router = new VueRouter({
    routes: routes,
    mode: 'history',
    scrollBehavior: function (to, from, savedPosition) {
        return savedPosition || {
            x: 0,
            y: 0
        };
    }
});

router.beforeEach((to, from, next) => {
    if (to.name === 'news') {
        news.read();
    }

    store.dispatch('ui/closeMenu');

    next();
});

router.beforeEach((to, from, next) => {
    if (to.meta.auth && !store.getters['auth/isAuthenticated']) {
        next({
            path: '/connexion',
            query: {
                redirect: to.fullPath
            }
        });
    } else {
        next();
    }
});

router.beforeEach((to, from, next) => {
    next();

    api.interactions
        .pageView(to)
        // Les erreurs des metrics ne doivent pas être bloquantes
        .catch(() => {});
});

export default router;
