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
                        <label>Mot de passe</label>
                        <div class="input-group">
                            <input v-model.lazy="model.password"
                                   v-show="passwordFieldType === 'password'"
                                   name="password"
                                   type="password"
                                   required
                                   minlength="8"
                                   maxlength="255"
                                   class="form-control"
                                   :class="fieldClassName(formstate.password)"
                                   :disabled="isLoading"/>
                            <input class="form-control"
                                   v-show="passwordFieldType === 'text'"
                                   type="text"
                                   :placeholder="passwordPeek"
                                   readonly>
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary"
                                        type="button"
                                        @click="peekPassword">
                                    <fa-icon v-show="passwordFieldType === 'password'" icon="fa-eye" label="Voir" />
                                    <fa-icon v-show="passwordFieldType === 'text'" icon="fa-eye-slash" label="Masquer" />
                                </button>
                            </div>

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

                </div>
            </div>

            <button type="submit" class="btn btn-primary" :disabled="isLoading">
                <fa-icon icon="fa-refresh fa-spin fa-fw"
                         label="Chargement"
                         v-show="isLoading" />
                Connexion
            </button>
        </vue-form>

    </div>
</template>

<script>
    import api from '~/lib/api';
    import FaIcon from '~/components/Ui/Icon/FaIcon.vue';

    export default {
        components: {
            FaIcon
        },

        data: () => ({
            isLoading: false,
            isEmailValid: true,
            isPasswordValid: true,
            errors: {
                email: '',
                password: '',
            },
            formstate: {},
            model: {
                email: '',
                password: '',
            },
            passwordPeek: '',
            passwordFieldType: 'password',
        }),

        methods: {
            resetErrors() {
                this.isEmailValid = true;
                this.isPasswordValid = true;

                this.errors.email = '';
                this.errors.password = '';
            },

            fieldClassName(field) {
                if (!field) {
                    return '';
                }

                if ((field.$touched || field.$submitted) && field.$valid) {
                    return 'is-valid';
                }

                if ((field.$touched || field.$submitted) && field.$invalid) {
                    return 'is-invalid';
                }
            },

            onSubmit() {
                if (this.formstate.$invalid
                    && (!this.formstate.email.$error.async)
                    && (!this.formstate.password.$error.async)
                ) {
                    return;
                }

                this.passwordPeek = '';
                this.passwordFieldType = 'password';

                this.resetErrors();

                this.isLoading = true;

                api.auth.login(
                    this.model.email,
                    this.model.password
                ).then((res) => {
                    this.$router.push(
                        {
                            name: 'profile',
                            params: {
                                user: res.data.username,
                            },
                        },
                    );
                }).catch((e) => {
                    if (!e.response) {
                        console.log(e);
                        return;
                    }

                    let errors = e.response.data.errors || {};

                    if (errors.email) {
                        this.isEmailValid = false;
                        this.errors.email = errors.email.join('\n');
                    }

                    if (errors.password) {
                        this.isPasswordValid = false;
                        this.errors.password = errors.password.join('\n');
                    }
                })
                .finally(() => {
                    this.isLoading = false;
                });
            },

            peekPassword() {
                if (this.passwordFieldType === 'password') {
                    this.passwordPeek = this.model.password;
                    this.passwordFieldType = 'text';

                    return null;
                }

                this.passwordPeek = '';
                this.passwordFieldType = 'password';
            }
        },
    };
</script>
