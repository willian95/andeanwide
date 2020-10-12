/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('create-symbol', require('./views/admin/symbols/Create.vue').default);
Vue.component('show-symbol', require('./views/admin/symbols/Show.vue').default);
Vue.component('index-symbol', require('./views/admin/symbols/Index.vue').default);
Vue.component('show-user', require('./views/admin/users/Show.vue').default);
Vue.component('show-order', require('./views/admin/order/Show').default);
Vue.component('navbar-component', require('./views/layout/Navbar').default);
Vue.component('create-currency', require('./views/admin/currencies/Create').default);
Vue.component('show-currency', require('./views/admin/currencies/Show').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
