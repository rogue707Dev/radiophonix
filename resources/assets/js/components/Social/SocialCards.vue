<template>
    <div class="card-deck">
        <div class="card">
            <discord-invite :with-icon="false" target="_blank">
                <div class="card-body text-center">
                    <h5 class="card-title">
                        <img src="/static/images/discord/discord-logo-color.svg" height="50" />
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">Discord</h6>

                    <p class="card-text">Rejoignez le serveur pour discuter directement avec nous !</p>
                </div>
            </discord-invite>
        </div>

        <div class="card">
            <a href="https://twitter.com/RadiophonixOrg" target="_blank">
                <div class="card-body text-center">
                    <h5 class="card-title pb-2">
                        <fa-icon icon="fa-twitter fa-fw fa-3x" label="twitter" style="color: #0C7ABF;" />
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">@RadiophonixOrg</h6>

                    <p class="card-text">
                        Suivez le compte et/ou posez vos questions.
                    </p>
                </div>
            </a>
        </div>

        <div class="card" @click="openFeedbackModal" style="cursor:pointer;">
            <div class="card-body text-center">
                <h5 class="card-title pb-2">
                    <fa-icon icon="fa-envelope fa-fw fa-3x" label="suggestion" />
                </h5>
                <h6 class="card-subtitle mb-2 text-muted">Suggestion</h6>

                <p class="card-text">
                    Envoyez nous un message !
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    import DiscordInvite from '~/components/Social/Discord/DiscordInvite';
    import FaIcon from "~/components/Ui/Icon/FaIcon";

    export default {
        components: {
            FaIcon,
            DiscordInvite,
        },

        methods: {
            openFeedbackModal() {
                this.$store.dispatch('ui/setFeedbackModalDefaultType', 'suggestion');
                this.$bvModal.show('js--modal-feedback');
            },
        }
    }
</script>
