import Resource from './Resource';

export default (axios) => {
    let TrackResource = Resource.build(axios, {
        get: '/tracks/:id',
        create: '/albums/:id/tracks',
        update: '/tracks/:id',
        delete: '/tracks/:id'
    });

    TrackResource.all = function (albumId, params) {
        let url = Resource.buildUrl('/albums/:albumId/tracks', {
            albumId: albumId
        });

        return axios.get(url, params);
    };

    return TrackResource;
};
