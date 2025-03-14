<template>
  <div>
    <h1>Login</h1>
    <form @submit.prevent="login">
      <input type="email" v-model="email" placeholder="Email" required />
      <input type="password" v-model="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>
    <p v-if="error" style="color:red">{{ error }}</p>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      email: '',
      password: '',
      error: ''
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post('/login', {
        email: this.email,
        password: this.password
        }, {
        withCredentials: true  // Important!
        });

        localStorage.setItem('token', response.data.token);
        this.$router.push('/dashboard');  // Redirect to dashboard after login
      } catch (err) {
        this.error = 'Invalid credentials';
      }
    }
  }
};
</script>
