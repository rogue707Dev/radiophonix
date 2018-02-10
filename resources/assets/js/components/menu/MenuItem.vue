<template>
    <router-link :to="to" tag="li" :class="clazz">
        <rp-icon :name="icon" width="30" height="30"></rp-icon>
        <slot></slot>
    </router-link>
</template>

<script>
    export default {
        props: {
            route: {
                type: String,
                required: true
            },
            name: {
                type: String,
                required: true
            },
            icon: {
                type: String,
                required: true
            },
        },

        computed: {
            to() {
                return {
                    name: this.route
                };
            },

            clazz() {
                return {
                    actif: this.$route.meta.menu === this.name
                };
            }
        }
    }
</script>
