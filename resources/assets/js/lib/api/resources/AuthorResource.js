import Resource from './Resource';

let AuthorResource = Resource.build({
    all: '/authors',
    get: '/authors/:id',
    create: '/authors',
    update: '/authors/:id',
    delete: '/authors/:id'
});

export default AuthorResource;
