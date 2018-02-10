<template>

    <div class="bandeau pr" v-bind:style="{ backgroundImage: 'url(' + urlImage + ')' }">
        <div class="pa__filtre-bleu"></div>
        <div class="pa-cover centrage-parent">
            <div class="centrage-enfant">
                <div class="bandeau__titre">
                    {{ title }}
                </div>
                <div class="bandeau__sous-titre">
                    {{ subtitle }}
                </div>
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
