<template>
    <div>


        <player-mini></player-mini>




        <div class="layout-sidebar__contenu">
            <div class="layout-sidebar__contenu-centre">




                <div class="row text-center">
                    <div class="col-sm-12 col-md-6 col-lg-12">

                        <i class="fa fa-gitlab fa--sidebar"></i>

                        <p class="titre-sidebar">
                            Radiophonix est un projet
                            <br>
                            open source
                        </p>

                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-12 centrage-parent">

                        <div class="centrage-enfant">

                            <p class="text-center mt-5 mt-md-0 mt-lg-5">
                                <a href="https://gitlab.com/Radiophonix/Radiophonix" class="btn btn-sidebar mx-5 mt-1 mt-lg-0">
                                    <i class="fa fa-gitlab"></i>
                                    Voir le code
                                </a>
                            </p>

                        </div>





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
