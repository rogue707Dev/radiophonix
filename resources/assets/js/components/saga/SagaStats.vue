<template>
    <span>
        <i aria-hidden="true" class="fa fa-music" v-if="withIcon"></i>
        {{ albums }}
        <template v-if="albums > 1">Saisons</template>
        <template v-else>Saison</template>
        -
        {{ tracks }}
        Épisodes
    </span>
</template>

<script>
export default {
    props: {
        stats: {
            type: Object,
            required: true,
        },

        withIcon: {
            type: Boolean,
            required: false,
            default: false,
        }
    },

    computed: {
        albums() {
            return this.stats.albums || 0;
        },

        tracks() {
            return this.stats.tracks || 0;
        }
    }
}
</script>

<style>

</style>
