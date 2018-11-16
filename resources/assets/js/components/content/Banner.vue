<template>
    <div class="bg-light">
        <div class="container banniere">

            <div class="banniere__fond" :class="{'var--saga': type == 'saga', 'var--genre': type == 'genre'}"></div>

            <div class="banniere__visuel">
                <slot class="banniere__test" name="image"></slot>
            </div>

            <!--
            <div class="banniere__zone-visuel text-center">
                <slot name="image"></slot>
            </div>-->

            <div class="banniere__zone-contenu">
                <div class="text-center text-md-left">

                    <h2 class="h1">
                        <slot name="subtitle"></slot>
                    </h2>
                    <h1 class="display-2">{{ title }}</h1>

                    <slot></slot>

                </div>
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
        type: {
            type: String,
            require: false
        }
    }
}
</script>
