<template>
    <div>
        <headband
                urlImage="/static/home/faq.jpg"
                title="F.A.Q."
                subtitle="Vous êtes perdu ?">
        </headband>

        <div class="container">

            <div class="row">
                <div class="col-12 col-xl-10">

                    <h2 class="h1 mb-2">Qu'est-ce que Radiophonix ?</h2>
                    <p>
                        Radiophonix est une plateforme libre et gratuite de partage et
                        d'écoute de sagas MP3.<br/>
                        L'ambition de ce projet est de redonner vie à ce super média qu'est
                        la saga MP3 en créant une plateforme qui facilite la publication et
                        l'écoute des sagas.<br/>
                        <br/>
                        Ce projet est inspiré par les diverses tentatives de site similaire qui
                        n'ont hélas jamais vu le jour, notamment l'<a title="Lien wiki Agoraphonix" href="https://wiki.netophonix.com/Agoraphonix" class="lien-paragraphe">Agoraphonix</a>.<br/>
                        Le nom du projet est bien évidemment inspiré de
                        <a title="Lien Netophonix" href="https://netophonix.com/" class="lien-paragraphe">Netophonix</a>.
                    </p>

                    <h2 class="h1 mb-2 mt-5">Qui êtes-vous ?</h2>
                    <p>
                        Nous sommes un développeur web (<a href="http://mopolo.fr/" class="lien-paragraphe">Nathan</a>)
                        et un UX Designer (<a href="http://www.pierre.tl" class="lien-paragraphe">Pierre</a>)
                        professionnels, passionnés de sagas MP3.<br/>
                        Faire des sites est notre métier depuis plusieurs années, ce qui
                        nous permet de développer ce projet.<br/>
                        Rejoignez-nous sur <lien-discord /> !
                    </p>

                    <h2 class="h1 mb-2 mt-5">Qu'est-ce qu'une Saga MP3 ?</h2>
                    <blockquote class="blockquote mb-5">
                        <p>
                            Une saga mp3 est le nom donné à une histoire se déroulant dans
                            un univers le plus souvent imaginaire, diffusée sur Internet
                            sous la forme d'un ou plusieurs fichiers sonores historiquement
                            encodés au format MP3. La saga MP3 s'éloigne du livre audio,
                            car contrairement à celui-ci, son histoire n'est pas lue mais
                            interprétée et suit davantage le concept des aventures radiophoniques.
                            Rapidement après leur apparition au début des années 2000, le nombre
                            des sagas MP3 en téléchargement libre a explosé.
                        </p>
                        <footer class="blockquote-footer">
                            <a href="https://wiki.netophonix.com/Saga_MP3" class="lien-paragraphe">
                                Extrait du Netowiki
                            </a>
                        </footer>
                    </blockquote>

                    <h2 class="h1 mb-2 mt-5">Qu'est-ce qu'un faiseur ?</h2>
                    <p>
                        Faiseur est le terme utilisé pour désigner un créateur de saga.<br/>
                    </p>

                    <h2 class="h1 mb-2 mt-5">Une plateforme libre et gratuite ?</h2>
                    <p>
                        Radiophonix est développé de façon ouverte sur
                        <a href="https://gitlab.com/Radiophonix/Radiophonix" class="lien-paragraphe">GitLab</a>.<br/>
                        Le code est sous licence MIT et les contributions sont les bienvenues !<br/>
                        <br/>
                        Le site est gratuit et les sagas actuellement présentes ont une licence
                        Creative Commons (dont certaines interdisent la vente en plus).
                    </p>

                    <h2 class="h1 mb-2 mt-5">Est-ce que je peux aider ?</h2>
                    <p>
                        Bien sûr !<br/>
                        <br/>
                        Il est possible d'aider de plusieurs façons :
                        <br/>
                        <a href="https://gitlab.com/Radiophonix/Radiophonix/issues" class="lien-paragraphe">En signalant des bugs</a><br/>
                        <a href="https://gitlab.com/Radiophonix/Radiophonix" class="lien-paragraphe">En contribuant au code</a><br/>
                        Si vous ne savez pas programmer vous pouvez aussi aider !<br/>
                        Rejoignez-nous sur <lien-discord /> pour signaler des bugs et partager votre avis.
                    </p>

                    <h2 class="h1 mb-2 mt-5">Où sont hébergés les fichiers ?</h2>
                    <p>
                        Certaines sagas ont des liens direct vers leurs fichiers. Dans
                        ce cas ces liens sont utilisés.<br/>
                        D'autres sagas n'ayant pas de liens, nous avons hébergés les
                        fichiers le temps de l'alpha pour que le lecteur fonctionne.
                    </p>

                </div>
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
