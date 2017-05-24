<template>
  <div class="markdown-editor">
    <div v-show="isEditing">
      <textarea ref="area"></textarea>
    </div>
    <div class="editor-preview visible" v-bind:class="{ small: isSmall }" v-show="!isEditing" v-html="compiledMarkdown"></div>
  </div>
</template>

<script>
import Simplemde from 'simplemde';
import marked from 'marked';

export default {
  props: {
    value: {
      required: true,
    },
    isEditing: {
      type: Boolean,
      default: true,
    },
    isSmall: {
      type: Boolean,
      default: false,
    },
  },
  computed: {
    compiledMarkdown() {
      return marked(this.value, { sanitize: true });
    },
  },
  mounted() {
    this.mde = new Simplemde({
      element: this.$refs.area,
      spellChecker: false,
      placeholder: 'Escribe aquí...',
    });
    
    this.mde.value(this.value);
    
    this.mde.codemirror.on('change', () => {
      this.$emit('input', this.mde.value());
    });
  },
  beforeDestroy() {
    this.mde.toTextArea();
  },
};
</script>

<style lang="css">
@import 'https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css';
.editor-toolbar.fullscreen {
  top: 60px;
  z-index: 10;
}
.CodeMirror-fullscreen {
  top: 110px;
}
.editor-preview.visible {
  display: block;
  position: relative;
}
</style>
