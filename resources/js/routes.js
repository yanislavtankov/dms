import VueRouter from 'vue-router';

let routes = [
    {
        path: '/',
        component: require('./views/Home.vue').default,
        name: 'Home'
    },
    {
        path: '/about',
        component: require('./views/About.vue').default,
        name: 'About'
    },
    {
        path: '/signup',
        component: require('./views/Signup.vue').default
    },
    {
        path: '/login',
        component: require('./views/Login.vue').default,
        meta: { middlewareAuth: false }
    },
    {
        path: '/dashboard',
        component: require('./views/Dashboard.vue').default,
        meta: { middlewareAuth: true },
        name: 'Dashboard'
    },
    {
        path: '/companies',
        component: require('./views/Companies.vue').default,
        meta: { middlewareAuth: true },
        name: 'Companies'
    },
    {
        path: '/files',
        component: require('./views/Files.vue').default,
        meta: { middlewareAuth: true },
        name: 'Files'
    },
    {
        path: '/account',
        component: require('./views/Account.vue').default,
        meta: { middlewareAuth: true },
        name: 'Account'
    }
];

const router = new VueRouter({
    routes
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.middlewareAuth)) {
        if (!auth.check()) {
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            });
            return;
        }
    }

    // if( auth.check() && to.matched[0].path == '/login' ){
    //     next({
    //         path: '/dashboard',
    //         query: { redirect: to.fullPath }
    //     });
    //     return;
    // }
    next();
})

export default router;
