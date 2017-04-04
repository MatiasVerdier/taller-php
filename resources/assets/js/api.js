import axios from 'axios';

const API_ROOT = '/api';

axios.defaults.baseURL = API_ROOT;

const login = data => axios.post('/login', data);
const register = data => axios.post('/register', data);
const logout = () => axios.post('/logout');
const getUser = () => axios.get('/me', {
  headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
});

export default {
  login,
  register,
  logout,
  getUser,
};
