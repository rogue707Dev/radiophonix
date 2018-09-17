<template>
    <div class="layout-conteneur__main">


        <div class="login-conteneur">


                <nav class="nav mb-4">
                    <span class="nav-link active">Connexion</span>
                    <span class="nav-link">Inscription</span>
                </nav>

                <div class="row">
                    <div class="col">
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <input type="text" id="email" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="password">Mot de passe</label>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <div class="input-group">
                            <input type="text" class="form-control" id="password">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="button" id="button-addon2">Voir</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="password2">Confirmer le mot de passe</label>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <div class="input-group">
                            <input type="text" class="form-control" id="password2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="button-addon2">Voir</button>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Se connecter</button>

        </div>



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
