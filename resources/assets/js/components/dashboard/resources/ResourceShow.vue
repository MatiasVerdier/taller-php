<template lang="html">
  <div class="resource-details">
    <router-link to="/dashboard">Volver</router-link>
    
    <h1 class="title">{{ currentResource.title }}</h1>
    
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
    ...mapGetters(['currentResource']),
  },
  methods: {
    ...mapActions(['getResource']),
  },
};
</script>

<style lang="scss" scoped>
.resource-details {
  padding: 20px;
  
  .title {
    font-size: 2em;
  }
}
</style>
