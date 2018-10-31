import Resource from './Resource';

const SagaResource = Resource.build({
    all: '/sagas',
    get: '/sagas/:id',
    create: '/sagas',
    update: '/sagas/:id',
    delete: '/sagas/:id'
});

SagaResource.popular = function (page) {
    let url = this.buildUrl('/sagas');

    return this.client.get(url, {
        page: page,
        // todo sort by likes
    });
};

SagaResource.recent = function (page) {
    let url = this.buildUrl('/sagas');

    return this.client.get(url, {
        page: page,
        sort: '+last_published_at',
    });
};

SagaResource.discover = function (page) {
    let url = this.buildUrl('/sagas');

    return this.client.get(url, {
        page: page,
        sort: '+name',
    });
};

export default SagaResource;
