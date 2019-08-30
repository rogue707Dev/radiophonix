<template>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <h2 class="h2 text-danger">Supprimer le compte</h2>

            <p class="mt-2">
                En supprimant votre compte, toutes les informations associées seront supprimées.
            </p>

            <button class="btn btn-danger mt-4"
                    v-b-tooltip.right
                    title="Une confirmation est demandée avant de supprimer le compte"
                    @click="deleteAccount">
                Supprimer mon compte
            </button>
        </div>
    </div>
</template>

<script>
    import flash from "~/lib/services/flash";
    import api from "~/lib/api";
    import storage from "~/lib/services/storage";
    import {resetStore} from "~/lib/store";

    export default {
        methods: {
            async deleteAccount() {
                const { value: password } = await flash.confirm(
                    'Entrez votre mot de passe pour confirmer la suppression de votre compte :',
                    'Cette action n\'est pas réversible',
                    true
                );

                if (typeof password === "undefined") {
                    return;
                }

                if ((password + '').length === 0) {
                    await flash.info('Il faut entrer votre mot de passe pour confirmer la suppression.', 'Compte non supprimé.');
                    return;
                }

                api.settings
                    .deleteAccount(password)
                    .catch(err => {
                        flash.error(err.response.data.errors.password.join('\n'));
                        return false;
                    })
                    .then((res) => {
                        if (res === false) {
                            return;
                        }

                        storage.clear();
                        resetStore();
                        this.$router.push({name: 'home'});

                        flash.success('Compte supprimé !');
                    });
            }
        },
    }
</script>
