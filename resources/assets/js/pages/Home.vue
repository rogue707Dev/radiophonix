<template>
    <div>


        <div class="jumbotron text-center">
            <svg class="logo-home">
                <use class="fill--logo-orange" xlink:href="#logo-part1of2"></use>
                <use class="fill--logo-bleu" xlink:href="#logo-part2of2"></use>
            </svg>
            <div class="display-4 texte-bleu-clair">
                Toutes vos sagas au même endroit
            </div>
            <div class="d-flex justify-content-center my-5">
                <div class="col-10 col-md-6 col-xl-4">
                    <form @submit.prevent="search">
                        <div class="input-group">
                            <input class="form-control form-control-lg" v-model="query" placeholder="Rechercher un faiseur, une saga, un épisode, un thème..." aria-describedby="Rechercher">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">Rechercher</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="layout-conteneur__main">

            <div class="row">
                <div class="col-12">
                    <h2 class="display-4">Qu'est-ce qu'une Saga MP3 ?</h2>
                    <blockquote class="blockquote mb-5">
                        <p class="mb-0X">
                            Une saga mp3 est le nom donné à une histoire se déroulant dans
                            un univers le plus souvent imaginaire, diffusée sur Internet
                            sous la forme d'un ou plusieurs fichiers sonores historiquement
                            encodés au format MP3. La saga MP3 s'éloigne du livre audio,
                            car contrairement à celui-ci, son histoire n'est pas lue mais
                            interprétée et suit davantage le concept des aventures radiophoniques.
                            Rapidement après leur apparition au début des années 2000, le nombre
                            des sagas MP3 en téléchargement libre a explosé.
                        </p>
                        <footer class="blockquote-footer">
                            <a href="https://wiki.netophonix.com/Saga_MP3">
                                Extrait du Netowiki
                            </a>
                        </footer>
                    </blockquote>

                    <h2 class="display-4">Qu'est-ce qu'un faiseur ?</h2>
                    <blockquote class="blockquote mb-5">
                        <p class="mb-0X">
                            blabla
                        </p>
                        <footer class="blockquote-footer">
                            <a href="https://wiki.netophonix.com/Saga_MP3">
                                Extrait du Netowiki
                            </a>
                        </footer>
                    </blockquote>

                </div>
            </div>

        </div>


        <headband
                urlImage="/static/home/ecouter.jpeg"
                title="Écouter"
                subtitle="Découvrez ou redécouvrez des sagas MP3">
        </headband>

        <div class="layout-conteneur__main">
            <div class="row mt-5 mb-5">
                <div class="col-12">
                    <h2 class="display-4 mb-4">Quelques exemples de Saga :</h2>
                    <saga-list :sagas="sagas"></saga-list>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="display-4">Découvrez quelques genres</h2>

                    <div class="row my-5">

                        <div class="col text-center"
                             v-for="genre in getGenresRow(0)" :key="genre.id">
                            <router-link :to="{ name: 'listen.genres.show', params: { id: genre.id } }">
                                <div class="pr jaquette--genre jaquette--grande">
                                    <img :src="genre.image.main" alt="" class="img__filtre-assombri">
                                    <div class="pa__filtre-bleu"></div>
                                    <div class="pa-centrer">
                                        <p class="texte-blanc">{{ genre.name }}</p>
                                    </div>
                                </div>
                            </router-link>
                        </div>

                    </div>

                </div>
            </div>
        </div>







        <headband
                urlImage="/static/home/publier.jpeg"
                title="Publier"
                subtitle="Publiez vos propres sagas directement sur le site">
        </headband>

        <div class="layout-conteneur__main">

            Capture a mettre

        </div>








        <headband
                urlImage="/static/home/contribuer.jpeg"
                title="Contribuer"
                subtitle="Le site est open source sur GitLab et les contributions sont les bienvenues">
        </headband>

        <div class="layout-conteneur__main">
            <div class="row mb-5">
                <div class="col-12">
                    <h2 class="display-4">Avancement</h2>
                    <p>Radiophonix est actuellement en <span class="badge badge-danger">Alpha</span></p>
                </div>
            </div>
            <div class="row">

                <div class="col-12 col-md-6">
                    <p>
                        Les contributions sont les bienvenues !<br />
                        <br>
                        Vous pouvez participer à la création du site sur GitLab.<br/>
                        <br>
                        Vous pouvez aussi signaler les bugs rencontrés.
                    </p>
                </div>

                <div class="col-12 col-md-6">
                    <p>Global</p>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-success" role="progressbar" :style="{ width: '30%'}" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">30%</div>
                    </div>

                    <p>API</p>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-success" role="progressbar" :style="{ width: '80%'}" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">80%</div>
                    </div>

                    <p>Gestion de compte</p>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-success" role="progressbar" :style="{ width: '5%'}" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">5%</div>
                    </div>

                    <p>Publication</p>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-success" role="progressbar" :style="{ width: '5%'}" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">5%</div>
                    </div>
                </div>

            </div>
        </div>


    </div>
</template>

<script>
import api from '~/lib/api';
import SagaList from '~/components/saga/SagaList.vue';
import Headband from '~/components/content/Headband.vue';

export default {
    components: {
        SagaList,
        Headband,
    },

    data() {
        return {
            sagas: [],
            genres: [],
            query: '',
        };
    },

    methods: {
        async loadSagas() {
            let result = await api.sagas.all({ random: 1 });

            this.sagas = result.data.slice(0, 10);
        },

        async loadGenres() {
            let results = await api.genres.all();

            this.genres = results.data.slice(0, 7);
        },

        search() {
            this.$store.dispatch('search/doSearch', this.query);
            this.$router.push({ name: 'search' });
        },

        getGenresRow(row) {
            return this.genres.slice(row * 3, 3 + (row * 3));
        }
    },

    mounted: function () {
        this.loadSagas();
        this.loadGenres();
    }
}

</script>
