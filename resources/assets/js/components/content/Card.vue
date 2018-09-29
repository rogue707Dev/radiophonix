<template>

    <router-link
            :to="link"
            :class="{'var--horizontal': cardHorizontal}"
            class="card">
        <div class="card-jacket" :class="['var--'+type]">
            <div :class="{'jaquette--petite': cardHorizontal, 'jaquette--moyen': !cardHorizontal, ['jaquette--'+type]: true}">
                <template v-if="type == 'saga'">
                    <div class="jaquette--card">
                        <img :src="urlImage" :alt="altImage">
                    </div>
                </template>
                <template v-else>
                    <img :src="urlImage" :alt="altImage">
                </template>
            </div>
            <template v-if="type == 'genre'">
                <div class="pa-centrer">
                    <template v-if="cardHorizontal">
                        <svg width="90px" height="79px">
                            <use xlink:href="#contour-genre"></use>
                        </svg>
                    </template>
                    <template v-else>
                        <svg width="167px" height="145px">
                            <use xlink:href="#contour-genre"></use>
                        </svg>
                    </template>
                </div>
            </template>
        </div>
        <div class="card-button">
            <i aria-hidden="true" class="fa fa-plus"></i>
            <i aria-hidden="true" class="fa fa-heart"></i>
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
export default {
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
        badge: {
            type: Boolean,
            required: false,
        },
    }
}
</script>
