<template>
    <span class="nav-link"
          :class="{ active: active }"
          @click="$emit('click')">
        <slot></slot>
    </span>
</template>

<script>
    export default {
        props: {
            active: {
                type: Boolean,
                required: true,
            }
        }
    }
</script>
