<template>
    <div class="layout-conteneur__main">

        <h1 class="display-1 mb-4">Contribuer au projet</h1>

        <p class="lead">
            Radiophonix est actuellement en <span class="badge badge-danger">Alpha</span>
        </p>

        <p class="mt-5">
            Les contributions sont les bienvenues !<br />
            Vous pouvez participer à la création du site en contribuant au code sur GitLab ou en
            signalant les bugs rencontrés.<br />
            <br />
            La plateforme est composée de deux briques essentielles : le site et l'API.
        </p>

        <div class="row mt-5">
            <div class="col">

                <h2 class="h1 mb-4">
                    <span class="text-success">{</span> Site <span class="text-success">}</span>
                </h2>

                <p>
                    Le site est écrit en JavaScript à l'aide de <a href="https://vuejs.org" class="lien-paragraphe">Vue.js</a><br/>
                    <br />
                    Il permet d'écouter, de parcourir et de publier des sagas.<br />
                    <br />
                    Le code est disponible sur <a href="https://gitlab.com/Radiophonix/Radiophonix" class="lien-paragraphe"><i class="fa fa-gitlab"></i> GitLab</a>
                </p>

                <pre class="mt-5 bg-light"><code>&lt;<span class="text-success">template</span>&gt;
    &lt;<span class="text-success">player</span>&gt;
        &lt;<span class="text-success">button</span> @<span class="text-warning">click</span>="play"&gt;C'est parti !&lt;<span class="text-success">button</span>&gt;
    &lt;/<span class="text-success">player</span>&gt;
&lt;/<span class="text-success">template</span>&gt;

&lt;<span class="text-success">script</span>&gt;
<span class="text-danger">import</span> Radiophonix <span class="text-danger">from</span> '<span class="text-success">radiophonix</span>';

<span class="text-danger">let</span> saga <span class="text-danger">= await</span> Radiophonix.sagas.find(<span class="text-info">1</span>);
&lt;/<span class="text-success">script</span>&gt;
</code></pre>

            </div>

            <div class="col">

                <h2 class="h1 mb-4">
                    <span class="text-success">{</span> API <span class="text-success">}</span>
                </h2>

                <p>
                    L'API est écrite en PHP à l'aide de <a href="https://laravel.com/" class="lien-paragraphe">Laravel</a>.<br />
                    <br />
                    Elle permet d'intéragir avec les données de Radiophonix (sagas, saisons, épisodes, faiseurs, etc.).<br />
                    <br />
                    Le code est disponible sur <a href="https://gitlab.com/Radiophonix/Radiophonix" class="lien-paragraphe"><i class="fa fa-gitlab"></i> GitLab</a>
                </p>

                <pre class="mt-5 bg-light"><code>&lt;?php

<span class="text-danger">namespace</span> Radiophonix\Api;

<span class="text-danger">class</span> Radiophonix
{
    <span class="text-danger">public function</span> api()
    {
        <span class="text-danger">return new</span> Saga();
    }
}
</code></pre>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            vue: `<template>
    <player>
        <button @click="play">C'est partit !</button>
    </player>
</template>`
        };
    }
}
</script>
