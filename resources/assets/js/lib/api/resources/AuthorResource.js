import Resource from './Resource';

export default (axios) => {
    let AuthorResource = Resource.build(axios, {
        all: '/authors',
        get: '/authors/:id',
        create: '/authors',
        update: '/authors/:id',
        delete: '/authors/:id'
    });

    return AuthorResource;
};
