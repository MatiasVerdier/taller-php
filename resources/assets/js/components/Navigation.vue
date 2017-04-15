<template lang="html">
  <nav class="main-navigation" role="navigation">
    <el-menu mode="horizontal" theme="dark" :default-active="activeRoute" @select="onMenuSelect">
      <div class="left-menu">
        <el-menu-item index="home">
          Home
        </el-menu-item>
        
        <el-menu-item index="explore">
          Explorar
        </el-menu-item>
      </div>
      
      <div class="right-menu">
        <template v-if="isAuthenticated">
          <el-menu-item index="dashboard">
            Dashboard
          </el-menu-item>
          
          <el-menu-item index="logout">
            Logout
          </el-menu-item>
        </template>
        <el-menu-item v-else index="login">
          Login
        </el-menu-item>
      </div>
    </el-menu>
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
  z-index: 100;
}
.right-menu {
  float: right;
}
</style>
