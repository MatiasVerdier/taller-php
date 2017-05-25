<template lang="html">
  <div class="resource-details">
    <div class="content" v-if="!isLoading && currentResource">
      <router-link to="/dashboard">Volver</router-link>
      
      <div class="actions-container">
        <h1 class="title">{{ currentResource.title }}</h1>
        <el-button type="primary" class="edit-button" icon="edit">Editar</el-button>
      </div>
      
      <div class="body">
        <template v-if="currentResource.type === 'LINK'">
          {{ currentResource.link }}
        </template>
        
        <template v-else-if="currentResource.type === 'MARKDOWN'">
          <markdown-editor :value="currentResource.markdown" :isEditing="false"></markdown-editor>
        </template>
        
        <template v-else="currentResource.type === 'CODE'">
          {{ currentResource.code }}
        </template>
      </div>
    </div>
    
    <div v-else class="loading" v-loading="isLoading"></div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';

export default {
  mounted() {
    this.getResource(this.id);
  },
  props: {
    id: {
      required: true,
    },
  },
  computed: {
    ...mapGetters(['currentResource', 'isLoading']),
  },
  methods: {
    ...mapActions(['getResource']),
  },
};
</script>

<style lang="scss" scoped>
.resource-details {
  padding: 20px;
  
  .actions-container {
    margin: .5em 0;
  }
  
  .body {
    padding: 20px 0;
  }
  
  .title {
    font-size: 2em;
    display: inline-block;
  }
  
  .loading {
    min-height: 40vh;
  }
  
  .edit-button {
    float: right;
  }
}
</style>
