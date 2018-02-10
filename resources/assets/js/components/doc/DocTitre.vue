<template>
    <h2 class="h2">
            <a :href="fullUrl">
                <slot></slot>
            </a>
        </h2>
</template>

<script>
export default {
    props: ['url'],

    computed: {
        fullUrl: function() {
            return 'http://getbootstrap.com/docs/4.0' + this.url;
        }
    }
}
</script>
