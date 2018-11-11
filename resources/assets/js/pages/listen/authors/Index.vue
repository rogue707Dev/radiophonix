<template>
    <div>
        <h1>Auteurs</h1>

        <ul>
            <li v-for="author in authors">
                <router-link :to="{ name: 'listen.authors.show', params: { id: author.id } }">
                    {{ author.name }}
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script>
import api from '~/lib/api'

export default {
    data: () => ({
        authors: [],
    }),
    methods: {
        loadAuthors: function() {
            var vm = this;

            api.authors.all().then(function(res) {
                vm.authors = res.data;
            });
        }
    },
    created: function() {
        this.loadAuthors();
    },
    watch: {
        '$route': 'loadAuthors'
    }
}
</script>
