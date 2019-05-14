import env from '~/lib/services/env';

const configs: any = {
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
    isActive(feature: any) {
        let config = env.get('FEATURES_CONFIG', 'production');

        return configs[config][feature] || false;
    }
};
