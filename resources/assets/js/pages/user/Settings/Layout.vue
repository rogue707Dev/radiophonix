<template>
    <div>
        <banner :title='user.name'>

            <template slot="image">
                <cover
                    size="banniere"
                    type="auteur"
                    :urlImage="user.avatar">
                </cover>
            </template>

            <div class="mt-3">
                <router-link class="btn btn-outline-secondary btn-sm mb-2"
                             :to="{ name: 'profile', params: { user: user.name } }">
                    <fa-icon label="Retour au profil" icon="fa-fw fa-chevron-left" />
                    Retour au profil
                </router-link>
            </div>
        </banner>

        <div class="container">

            <nav-list class="mb-2">
                <nav-item :active="$route.name === 'settings.profile'">
                    <router-link :to="{ name: 'settings.profile' }">
                        Profil
                    </router-link>
                </nav-item>
            </nav-list>

            <router-view></router-view>

        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    import Banner from '~/components/content/Banner.vue';
    import Cover from '~/components/content/Cover.vue';
    import FaIcon from "~/components/Ui/Icon/FaIcon";
    import NavList from '~/components/Ui/Nav/NavList';
    import NavItem from '~/components/Ui/Nav/NavItem';

    export default {
        components: {
            FaIcon,
            Banner,
            Cover,
            NavList,
            NavItem,
        },

        computed: {
            ...mapState('auth', [
                'user',
            ]),
        },
    }
</script>
