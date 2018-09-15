<template>
    <div class="layout-conteneur__main">

        <h1 class="h1 mb-4">Section "Publier"</h1>

        <p>Avancement global</p>
        <div class="progress">
            <div class="progress-bar bg-success" role="progressbar"
                 :style="{ width: total + '%'}"
                 :aria-valuenow="total"
                 after-content="Non commencé"
                 aria-valuemin="0" aria-valuemax="100">{{ total }}%</div>
        </div>

        <p class="mt-5">API</p>
        <div class="progress">
            <div class="progress-bar bg-success" role="progressbar"
                 :style="{ width: progress.api + '%'}"
                 :aria-valuenow="progress.api"
                 after-content="Non commencé"
                 aria-valuemin="0" aria-valuemax="100">{{ progress.api }}%</div>
        </div>

        <p class="mt-5">Gestion des sagas</p>
        <div class="progress">
            <div class="progress-bar bg-success" role="progressbar"
                 :style="{ width: progress.sagas + '%'}"
                 :aria-valuenow="progress.sagas"
                 after-content="Non commencé"
                 aria-valuemin="0" aria-valuemax="100">{{ progress.sagas }}%</div>
        </div>

        <p class="mt-5">Gestion des collections (saisons)</p>
        <div class="progress">
            <div class="progress-bar bg-success" role="progressbar"
                 :style="{ width: progress.collections + '%'}"
                 :aria-valuenow="progress.collections"
                 after-content="Non commencé"
                 aria-valuemin="0" aria-valuemax="100">{{ progress.collections }}%</div>
        </div>

        <p class="mt-5">Gestion du profil</p>
        <div class="progress">
            <div class="progress-bar bg-success" role="progressbar"
                 :style="{ width: progress.authors + '%'}"
                 :aria-valuenow="progress.authors"
                 after-content="Non commencé"
                 aria-valuemin="0" aria-valuemax="100">{{ progress.authors }}%</div>
        </div>

        <p class="mt-5">Publication automatique</p>
        <div class="progress">
            <div class="progress-bar bg-success" role="progressbar"
                 :style="{ width: progress.publish + '%'}"
                 :aria-valuenow="progress.publish"
                 after-content="Non commencé"
                 aria-valuemin="0" aria-valuemax="100">{{ progress.publish }}%</div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                progress: {
                    api: 80,
                    sagas: 0,
                    collections: 0,
                    authors: 0,
                    publish: 70,
                }
            }
        },

        computed: {
            total() {
                let progress = this.progress;
                let quantity = 0;

                let total = Object.keys(progress).reduce(function (previous, key) {
                    quantity++;
                    return previous + progress[key];
                }, 0);

                return Math.round(total / quantity);
            }
        }
    }
</script>
