<template>

    <div class="container pt-md-5">

        <nav-list class="mb-4 mt-md-4">
            <nav-item :active="true" v-if="$route.name === 'password.forgot'">
                Oubli de mot de passe
            </nav-item>
            <nav-item :active="true" v-else-if="$route.name === 'password.reset'">
                Réinitialiser le mot de passe
            </nav-item>
            <template v-else>
                <nav-item :active="isActive('login')">
                    <router-link :to="{ name: 'login' }">
                        Connexion
                    </router-link>
                </nav-item>
                <nav-item :active="isActive('register')">
                    <router-link :to="{ name: 'register' }">
                        Inscription
                    </router-link>
                </nav-item>
            </template>
        </nav-list>

        <router-view></router-view>

    </div>

</template>

<script>
    import NavList from '~/components/Ui/Nav/NavList';
    import NavItem from '~/components/Ui/Nav/NavItem';

    export default {
        components: {
            NavList,
            NavItem,
        },

        methods: {
            isActive(name) {
                return this.$route.meta.menu === name;
            }
        }
    }
</script>
