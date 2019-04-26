import Resource from './Resource';

export default (axios) => {
    let ProfileResource = Resource.build(axios, {
        get: '/profile/:id',
    });

    ProfileResource.likes = function (username) {
        let url = Resource.buildUrl('/profile/:username/likes', {
            username: username,
        });

        return axios.get(url, {username});
    };

    return ProfileResource;
};
