<template>
    <div>
        <h1>Connexion</h1>

        <form v-on:submit.prevent="login">
            <input type="email" v-model="email" placeholder="Email" />
            <input type="password" v-model="password" placeholder="Mot de passe" />

            <button type="submit">Login</button>
        </form>
    </div>
</template>

<script>
    import api from '~/lib/api';

    export default {
        data() {
            return {
                email: '',
                password: ''
            }
        },

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
