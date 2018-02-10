<template>
    <div>
        {{ count }}
    </div>
</template>

<script>
export default {
    data() {
        return {
            count: 0
        };
    },

    mounted() {
        setInterval(() => {
            this.count++;
        }, 1000);
    }
}
</script>
