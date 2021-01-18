/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

//V form
import {AlertError, Form, HasError} from 'vform'
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
//Vue Router
import VueRouter from 'vue-router';
import {routes} from './routes/routes'
Vue.use(VueRouter);
//toastr
import toastr from 'toastr'
window.toastr = toastr;

// Vuex
import Vuex from 'vuex'
import storeData from "./store/store";

Vue.use(Vuex)
const store = new Vuex.Store(
    storeData
)

const router = new VueRouter({
    routes,
    // mode: 'history',
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('home', require('./components/backend/home').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    store
});
