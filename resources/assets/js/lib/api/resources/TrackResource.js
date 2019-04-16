import Resource from './Resource';

export default (axios) => {
    let TrackResource = Resource.build(axios, {
        get: '/tracks/:id',
        create: '/collections/:id/tracks',
        update: '/tracks/:id',
        delete: '/tracks/:id'
    });

    TrackResource.all = function (collectionId, params) {
        let url = Resource.buildUrl('/collections/:collectionId/tracks', {
            collectionId: collectionId
        });

        return axios.get(url, params);
    };

    return TrackResource;
};
