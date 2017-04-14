import axios from 'axios';

const API_ROOT = '/api';

axios.defaults.baseURL = API_ROOT;
axios.defaults.headers.common = {
  'X-CSRF-TOKEN': window.Laravel.csrfToken,
  'X-Requested-With': 'XMLHttpRequest',
};

// Authentication
const login = data => axios.post('/login', data);
const register = data => axios.post('/register', data);
const logout = () => axios.post('/logout');
const getUser = () => axios.get('/me', {
  headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
});

// Resources
const addResource = data => axios.post('/resources', data, {
  headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
});

export default {
  login,
  register,
  logout,
  getUser,
  addResource,
};
