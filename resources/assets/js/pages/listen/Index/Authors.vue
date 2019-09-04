<template>
    <div>

        <page-loading v-if="isLoading"></page-loading>

        <author-list v-show="!isLoading" :authors="authors"></author-list>

    </div>
</template>
<script>
    import api from '~/lib/api';
    import AuthorList from '~/components/author/AuthorList.vue';
    import PageLoading from '~/components/Ui/PageLoading.vue';

    export default {
        components: {
            AuthorList,
            PageLoading,
        },

        data: () => ({
            authors: [],
            isLoading: true,
        }),

        methods: {
            async load() {
                this.isLoading = true;

                this.authors = await api.authors.all();

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
