<template>
    <div>

        <page-loading v-if="isLoading"></page-loading>

        <div class="list-card">

            <card-genre v-for="genre in genres"
                        :key="genre.id"
                        :genre="genre"></card-genre>

        </div>

    </div>
</template>
<script>
    import api from '~/lib/api';
    import CardGenre from '~/components/content/Card/CardGenre';
    import PageLoading from '~/components/Ui/PageLoading.vue';

    export default {
        components: {
            CardGenre,
            PageLoading,
        },

        data: () => ({
            genres: [],
            isLoading: true,
        }),

        methods: {
            async load() {
                this.isLoading = true;

                this.genres = await api.genres.all();

                this.isLoading = false;
            }
        },

        created() {
            this.load();
        },

        watch: {
            '$route': 'load'
        },
    }
</script>
