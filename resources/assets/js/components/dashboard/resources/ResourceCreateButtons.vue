<template lang="html">
  <el-row class="resource-create-buttons">
    <el-col :span="7">
      <el-card class="resource-type-card">
        <h2>
          <i class="fa fa-globe"></i>
          Sitio Web
        </h2>
      </el-card>
    </el-col>
    
    <el-col :span="7">
      <el-card class="resource-type-card">
        <h2>
          <i class="fa fa-file-text"></i>
          Markdown
        </h2>
      </el-card>
    </el-col>
    
    <el-col :span="7">
      <el-card class="resource-type-card">
        <h2>
          <i class="fa fa-code"></i>
          Snippet
        </h2>
      </el-card>
    </el-col>
  </el-row>
</template>

<script>
export default {
};
</script>

<style lang="scss">
.resource-create-buttons {
  padding: 20px;
  display: flex;
  justify-content: space-between;
  
  .resource-type-card {
    text-align: left;
    
    @media (min-width: 640px) {
      text-align: center;
    }
    
    .el-card__body {
      padding: 10px;
      
      @media (min-width: 640px) {
        padding: 10px 0;
      }
    }
    
    i {
      font-size: 1.2em;
      vertical-align: middle;
      margin-right: 10px;
      
      @media (min-width: 640px) {
        display: block;
        font-size: 2em;
        margin-bottom: 10px;
      }
    }
  }
}
</style>
