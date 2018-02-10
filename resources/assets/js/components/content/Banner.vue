<template>

    <div class="banniere">
        <div class="banniere__zone-visuel text-center">

            <slot name="image"></slot>

        </div>
        <div class="banniere__zone-contenu centrage-parent">
            <div class="centrage-enfant text-center text-lg-left">

                <div class="texte-moyen texte-300">{{ subtitle }}</div>
                <h1 class="texte-tres-grand texte-300">{{ title }}</h1>

                <slot></slot>

            </div>
        </div>
    </div>


</template>

<script>
export default {
    props: {
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
