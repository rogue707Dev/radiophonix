<template>
    <div>
        <headband
            urlImage="/static/home/publier.jpeg"
            title="Publier"
            subtitle="Publiez vos propres sagas directement sur le site">
        </headband>

        <div class="container">


            <div class="row">
                <div class="col-12">
                    <p>
                        Radiophonix ne va pas se limiter à l'écoute de sagas MP3 !<br>
                        Le site servira également à la publication. <br>
                        Les créateurs auront accès à une interface permettant de publier des sagas,
                        avec toutes les infos liées.
                    </p>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12 col-md-8 col-lg-6 order-lg-2">
                    <div class="card mb-4 mb-lg-0">
                        <img class="card-img-top"
                             src="/static/home/publier-mock-calendrier.png"
                             alt="Programmation en avance de la publication">
                        <div class="card-footer text-muted">
                            Programmation en avance de la publication
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 order-lg-1">
                    Plein de choses sont prévues, par exemple :
                    <ul>
                        <li>Programmer à l'avance la publication des épisodes</li>
                        <li>Avoir un flux RSS de podcast généré automatiquement par saga</li>
                        <li>Afficher les pourcentages d'avancement du prochain épisode</li>
                        <li>Lister les différents participants à une saga</li>
                        <li>Renseigner les informations de la saga (liens, licence, synopsis, etc)</li>
                        <li>Avoir plusieurs auteurs par saga</li>
                        <li>Uploader une image de couverture selon la saga, la saison ou l'épisode</li>
                        <li>Et beaucoup d'autres choses...</li>
                    </ul>
                </div>
            </div>


            <div class="row mt-4">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card card mb-4 mb-lg-0">
                        <img class="card-img-top"
                             src="/static/home/publier-mock-infos-saga.png"
                             alt="Informations d'une saga">
                        <div class="card-footer text-muted">
                            Informations d'une saga
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <p class="mb-4 mb-lg-0">
                        Cette partie "publication" est encore en cours de développement, et comme
                        le reste du site, de façon ouverte sur
                        <a href="https://gitlab.com/Radiophonix/Radiophonix" class="lien-paragraphe">GitLab</a>.<br/>
                        <br/>
                        Si vous savez développer du web vous êtes bien sûr invité.e.s à venir
                        contribuer au code !
                    </p>
                </div>
                <div class="col-12 col-md-8 col-lg-12 mt-lg-4">
                    <div class="card">
                        <img class="card-img-top"
                             src="/static/home/publier-mock-collections.png"
                             alt="Liste des collections (saisons, bonus, making-of, etc.)">
                        <div class="card-footer text-muted">
                            Liste des collections (saisons, bonus, making-of, etc.)
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import Headband from '~/components/content/Headband.vue';

    export default {
        components: {
            Headband,
        },
    }
</script>
