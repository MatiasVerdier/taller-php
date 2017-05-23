import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes,
});

router.beforeEach((to, from, next) => {
  const authToken = localStorage.getItem('token');
  
  if (to.meta.requireAuth) {
    if (authToken) {
      next();
    } else {
      next({ name: 'login' });
    }
  }
  
  if (to.meta.onlyGuest) {
    if (authToken) {
      next({ name: 'dashboard' });
    } else {
      next();
    }
  }
  
  next();
});

router.afterEach((to, from) => { // eslint-disable-line
  window.scrollTo(0, 0);
});

export default router;
