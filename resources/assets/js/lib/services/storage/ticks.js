import storage from '~/lib/services/storage';

export default {
    saveTrack: (sagaId, trackId, percentage = 0) => {
        let ticks = storage.get('ticks', {});

        ticks[sagaId] = {
            saga: sagaId + '',
            track: trackId + '',
            percentage: percentage,
        };

        storage.set('ticks', ticks);
        storage.set('currentTick', sagaId);
    },

    savePercentage: (percentage) => {
        let ticks = storage.get('ticks');
        let currentTick = storage.get('currentTick');

        ticks[currentTick].percentage = percentage;

        storage.set('ticks', ticks);
    },

    current: () => {
        let ticks = storage.get('ticks', {});
        let currentTick = storage.get('currentTick');

        return new Promise(resolve => {
            resolve(ticks[currentTick] || null);
        });
    },

    get: (sagaId) => {
        let ticks = storage.get('ticks', {});

        return new Promise(resolve => {
            resolve(ticks[sagaId] || null);
        });
    },
};
