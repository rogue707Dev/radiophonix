<template>
    <div class="">
        <router-link :to="{ name: 'listen.sagas.show', params: { idOrSlug: saga.slug } }">
            <div class="">
                <div class="jaquette--moyen">
                    <img :src="saga.images.cover.thumb" alt="" width="340px" height="340px"/>
                </div>
            </div>
        </router-link>
        <div class="">
            <p class="h2">
                <router-link :to="{ name: 'listen.sagas.show', params: { idOrSlug: saga.slug } }">
                    {{ saga.name }}
                </router-link>
            </p>
            <p>
                {{ saga.stats.collections }} Saison - {{ saga.stats.tracks }} Épisodes
            </p>
            <hr class="separateur">
            <p>
                par
                <router-link :to="{ name: 'listen.authors.show', params: { id: saga.author.slug } }">
                    <span class="text-orange-300">{{ saga.author.name }}</span>
                </router-link>
            </p>
        </div>
    </div>
</template>

<script>
export default {
    props: ['saga']
}
</script>
