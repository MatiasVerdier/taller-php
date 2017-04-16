<template lang="html">
  <el-menu default-active="2" class="SideBar">
    <el-menu-item index="2">Navigator Two</el-menu-item>
    <el-menu-item index="3">Navigator Three</el-menu-item>
  </el-menu>
</template>

<script>
export default {
};
</script>

<style lang="scss">
.SideBar {
  display: none;
  
  @media (min-width: 640px) {
    display: block;
    height: calc(100vh - 60px);
    position: fixed;
    width: 200px;
    border-right: 2px solid #e0e0e0;
  }
}
</style>
