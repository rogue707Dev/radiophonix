<template>
    <div>

        <banner
                :title="genre.name"
                subtitle="Genres">

            <template slot="image">
                <cover
                        size="banniere"
                        type="genre"
                        :urlImage="genre.image.main"
                        :altImage="genre.name">
                </cover>
            </template>

        </banner>

        <div class="container">

            <saga-list :sagas="genre.sagas"></saga-list>

        </div>

    </div>
</template>

<script>
import api from '~/lib/api';
import Banner from '~/components/content/Banner.vue';
import SagaList from '~/components/saga/SagaList.vue';
import Cover from '~/components/content/Cover.vue';

export default {
    components: {
        Banner,
        SagaList,
        Cover,
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
