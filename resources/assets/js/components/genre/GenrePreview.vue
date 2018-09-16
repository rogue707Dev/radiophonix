<template>
    <div class="">
        <div class="">
            <div class="jaquette--petite jaquette--genre">
                <img :src="genre.image.main" alt="" width="340px" height="340px"/>
            </div>
        </div>
        <div class="justify-content-center">
            <p class="h2">{{ genre.name }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: ['genre']
}
</script>
