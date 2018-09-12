<template>
    <div class="layout-conteneur__main">

        <a href="ancre-radiophonix">Composent Radiophonix</a>
        <br>
        <a href="ancre-bootstrap">Composent Bootstrap</a>



        <div class="alert alert-warning">
            -> analyse en cour : la home page
            <br>
            -> a faire la prochaine fois : jumbotron <-> bandeau & baseline sous le logo home
            <br>
            -> ne pas oublier de faire une repasser coté scss apres celle html/vue
            <br>
            -> supprimer les commentaire "(issues#57)" dans les scss
        </div>



        <div class="jumbotron" id="ancre-radiophonix">
            <h1 class="display-3">Composent Radiophonix</h1>
            <p class="lead">
                Les composants spécifique à radiophonix
            </p>
        </div>


        <hr class="my-4">
        <h1 class="display-3">SVG</h1>
        <svg width="280px" height="50px">
            <use class="fill--logo-orange" xlink:href="#logo-part1of2"></use>
            <use class="fill--logo-bleu" xlink:href="#logo-part2of2"></use>
        </svg>
        <div>
            <svg width="280px" height="50px" class="fill--bleu">
                <use xlink:href="#logo-part1of2"></use>
                <use xlink:href="#logo-part2of2"></use>
            </svg>
        </div>
        <div style="background-color: #3a4651">
            <svg width="280px" height="50px" class="fill--blanc">
                <use xlink:href="#logo-part1of2"></use>
                <use xlink:href="#logo-part2of2"></use>
            </svg>
        </div>


        <hr data-v-5f801cbc="" class="my-4">
        <h1 class="display-3">Liste de Saga</h1>
        <ul class="liste-jaquette saga">
            <li>
                <a href="/ecouter/sagas/le-donjon-de-naheulbeuk" class="">
                    <div class="jaquette--grande jaquette--saga zone-interactive__border">
                        <img src="http://facetheforce.today/random/340?r=1" alt="" width="340px" height="340px">
                    </div>
                    <div class="zone-interactive zone-interactive__colle-cadre border-top-0">
                        <div class="zone-interactive__info p-1">
                            <a href="/ecouter/sagas/le-donjon-de-naheulbeuk" class="">
                                <p class="titre-liste-jaquette-saga">Le Donjon de Naheulbeuk</p>
                                <p class="texte-rouge texte-petit">
                                    <i aria-hidden="true" class="fa fa-podcast"></i> 2 Saison - 30 Épisodes
                                </p>
                            </a>
                            <p><a href="/ecouter/faiseurs/pen-of-chaos" class="">Par Pen Of Chaos</a></p>
                        </div>
                        <div class="zone-interactive__action">
                            <a href="" class="zone-interactive__bouton"><i aria-hidden="true" class="fa fa-heart"></i></a>
                            <a href="" class="zone-interactive__bouton"><i aria-hidden="true" class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </a>
            </li>
        </ul>



        <hr data-v-5f801cbc="" class="my-4">
        <h1 class="display-3">Résultat recherche</h1>
        <div class="layout-resultat-recherche">
            <div class="layout-resultat-recherche__zoom">
                <ul class="liste-resultat">

                    <li class="liste-resultat__item-zoom">
                        <a href="/ecouter/sagas/le-donjon-de-naheulbeuk" class="text-center">
                            <div class="zone-interactive__border d-flex">
                                <div class="flex-grow-1">
                                    <div class="jaquette--moyen jaquette--saga">
                                        <img src="http://facetheforce.today/random/340?r=2" alt="" width="340px" height="340px">
                                    </div>
                                </div>
                            </div>
                            <div class="zone-interactive border-top-0">
                                <div class="zone-interactive__action">
                                    <a href="" class="zone-interactive__bouton">
                                        <i aria-hidden="true" class="fa fa-plus"></i>
                                    </a>
                                </div>
                                <div class="zone-interactive__info p-1">
                                    <p class="titre-resultat-recherche">Le Donjon de Naheulbeuk</p>
                                    <p class="texte-rouge">
                                        <i aria-hidden="true" class="fa fa-podcast"></i> 2 Saison - 30 Épisodes
                                    </p>
                                </div>
                                <div class="zone-interactive__action">
                                    <a href="" class="zone-interactive__bouton">
                                        <i aria-hidden="true" class="fa fa-heart actif"></i>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </li>


                    <li class="liste-resultat__item-zoom">
                        <a href="/ecouter/sagas/le-donjon-de-naheulbeuk" class="text-center">
                            <div class="zone-interactive__border d-flex">
                                <div class="flex-grow-1">
                                    <div class="jaquette--moyen jaquette--faiseur">
                                        <img src="http://facetheforce.today/random/340?r=3" alt="" width="340px" height="340px">
                                    </div>
                                </div>
                            </div>
                            <div class="zone-interactive border-top-0">
                                <div class="zone-interactive__action">
                                    <a href="" class="zone-interactive__bouton">
                                        <i aria-hidden="true" class="fa fa-plus"></i>
                                    </a>
                                </div>
                                <div class="zone-interactive__info p-1">
                                    <p class="titre-resultat-recherche">Pen Of Chaos</p>
                                    <p class="texte-rouge">
                                        <i aria-hidden="true" class="fa fa-file-audio-o"></i> 2 Séries
                                    </p>
                                </div>
                                <div class="zone-interactive__action">
                                    <a href="" class="zone-interactive__bouton">
                                        <i aria-hidden="true" class="fa fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </li>


                    <li class="liste-resultat__item-zoom">
                        <a href="/ecouter/sagas/le-donjon-de-naheulbeuk" class="text-center">
                            <div class="zone-interactive__border d-flex">
                                <div class="flex-grow-1">
                                    <div class="jaquette--moyen jaquette--episode">
                                        <img src="http://facetheforce.today/random/340?r=4" alt="" width="340px" height="340px">
                                    </div>
                                </div>
                            </div>
                            <div class="zone-interactive border-top-0">
                                <div class="zone-interactive__action">
                                    <a href="" class="zone-interactive__bouton">
                                        <i aria-hidden="true" class="fa fa-plus"></i>
                                    </a>
                                </div>
                                <div class="zone-interactive__info p-1">
                                    <p class="titre-resultat-recherche">Présentation</p>
                                    <p class="texte-rouge">
                                        <i aria-hidden="true" class="fa fa-clock-o"></i> 3m, 45s
                                    </p>
                                </div>
                                <div class="zone-interactive__action">
                                    <a href="" class="zone-interactive__bouton">
                                        <i aria-hidden="true" class="fa fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </li>


                    <li class="liste-resultat__item-zoom">
                        <a href="/ecouter/sagas/le-donjon-de-naheulbeuk" class="text-center">
                            <div class="zone-interactive__border d-flex">
                                <div class="flex-grow-1">
                                    <div class="jaquette--moyen jaquette--genre">
                                        <img src="http://facetheforce.today/random/340?r=5" alt="" width="340px" height="340px">
                                    </div>
                                </div>
                            </div>
                            <div class="zone-interactive border-top-0">
                                <div class="zone-interactive__action">
                                    <a href="" class="zone-interactive__bouton">
                                        <i aria-hidden="true" class="fa fa-plus"></i>
                                    </a>
                                </div>
                                <div class="zone-interactive__info p-1">
                                    <p class="titre-resultat-recherche">Heroic fantasy</p>
                                    <p class="texte-rouge">
                                        <i aria-hidden="true" class="fa fa-file-audio-o"></i> 2 Séries
                                    </p>
                                </div>
                                <div class="zone-interactive__action">
                                    <a href="" class="zone-interactive__bouton">
                                        <i aria-hidden="true" class="fa fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </li>


                </ul>
            </div>
            <div class="layout-resultat-recherche__vrac">
                <ul class="liste-resultat">

                    <li class="liste-resultat__item-vrac">
                        <a href="/ecouter/sagas/le-donjon-de-naheulbeuk">

                            <div class="zone-interactive">
                                <div class="zone-interactive__info">

                                    <div class="d-flex">
                                        <div class="liste-resultat__visuel">
                                            <div class="jaquette--petite jaquette--saga">
                                                <img src="http://facetheforce.today/random/340?r=6" alt="" height="340px" width="340px">
                                            </div>
                                        </div>
                                        <div class="liste-resultat__info">
                                            <p class="titre-resultat-recherche">Le Donjon de Naheulbeuk</p>
                                            <p class="texte-rouge">
                                                <i aria-hidden="true" class="fa fa-podcast"></i> 2 Saison - 30 Épisodes
                                            </p>
                                        </div>
                                    </div>

                                </div>
                                <div class="zone-interactive__action">
                                    <a class="zone-interactive__bouton" href="">
                                        <i aria-hidden="true" class="fa fa-heart"></i>
                                    </a>
                                    <a class="zone-interactive__bouton" href="">
                                        <i aria-hidden="true" class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>

                        </a>
                    </li>

                    <li class="liste-resultat__item-vrac">
                        <a href="/ecouter/sagas/le-donjon-de-naheulbeuk">

                            <div class="zone-interactive">
                                <div class="zone-interactive__info">

                                    <div class="d-flex">
                                        <div class="liste-resultat__visuel">
                                            <div class="jaquette--petite jaquette--faiseur">
                                                <img src="http://facetheforce.today/random/340?r=7" alt="" height="340px" width="340px">
                                            </div>
                                        </div>
                                        <div class="liste-resultat__info">
                                            <p class="titre-resultat-recherche">Pen Of Chaos</p>
                                            <p class="texte-rouge">
                                                <i aria-hidden="true" class="fa fa-file-audio-o"></i> 2 Séries
                                            </p>
                                        </div>
                                    </div>

                                </div>
                                <div class="zone-interactive__action">
                                    <a class="zone-interactive__bouton" href="">
                                        <i aria-hidden="true" class="fa fa-heart"></i>
                                    </a>
                                    <a class="zone-interactive__bouton" href="">
                                        <i aria-hidden="true" class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>

                        </a>
                    </li>

                    <li class="liste-resultat__item-vrac">
                        <a href="/ecouter/sagas/le-donjon-de-naheulbeuk">

                            <div class="zone-interactive">
                                <div class="zone-interactive__info">

                                    <div class="d-flex">
                                        <div class="liste-resultat__visuel">
                                            <div class="jaquette--petite jaquette--episode">
                                                <img src="http://facetheforce.today/random/340?r=8" alt="" height="340px" width="340px">
                                            </div>
                                        </div>
                                        <div class="liste-resultat__info">
                                            <p class="titre-resultat-recherche">Présentation</p>
                                            <p class="texte-rouge">
                                                <i aria-hidden="true" class="fa fa-clock-o"></i> 3m, 45s
                                            </p>
                                        </div>
                                    </div>

                                </div>
                                <div class="zone-interactive__action">
                                    <a class="zone-interactive__bouton" href="">
                                        <i aria-hidden="true" class="fa fa-heart actif"></i>
                                    </a>
                                    <a class="zone-interactive__bouton" href="">
                                        <i aria-hidden="true" class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>

                        </a>
                    </li>

                    <li class="liste-resultat__item-vrac">
                        <a href="/ecouter/sagas/le-donjon-de-naheulbeuk">

                            <div class="zone-interactive">
                                <div class="zone-interactive__info">

                                    <div class="d-flex">
                                        <div class="liste-resultat__visuel">
                                            <div class="jaquette--petite jaquette--genre">
                                                <img src="http://facetheforce.today/random/340?r=9" alt="" height="340px" width="340px">
                                            </div>
                                        </div>
                                        <div class="liste-resultat__info">
                                            <p class="titre-resultat-recherche">Heroic fantasy</p>
                                            <p class="texte-rouge">
                                                <i aria-hidden="true" class="fa fa-file-audio-o"></i> 2 Séries
                                            </p>
                                        </div>
                                    </div>

                                </div>
                                <div class="zone-interactive__action">
                                    <a class="zone-interactive__bouton" href="">
                                        <i aria-hidden="true" class="fa fa-heart"></i>
                                    </a>
                                    <a class="zone-interactive__bouton" href="">
                                        <i aria-hidden="true" class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>

                        </a>
                    </li>



                </ul>
            </div>
        </div>



        <hr data-v-5f801cbc="" class="my-4">
        <h1 class="display-3">Bouton</h1>
        <div>
            <div role="alert" class="alert alert-danger">
                Refaire en bootstrap ?
            </div>
            <button class="btn btn-blanc">Test</button>
            <button class="btn btn-blanc"><i class="fa fa-volume-up" aria-hidden="true"></i>Test</button>
            <button class="btn-blanc btn-rond-petit"><i class="fa fa-volume-up" aria-hidden="true"></i></button>
            <button class="btn-blanc btn-rond-moyen"><i class="fa fa-volume-up" aria-hidden="true"></i></button>
            <button class="btn-blanc btn-rond-grand"><i class="fa fa-volume-up" aria-hidden="true"></i></button>
            <br>
            <button class="btn btn-bleu-moyen">Test</button>
            <button class="btn btn-bleu-moyen"><i class="fa fa-volume-up" aria-hidden="true"></i>Test</button>
            <button class="btn-bleu-moyen btn-rond-petit"><i class="fa fa-volume-up" aria-hidden="true"></i></button>
            <button class="btn-bleu-moyen btn-rond-moyen"><i class="fa fa-volume-up" aria-hidden="true"></i></button>
            <button class="btn-bleu-moyen btn-rond-grand"><i class="fa fa-volume-up" aria-hidden="true"></i></button>
            pas utiliser
            <br>
            <button class="btn btn-blanc-fonce">Test</button>
            <button class="btn btn-blanc-fonce"><i class="fa fa-volume-up" aria-hidden="true"></i>Test</button>
            <br>
            <button class="btn-composer-blanc-fonce">
                <span class="btn-blanc-fonce btn-rond-petit"><i class="fa fa-volume-up" aria-hidden="true"></i></span>
                Pas utiliser
            </button>
        </div>



        <hr data-v-5f801cbc="" class="my-4">
        <h1 class="display-3">Cartouche</h1>
        <div role="alert" class="alert alert-danger">
            Refaire en bootstrap ? -> bouton group ou badge ?
        </div>
        <ul class="reset-ul">
            <li class="cartouche">
                <span>3 <i aria-hidden="true" class="fa fa-heart"></i></span>
            </li>
            <li class="cartouche-groupe">
                <div class="cartouche">4 saisons</div>
                <div class="cartouche">32 épisodes</div>
            </li>
            <li class="cartouche">Terminé</li>
            <li class="cartouche lien">Lien</li>
        </ul>



        <hr data-v-5f801cbc="" class="my-4">
        <h1 class="display-3">Icon cc dans banniere</h1>
        <div role="alert" class="alert alert-danger">
            atomisé ou a mettre avec toute la banniere
        </div>
        <div class="banniere__icon-cc">
            <i class="cc cc-BY"></i>
        </div>



        <hr data-v-5f801cbc="" class="my-4">
        <h1 class="display-3">Habillage icon "Font Awesome"</h1>
        <div class="hfa-cercle-blanc-fonce">
            <i aria-hidden="true" class="fa fa-volume-up"></i>
        </div>
        <div class="hfa-cercle-blanc-fonce">
            <i aria-hidden="true" class="fa fa-play"></i>
        </div>



        <hr data-v-5f801cbc="" class="my-4">
        <h1 class="display-3">Taille de texte"</h1>
        <div role="alert" class="alert alert-danger">
            Refaire en bootstrap ?
        </div>
        <p class="texte-tres-petit">.texte-tres-petit</p>
        <p class="texte-petit">.texte-petit</p>
        <p>Texte normal</p>
        <p class="texte-moyen">.texte-moyen</p>
        <p class="texte-grand">.texte-grand</p>
        <p class="texte-tres-grand">.texte-tres-grand</p>



        <hr data-v-5f801cbc="" class="my-4">
        <h1 class="display-3">Graisse de texte"</h1>
        <div role="alert" class="alert alert-danger">
            Refaire en bootstrap ?
        </div>
        <p class="texte-300">.texte-300</p>
        <p>normal (400)</p>
        <p class="texte-600">.texte-600</p>



        <hr data-v-5f801cbc="" class="my-4">
        <h1 class="display-3">Heading</h1>
        <div role="alert" class="alert alert-danger">
            verifier utilisation <br>
            Utiliser que bootstrap ? -> display-x
        </div>
        <h1>h1. Bootstrap heading</h1>
        <h2>h2. Bootstrap heading</h2>
        <h3>h3. Bootstrap heading</h3>
        <h4>h4. Bootstrap heading</h4>
        <h5>h5. Bootstrap heading</h5>
        <h6>h6. Bootstrap heading</h6>
        <p class="h1">.h1</p>
        <p class="h2">.h2</p>
        <p class="h3">.h3</p>
        <p class="h4">.h4</p>
        <p class="h5">.h5</p>
        <p class="h6">.h6</p>
        <h1 class="display-1">.display 1</h1>
        <h1 class="display-2">.display 2</h1>
        <h1 class="display-3">.display 3</h1>
        <h1 class="display-4">.display 4</h1>
        <p class="lead">
            .lead : <br> Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus.
        </p>



        <hr class="my-4">
        <h1 class="display-3">Couleur de texte</h1>
        <div role="alert" class="alert alert-danger">
            Refaire en bootstrap -> style bootstrap
            <br> voir ce qui est encore utiliser
        </div>
        <div>
            <h2 class="titre--bloc mb-4 mt-5">Couleur texte</h2>
            <div class="row">
                <div class="col">
                    <p>Texte par defaut</p>
                    <p class="texte-blanc">Texte blanc</p>
                    <p class="texte-bleu-fonce">Texte bleu-fonce</p>
                    <p class="texte-orange-fonce">Texte orange-fonce</p>
                </div>
                <div class="col" style="background-color: #EBEFF4">
                    <p>Texte par defaut</p>
                    <p class="texte-blanc">Texte blanc</p>
                    <p class="texte-bleu-fonce">Texte bleu-fonce</p>
                    <p class="texte-orange-fonce">Texte orange-fonce</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="text-primary">.text-primary</p>
                    <p class="text-secondary">.text-secondary</p>
                    <p class="text-success">.text-success</p>
                    <p class="text-danger">.text-danger</p>
                    <p class="text-warning">.text-warning</p>
                    <p class="text-info">.text-info</p>
                    <p class="text-light bg-dark">.text-light</p>
                    <p class="text-dark">.text-dark</p>
                    <p class="text-muted">.text-muted</p>
                    <p class="text-white bg-dark">.text-white</p>
                </div>
                <div class="col">
                    <p><a href="#" class="text-primary">Primary link</a></p>
                    <p><a href="#" class="text-secondary">Secondary link</a></p>
                    <p><a href="#" class="text-success">Success link</a></p>
                    <p><a href="#" class="text-danger">Danger link</a></p>
                    <p><a href="#" class="text-warning">Warning link</a></p>
                    <p><a href="#" class="text-info">Info link</a></p>
                    <p><a href="#" class="text-light bg-dark">Light link</a></p>
                    <p><a href="#" class="text-dark">Dark link</a></p>
                    <p><a href="#" class="text-muted">Muted link</a></p>
                    <p><a href="#" class="text-white bg-dark">White link</a></p>
                </div>
            </div>
        </div>



        <hr class="my-4">
        <h1 class="display-3">Navigation</h1>
        <div role="alert" class="alert alert-danger">
            Refaire en bootstrap ?
        </div>
        <ul class="navigation">
            <li class="actif">Populaire</li>
            <li>Nouveau</li>
            <li>Type</li>
            <li>Playlist</li>
        </ul>







        <br>
        <div class="jumbotron" id="ancre-bootstrap">
            <h1 class="display-3">Composants Bootstrap</h1>
            <p class="lead">
                Les composants viennent tous de Bootstrap.<br />
                Les titres sont cliquables et ouvrent la documentation de Bootstrap correspondante.
            </p>
            <hr class="my-4">
            <p>
                La documentation de Bootstrap est disponible ici :
            </p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="http://getbootstrap.com/docs/4.0/getting-started/introduction/" role="button">Lire la doc</a>
            </p>
        </div>

        <hr class="my-4">
        <h1 class="display-2">Alertes</h1>

        <doc-titre url="/components/alerts/#examples">
            Exemple
        </doc-titre>

        <div class="alert alert-primary" role="alert">
            This is a primary alert—check it out!
        </div>
        <div class="alert alert-secondary" role="alert">
            This is a secondary alert—check it out!
        </div>
        <div class="alert alert-success" role="alert">
            This is a success alert—check it out!
        </div>
        <div class="alert alert-danger" role="alert">
            This is a danger alert—check it out!
        </div>
        <div class="alert alert-warning" role="alert">
            This is a warning alert—check it out!
        </div>
        <div class="alert alert-info" role="alert">
            This is a info alert—check it out!
        </div>
        <div class="alert alert-light" role="alert">
            This is a light alert—check it out!
        </div>
        <div class="alert alert-dark" role="alert">
            This is a dark alert—check it out!
        </div>

        <doc-titre url="/components/alerts/#link-color">
            Liens dans les Alertes
        </doc-titre>

        <div class="alert alert-primary" role="alert">
            This is a primary alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
        </div>
        <div class="alert alert-secondary" role="alert">
            This is a secondary alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
        </div>
        <div class="alert alert-success" role="alert">
            This is a success alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
        </div>
        <div class="alert alert-danger" role="alert">
            This is a danger alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
        </div>
        <div class="alert alert-warning" role="alert">
            This is a warning alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
        </div>
        <div class="alert alert-info" role="alert">
            This is a info alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
        </div>
        <div class="alert alert-light" role="alert">
            This is a light alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
        </div>
        <div class="alert alert-dark" role="alert">
            This is a dark alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
        </div>

        <doc-titre url="/components/alerts/#additional-content">
            Contenu additionnel dans une alerte
        </doc-titre>

        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Well done!</h4>
            <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
            <hr>
            <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
        </div>

        <hr class="my-4">
        <h1 class="display-2">Badges</h1>

        <doc-titre url="/components/badge/#example">
            Exemple
        </doc-titre>

        <h1>Example heading <span class="badge badge-secondary">New</span></h1>
        <h2>Example heading <span class="badge badge-secondary">New</span></h2>
        <h3>Example heading <span class="badge badge-secondary">New</span></h3>
        <h4>Example heading <span class="badge badge-secondary">New</span></h4>
        <h5>Example heading <span class="badge badge-secondary">New</span></h5>
        <h6>Example heading <span class="badge badge-secondary">New</span></h6>

        <h2 class="h2">Dans un bouton</h2>

        <button type="button" class="btn btn-primary">
            Notifications <span class="badge badge-light">4</span>
        </button>

        <doc-titre url="/components/badge/#contextual-variations">
            Variations des badges
        </doc-titre>

        <span class="badge badge-primary">Primary</span>
        <span class="badge badge-secondary">Secondary</span>
        <span class="badge badge-success">Success</span>
        <span class="badge badge-danger">Danger</span>
        <span class="badge badge-warning">Warning</span>
        <span class="badge badge-info">Info</span>
        <span class="badge badge-light">Light</span>
        <span class="badge badge-dark">Dark</span>

        <doc-titre url="/components/badge/#pill-badges">
            Badges en versions rondes
        </doc-titre>

        <span class="badge badge-pill badge-primary">Primary</span>
        <span class="badge badge-pill badge-secondary">Secondary</span>
        <span class="badge badge-pill badge-success">Success</span>
        <span class="badge badge-pill badge-danger">Danger</span>
        <span class="badge badge-pill badge-warning">Warning</span>
        <span class="badge badge-pill badge-info">Info</span>
        <span class="badge badge-pill badge-light">Light</span>
        <span class="badge badge-pill badge-dark">Dark</span>

        <hr class="my-4">
        <h1 class="display-2">Breadcrumbs</h1>

        <doc-titre url="/components/breadcrumb/#overview">
            Exemple
        </doc-titre>

        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
            </ol>
        </nav>

        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Library</li>
            </ol>
        </nav>

        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Library</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
        </nav>

        <hr class="my-4">
        <h1 class="display-2">Boutons</h1>

        <doc-titre url="/components/buttons/#examples">
            Boutons
        </doc-titre>

        <div>
            <h3 class="h3">Grands</h3>

            <button type="button" class="btn btn-primary btn-lg">Primary</button>
            <button type="button" class="btn btn-secondary btn-lg">Secondary</button>
            <button type="button" class="btn btn-success btn-lg">Success</button>
            <button type="button" class="btn btn-danger btn-lg">Danger</button>
            <button type="button" class="btn btn-warning btn-lg">Warning</button>
            <button type="button" class="btn btn-info btn-lg">Info</button>
            <button type="button" class="btn btn-light btn-lg">Light</button>
            <button type="button" class="btn btn-dark btn-lg">Dark</button>

            <button type="button" class="btn btn-link btn-lg">Link</button>
        </div>

        <div>
            <h3 class="h3">Normaux</h3>

            <button type="button" class="btn btn-primary">Primary</button>
            <button type="button" class="btn btn-secondary">Secondary</button>
            <button type="button" class="btn btn-success">Success</button>
            <button type="button" class="btn btn-danger">Danger</button>
            <button type="button" class="btn btn-warning">Warning</button>
            <button type="button" class="btn btn-info">Info</button>
            <button type="button" class="btn btn-light">Light</button>
            <button type="button" class="btn btn-dark">Dark</button>

            <button type="button" class="btn btn-link">Link</button>
        </div>

        <div>
            <h3 class="h3">Petits</h3>

            <button type="button" class="btn btn-primary btn-sm">Primary</button>
            <button type="button" class="btn btn-secondary btn-sm">Secondary</button>
            <button type="button" class="btn btn-success btn-sm">Success</button>
            <button type="button" class="btn btn-danger btn-sm">Danger</button>
            <button type="button" class="btn btn-warning btn-sm">Warning</button>
            <button type="button" class="btn btn-info btn-sm">Info</button>
            <button type="button" class="btn btn-light btn-sm">Light</button>
            <button type="button" class="btn btn-dark btn-sm">Dark</button>

            <button type="button" class="btn btn-link">Link</button>
        </div>

        <doc-titre url="/components/buttons/#outline-buttons">
            Boutons Outline
        </doc-titre>

        <button type="button" class="btn btn-outline-primary">Primary</button>
        <button type="button" class="btn btn-outline-secondary">Secondary</button>
        <button type="button" class="btn btn-outline-success">Success</button>
        <button type="button" class="btn btn-outline-danger">Danger</button>
        <button type="button" class="btn btn-outline-warning">Warning</button>
        <button type="button" class="btn btn-outline-info">Info</button>
        <button type="button" class="btn btn-outline-light">Light</button>
        <button type="button" class="btn btn-outline-dark">Dark</button>

        <doc-titre url="/components/buttons/#active-state">
            Etat actif
        </doc-titre>

        <a href="#" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Primary link</a>
        <a href="#" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Link</a>

        <doc-titre url="/components/buttons/#active-state">
            Etat désactivé
        </doc-titre>

        <button type="button" class="btn btn-lg btn-primary" disabled>Primary button</button>
        <button type="button" class="btn btn-secondary btn-lg" disabled>Button</button>

        <hr class="my-4">
        <h1 class="display-2">Cards</h1>

        <doc-titre url="/components/card/#example">
            Exemple de carte
        </doc-titre>

        <div class="card" style="width: 30rem;">
            <img class="card-img-top" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22318%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20318%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_15f5027a063%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A16pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_15f5027a063%22%3E%3Crect%20width%3D%22318%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22117.625%22%20y%3D%2296.45%22%3E318x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title">Card title</h4>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>

        <hr class="my-4">
        <h1 class="display-2">Forms</h1>

        <doc-titre url="/components/forms/#overview">
            Exemple simple
        </doc-titre>

        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input">
                Check me out
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <doc-titre url="/components/forms/#form-controls">
            Inputs
        </doc-titre>

        <form>
            <div class="form-group">
                <label for="exampleFormControlInput1">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Example select</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect2">Example multiple select</label>
                <select multiple class="form-control" id="exampleFormControlSelect2">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Example textarea</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="exampleFormControlFile1">Example file input</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1">
            </div>
        </form>

        <doc-titre url="/components/forms/#sizing">
            Tailles des inputs
        </doc-titre>

        <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg">
        <br>
        <input class="form-control" type="text" placeholder="Default input">
        <br>
        <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm">

        <br><br>

        <select class="form-control form-control-lg">
            <option>Large select</option>
        </select>
        <br>
        <select class="form-control">
            <option>Default select</option>
        </select>
        <br>
        <select class="form-control form-control-sm">
            <option>Small select</option>
        </select>

        <doc-titre url="/components/forms/#overview">
            Lecture seule
        </doc-titre>

        <form>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword" placeholder="Password" readonly>
                </div>
            </div>
        </form>

        <doc-titre url="/components/forms/#checkboxes-and-radios">
            Checkbox et Radio - Stacked
        </doc-titre>

        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" value="">
                Option one is this and that&mdash;be sure to include why it's great
            </label>
        </div>
        <div class="form-check disabled">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" value="" disabled>
                Option two is disabled
            </label>
        </div>

        <br>

        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                Option one is this and that&mdash;be sure to include why it's great
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                Option two can be something else and selecting it will deselect option one
            </label>
        </div>
        <div class="form-check disabled">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" disabled>
                Option three is disabled
            </label>
        </div>

        <doc-titre url="/components/forms/#checkboxes-and-radios">
            Checkbox et Radio - Inline
        </doc-titre>

        <div>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1"> 1
                </label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2"> 2
                </label>
            </div>
            <div class="form-check form-check-inline disabled">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled> 3
                </label>
            </div>
        </div>

        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 1
            </label>
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 2
            </label>
        </div>
        <div class="form-check form-check-inline disabled">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled> 3
            </label>
        </div>

        <doc-titre url="/components/forms/#help-text">
            Texte d'aide
        </doc-titre>

        <label for="inputPassword5">Password</label>
        <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">
        <small id="passwordHelpBlock" class="form-text text-muted">
        Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
        </small>

        <br>

        <form class="form-inline">
            <div class="form-group">
                <label for="inputPassword6">Password</label>
                <input type="password" id="inputPassword6" class="form-control mx-sm-3" aria-describedby="passwordHelpInline">
                <small id="passwordHelpInline" class="text-muted">
                Must be 8-20 characters long.
                </small>
            </div>
        </form>

        <doc-titre url="/components/forms/#validation">
            Validation
        </doc-titre>

        <form>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="validationServer01">First name</label>
                    <input type="text" class="form-control is-valid" id="validationServer01" placeholder="First name" value="Mark" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationServer02">Last name</label>
                    <input type="text" class="form-control is-valid" id="validationServer02" placeholder="Last name" value="Otto" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="validationServer03">City</label>
                    <input type="text" class="form-control is-invalid" id="validationServer03" placeholder="City" required>
                    <div class="invalid-feedback">
                        Please provide a valid city.
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationServer04">State</label>
                    <input type="text" class="form-control is-invalid" id="validationServer04" placeholder="State" required>
                    <div class="invalid-feedback">
                        Please provide a valid state.
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationServer05">Zip</label>
                    <input type="text" class="form-control is-invalid" id="validationServer05" placeholder="Zip" required>
                    <div class="invalid-feedback">
                        Please provide a valid zip.
                    </div>
                </div>
            </div>

            <button class="btn btn-primary" type="submit">Submit form</button>
        </form>

        <hr class="my-4">
        <h1 class="display-2">Input group</h1>

        <doc-titre url="/components/input-group/#basic-example">
            Exemples
        </doc-titre>

        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">@</span>
            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <br>
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <span class="input-group-addon" id="basic-addon2">@example.com</span>
        </div>
        <br>
        <label for="basic-url">Your vanity URL</label>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon3">https://example.com/users/</span>
            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
        </div>
        <br>
        <div class="input-group">
            <span class="input-group-addon">$</span>
            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
            <span class="input-group-addon">.00</span>
        </div>
        <br>
        <div class="input-group">
            <span class="input-group-addon">$</span>
            <span class="input-group-addon">0.00</span>
            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
        </div>

        <hr class="my-4">
        <h1 class="display-2">List group</h1>

        <doc-titre url="/components/list-group/#active-items">
            Exemples
        </doc-titre>

        <ul class="list-group">
            <li class="list-group-item active">Cras justo odio</li>
            <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item">Morbi leo risus</li>
            <li class="list-group-item">Porta ac consectetur ac</li>
            <li class="list-group-item">Vestibulum at eros</li>
        </ul>

        <doc-titre url="/components/list-group/#contextual-classes">
            Contexte
        </doc-titre>

        <ul class="list-group">
            <li class="list-group-item">Dapibus ac facilisis in</li>

            <li class="list-group-item list-group-item-primary">This is a primary list group item</li>
            <li class="list-group-item list-group-item-secondary">This is a secondary list group item</li>
            <li class="list-group-item list-group-item-success">This is a success list group item</li>
            <li class="list-group-item list-group-item-danger">This is a danger list group item</li>
            <li class="list-group-item list-group-item-warning">This is a warning list group item</li>
            <li class="list-group-item list-group-item-info">This is a info list group item</li>
            <li class="list-group-item list-group-item-light">This is a light list group item</li>
            <li class="list-group-item list-group-item-dark">This is a dark list group item</li>
        </ul>

        <doc-titre url="/components/list-group/#with-badges">
            Avec badges
        </doc-titre>

        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Cras justo odio
                <span class="badge badge-primary badge-pill">14</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Dapibus ac facilisis in
                <span class="badge badge-primary badge-pill">2</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Morbi leo risus
                <span class="badge badge-primary badge-pill">1</span>
            </li>
        </ul>

        <doc-titre url="/components/list-group/#custom-content">
            Contenu custom
        </doc-titre>

        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
                <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">List group item heading</h5>
                <small>3 days ago</small>
                </div>
                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                <small>Donec id elit non mi porta.</small>
            </a>
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">List group item heading</h5>
                <small class="text-muted">3 days ago</small>
                </div>
                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                <small class="text-muted">Donec id elit non mi porta.</small>
            </a>
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">List group item heading</h5>
                <small class="text-muted">3 days ago</small>
                </div>
                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                <small class="text-muted">Donec id elit non mi porta.</small>
            </a>
        </div>

        <hr class="my-4">
        <h1 class="display-2">Progress</h1>

        <doc-titre url="/components/progress/">
            Exemples
        </doc-titre>

        <div class="progress">
            <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <br>
        <div class="progress">
            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <br>
        <div class="progress">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <br>
        <div class="progress">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <br>
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
        </div>
        <br>
        <div class="progress">
            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
        </div>

        <br>
    </div>
</template>

<script>
import Titre from '~/components/doc/DocTitre.vue';

export default {
    components: {
        'doc-titre': Titre
    }
}
</script>

<style scoped>
h2.h2:not(:first-child) {
    margin-top: 3rem;
}
</style>
