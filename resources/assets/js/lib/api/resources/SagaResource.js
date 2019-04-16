import Resource from './Resource';

export default (axios) => {
    let SagaResource = Resource.build(axios, {
        all: '/sagas',
        get: '/sagas/:id',
        create: '/sagas',
        update: '/sagas/:id',
        delete: '/sagas/:id'
    });

    SagaResource.popular = function (page) {
        let url = Resource.buildUrl('/sagas');

        return axios.get(url, {
            page: page,
            // todo sort by likes
        });
    };

    SagaResource.recent = function (page) {
        let url = Resource.buildUrl('/sagas');

        return axios.get(url, {
            page: page,
            sort: '+last_published_at',
        });
    };

    SagaResource.discover = function (page) {
        let url = Resource.buildUrl('/sagas');

        return axios.get(url, {
            page: page,
            sort: '+name',
        });
    };

    return SagaResource;
};
