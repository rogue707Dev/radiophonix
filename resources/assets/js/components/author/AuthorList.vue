<template>
    <div class="list-card">
        <Card
                v-for="author in authors"
                :key="author.id"
                :link="{ name: 'listen.authors.show', params: { id: author.slug } }"
                :urlImage="author.picture.thumb"
                :altImage="author.name"
                :title="author.name"
                type="faiseur">

            <template slot="stats">
                <i aria-hidden="true" class="fa fa-file-audio-o"></i>
                {{author.stats.sagas}} Séries
            </template>

        </Card>
    </div>
</template>

<script>
    import Card from '~/components/content/Card.vue';

    export default {
        components: {
            Card,
        },

        props: {
            authors: {
                type: Array
            }
        }
    }
</script>
