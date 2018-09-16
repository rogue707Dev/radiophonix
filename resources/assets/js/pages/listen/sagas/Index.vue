<template>
    <div class="layout-conteneur__main">

        <ul class="navigation">
            <li :class="{ actif: menu == 'popular' }" @click="switchMenu('popular', 'sagas', 'popular')">Populaire</li>
            <li :class="{ actif: menu == 'recent' }" @click="switchMenu('recent', 'sagas', 'recent')">Nouveau</li>
            <li :class="{ actif: menu == 'authors' }" @click="switchMenu('authors', 'authors', 'all')">Faiseurs</li>
            <li :class="{ actif: menu == 'genres' }" @click="switchMenu('genres', 'genres', 'all')">Genres</li>
            <li :class="{ actif: menu == 'discover' }" @click="switchMenu('discover', 'sagas', 'discover')">Découvrir</li>
        </ul>

        <saga-list v-show="menu == 'popular'" :sagas="popular"></saga-list>

        <saga-list v-show="menu == 'recent'" :sagas="recent"></saga-list>

        <saga-alphabet-list v-show="menu == 'discover'" :sagas="discover"></saga-alphabet-list>

        <author-list v-show="menu == 'authors'" :authors="authors"></author-list>

        <ul class="liste-jaquette" v-show="menu == 'genres'">
            <li v-for="genre in genres" :key="genre.id">
                <router-link :to="{ name: 'listen.genres.show', params: { id: genre.id } }">
                    <div class="pr jaquette--genre jaquette--grande">
                        <img :src="genre.image.main" alt="" class="img__filtre-assombri">
                        <div class="pa__filtre-bleu"></div>
                        <div class="pa-centrer">
                            <p class="text-white">{{ genre.name }}</p>
                        </div>
                    </div>
                </router-link>
            </li>
        </ul>

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
