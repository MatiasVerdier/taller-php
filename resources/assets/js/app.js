/* global window */
import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import App from './App.vue';
import routes from './routes';

Vue.use(VueRouter);

axios.defaults.headers.common = {
  'X-CSRF-TOKEN': window.Laravel.csrfToken,
  'X-Requested-With': 'XMLHttpRequest',
};

const router = new VueRouter({
  mode: 'history',
  routes,
});

/* eslint no-new: "off" */
new Vue({
  el: '#app',
  router,
  render: h => h(App),
});
