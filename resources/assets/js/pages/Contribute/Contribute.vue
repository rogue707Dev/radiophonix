<template>
    <div>

        <p class="lead">
            Radiophonix est actuellement en <span class="badge badge-warning">Beta</span>
        </p>

        <p class="mt-3 mb-5">
            Les contributions sont les bienvenues !<br />
            Il est possible de contribuer au projet de plusieurs façons.
        </p>

        <h2 class="h2">Suggestions et bugs</h2>
        <hr>

        <p class="mt-3">
            Envoyez nous vos idées et suggestions pour le projet !<br />
            <br />
        </p>

        <social-cards />

        <h2 class="h2 mt-5">Le code</h2>
        <hr>

        <p class="mt-3">
            Le code source de tout le site est open-source et libre d'accès sur
            <a class="lien-paragraphe" href="https://gitlab.com/Radiophonix/Radiophonix">GitLab</a>.
            <br />
            Tout est développé de façon publique,
            <a class="lien-paragraphe" href="https://gitlab.com/Radiophonix/Radiophonix/commits/dev">le code</a>
            et <a class="lien-paragraphe" href="https://gitlab.com/Radiophonix/Radiophonix/issues">la gestion du projet</a>.<br />
            <br />
            N'hésitez pas à lire <a href="https://radiophonix.gitlab.io/Radiophonix/contribuer/" class="lien-paragraphe">la documentation</a>.<br />
            <br />
            La plateforme est composée de deux briques essentielles : le site et l'API.<br/>
            <br />
        </p>

        <div class="row mt-3">
            <div class="col-12 col-md-6">

                <h3 class="h3 mb-4">
                    <span class="text-success">{</span> Site <span class="text-success">}</span>
                </h3>

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
            <div class="col-12 col-md-6">

                <h3 class="h3 mb-4">
                    <span class="text-success">{</span> API <span class="text-success">}</span>
                </h3>

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
    <span class="text-danger">public function</span> api(): Saga
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
    import DiscordInvite from '~/components/Social/Discord/DiscordInvite';
    import FaIcon from "~/components/Ui/Icon/FaIcon";
    import SocialCards from "~/components/Social/SocialCards";

    export default {
        components: {
            SocialCards,
            FaIcon,
            Headband,
            DiscordInvite,
        },
    }
</script>
