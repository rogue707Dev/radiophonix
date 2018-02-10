<template>
    <svg :width="sizeWidth" :height="sizeHeight" :id="id">
        <use :xlink:href="href"/>
    </svg>
</template>

<script>
    export default {
        props: {
            name: {
                type: String,
                required: true
            },
            id: String,
            width: {
                type: [Number, String],
                default: 30
            },
            height: {
                type: [Number, String],
                default: 30
            },
        },
        computed: {
            sizeWidth() {
                return this.width + 'px';
            },

            sizeHeight() {
                return this.height + 'px';
            },

            href() {
                return '#' + this.name;
            }
        }
    }
</script>
