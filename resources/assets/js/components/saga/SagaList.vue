<template>
    <div class="list-card">
        <card-saga v-for="saga in sagas"
                   :key="saga.id"
                   :saga="saga"></card-saga>
    </div>
</template>

<script>
import CardSaga from '~/components/content/Card/CardSaga';

export default {
    components: {
        CardSaga,
    },

    props: {
        sagas: {
            type: Array
        }
    }
}
</script>
