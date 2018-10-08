import env from '~/lib/services/env';

const configs = {
    development: {
        login: true,
    },

    production: {
        login: false,
    }
};

export default {
    isActive(feature) {
        let config = env.get('FEATURES_CONFIG', 'production');

        return configs[config][feature] || false;
    }
};
