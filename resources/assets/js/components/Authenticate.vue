<template lang="html">
  <div class="Authenticate">
    <form class="form-signin" @submit.prevent="login">
        <h2 class="form-signin-heading">Entrar al sitio</h2>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus v-model="email">
        
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required v-model="password">
        
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Recordarme
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      </form>
  </div>
</template>

<script>
import * as types from '../store/mutation-types';

export default {
  data() {
    return {
      email: '',
      password: '',
    };
  },
  methods: {
    login() {
      this.$store.dispatch('login', {
        email: this.email,
        password: this.password,
      })
      .then(({ data }) => {
        this.$store.commit(types.LOGIN_SUCCESS);
        localStorage.setItem('token', data);
        this.$router.push({ path: '/' });
        
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

<style lang="css">
.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>
