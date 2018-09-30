<template>
    <div class="list-card">
        <card-author
                v-for="author in authors"
                :key="author.id"
                :author="author"></card-author>
    </div>
</template>

<script>
    import CardAuthor from '~/components/content/Card/CardAuthor';

    export default {
        components: {
            CardAuthor,
        },

        props: {
            authors: {
                type: Array
            }
        }
    }
</script>
