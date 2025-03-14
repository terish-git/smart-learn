import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import axios from 'axios';

axios.defaults.baseURL = 'http://127.0.0.1:8000/api';  // Laravel API base URL
axios.defaults.withCredentials = true;  // Allow sending cookies for authentication

// 🔹 Automatically attach the token to every request
axios.interceptors.request.use(
    config => {
      const token = localStorage.getItem('token');  // Get token from storage
      if (token) {
        config.headers.Authorization = `Bearer ${token}`;
      }
      return config;
    },
    error => Promise.reject(error)
  );


const app = createApp(App);
app.use(router);
app.config.globalProperties.$axios = axios;  // Make Axios globally available
app.mount('#app');
