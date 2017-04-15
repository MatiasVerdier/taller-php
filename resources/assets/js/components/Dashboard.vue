<template lang="html">
  <div class="Dashboard">
    <el-row type="flex" justify="center">
      <el-col :xs="20" :lg="16">
        <!-- <el-row>
          <el-col span="24">
            <h1 class="empty-dashboard-title">
              Todavía no has agregado ningún material
            </h1>
          </el-col>
        </el-row> -->
        
        <create-resource-form></create-resource-form>
      </el-col>
    </el-row>
  </div>
</template>

<script>
import CreateResourceForm from './UI/CreateResourceForm.vue';

export default {
  components: {
    CreateResourceForm,
  },
};
</script>

<style scoped>
.Dashboard {
  padding: 20px;
  height: calc(100vh - 60px);
}
.empty-dashboard-title {
  font-size: 48px;
  text-align: center;
}
</style>
