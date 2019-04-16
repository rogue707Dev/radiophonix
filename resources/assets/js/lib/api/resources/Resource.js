class Resource {
    static build(axios, methods) {
        const resource = new Resource;

        if (methods.all) {
            resource.all = function (params) {
                return axios.get(`${methods.all}`, params);
            };
        }

        if (methods.get) {
            resource.get = (id, params) => {
                let url = Resource.buildUrl(methods.get, {
                    id: id
                });

                return axios.get(url, params);
            };
        }

        if (methods.create) {
            resource.create = function (data) {
                return axios.post(`${methods.create}`, data);
            };
        }

        if (methods.update) {
            resource.update = (id, data) => {
                let url = Resource.buildUrl(methods.update, {
                    id: id
                });

                return axios.put(url, data);
            };
        }

        if (methods.delete) {
            resource.delete = (id) => {
                let url = Resource.buildUrl(methods.delete, {
                    id: id
                });

                return axios.delete(url);
            };
        }

        return resource;
    }

    static buildUrl(url, vars) {
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
