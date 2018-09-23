<template>
    <div class="list-card">
<!--
        <saga-list-item
            v-for="saga in sagas"
            :saga="saga"
            :key="saga.id">
        </saga-list-item>
-->
        <Card
                v-for="saga in sagas"
                :key="saga.id"
                :link="{ name: 'listen.sagas.show', params: { idOrSlug: saga.slug } }"
                :urlImage="saga.images.cover.main"
                :altImage="saga.name"
                :title="saga.name"
                type="saga">

            <template slot="stats">
                <saga-stats
                        :stats="saga.stats"
                        :with-icon="true">
                </saga-stats>
            </template>
            <template slot="content">
                <p>Par {{ saga.author.name }}</p>
            </template>

        </Card>

    </div>
</template>

<script>
import SagaListItem from '~/components/saga/SagaListItem.vue';
import SagaStats from '~/components/saga/SagaStats.vue';
import Card from '~/components/content/Card.vue';

export default {
    components: {
        SagaListItem,
        SagaStats,
        Card,
    },

    props: {
        sagas: {
            type: Array
        }
    }
}
</script>
