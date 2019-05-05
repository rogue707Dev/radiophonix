<template>
    <form @submit.prevent="search">
        <div class="input-group">
            <input class="form-control"
                   v-model="query"
                   placeholder="Rechercher…"
                   aria-describedby="Rechercher">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-fw fa-spinner fa-spin" v-show="isSearching"></i>
                    <i class="fa fa-fw fa-search" v-show="!isSearching"></i>
                </button>
            </div>
        </div>
        <a href="https://www.algolia.com" target="_blank" v-if="algolia" v-feature="'algolia'">
            <img :src="algoliaLogo" alt="Algolia" class="mt-2" />
        </a>
    </form>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        props: {
            algolia: {
                type: String,
                required: false,
                default: '',
            },
        },

        computed: {
            ...mapState('search', [
                'isSearching',
                'lastQuery',
            ]),

            query: {
                get () {
                    if (this.$route.name !== 'search') {
                        return null;
                    }

                    return this.$store.state.search.currentQuery;
                },
                set (value) {
                    this.$store.commit('search/setCurrentQuery', value);
                },
            },

            algoliaLogo() {
                return '/static/images/algolia/algolia-' + this.algolia + '.svg';
            }
        },

        methods: {
            search() {
                this.$store.dispatch(
                    'search/doSearch',
                    this.$store.state.search.currentQuery
                );

                if (this.$route.name !== 'search') {
                    this.$router.push({name: 'search'});
                }
            },
        },

        mounted() {
            if (this.lastQuery && this.$route.name !== 'home') {
                this.query = this.lastQuery;
            }
        }
    }
</script>
