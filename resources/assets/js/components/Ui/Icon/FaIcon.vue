<template>
    <span>
        <span :class="{'sr-only': !showLabel}">{{ label }}</span>
        <i aria-hidden="true" class="fa" :class="icon"></i>
    </span>
</template>

<script>
    export default {
        props: {
            label: {
                type: String,
                required: true,
            },

            icon: {
                type: String,
                required: true,
            },

            showLabel: {
                type: Boolean,
                required: false,
                default: false,
            }
        },
    }
</script>
