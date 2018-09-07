import Vue from 'vue';

import store from '~/lib/store';
import progress from '~/plugins/progress-bar';
import router from '~/router';

import filters from '~/lib/filters';

import AppView from '~/pages/App.vue';

export default new Vue({
    router,
    store,
    render: h => h(AppView)
}).$mount('#app');
