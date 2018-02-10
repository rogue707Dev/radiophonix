import Resource from './Resource';

let CollectionResource = Resource.build({
    get: '/collections/:id',
    create: '/sagas/:id/collections',
    update: '/collections/:id',
    delete: '/collections/:id'
});

CollectionResource.all = function (sagaId, params) {
    let url = this.buildUrl('/sagas/:sagaId/collections', {
        sagaId: sagaId
    });

    return this.client.get(url, params);
};

export default CollectionResource;
