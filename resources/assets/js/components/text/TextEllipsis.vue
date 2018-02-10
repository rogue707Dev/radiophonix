<template>
    <span :title="text">{{ truncated }}</span>
</template>

<script>
export default {
    props: {
        text: {
            type: String,
            required: false
        },
        size: {
            type: Number,
            required: true
        }
    },

    computed: {
        truncated() {
            let text = this.text;

            text = text.trim();

            if (text.length <= this.size) {
                return text;
            }

            text = text.substring(0, this.size);
            text = text.trim();
            text = text.replace(/^,|,$/g, '');

            return text + '...';
        }
    }
}
</script>

