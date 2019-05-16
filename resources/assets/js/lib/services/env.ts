export default {
    get: (key: string, defaultValue: any = null) => {
        return process.env['RADIOPHONIX_' + key] || defaultValue;
    },
};
