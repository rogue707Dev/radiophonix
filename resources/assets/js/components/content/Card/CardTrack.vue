<template>
    <!-- @todo mettre un lien vers la page d'un épisode quand elle existera -->
    <Card
        :link="{ name: 'listen.sagas.show', params: { idOrSlug: track.collection.saga.slug } }"
        :urlImage="track.collection.saga.images.cover.thumb"
        :altImage="track.title"
        :title="track.title"
        type="episode"
        :badge="badge"
        :size="size"
        :card-horizontal="horizontal">

        <template slot="stats" v-if="withStats">
            <i aria-hidden="true" class="fa fa-clock-o"></i>
            <track-length :seconds="track.seconds"></track-length>
        </template>

    </Card>
</template>

<script>
    import Card from '~/components/content/Card.vue';
    import TrackLength from '~/components/track/TrackLength';

    export default {
        components: {
            Card,
            TrackLength,
        },

        computed: {
            size() {
                if (this.horizontal) {
                    return 'petit';
                }

                return 'moyen';
            }
        },

        props: {
            track: {
                type: Object,
                required: true,
            },

            badge: {
                type: Boolean,
                default: false,
            },

            horizontal: {
                type: Boolean,
                default: false,
            },

            withStats: {
                type: Boolean,
                default: true,
            },
        }
    }
</script>
