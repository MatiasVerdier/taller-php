import Vue from 'vue';
import * as types from './mutation-types';

const mutations = {
  [types.LOGIN](state) {
    Vue.set(state, 'loading', true);
  },
  [types.LOGIN_SUCCESS](state) {
    Vue.set(state, 'loading', false);
    Vue.set(state, 'isAuthenticated', true);
  },
  [types.LOGOUT](state) {
    Vue.set(state, 'isAuthenticated', false);
    Vue.set(state, 'currentUser', null);
  },
  [types.LOGIN_FAILURE](state, { data }) {
    Vue.set(state, 'loading', false);
    Vue.set(state, 'loginError', data);
  },
  [types.GET_USER](state) {
    Vue.set(state, 'loading', true);
  },
  [types.GET_USER_SUCCESS](state, { user }) {
    Vue.set(state, 'loading', false);
    Vue.set(state, 'currentUser', user);
  },
  
  [types.ADD_RESOURCE](state) {
    Vue.set(state, 'loading', true);
  },
  
  [types.ADD_RESOURCE_SUCCESS](state, resource) {
    state.resources.push(resource);
    Vue.set(state, 'loading', false);
  },
  
  [types.ADD_RESOURCE_FAILURE](state, { data }) {
    Vue.set(state, 'loading', false);
    Vue.set(state, 'resourceError', data);
  },
};

export default mutations;
