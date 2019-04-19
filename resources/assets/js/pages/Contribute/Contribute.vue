<template>
    <div>

        <p class="lead">
            Radiophonix est actuellement en <span class="badge badge-warning">Beta</span>
        </p>

        <p class="mt-3">
            Les contributions sont les bienvenues !<br />
            Vous pouvez participer à la création du site en contribuant au code sur GitLab ou en
            signalant les bugs rencontrés.<br />
            <br />
            La plateforme est composée de deux briques essentielles : le site et l'API.<br/>
            <br/>
            Pour voir le code c'est <a href="https://gitlab.com/Radiophonix/Radiophonix" class="lien-paragraphe">par ici</a> !<br/>
            Pour signaler des bugs c'est <a href="https://gitlab.com/Radiophonix/Radiophonix/issues" class="lien-paragraphe">par ici</a> !<br />
            Vous pouvez également rejoindre le <lien-discord /> !
        </p>

        <div class="row mt-3">
            <div class="col">

                <h2 class="h1 mb-4">
                    <span class="text-success">{</span> Site <span class="text-success">}</span>
                </h2>

                <p>
                    Le site est écrit en JavaScript à l'aide de <a href="https://vuejs.org" class="lien-paragraphe">Vue.js</a><br/>
                    <br />
                    Il permet d'écouter, de parcourir et de publier des sagas. Vous êtes dessus en
                    ce moment même !<br />
                    <br />
                    Le code est disponible sur <a href="https://gitlab.com/Radiophonix/Radiophonix" class="lien-paragraphe">GitLab</a>
                </p>

            <pre class="mt-4 bg-light" style="padding: 5px;"><code>&lt;<span class="text-success">template</span>&gt;
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
        </div>
        <div class="row">
            <div class="col">

                <h2 class="h1 mb-4">
                    <span class="text-success">{</span> API <span class="text-success">}</span>
                </h2>

                <p>
                    L'API est écrite en PHP à l'aide de <a href="https://laravel.com/" class="lien-paragraphe">Laravel</a>.<br />
                    <br />
                    Elle permet d'intéragir avec les données de Radiophonix (sagas, saisons, épisodes, auteurs, etc.).<br />
                    <br />
                    Le code est disponible sur <a href="https://gitlab.com/Radiophonix/Radiophonix" class="lien-paragraphe">GitLab</a>
                </p>

                <pre class="mt-4 bg-light" style="padding: 5px;"><code>&lt;?php

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
    import Headband from '~/components/content/Headband.vue';
    import LienDiscord from '~/components/doc/LienDiscord';

    export default {
        components: {
            Headband,
            LienDiscord,
        },
    }
</script>
