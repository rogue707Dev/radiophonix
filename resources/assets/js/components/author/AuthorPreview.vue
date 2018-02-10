<template>
    <div class="">
        <router-link :to="{ name: 'listen.authors.show', params: { id: author.slug } }" class="d-flex flex-grow-1">
            <div class="">
                <div class="jaquette--petite jaquette--faiseur">
                    <img :src="author.picture.thumb" width="340px" height="340px"/>
                </div>
            </div>
            <div class="justify-content-center">
                <p class="texte-moyen texte-300 texte-bleu-fonce">{{ author.name }}</p>
                <p><text-ellispis :text="author.bio" :size="100"></text-ellispis></p>
                <p class="texte-tres-petit">2 séries (todo)</p>
                teststestes
            </div>
        </router-link>
        <div class="">
            <button><i aria-hidden="true" class="fa fa-heart"></i></button>
            <button><i aria-hidden="true" class="fa fa-plus"></i></button>
        </div>
    </div>
</template>

<script>
import TextEllispis from '~/components/text/TextEllipsis.vue';

export default {
    components: {
        TextEllispis,
    },

    props: ['author'],
}
</script>
