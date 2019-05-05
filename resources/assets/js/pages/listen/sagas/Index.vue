<template>
    <div>
        <headband
                urlImage="/static/home/radio.jpg"
                title="Écouter">
            <div class="search-headband">
                <search-form algolia="dark"></search-form>
            </div>
        </headband>

        <div class="container">

            <nav-list class="mb-4">
                <nav-item :active="menu == 'sagas'" @click="switchMenu('sagas', 'sagas', 'all')">Sagas</nav-item>
                <nav-item :active="menu == 'authors'" @click="switchMenu('authors', 'authors', 'all')">Auteurs</nav-item>
                <nav-item :active="menu == 'teams'" @click="switchMenu('teams', 'teams', 'all')">Équipes</nav-item>
                <nav-item :active="menu == 'genres'" @click="switchMenu('genres', 'genres', 'all')">Genres</nav-item>
            </nav-list>

            <p class="lead text-center mt-md-5 mt-5"
                v-if="isLoading">
                <i class="fa fa-spinner fa-spin fa-5x mt-md-5 mb-md-5 mb-4"></i>
                <br/>
                Chargement...
            </p>

            <template v-if="!isLoading">
                <saga-list v-show="menu === 'sagas'" :sagas="sagas"></saga-list>

                <author-list v-show="menu === 'authors'" :authors="authors"></author-list>

                <team-list v-show="menu === 'teams'" :teams="teams"></team-list>

                <div class="list-card" v-show="menu === 'genres'">

                    <card-genre v-for="genre in genres"
                                :key="genre.id"
                                :genre="genre"></card-genre>

                </div>
            </template>

        </div>
    </div>
</template>

<script>
import api from '~/lib/api';
import SagaList from '~/components/saga/SagaList.vue';
import AuthorList from '~/components/author/AuthorList.vue';
import SagaAlphabetList from '~/components/saga/SagaAlphabetList.vue';
import NavList from '~/components/Ui/Nav/NavList';
import NavItem from '~/components/Ui/Nav/NavItem';
import Headband from '~/components/content/Headband.vue';
import SearchForm from '~/components/search/SearchForm';
import CardGenre from '~/components/content/Card/CardGenre';
import TeamList from '~/components/content/List/TeamList';

export default {
    components: {
        SagaList,
        AuthorList,
        SagaAlphabetList,
        NavList,
        NavItem,
        Headband,
        SearchForm,
        CardGenre,
        TeamList,
    },

    data: () => ({
        menu: 'sagas',
        sagas: [],
        authors: [],
        teams: [],
        genres: [],
        shouldWait: false,
        isLoading: false,
    }),

    methods: {
        async switchMenu(menu, resource, type) {
            this.menu = menu;

            if (true === this.shouldWait && this[menu].length > 0) {
                return;
            }

            this.isLoading = true;
            this.shouldWait = true;

            setTimeout(() => {
                this.shouldWait = false;
            }, 1000);

            this[menu] = [];

            let data = await this.fetchResource(type, resource);

            this[menu] = this[menu].concat(data);

            this.isLoading = false;
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
        this.switchMenu('sagas', 'sagas', 'all');
    }
}
</script>
