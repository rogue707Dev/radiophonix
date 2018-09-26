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

            <saga-list :sagas="genre.sagas"></saga-list>

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
        };
    },

    methods: {
        async fetchGenre() {
            let result = await api.genres.get(this.$route.params.id);

            this.genre = result.data;
        },
    },

    created() {
        this.fetchGenre();
    }
}
</script>

<style>

</style>
