<template>
    <li>
        <i class="fa fa-fw"
           :class="iconClass"
           :title="title"
           v-b-tooltip.hover.left
           aria-hidden="true"></i>
        <slot></slot>
    </li>
</template>

<script>
    export default {
        props: {
            status: {
                type: String,
                required: true,
                validate: val => ['todo', 'doing', 'done'].includes(val),
            },
        },

        computed: {
            iconClass() {
                if (this.status === 'done') {
                    return 'fa-check-circle text-success';
                }

                if (this.status === 'doing') {
                    return 'fa-play-circle text-warning';
                }

                return 'fa-stop-circle text-info';
            },

            title() {
                if (this.status === 'done') {
                    return 'fait !';
                }

                if (this.status === 'doing') {
                    return 'en cours';
                }

                return 'à faire';
            },
        }
    }
</script>
