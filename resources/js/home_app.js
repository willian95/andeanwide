require('./bootstrap');

window.Vue = require('vue');


Vue.component('rate-calculator', require('./views/RateCalculator.vue').default);
Vue.component('contact-form-component', require('./views/ContactFormComponent.vue').default);

const app = new Vue({
    el: '#home_app',
});
