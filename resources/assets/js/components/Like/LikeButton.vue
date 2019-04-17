<template>
    <button aria-hidden="true"
            class="fa fa-heart"
            :class="buttonClass"
            :disabled="isLoading"
            @click="toggleLike"></button>
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
        props: {
            likeableId: {
                type: Number,
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

            buttonClass() {
                if (this.isLoading) {
                    return 'fa-circle-o-notch fa-spin';
                }

                if (this.isLiked(this.likeableType, this.likeableId)) {
                    return 'var--actif';
                }
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
