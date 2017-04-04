import * as types from './mutation-types';
import api from '../api';

export const login = ({ commit }, credentials) => {
  commit(types.LOGIN);
  return api.login(credentials);
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
