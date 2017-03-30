import axios from 'axios';

const API_ROOT = '/api';

axios.defaults.baseURL = API_ROOT;

const login = data => axios.post('/login', data);
const register = data => axios.post('/register', data);
const logout = () => axios.post('/logout');

export default {
  login,
  register,
  logout,
};
