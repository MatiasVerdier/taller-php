/* global window */
import Vue from 'vue';
import axios from 'axios';

axios.defaults.headers.common = {
  'X-CSRF-TOKEN': window.Laravel.csrfToken,
  'X-Requested-With': 'XMLHttpRequest',
};

/* eslint no-new: "off" */
new Vue({
  el: '#app',
});
