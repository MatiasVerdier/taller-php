<template lang="html">
  <div class="resource-details">
    <div class="content" v-if="!isLoading && currentResource">
      <router-link to="/dashboard">Volver</router-link>
      
      <h1 class="title">{{ currentResource.title }}</h1>
      
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
import MarkdownEditor from '../../UI/MarkdownEditor.vue';

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
  components: {
    MarkdownEditor,
  },
};
</script>

<style lang="scss" scoped>
.resource-details {
  padding: 20px;
  
  .title {
    font-size: 2em;
    margin: .5em 0;
  }
  
  .loading {
    min-height: 40vh;
  }
}
</style>
