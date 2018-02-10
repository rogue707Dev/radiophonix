<template>
    <div>

        <player-mini></player-mini>

        <div class="layout-sidebar__contenu">
            <div class="layout-sidebar__contenu-grille">



                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-12">
                        <div class="titre--bloc mt-5">Recherche</div>
                        <form @submit.prevent="search">
                            <div class="form-group">
                                <input v-model="query" placeholder="Rechercher..." class="form-control form-control-lg" aria-describedby="Rechercher">
                                <small class="form-text">Rechercher un faiseur, une saga, un épisode, un genre...</small>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-12">
                        <div class="titre--bloc mt-5">Genres</div>
                        <ul class="liste-bouton">
                            <li>
                                <button class="btn btn-sidebar">Science Fiction</button>
                            </li>
                            <li>
                                <button class="btn btn-sidebar">Heroic Fantasy</button>
                            </li>
                            <li>
                                <button class="btn btn-sidebar">Policier</button>
                            </li>
                            <li>
                                <button class="btn btn-sidebar">Humour</button>
                            </li>
                        </ul>
                    </div>
                </div>



            </div>
        </div>



    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import PlayerMini from '~/components/player/PlayerMini.vue';

export default {
    components: {
        PlayerMini
    },

    data() {
        return {
            query: '',
        }
    },

    computed: {
        ...mapGetters('search', [
            'lastQuery'
        ])
    },

    methods: {
        search() {
            this.$store.dispatch('search/doSearch', this.query);
        },

        retrieveLastQuery() {
            let lastQuery = this.lastQuery || '';

            if (lastQuery.length > 0) {
                this.query = lastQuery;
                this.search();
            }
        }
    },

    created() {
        this.retrieveLastQuery();
    }
}
</script>
