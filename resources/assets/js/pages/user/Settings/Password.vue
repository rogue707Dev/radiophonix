<template>
    <div>

        <vue-form :state="formstate" @submit.prevent="onSubmit">

            <div class="row">
                <div class="col-sm-12 col-md-6">

                    <validate class="form-group"
                              tag="div"
                              auto-label
                              :custom="{ 'async': isOldPasswordValid }">
                        <label>Ancien mot de passe</label>
                        <div class="input-group">
                            <input v-model.lazy="model.oldPassword"
                                   name="old_password"
                                   type="password"
                                   required
                                   minlength="8"
                                   maxlength="255"
                                   readonly
                                   style="background-color: inherit;"
                                   onfocus="this.removeAttribute('readonly');"
                                   class="form-control"
                                   :class="fieldClassName(formstate.old_password)"
                                   :disabled="isLoading"/>

                            <field-messages name="old_password"
                                            auto-label
                                            show="$touched || $submitted"
                                            class="invalid-feedback">
                                <span slot="required">Mot de passe requis</span>
                                <span slot="minlength">Le mot de passe doit faire au moins 8 caractères</span>
                                <span slot="maxlength">Le mot de passe doit faire au moins 8 caractères</span>
                                <span slot="async">{{ errors.oldPassword }}</span>
                            </field-messages>
                        </div>
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
                                   readonly
                                   style="background-color: inherit;"
                                   onfocus="this.removeAttribute('readonly');"
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
                        <label>Confirmation</label>
                        <div class="input-group">
                            <input v-model.lazy="model.passwordConfirmation"
                                   name="password_confirmation"
                                   type="password"
                                   required
                                   minlength="8"
                                   maxlength="255"
                                   readonly
                                   style="background-color: inherit;"
                                   onfocus="this.removeAttribute('readonly');"
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
                Enregistrer
            </button>

        </vue-form>

    </div>
</template>

<script>
    import FaIcon from "~/components/Ui/Icon/FaIcon";
    import api from '~/lib/api';

    export default {
        components: {
            FaIcon,
        },

        data: () => ({
            isLoading: false,
            isOldPasswordValid: true,
            isPasswordValid: true,
            isPasswordConfirmationValid: true,
            errors: {
                oldPassword: '',
                password: '',
                passwordConfirmation: '',
            },
            formstate: {},
            model: {
                oldPassword: '',
                password: '',
                passwordConfirmation: '',
            },
        }),

        methods: {
            resetErrors() {
                this.isOldPasswordValid = true;
                this.isPasswordValid = true;
                this.isPasswordConfirmationValid = true;

                this.errors.oldPassword = '';
                this.errors.password = '';
                this.errors.passwordConfirmation = '';
            },

            fieldClassName(field) {
                if (!field) {
                    return '';
                }

                if ((field.$touched || field.$submitted) && field.$valid) {
                    return 'is-valid';
                }

                if (((field.$touched || field.$submitted) && field.$invalid)) {
                    return 'is-invalid';
                }
            },

            onSubmit() {
                if (this.formstate.$invalid
                    && (!this.formstate.old_password.$error.async)
                    && (!this.formstate.password.$error.async)
                    && (!this.formstate.password_confirmation.$error.async)
                ) {
                    return;
                }

                this.resetErrors();

                this.isLoading = true;

                api.settings.password({
                    old_password: this.model.oldPassword,
                    password: this.model.password,
                    password_confirmation: this.model.passwordConfirmation,
                }).then(() => {
                    flash.success('Modifications enregistrées');

                    this.model.oldPassword = '';
                    this.model.password = '';
                    this.model.passwordConfirmation = '';

                    this.formstate._reset();
                }).catch((e) => {
                    let errors = e.response.data.errors;

                    if (errors.old_password) {
                        this.isOldPasswordValid = false;
                        this.errors.oldPassword = errors.old_password.join('\n');
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
    }
</script>
