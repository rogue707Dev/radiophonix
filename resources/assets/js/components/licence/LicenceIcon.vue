<template>
    <i :class="icon"></i>
</template>

<script>
import { licenceIconClass } from '~/lib/services/licence';

export default {
    props: ['licence'],

    computed: {
        icon() {
            return licenceIconClass(this.licence || '');
        }
    }
}
</script>
