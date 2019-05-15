import env from '~/lib/services/env';

type Env = 'development' | 'production';
type Feature = 'login' | 'algolia' | 'feedback';

type Config = {
    [key in Feature]: boolean;
};

type Configs = {
    [env in Env]: Config;
};

const configs: Configs = {
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
    isActive(feature: Feature) {
        let environment: Env = env.get('FEATURES_CONFIG', 'production');

        return configs[environment][feature] || false;
    }
};
