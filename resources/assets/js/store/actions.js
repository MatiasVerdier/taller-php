import * as types from './mutation-types';
import api from '../api';

export const login = ({ commit }, credentials) => {
  commit(types.LOGIN);
  return api.login(credentials);
};

export const logout = ({ commit }) => {
  localStorage.removeItem('token');
  commit(types.LOGOUT);
};
