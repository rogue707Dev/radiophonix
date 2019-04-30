import Resource from './Resource';

export default (axios) => {
    let SiteInviteResource = Resource.build(axios, {
        get: '/invites/site/:id',
    });

    return SiteInviteResource;
};
