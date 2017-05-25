<template lang="html">
  <div class="ActivitySideBar">
    <el-row style="padding:20px;">
      <el-col :span="24" v-for="n in 10" :key="n">
        <el-alert
          title="texto de prueba"
          type="success"
          :closable="false"
          style="padding: 5px 0; margin-bottom: 10px;">
        </el-alert>
      </el-col>
    </el-row>
  </div>
</template>

<script>
export default {
};
</script>

<style lang="scss">
.ActivitySideBar {
  display: none;
  
  @media (min-width: 1024px) {
    display: block;
    position: fixed;
    right: 0px !important;
    top: 0px !important;
    width: 200px;
    height: 100%;
    background-color: #fff;
    box-sizing: border-box;
    margin-top: 60px;
    border-left: 2px solid #e0e0e0;
  }
}
</style>
