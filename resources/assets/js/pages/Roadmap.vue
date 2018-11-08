<template>
    <div>
        <headband
            urlImage="/static/home/roadmap.jpg"
            title="Roadmap"
            subtitle="Suivez l'avancement du projet">
            <ul class="list-inline">
                <li class="list-inline-item">
                    <i class="fa fa-fw fa-stop-circle text-info"></i> à faire
                </li>
                <li class="list-inline-item">
                    <i class="fa fa-fw fa-play-circle text-warning"></i> en cours
                </li>
                <li class="list-inline-item">
                    <i class="fa fa-fw fa-check-circle text-success"></i> fait !
                </li>
            </ul>
        </headband>

        <div class="container">

            <p class="lead">
                Radiophonix est actuellement en <span class="badge badge-warning">Alpha</span>
            </p>

            <p class="mt-3">
                Vous pouvez participer à la création du site en contribuant au code sur GitLab ou en
                signalant les bugs rencontrés.<br />
                <br />
                Pour voir le code c'est <a href="https://gitlab.com/Radiophonix/Radiophonix" class="lien-paragraphe">par ici</a> !<br/>
                Pour signaler des bugs c'est <a href="https://gitlab.com/Radiophonix/Radiophonix/issues" class="lien-paragraphe">par ici</a> !<br />
                Vous pouvez également rejoindre le <lien-discord /> !
            </p>

            <hr class="mt-5">

            <h2 class="h1">
                Version Alpha
                <a href="https://gitlab.com/Radiophonix/Radiophonix/boards/463758"
                   class="badge badge-warning badge-sm"
                   target="_blank">
                    <i class="fa fa-gitlab"></i>
                    en cours
                </a>
            </h2>

            <p class="mt-2 mb-2">
                La toute première version du site avec des fonctionnalités de base.
            </p>

            <ul class="list-unstyled pl-4">
                <roadmap-task status="doing">
                    Une navigation agréable sur le site
                </roadmap-task>
                <roadmap-task status="doing">
                    Finaliser la mise en page d'une saga
                </roadmap-task>
                <roadmap-task status="done">
                    Avoir un lecteur audio fonctionnel
                </roadmap-task>
                <roadmap-task status="doing">
                    Générer un flux RSS de podcast pour chaque saga
                </roadmap-task>
                <roadmap-task status="done">
                    Enregistrer l'avancement de la lecture sur le navigateur
                </roadmap-task>
            </ul>

            <hr class="mt-5">

            <h2 class="h1">
                Version Beta

                <a href="https://gitlab.com/Radiophonix/Radiophonix/boards/463759"
                   class="badge badge-info badge-sm"
                   target="_blank">
                    <i class="fa fa-gitlab"></i>
                    à venir
                </a>
            </h2>

            <p class="mt-2 mb-2">
                Finalisation de la zone auditeur du site avec inscription/connexion.
                <a href="https://gitlab.com/Radiophonix/Radiophonix/boards/463759"
                   class="lien-paragraphe">Suivre le développement</a>
            </p>

            <ul class="list-unstyled pl-4">
                <roadmap-task status="todo">
                    Pouvoir s'inscrire sur le site
                </roadmap-task>
                <roadmap-task status="todo">
                    Enregistrer l'avancement de la lecture sur le compte
                </roadmap-task>
                <roadmap-task status="todo">
                    Système de "like" pour les sagas, les faiseurs, etc.
                </roadmap-task>
                <roadmap-task status="todo">
                    Possibilité de s'abonner à une saga
                </roadmap-task>
                <roadmap-task status="todo">
                    Indicateurs de chargement sur les différentes pages
                </roadmap-task>
            </ul>

            <hr class="mt-5">

            <h2 class="h1">Publication de sagas</h2>

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
                    Donner accès aux sagas existantes à leurs faiseurs
                </roadmap-task>
            </ul>

            <hr class="mt-5">

            <h2 class="h1">Applications mobiles</h2>

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
