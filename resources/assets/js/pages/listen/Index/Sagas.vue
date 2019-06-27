<template>
    <div>

        <page-loading v-if="isLoading"></page-loading>

        <saga-list v-show="!isLoading" :sagas="sagas"></saga-list>

    </div>
</template>
<script>
    import api from '~/lib/api';
    import SagaList from '~/components/saga/SagaList.vue';
    import PageLoading from '~/components/Ui/PageLoading.vue';

    export default {
        components: {
            SagaList,
            PageLoading,
        },

        data: () => ({
            sagas: [],
            isLoading: true,
        }),

        methods: {
            async load() {
                this.isLoading = true;

                this.sagas = await api.sagas.all();

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
