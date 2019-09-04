import storage from '~/lib/services/storage';
import api from "~/lib/api/site";
import store from "~/lib/store";

const serverTickToFrontTick = function (serverTick) {
    return {
        saga: serverTick.saga.id,
        track: serverTick.track.id,
        progress: serverTick.progress,
    };
};

const getCurrentTick = function () {
    if (store.getters['auth/isAuthenticated']) {
        return api.ticks.current()
            .then(res => res.saga.id);
    }

    return storage.get('currentTick');
};

export default {
    saveTrack: (sagaId, trackId, percentage = 0) => {
        if (store.getters['auth/isAuthenticated']) {
            return;
        }

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
        if (store.getters['auth/isAuthenticated']) {
            return;
        }

        let ticks = storage.get('ticks');
        let currentTick = storage.get('currentTick');

        ticks[currentTick].progress = parseInt(percentage * 1000);

        storage.set('ticks', ticks);
    },

    async current() {
        let ticks = await this.all();
        let currentTick = await getCurrentTick();

        let tick = ticks[currentTick] || null;

        if (!tick) {
            return Promise.resolve(null);
        }

        tick.percentage = tick.progress / 1000;

        return Promise.resolve(tick);
    },

    async get(sagaId) {
        let ticks = await this.all();

        let tick = ticks[sagaId] || null;

        if (!tick) {
            return Promise.resolve(null);
        }

        tick.percentage = tick.progress / 1000;

        return Promise.resolve(tick);
    },

    async all() {
        if (store.getters['auth/isAuthenticated']) {
            return api.ticks.all()
                .then(res => {
                    let ticks = {};

                    for (const key in res) {
                        if (!res.hasOwnProperty(key)) {
                            continue;
                        }

                        ticks[res[key].saga.id] = serverTickToFrontTick(res[key]);
                    }

                    return ticks;
                });
        }

        let ticks = storage.get('ticks', {});

        return Promise.resolve(ticks);
    },
};
