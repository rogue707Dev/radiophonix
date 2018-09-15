<template>
    <div class="">
        <router-link :to="{ name: 'listen.sagas.show', params: { idOrSlug: saga.slug } }">
            <div class="">
                <div class="jaquette--petite">
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
                <router-link :to="{ name: 'listen.authors.show', params: { id: saga.author.slug } }">
                    {{ saga.author.name }}
                </router-link>
            </p>
            <p class="h6">
                {{ saga.stats.collections }} Saison - {{ saga.stats.tracks }} Épisodes
            </p>
            <p class="h6">
                {{ saga.stats.collections }} Saison - {{ saga.stats.tracks }} Épisodes
            </p>
        </div>
        <div class="">
            <button><i aria-hidden="true" class="fa fa-heart"></i></button>
            <button><i aria-hidden="true" class="fa fa-plus"></i></button>
        </div>
    </div>
</template>

<script>
export default {
    props: ['saga']
}

</script>
