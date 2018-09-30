const storage = window.localStorage;

const makeKey = (key) => 'rdpx__' + key;

export default {
    set: (key, value) => {
        storage.setItem(makeKey(key), value);
    },

    get: (key, defaultValue) => storage.getItem(makeKey(key)) || defaultValue,
};
