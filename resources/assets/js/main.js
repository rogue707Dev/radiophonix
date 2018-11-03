import Vue from 'vue';
import store from '~/lib/store';
import router from '~/routing/router';
import * as filters from '~/lib/vue/filters';
import * as directives from '~/lib/vue/directives';
import AppView from '~/pages/App.vue';

Object.keys(filters).forEach(key => {
    Vue.filter(key, filters[key]);
});

Object.keys(directives).forEach(key => {
    Vue.directive(key, directives[key]);
});

export default new Vue({
    router,
    store,
    render: h => h(AppView)
}).$mount('#app');
