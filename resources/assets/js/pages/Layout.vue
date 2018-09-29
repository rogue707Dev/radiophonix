<template>

    <root-layout>
        <router-view></router-view>
    </root-layout>

</template>

<script>
import RootLayout from '~/components/Ui/Layout/RootLayout';

export default {
    components: {
        RootLayout,
    },
}
</script>
