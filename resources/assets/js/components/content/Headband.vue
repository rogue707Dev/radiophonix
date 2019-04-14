<template>

    <div class="jumbotron var--bg-image" v-bind:style="{ backgroundImage: 'url(' + urlImage + ')' }">
        <div class="jumbotron-bg-image__filtre">
            <div class="container jumbotron-bg-image__content">
                <div class="display-1" v-if="title">{{ title }}</div>
                <div class="display-4" v-if="subtitle">{{ subtitle }}</div>
                <slot></slot>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    props: {
        urlImage: {
            type: String,
            required: false
        },
        title: {
            type: String,
            required: false
        },
        subtitle: {
            type: String,
            require: false
        }
    }
}
</script>
