import * as types from './mutation-types';
import api from '../api';

export const login = ({ commit }, credentials) => {
  const { username, email, password, isLogin } = credentials;
  commit(types.LOGIN);
  
  return isLogin ? api.login({ email, password }) : api.register({ username, email, password });
};

export const logout = ({ commit }) => {
  localStorage.removeItem('token');
  localStorage.removeItem('currentUser');
  commit(types.LOGOUT);
};

export const getUser = ({ commit }) => {
  commit(types.GET_USER);
  return api.getUser();
};

export const addResource = ({ commit }, payload) => {
  commit(types.ADD_RESOURCE);
  
  api.addResource(payload)
    .then(({ data }) => {
      commit(types.ADD_RESOURCE_SUCCESS, data);
    })
    .catch(error => commit(types.ADD_RESOURCE_FAILURE, error.response));
};
