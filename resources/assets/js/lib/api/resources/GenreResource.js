import Resource from './Resource';

const GenreResource = Resource.build({
    all: '/genres',
    get: '/genres/:id',
    create: '/genres',
    update: '/genres/:id',
    delete: '/genres/:id'
});

export default GenreResource;
