<template lang="html">
  <div class="resource-create">
    <el-row>
      <el-col :span="24">
        <h1 class="view-title">{{ viewTitle }}</h1>
      </el-col>
    </el-row>
    
    <el-row type="flex" justify="center">
      <el-col :span="18">
        
        <div class="content" v-if="type === 'link'">
          <el-card>
            <el-form :model="resource" label-position="top">
              <el-form-item label="Titulo">
                <el-input v-model="resource.title" placeholder="De que se trata"></el-input>
              </el-form-item>
              
              <el-form-item label="Url">
                <el-input v-model="resource.link" placeholder="Inserta tu link"></el-input>
              </el-form-item>
            </el-form>
            
            <el-button @click="backToList">
              Cancelar
            </el-button>
            
            <el-button type="primary" @click="addResource">
              Guardar
            </el-button>
          </el-card>
        </div>
        
        
        <div class="content" v-if="type === 'markdown'">
          <el-card>
            <el-form :model="resource" label-position="top">
              <el-form-item label="Titulo">
                <el-input v-model="resource.title" placeholder="De que se trata"></el-input>
              </el-form-item>
            </el-form>
            
            <markdown-editor :value="resource.markdown" @input="onInput" :isEditing="true"></markdown-editor>
            
            <el-button @click="backToList">
              Cancelar
            </el-button>
            
            <el-button type="primary" @click="addResource">
              Guardar
            </el-button>
          </el-card>
        </div>
        
        <div class="content" v-if="type === 'code'">
          <el-card>
            <el-form :model="resource" label-position="top">
              <el-form-item label="Titulo">
                <el-input v-model="resource.title" placeholder="De que se trata"></el-input>
              </el-form-item>
            </el-form>
            
            <code-editor></code-editor>
            
            <el-button @click="backToList">
              Cancelar
            </el-button>
            
            <el-button type="primary" @click="addResource">
              Guardar
            </el-button>
          </el-card>
        </div>
        
      </el-col>
    </el-row>
    
    <el-row>
      <el-col>
        <div class="change-type">
          <h3>O intenta con</h3>
          <router-link to="link" v-show="type !== 'link'">Link</router-link>
          <router-link to="markdown" v-show="type !== 'markdown'">Markdown</router-link>
          <router-link to="code" v-show="type !== 'code'">Snippet</router-link>
        </div>
      </el-col>
    </el-row>
  </div>
</template>

<script>
export default {
  data() {
    return {
      resource: {
        title: '',
        description: '',
        link: '',
        markdown: '',
        code: '',
      },
    };
  },
  computed: {
    type() {
      return this.$route.params.type;
    },
    viewTitle() {
      let title;
      if (this.type === 'link') {
        title = 'Agregar nuevo sitio web';
      } else if (this.type === 'markdown') {
        title = 'Crear documento markdown';
      } else if (this.type === 'code') {
        title = 'Crear snippet';
      }
      
      return title;
    },
  },
  methods: {
    onInput(value) {
      this.resource.markdown = value;
    },
    addResource() {
      const { type } = this;
      const data = {
        title: this.resource.title,
        type,
      };
      
      if (type === 'link') data.link = this.resource.link;
      if (type === 'markdown') data.markdown = this.resource.markdown;
      if (type === 'code') data.code = this.resource.code;
      
      this.$store.dispatch('addResource', data)
      .then(() => {
        this.$notify.success({
          title: 'Todo salio bien!',
          message: 'El recurso se ha creado con exito',
        });
        this.backToList();
      }).catch(error => console.log('catch resource', error));
    },
    backToList() {
      this.$router.push({ name: 'resource-list' });
    },
  },
};
</script>

<style lang="scss">
.resource-create {
  padding: 20px;
}

.change-type {
  margin-top: 30px;
  text-align: center;
}

.view-title {
  font-size: 2.6em;
  text-align: center;
  margin-bottom: 30px;
}
</style>
