import Resource from './Resource';

export default (axios) => {
    let CollectionResource = Resource.build(axios, {
        get: '/collections/:id',
        create: '/sagas/:id/collections',
        update: '/collections/:id',
        delete: '/collections/:id',
    });

    CollectionResource.all = (sagaId, params) => {
        let url = Resource.buildUrl('/sagas/:sagaId/collections', {
            sagaId: sagaId
        });

        return axios.get(url, params);
    };

    return CollectionResource;
};
