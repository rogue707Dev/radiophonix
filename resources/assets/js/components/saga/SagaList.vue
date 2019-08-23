<template>
    <div class="list-card">
        <card-saga v-for="saga in sagas"
                   :key="saga.id"
                   :saga="saga"></card-saga>

        <Card v-if="showMoreCard"
              :link="{ name: 'listen.home' }"
              title="En voir plus..."
              size="moyen"
              type="saga">
        </Card>
    </div>
</template>

<script>
import CardSaga from '~/components/content/Card/CardSaga';
import Card from "~/components/content/Card";

export default {
    components: {
        Card,
        CardSaga,
    },

    props: {
        sagas: {
            type: Array,
            required: true,
        },

        showMoreCard: {
            type: Boolean,
            required: false,
            default: false,
        },
    },
}
</script>
