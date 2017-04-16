<template lang="html">
  <div class="Dashboard">
    <div class="dashboard-container">
      <side-bar></side-bar>
      
      <div class="dashboard-main">
        <resource-create-buttons></resource-create-buttons>
        
        <resource-list></resource-list>
      </div>
    </div>
  
    <activity-side-bar></activity-side-bar>
  </div>
</template>

<script>
import SideBar from './SideBar.vue';
import ActivitySideBar from './ActivitySideBar.vue';
import ResourceCreateButtons from './resources/ResourceCreateButtons.vue';
import ResourceList from './resources/ResourceList.vue';

export default {
  components: {
    SideBar,
    ActivitySideBar,
    ResourceCreateButtons,
    ResourceList,
  },
};
</script>

<style lang="scss" scoped>
.dashboard-container {
  @media (min-width: 1024px) {
    margin-right: 200px;
  }
}
.dashboard-main {
  max-width: 100%;
  height: calc(100vh - 60px);
  
  @media (min-width: 640px) {
    margin-left: 200px;
    max-width: calc(100% - 200px);
  }
}
.empty-dashboard-title {
  font-size: 48px;
  text-align: center;
}
</style>
