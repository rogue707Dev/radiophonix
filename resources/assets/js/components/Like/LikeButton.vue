<template>
    <button type="button"
            aria-hidden="true"
            class="favoris"
            :class="activeClass"
            :disabled="isLoading"
            @click="toggleLike">
        <fa-icon class="favoris__oui" :icon="buttonClass" label="Bouton j'aime" />
        <svg class="favoris__non" width="14px" height="14px">
            <use xlink:href="#heart-broken"></use>
        </svg>
    </button>
</template>

<script>

    import { mapGetters } from 'vuex';
    import FaIcon from "~/components/Ui/Icon/FaIcon";

    export default {
        components: {
            FaIcon,
        },

        props: {
            likeableId: {
                type: String,
                required: true,
            },
            likeableType: {
                type: String,
                required: true,
            }
        },

        data: () => ({
            isLoading: false,
        }),

        computed: {
            ...mapGetters('likes', [
                'isLiked',
            ]),

            ...mapGetters('auth', [
                'isAuthenticated',
            ]),

            activeClass() {

                if (this.isLiked(this.likeableType, this.likeableId)) {
                    return 'var--actif';
                }

            },

            buttonClass() {
                if (this.isLoading) {
                    return 'fa-circle-o-notch fa-spin';
                }

                return 'fa-heart';
            },
        },

        methods: {
            async toggleLike() {
                if (!this.isAuthenticated) {
                    this.openModal();
                    return;
                }

                this.isLoading = true;
                let isLiked = this.isLiked(this.likeableType, this.likeableId);

                let action = isLiked ? 'likes/remove' : 'likes/add';
                let event = isLiked ? 'unliked' : 'liked';

                try {
                    await this.$store.dispatch(
                        action,
                        {
                            type: this.likeableType,
                            id: this.likeableId,
                        }
                    );

                    this.$emit(event);
                } catch (e) {
                    this.openModal();
                } finally {
                    this.isLoading = false;
                }
            },

            openModal() {
                this.$store.dispatch(
                    'ui/openMustRegisterModal',
                    'En rejoignant Radiophonix vous pouvez ajouter toutes les sagas à vos favoris.'
                );
            }
        },
    }
</script>
