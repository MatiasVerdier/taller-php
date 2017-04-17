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
