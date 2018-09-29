<template>

    <div class="cover" :class="['var--'+size, 'var--'+type]">
        <template v-if="type == 'genre'">
            <svg><use xlink:href="#contour-genre"></use></svg>
            <div class="cover__mask">
                <img :src="urlImage" :alt="altImage">
            </div>
        </template>
        <template v-else>
            <div class="cover__mask">
                <img :src="urlImage" :alt="altImage">
            </div>
        </template>
    </div>

</template>

<script>
export default {
    props: {
        size: {
            type: String,
            required: true
        },
        type: {
            type: String,
            required: true
        },
        urlImage: {
            type: String,
            required: false
        },
        altImage: {
            type: String,
            required: false
        },
    }
}
</script>
