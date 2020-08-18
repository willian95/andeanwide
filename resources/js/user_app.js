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

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('create-identity', require('./views/user/identity/Create.vue').default);
Vue.component('create-address', require('./views/user/address/Create.vue').default);
Vue.component('add-recipient', require('./views/user/orders/AddRecipient').default);
Vue.component('user-rate-calculator', require('./views/user/orders/UserRateCalculator').default);
Vue.component('order-validation', require('./views/user/orders/OrderValidation').default);
Vue.component('show-order', require('./views/user/orders/Show').default);
Vue.component('navbar-component', require('./views/layout/Navbar').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
