<template>

    <root-layout>
        <headband
            urlImage="/static/home/faq.jpg"
            title="Erreur 404"
            subtitle="Page introuvable">
        </headband>

        <div class="container">

            <h1 class="h1 mb-4">Sagas populaires</h1>

            <p class="lead text-center mt-md-5 mt-5"
               v-if="isLoading">
                <i class="fa fa-spinner fa-spin fa-5x mt-md-5 mb-md-5 mb-4"></i>
                <br/>
                Chargement...
            </p>

            <saga-list v-else :sagas="popular"></saga-list>

        </div>
    </root-layout>

</template>

<script>
    import api from '~/lib/api';
    import RootLayout from '~/components/Ui/Layout/RootLayout';
    import Headband from '~/components/content/Headband';
    import SagaList from '~/components/saga/SagaList';

    export default {
        components: {
            RootLayout,
            Headband,
            SagaList,
        },

        data: () => ({
            popular: [],
            isLoading: true,
        }),

        methods: {
            async fetchPopular() {
                this.popular = await api.sagas.all();

                this.isLoading = false;
            }
        },

        mounted() {
            this.fetchPopular();
        },
    }
</script>
