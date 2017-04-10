<template lang="html">
  <nav class="main-navigation" role="navigation">
    <Menu mode="horizontal" theme="dark" :active-name="activeRoute" @on-select="onMenuSelect">
      <div class="left-menu">
        <Menu-item name="home">
          <Icon type="home"></Icon>
          Home
        </Menu-item>
        
        <Menu-item name="explore">
          <Icon type="eye"></Icon>
          Explorar
        </Menu-item>
      </div>
      
      <div class="right-menu">
        <template v-if="isAuthenticated">
          <Menu-item name="dashboard">
            <Icon type="speedometer"></Icon>
            Dashboard
          </Menu-item>
          
          <Menu-item name="logout">
            Logout
          </Menu-item>
        </template>
        <Menu-item v-else name="login">
          Login
        </Menu-item>
      </div>
    </Menu>
  </nav>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';

export default {
  methods: {
    ...mapActions(['logout']),
    onMenuSelect(name) {
      if (name === 'logout') {
        this.logout();
      } else {
        this.$router.push({ name });
      }
    },
  },
  computed: {
    ...mapGetters(['isAuthenticated', 'currentUser']),
    activeRoute() {
      return this.$route.name;
    },
  },
};
</script>

<style scoped>
.main-navigation {
  position: fixed;
  width: 100%;
}
.right-menu {
  float: right;
}
</style>
