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
        
        <Row class="content-selector" :gutter="20">
          <Col span="24">
            <h2 class="content-selector-title">Comienza con alguna de estas opciones</h2>
          </Col>
          
          <Col :xs="24" :sm="12" :lg="8">
            <Card class="content-type-card">
              <Icon type="document-text" size="64"></Icon>
              <h2>Texto</h2>
            </Card>
          </Col>
          <Col :xs="24" :sm="12" :lg="8">
            <Card class="content-type-card">
              <Icon type="earth" size="64"></Icon>
              <h2>Sitio Web</h2>
            </Card>
          </Col>
          <Col :xs="24" :sm="12" :lg="8">
            <Card class="content-type-card">
              <Icon type="social-youtube" size="64"></Icon>
              <h2>Video</h2>
            </Card>
          </Col>
          <Col :xs="24" :sm="12" :lg="8">
            <Card class="content-type-card">
              <Icon type="code" size="64"></Icon>
              <h2>Codigo</h2>
            </Card>
          </Col>
          <Col :xs="24" :sm="12" :lg="8">
            <Card class="content-type-card">
              <Icon type="clipboard" size="64"></Icon>
              <h2>Listas</h2>
            </Card>
          </Col>
          <Col :xs="24" :sm="12" :lg="8">
            <Card class="content-type-card">
              <Icon type="ios-mic" size="64"></Icon>
              <h2>Podcasts</h2>
            </Card>
          </Col>
        </Row>
      </Col>
    </Row>
  </div>
</template>

<script>
export default {
};
</script>

<style scoped>
.Dashboard {
  padding: 20px;
  height: calc(100vh - 60px);
}
.content-selector {
  margin-top: 50px;
}
.content-selector-title {
  font-size: 26px;
  text-align: center;
}
.ivu-card {
  margin: 10px 0;
}
.content-type-card {
  text-align: center;
}
.empty-dashboard-title {
  font-size: 48px;
  text-align: center;
}
</style>
