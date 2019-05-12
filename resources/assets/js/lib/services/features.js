import env from '~/lib/services/env';

const configs = {
    development: {
        login: true,
        algolia: false,
        feedback: true,
    },

    production: {
        login: true,
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
