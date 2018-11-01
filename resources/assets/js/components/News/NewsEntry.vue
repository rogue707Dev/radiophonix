<template>
    <div class="row">
        <div class="col-12 col-xl-10">

            <h2 class="h1">
                <i class="fa fa-calendar"></i> <span v-html="date"></span>
            </h2>

            <slot></slot>

        </div>
    </div>
</template>

<script>
    export default {
        props: {
            date: {
                required: true,
                type: String,
            }
        }
    };
</script>
