<template>
    <div>
        <headband
            urlImage="/static/home/puzzle.jpg"
            title="Nouveautés"
            subtitle="Quoi de neuf sur Radiophonix ?">
        </headband>

        <div class="container">

            <div class="row">
                <div class="col-12 col-xl-10">

                    <h2 class="h1 mb-2">Nouveautés du 29/10/2018</h2>

                    <h3 class="h3">Amélioration du player en mobile</h3>
                    <div class="row">
                        <div class="col-12">
                            <p>
                                Lors d'une lecture d'un épisode en mobile, une barre est maintenant
                                affichée en bas de l'écran pour accéder au player.<br/>
                                Cette barre permet d'ouvrir le player en plein écran et de faire
                                lecture/pause.
                            </p>
                        </div>
                        <div class="col-6">
                            <div class="card mb-4 mb-lg-0">
                                <img class="card-img-top"
                                     src="/static/home/nouveau-player-mobile/nouveau-player-mobile-ferme.jpg"
                                     alt="Player fermé">
                                <div class="card-footer text-muted">
                                    Player audio fermé
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card mb-4 mb-lg-0">
                                <img class="card-img-top"
                                     src="/static/home/nouveau-player-mobile/nouveau-player-mobile-ouvert.jpg"
                                     alt="Player ouvert">
                                <div class="card-footer text-muted">
                                    Player audio ouvert
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="h3">Les autres nouveautés</h3>
                    <ul>
                        <li>Le temps de lecture de chaque saga est enregistré (il manque une indication visuelle)</li>
                        <li>L'équipe d'une saga est désormais affichée</li>
                        <li>
                            Deux nouvelles sagas :
                            <router-link :to="{ name: 'listen.sagas.show', params: { idOrSlug: 'kingdom-bwarf' } }"
                                         class="lien-paragraphe">
                                Kingdom Bwarf
                            </router-link>
                            et
                            <router-link :to="{ name: 'listen.sagas.show', params: { idOrSlug: 'affabulation-ii' } }"
                                         class="lien-paragraphe">
                                Affabulation II
                            </router-link>
                        </li>
                        <li>
                            Des urls plus lisibles pour les genres
                            (merci à <lien-merge-request num="40">Quoc-Viet</lien-merge-request> pour sa première contribution !)
                        <li>
                            Une <a href="https://radiophonix.gitlab.io/Radiophonix/">première ébauche de documentation</a> pour le développement.
                        </li>
                        <li>
                            Cette page de nouveautés !
                        </li>
                    </ul>

                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import Headband from '~/components/content/Headband.vue';
    import LienMergeRequest from '~/components/doc/LienMergeRequest.vue';

    export default {
        components: {
            Headband,
            LienMergeRequest,
        },
    }
</script>
