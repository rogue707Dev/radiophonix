import storage from '~/lib/services/storage';

export default {
    saveTrack: (sagaId, trackId, percentage = 0) => {
        let ticks = storage.get('ticks', {});

        ticks[sagaId] = {
            saga: sagaId + '',
            track: trackId + '',
            progress: parseInt(percentage * 1000),
        };

        storage.set('ticks', ticks);
        storage.set('currentTick', sagaId);
    },

    savePercentage: (percentage) => {
        let ticks = storage.get('ticks');
        let currentTick = storage.get('currentTick');

        ticks[currentTick].progress = parseInt(percentage * 1000);

        storage.set('ticks', ticks);
    },

    current: () => {
        let ticks = storage.get('ticks', {});
        let currentTick = storage.get('currentTick');
        let tick = ticks[currentTick] || null;

        if (!tick) {
            return Promise.resolve(null);
        }

        tick.percentage = tick.progress / 1000;

        return Promise.resolve(tick);
    },

    get: (sagaId) => {
        let ticks = storage.get('ticks', {});
        let tick = ticks[sagaId] || null;

        if (!tick) {
            return Promise.resolve(null);
        }

        tick.percentage = tick.progress / 1000;

        return Promise.resolve(tick);
    },

    all: () => {
        let ticks = storage.get('ticks', []);

        return Promise.resolve(Object.values(ticks));
    },
};
