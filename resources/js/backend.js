/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window._ = require('lodash');
window.axios = require("axios");

let base_url = document.head.querySelector('meta[name="base-url"]');

if (window.axios) {
    window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

    /**
     * Next we will register the CSRF Token as a common header with Axios so that
     * all outgoing HTTP requests automatically have it attached. This is just
     * a simple convenience so we don't have to attach every token manually.
     */

    let token = document.head.querySelector('meta[name="csrf-token"]');

    if (token) {
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    } else {
        console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
    }

    if (base_url) {
      window.axios.defaults.baseURL = base_url.content;
      window.base_url = base_url.content;
   }
}

window.Vue = require('vue');
Vue.component('attribute-options', require('./components/backend/AttributeOptions.vue').default);
// Vue.component('type-product', require('./components/backend/TypeProduct.vue').default);
// Vue.component('variations', require('./components/backend/Variations.vue').default);
// Vue.component('product-related', require('./components/backend/ProductRelated.vue').default);
// Vue.component('categories-product', require('./components/backend/CategoryProduct.vue').default);
// Vue.component('product-images', require('./components/backend/ProductImages.vue').default);
// Vue.component('rules-discount', require('./components/backend/RulesDiscount.vue').default);
// Vue.component('user-coupon', require('./components/backend/UserCoupon.vue').default);


$(document).ready(function () {
const app = new Vue({
    el: '#app'
});

});