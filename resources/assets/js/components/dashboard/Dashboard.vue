<template lang="html">
  <div class="Dashboard">
    <div class="dashboard-container">
      <side-bar></side-bar>
      
      <div class="dashboard-main">
        
        <transition :name="transitionName">
          <router-view class="child-view"></router-view>
        </transition>
        
      </div>
    </div>
  
    <activity-side-bar></activity-side-bar>
  </div>
</template>

<script>
import SideBar from './SideBar.vue';
import ActivitySideBar from './ActivitySideBar.vue';

export default {
  data() {
    return {
      transitionName: 'slide-left',
    };
  },
  components: {
    SideBar,
    ActivitySideBar,
  },
  watch: {
    $route: function watchRoute(to, from) {
      const toDepth = to.path.split('/').length;
      const fromDepth = from.path.split('/').length;
      this.transitionName = toDepth < fromDepth ? 'slide-right' : 'slide-left';
    },
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
  position: relative;
  
  @media (min-width: 640px) {
    margin-left: 200px;
    max-width: calc(100% - 200px);
  }
}
.empty-dashboard-title {
  font-size: 48px;
  text-align: center;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity .5s ease;
}
.fade-enter, .fade-leave-active {
  opacity: 0
}
.child-view {
  position: absolute;
  left: 0;
  top: 0;
  right: 0;
  transition: all .5s cubic-bezier(.55,0,.1,1);
}
.slide-left-enter, .slide-right-leave-active {
  opacity: 0;
  transform: translate(30px, 0);
}
.slide-left-leave-active, .slide-right-enter {
  opacity: 0;
  transform: translate(-30px, 0);
}
</style>
