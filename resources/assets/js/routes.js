import Home from './components/Home.vue';
import Explore from './components/Explore.vue';
import Authenticate from './components/Authenticate.vue';

const routes = [
  { path: '/', component: Home },
  { path: '/explore', component: Explore },
  { path: '/authenticate', component: Authenticate },
];

export default routes;
