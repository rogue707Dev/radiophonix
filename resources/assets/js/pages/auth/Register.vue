<template>
    <div>

        <vue-form :state="formstate" @submit.prevent="onSubmit">

            <div class="row">
                <div class="col-sm-12 col-md-6">

                    <validate class="form-group"
                              tag="div"
                              auto-label>
                        <label>Email</label>
                        <input v-model.lazy="model.email"
                               name="email"
                               type="email"
                               required
                               class="form-control"
                               :class="fieldClassName(formstate.email)"/>

                        <field-messages name="email"
                                        auto-label
                                        show="$touched || $submitted"
                                        class="invalid-feedback">
                            <span slot="required">Champ requis</span>
                            <span slot="email">Adresse email invalide</span>
                        </field-messages>
                    </validate>

                    <validate class="form-group"
                              tag="div"
                              auto-label>
                        <label>Nom d'utilisateur</label>
                        <input v-model.lazy="model.username"
                               name="username"
                               type="text"
                               required
                               class="form-control"
                               :class="fieldClassName(formstate.username)"/>

                        <field-messages name="username"
                                        auto-label
                                        show="$touched || $submitted"
                                        class="invalid-feedback">
                            <span slot="required">Champ requis</span>
                        </field-messages>
                    </validate>

                    <validate class="form-group"
                              tag="div"
                              auto-label>
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
                                   :class="fieldClassName(formstate.password)"/>
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
                            </field-messages>
                        </div>
                    </validate>

                </div>
            </div>

            <button type="submit" class="btn btn-primary">Inscription</button>
        </vue-form>

    </div>
</template>

<script>
    import FaIcon from '~/components/Ui/Icon/FaIcon.vue';

    export default {
        components: {
            FaIcon
        },

        data: () => ({
            formstate: {},
            model: {
                email: '',
                username: '',
                password: '',
            },
            passwordPeek: '',
            passwordFieldType: 'password',
        }),

        methods: {
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
                console.log(this.formstate.$valid);
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
