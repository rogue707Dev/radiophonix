import http from '../http';

class ResourceClient {
    get(url, params = {}) {
        return http.get(url, {
            params: params
        });
    }

    post(url, data = {}, params = {}) {
        return http.post(url, {
            data: data,
            params: params
        });
    }

    put(url, data = {}, params = {}) {
        return http.put(url, {
            data: data,
            params: params
        });
    }

    delete(url, params = {}) {
        return http.delete(url, {
            params: params
        });
    }
}

export default ResourceClient;
