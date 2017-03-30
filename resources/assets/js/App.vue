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
  components: {
    Navigation,
  },
};
</script>

<style lang="css">
</style>
