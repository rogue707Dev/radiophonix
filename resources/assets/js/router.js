import Vue from 'vue';
import VueRouter from 'vue-router';

import routes from '~/routes';
import store from '~/lib/store';

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
