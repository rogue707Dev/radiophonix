export default {
    get: (key, defaultValue = null) => {
        return process.env['RADIOPHONIX_' + key] || defaultValue;
    },
};
