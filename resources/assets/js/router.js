import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes,
});

router.beforeEach((to, from, next) => {
  if (to.meta.requireAuth) {
    const authToken = localStorage.getItem('token');
    
    if (authToken) {
      next();
    } else {
      next({ name: 'login' });
    }
  }
  next();
});

export default router;
