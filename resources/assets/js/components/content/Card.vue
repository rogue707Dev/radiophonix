<template>

    <div class="card var--survol" :class="{'var--horizontal': cardHorizontal}">
        <div class="card-cover">
            <cover
                    :size="size"
                    :type="type"
                    :urlImage="urlImage"
                    :altImage="altImage">
            </cover>
        </div>
        <div class="card-button">
            <button aria-hidden="true" class="fa fa-heart"></button>
        </div>
        <div class="card-body">
            <span v-if="badge" class="badge badge-light badge-sm text-capitalize">{{ type }}</span>
            <p class="h3 text-body">
                {{ title }}
            </p>
            <p class="text-primary h5">
                <slot name="stats"></slot>
            </p>
            <slot name="content"></slot>
            <router-link :to="link" class="pa-cover"><span class="sr-only">{{ title }}</span></router-link>
        </div>
    </div>

</template>

<script>
import Cover from '~/components/content/Cover.vue';

export default {
    components: {
        Cover,
    },

    props: {
        cardHorizontal: {
            type: Boolean,
            required: false
        },
        link: {
            type: Object,
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
        title: {
            type: String,
            required: true
        },
        type: {
            type: String,
            required: true
        },
        size: {
            type: String,
            required: true
        },
        badge: {
            type: Boolean,
            required: false,
        },
    }
}
</script>
