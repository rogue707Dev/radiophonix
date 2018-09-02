<template>
    <li>
        <router-link :to="{ name: 'listen.sagas.show', params: { idOrSlug: saga.slug } }">
            <div class="jaquette--grande jaquette--saga zone-interactive__border">
                <img :src="saga.images.cover.main" alt="" height="340px" width="340px">
            </div>
            <div class="zone-interactive zone-interactive__colle-cadre border-top-0">
                <div class="zone-interactive__info p-1">
                    <router-link :to="{ name: 'listen.sagas.show', params: { idOrSlug: saga.slug } }">
                        <p class="titre-liste-jaquette-saga">{{ saga.name }}</p>
                        <p class="texte-rouge texte-petit">
                            <saga-stats
                                :stats="saga.stats"
                                :with-icon="true">
                            </saga-stats>
                        </p>
                    </router-link>
                    <p>
                        <router-link :to="{ name: 'listen.authors.show', params: { id: saga.author.slug } }">
                            Par {{ saga.author.name }}
                        </router-link>
                    </p>
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
        </router-link>
    </li>
</template>

<script>
import SagaStats from '~/components/saga/SagaStats.vue';

export default {
    props: ['saga'],

    components: {
        SagaStats,
    }
}
</script>
