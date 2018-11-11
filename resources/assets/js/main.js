// Vue
import Vue from 'vue';

// Bootstrap-Vue
import BootstrapVue from 'bootstrap-vue';
import 'bootstrap-vue/dist/bootstrap-vue.css';

// Radiophonix
import store from '~/lib/store';
import router from '~/routing/router';
import * as filters from '~/lib/vue/filters';
import * as directives from '~/lib/vue/directives';
import AppView from '~/pages/App.vue';

// Inclusion du SASS
// Il est important de l'inclure depuis le JavaScript et pas depuis
// un fichier .vue pour avoir une génération correcte des source maps.
require('../sass/app.scss');

Object.keys(filters).forEach(key => {
    Vue.filter(key, filters[key]);
});

Object.keys(directives).forEach(key => {
    Vue.directive(key, directives[key]);
});

Vue.use(BootstrapVue);

export default new Vue({
    router,
    store,
    render: h => h(AppView)
}).$mount('#app');
