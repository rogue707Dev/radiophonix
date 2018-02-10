import Vue from 'vue';

import store from '~/lib/store';
import progress from '~/plugins/progress-bar';
import router from '~/router';

import filters from '~/lib/filters';

import AppView from '~/pages/App.vue';

import MenuComponent from '~/components/Menu.vue';
import MenuItemComponent from '~/components/menu/MenuItem.vue';
import PlayerComponent from '~/components/Player.vue';
import IconComponent from '~/components/Icon.vue';

Vue.component('rp-menu', MenuComponent);
Vue.component('rp-menu-item', MenuItemComponent);
Vue.component('rp-player', PlayerComponent);
Vue.component('rp-icon', IconComponent);

export default new Vue({
    router,
    store,
    render: h => h(AppView)
}).$mount('#app');
