<template>
    <div>

        <headband
            urlImage="/static/home/contribuer.jpeg"
            title="Participer au projet"
            subtitle="Contribuer au code sur GitLab ou signaler les bugs">
        </headband>

        <div class="container">

            <nav-list class="mb-4 mt-md-4">
                <nav-item :active="isActive('contribute')">
                    <router-link :to="{ name: 'contribute' }">
                        Contribuer
                    </router-link>
                </nav-item>
                <nav-item :active="isActive('roadmap')">
                    <router-link :to="{ name: 'roadmap' }">
                        Roadmap
                    </router-link>
                </nav-item>
            </nav-list>

            <router-view></router-view>

        </div>
    </div>
</template>

<script>
    import Headband from '~/components/content/Headband.vue';
    import NavList from '~/components/Ui/Nav/NavList';
    import NavItem from '~/components/Ui/Nav/NavItem';

    export default {
        components: {
            Headband,
            NavList,
            NavItem,
        },

        methods: {
            isActive(name) {
                return this.$route.name === name;
            },
        },
    }
</script>
