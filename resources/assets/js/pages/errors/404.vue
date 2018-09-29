<template>

    <root-layout>
        <headband
            urlImage="/static/home/faq.jpg"
            title="Erreur 404"
            subtitle="Page introuvable">
        </headband>

        <div class="container">

            <h1 class="h1 mb-4">Sagas populaires</h1>

            <saga-list :sagas="popular"></saga-list>

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

        data() {
            return {
                popular: [],
            }
        },

        methods: {
            async fetchPopular() {
                let result = await api.sagas.popular();

                this.popular = result.data;
            }
        },

        mounted() {
            this.fetchPopular();
        },
    }
</script>
