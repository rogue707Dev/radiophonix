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
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Voir</button>
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



        <br><br><br><br><br><br><br><br><br><br>





        <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg">
        <input class="form-control" type="text" placeholder="Default input">
        <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm">

        <hr class="mb-5">


        <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Small</span>
            </div>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Default</span>
            </div>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>

        <div class="input-group input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-lg">Large</span>
            </div>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
        </div>



        <form class="was-validated">
            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customControlValidation1" required>
                <label class="custom-control-label" for="customControlValidation1">Check this custom checkbox</label>
                <div class="invalid-feedback">Example invalid feedback text</div>
            </div>

            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="customControlValidation2" name="radio-stacked" required>
                <label class="custom-control-label" for="customControlValidation2">Toggle this custom radio</label>
            </div>
            <div class="custom-control custom-radio mb-3">
                <input type="radio" class="custom-control-input" id="customControlValidation3" name="radio-stacked" required>
                <label class="custom-control-label" for="customControlValidation3">Or toggle this other custom radio</label>
                <div class="invalid-feedback">More example invalid feedback text</div>
            </div>

            <div class="form-group">
                <select class="custom-select" required>
                    <option value="">Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                <div class="invalid-feedback">Example invalid custom select feedback</div>
            </div>

            <div class="custom-file">
                <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                <div class="invalid-feedback">Example invalid custom file feedback</div>
            </div>
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
