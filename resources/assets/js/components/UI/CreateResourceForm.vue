<template lang="html">
  <div class="CreateResourceForm">
    <Row class="content-selector" :gutter="20">
      <Col span="24" v-show="!typeSelected">
        <h2 class="content-selector-title">Comienza con alguna de estas opciones</h2>
      </Col>
      
      <Col :xs="formColxs" :sm="formColsm" :lg="formCollg"
        v-show="!typeSelected || resource.type === 'LINK'">
        <Card class="content-type-card" @click.native="selectResourceType('LINK')">
          <p slot="title">
            Nuevo Sitio Web
          </p>
          
          <div v-show="!typeSelected">
            <Icon type="earth" size="64"></Icon>
          </div>
          
          <div class="content link" v-if="resource.type === 'LINK'">
            <Form :model="resource" label-position="top">
              <Form-item label="Titulo">
                <Input v-model="resource.title" placeholder="De que se trata"></Input>
              </Form-item>
              
              <Form-item label="Url">
                <Input v-model="resource.link" placeholder="Inserta tu link"></Input>
              </Form-item>
            </Form>
            
            <button class="ivu-btn" @click="resetForm">
              Cancelar
            </button>
            
            <button class="ivu-btn ivu-btn-primary" @click="addResource">
              Guardar
            </button>
          </div>
        </Card>
      </Col>
      
      <Col :xs="formColxs" :sm="formColsm" :lg="formCollg"
        v-show="!typeSelected || resource.type === 'MARKDOWN'">
        <Card class="content-type-card" @click.native="selectResourceType('MARKDOWN')">
          
          <p slot="title">
            Nuevo Texto / Markdown
          </p>
          
          <div v-show="!typeSelected">
            <Icon type="document-text" size="64"></Icon>
          </div>
          
          <div class="content" v-if="resource.type === 'MARKDOWN'">
            <Form :model="resource" label-position="top">
              <Form-item label="Titulo">
                <Input v-model="resource.title" placeholder="De que se trata"></Input>
              </Form-item>
            </Form>
            
            <markdown-editor :value="resource.markdown" @input="updateMarkdown"></markdown-editor>
            
            <button class="ivu-btn" @click="resetForm">
              Cancelar
            </button>
            
            <button class="ivu-btn ivu-btn-primary" @click="addResource">
              Guardar
            </button>
          </div>
        </Card>
      </Col>
      
      <Col :xs="formColxs" :sm="formColsm" :lg="formCollg"
        v-show="!typeSelected || resource.type === 'CODE'">
        <Card class="content-type-card" @click.native="selectResourceType('CODE')">
          
          <p slot="title">
            Nuevo Snippet de Codigo
          </p>
          
          <div v-show="!typeSelected">
            <Icon type="code" size="64"></Icon>
          </div>
          
          <div class="content" v-if="resource.type === 'CODE'">
            
            <Form :model="resource" label-position="top">
              <Form-item label="Titulo">
                <Input v-model="resource.title" placeholder="De que se trata"></Input>
              </Form-item>
            </Form>
            
            <code-editor></code-editor>
            
            <button class="ivu-btn" @click="resetForm">
              Cancelar
            </button>
            
            <button class="ivu-btn ivu-btn-primary" @click="addResource">
              Guardar
            </button>
          </div>
        </Card>
      </Col>
    </Row>    
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
        this.$Notice.success({
          title: 'Todo salio bien!',
          desc: 'El recurso se ha creado con exito',
        });
      });
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
  transition: all .5s
}
.content {
  text-align: left;
}

.content.link {
  max-width: 400px;
  margin: 0 auto;
}
</style>
