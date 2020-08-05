class Api {
    constructor () {}

    call (requestType, url, data = null, config = null) {
        return new Promise((resolve, reject) => {
            axios[requestType](url, data, config)
                .then(response => {
                    resolve(response);
                })
                .catch(({response}) => {
                    if (response.status === 401) {
                        auth.logout(false);
                    }
                    resolve(response);
                });
        });
    }

}

export default Api;
