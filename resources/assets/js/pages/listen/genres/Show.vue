<template>
    <div>

        <banner
                :title="genre.name"
                subtitle="Genres">

            <template slot="image">
                <div class="pr jaquette--genre jaquette--grande">
                    <img :src="genre.image.main" alt="" class="img__filtre-assombri">
                    <div class="pa__filtre-bleu"></div>
                </div>
            </template>

        </banner>

        <div class="layout-conteneur__main">

            <saga-list :sagas="sagas"></saga-list>

        </div>

    </div>
</template>

<script>
import api from '~/lib/api';
import Banner from '~/components/content/Banner.vue';
import SagaList from '~/components/saga/SagaList.vue';

export default {
    components: {
        Banner,
        SagaList,
    },

    data() {
        return {
            genre: {
                image: {}
            },
            sagas: [],
        };
    },

    methods: {
        async fetchGenre() {
            let result = await api.genres.get(this.$route.params.id);

            this.genre = result.data;
        },

        async fetchSagas() {
            let result = await api.sagas.all();

            this.sagas = result.data;
        }
    },

    created() {
        this.fetchGenre();
        this.fetchSagas();
    }
}
</script>

<style>

</style>
