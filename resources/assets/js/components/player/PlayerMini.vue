<template>

    <div class="layout-sidebar__lecteur-mini" v-if="currentTrack.id">

        <div class="lecteur-mini">
            <div class="lecteur-mini__visuel">
                <img width="320px" height="320px"
                     class="img__filtre-grayscale"
                     :src="currentSaga.images.cover.main || '/static/dev/images/platine.jpg'"
                     :alt="currentSaga.name">
            </div>
            <div class="lecteur-mini__media centrage-parent">
                <div class="centrage-enfant">
                    <p class="titre-episode-lecteur">{{ currentTrack.title || 'Radiophonix' }}</p>
                    <div class="texte-blanc">
                        <p v-if="currentSaga.name">
                            <i>{{ currentSaga.name }}</i>
                        </p>
                        <p v-if="currentTrack.id" class="texte-petit">
                            <template v-if="currentSaga.stats.collections > 1">
                                Saison {{ currentCollection.number }} - Épisode {{ currentTrack.number }}
                            </template>
                            <template v-else>
                                Épisode {{ currentTrack.number }}
                            </template>
                        </p>
                    </div>
                </div>
            </div>
            <div class="lecteur-mini__bouton">
                <div class="btn-panel-conteneur" @click="toggleButton"
                     :class="{ 'actif': isButtonDeploy }">
                    <button class="btn-panel-0 btn-blanc btn-rond-grand"><i aria-hidden="true" class="fa fa-bars"></i></button>
                    <button class="btn-panel-1 btn-blanc btn-rond-moyen" @click="next"><i aria-hidden="true" class="fa fa-step-forward"></i></button>
                    <button class="btn-panel-2 btn-blanc btn-rond-moyen" @click="toggle"><i aria-hidden="true" class="fa" :class="{'fa-play': !isPlaying, 'fa-pause': isPlaying}"></i></button>
                    <button class="btn-panel-3 btn-blanc btn-rond-moyen" @click="previous"><i aria-hidden="true" class="fa fa-step-backward"></i></button>
                </div>
            </div>
        </div>

    </div>


</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    data() {
        return {
            isButtonDeploy: false,
        };
    },

    computed: mapState('player', [
        'isPlaying',
        'currentTrack',
        'currentSaga',
        'currentCollection',
    ]),

    methods: {
        ...mapActions('player', [
            'toggle',
            'next',
            'previous',
        ]),

        toggleButton() {
            this.isButtonDeploy = !this.isButtonDeploy;
        }
    }
}
</script>
