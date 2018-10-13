<template>
    <div>


        <banner
            :title="team.name">

            <template slot="image">
                <cover
                    size="banniere"
                    type="faiseur"
                    :urlImage="team.picture.main"
                    :altImage="team.name">
                </cover>
            </template>
        </banner>


        <div class="container">
            <div class="row mb-4" v-if="team.bio">
                <div class="col-xl-8">

                    <h2 class="h1 mb-4">Biographie</h2>
                    <p class="mb-3" v-html="bio"></p>

                </div>

                <div class="col-xl-4">
                    <a class="btn btn-outline-secondary btn-sm mb-2" :href="team.links.site" v-if="team.links.site">
                        <i aria-hidden="true" class="fa fa-globe"></i>&nbsp;Site officiel
                    </a>
                    <a class="btn btn-outline-secondary btn-sm mb-2" :href="team.links.facebook" title="Facebook" v-if="team.links.facebook">
                        <i aria-hidden="true" class="fa fa-facebook"></i> Facebook
                    </a>
                    <a class="btn btn-outline-secondary btn-sm mb-2" :href="team.links.twitter" title="Twitter" v-if="team.links.twitter">
                        <i aria-hidden="true" class="fa fa-twitter"></i> Twitter
                    </a>
                    <a class="btn btn-outline-secondary btn-sm mb-2" :href="team.links.netowiki" v-if="team.links.netowiki">
                        <i aria-hidden="true" class="fa fa-globe"></i>&nbsp;Netowiki
                    </a>
                    <a class="btn btn-outline-secondary btn-sm mb-2" :href="team.links.topic" v-if="team.links.topic">
                        <i aria-hidden="true" class="fa fa-globe"></i>&nbsp;Netophonix
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6 col-lg-6" v-if="team.sagas">

                    <h2 class="h1 mb-4">Sagas</h2>

                    <saga-list :sagas="team.sagas"></saga-list>

                </div>

                <div class="col-xl-6 col-lg-6" v-if="team.authors">

                    <h2 class="h1 mb-4">Membres</h2>

                    <author-list :authors="team.authors"></author-list>

                </div>
            </div>
        </div>


    </div>
</template>

<script>
    import api from '~/lib/api'
    import Banner from '~/components/content/Banner.vue';
    import SagaList from '~/components/saga/SagaList.vue';
    import AuthorList from '~/components/author/AuthorList.vue';
    import Cover from '~/components/content/Cover.vue';

    function nl2br(str) {
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1<br/>$2');
    }

    export default {
        components: {
            Banner,
            SagaList,
            AuthorList,
            Cover,
        },

        data: () => ({
            team: {
                links: {},
                picture: {},
                sagas: [],
                bio: '',
            }
        }),

        computed: {
            bio() {
                return nl2br(this.team.bio);
            }
        },

        methods: {
            async loadTeam() {
                let result = await api.teams.get(this.$route.params.id);

                this.team = result.data;
            }
        },

        created: function() {
            this.loadTeam();
        },

        watch: {
            '$route': 'loadTeam'
        }
    }
</script>
