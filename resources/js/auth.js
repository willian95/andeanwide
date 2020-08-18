require('./bootstrap');

window.Vue = require('vue');

Vue.component('register-form-component', require('./views/RegisterFormComponent.vue').default);

const app = new Vue({
    el: '#auth_app',
});
