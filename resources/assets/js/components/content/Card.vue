<template>

    <router-link
            :to="link"
            :class="{'var--horizontal': cardHorizontal}"
            class="card">


        <div class="card-cover">
            <cover
                    :size="size"
                    :type="type"
                    :urlImage="urlImage"
                    :altImage="altImage">
            </cover>
        </div>
        <div class="card-button">
<!--            à remettre une fois l'issue #166 fait-->
<!--            <button aria-hidden="true" class="fa fa-heart"></button>-->
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
        </div>
    </router-link>

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
