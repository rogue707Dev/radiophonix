import storage from '~/lib/services/storage';
import store from '~/lib/store';

const currentNewsId = '4';

export default {
    loadLastRead: () => {
        let lastNewsId = storage.get('news_id', '');

        if (!lastNewsId) {
            return;
        }

        if (lastNewsId.toString() !== currentNewsId.toString()) {
            store.dispatch('ui/masNewsAsUnread');
            return;
        }

        store.dispatch('ui/masNewsAsRead');
    },

    read: () => {
        storage.set('news_id', currentNewsId);
        store.dispatch('ui/masNewsAsRead');
    },
};
