<template>
    <div>

        <banner :title='profile.name'>

            <template slot="image">
                <cover
                        size="banniere"
                        type="auteur"
                        :urlImage="profile.avatar"
                        :altImage="Avatar">
                </cover>
            </template>

            <div class="mt-3">
                <button class="btn btn-outline-secondary btn-sm mb-2">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    Editer le profile
                </button>
            </div>
        </banner>

        <div class="container">

            <h2 class="h1 mb-2">Badge</h2>

            <div class="layout-badge">

                <div class="cover var--petit var--badge layout-badge__item"
                     v-b-popover.hover.top="'Pour être venu nous voir en personne à l\'évènement.'"
                     title="MP3@Paris 2019">
                    <div class="cover__mask">
                        <img src="https://dev.radiophonix.org/storage/1930664737/conversions/zylann-thumb.jpg" alt="Zylann">
                    </div>
                </div>
                <div class="cover var--petit var--badge layout-badge__item"
                     v-b-popover.hover.bottom="'Pour être venu nous voir en personne à l\'évènement.'"
                     title="MP3@Paris 2019">
                    <div class="cover__mask">
                        <img src="https://dev.radiophonix.org/storage/1930664737/conversions/zylann-thumb.jpg" alt="Zylann">
                    </div>
                </div>
                <div class="cover var--petit var--badge layout-badge__item" id="badge-1">
                    <b-tooltip target="badge-1">
                        <div class="text-left">
                            <h2 style="font-size: 1rem;">MP3@Paris 2019</h2>
                            <p>
                                Pour être venu nous voir en personne à l'évènement.
                            </p>
                        </div>
                    </b-tooltip>

                    <div class="cover__mask">
                        <img src="https://dev.radiophonix.org/storage/1930664737/conversions/zylann-thumb.jpg" alt="Zylann">
                    </div>
                </div>
                <div class="cover var--petit var--badge layout-badge__item" id="badge-2">
                    <b-popover target="badge-2" triggers="hover focus" placement="top">
                        <h2 class="h2">MP3@Paris 2019</h2>
                        <p>
                            Pour être venu nous voir en personne à l'évènement.
                        </p>
                    </b-popover>

                    <div class="cover__mask">
                        <img src="https://dev.radiophonix.org/storage/1930664737/conversions/zylann-thumb.jpg" alt="Zylann">
                    </div>
                </div>
                <div class="cover var--petit var--badge layout-badge__item" v-b-tooltip.hover.top title="Badge">
                    <div class="cover__mask">
                        <img src="https://dev.radiophonix.org/storage/1930664737/conversions/zylann-thumb.jpg" alt="Zylann">
                    </div>
                </div>
                <div class="cover var--petit var--badge layout-badge__item" v-b-tooltip.hover.top title="Badge">
                    <div class="cover__mask">
                        <img src="https://dev.radiophonix.org/storage/1930664737/conversions/zylann-thumb.jpg" alt="Zylann">
                    </div>
                </div>
                <div class="cover var--petit var--badge layout-badge__item" v-b-tooltip.hover.top title="Badge">
                    <div class="cover__mask">
                        <img src="https://dev.radiophonix.org/storage/1930664737/conversions/zylann-thumb.jpg" alt="Zylann">
                    </div>
                </div>
                <div class="cover var--petit var--badge layout-badge__item" v-b-tooltip.hover.top title="Badge">
                    <div class="cover__mask">
                        <img src="https://dev.radiophonix.org/storage/1930664737/conversions/zylann-thumb.jpg" alt="Zylann">
                    </div>
                </div>
                <div class="cover var--petit var--badge layout-badge__item" v-b-tooltip.hover.top title="Badge">
                    <div class="cover__mask">
                        <img src="https://dev.radiophonix.org/storage/1930664737/conversions/zylann-thumb.jpg" alt="Zylann">
                    </div>
                </div>
                <div class="cover var--petit var--badge layout-badge__item" v-b-tooltip.hover.top title="Badge">
                    <div class="cover__mask">
                        <img src="https://dev.radiophonix.org/storage/1930664737/conversions/zylann-thumb.jpg" alt="Zylann">
                    </div>
                </div>
                <div class="cover var--petit var--badge layout-badge__item" v-b-tooltip.hover.top title="Badge">
                    <div class="cover__mask">
                        <img src="https://dev.radiophonix.org/storage/1930664737/conversions/zylann-thumb.jpg" alt="Zylann">
                    </div>
                </div>
                <div class="cover var--petit var--badge layout-badge__item" v-b-tooltip.hover.top title="Badge">
                    <div class="cover__mask">
                        <img src="https://dev.radiophonix.org/storage/1930664737/conversions/zylann-thumb.jpg" alt="Zylann">
                    </div>
                </div>
                <div class="cover var--petit var--badge layout-badge__item" v-b-tooltip.hover.top title="Badge">
                    <div class="cover__mask">
                        <img src="https://dev.radiophonix.org/storage/1930664737/conversions/zylann-thumb.jpg" alt="Zylann">
                    </div>
                </div>
                <div class="cover var--petit var--badge layout-badge__item" v-b-tooltip.hover.top title="Badge">
                    <div class="cover__mask">
                        <img src="https://dev.radiophonix.org/storage/1930664737/conversions/zylann-thumb.jpg" alt="Zylann">
                    </div>
                </div>
                <div class="cover var--petit var--badge layout-badge__item" v-b-tooltip.hover.top title="Badge">
                    <div class="cover__mask">
                        <img src="https://dev.radiophonix.org/storage/1930664737/conversions/zylann-thumb.jpg" alt="Zylann">
                    </div>
                </div>
            </div>



            <nav class="nav mb-2">
                <span class="nav-link active">En cours</span>
                <span class="nav-link">Favoris</span>
            </nav>

            <div class="episode-item var--en-cours">
                <div class="episode-item__cover">
                    <div class="cover var--petit var--episode">
                        <div class="cover__mask">
                            <img src="https://dev.radiophonix.org/storage/1930664737/conversions/zylann-thumb.jpg" alt="Zylann">
                        </div>
                    </div>
                </div>
                <div class="episode-item__content align-content-center h-100 d-grid">
                    <div>
                        Zylann&nbsp;•&nbsp;<span class="font-weight-bold">Le Complot</span>
                        <div class="progression text-dark h5 mt-1">
                            <span>06:55</span>
                            <progress value="45.63106796116505" max="100" class="progression__barre"></progress>
                            <span class="text-right">15:10</span>
                        </div>
                    </div>
                </div>
                <div class="episode-item__etat-lecture">
                    <button class="btn btn-sm btn-outline-secondary">
                        <i aria-hidden="true" class="fa fa-play pr-1"></i><span>Écouter</span>
                    </button>
                </div>
                <div class="episode-item__download">
                    <a href="https://audio.radiophonix.org/1287/1287-Episode-I-Le-Complot.mp3" target="_blank" class="btn btn-outline-secondary btn-sm mr-xl-3">
                        <i aria-hidden="true" class="fa fa-download"></i>Télécharger
                    </a>
                </div>
            </div>

            <div class="episode-item var--en-cours">
                <div class="episode-item__cover">
                    <div class="cover var--petit var--episode">
                        <div class="cover__mask">
                            <img src="https://dev.radiophonix.org/storage/1930664737/conversions/zylann-thumb.jpg" alt="Zylann">
                        </div>
                    </div>
                </div>
                <div class="episode-item__content align-content-center h-100 d-grid">
                    <div>
                        Zylann&nbsp;•&nbsp;<span class="font-weight-bold">Le Complot</span>
                        <div class="progression text-dark h5 mt-1">
                            <span>06:55</span>
                            <progress value="60" max="100" class="progression__barre"></progress>
                            <span class="text-right">15:10</span>
                        </div>
                    </div>
                </div>
                <div class="episode-item__etat-lecture">
                    <button class="btn btn-sm btn-outline-secondary">
                        <i aria-hidden="true" class="fa fa-play pr-1"></i><span>Écouter</span>
                    </button>
                </div>
                <div class="episode-item__download">
                    <a href="https://audio.radiophonix.org/1287/1287-Episode-I-Le-Complot.mp3" target="_blank" class="btn btn-outline-secondary btn-sm mr-xl-3">
                        <i aria-hidden="true" class="fa fa-download"></i>Télécharger
                    </a>
                </div>
            </div>

        </div>

    </div>
</template>

<script>
    import api from '~/lib/api';
    import Banner from '~/components/content/Banner.vue';
    import Cover from '~/components/content/Cover.vue';

    export default {
        data: () => ({
            profile: {
                author: {},
            },
        }),

        components: {
            Banner,
            Cover
        },

        methods: {
            async loadProfile() {
                try {
                    let result = await api.profile.get(this.$route.params.user);
                    this.profile = result.data;
                } catch (e) {
                    this.$router.push({
                        name: '404',
                    });
                }
            }
        },

        created() {
            this.loadProfile();
        },
    }
</script>
