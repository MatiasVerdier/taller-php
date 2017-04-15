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
    this.$Notice.config({
      top: 80,
      duration: 3,
    });
  },
  components: {
    Navigation,
  },
};
</script>

<style scoped>
#main {
  padding-top: 60px;
}
</style>
