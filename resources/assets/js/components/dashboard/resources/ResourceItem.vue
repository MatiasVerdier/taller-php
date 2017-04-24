<template lang="html">
  <el-card class="card-resource">
    <div slot="header">
      <h2 style="font-size: 18px;">
        {{ resource.title }}
      </h2>
      <i style="position: absolute; top: 10px; right: 10px;" class="fa fa-gear"></i>
    </div>
    
    <p style="word-break: break-all;">
      <template v-if="resource.type === 'LINK'">
        {{ resource.link }}
      </template>
      
      <template v-else-if="resource.type === 'MARKDOWN'">
        {{ resource.markdown }}
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
};
</script>

<style lang="scss">
</style>
