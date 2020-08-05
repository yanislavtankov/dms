
// window.axios = require('axios');

class Auth {
    constructor() {
        this.token = window.localStorage.getItem('token');

        let userData = window.localStorage.getItem('user');
        this.user = userData ? JSON.parse(userData) : null;

        if (this.token) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token;
            this.getUser();
        }
    }

    login (token, user) {
        window.localStorage.setItem('token', token);
        window.localStorage.setItem('user', JSON.stringify(user));

        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;

        this.token = token;
        this.user = user;

        Event.$emit('userLoggedIn');
    }

    check () {
        return !! this.token;
    }

    getUser() {
        api.call('get', '/api/get-user')
        .then(({data}) => {
            this.user = data;
        });
    }

    logout (tokenIsValid = true) {
        if (tokenIsValid) {
            api.call('get', '/api/logout')
            .then(({response}) => {
                if(response.status == 200){
                    window.localStorage.removeItem('token');
                    window.localStorage.removeItem('user');
                    this.authenticated = false;
                    this.user = '';
                    this.token = '';
                }
            });
        } else {
            window.localStorage.removeItem('token');
            window.localStorage.removeItem('user');
            this.authenticated = false;
            this.user = '';
            this.token = '';
        }
    }

}

export default Auth;
