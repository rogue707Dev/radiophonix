<template>
    <b-modal id="js--modal-feedback" :hide-header="true" :hide-footer="true">
        <b-button-close @click="hide"></b-button-close>

        <h2 class="text-center display-4 mb-4 mt-4">{{ title }}</h2>

        <div class="text-center">
            <div class="btn-group" role="group" aria-label="Bug ou suggestion">
                <button type="button"
                        class="btn btn-light btn-lg"
                        :class="{active: model.type === 'bug'}"
                        @click="model.type = 'bug'">
                    <fa-icon icon="fa-bug fa-fw" label="bug"/>
                    Bug
                </button>
                <button type="button"
                        class="btn btn-light btn-lg"
                        :class="{active: model.type === 'suggestion'}"
                        @click="model.type = 'suggestion'">
                    <fa-icon icon="fa-lightbulb-o fa-fw" label="suggestion"/>
                    Suggestion
                </button>
            </div>
        </div>

        <vue-form :state="formstate" @submit.prevent="submitFeedback">

            <validate class="form-group"
                      tag="div"
                      auto-label
                      :custom="{ 'async': isTitleValid }">
                <label>Titre</label>
                <input v-model.lazy="model.title"
                       name="title"
                       type="text"
                       required
                       class="form-control"
                       :class="fieldClassName(formstate.title)"
                       :disabled="isLoading"/>

                <field-messages name="title"
                                auto-label
                                show="$touched || $submitted"
                                class="invalid-feedback">
                    <span slot="required">Champ requis</span>
                    <span slot="async">{{ errors.title }}</span>
                </field-messages>
            </validate>

            <validate class="form-group"
                      tag="div"
                      auto-label
                      :custom="{ 'async': isDescriptionValid }">
                <label>Description</label>
                <textarea v-model.lazy="model.description"
                       name="description"
                       rows="3"
                       required
                       class="form-control"
                       :class="fieldClassName(formstate.description)"
                          :disabled="isLoading"></textarea>

                <field-messages name="description"
                                auto-label
                                show="$touched || $submitted"
                                class="invalid-feedback">
                    <span slot="required">Champ requis</span>
                    <span slot="async">{{ errors.description }}</span>
                </field-messages>
            </validate>

            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg" :disabled="isLoading">
                    <fa-icon icon="fa-refresh fa-spin fa-fw"
                             label="Chargement"
                             v-show="isLoading" />
                    Envoyer
                </button>
            </div>
        </vue-form>

    </b-modal>
</template>

<script>
    import { mapState } from 'vuex';
    import FaIcon from "~/components/Ui/Icon/FaIcon";
    import flash from "~/lib/services/flash";
    import api from "~/lib/api";

    export default {
        components: {
            FaIcon,
        },

        data: () => ({
            sent: false,
            isLoading: false,
            isTitleValid: true,
            isDescriptionValid: true,
            errors: {
                title: '',
                description: '',
            },
            formstate: {},
            model: {
                type: '',
                title: '',
                description: '',
            },
        }),

        computed: {
            ...mapState('ui', [
                'feedbackModalDefaultType',
            ]),

            title() {
                if (this.model.type === 'bug') {
                    return 'Signaler un bug';
                }

                return 'Faire une suggestion';
            },
        },

        methods: {
            show() {
                this.$bvModal.show('js--modal-feedback');
            },

            hide() {
                this.$bvModal.hide('js--modal-feedback');
            },

            fieldClassName(field) {
                if (!field) {
                    return '';
                }

                if ((field.$touched || field.$submitted) && field.$invalid) {
                    return 'is-invalid';
                }
            },

            resetErrors() {
                this.isTitleValid = true;
                this.isDescriptionValid = true;

                this.errors.title = '';
                this.errors.description = '';
            },

            async submitFeedback() {
                if (this.formstate.$invalid
                    && (!this.formstate.title.$error.async)
                    && (!this.formstate.description.$error.async)
                ) {
                    return;
                }

                this.resetErrors();

                this.isLoading = true;

                try {
                    await api.feedback.send(
                        this.model.type,
                        this.model.title,
                        this.model.description,
                        window.location.href,
                    );

                    flash.success('', 'C\'est envoyé !');

                    setTimeout(() => {
                        this.hide();
                    }, 150);
                } catch (e) {
                    flash.error('Une erreur est survenue', 'Oops');
                } finally {
                    this.isLoading = false;

                    setTimeout(() => {
                        this.model.type = this.feedbackModalDefaultType;
                        this.model.title = '';
                        this.model.description = '';

                        this.resetErrors();
                        this.formstate._reset();
                    }, 200);
                }
            }
        },

        mounted() {
            this.$root.$on('bv::modal::show', (bvEvent, modalId) => {
                if (modalId === 'js--modal-feedback') {
                    this.model.type = this.feedbackModalDefaultType;
                }
            });
        },
    }
</script>
