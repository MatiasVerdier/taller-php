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
          <el-dropdown trigger="click" @command="dropdownSelect">
            <div class="el-menu-item">
              <img class="user-avatar" src="https://avatars0.githubusercontent.com/u/5176883?v=3&s=40">
              <span class="user-name">{{ currentUser.username }}</span>
            </div>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item command="dashboard">
                <i class="fa fa-dashboard"></i>
                Dashboard
              </el-dropdown-item>
              <el-dropdown-item>Action 2</el-dropdown-item>
              <el-dropdown-item>Action 3</el-dropdown-item>
              <el-dropdown-item>Action 4</el-dropdown-item>
              <el-dropdown-item divided command="logout">
                Logout</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>

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
      } else {
        this.$router.push({ name: command });
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
.user-avatar {
  vertical-align: middle;
  border-radius: 50%;
  width: 30px;
  margin: 0 10px;
}
.user-name {
  display: inline-block;
}
</style>
