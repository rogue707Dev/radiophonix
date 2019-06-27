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

                <nav-item :active="$route.name === 'listen.sagas.index' || $route.name === 'listen.home'">
                    <router-link :to="{ name: 'listen.sagas.index' }">
                        Sagas
                    </router-link>
                </nav-item>

                <nav-item :active="$route.name === 'listen.authors.index'">
                    <router-link :to="{ name: 'listen.authors.index' }">
                        Auteurs
                    </router-link>
                </nav-item>

                <nav-item :active="$route.name === 'listen.teams.index'">
                    <router-link :to="{ name: 'listen.teams.index' }">
                        Équipes
                    </router-link>
                </nav-item>

                <nav-item :active="$route.name === 'listen.genres.index'">
                    <router-link :to="{ name: 'listen.genres.index' }">
                        Genres
                    </router-link>
                </nav-item>
            </nav-list>

            <router-view></router-view>

        </div>
    </div>
</template>

<script>
    import Headband from '~/components/content/Headband.vue';
    import SearchForm from '~/components/search/SearchForm';
    import NavList from '~/components/Ui/Nav/NavList';
    import NavItem from '~/components/Ui/Nav/NavItem';

    export default {
        components: {
            Headband,
            SearchForm,
            NavList,
            NavItem,
        },
    }
</script>
