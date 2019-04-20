<template>
    <div>

        <h1>Profil de {{ profile.name }}</h1>

        <img :src="profile.avatar" alt="Avatar" />

    </div>
</template>

<script>
    import api from '~/lib/api'

    export default {
        data: () => ({
            profile: {
                author: {},
            },
        }),

        methods: {
            async loadProfile() {
                try {
                    let result = await api.profile.get(this.$route.params.user);
                    this.profile = result.data;
                } catch (e) {
                    this.$router.push({
                        name: '404',
                    });
                }
            }
        },

        created() {
            this.loadProfile();
        },
    }
</script>
