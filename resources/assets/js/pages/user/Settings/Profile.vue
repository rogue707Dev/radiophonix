<template>
    <div>

        <vue-form :state="formstate" @submit.prevent="onSubmit">

            <div class="row">
                <div class="col-sm-12 col-md-6">

                    <validate class="form-group"
                              tag="div"
                              auto-label
                              :custom="{ 'async': isUsernameValid }">
                        <label>Nom d'utilisateur</label>
                        <input v-model.lazy="model.username"
                               name="username"
                               type="text"
                               required
                               class="form-control"
                               :class="fieldClassName(formstate.username)"
                               :disabled="isLoading"/>

                        <field-messages name="username"
                                        auto-label
                                        show="$touched || $submitted"
                                        class="invalid-feedback">
                            <span slot="required">Champ requis</span>
                            <span slot="async">{{ errors.username }}</span>
                        </field-messages>
                    </validate>

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
            isEmailValid: true,
            isUsernameValid: true,
            errors: {
                email: '',
                username: '',
            },
            formstate: {},
            model: {
                email: '',
                username: '',
            },
        }),

        methods: {
            resetErrors() {
                this.isEmailValid = true;
                this.isUsernameValid = true;

                this.errors.email = '';
                this.errors.username = '';
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
                    && (!this.formstate.email.$error.async)
                    && (!this.formstate.username.$error.async)
                ) {
                    return;
                }

                this.resetErrors();

                this.isLoading = true;

                api.settings.profile({
                    email: this.model.email,
                    name: this.model.username,
                }).then(() => {
                    // @todo
                }).catch((e) => {
                    let errors = e.response.data.errors;

                    if (errors.email) {
                        this.isEmailValid = false;
                        this.errors.email = errors.email.join('\n');
                    }

                    if (errors.username) {
                        this.isUsernameValid = false;
                        this.errors.username = errors.username.join('\n');
                    }
                }).finally(() => {
                    this.isLoading = false;
                });
            },
        },

        mounted() {
            this.model.username = this.$store.state.auth.user.name;
            this.model.email = this.$store.state.auth.user.email;
        },
    }
</script>
