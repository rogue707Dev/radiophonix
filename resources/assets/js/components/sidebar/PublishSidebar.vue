<template>
    <div>

        <player-mini></player-mini>

        <div class="layout-sidebar__contenu">
            <div class="layout-sidebar__contenu-centre">



                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-12 text-center">

                        <i class="fa fa-rocket fa--sidebar"></i>
                        <div class="my-5 d-none d-lg-block">
                            <div class="fill--blanc">
                                <svg width="300px" height="50px">
                                    <use xlink:href="#logo"/>
                                </svg>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-12 centrage-parent">

                        <div class="centrage-enfant">
                            <p class="mb-4">
                                Cette section du site va permettre la gestion des sagas et la publication de leurs épisodes.
                            </p>
                            <p class="mb-4">
                                Vous pouvez suivre l'avancement du projet sur GitLab :
                            </p>
                            <a href="https://gitlab.com/Radiophonix/Radiophonix-Site" class="btn btn-sidebar">
                                <i class="fa fa-gitlab"></i>
                                Voir le code
                            </a>
                        </div>

                    </div>
                </div>




                <div class="row" v-if="1 == 2">
                    <div class="col-12">


                        <h1>Sidebar publish</h1>
                        {{ state.publish.saga.name }}
                        <ul>
                            <li><router-link :to="{ name: 'publish.saga.dashboard', params: { id: state.publish.saga.id } }">Dashboard</router-link></li>
                            <li><router-link :to="{ name: 'publish.saga.tracks', params: { id: state.publish.saga.id } }">Épisodes</router-link></li>
                            <li><router-link :to="{ name: 'publish.saga.calendar', params: { id: state.publish.saga.id } }">Calendrier</router-link></li>
                            <li><router-link :to="{ name: 'publish.saga.informations', params: { id: state.publish.saga.id } }">Informations</router-link></li>
                            <li><router-link :to="{ name: 'publish.saga.links', params: { id: state.publish.saga.id } }">Liens</router-link></li>
                            <li><router-link :to="{ name: 'publish.saga.images', params: { id: state.publish.saga.id } }">Images</router-link></li>
                            <li><router-link :to="{ name: 'publish.saga.authors', params: { id: state.publish.saga.id } }">Faiseurs</router-link></li>
                            <li><router-link :to="{ name: 'publish.saga.collections', params: { id: state.publish.saga.id } }">Collections</router-link></li>
                            <li><router-link :to="{ name: 'publish.saga.settings', params: { id: state.publish.saga.id } }">Paramètres</router-link></li>
                        </ul>


                    </div>
                </div>



            </div>
        </div>

    </div>
</template>

<script>
import PlayerMini from '~/components/player/PlayerMini.vue';

export default {
    components: {
        PlayerMini,
    }
}
</script>
