import Vue from 'vue';
import Vuex from 'vuex';
import PlayerModule from './modules/PlayerModule';
import MenuModule from './modules/MenuModule';
import SearchModule from './modules/SearchModule';

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        player: PlayerModule,
        menu: MenuModule,
        search: SearchModule,
    }
});

export default store;
