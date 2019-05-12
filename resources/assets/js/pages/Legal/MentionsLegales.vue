<template>
    <div>

        <headband
            urlImage="/static/home/faq.jpg"
            title="Mentions légales">
        </headband>

        <div class="container">

            <div class="row">

                <div class="col-12 col-md-4">
                    <h2 class="h2 mb-1">
                        Éditeur du Site
                    </h2>

                    <p>
                        Nathan Boiron<br />
                        4 rue de la Saïda<br />
                        75015 PARIS<br />
                        Email : contact@radiophonix.org<br />
                        Site Web : www.radiophonix.org
                    </p>
                </div>

                <div class="col-12 col-md-4">
                    <h2 class="h2 mb-1">
                        Hébergement
                    </h2>

                    <p>
                        OVH SAS<br />
                        2 rue Kellermann<br />
                        59100 Roubaix<br />
                        Site Web : www.ovh.com
                    </p>
                </div>

                <div class="col-12 col-md-4">
                    <h2 class="h2 mb-1">
                        Développement
                    </h2>

                    <p>
                        Nathan Boiron<br />
                        4 rue de la Saïda<br />
                        75015 PARIS<br />
                        Site Web : www.mopolo.net
                    </p>
                </div>

                <div class="col-12 col-xl-10">
                    <h2 class="h2 mt-4 mb-1">
                        Données personnelles
                    </h2>

                    Conformément aux dispositions de la loi du 6 janvier 1978 relative aux fichiers, à l’informatique et aux libertés, vous disposez d’un droit d’accès, de rectification et de suppression des données personnelles vous concernant.
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import Headband from "~/components/content/Headband";
    import SocialCards from "~/components/Social/SocialCards";

    export default {
        components: {
            SocialCards,
            Headband,
        }
    }
</script>
