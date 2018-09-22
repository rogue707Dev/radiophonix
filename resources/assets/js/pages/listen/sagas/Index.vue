<template>
    <div class="layout-conteneur__main">

        <nav class="nav mb-4">
            <span class="nav-link" :class="{ active: menu == 'popular' }" @click="switchMenu('popular', 'sagas', 'popular')">Populaire</span>
            <span class="nav-link" :class="{ active: menu == 'recent' }" @click="switchMenu('recent', 'sagas', 'recent')">Nouveau</span>
            <span class="nav-link" :class="{ active: menu == 'authors' }" @click="switchMenu('authors', 'authors', 'all')">Faiseurs</span>
            <span class="nav-link" :class="{ active: menu == 'genres' }" @click="switchMenu('genres', 'genres', 'all')">Genres</span>
            <span class="nav-link" :class="{ active: menu == 'discover' }" @click="switchMenu('discover', 'sagas', 'discover')">Découvrir</span>
        </nav>

        <saga-list v-show="menu == 'popular'" :sagas="popular"></saga-list>

        <saga-list v-show="menu == 'recent'" :sagas="recent"></saga-list>

        <saga-alphabet-list v-show="menu == 'discover'" :sagas="discover"></saga-alphabet-list>

        <author-list v-show="menu == 'authors'" :authors="authors"></author-list>

        <div class="list-card" v-show="menu == 'genres'">
            <router-link class="card border-saga"
                         v-for="genre in genres" :key="genre.id"
                         :to="{ name: 'listen.genres.show', params: { id: genre.id } }">
                <div class="card-jacket--genre bg-saga">
                    <div class="jaquette--moyen jaquette--genre">
                        <img :src="genre.image.main" alt="">
                    </div>
                    <div class="pa-centrer">
                        <svg width="167px" height="145px">
                            <use xlink:href="#contour-genre"></use>
                        </svg>
                    </div>
                </div>
                <div class="card-body">
                    <p class="h3 text-body">
                        {{ genre.name }}
                        <span class="badge badge-light badge-sm">Genre</span>
                    </p>
                    <p class="text-primary h5">
                        <i aria-hidden="true" class="fa fa-file-audio-o"></i> XXX Séries
                    </p>
                </div>
            </router-link>
        </div>

    </div>
</template>

<script>
import api from '~/lib/api';
import SagaList from '~/components/saga/SagaList.vue';
import AuthorList from '~/components/author/AuthorList.vue';
import SagaAlphabetList from '~/components/saga/SagaAlphabetList.vue';

export default {
    components: {
        SagaList,
        AuthorList,
        SagaAlphabetList,
    },

    data() {
        return {
            menu: 'popular',
            popular: [],
            recent: [],
            authors: [],
            genres: [],
            discover: [],
            shouldWait: false,
        }
    },

    methods: {
        async switchMenu(menu, resource, type) {
            this.menu = menu;

            if (true === this.shouldWait && this[menu].length > 0) {
                return;
            }

            this.shouldWait = true;

            setTimeout(() => {
                this.shouldWait = false;
            }, 1000);

            this[menu] = [];

            let data = await this.fetchResource(type, resource);

            this[menu] = this[menu].concat(data);
        },

        async fetchResource(type, resource) {
            let result = await api[resource][type]();

            if (result.status == 200) {
                return result.data;
            }

            return [];
        }
    },

    mounted() {
        this.switchMenu('popular', 'sagas', 'popular');
    }
}
</script>
