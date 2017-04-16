<template lang="html">
  <el-row class="resource-list">
    <el-col :span="24">
      <el-tabs>
        <el-tab-pane label="User" name="first">User</el-tab-pane>
        <el-tab-pane label="Config" name="second">Config</el-tab-pane>
        <el-tab-pane label="Role" name="third">Role</el-tab-pane>
        <el-tab-pane label="Task" name="fourth">Task</el-tab-pane>
      </el-tabs>
    </el-col>
  </el-row>
</template>

<script>
export default {
}
</script>

<style lang="scss">
  .resource-list {
    padding: 0 20px;
    margin-bottom: 20px;
  }
</style>
