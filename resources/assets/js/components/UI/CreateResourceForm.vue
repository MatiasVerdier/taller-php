<template lang="html">
  <div class="CreateResourceForm">
    <el-row class="content-selector" :gutter="20">
      <el-col :span="24" v-show="!typeSelected">
        <h2 class="content-selector-title">Comienza con alguna de estas opciones</h2>
      </el-col>
      
      <el-col :xs="formColxs" :sm="formColsm" :lg="formCollg"
        v-show="!typeSelected || resource.type === 'LINK'">
        <el-card class="content-type-card" @click.native="selectResourceType('LINK')">
          <p slot="header">
            Nuevo Sitio Web
          </p>
          
          <div v-show="!typeSelected">
            <icon name="globe" scale="4"></icon>
          </div>
          
          <div class="content link" v-if="resource.type === 'LINK'">
            <el-form :model="resource" label-position="top">
              <el-form-item label="Titulo">
                <el-input v-model="resource.title" placeholder="De que se trata"></el-input>
              </el-form-item>
              
              <el-form-item label="Url">
                <el-input v-model="resource.link" placeholder="Inserta tu link"></el-input>
              </el-form-item>
            </el-form>
            
            <el-button @click="resetForm">
              Cancelar
            </el-button>
            
            <el-button type="primary" @click="addResource">
              Guardar
            </el-button>
          </div>
        </el-card>
      </el-col>
      
      <el-col :xs="formColxs" :sm="formColsm" :lg="formCollg"
        v-show="!typeSelected || resource.type === 'MARKDOWN'">
        <el-card class="content-type-card" @click.native="selectResourceType('MARKDOWN')">
          
          <p slot="header">
            Nuevo Texto / Markdown
          </p>
          
          <div v-show="!typeSelected">
            <icon name="file-text" scale="4"></icon>
          </div>
          
          <div class="content" v-if="resource.type === 'MARKDOWN'">
            <el-form :model="resource" label-position="top">
              <el-form-item label="Titulo">
                <el-input v-model="resource.title" placeholder="De que se trata"></el-input>
              </el-form-item>
            </el-form>
            
            <markdown-editor :value="resource.markdown" @input="updateMarkdown"></markdown-editor>
            
            <el-button @click="resetForm">
              Cancelar
            </el-button>
            
            <el-button type="primary" @click="addResource">
              Guardar
            </el-button>
          </div>
        </el-card>
      </el-col>
      
      <el-col :xs="formColxs" :sm="formColsm" :lg="formCollg"
        v-show="!typeSelected || resource.type === 'CODE'">
        <el-card class="content-type-card" @click.native="selectResourceType('CODE')">
          
          <p slot="header">
            Nuevo Snippet de Codigo
          </p>
          
          <div v-show="!typeSelected">
            <icon name="code" scale="4"></icon>
          </div>
          
          <div class="content" v-if="resource.type === 'CODE'">
            
            <el-form :model="resource" label-position="top">
              <el-form-item label="Titulo">
                <el-input v-model="resource.title" placeholder="De que se trata"></el-input>
              </el-form-item>
            </el-form>
            
            <code-editor></code-editor>
            
            <el-button @click="resetForm">
              Cancelar
            </el-button>
            
            <el-button type="primary" @click="addResource">
              Guardar
            </el-button>
          </div>
        </el-card>
      </el-col>
    </el-row>    
  </div>
</template>

<script>
import MarkdownEditor from './MarkdownEditor.vue';
import CodeEditor from './CodeEditor.vue';

export default {
  data() {
    return {
      typeSelectedColSize: 24,
      resource: {
        type: '',
        title: '',
        description: '',
        link: '',
        markdown: '',
        code: '',
      },
    };
  },
  computed: {
    typeSelected() {
      return this.resource.type !== '';
    },
    formColxs() {
      return !this.typeSelected ? 24 : this.typeSelectedColSize;
    },
    formColsm() {
      return !this.typeSelected ? 12 : this.typeSelectedColSize;
    },
    formCollg() {
      return !this.typeSelected ? 8 : this.typeSelectedColSize;
    },
  },
  methods: {
    selectResourceType(type) {
      this.resource.type = type;
    },
    resetForm(event) {
      event.stopPropagation();
      this.resource.type = '';
    },
    addResource() {
      const { type } = this.resource;
      const data = {
        title: this.resource.title,
        type,
      };
      
      if (type === 'LINK') data.link = this.resource.link;
      if (type === 'MARKDOWN') data.markdown = this.resource.markdown;
      if (type === 'CODE') data.code = this.resource.code;
      
      this.$store.dispatch('addResource', data)
      .then(() => {
        this.cleanForm();
        this.$notify.success({
          title: 'Todo salio bien!',
          message: 'El recurso se ha creado con exito',
        });
      }).catch(error => console.log('catch resource', error));
    },
    cleanForm() {
      this.resource.type = '';
      this.resource.title = '';
      this.resource.description = '';
      this.resource.link = '';
      this.resource.markdown = '';
      this.resource.code = '';
    },
    updateMarkdown(value) {
      this.resource.markdown = value;
    },
  },
  components: {
    MarkdownEditor,
    CodeEditor,
  },
};
</script>

<style lang="css">
/*.content-selector {
  margin-top: 50px;
}*/
.content-selector-title {
  font-size: 26px;
  text-align: center;
}
.content-type-card {
  text-align: center;
}
.content {
  text-align: left;
}

.content.link {
  max-width: 400px;
  margin: 0 auto;
}
</style>
