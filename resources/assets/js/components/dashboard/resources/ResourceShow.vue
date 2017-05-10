<template lang="html">
  <div>
    <h1>{{ id }}</h1>
  </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
  mounted() {
    this.getResource(this.id);
  },
  props: {
    id: {
      required: true,
    },
  },
  methods: {
    ...mapActions(['getResource']),
  },
};
</script>

<style lang="scss">
</style>
