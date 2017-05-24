<template lang="html">
  <el-card class="card-resource" @click.native="showResource">
    <h2 class="title">
      {{ resource.title }}
    </h2>
    
    <p class="resource-content">
      <template v-if="resource.type === 'LINK'">
        {{ resource.link }}
      </template>
      
      <template v-else-if="resource.type === 'MARKDOWN'">
        <markdown-editor :value="resource.markdown" :isEditing="false" :isSmall="true"></markdown-editor>
      </template>
      
      <template v-else="resource.type === 'CODE'">
        {{ resource.code }}
      </template>
    </p>
    
  </el-card>
</template>

<script>
export default {
  props: {
    resource: {
      type: Object,
      required: true,
    },
  },
  methods: {
    showResource() {
      this.$router.push({
        name: 'show',
        params: {
          id: this.resource.id,
        },
      });
    },
  },
};
</script>

<style lang="scss" scoped>
.card-resource {
  flex: 1 0 auto;
  position: relative;
  box-shadow: none;
  
  &:hover {
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.12), 0 0 6px 0 rgba(0,0,0,.04);
    cursor: pointer;
  }
}
.resource-content {
  word-break: break-all;
  max-height: 150px;
  overflow: hidden;
}
.title {
  font-size: 18px;
  margin-bottom: 1em;
}
</style>
