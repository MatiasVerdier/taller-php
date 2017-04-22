<template lang="html">
  <el-row class="resource-list">
    
    <resource-create-buttons></resource-create-buttons>
    
    <el-col :span="24">
      <el-tabs value="my-resources">
        <el-tab-pane label="Mis Resursos" name="my-resources">
          <el-row class="flex-container">
            <el-col :xs="24" :sm="12" :lg="6" v-for="resource in myResources" class="flex-item">
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
            </el-col>
          </el-row>
        </el-tab-pane>
        
        <el-tab-pane label="Compartidos conmigo" name="shared-with-me">
          
        </el-tab-pane>
      </el-tabs>
    </el-col>
  </el-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import ResourceCreateButtons from './ResourceCreateButtons.vue';

export default {
  mounted() {
    this.getMyResources(this.currentUser.id);
  },
  methods: {
    ...mapActions(['getMyResources']),
  },
  computed: {
    ...mapGetters(['currentUser', 'myResources']),
  },
  components: {
    ResourceCreateButtons,
  },
};
</script>

<style lang="scss">
  .resource-list {
    padding: 0 20px;
    margin-bottom: 20px;
  }
  
  .flex-container {
    display: flex;
    flex-wrap: wrap;
    
    .flex-item {
      display: flex; 
      padding: 0.5em;
      flex-direction: column;
      
      .card-resource {
        flex: 1 0 auto;
        position: relative;
      }
    }
  }
  
  
</style>
