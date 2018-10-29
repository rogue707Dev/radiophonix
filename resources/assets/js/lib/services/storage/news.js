import storage from '~/lib/services/storage';

const currentNewsId = '1';

export default {
    hasUnread: () => {
        let lastNewsId = storage.get('news_id');

        return lastNewsId.toString() !== currentNewsId.toString();
    },

    read: () => {
        storage.set('news_id', currentNewsId);
    },
};
