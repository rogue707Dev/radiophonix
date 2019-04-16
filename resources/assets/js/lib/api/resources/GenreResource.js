import Resource from './Resource';

export default (axios) => {
    const GenreResource = Resource.build(axios, {
        all: '/genres',
        get: '/genres/:id',
        create: '/genres',
        update: '/genres/:id',
        delete: '/genres/:id'
    });

    return GenreResource;
};
