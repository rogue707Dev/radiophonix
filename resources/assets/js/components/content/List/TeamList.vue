<template>
    <div class="list-card">
        <card-team
            v-for="team in teams"
            :key="team.id"
            :team="team"></card-team>
    </div>
</template>

<script>
    import CardTeam from '~/components/content/Card/CardTeam';

    export default {
        components: {
            CardTeam,
        },

        props: {
            teams: {
                type: Array
            }
        }
    }
</script>
