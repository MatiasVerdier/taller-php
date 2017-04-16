import Home from './components/Home.vue';
import Explore from './components/Explore.vue';
import Authenticate from './components/Authenticate.vue';
import Dashboard from './components/dashboard/Dashboard.vue';

const routes = [
  { path: '/', name: 'home', component: Home },
  { path: '/explore', name: 'explore', component: Explore },
  { path: '/login', name: 'login', component: Authenticate, meta: { onlyGuest: true } },
  { path: '/dashboard', name: 'dashboard', component: Dashboard, meta: { requireAuth: true } },
];

export default routes;
