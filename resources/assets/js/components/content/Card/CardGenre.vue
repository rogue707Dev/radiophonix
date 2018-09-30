<template>
    <Card
        :link="{ name: 'listen.genres.show', params: { id: genre.id } }"
        :urlImage="genre.image.main"
        :altImage="genre.name"
        :title="genre.name"
        type="genre"
        :badge="badge"
        :size="size"
        :card-horizontal="horizontal">

        <template slot="stats" v-if="withStats">
            <i aria-hidden="true" class="fa fa-file-audio-o"></i>
            {{ genre.stats.sagas }} Séries
        </template>

    </Card>
</template>

<script>
    import Card from '~/components/content/Card.vue';

    export default {
        components: {
            Card,
        },

        computed: {
            size() {
                if (this.horizontal) {
                    return 'petit';
                }

                return 'moyen';
            }
        },

        props: {
            genre: {
                type: Object,
                required: true,
            },

            badge: {
                type: Boolean,
                default: false,
            },

            horizontal: {
                type: Boolean,
                default: false,
            },

            withStats: {
                type: Boolean,
                default: true,
            },
        }
    }
</script>
