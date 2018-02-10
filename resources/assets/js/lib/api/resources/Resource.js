import ResourceClient from './ResourceClient';

class Resource {
    static build(methods) {
        const resource = new Resource;

        if (methods.all) {
            resource.all = function (params) {
                return this.client.get(`${methods.all}`, params);
            };
        }

        if (methods.get) {
            resource.get = function (id, params) {
                let url = this.buildUrl(methods.get, {
                    id: id
                });

                return this.client.get(url, params);
            };
        }

        if (methods.create) {
            resource.create = function (data) {
                return this.client.post(`${methods.create}`, data);
            };
        }

        if (methods.update) {
            resource.update = function (id, data) {
                let url = this.buildUrl(methods.update, {
                    id: id
                });

                return this.client.put(url, data);
            };
        }

        if (methods.delete) {
            resource.delete = function (id) {
                let url = this.buildUrl(methods.delete, {
                    id: id
                });

                return this.client.delete(url);
            };
        }

        return resource;
    }

    constructor() {
        this.client = new ResourceClient();
    }

    buildUrl(url, vars) {
        for (let key in vars) {
            if (vars.hasOwnProperty(key)) {
                let value = vars[key];

                url = url.replace(':' + key, value);
            }
        }

        return url;
    }
}

export default Resource;
