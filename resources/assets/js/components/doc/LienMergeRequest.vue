<template>
    <a :href="url" class="lien-paragraphe">
        <slot></slot>
    </a>
</template>

<script>
    export default {
        props: {
            num: {
                type: Number,
                required: true,
            }
        },

        computed: {
            url() {
                return 'https://gitlab.com/Radiophonix/Radiophonix/merge_requests/' + this.num;
            }
        },
    }
</script>
