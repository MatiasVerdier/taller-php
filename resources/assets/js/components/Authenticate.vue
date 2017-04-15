<template lang="html">
  <div class="Authenticate">
    <el-card class="login-card">
      <h2 slot="header">Entrar al sitio</h2>
      <el-form :model="form">
          
        <el-form-item label="Nombre de usuario" v-if="!form.isLogin">
          <el-input size="large" v-model="form.username" placeholder="Tu nombre de usuario único"></el-input>
        </el-form-item>
        
        <el-form-item label="Email">
          <el-input size="large" v-model="form.email" placeholder="Tu dirección de correo"></el-input>
        </el-form-item>
        
        <el-form-item label="Contraseña">
          <el-input type="password" size="large" v-model="form.password" placeholder="Tu contraseña super secreta"></el-input>
        </el-form-item>
        
        <el-row type="flex" justify="center">
          <div>
            <a href="#" @click.prevent="form.isLogin = false" v-if="form.isLogin">No tienes cuenta?</a>
            <a href="#" @click.prevent="form.isLogin = true" v-else="form.isLogin">Ya tienes cuenta?</a>
          </div>
        </el-row>
        <el-row type="flex" justify="center">
          <el-button type="primary" @click="login">
            {{buttonText}}
          </el-button>
        </el-row>
      </el-form>
    </el-card>
  </div>
</template>

<script>
import * as types from '../store/mutation-types';

export default {
  data() {
    return {
      form: {
        username: '',
        email: '',
        password: '',
        isLogin: true,
      },
    };
  },
  computed: {
    buttonText() {
      return this.form.isLogin ? 'Entrar' : 'Crear cuenta';
    },
  },
  methods: {
    login() {
      this.$store.dispatch('login', {
        username: this.form.username,
        email: this.form.email,
        password: this.form.password,
        isLogin: this.form.isLogin,
      })
      .then(({ data }) => {
        this.$store.commit(types.LOGIN_SUCCESS);
        localStorage.setItem('token', data);
        this.$router.push({ name: 'dashboard' });
        
        this.$store.dispatch('getUser').then((response) => {
          const user = response.data;
          this.$store.commit(types.GET_USER_SUCCESS, { user });
          localStorage.setItem('currentUser', JSON.stringify(user));
        });
      })
      .catch(error => this.$store.commit(types.LOGIN_FAILURE, error.response));
    },
  },
};
</script>

<style scoped>
.login-card {
  max-width: 350px;
  margin: 100px auto;
}
</style>
