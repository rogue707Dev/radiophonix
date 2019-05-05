<template>
    <div>

        <vue-form :state="formstate" @submit.prevent="onSubmit">

            <div class="row">
                <div class="col-sm-12 col-md-6">

                    <validate class="form-group"
                              tag="div"
                              auto-label
                              :custom="{ 'async': isEmailValid }">
                        <label>Email</label>
                        <input v-model.lazy="model.email"
                               name="email"
                               type="email"
                               required
                               class="form-control"
                               :class="fieldClassName(formstate.email)"
                               :disabled="isLoading"/>

                        <field-messages name="email"
                                        auto-label
                                        show="$touched || $submitted"
                                        class="invalid-feedback">
                            <span slot="required">Champ requis</span>
                            <span slot="email">Adresse email invalide</span>
                            <span slot="async">{{ errors.email }}</span>
                        </field-messages>
                    </validate>

                    <validate class="form-group"
                              tag="div"
                              auto-label
                              :custom="{ 'async': isPasswordValid }">
                        <label>Nouveau mot de passe</label>
                        <div class="input-group">
                            <input v-model.lazy="model.password"
                                   name="password"
                                   type="password"
                                   required
                                   minlength="8"
                                   maxlength="255"
                                   class="form-control"
                                   :class="fieldClassName(formstate.password)"
                                   :disabled="isLoading"/>

                            <field-messages name="password"
                                            auto-label
                                            show="$touched || $submitted"
                                            class="invalid-feedback">
                                <span slot="required">Mot de passe requis</span>
                                <span slot="minlength">Le mot de passe doit faire au moins 8 caractères</span>
                                <span slot="maxlength">Le mot de passe doit faire au moins 8 caractères</span>
                                <span slot="async">{{ errors.password }}</span>
                            </field-messages>
                        </div>
                    </validate>

                    <validate class="form-group"
                              tag="div"
                              auto-label
                              :custom="{ 'async': isPasswordConfirmationValid }">
                        <label>Confirmer le nouveau mot de passe</label>
                        <div class="input-group">
                            <input v-model.lazy="model.passwordConfirmation"
                                   name="password_confirmation"
                                   type="password"
                                   required
                                   minlength="8"
                                   maxlength="255"
                                   class="form-control"
                                   :class="fieldClassName(formstate.password_confirmation)"
                                   :disabled="isLoading"/>

                            <field-messages name="password_confirmation"
                                            auto-label
                                            show="$touched || $submitted"
                                            class="invalid-feedback">
                                <span slot="required">Mot de passe requis</span>
                                <span slot="minlength">Le mot de passe doit faire au moins 8 caractères</span>
                                <span slot="maxlength">Le mot de passe doit faire au moins 8 caractères</span>
                                <span slot="async">{{ errors.passwordConfirmation }}</span>
                            </field-messages>
                        </div>
                    </validate>

                </div>
            </div>

            <button type="submit" class="btn btn-primary" :disabled="isLoading">
                <fa-icon icon="fa-refresh fa-spin fa-fw"
                         label="Chargement"
                         v-show="isLoading"/>
                Réinitialiser le mot de passe
            </button>
        </vue-form>

    </div>
</template>

<script>
    import api from '~/lib/api';
    import FaIcon from '~/components/Ui/Icon/FaIcon.vue';
    import flash from "~/lib/services/flash";

    export default {
        components: {
            FaIcon,
        },

        data: () => ({
            token: null,
            isLoading: false,
            isEmailValid: true,
            isPasswordValid: true,
            isPasswordConfirmationValid: true,
            errors: {
                email: '',
                password: '',
                passwordConfirmation: '',
            },
            formstate: {},
            model: {
                email: '',
                password: '',
                passwordConfirmation: '',
            },
        }),

        methods: {
            resetErrors() {
                this.isEmailValid = true;
                this.isPasswordValid = true;
                this.isPasswordConfirmationValid = true;

                this.errors.email = '';
                this.errors.password = '';
                this.errors.passwordConfirmation = '';
            },

            fieldClassName(field) {
                if (!field) {
                    return '';
                }

                if ((field.$touched || field.$submitted) && field.$invalid) {
                    return 'is-invalid';
                }

                if (((field.$touched || field.$submitted) && field.$invalid)) {
                    return 'is-invalid';
                }
            },

            onSubmit() {
                if (this.formstate.$invalid
                    && (!this.formstate.email.$error.async)
                    && (!this.formstate.password.$error.async)
                    && (!this.formstate.password_confirmation.$error.async)
                ) {
                    return;
                }

                this.resetErrors();

                this.isLoading = true;

                api.auth.resetPassword({
                    token: this.token,
                    email: this.model.email,
                    password: this.model.password,
                    password_confirmation: this.model.passwordConfirmation,
                }).then(() => {
                    flash.success(
                        'Vous pouvez maintenant vous connecter.',
                        'Mot de passe modifié !'
                    );

                    this.$router.push({
                        name: 'login',
                    });
                }).catch((e) => {
                    let errors = e.response.data.errors;

                    if (errors.email) {
                        this.isEmailValid = false;
                        this.errors.email = errors.email.join('\n');
                    }

                    if (errors.password) {
                        this.isPasswordValid = false;
                        this.errors.password = errors.password.join('\n');
                    }
                }).finally(() => {
                    this.isLoading = false;
                });
            },
        },

        created() {
            this.token = this.$route.params.token;
            this.model.email = this.$route.query.email;
        }
    };
</script>
