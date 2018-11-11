<template>
    <Card
        :link="{ name: 'listen.authors.show', params: { id: author.slug } }"
        :urlImage="author.picture.thumb"
        :altImage="author.name"
        :title="author.name"
        type="auteur"
        :badge="badge"
        :size="size"
        :card-horizontal="horizontal">

        <template slot="stats" v-if="withStats">
            <i aria-hidden="true" class="fa fa-microphone"></i>
            {{ author.stats.sagas }}
            <template v-if="author.stats.sagas > 1">Sagas</template>
            <template v-else>Saga</template>
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
