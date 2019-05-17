<template>
    <div>
        saga {{ saga.name }}
    </div>
</template>

<script>
    import api from '~/lib/api'

    export default {
        data() {
            return {
                saga: {}
            }
        },

        beforeRouteEnter (to, from, next) {
            api.sagas.get(to.params.id).then((saga) => {
                next(vm => {
                    vm.saga = saga;
                    // vm.$store.dispatch('setSaga', res.data);
                });
            });
        }
    }
</script>
