import Vue from 'vue';
import VueRouter from 'vue-router';
import iView from 'iview';
import routes from './routes';

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes,
});

// Start loading bar before each route
router.beforeEach((to, from, next) => {
  iView.LoadingBar.start();
  next();
});

// Finish loading bar after each route
router.afterEach((to, from, next) => { // eslint-disable-line
  iView.LoadingBar.finish();
  window.scrollTo(0, 0);
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
