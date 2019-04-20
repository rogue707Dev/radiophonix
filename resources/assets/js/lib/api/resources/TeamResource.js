import Resource from './Resource';

export default (axios) => {
    let TeamResource = Resource.build(axios, {
        all: '/teams',
        get: '/teams/:id',
        create: '/teams',
        update: '/teams/:id',
        delete: '/teams/:id'
    });

    return TeamResource;
};
