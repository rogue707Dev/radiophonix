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

        <template slot="buttons">
            <like-button likeable-type="saga"
                         class="btn-reset text-body"
                         :likeable-id="saga.id"/>
        </template>
        <template slot="stats" v-if="withStats">
            <saga-stats
                :stats="saga.stats"
                :with-icon="true">
            </saga-stats>
        </template>
        <template slot="content" v-if="withAuthor">
            <p>
                Par
                <router-link v-if="saga.authors[0].id"
                             :to="{ name: 'listen.authors.show', params: { id: saga.authors[0].slug } }">
                    {{ saga.authors[0].name }}
                </router-link>
                <router-link v-if="saga.team"
                             :to="{ name: 'listen.teams.show', params: { id: saga.team.slug } }">
                    ({{ saga.team.name }})
                </router-link>
            </p>
        </template>

    </Card>
</template>

<script>
    import Card from '~/components/content/Card.vue';
    import SagaStats from '~/components/saga/SagaStats.vue';
    import LikeButton from "~/components/Like/LikeButton";

    export default {
        components: {
            Card,
            SagaStats,
            LikeButton,
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
