import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/es';
import 'element-ui/lib/theme-default/index.css';
import 'vue-awesome/icons';
import Icon from 'vue-awesome/components/Icon.vue';
import App from './App.vue';
import store from './store';
import router from './router';

Vue.use(ElementUI, { locale });
Vue.use(VueAxios, axios);
Vue.component('icon', Icon);

/* eslint no-new: "off" */
new Vue({
  el: '#app',
  router,
  store,
  render: h => h(App),
});
