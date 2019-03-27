<template>
    <div>

        TODO

    </div>
</template>

<script>
    import api from '~/lib/api';

    export default {
        data: () => ({
            email: '',
            password: '',
        }),

        methods: {
            login: function() {
                api.auth.login(this.email, this.password)
                    .then((res) => {
                        console.log(res.data.token);
                        // this.$store.dispatch('setToken', res.data.token);

                        console.log(this.$route);

                        this.$router.push(this.$route.query.redirect);
                    })
                    .catch((err) => {
                        console.log('nope', err);
                    });
            }
        }
    }
</script>
