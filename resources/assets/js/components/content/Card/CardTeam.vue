<template>
    <Card
        :link="{ name: 'listen.teams.show', params: { id: team.slug } }"
        :urlImage="team.picture.thumb"
        :altImage="team.name"
        :title="team.name"
        type="faiseur"
        :badge="badge"
        :size="size"
        :card-horizontal="horizontal">

        <template slot="stats" v-if="withStats">
            <i aria-hidden="true" class="fa fa-microphone"></i>
            {{ team.stats.sagas }}
            <template v-if="team.stats.sagas > 1">Sagas</template>
            <template v-else>Saga</template>
        </template>

    </Card>
</template>

<script>
    import Card from '~/components/content/Card.vue';

    export default {
        components: {
            Card,
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
            team: {
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
