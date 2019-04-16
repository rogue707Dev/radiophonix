import Resource from './Resource';

export default (axios) => {
    let ProfileResource = Resource.build(axios, {
        get: '/profile/:id',
    });

    return ProfileResource;
};
