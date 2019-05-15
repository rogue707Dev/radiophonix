type StorageItem = object | string;

const ls = window.localStorage;
const makeKey = (key: string) => 'rdpx__' + key;

export default class Storage {
    static set(key: string, value: StorageItem): void {
        if (typeof value === 'object') {
            value = JSON.stringify(value);
        }

        ls.setItem(makeKey(key), value);
    }

    static get(key: string, defaultValue?: StorageItem): StorageItem {
        let value = ls.getItem(makeKey(key));

        if (!value) {
            return defaultValue;
        }

        if (value[0] === '{' || value[0] === '[') {
            value = JSON.parse(value);
        }

        return value;
    }

    static remove(key: string): void {
        ls.removeItem(makeKey(key));
    }

    static clear(): void {
        ls.clear();
    }
}
