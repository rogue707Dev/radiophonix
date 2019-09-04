<template>
    <div>

        <page-loading v-if="isLoading"></page-loading>

        <team-list v-show="!isLoading" :teams="teams"></team-list>

    </div>
</template>
<script>
    import api from '~/lib/api';
    import TeamList from '~/components/content/List/TeamList';
    import PageLoading from '~/components/Ui/PageLoading.vue';

    export default {
        components: {
            TeamList,
            PageLoading,
        },

        data: () => ({
            teams: [],
            isLoading: true,
        }),

        methods: {
            async load() {
                this.isLoading = true;

                this.teams = await api.teams.all();

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
