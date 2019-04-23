import Resource from './Resource';

export default (axios) => {
    let BadgeResource = Resource.build(axios, {
        all: '/badges',
    });

    return BadgeResource;
};
