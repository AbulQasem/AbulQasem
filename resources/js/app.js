/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

window.Vue = require('vue').default;
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


import router from './routes.js';
import vuetify from '../plugins/vuetify'
import 'material-design-icons-iconfont/dist/material-design-icons.css' // Ensure you are using css-loader
import '@mdi/font/css/materialdesignicons.css'


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
  vuetify,
  router,
}).$mount('#app')

Vue.use(vuetify, {
  iconfont: 'md'
})