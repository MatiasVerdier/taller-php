import Vue from 'vue';
import Vuex from 'vuex';
import * as actions from './actions';
import * as getters from './getters';
import mutations from './mutations';

Vue.use(Vuex);

const store = new Vuex.Store({
  state: {
    isAuthenticated: !!localStorage.getItem('token'),
    currentUser: JSON.parse(localStorage.getItem('currentUser')),
    resources: [],
    myResources: [],
  },
  actions,
  getters,
  mutations,
});

export default store;
