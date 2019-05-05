<template>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <h2 class="h2 text-danger">Supprimer le compte</h2>

            <p class="mt-2">
                En supprimant votre compte, toutes les informations associées seront supprimées.
            </p>

            <button class="btn btn-danger mt-4"
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
                let confirmed = await flash.confirm(
                    'Êtes-vous sûr de vouloir supprimer votre compte ?',
                    'Cette action n\'est pas réversible'
                );

                if (true !== confirmed) {
                    return;
                }

                api.settings
                    .deleteAccount()
                    .then(() => {
                        storage.clear();
                        resetStore();
                        this.$router.push({name: 'home'});
                    })
                    .then(flash.close);
            }
        },
    }
</script>
