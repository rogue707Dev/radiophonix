import Vue from 'vue';
import Vuex from 'vuex';
import PlayerModule from './modules/PlayerModule';
import TickModule from './modules/TickModule';
import UiModule from './modules/UiModule';
import SearchModule from './modules/SearchModule';
import AuthModule from './modules/AuthModule';
import LikesModule from './modules/LikesModule';

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        player: PlayerModule,
        tick: TickModule,
        ui: UiModule,
        search: SearchModule,
        auth: AuthModule,
        likes: LikesModule,
    }
});

export function resetStore() {
    store.dispatch('auth/resetState');
    store.dispatch('likes/resetState');
}

export default store;
