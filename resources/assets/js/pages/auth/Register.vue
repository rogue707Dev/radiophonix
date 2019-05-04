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

                    <validate class="form-group"
                              tag="div"
                              auto-label
                              :custom="{ 'async': isInviteValid }">
                        <label>Code d'invitation (optionnel)</label>
                        <input v-model.lazy="model.invite"
                               name="invite"
                               type="text"
                               class="form-control"
                               :class="fieldClassName(formstate.invite)"
                               :disabled="isLoading"/>

                        <field-messages name="invite"
                                        auto-label
                                        show="$touched || $submitted"
                                        class="invalid-feedback">
                            <span slot="async">{{ errors.invite }}</span>
                        </field-messages>
                        <div class="invalid-feedback" v-if="!isInviteValid && inviteLoadingError">
                            <span>Ce code n'existe pas</span>
                        </div>
                    </validate>

                </div>
            </div>

            <button type="submit" class="btn btn-primary" :disabled="isLoading">
                <fa-icon icon="fa-refresh fa-spin fa-fw"
                         label="Chargement"
                         v-show="isLoading" />
                Inscription
            </button>
        </vue-form>

    </div>
</template>

<script>
    import api from '~/lib/api';
    import flash from '~/lib/services/flash';
    import FaIcon from '~/components/Ui/Icon/FaIcon.vue';

    export default {
        components: {
            FaIcon
        },

        data: () => ({
            isLoading: false,
            isEmailValid: true,
            isUsernameValid: true,
            isPasswordValid: true,
            isInviteValid: true,
            inviteLoadingError: false,
            errors: {
                email: '',
                username: '',
                password: '',
                invite: '',
            },
            formstate: {},
            model: {
                email: '',
                username: '',
                password: '',
                invite: '',
            },
            passwordPeek: '',
            passwordFieldType: 'password',
        }),

        methods: {
            resetErrors() {
                this.isEmailValid = true;
                this.isUsernameValid = true;
                this.isPasswordValid = true;
                this.isInviteValid = true;
                this.inviteLoadingError = false;

                this.errors.email = '';
                this.errors.username = '';
                this.errors.password = '';
                this.errors.invite = '';
            },

            fieldClassName(field) {
                if (!field) {
                    return '';
                }

                if ((field.$touched || field.$submitted)
                    && field.$valid
                    && (field.$name === 'invite' && this.model.invite.length > 0)
                ) {
                    return 'is-valid';
                }

                if (((field.$touched|| field.$submitted) && field.$invalid)
                    || (field.$name === 'invite' && !this.isInviteValid)
                ) {
                    return 'is-invalid';
                }
            },

            onSubmit() {
                if (this.formstate.$invalid
                    && (!this.formstate.email.$error.async)
                    && (!this.formstate.username.$error.async)
                    && (!this.formstate.password.$error.async)
                    && (!this.formstate.invite.$error.async)
                ) {
                    return;
                }

                this.passwordPeek = '';
                this.passwordFieldType = 'password';

                this.resetErrors();

                this.isLoading = true;

                api.auth.register({
                    email: this.model.email,
                    username: this.model.username,
                    password: this.model.password,
                    invite: this.model.invite,
                }).then(() => {
                    flash.success('Inscription validée !');

                    // @todo connecter le user

                    this.$router.push(
                        {
                            name: 'profile',
                            params: {
                                user: this.model.username,
                            },
                        },
                    );
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

                    if (errors.password) {
                        this.isPasswordValid = false;
                        this.errors.password = errors.password.join('\n');
                    }

                    console.log(errors);

                    if (errors.invite) {
                        this.isInviteValid = false;
                        this.errors.invite = errors.invite.join('\n');
                        this.inviteLoadingError = false;
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
            },

            loadInvite() {
                this.isLoading = true;
                this.model.invite = this.$route.query.invite;

                api.invites.site.get(this.$route.query.invite)
                    .then(res => {
                        this.model.email = res.data.email;
                    })
                    .catch(err => {
                        this.isInviteValid = false;
                        this.inviteLoadingError = true;
                    })
                    .finally(() => {
                        this.isLoading = false;
                    });
            }
        },

        mounted() {
            if (this.$route.query.invite) {
                this.loadInvite();
            }
        }
    };
</script>
