import Vue from 'vue';
import VueRouter from 'vue-router';

import routes from '~/routing/routes';
import store from '~/lib/store';
import news from '~/lib/services/storage/news';

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
    // return next();
    if (to.meta.auth && (router.app.$store.state.token == undefined)) {
        window.console.log('Not authenticated');

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

export default router;
