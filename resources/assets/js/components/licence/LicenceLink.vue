<template>
    <a :href="url"
       title="Creative commons">
        <i aria-hidden="true" class="fa fa-creative-commons"></i>&nbsp;{{ name }}
    </a>
</template>

<script>
export default {
    props: {
        licence: {
            type: Object,
            required: true,
        }
    },

    computed: {
        url() {
            return this.licence.url;
        },

        name() {
            return this.licence.name.substr(3, this.licence.name.lenght);
        }
    }
}
</script>
