import Resource from './Resource';

export default (axios) => {
    let TickResource = Resource.build(axios, {
        all: '/ticks',
    });

    TickResource.savePercentage = function (trackId, percentage) {
        let url = Resource.buildUrl('/ticks/:track', {
            track: trackId,
        });

        return axios.post(url, {
            progress: parseInt(percentage * 1000),
        });
    };

    return TickResource;
};
