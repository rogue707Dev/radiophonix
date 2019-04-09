import Resource from './Resource';

let ProfileResource = Resource.build({
    get: '/profile/:id',
});

export default ProfileResource;
