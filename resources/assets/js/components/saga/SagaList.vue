<template>
    <ul class="liste-jaquette saga">
        <saga-list-item
            v-for="saga in sagas"
            :saga="saga"
            :key="saga.id">
        </saga-list-item>
    </ul>
</template>

<script>
import SagaListItem from '~/components/saga/SagaListItem.vue';

export default {
    components: {
        SagaListItem,
    },

    props: {
        sagas: {
            type: Array
        }
    }
}
</script>
