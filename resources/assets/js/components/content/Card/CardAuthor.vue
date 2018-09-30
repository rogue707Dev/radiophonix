<template>
    <Card
        :link="{ name: 'listen.authors.show', params: { id: author.slug } }"
        :urlImage="author.picture.thumb"
        :altImage="author.name"
        :title="author.name"
        type="faiseur"
        :badge="badge"
        :size="size"
        :card-horizontal="horizontal">

        <template slot="stats" v-if="withStats">
            <i aria-hidden="true" class="fa fa-file-audio-o"></i>
            {{ author.stats.sagas }} Séries
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
            author: {
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
