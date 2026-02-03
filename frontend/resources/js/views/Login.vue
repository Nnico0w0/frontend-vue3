<template>
  <div class="min-h-screen flex flex-col bg-gray-50">
    <Navbar />
    
    <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-md w-full space-y-8">
        <div>
          <div class="flex justify-center">
            <div class="bg-gradient-to-r from-cyan-500 to-blue-600 p-3 rounded-xl">
              <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2zm0 6a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z"/>
              </svg>
            </div>
          </div>
          <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Iniciar Sesión en SBuild
          </h2>
          <p class="mt-2 text-center text-sm text-gray-600">
            O
            <router-link to="/register" class="font-medium text-cyan-600 hover:text-cyan-500">
              crea una cuenta nueva
            </router-link>
          </p>
        </div>
        
        <div class="bg-white shadow-xl rounded-lg p-8">
          <form @submit.prevent="handleLogin" class="space-y-6">
            <!-- Email -->
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700">
                Email
              </label>
              <div class="mt-1">
                <input
                  id="email"
                  v-model="form.email"
                  type="email"
                  required
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-cyan-500 focus:border-cyan-500"
                  placeholder="tu@email.com"
                />
              </div>
            </div>

            <!-- Password -->
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700">
                Contraseña
              </label>
              <div class="mt-1">
                <input
                  id="password"
                  v-model="form.password"
                  type="password"
                  required
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-cyan-500 focus:border-cyan-500"
                  placeholder="••••••••"
                />
              </div>
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <input
                  id="remember-me"
                  v-model="form.remember"
                  type="checkbox"
                  class="h-4 w-4 text-cyan-600 focus:ring-cyan-500 border-gray-300 rounded"
                />
                <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                  Recordarme
                </label>
              </div>

              <div class="text-sm">
                <a href="#" class="font-medium text-cyan-600 hover:text-cyan-500">
                  ¿Olvidaste tu contraseña?
                </a>
              </div>
            </div>

            <!-- Error Message -->
            <div v-if="error" class="rounded-lg bg-red-50 p-4">
              <div class="flex">
                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/>
                </svg>
                <p class="ml-3 text-sm text-red-700">{{ error }}</p>
              </div>
            </div>

            <!-- Submit Button -->
            <div>
              <button
                type="submit"
                :disabled="loading"
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 disabled:opacity-50 disabled:cursor-not-allowed"
              >
                <span v-if="!loading">Iniciar Sesión</span>
                <span v-else class="flex items-center">
                  <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  Iniciando sesión...
                </span>
              </button>
            </div>
          </form>

          <!-- Demo Credentials -->
          <div class="mt-6 border-t border-gray-200 pt-6">
            <p class="text-xs text-center text-gray-500 mb-4">
              Para pruebas, usa estas credenciales de demostración:
            </p>
            <div class="grid grid-cols-2 gap-4 text-xs">
              <div class="bg-gray-50 rounded p-3">
                <p class="font-semibold text-gray-700 mb-1">Usuario:</p>
                <p class="text-gray-600">user@sbuild.com</p>
                <p class="text-gray-600">password123</p>
              </div>
              <div class="bg-cyan-50 rounded p-3">
                <p class="font-semibold text-cyan-700 mb-1">Admin:</p>
                <p class="text-cyan-600">admin@sbuild.com</p>
                <p class="text-cyan-600">admin123</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    
    <Footer />
  </div>
</template>

<script>
import Navbar from '../components/layout/Navbar.vue'
import Footer from '../components/layout/Footer.vue'
import axios from 'axios'

export default {
  name: 'Login',
  components: {
    Navbar,
    Footer
  },
  data() {
    return {
      form: {
        email: '',
        password: '',
        remember: false
      },
      loading: false,
      error: null
    }
  },
  methods: {
    async handleLogin() {
      this.loading = true
      this.error = null
      
      try {
        // For demo purposes, simulate authentication
        // In production, replace with actual API call
        // const response = await axios.post('/api/auth/login', this.form)
        
        // Demo authentication logic
        if (this.form.email === 'admin@sbuild.com' && this.form.password === 'admin123') {
          // Admin login
          localStorage.setItem('token', 'demo-admin-token')
          localStorage.setItem('role', 'admin')
          localStorage.setItem('user', JSON.stringify({
            name: 'Admin User',
            email: this.form.email
          }))
          this.$router.push('/admin/dashboard')
        } else if (this.form.email === 'user@sbuild.com' && this.form.password === 'password123') {
          // User login
          localStorage.setItem('token', 'demo-user-token')
          localStorage.setItem('role', 'user')
          localStorage.setItem('user', JSON.stringify({
            name: 'Demo User',
            email: this.form.email
          }))
          this.$router.push('/dashboard')
        } else {
          this.error = 'Credenciales inválidas. Por favor, verifica tu email y contraseña.'
        }
      } catch (err) {
        console.error('Login error:', err)
        this.error = 'Error al iniciar sesión. Por favor, intenta de nuevo.'
      } finally {
        this.loading = false
      }
    }
  }
}
</script>
