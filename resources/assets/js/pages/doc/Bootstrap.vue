<template>
    <div>

        <div class="jumbotron" id="ancre-radiophonix">
            <h1 class="display-1 text-white">Composent Radiophonix</h1>
            <p>
                <a class="btn btn-primary" href="http://getbootstrap.com/docs/4.0/getting-started/introduction/" role="button">Documentation de Bootstrap</a>
            </p>
        </div>
        <div class="container">


            <h1 class="display-3">Couleur accessible</h1>

            <h1 class="display-4 mt-2">$blanc: #ffffff;</h1>
            <div style="background:#fff">
                <div style="color:#627485">$bleu-300: #627485</div>
                <div style="color:#262f38">$bleu-500: #262f38</div>
                <div style="color:#D73F3C">$rouge-300: #D73F3C</div>
            </div>

            <h1 class="display-4 mt-2">$bleu-100: #ebeff4;</h1>
            <div style="background:#ebeff4">
                <div style="color:#5C6F80">$bleu-350: #5C6F80;</div>
                <div style="color:#CA342D">$rouge-400: #CA342D;</div>
            </div>

            <h1 class="display-4 mt-2">$bleu-400: #3a4651;</h1>
            <div style="background:#3a4651">
                <div style="color:#FFFFFF">$blanc: #FFFFFF</div>
                <div style="color:#F19C7C">$orange-250: #F19C7C;</div>
            </div>

            <h1 class="display-4 mt-2">$bleu-500: #262f38;</h1>
            <div style="background:#262f38">
                <div style="color:#FFFFFF">$blanc: #FFFFFF</div>
                <div style="color:#bdcadb">$bleu-200: #bdcadb;</div>
            </div>

            <h1 class="display-4 mt-2">$rouge-300: #D73F3C;</h1>
            <div style="background:#D73F3C">
                <div style="color:#FFFFFF">$blanc: #FFFFFF</div>
            </div>

            <h1 class="display-4 mt-2">ASIDE - Wip</h1>
            <div style="background:#eda280;">
                <div style=" color:#fff">background:#eda280; color:#fff : KO</div>
                <div style=" color:#3a4651">background:#eda280; color:#3a4651 : OK</div>
                <div style=" color:#262f38">background:#eda280; color:#262f38 : OK</div>
                <s style=" color:#627485">background:#eda280; color:#627485 : KO</s>
                <div style=" color:#35485E">background:#eda280; color:#35485E : OK</div>
            </div>

            <div style="background:#F19C7C;">
                <div style=" color:#fff">background:#F19C7C; color:#fff : KO</div>
                <div style=" color:#3a4651">background:#F19C7C; color:#3a4651 : OK</div>
                <div style=" color:#262f38">background:#F19C7C; color:#262f38 : OK</div>
                <s style=" color:#627485">background:#F19C7C; color:#627485 : KO</s>
                <div style=" color:#304661">background:#F19C7C; color:#304661 : OK</div>
            </div>










            <h1 class="display-3">Cover : Petite</h1>
            <div class="cover var--petit var--saga">
                <div class="cover__mask">
                    <img src="http://facetheforce.today/random/340?r=2">
                </div>
            </div>
            <div class="cover var--petit var--auteur">
                <div class="cover__mask">
                    <img src="http://facetheforce.today/random/340?r=2">
                </div>
            </div>
            <div class="cover var--petit var--episode">
                <div class="cover__mask">
                    <img src="http://facetheforce.today/random/340?r=2">
                </div>
            </div>
            <div class="cover var--petit var--genre">
                <svg><use xlink:href="#contour-genre"></use></svg>
                <div class="cover__mask">
                    <img src="http://facetheforce.today/random/340?r=2">
                </div>
            </div>
            <div class="cover var--petit var--badge">
                <div class="cover__mask">
                    <img src="http://facetheforce.today/random/340?r=2">
                </div>
            </div>
            <hr class="my-5">




            <h1 class="display-3">Cover : Moyenne</h1>
            <div class="cover var--moyen var--auteur">
                <div class="cover__mask">
                    <img src="http://facetheforce.today/random/340?r=2">
                </div>
            </div>
            <div class="cover var--moyen var--saga">
                <div class="cover__mask">
                    <img src="http://facetheforce.today/random/340?r=2">
                </div>
            </div>
            <div class="cover var--moyen var--episode">
                <div class="cover__mask">
                    <img src="http://facetheforce.today/random/340?r=2">
                </div>
            </div>
            <div class="cover var--moyen var--genre">
                <svg><use xlink:href="#contour-genre"></use></svg>
                <div class="cover__mask">
                    <img src="http://facetheforce.today/random/340?r=2">
                </div>
            </div>
            <hr class="my-5">






            <h1 class="display-3">Carte Horizontal avec Cover</h1>
            <div class="list-card-horizontal">
                <a href="#" class="card var--horizontal">
                    <div class="card-cover">
                        <div class="cover var--petit var--episode">
                            <div class="cover__mask">
                                <img src="http://facetheforce.today/random/340?r=2">
                            </div>
                        </div>
                    </div>
                    <div class="card-button">
                        <i data-v-5f801cbc="" aria-hidden="true" class="fa fa-plus"></i>
                        <i data-v-5f801cbc="" aria-hidden="true" class="fa fa-heart"></i>
                    </div>
                    <div class="card-body">
                        <p class="h3 text-body">
                            Présentation
                            <span class="badge badge-light badge-sm">Episode</span>
                        </p>
                        <p class="text-primary h5">
                            <i aria-hidden="true" class="fa fa-clock-o"></i> 3m, 45s
                        </p>
                    </div>
                </a>

                <a href="#" class="card var--horizontal">
                    <div class="card-cover">
                        <div class="cover var--petit var--auteur">
                            <div class="cover__mask">
                                <img src="http://facetheforce.today/random/340?r=2">
                            </div>
                        </div>
                    </div>
                    <div class="card-button">
                        <i data-v-5f801cbc="" aria-hidden="true" class="fa fa-plus"></i>
                        <i data-v-5f801cbc="" aria-hidden="true" class="fa fa-heart"></i>
                    </div>
                    <div class="card-body">
                        <p class="h3 text-body">
                            Pen Of Chaos
                            <span class="badge badge-light badge-sm">Auteur</span>
                        </p>
                        <p class="text-primary h5">
                            <i aria-hidden="true" class="fa fa-file-audio-o"></i> 2 Séries
                        </p>
                    </div>
                </a>

                <a href="#" class="card var--horizontal">
                    <div class="card-cover">
                        <div class="cover var--petit var--genre">
                            <svg><use xlink:href="#contour-genre"></use></svg>
                            <div class="cover__mask">
                                <img src="http://facetheforce.today/random/340?r=2">
                            </div>
                        </div>
                    </div>
                    <div class="card-button">
                        <i data-v-5f801cbc="" aria-hidden="true" class="fa fa-plus"></i>
                        <i data-v-5f801cbc="" aria-hidden="true" class="fa fa-heart"></i>
                    </div>
                    <div class="card-body">
                        <p class="h3 text-body">
                            Heroic fantasy
                            <span class="badge badge-light badge-sm">Genre</span>
                        </p>
                        <p class="text-primary h5">
                            <i aria-hidden="true" class="fa fa-file-audio-o"></i> 2 Séries
                        </p>
                    </div>
                </a>

                <a href="#" class="card var--horizontal">
                    <div class="card-cover">
                        <div class="cover var--petit var--saga">
                            <div class="cover__mask">
                                <img src="http://facetheforce.today/random/340?r=2">
                            </div>
                        </div>
                    </div>
                    <div class="card-button">
                        <i data-v-5f801cbc="" aria-hidden="true" class="fa fa-plus"></i>
                        <i data-v-5f801cbc="" aria-hidden="true" class="fa fa-heart var--actif"></i>
                    </div>
                    <div class="card-body">
                        <p class="h3 text-body">
                            Le Donjon de Naheulbeuk
                            <span class="badge badge-light badge-sm">Saga</span>
                        </p>
                        <p class="text-primary h5">
                            <i aria-hidden="true" class="fa fa-podcast"></i> 2 Saison - 30 Épisodes
                        </p>
                    </div>
                </a>
            </div>
            <hr class="my-5">









            <h1 class="display-3">Carte avec Cover</h1>
            <div class="list-card">


                <a href="#" class="card">
                    <div class="card-cover">
                        <div class="cover var--moyen var--episode">
                            <div class="cover__mask">
                                <img src="http://facetheforce.today/random/340?r=2">
                            </div>
                        </div>
                    </div>
                    <div class="card-button">
                        <i data-v-5f801cbc="" aria-hidden="true" class="fa fa-plus"></i>
                        <i data-v-5f801cbc="" aria-hidden="true" class="fa fa-heart"></i>
                    </div>
                    <div class="card-body">
                        <p class="h3 text-body">
                            Présentation
                            <span class="badge badge-light badge-sm">Episode</span>
                        </p>
                        <p class="text-primary h5">
                            <i aria-hidden="true" class="fa fa-clock-o"></i> 3m, 45s
                        </p>
                    </div>
                </a>

                <a href="#" class="card">
                    <div class="card-cover">
                        <div class="cover var--moyen var--auteur">
                            <div class="cover__mask">
                                <img src="http://facetheforce.today/random/340?r=2">
                            </div>
                        </div>
                    </div>
                    <div class="card-button">
                        <i data-v-5f801cbc="" aria-hidden="true" class="fa fa-plus"></i>
                        <i data-v-5f801cbc="" aria-hidden="true" class="fa fa-heart"></i>
                    </div>
                    <div class="card-body">
                        <p class="h3 text-body">
                            Pen Of Chaos
                            <span class="badge badge-light badge-sm">Auteur</span>
                        </p>
                        <p class="text-primary h5">
                            <i aria-hidden="true" class="fa fa-file-audio-o"></i> 2 Séries
                        </p>
                    </div>
                </a>

                <a href="#" class="card">
                    <div class="card-cover">
                        <div class="cover var--moyen var--genre">
                            <svg><use xlink:href="#contour-genre"></use></svg>
                            <div class="cover__mask">
                                <img src="http://facetheforce.today/random/340?r=2">
                            </div>
                        </div>
                    </div>
                    <div class="card-button">
                        <i data-v-5f801cbc="" aria-hidden="true" class="fa fa-plus"></i>
                        <i data-v-5f801cbc="" aria-hidden="true" class="fa fa-heart"></i>
                    </div>
                    <div class="card-body">
                        <p class="h3 text-body">
                            Heroic fantasy
                            <span class="badge badge-light badge-sm">Genre</span>
                        </p>
                        <p class="text-primary h5">
                            <i aria-hidden="true" class="fa fa-file-audio-o"></i> 2 Séries
                        </p>
                    </div>
                </a>

                <a href="#" class="card">
                    <div class="card-cover">
                        <div class="cover var--moyen var--saga">
                            <div class="cover__mask">
                                <img src="http://facetheforce.today/random/340?r=2">
                            </div>
                        </div>
                    </div>
                    <div class="card-button">
                        <i data-v-5f801cbc="" aria-hidden="true" class="fa fa-plus"></i>
                        <i data-v-5f801cbc="" aria-hidden="true" class="fa fa-heart var--actif"></i>
                    </div>
                    <div class="card-body">
                        <p class="h3 text-body">
                            Le Donjon de Naheulbeuk
                            <span class="badge badge-light badge-sm">Saga</span>
                        </p>
                        <p class="text-primary h5">
                            <i aria-hidden="true" class="fa fa-podcast"></i> 2 Saison - 30 Épisodes
                        </p>
                    </div>
                </a>


            </div>
            <hr class="my-5">






            <h1 class="display-3">Nav</h1>
            Peut etre aussi réalisé en ul li voir source
            <br>
            Les textes sont de la meme taille qu'un <code>.h1</code>
            <nav class="nav mb-4">
                <span class="nav-link active">active</span>
                <span class="nav-link">normal</span>
                <span class="nav-link">normal</span>
                <span class="nav-link disabled">disabled</span>
            </nav>
            <!--
            <ul class="nav justify-content-center mb-4">
                <li class="nav-item">
                    <a class="nav-link active" href="#">active</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">normal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">normal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">disabled</a>
                </li>
            </ul>
            -->
            <hr class="my-5">




            <h1 class="display-3">Jumbotron</h1>
            Ne doit pas etre contenu dans "container"
            <div class="jumbotron">
                Jumboron classique
            </div>
            <div class="jumbotron var--bg-image" style="background-image: url(&quot;/static/home/ecouter.jpeg&quot;);">
                <div class="jumbotron-bg-image__filtre">
                    <div class="container jumbotron-bg-image__content">
                        .jumboron.var--bg-image
                        <br>
                        Avec un structure pour centrer le texte et ajouter un filtre au bg
                    </div>
                </div>
            </div>
            <hr class="my-5">




            <h1 class="display-3">SVG</h1>
            <div style="background-color: #F19C7C">
                <svg width="280px" height="50px" class="fill--logo-bleu">
                    <use xlink:href="#logo-part1of2"></use>
                    <use xlink:href="#logo-part2of2"></use>
                </svg>
            </div>
            <div style="background-color: #262f38">
                <svg width="280px" height="50px">
                    <use class="fill--logo-orange" xlink:href="#logo-part1of2"></use>
                    <use class="fill--logo-blanc" xlink:href="#logo-part2of2"></use>
                </svg>
            </div>
            <hr class="my-5">







            <h1 class="display-3">Text</h1>
            <p>Les taille des balises "h1, h2, h3, h4, h5 et h6" sont "inherit"</p>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Class</th>
                    <th>Apercus</th>
                    <th>Type</th>
                    <th>Couleur</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>.display-1</td>
                    <td class="display-1">Hello</td>
                    <td>display</td>
                    <td>inherit</td>
                </tr>
                <tr>
                    <td>.display-2</td>
                    <td class="display-2">Hello</td>
                    <td>display</td>
                    <td>inherit</td>
                </tr>
                <tr>
                    <td>.display-3</td>
                    <td class="display-3">Hello</td>
                    <td>display</td>
                    <td>inherit</td>
                </tr>
                <tr>
                    <td>.display-4</td>
                    <td class="display-4">Hello</td>
                    <td>display</td>
                    <td>inherit</td>
                </tr>

                <tr>
                    <td>.h1</td>
                    <td class="h1">Hello</td>
                    <td>h</td>
                </tr>
                <tr>
                    <td>.h2</td>
                    <td class="h2">Hello</td>
                    <td>h</td>
                </tr>
                <tr>
                    <td>.h3</td>
                    <td class="h3">Hello</td>
                    <td>h</td>
                </tr>
                <tr>
                    <td>.h4</td>
                    <td class="h4">Hello</td>
                    <td>h</td>
                </tr>

                <tr>
                    <td>.lead</td>
                    <td class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit</td>
                    <td>paragraphe</td>
                </tr>
                <tr>
                    <td>(default)</td>
                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit</td>
                    <td>paragraphe</td>
                    <td>inherit</td>
                </tr>
                <tr>
                    <td>.h5</td>
                    <td class="h5">Lorem ipsum dolor sit amet, consectetur adipisicing elit</td>
                    <td>h</td>
                    <td>inherit</td>
                </tr>
                <tr>
                    <td>.h6</td>
                    <td class="h6">Lorem ipsum dolor sit amet, consectetur adipisicing elit</td>
                    <td>h</td>
                    <td>inherit</td>
                </tr>
                </tbody>
            </table>
            <hr class="my-5">






            <h1 class="display-3">Couleur de texte</h1>
            <div>
                <h2 class="h2">Theme Color</h2>
                <div class="row">
                    <div class="col">
                        <p>Texte par defaut</p>
                        <p class="text-body">.text-body</p>
                    </div>
                    <div class="col" style="background-color: #EBEFF4">
                        <p><a href="#" class="lien-paragraphe">.lien-paragraphe</a></p>
                        <p><a href="#" class="text-body">Lien couleur body (defaut)</a></p>
                    </div>
                </div>
                <br>
                <h2 class="h2">Bootstrap</h2>
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
            <hr class="my-5">







            <h1 class="display-3 mt-5">Graisse et transform</h1>
            <p class="font-weight-bold">Hello .font-weight-bold (700)</p>
            <p class="font-weight-normal">Hello .font-weight-normal (400)</p>
            <p class="font-weight-light">Hello .font-weight-light (300)</p>
            <br>
            <p class="font-italic">Hello .font-italic</p>
            <br>
            <p class="text-lowercase">Hello .text-lowercase</p>
            <p class="text-uppercase">Hello .text-uppercase</p>
            <p class="text-capitalize">Hello .text-capitalize</p>
            <hr class="my-5">





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
            <hr class="my-5">








            <h1 class="display-2">Badges</h1>

            <doc-titre url="/components/badge/#example">
                Exemple
            </doc-titre>

            <h1 class="h1">Example heading <span class="badge badge-secondary">New</span></h1>
            <h2 class="h2">Example heading <span class="badge badge-secondary">New</span></h2>
            <h3 class="h3">Example heading <span class="badge badge-secondary">New</span></h3>
            <h4 class="h4">Example heading <span class="badge badge-secondary">New</span></h4>
            <p>Example paragraphe <span class="badge badge-secondary">New</span></p>
            <h5 class="h5">Example heading <span class="badge badge-secondary">New</span></h5>
            <h6 class="h6">Example heading <span class="badge badge-secondary">New</span></h6>

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

            <doc-titre url="/components/badge/#pill-badges">
                Badges en versions lien
            </doc-titre>
            <a href="#" class="badge badge-primary">Primary</a>
            <a href="#" class="badge badge-secondary">Secondary</a>
            <a href="#" class="badge badge-success">Success</a>
            <a href="#" class="badge badge-danger">Danger</a>
            <a href="#" class="badge badge-warning">Warning</a>
            <a href="#" class="badge badge-info">Info</a>
            <a href="#" class="badge badge-light">Light</a>
            <a href="#" class="badge badge-dark">Dark</a>
            <hr class="my-5">








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
            <hr class="my-5">









            <a href="http://getbootstrap.com/docs/4.0/components/buttons/#examples" class="display-2">Boutons</a>
            <div>
                <h3 class="h1 mt-4">Rond pour icone</h3>
                <button type="button" class="btn btn-outline-primary btn-round"><i class="fa fa-volume-up" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-outline-secondary btn-round"><i class="fa fa-volume-up" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-outline-success btn-round"><i class="fa fa-volume-up" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-outline-danger btn-round"><i class="fa fa-volume-up" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-outline-warning btn-round"><i class="fa fa-volume-up" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-outline-info btn-round"><i class="fa fa-volume-up" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-outline-light btn-round"><i class="fa fa-volume-up" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-outline-dark btn-round"><i class="fa fa-volume-up" aria-hidden="true"></i></button>
                <br>
                <br>
                <div class="row">
                    <div class="col-6">
                        <button type="button" class="btn btn-outline-theme btn-round"><i class="fa fa-volume-up" aria-hidden="true"></i></button>
                        <br>
                        .btn-outline-theme
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-outline-primary btn-round btn-sm"><i class="fa fa-volume-up" aria-hidden="true"></i></button>
                        <button type="button" class="btn btn-outline-warning btn-round"><i class="fa fa-volume-up" aria-hidden="true"></i></button>
                        <button type="button" class="btn btn-outline-theme btn-round btn-lg"><i class="fa fa-volume-up" aria-hidden="true"></i></button>
                        <br>
                        Existe en petit, normal et grand
                    </div>
                </div>

            </div>


            <div>
                <h3 class="h1 mt-4">Avec Icon "Font Awesome"</h3>
                Fonctionne avec tous les boutons
                <button type="button" class="btn btn-primary"><i class="fa fa-volume-up" aria-hidden="true"></i>Primary</button>
                <button type="button" class="btn btn-outline-secondary"><i class="fa fa-volume-up" aria-hidden="true"></i>outline Secondary</button>
            </div>

            <div>
                <h1 class="h1 mt-4">Grands</h1>
                <button type="button" class="btn btn-primary btn-lg">Primary</button>
                <button type="button" class="btn btn-secondary btn-lg">Secondary</button>
                <button type="button" class="btn btn-success btn-lg">Success</button>
                <button type="button" class="btn btn-danger btn-lg">Danger</button>
                <button type="button" class="btn btn-warning btn-lg">Warning</button>
                <button type="button" class="btn btn-info btn-lg">Info</button>
                <button type="button" class="btn btn-light btn-lg">Light</button>
                <button type="button" class="btn btn-dark btn-lg">Dark</button>
                <button type="button" class="btn btn-link btn-lg">Link</button>
                <button type="button" class="btn btn-primary btn-lg">Homepage</button>
            </div>

            <div>
                <h1 class="h1 mt-4">Normaux</h1>
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
                <h1 class="h1 mt-4">Petits</h1>
                <button type="button" class="btn btn-primary btn-sm">Primary</button>
                <button type="button" class="btn btn-secondary btn-sm">Secondary</button>
                <button type="button" class="btn btn-success btn-sm">Success</button>
                <button type="button" class="btn btn-danger btn-sm">Danger</button>
                <button type="button" class="btn btn-warning btn-sm">Warning</button>
                <button type="button" class="btn btn-info btn-sm">Info</button>
                <button type="button" class="btn btn-light btn-sm">Light</button>
                <button type="button" class="btn btn-dark btn-sm">Dark</button>
                <button type="button" class="btn btn-link btn-sm">Link</button>
            </div>

            <div>
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
            </div>

            <div>
                <doc-titre url="/components/buttons/#active-state">
                    Etat actif
                </doc-titre>
                <a href="#" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Primary link</a>
                <a href="#" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Link</a>
            </div>

            <div>
                <doc-titre url="/components/buttons/#active-state">
                    Etat désactivé
                </doc-titre>
                <button type="button" class="btn btn-lg btn-primary" disabled>Primary button</button>
                <button type="button" class="btn btn-secondary btn-lg" disabled>Button</button>
            </div>

            <hr class="my-5">









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
            <hr class="my-5">









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
            <hr class="my-5">









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
            <hr class="my-5">









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
            <hr class="my-5">






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


</style>
