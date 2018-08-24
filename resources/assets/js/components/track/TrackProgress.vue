<template>
    <div>
        <progress max="100" :value="seconds"></progress>
    </div>
</template>

<script>
    export default {
        props: {
            track: {
                type: Object,
                required: true,
            }
        },

        computed: {
            seconds() {
                return this.store.state.tick.ticks[this.track.id];
            }
        },
    }
</script>
