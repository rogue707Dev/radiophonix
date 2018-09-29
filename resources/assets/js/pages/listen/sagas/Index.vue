<template>
    <div>
        <headband
                urlImage="/static/home/radio.jpg"
                title="Écouter">
            <div class="search-headband">
                <search-form></search-form>
            </div>
        </headband>

        <div class="container">

        <nav-list class="mb-4">
            <nav-item :active="menu == 'popular'" @click="switchMenu('popular', 'sagas', 'popular')">Populaire</nav-item>
            <nav-item :active="menu == 'recent'" @click="switchMenu('recent', 'sagas', 'recent')">Nouveau</nav-item>
            <nav-item :active="menu == 'authors'" @click="switchMenu('authors', 'authors', 'all')">Faiseurs</nav-item>
            <nav-item :active="menu == 'genres'" @click="switchMenu('genres', 'genres', 'all')">Genres</nav-item>
            <nav-item :active="menu == 'discover'" @click="switchMenu('discover', 'sagas', 'discover')">Découvrir</nav-item>
        </nav-list>

        <saga-list v-show="menu == 'popular'" :sagas="popular"></saga-list>

        <saga-list v-show="menu == 'recent'" :sagas="recent"></saga-list>

        <saga-alphabet-list v-show="menu == 'discover'" :sagas="discover"></saga-alphabet-list>

        <author-list v-show="menu == 'authors'" :authors="authors"></author-list>

        <div class="list-card" v-show="menu == 'genres'">

            <Card
                    v-for="genre in genres"
                    :key="genre.id"
                    :link="{ name: 'listen.genres.show', params: { id: genre.id } }"
                    :urlImage="genre.image.main"
                    :altImage="genre.name"
                    :title="genre.name"
                    type="genre">

                <template slot="stats">
                    <i aria-hidden="true" class="fa fa-file-audio-o"></i> {{ genre.stats.sagas }} Sagas
                </template>

            </Card>

        </div>

    </div>
    </div>
</template>

<script>
import api from '~/lib/api';
import SagaList from '~/components/saga/SagaList.vue';
import AuthorList from '~/components/author/AuthorList.vue';
import SagaAlphabetList from '~/components/saga/SagaAlphabetList.vue';
import Card from '~/components/content/Card.vue';
import NavList from '~/components/Ui/Nav/NavList';
import NavItem from '~/components/Ui/Nav/NavItem';
import Headband from '~/components/content/Headband.vue';
import SearchForm from '~/components/search/SearchForm';

export default {
    components: {
        SagaList,
        AuthorList,
        SagaAlphabetList,
        Card,
        NavList,
        NavItem,
        Headband,
        SearchForm,
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
