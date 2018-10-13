<template>
    <Card
        :link="{ name: 'listen.sagas.show', params: { idOrSlug: saga.slug } }"
        :urlImage="saga.images.cover.main"
        :altImage="saga.name"
        :title="saga.name"
        type="saga"
        :badge="badge"
        :size="size"
        :card-horizontal="horizontal">

        <template slot="stats" v-if="withStats">
            <saga-stats
                :stats="saga.stats"
                :with-icon="true">
            </saga-stats>
        </template>
        <template slot="content" v-if="withAuthor">
            <p>Par {{ saga.authors[0].name }}</p>
        </template>

    </Card>
</template>

<script>
    import Card from '~/components/content/Card.vue';
    import SagaStats from '~/components/saga/SagaStats.vue';

    export default {
        components: {
            Card,
            SagaStats,
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
            saga: {
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

            withAuthor: {
                type: Boolean,
                default: true,
            },
        }
    }
</script>
