<template>
    <div>


        <div class="jumbotron text-center">
            <svg class="logo-home">
                <use class="fill--logo-orange" xlink:href="#logo-part1of2"></use>
                <use class="fill--logo-bleu" xlink:href="#logo-part2of2"></use>
            </svg>
            <div class="display-4 text-body">
                Toutes vos sagas au même endroit
            </div>
            <div class="search-homepage my-5">
                <search-form></search-form>
            </div>
        </div>


        <div class="container">

            <div class="row">
                <div class="col-12">
                    <h2 class="h1">Qu'est-ce que Radiophonix ?</h2>
                    <blockquote class="blockquote mb-5">
                        <p class="mb-0X">
                            Radiophonix est une plateforme libre et gratuite de partage et
                            d'écoute de sagas MP3.<br/>
                            L'ambition de ce projet est de redonner vie à ce super média qu'est
                            la saga MP3 en créant une plateforme qui facilite la publication et
                            l'écoute des sagas.<br/>
                            <br/>
                            Ce projet est inspiré par les diverses tentatives de site similaire qui
                            n'ont hélas jamais vu le jour, notamment l'<a title="Lien wiki Agoraphonix" href="https://wiki.netophonix.com/Agoraphonix">Agoraphonix</a>.<br/>
                            Le nom du projet est bien évidemment inspiré de
                            <a title="Lien Netophonix" href="https://netophonix.com/">Netophonix</a>.
                        </p>
                    </blockquote>

                    <h2 class="h1">Qui êtes-vous ?</h2>
                    <blockquote class="blockquote mb-5">
                        <p class="mb-0X">
                            Nous sommes un développeur web (<a href="http://mopolo.fr/" class="lien-paragraphe">Nathan</a>)
                            et un UX Designer (<a href="http://www.pierre.tl" class="lien-paragraphe">Pierre</a>)
                            professionnels, passionnés de sagas MP3.<br/>
                            Faire des sites est notre métier depuis plusieurs années, ce qui
                            nous permet de développer ce projet.<br/>

                            Rejoignez-nous sur <lien-discord /> !
                        </p>
                    </blockquote>

                    <h2 class="h1">Version Alpha</h2>
                    <blockquote class="blockquote mb-5">
                        <p class="mb-0X">
                            Le site est actuellement en version Alpha, où seule l'écoute de sagas
                            est possible.<br/>
                            Nous avons fait attention à ce que les sagas présentes actuellement sur
                            le site aient toutes une licence Creative Commons.<br/>
                            La publication est en cours de développement.<br/>
                            <br/>
                            N'hésitez pas à laisser des remarques, signaler des bugs et
                            faire des suggestions. On ne demande que ça !<br/>
                            Le plus simple est de nous rejoindre sur <lien-discord />.<br/>
                            <br/>
                            Radiophonix est un projet open source :
                            <a title="Lien GitLab" class="lien-paragraphe" href="https://gitlab.com/Radiophonix/Radiophonix">
                                https://gitlab.com/Radiophonix/Radiophonix
                            </a><br/>
                            Les contributions sont les bienvenues !
                        </p>
                    </blockquote>

                    <h2 class="h1">Qu'est-ce qu'une Saga MP3 ?</h2>
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
                            <a href="https://wiki.netophonix.com/Saga_MP3" class="lien-paragraphe">
                                Extrait du Netowiki
                            </a>
                        </footer>
                    </blockquote>

                    Pour plus d'informations, allez voir la <router-link :to="{ name: 'help' }" class="lien-paragraphe">FAQ</router-link>.
                </div>
            </div>

        </div>


        <headband
                urlImage="/static/home/ecouter.jpeg"
                title="Écouter"
                subtitle="Découvrez ou redécouvrez des sagas MP3">
        </headband>

        <div class="container">
            <div class="row mt-5 mb-5">
                <div class="col-12">
                    <h2 class="h1 mb-4">Quelques exemples de Saga :</h2>
                    <saga-list :sagas="sagas"></saga-list>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="h1">Découvrez quelques genres</h2>

                    <div class="list-card my-5">

                        <Card
                                v-for="genre in getGenresRow(0)"
                                :key="genre.id"
                                :link="{ name: 'listen.genres.show', params: { id: genre.id } }"
                                :urlImage="genre.image.main"
                                :altImage="genre.name"
                                :title="genre.name"
                                type="genre">

                            <template slot="stats">
                                <i aria-hidden="true" class="fa fa-file-audio-o"></i> {{ genre.stats.sagas }} Séries
                            </template>

                        </Card>
                    </div>

                </div>
            </div>
        </div>







        <publish-presentation/>








        <headband v-feature="'contribuer'"
                urlImage="/static/home/contribuer.jpeg"
                title="Contribuer"
                subtitle="Le site est open source et les contributions sont les bienvenues">
        </headband>

        <div class="container" v-feature="'contribuer'">
            <div class="row mb-5">
                <div class="col-12">
                    <p>Radiophonix est actuellement en <span class="badge badge-danger">Alpha</span></p>
                </div>
            </div>
            <div class="row">

                <div class="col-12 col-md-6">
                    <p>
                        Les contributions sont les bienvenues !<br />
                        <br>
                        Vous pouvez participer à la création du site sur <a title="Lien GitLab" href="https://gitlab.com/Radiophonix/Radiophonix" class="lien-paragraphe">GitLab</a>.<br/>
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
import Card from '~/components/content/Card.vue';
import PublishPresentation from '~/components/publish/PublishPresentation.vue';
import LienDiscord from '~/components/doc/LienDiscord';
import SearchForm from '~/components/search/SearchForm';

export default {
    components: {
        SagaList,
        Headband,
        Card,
        PublishPresentation,
        LienDiscord,
        SearchForm,
    },

    data() {
        return {
            sagas: [],
            genres: [],
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
