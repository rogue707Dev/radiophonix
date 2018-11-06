<template>
    <a :href="url"
       title="Creative commons">
        <i aria-hidden="true" class="fa fa-creative-commons"></i>&nbsp;{{ name }}
    </a>
</template>

<script>
import { licenceUrl } from '~/lib/services/licence';

export default {
    props: {
        licence: {
            type: String,
            required: true,
        }
    },

    computed: {
        url() {
            return licenceUrl(this.licence || '');
        },

        name() {
            return this.licence.substr(3, this.licence.lenght);
        }
    }
}
</script>
