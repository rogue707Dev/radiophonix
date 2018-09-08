<template>
    <li>
        <router-link :to="{ name: 'listen.authors.show', params: { id: author.slug } }">
            <img :src="author.picture.thumb"
                 :alt="author.name"
                 height="100px" width="100px"/>

            {{author.name}}

            {{author.stats.sagas}}
        </router-link>
    </li>
</template>

<script>
    export default {
        props: ['author'],
    }
</script>
