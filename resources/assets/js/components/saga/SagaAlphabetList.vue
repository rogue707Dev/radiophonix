<template>
    <div>
        <div v-for="(sagas, key, index) in letters" :key="index" v-if="sagas.length > 0">
            <h1 class="display-1">{{ key.toUpperCase() }}</h1>
            <saga-list :sagas="sagas"></saga-list>
        </div>
    </div>
</template>

<script>
import SagaList from '~/components/saga/SagaList.vue';

export default {
    components: {
        SagaList,
    },

    props: {
        sagas: {
            type: Array
        }
    },

    computed: {
        letters() {
            let alphabet = 'abcdefghijklmnopqrstuvwxyz'.split('');
            let out = {};

            for (let i = 0; i < alphabet.length; i++) {
                const letter = alphabet[i];

                out[letter] = this.sagas.filter(saga => saga.name.charAt(0).toLowerCase() === letter);
            }

            return out;
        }
    }
}
</script>
