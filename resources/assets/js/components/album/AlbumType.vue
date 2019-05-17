<template>
    <span>{{ label }}</span>
</template>

<script>
    const mapping = {
        season: 'Saisons',
        bloopers: 'Bêtisiers',
        bonus: 'Bonus',
        music: 'Musiques',
        making_of: 'Making of',
    };

    export default {
        props: {
            type: {
                type: String,
                required: true
            }
        },

        computed: {
            label() {
                return mapping[this.type];
            }
        }
    }
</script>
