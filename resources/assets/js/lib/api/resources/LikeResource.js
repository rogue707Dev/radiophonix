import Resource from './Resource';

let LikeResource = Resource.build();

LikeResource.add = function (sagaId) {
    let url = this.buildUrl('/sagas/:sagaId/likes', {
        sagaId: sagaId
    });

    return this.client.post(url);
};

LikeResource.remove = function (sagaId) {
    let url = this.buildUrl('/sagas/:sagaId/likes', {
        sagaId: sagaId
    });

    return this.client.delete(url);
};

export default LikeResource;
