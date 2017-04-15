<template lang="html">
  <div class="Dashboard">
    <Row type="flex" justify="center">
      <Col :xs="20" :lg="16">
        <Row>
          <Col span="24">
            <h1 class="empty-dashboard-title">
              Todavía no has agregado ningún material
            </h1>
          </Col>
        </Row>
        
        <create-resource-form></create-resource-form>
      </Col>
    </Row>
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
