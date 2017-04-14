import axios from 'axios';

const API_ROOT = '/api';

axios.defaults.baseURL = API_ROOT;
axios.defaults.headers.common = {
  'X-CSRF-TOKEN': window.Laravel.csrfToken,
  'X-Requested-With': 'XMLHttpRequest',
};

// Add Authorization header to all requests
axios.interceptors.request.use((config) => {
  config.headers.Authorization = `Bearer ${localStorage.getItem('token')}`; // eslint-disable-line
  return config;
}, error => Promise.reject(error));

// Authentication
const login = data => axios.post('/login', data);
const register = data => axios.post('/register', data);
const logout = () => axios.post('/logout');
const getUser = () => axios.get('/me');

// Resources
const addResource = data => axios.post('/resources', data);

export default {
  login,
  register,
  logout,
  getUser,
  addResource,
};
