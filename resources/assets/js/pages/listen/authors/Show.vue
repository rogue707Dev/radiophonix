<template>
    <div>


        <banner
            :title="author.name">

            <template slot="image">
                <div class="jaquette--banniere jaquette--faiseur">
                    <img :src="author.picture.main" alt="" />
                </div>
            </template>
        </banner>


        <div class="layout-conteneur__main">
            <div class="row mb-4" v-if="author.bio">
                <div class="col-xl-8">

                    <h2 class="titre--bloc mb-4">Biographie</h2>
                    <p v-html="bio"></p>

                </div>

                <div class="col-xl-4">

                    <ul class="liste-bouton mt-3">
                        <li v-if="author.links.site">
                            <a class="btn btn-blanc-fonce" :href="author.links.site">
                                <i aria-hidden="true" class="fa fa-globe"></i>&nbsp;Site officiel
                            </a>
                        </li>
                        <li v-if="author.links.facebook">
                            <a class="btn btn-blanc-fonce" :href="author.links.facebook" title="Facebook">
                                <i aria-hidden="true" class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li v-if="author.links.twitter">
                            <a class="btn btn-blanc-fonce" :href="author.links.twitter" title="Twitter">
                                <i aria-hidden="true" class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li v-if="author.links.netowiki">
                            <a class="btn btn-blanc-fonce" :href="author.links.netowiki">
                                <i aria-hidden="true" class="fa fa-globe"></i>&nbsp;Netowiki
                            </a>
                        </li>
                        <li v-if="author.links.topic">
                            <a class="btn btn-blanc-fonce" :href="author.links.topic">
                                <i aria-hidden="true" class="fa fa-globe"></i>&nbsp;Netophonix
                            </a>
                        </li>
                    </ul>

                </div>
            </div>

            <div class="row" v-if="author.sagas">
                <div class="col-xl-12">

                    <h2 class="titre--bloc mb-4">Sagas</h2>

                    <saga-list :sagas="author.sagas"></saga-list>

                </div>
            </div>
        </div>


    </div>
</template>

<script>
import api from '~/lib/api'
import Banner from '~/components/content/Banner.vue';
import SagaList from '~/components/saga/SagaList.vue';

function nl2br(str) {
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1<br/>$2');
}

export default {
    components: {
        Banner,
        SagaList,
    },

    data() {
        return {
            author: {
                links: {},
                picture: {},
                sagas: [],
                bio: '',
            }
        };
    },

    computed: {
        bio() {
            return nl2br(this.author.bio);
        }
    },

    methods: {
        async loadAuthor() {
            let result = await api.authors.get(this.$route.params.id);

            this.author = result.data;
        }
    },

    created: function() {
        this.loadAuthor();
    },

    watch: {
        '$route': 'loadAuthor'
    }
}
</script>
