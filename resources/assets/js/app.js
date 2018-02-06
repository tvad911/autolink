/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('flash', require('vue-flash'));
Vue.component('index-user', require('./components/backends/users/Index.vue'));
Vue.component('index-group', require('./components/backends/groups/Index.vue'));
Vue.component('index-profile', require('./components/backends/profile/Index.vue'));
Vue.component('index-editprofile', require('./components/backends/profile/Show.vue'));
Vue.component('index-changepassword', require('./components/backends/profile/ChangePassword.vue'));
Vue.component('index-apishortesturl', require('./components/backends/profile/ApiShortestUrl.vue'));
Vue.component('index-link', require('./components/backends/links/Index.vue'));

var bus = new Vue();

const app = new Vue({
    el: '#app',
    data: {
        bus: bus // Here we bind our event bus to our $root Vue model.
    }
});