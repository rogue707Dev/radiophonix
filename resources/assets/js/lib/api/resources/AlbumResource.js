import Resource from './Resource';

export default (axios) => {
    let AlbumResource = Resource.build(axios, {
        get: '/albums/:id',
        create: '/sagas/:id/albums',
        update: '/albums/:id',
        delete: '/albums/:id',
    });

    AlbumResource.all = (sagaId, params) => {
        let url = Resource.buildUrl('/sagas/:sagaId/albums', {
            sagaId: sagaId
        });

        return axios.get(url, params);
    };

    return AlbumResource;
};
