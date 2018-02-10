<template>
    <div class="">
        <div class="">
            <div class="jaquette--petite jaquette--episode">
                <img :src="track.collection.saga.images.cover.thumb" alt="" width="340px" height="340px"/>
            </div>
        </div>
        <div class="">
            <p class="texte-moyen texte-300 texte-bleu-fonce a-curseur" @click="play({track, saga: track.collection.saga})">
                {{ track.title }}
            </p>
            <p>{{ track.collection.saga.name }}</p>
            <p class="texte-tres-petit">
                <length :seconds="track.seconds"></length>
            </p>
        </div>
        <div class="">
            <button><i aria-hidden="true" class="fa fa-heart"></i></button>
            <button><i aria-hidden="true" class="fa fa-plus"></i></button>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex';
import TrackLength from '~/components/track/Length.vue';

export default {
    props: ['track'],

    components: {
        'length': TrackLength
    },

    methods: mapActions('player', [
        'play'
    ]),
}

</script>
