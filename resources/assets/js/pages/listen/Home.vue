<template>
    <div>
        <h1>Home</h1>

        <ul>
            <li v-for="saga in sagas">
                <router-link :to="{ name: 'listen.sagas.show', params: { idOrSlug: saga.id } }">
                    {{ saga.name }}
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script>
import api from '~/lib/api'

export default {
    data() {
        return {
            sagas: []
        };
    },
    methods: {
        loadSagas: function() {
            api.sagas.all().then((res) => {
                this.sagas = res.data;
            });
        }
    },
    created: function() {
        this.loadSagas();
    },
    watch: {
        '$route': 'loadSagas'
    }
}
</script>
