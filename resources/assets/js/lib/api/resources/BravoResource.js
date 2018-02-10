import Resource from './Resource';

let BravoResource = Resource.build();

BravoResource.add = function (sagaId) {
    let url = this.buildUrl('/sagas/:sagaId/bravos', {
        sagaId: sagaId
    });

    return this.client.post(url);
};

BravoResource.remove = function (sagaId) {
    let url = this.buildUrl('/sagas/:sagaId/bravos', {
        sagaId: sagaId
    });

    return this.client.delete(url);
};

export default BravoResource;
