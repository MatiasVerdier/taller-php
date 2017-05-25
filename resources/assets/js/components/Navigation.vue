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
          <div v-if="currentUser" class="el-menu-item user-menu" @click="onMenuLogout">
            <gravatar :email="currentUser.email"></gravatar>
            <span class="user-name">{{ currentUser.username }}</span>
            
            <i class="fa fa-sign-out"></i>
          </div>
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
      this.$router.push({ name });
    },
    dropdownSelect(command) {
      if (command === 'logout') {
        this.logout();
        this.$router.push({ name: 'login' });
      } else {
        this.$router.push({ name: command });
      }
    },
    onMenuLogout() {
      this.logout();
      this.$router.push({ name: 'login' });
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
.el-menu-item:hover {
  border-bottom: 5px solid #20a0ff;
}
.main-navigation {
  position: fixed;
  width: 100%;
  z-index: 100;
}
.right-menu {
  float: right;
}
.user-menu {
  padding: 0;
  width: 200px;
}
.user-name {
  display: inline-block;
  margin-right: 20px;
}
</style>
