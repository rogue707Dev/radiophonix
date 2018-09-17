<template>
    <div class="marquee-container"
         @mouseenter="onEnter"
         @mouseleave="onLeave">
        <div :style="styles" v-html="text"></div>
    </div>
</template>

<script>
    export default {
        props: {
            'text': {
                type: String,
                required: true,
            },
        },

        data: () => ({
            isActive: false,
            right: 0,
        }),

        computed: {
            styles() {
                return {
                    right: this.right + 'px',
                };
            }
        },

        methods: {
            init() {
                this.right = 0;
                this.isActive = false;
            },

            onEnter() {
                this.isActive = true;
                this.loop();
            },

            onLeave() {
                this.init();
            },

            loop() {
                if (!this.isActive) {
                    return;
                }

                let x = parseFloat(this.right);
                x++;

                let thisOffsetWidth = parseFloat(this.$el.offsetWidth) + 10;

                if (x > thisOffsetWidth) {
                    x = 0;
                }

                this.right = x;

                requestAnimationFrame(this.loop.bind(this));
            }
        },

        mounted() {
            this.init();
        },
    }
</script>

<style scoped>
    .marquee-container {
        overflow: hidden;
        white-space: nowrap;
    }

    .marquee-container div {
        position: relative;
    }
</style>
