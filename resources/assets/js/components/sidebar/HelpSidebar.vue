<template>
    <div>

        <player-mini></player-mini>

        <div class="layout-sidebar__contenu">
            <div class="layout-sidebar__contenu-centre">



                <div class="row text-center">
                    <div class="col-12">

                        <i class="fa fa-info-circle fa--sidebar"></i>
                        <p class="titre-sidebar">Aide</p>

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
