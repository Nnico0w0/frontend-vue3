<template>
  <div class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
      <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Admin Login</h2>
      
      <form @submit.prevent="handleLogin" v-if="!isLoading">
        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
            Email
          </label>
          <input
            type="email"
            id="email"
            v-model="form.email"
            required
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="admin@ecommerce.com"
          />
        </div>

        <div class="mb-6">
          <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
            Password
          </label>
          <input
            type="password"
            id="password"
            v-model="form.password"
            required
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="admin123"
          />
        </div>

        <button
          type="submit"
          class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
        >
          Login
        </button>
      </form>

      <div v-if="isLoading" class="text-center">
        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
        <p class="mt-2 text-gray-600">Logging in...</p>
      </div>

      <div v-if="error" class="mt-4 p-3 bg-red-100 border border-red-300 text-red-700 rounded-md">
        {{ error }}
      </div>

      <div v-if="success" class="mt-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded-md">
        {{ success }}
      </div>

      <!-- Demo credentials -->
      <div class="mt-6 p-3 bg-gray-50 rounded-md">
        <p class="text-sm text-gray-600 text-center">
          <strong>Demo Credentials:</strong><br>
          Email: admin@ecommerce.com<br>
          Password: admin123
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'LoginForm',
  data() {
    return {
      form: {
        email: 'admin@ecommerce.com',
        password: 'admin123'
      },
      isLoading: false,
      error: null,
      success: null
    }
  },
  methods: {
    async handleLogin() {
      this.isLoading = true
      this.error = null
      this.success = null

      try {
        const response = await axios.post('http://localhost:8000/api/login', {
          email: this.form.email,
          password: this.form.password
        })

        const { access_token, user } = response.data

        // Store token and user data
        localStorage.setItem('token', access_token)
        localStorage.setItem('user', JSON.stringify(user))

        // Set axios default header for future requests
        axios.defaults.headers.common['Authorization'] = `Bearer ${access_token}`

        this.success = `Welcome, ${user.name}! Redirecting to dashboard...`

        // Redirect to admin dashboard after 2 seconds
        setTimeout(() => {
          this.$emit('login-success', { user, token: access_token })
        }, 2000)

      } catch (error) {
        console.error('Login error:', error)
        
        if (error.response) {
          this.error = error.response.data.error || 'Login failed. Please check your credentials.'
        } else {
          this.error = 'Network error. Please check if the backend server is running.'
        }
      } finally {
        this.isLoading = false
      }
    }
  },
  mounted() {
    // Check if user is already logged in
    const token = localStorage.getItem('token')
    const user = localStorage.getItem('user')
    
    if (token && user) {
      try {
        const userData = JSON.parse(user)
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
        this.$emit('login-success', { user: userData, token })
      } catch (error) {
        // Invalid stored data, clear it
        localStorage.removeItem('token')
        localStorage.removeItem('user')
      }
    }
  }
}
</script>