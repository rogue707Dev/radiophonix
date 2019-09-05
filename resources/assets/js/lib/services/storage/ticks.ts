import storage from '~/lib/services/storage';
import api from "~/lib/api/site";
import store from "~/lib/store";
import {FrontTick, Tick} from "~types/Tick";

interface HashMap<T = any> {
    [key: string]: T;
}

const serverTickToFrontTick = function (serverTick: Tick): FrontTick {
    return {
        saga: serverTick.saga.id,
        track: serverTick.track.id,
        progress: serverTick.progress,
    };
};

const getCurrentTick = function (): Promise<string> {
    if (store.getters['auth/isAuthenticated']) {
        return api.ticks.current()
            .then(res => res.saga.id);
    }

    return Promise.resolve(<string>storage.get('currentTick'));
};

export default {
    saveTrack: (sagaId: string, trackId: string, percentage: number = 0) => {
        if (store.getters['auth/isAuthenticated']) {
            return;
        }

        let ticks = <HashMap>storage.get('ticks', {});

        ticks[sagaId] = {
            saga: sagaId + '',
            track: trackId + '',
            progress: Math.round(percentage * 1000),
        };

        storage.set('ticks', ticks);
        storage.set('currentTick', sagaId);
    },

    savePercentage: (percentage: number) => {
        if (store.getters['auth/isAuthenticated']) {
            return;
        }

        let ticks = <HashMap>storage.get('ticks', {});
        let currentTick = <string>storage.get('currentTick');

        ticks[currentTick].progress = Math.round(percentage * 1000);

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

    async get(sagaId: string) {
        let ticks = await this.all();

        let tick = ticks[sagaId] || null;

        if (!tick) {
            return Promise.resolve(null);
        }

        tick.percentage = tick.progress / 1000;

        return Promise.resolve(tick);
    },

    async all(): Promise<HashMap<FrontTick>> {
        if (store.getters['auth/isAuthenticated']) {
            return api.ticks.all()
                .then(res => {
                    let ticks: HashMap<FrontTick> = {};

                    for (const key in res) {
                        if (!res.hasOwnProperty(key)) {
                            continue;
                        }

                        ticks[res[key].saga.id] = serverTickToFrontTick(res[key]);
                    }

                    return ticks;
                });
        }

        let ticks = <HashMap<FrontTick>>storage.get('ticks', {});

        return Promise.resolve(ticks);
    },
};
