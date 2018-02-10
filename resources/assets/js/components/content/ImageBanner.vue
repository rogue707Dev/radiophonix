<template>
    <div class="mb-5 image-banner" :style="background">
        <h2 class="titre--bloc">{{ title }}</h2>
        <p class="mb-5">
            {{ subtitle }}
        </p>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            require: true,
        },

        subtitle: {
            type: String,
            require: true,
        },

        image: {
            type: String,
            require: true,
        },

        imagePosition: {
            type: String,
            require: false,
            default: 'center'
        }
    },

    computed: {
        background() {
            return {
                background: `rgba(0, 0, 0, 0) url("${this.image}") repeat scroll 0% ${this.imagePosition} / cover`
            };
        }
    }
}
</script>

<style lang="scss" scoped>
.image-banner {
    height: 300px;
    color: rgb(255, 255, 255);
    padding-left: 60px;
    padding-top: 90px;

    .titre--bloc {
        color: rgb(255, 255, 255);
        font-size: 50px;
    }

    p {
        font-size: 22px;
    }
}
</style>
