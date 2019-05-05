<template>
    <div>

        <vue-form :state="formstate" @submit.prevent="onSubmit">

            <div class="row">
                <div class="col-sm-12 col-md-6">

                    <p class="mb-3">
                        Entrez votre adresse e-mail et nous vous enverrons un lien pour réinitialiser votre mot de passe.
                    </p>

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
                Envoyer
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
            isLoading: false,
            isEmailValid: true,
            errors: {
                email: '',
            },
            formstate: {},
            model: {
                email: '',
            },
        }),

        methods: {
            resetErrors() {
                this.isEmailValid = true;

                this.errors.email = '';
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
                ) {
                    return;
                }

                this.resetErrors();

                this.isLoading = true;

                api.auth.askPasswordReset(
                    this.model.email
                ).then((res) => {
                    flash.success('Email de réinitialisation envoyé !');

                    this.$router.push(
                        {
                            name: 'login',
                        },
                    );
                }).catch((e) => {
                    if (!e.response) {
                        return;
                    }

                    let errors = e.response.data.errors || {};

                    if (errors.email) {
                        this.isEmailValid = false;
                        this.errors.email = errors.email.join('\n');
                    }
                }).finally(() => {
                    this.isLoading = false;
                });
            },
        },
    };
</script>
