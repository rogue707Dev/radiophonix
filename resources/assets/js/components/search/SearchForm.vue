<template>
    <form @submit.prevent="search">
        <div class="input-group">
            <input class="form-control"
                   v-model="query"
                   placeholder="Rechercher…"
                   aria-describedby="Rechercher">
            <div class="input-group-append">
                <button class="btn btn-homepage" type="submit">
                    <i class="fa fa-fw fa-spinner fa-spin" v-show="isSearching"></i>
                    <i class="fa fa-fw fa-search" v-show="!isSearching"></i>
                </button>
            </div>
        </div>
    </form>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        data: () => ({
            query: '',
        }),

        computed: {
            ...mapState('search', [
                'isSearching',
            ]),
        },

        methods: {
            search() {
                this.$store.dispatch('search/doSearch', this.query);

                if (this.$route.name !== 'search') {
                    this.$router.push({
                        name: 'search',
                        params: {
                            query: this.query,
                        }
                    });
                }
            },
        },

        mounted() {
            if (this.$route.params.query) {
                this.query = this.$route.params.query;
            }
        }
    }
</script>
