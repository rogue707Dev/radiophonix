<template>
    <h1 class="h1 mt-5">
        <a :href="fullUrl">
            <slot></slot>
        </a>
    </h1>
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
