<template>
    <router-link
            class="card border-saga"
            :to="{ name: 'listen.sagas.show', params: { idOrSlug: saga.slug } }">
        <div class="card-jacket--saga bg-saga">
            <div class="jaquette--card">
                <img :src="saga.images.cover.main" alt="" width="340px" height="340px">
            </div>
            <div class="card-jacket__button">
                <i data-v-5f801cbc="" aria-hidden="true" class="fa fa-plus"></i>
                <i data-v-5f801cbc="" aria-hidden="true" class="fa fa-heart"></i>
            </div>
        </div>
        <div class="card-body">
            <p class="h3 text-body">
                {{ saga.name }}
                <span class="badge badge-light badge-sm">Saga</span>
            </p>
            <p class="text-primary h5">
                <saga-stats
                        :stats="saga.stats"
                        :with-icon="true">
                </saga-stats>
            </p>
            <p>
                <router-link :to="{ name: 'listen.authors.show', params: { id: saga.author.slug } }">
                    Par {{ saga.author.name }}
                </router-link>
            </p>
        </div>
    </router-link>
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
