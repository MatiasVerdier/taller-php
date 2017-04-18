import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/es';
import App from './App.vue';
import store from './store';
import router from './router';
import Gravatar from './components/Gravatar.vue';

Vue.use(ElementUI, { locale });
Vue.use(VueAxios, axios);
Vue.component('gravatar', Gravatar);

/* eslint no-new: "off" */
new Vue({
  el: '#app',
  router,
  store,
  render: h => h(App),
});
