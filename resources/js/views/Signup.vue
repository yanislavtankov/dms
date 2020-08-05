<template>
    <div class="container vertical-center mt-5" >
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Sign Up</div>
                    <div class="card-body">
                        <form
                            id="app"
                            @submit="formSubmit"
                            enctype="multipart/form-data"
                            novalidate="true"
                        >
                            <flash-message transitionIn="animated swing"></flash-message>
                            <label for="name">Name</label>
                            <input class="form-control"
                                type="text"
                                name="name"
                                v-model="name"
                                id="name"
                            >
                            <label for="email">Email</label>
                            <input class="form-control"
                                id="email"
                                v-model="email"
                                type="email"
                                name="email"
                            >
                            <label for="password">Password</label>
                            <input class="form-control"
                                id="password"
                                type="password"
                                name="password"
                                v-model="password"
                            >
                            <button class="btn btn-success mt-3 float-right">Submit</button>
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: '',
            email: '',
            password: ''
        };
    },

    methods: {
        formSubmit(e) {
            var flashMessage = '';
            var flashAlert = 'info';
            var errors = [];
            var htmlMessage = '<p>Please correct the following error(s):</p><ul>';

            e.preventDefault();
            let currentObj = this;

            if (!this.name) {
                errors.push("Name required.");
            }
            if (!this.password) {
                errors.push("Password required.");
            }
            if (!this.email) {
                errors.push('Email required.');
            } else if (!this.validEmail(this.email)) {
                errors.push('Valid email required.');
            }

            if (!errors.length) {

                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let formData = new FormData();
                formData.append('name', this.name);
                formData.append('email', this.email);
                formData.append('password', this.password);

                api.call('post', '/api/register', formData, config)
                .then(function (response) {
                switch(response.status) {
                    case 401, 500:
                        flashAlert = 'error'
                        break;
                    case 200:
                    flashAlert = 'success'
                        break;
                    default:
                    flashAlert = 'info'
                }
                    currentObj.flash(response.data.message, flashAlert, {
                        timeout: 3000
                    });
                    currentObj.name = '';
                    currentObj.email = '';
                    currentObj.password = '';
                })
                .catch(function (error) {
                    currentObj.flash(error, 'error', {
                        timeout: 3000
                    });
                });
            } else {
                errors.forEach(element =>
                    htmlMessage += '<li>' + element + '</li>'
                );
                htmlMessage += '</ul>';
                currentObj.flash(htmlMessage, 'warning', {
                    timeout: 3000
                });
            }
        },

        validEmail: function (email) {
            var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
    }
}
</script>
