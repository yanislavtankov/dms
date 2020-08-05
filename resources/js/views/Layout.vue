<template>
    <div>
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Welcome<span v-if="authenticated && user"> {{ user.name }}</span></a>
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    <span v-if="authenticated && user">
                        <router-link class="nav-link float-left mr-3" to="/">Home</router-link>
                        <router-link class="nav-link float-left mr-3" to="/about">About</router-link>
                        <a class="nav-link float-right mr-3" @click.prevent="logout" href="#">Sign out</a>
                    </span>
                    <span v-else>
                        <router-link class="nav-link float-left mr-3" to="/">Home</router-link>
                        <router-link class="nav-link float-left mr-3" to="/about">About</router-link>
                        <router-link class="nav-link float-left mr-3" to="/login">Sign In</router-link>
                        <router-link class="nav-link float-left mr-3" to="/signup">Sign Up</router-link>
                    </span>
                </li>
            </ul>
        </nav>

        <div class="container-fluid">
            <div class="row" v-if="authenticated && user">
                <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                    <div class="sidebar-sticky">
                        <router-link class="nav-link" to="/dashboard">Dashboard</router-link>
                        <router-link class="nav-link" to="/companies">My companies</router-link>
                        <router-link class="nav-link" to="/files">My files</router-link>
                        <router-link class="nav-link" to="/account">Account</router-link>
                    </div>
                </nav>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                        <h1 class="h2">{{ $route.name }}</h1>
                    </div>
                    <router-view></router-view>
                </main>
            </div>
            <div v-else>
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    data() {
        return {
            authenticated: auth.check(),
            user: auth.user,
            showAll: false
        };
    },

    mounted() {
        Event.$on('userLoggedIn', () => {
            this.authenticated = true;
            this.user = auth.user;
        });
    },

    methods: {
        logout(){


            if(confirm("Are you sure you want to log out?")) {
                axios.post('api/logout').then(response => {
                    if(response.status == 200) {
                        this.authenticated = false;
                        localStorage.removeItem('token');
                        localStorage.removeItem('user');
                        delete axios.defaults.headers.common['Authorization'];
                        this.authenticated = false;
                        this.user = '';
                        this.token = '';
                        this.$router.push('/login');
                    }
                })
                .catch(error => {
                    this.authenticated = false;
                    localStorage.removeItem('token');
                    localStorage.removeItem('user');
                    delete axios.defaults.headers.common['Authorization'];
                    this.authenticated = false;
                    this.user = '';
                    this.token = '';
                    this.$router.push('/login');
                });
            }
        }
    }

}
</script>
