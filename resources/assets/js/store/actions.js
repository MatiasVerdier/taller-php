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
  
  return new Promise((resolve, reject) => {
    api.addResource(payload)
      .then((response) => {
        commit(types.ADD_RESOURCE_SUCCESS, response.data);
        resolve(response);
      })
      .catch((error) => {
        commit(types.ADD_RESOURCE_FAILURE, error.response);
        reject(error);
      });
  });
};

export const getMyResources = ({ commit }, payload) => {
  commit(types.GET_MY_RESOURCES);
  
  return new Promise((resolve, reject) => {
    api.getMyResources(payload)
      .then((response) => {
        commit(types.GET_MY_RESOURCES_SUCCESS, response.data);
        resolve(response);
      })
      .catch((error) => {
        commit(types.GET_MY_RESOURCES_FAILURE, error.response);
        reject(error);
      });
  });
};

export const getResource = ({ commit }, payload) => {
  commit(types.GET_RESOURCE);
  
  return api.getResource(payload)
    .then((response) => {
      commit(types.GET_RESOURCE_SUCCESS, response.data);
    })
    .catch((error) => {
      commit(types.GET_RESOURCE_FAILURE, error.response);
    });
};

export const unauthenticated = ({ commit }) => {
  commit(types.UNAUTHENTICATED);
};
