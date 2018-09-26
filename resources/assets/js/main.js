import Vue from 'vue';

import store from '~/lib/store';
import router from '~/router';

import filters from '~/lib/filters';
import feature from '~/directives/feature';
import title from '~/directives/title';

import AppView from '~/pages/App.vue';

export default new Vue({
    router,
    store,
    render: h => h(AppView)
}).$mount('#app');
