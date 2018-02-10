let mockResponse = function (file) {
    let data = require('../../../static/mocks/data/'  + file + '.json');

    console.log('Mock :', file, data);

    return new Promise((resolve, reject) => {
        resolve({
            data: data,
            status: 200,
        });
    });
};

let mock = function (api) {
    api.sagas.all = () => mockResponse('sagas');
    api.genres.all = () => mockResponse('genres');
    api.sagas.popular = () => mockResponse('sagas');
    api.sagas.recent = () => mockResponse('sagas');
    api.sagas.get = (id) => mockResponse('sagas/' + id + '/saga');
    api.collections.all = (id) => mockResponse('sagas/' + id + '/collections');
    api.authors.get = (id) => mockResponse('authors/' + id);
    api.search = (query) => mockResponse('search/' + query);
};

export default mock;
