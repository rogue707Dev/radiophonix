const storage = window.localStorage;

const makeKey = (key) => 'rdpx__' + key;

export default {
    set: (key, value) => {
        if (typeof value === 'object') {
            value = JSON.stringify(value);
        }

        storage.setItem(makeKey(key), value);
    },

    get: (key, defaultValue) => {
        let value = storage.getItem(makeKey(key));

        if (!value) {
            return defaultValue;
        }

        if (value[0] === '{' || value[0] === '[') {
            value = JSON.parse(value);
        }

        return value;
    },

    remove: key => storage.removeItem(makeKey(key)),
};
