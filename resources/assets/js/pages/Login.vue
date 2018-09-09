<template>
    <div class="layout-conteneur__main">

        <ul class="navigation">
            <li class="actif">Connexion</li>
            <li>Inscription</li>
        </ul>

        <div class="row">
            <div class="col">
                <label for="email">Email</label>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col">
                <input type="text" id="email" class="">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="password">Mot de passe</label>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col">
                <input type="password" id="password" class="">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="password2">Confirmer le mot de passe</label>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col">
                <input type="password" id="password2" class="">
            </div>
        </div>

        <button type="submit">Se connecter</button>



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
