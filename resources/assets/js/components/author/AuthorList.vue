<template>
    <ul>
        <author-list-item
            v-for="author in authors"
            :author="author"
            :key="author.id">
        </author-list-item>
    </ul>
</template>

<script>
    import AuthorListItem from '~/components/author/AuthorListItem.vue';

    export default {
        components: {
            AuthorListItem,
        },

        props: {
            authors: {
                type: Array
            }
        }
    }
</script>
