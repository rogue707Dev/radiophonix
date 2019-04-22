<template>
    <a href="https://discord.gg/vF5Y7qD">
        <img v-if="withIcon"
             height="25"
             src="/static/images/discord/discord-full-color.svg"
             alt="Lien invitation Discord">
        <slot v-else></slot>
    </a>
</template>

<script>
    export default {
        props: {
            withIcon: {
                type: Boolean,
                default: true,
            },
        },
    }
</script>
