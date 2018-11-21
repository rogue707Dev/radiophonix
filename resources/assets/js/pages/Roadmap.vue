<template>
    <div>
        <headband
            urlImage="/static/home/roadmap.jpg"
            title="Roadmap"
            subtitle="Suivez l'avancement du projet">
        </headband>

        <div class="container">

            <h1 class="h1">
                Radiophonix est actuellement en Beta
            </h1>

            <p class="mt-3">
                Vous pouvez participer à la création du site en contribuant au <a href="https://gitlab.com/Radiophonix/Radiophonix" class="lien-paragraphe">code sur GitLab</a> ou en
                <a href="https://gitlab.com/Radiophonix/Radiophonix/issues" class="lien-paragraphe">signalant les bugs</a> rencontrés.<br />
                Vous pouvez également rejoindre le <lien-discord /> !
            </p>

            <p class="mt-3">
                <i class="fa fa-fw fa-stop-circle text-info"></i> = à faire
                <br>
                <i class="fa fa-fw fa-play-circle text-warning"></i> = en cours
                <br>
                <i class="fa fa-fw fa-check-circle text-success"></i> = fait !
            </p>

            <hr class="mt-5">

            <h2 class="h2">
                Version Alpha

                <a href="https://gitlab.com/Radiophonix/Radiophonix/boards/463758"
                   class="badge badge-warning badge-sm"
                   target="_blank">
                    <i class="fa fa-gitlab"></i>
                    fait !
                </a>
            </h2>

            <p class="mt-2 mb-2">
                La toute première version du site avec des fonctionnalités de base.
            </p>

            <ul class="list-unstyled pl-4">
                <roadmap-task status="done">
                    Une navigation agréable sur le site
                </roadmap-task>
                <roadmap-task status="done">
                    Finaliser la mise en page d'une saga
                </roadmap-task>
                <roadmap-task status="done">
                    Avoir un lecteur audio fonctionnel
                </roadmap-task>
                <roadmap-task status="done">
                    Générer un flux RSS de podcast pour chaque saga
                </roadmap-task>
                <roadmap-task status="done">
                    Enregistrer l'avancement de la lecture sur le navigateur
                </roadmap-task>
            </ul>

            <hr class="mt-5">

            <h2 class="h2">
                Version Beta

                <a href="https://gitlab.com/Radiophonix/Radiophonix/boards/463759"
                   class="badge badge-info badge-sm"
                   target="_blank">
                    <i class="fa fa-gitlab"></i>
                    en cours
                </a>
            </h2>

            <p class="mt-2 mb-2">
                Finalisation de la zone auditeur du site avec inscription/connexion.
                <a href="https://gitlab.com/Radiophonix/Radiophonix/boards/463759"
                   class="lien-paragraphe">Suivre le développement</a>
            </p>

            <ul class="list-unstyled pl-4">
                <roadmap-task status="doing">
                    Pouvoir s'inscrire sur le site
                </roadmap-task>
                <roadmap-task status="doing">
                    Enregistrer l'avancement de la lecture sur le compte
                </roadmap-task>
                <roadmap-task status="todo">
                    Système de "like" pour les sagas, les auteurs, etc.
                </roadmap-task>
                <roadmap-task status="todo">
                    Possibilité de s'abonner à une saga
                </roadmap-task>
                <roadmap-task status="todo">
                    Indicateurs de chargement sur les différentes pages
                </roadmap-task>
            </ul>

            <hr class="mt-5">

            <h2 class="h2">
                Publication de sagas

                <a href="https://gitlab.com/Radiophonix/Radiophonix/boards/854424"
                   class="badge badge-info badge-sm"
                   target="_blank">
                    <i class="fa fa-gitlab"></i>
                    à venir
                </a>
            </h2>

            <p class="mt-2 mb-2">
                Une fois la phase de Beta terminée, le développement de la zone
                de publication pourra commencer.<br />
                Cette zone permettra aux créateurs de renseigner toutes les
                informations de leurs sagas et de les publier depuis Radiophonix
                directement.
            </p>

            <ul class="list-unstyled pl-4">
                <roadmap-task status="todo">
                    Programmer à l'avance la publication des épisodes
                </roadmap-task>
                <roadmap-task status="todo">
                    Afficher les pourcentages d'avancement du prochain épisode
                </roadmap-task>
                <roadmap-task status="todo">
                    Renseigner les différents participants à une saga
                </roadmap-task>
                <roadmap-task status="todo">
                    Renseigner les informations de la saga (liens, licence, synopsis, etc)
                </roadmap-task>
                <roadmap-task status="todo">
                    Uploader une image de couverture selon la saga, la saison ou l'épisode
                </roadmap-task>
                <roadmap-task status="todo">
                    Ajouter des chapitres aux épisodes
                </roadmap-task>
                <roadmap-task status="todo">
                    Système de notification aux auditeurs pour la sortie de nouveaux épisodes
                </roadmap-task>
                <roadmap-task status="todo">
                    Repenser la gestion des fichiers audio (actuellement uploadés à la main)
                </roadmap-task>
                <roadmap-task status="todo">
                    Permettre la gestion de versions d'épisodes
                </roadmap-task>
                <roadmap-task status="todo">
                    Donner accès aux sagas existantes à leurs auteurs
                </roadmap-task>
                <roadmap-task status="todo">
                    Et plein d'autres choses !
                </roadmap-task>
            </ul>

            <hr class="mt-5">

            <h2 class="h2">Applications mobiles</h2>

            <p class="mt-2 mb-2">
                C'est pas pour tout de suite !
            </p>

            <ul class="list-unstyled pl-4">
                <roadmap-task status="todo">
                    Pouvoir se connecter à son compte depuis l'application
                </roadmap-task>
                <roadmap-task status="todo">
                    Lister ses abonnements
                </roadmap-task>
                <roadmap-task status="todo">
                    Notifications lors de la sortie de nouveaux épisodes
                </roadmap-task>
                <roadmap-task status="todo">
                    Ecoute en streaming ou en téléchargement depuis l'application
                </roadmap-task>
            </ul>

        </div>
    </div>
</template>

<script>
    import Headband from '~/components/content/Headband';
    import RoadmapTask from '~/components/News/RoadmapTask';
    import LienDiscord from '~/components/doc/LienDiscord';

    export default {
        components: {
            Headband,
            RoadmapTask,
            LienDiscord,
        },
    }
</script>
