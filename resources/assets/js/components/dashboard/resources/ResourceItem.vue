<template lang="html">
  <el-card class="card-resource" v-bind:class="cardTypeClass" @click.native="showResource">
    <h2 slot="header" class="title">
      {{ resource.title }}
    </h2>
    
    <div class="resource-content">
      <template v-if="resource.type === 'LINK'">
        <div class="link-image" v-bind:style="{ backgroundImage: `url(${linkImage})` }"></div>
        <div class="link-href">
          <a :href="resource.link" @click.stop="" target="_blank" rel="noopener">Visitar sitio</a>
        </div>
      </template>
      
      <template v-else-if="resource.type === 'MARKDOWN'">
        <markdown-editor :value="resource.markdown" :isEditing="false" :isSmall="true"></markdown-editor>
      </template>
      
      <template v-else="resource.type === 'CODE'">
        {{ resource.code }}
      </template>
    </div>
    
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
  computed: {
    cardTypeClass() {
      return `type-${this.resource.type.toLowerCase()}`;
    },
    linkImage() {
      return this.resource.link_image || 'http://placehold.it/350x150?text=No+Disponible';
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

<style lang="scss">
.card-resource {
  flex: 1 0 auto;
  position: relative;
  box-shadow: none;
  
  .el-card__body {
    position: relative;
  }
  
  .el-card__header {
    padding: 10px;
    color: #ecf0f1;
    border: none;
  }
  
  &:hover {
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.12), 0 0 6px 0 rgba(0,0,0,.04);
    cursor: pointer;
  }
  
  .resource-content {
    word-break: break-all;
    overflow: hidden;
    max-height: 180px;
    
    .link-image {
      min-height: 150px;
      background-position: center;
      background-size: cover;
      margin-bottom: 10px;
    }
  }
  
  .title {
    font-size: 16px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  
  &.type-link {
    .el-card__header {
      background-color: #2980b9;
    }
  }
  &.type-markdown {
    .el-card__header {
      background-color: #16a085;
    }
  }
  &.type-code {
    .el-card__header {
      background-color: #d35400;
    }
  }
}
</style>
