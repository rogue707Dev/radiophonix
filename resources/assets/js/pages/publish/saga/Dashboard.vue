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
            api.sagas.get(to.params.id).then((res) => {
                next(vm => {
                    vm.saga = res.data;
                    // vm.$store.dispatch('setSaga', res.data);
                });
            });
        }
    }
</script>
