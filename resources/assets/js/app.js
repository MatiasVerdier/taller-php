/* global window */
import Vue from 'vue';
import VueRouter from 'vue-router';
import iView from 'iview';
import locale from 'iview/src/locale/lang/en-US';
import 'iview/dist/styles/iview.css';
import axios from 'axios';
import App from './App.vue';
import routes from './routes';
import store from './store';

Vue.use(VueRouter);
Vue.use(iView, { locale });

axios.defaults.headers.common = {
  'X-CSRF-TOKEN': window.Laravel.csrfToken,
  'X-Requested-With': 'XMLHttpRequest',
};

const router = new VueRouter({
  mode: 'history',
  routes,
});

router.beforeEach((to, from, next) => {
  iView.LoadingBar.start();
  next();
});

router.afterEach((to, from, next) => { // eslint-disable-line
  iView.LoadingBar.finish();
  window.scrollTo(0, 0);
});

/* eslint no-new: "off" */
new Vue({
  el: '#app',
  router,
  store,
  render: h => h(App),
});
