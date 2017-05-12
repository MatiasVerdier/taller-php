<template>
  <textarea ref="area"></textarea>
</template>

<script>
import Simplemde from 'simplemde';

export default {
  props: {
    value: {
      required: true,
    },
    isEditing: {
      type: Boolean,
      default: true,
    },
  },
  mounted() {
    this.mde = new Simplemde({
      element: this.$refs.area,
      toolbar: this.isEditing,
    });
    
    this.mde.value(this.value);
    
    if (!this.isEditing) {
      this.mde.togglePreview();
    }
    
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
</style>
