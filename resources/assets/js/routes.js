import Home from './components/Home.vue';
import Explore from './components/Explore.vue';
import Authenticate from './components/Authenticate.vue';
import Dashboard from './components/dashboard/Dashboard.vue';
import ResourceList from './components/dashboard/resources/ResourceList.vue';
import ResourceCreate from './components/dashboard/resources/ResourceCreate.vue';
import ResourceShow from './components/dashboard/resources/ResourceShow.vue';

const routes = [
  { path: '/', name: 'home', component: Home, meta: { onlyGuest: true } },
  { path: '/explore', name: 'explore', component: Explore },
  { path: '/login', name: 'login', component: Authenticate, meta: { onlyGuest: true } },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard,
    redirect: '/dashboard/resources',
    meta: {
      requireAuth: true,
    },
    children: [
      {
        path: 'resources', name: 'resource-list', component: ResourceList,
      },
      {
        path: 'create/:type', component: ResourceCreate,
      },
      {
        path: 'show/:id', name: 'show', component: ResourceShow, props: true,
      },
    ],
  },
];

export default routes;
