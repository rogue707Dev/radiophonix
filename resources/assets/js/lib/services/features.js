import env from '~/lib/services/env';

const configs = {
    development: {
        login: true,
        algolia: false,
        feedback: false,
    },

    production: {
        login: false,
        algolia: false,
        feedback: true,
    }
};

export default {
    isActive(feature) {
        let config = env.get('FEATURES_CONFIG', 'production');

        return configs[config][feature] || false;
    }
};
