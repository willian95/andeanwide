require('./bootstrap');

window.Vue = require('vue');

Vue.component('user-rate-calculator', require('./views/UserRateCalculator.vue').default);

const app = new Vue({
    el: '#user_calculator_app',
});
