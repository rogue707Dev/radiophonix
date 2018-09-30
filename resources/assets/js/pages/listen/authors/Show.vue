<template>
    <div>


        <banner
            :title="author.name">

            <template slot="image">
                <cover
                        size="banniere"
                        type="faiseur"
                        :urlImage="author.picture.main"
                        :altImage="author.name">
                </cover>
            </template>
        </banner>


        <div class="container">
            <div class="row mb-4" v-if="author.bio">
                <div class="col-xl-8">

                    <h2 class="h1 mb-4">Biographie</h2>
                    <p class="mb-3" v-html="bio"></p>

                </div>

                <div class="col-xl-4">
                    <a class="btn btn-outline-secondary btn-sm mb-2" :href="author.links.site" v-if="author.links.site">
                        <i aria-hidden="true" class="fa fa-globe"></i>&nbsp;Site officiel
                    </a>
                    <a class="btn btn-outline-secondary btn-sm mb-2" :href="author.links.facebook" title="Facebook" v-if="author.links.facebook">
                        <i aria-hidden="true" class="fa fa-facebook"></i> Facebook
                    </a>
                    <a class="btn btn-outline-secondary btn-sm mb-2" :href="author.links.twitter" title="Twitter" v-if="author.links.twitter">
                        <i aria-hidden="true" class="fa fa-twitter"></i> Twitter
                    </a>
                    <a class="btn btn-outline-secondary btn-sm mb-2" :href="author.links.netowiki" v-if="author.links.netowiki">
                        <i aria-hidden="true" class="fa fa-globe"></i>&nbsp;Netowiki
                    </a>
                    <a class="btn btn-outline-secondary btn-sm mb-2" :href="author.links.topic" v-if="author.links.topic">
                        <i aria-hidden="true" class="fa fa-globe"></i>&nbsp;Netophonix
                    </a>
                </div>
            </div>

            <div class="row" v-if="author.sagas">
                <div class="col-xl-12">

                    <h2 class="h1 mb-4">Sagas</h2>

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
import Cover from '~/components/content/Cover.vue';

function nl2br(str) {
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1<br/>$2');
}

export default {
    components: {
        Banner,
        SagaList,
        Cover
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
