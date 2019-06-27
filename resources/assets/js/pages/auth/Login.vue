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
                        <router-link :to="{ name: 'password.forgot' }"
                            class="pull-right lien-paragraphe">
                            Mot de passe oublié ?
                        </router-link>
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
                                user: res.data.user.name,
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

                    if (e.response.data.message) {
                        this.isEmailValid = false;
                        this.isPasswordValid = false;
                        this.errors.password = e.response.data.message;
                    }
                })
                .finally(() => {
                    this.isLoading = false;
                });
            },
        },
    };
</script>
