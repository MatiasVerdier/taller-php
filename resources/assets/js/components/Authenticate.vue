<template lang="html">
  <div class="Authenticate">
    <el-card class="login-card">
      <h2 slot="header">Entrar al sitio</h2>
      <form @submit.prevent="login">
        <div class="input-field">
          <el-alert
            v-show="loginError"
            :title="errorTitle"
            type="error"
            :description="errorDescription"
            show-icon
            :closable="true">
          </el-alert>
        </div>
          
        <div v-if="!form.isLogin" class="input-field">
          <el-input v-if="!form.isLogin" size="large" v-model="form.username" placeholder="Tu nombre de usuario único"></el-input>
        </div>
        
        <div class="input-field">
          <el-input size="large" v-model="form.email" required placeholder="Tu dirección de correo"></el-input>
        </div>
        
        <div class="input-field">
          <el-input type="password" size="large" v-model="form.password" required placeholder="Tu contraseña super secreta" @keyup.enter=""></el-input>
        </div>
        
        <el-row type="flex" justify="center">
          <button type="submit" v-bind:class="{ 'is-loading': isLoading}" class="el-button el-button--primary">
            <i v-show="isLoading" class="el-icon-loading"></i>
            {{buttonText}}
          </button>
        </el-row>
        
        <el-row type="flex" justify="center">
          <div class="form-links">
            <a href="#" @click.prevent="form.isLogin = false" v-if="form.isLogin">No tienes cuenta?</a>
            <a href="#" @click.prevent="form.isLogin = true" v-else="form.isLogin">Ya tienes cuenta?</a>
          </div>
        </el-row>
      </form>
    </el-card>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
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
      if (this.isLoading) {
        return 'Cargando';
      }
      return this.form.isLogin ? 'Entrar' : 'Crear cuenta';
    },
    errorTitle() {
      return this.form.isLogin ? 'Error de autenticacion' : 'Error al registrarse';
    },
    errorDescription() {
      const error = this.loginError ? this.loginError.error : '';
      let errorMessage = '';
      
      if (error === 'invalid_credentials') {
        errorMessage = 'El email y/o la contraseña son incorrectos';
      }
      
      return errorMessage;
    },
    ...mapGetters(['isLoading', 'loginError']),
  },
  methods: {
    login() {
      if (this.form.email === '' || this.form.password === '') return;
      if (!this.form.isLogin && this.form.username === '') return;
      
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
.input-field {
  margin-bottom: 20px;
}
.form-links {
  margin-top: 20px;
}
</style>
