/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.axios = require('axios');

import VueRouter from 'vue-router';
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import Api from './api.js';
import Auth from './auth.js';
import router from './routes.js';
import VueFlashMessage from 'vue-flash-message';
import SlimDialog from 'v-slim-dialog'
import { BootstrapVueIcons } from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue-icons.min.css'
import Lightbox from 'vue-my-photos'

Vue.component('lightbox', Lightbox);



import 'v-slim-dialog/dist/v-slim-dialog.css'
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap-vue/dist/bootstrap-vue.css"
import 'vue-flash-message/dist/vue-flash-message.min.css';

window.api = new Api();
window.auth = new Auth();
window.Event = new Vue;

window.Vue = require('vue');

Vue.use(BootstrapVue)
Vue.use(VueRouter);
Vue.use(VueFlashMessage);
Vue.use(SlimDialog)
Vue.use(BootstrapVueIcons)


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('vue-layout', require('./views/Layout.vue').default);
Vue.component('modal', require('./components/Modal.vue').default);
Vue.component('company-modal', require('./components/CompaniesModal.vue').default);
Vue.component('file-modal', require('./components/FilesModal.vue').default);
Vue.component('pdf-modal', require('./components/PdfModal.vue').default);
Vue.component('import-modal', require('./components/ImportModal.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
