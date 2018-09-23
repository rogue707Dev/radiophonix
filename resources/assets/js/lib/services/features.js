const features = {
    development: {
        login: true,
    },

    production: {
        login: false,
    }
};

export default {
    isActive(feature) {
        let env = process.env.RADIOPHONIX_FEATURES_ENV || 'production';

        return features[env][feature] || false;
    }
};
