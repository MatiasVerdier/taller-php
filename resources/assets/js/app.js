import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/es';
import App from './App.vue';
import store from './store';
import router from './router';

// Global components
import Gravatar from './components/Gravatar.vue';
import MarkdownEditor from './components/UI/MarkdownEditor.vue';
import CodeEditor from './components/UI/CodeEditor.vue';

Vue.component('gravatar', Gravatar);
Vue.component('markdown-editor', MarkdownEditor);
Vue.component('code-editor', CodeEditor);

// Plugins
Vue.use(ElementUI, { locale });
Vue.use(VueAxios, axios);

/* eslint no-new: "off" */
new Vue({
  el: '#app',
  router,
  store,
  render: h => h(App),
});
