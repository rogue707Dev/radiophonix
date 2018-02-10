import Resource from './Resource';

let TrackResource = Resource.build({
    get: '/tracks/:id',
    create: '/collections/:id/tracks',
    update: '/tracks/:id',
    delete: '/tracks/:id'
});

TrackResource.all = function (collectionId, params) {
    let url = this.buildUrl('/collections/:collectionId/tracks', {
        collectionId: collectionId
    });

    return this.client.get(url, params);
};

export default TrackResource;
