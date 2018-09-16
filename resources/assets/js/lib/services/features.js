const features = {
    development: {

    },

    production: {

    }
};

export default {
    isActive(feature) {
        let env = process.env.RADIOPHONIX_FEATURES_ENV || 'production';

        return features[env][feature] || false;
    }
};
