
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */




// require('./bootstrap');
window.Vue = require('vue');
var VueResource = require('vue-resource');
import lodash from 'lodash'
Vue.prototype._ = lodash

Vue.use(VueResource);
// Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;


Vue.component('app', require('./components/App.vue'));

const app = new Vue({
    el: '#app'
});