<template>
    <div>
        <headband
            urlImage="/static/home/puzzle.jpg"
            title="Nouveautés"
            subtitle="Quoi de neuf sur Radiophonix ?">
        </headband>

        <div class="container">

            <news-entry date="15 juin 2019" class="mt-4">
                <p class="pl-lg-4 mt-2">
                    La licence du code source du site a changée.
                    On est passés de
                    <a href="https://choosealicense.com/licenses/mit/" class="lien-paragraphe">MIT</a>
                    à
                    <a href="https://choosealicense.com/licenses/gpl-3.0/" class="lien-paragraphe">GNU GPLv3</a>.
                    <br/>
                    Cette nouvelle licence permet toujours la copie/modification du code mais à condition
                    qu'il reste open source.
                </p>
            </news-entry>

            <hr>

            <news-entry date="30 mai 2019">
                <h3 class="h2 pl-lg-4 mt-2 mb-1">Lancement publique !</h3>

                <p class="pl-lg-4 mt-2">
                    Le projet est maintenant ouvert à tout le monde et a été officiellement
                    présenté à la communauté <a href="https://forum.netophonix.com/ftopic17756.html" class="lien-paragraphe">sur le Netophonix</a>.<br />
                    Il est désormais possible de
                    <router-link :to="{ name: 'register' }" class="lien-paragraphe">s'inscrire</router-link>
                    sur le site afin d'enregistrer son avancement dans les épisodes et de gagner des badges !<br />
                    N'hésitez pas à
                    <a href="javascript:void(0);" class="lien-paragraphe" @click="openFeedbackModal('bug')">signaler des bugs</a>
                    et/ou à
                    <a href="javascript:void(0);" class="lien-paragraphe" @click="openFeedbackModal('suggestion')">faire des suggestions</a>.
                </p>

                <h3 class="h2 pl-lg-4 mt-2 mb-1">MP3@Paris 2019</h3>

                <p class="pl-lg-4 mt-2">
                    Pierre et moi seront présent cette année à l'évènement
                    <a href="https://mp3aparis.fr/" class="lien-paragraphe">MP3@Paris</a>
                    du 22 juin !
                </p>

                <h3 class="h2 pl-lg-4 mt-2 mb-1">Suite des travaux</h3>

                <p class="pl-lg-4 mt-2">
                    Il reste encore beaucoup à faire sur le site. Il est possible de suivre
                    l'avancement sur la
                    <router-link :to="{ name: 'roadmap' }" class="lien-paragraphe">roadmap</router-link>.
                </p>
            </news-entry>

            <hr>

            <news-entry date="2 décembre 2018" class="mt-4">
                <p class="pl-lg-4 mt-2">
                    Le développement de l'alpha est terminé et la beta peut démarrer !<br>
                    Vous pouvez suivre l'avancement du projet sur la
                    <router-link :to="{ name: 'roadmap' }" class="lien-paragraphe">roadmap !</router-link>
                </p>
            </news-entry>

            <hr>

            <news-entry date="20 novembre 2018" class="mt-4">
                <ul class="mt-2">
                    <li>Le corps du site est maintenant centré sur les grands écrans</li>
                    <li>Indicateur de chargement sur le lecteur</li>
                    <li>Refonte de la liste des épisodes sur la page d'une saga</li>
                    <li>Ajout d'un lien de téléchargement des épisodes</li>
                </ul>
            </news-entry>

            <hr>

            <news-entry date="14 novembre 2018" class="mt-4">
                <h3 class="h2 pl-lg-4 mt-2 mb-1">Flux RSS</h3>

                <p class="pl-lg-4">
                    Un flux RSS est maintenant généré automatiquement pour chaque saga !<br/>
                    Cela vous permet d'utiliser une application mobile de podcast pour écouter
                    sur mobile au lieu d'utiliser le site.<br/>
                    L'avantage par rapport au site est qu'il est possible de télécharger les
                    épisodes pour pouvoir les écouter sans internet.<br/>
                    Vous pouvez par exemple utiliser
                    <i class="fa fa-android"></i>
                    <a href="https://play.google.com/store/apps/details?id=com.bambuna.podcastaddict&hl=fr"
                       class="lien-paragraphe">Podcast & Radio Addict</a>
                    ou
                    <i class="fa fa-apple"></i>
                    <a href="https://itunes.apple.com/fr/app/apple-podcasts/id525463029"
                       class="lien-paragraphe">Apple Podcasts</a>
                    comme applications.<br />
                    Le lien RSS d'une saga est disponible sur sa page via un bouton en haut de la fiche.
                </p>

                <h3 class="h2 pl-lg-4 mt-2 mb-1">Une roadmap</h3>

                <p class="pl-lg-4">
                    Une <router-link :to="{ name: 'roadmap' }" class="lien-paragraphe">page de roadmap</router-link> fait sont apparition !
                    <br>
                    Cette page vous permet de suivre l'avancement du projet et ce qui est prévu pour l'avenir.
                </p>

                <h3 class="h2 pl-lg-4 mt-2 mb-1">Les autres nouveautés</h3>
                <ul>
                    <li>
                        Deux nouvelles sagas :
                        <router-link :to="{ name: 'listen.sagas.show', params: { idOrSlug: 'adoprixtoxis' } }"
                                     class="lien-paragraphe">Adoprixtoxis</router-link>
                        et
                        <router-link :to="{ name: 'listen.sagas.show', params: { idOrSlug: 'la-legende-de-xantah' } }"
                                     class="lien-paragraphe">La légende de Xantah</router-link>
                    </li>
                    <li>
                        Correction des auteurs de la saga
                        <router-link :to="{ name: 'listen.sagas.show', params: { idOrSlug: 'chez-le-psy' } }"
                                     class="lien-paragraphe">Chez le psy</router-link>
                        :
                        <router-link :to="{ name: 'listen.authors.show', params: { id: 'le-mago' } }"
                                     class="lien-paragraphe">Le Mago</router-link>
                        et
                        <router-link :to="{ name: 'listen.authors.show', params: { id: 'yond' } }"
                                     class="lien-paragraphe">Yond</router-link>
                    </li>
                    <li>Affichage des équipes d'un auteur sur sa page</li>
                    <li>
                        Ajout de plusieurs auteurs manquant :
                        <router-link :to="{ name: 'listen.authors.show', params: { id: 'mathieu-quintin' } }"
                                     class="lien-paragraphe">Mathieu Quintin</router-link>,
                        <router-link :to="{ name: 'listen.authors.show', params: { id: 'alinor' } }"
                                     class="lien-paragraphe">Alinor</router-link>,
                        <router-link :to="{ name: 'listen.authors.show', params: { id: 'szadec' } }"
                                     class="lien-paragraphe">Szadec</router-link> et
                        <router-link :to="{ name: 'listen.authors.show', params: { id: 'luneral' } }"
                                     class="lien-paragraphe">Luneral</router-link>
                    </li>
                    <li>
                        Une amélioration de la <router-link :to="{ name: 'search' }" class="lien-paragraphe">page de recherche</router-link>
                    </li>
                </ul>
            </news-entry>

            <hr>

            <news-entry date="29 octobre 2018" class="mt-4">
                <h3 class="h2 pl-lg-4 mt-2 mb-1">Amélioration du lecteur en mobile</h3>
                <p class="pl-lg-4">
                    Lors d'une lecture d'un épisode en mobile, une barre est maintenant
                    affichée en bas de l'écran pour accéder au lecteur.<br/>
                    Cette barre permet d'ouvrir le lecteur en plein écran et de faire
                    lecture/pause.
                </p>
                <div class="row pl-lg-4">
                    <div class="col-4">
                        <div class="card mb-4 mb-lg-0">
                            <img class="card-img-top"
                                 src="/static/news/nouveau-player-mobile/nouveau-player-mobile-ferme.png"
                                 alt="Lecteur fermé">
                            <div class="card-footer text-muted">
                                Lecteur audio fermé
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card mb-4 mb-lg-0">
                            <img class="card-img-top"
                                 src="/static/news/nouveau-player-mobile/nouveau-player-mobile-ouvert.png"
                                 alt="Lecteur ouvert">
                            <div class="card-footer text-muted">
                                Lecteur audio ouvert
                            </div>
                        </div>
                    </div>
                </div>

                <h3 class="h2 pl-lg-4 mt-2 mb-1">Les autres nouveautés</h3>
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
                        (merci à <lien-merge-request :num="40">Quoc-Viet</lien-merge-request> pour sa première contribution !)
                    <li>
                        Une <a href="https://radiophonix.gitlab.io/Radiophonix/" class="lien-paragraphe">première ébauche de documentation</a> pour le développement.
                    </li>
                    <li>
                        Cette page de nouveautés !
                    </li>
                </ul>
            </news-entry>

        </div>
    </div>
</template>

<script>
    import Headband from '~/components/content/Headband';
    import LienMergeRequest from '~/components/doc/LienMergeRequest';
    import NewsEntry from '~/components/News/NewsEntry';

    export default {
        components: {
            Headband,
            LienMergeRequest,
            NewsEntry,
        },

        methods: {
            openFeedbackModal(type) {
                this.$store.dispatch('ui/setFeedbackModalDefaultType', type);
                this.$bvModal.show('js--modal-feedback');
            },
        }
    }
</script>
