<template lang="html">
  <div class="App">
    <!-- Navigation -->
    <navigation></navigation>
    
    <!-- Main Content -->
    <div id="main">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import Navigation from './components/Navigation.vue';

export default {
  mounted() {
    this.axios.interceptors.response.use(response => response
    , (error) => {
      if (error.response.status === 401) {
        localStorage.removeItem('token');
        this.$store.dispatch('unauthenticated');
        this.$router.push({ name: 'login' });
      }
      return Promise.reject(error);
    });
  },
  components: {
    Navigation,
  },
};
</script>

<style scoped>
@import "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css";
@import "https://unpkg.com/element-ui/lib/theme-default/index.css";

#main {
  padding-top: 60px;
}
</style>
