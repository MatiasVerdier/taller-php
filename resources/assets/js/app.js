import Vue from 'vue';
import iView from 'iview';
import locale from 'iview/src/locale/lang/en-US';
import 'iview/dist/styles/iview.css';
import App from './App.vue';
import store from './store';
import router from './router';

Vue.use(iView, { locale });

/* eslint no-new: "off" */
new Vue({
  el: '#app',
  router,
  store,
  render: h => h(App),
});
