<template>
  <nav class="bg-gray-900 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center py-4">
        <!-- Logo -->
        <router-link to="/" class="flex items-center space-x-2">
          <div class="bg-gradient-to-r from-cyan-500 to-blue-600 p-2 rounded-lg">
            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
              <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2zm0 6a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z"/>
            </svg>
          </div>
          <span class="text-2xl font-bold text-white">SBuild</span>
        </router-link>
        
        <!-- Navigation Links -->
        <div class="hidden md:flex items-center space-x-8">
          <router-link to="/" class="text-gray-300 hover:text-white transition">
            Inicio
          </router-link>
          <a href="#features" class="text-gray-300 hover:text-white transition">
            Características
          </a>
          <a href="#plans" class="text-gray-300 hover:text-white transition">
            Planes
          </a>
        </div>
        
        <!-- Auth Buttons -->
        <div v-if="!isAuthenticated" class="flex items-center space-x-4">
          <router-link 
            to="/login" 
            class="text-gray-300 hover:text-white font-medium transition"
          >
            Iniciar Sesión
          </router-link>
          <router-link 
            to="/register" 
            class="bg-gradient-to-r from-cyan-500 to-blue-600 text-white px-6 py-2 rounded-lg hover:from-cyan-600 hover:to-blue-700 transition font-medium"
          >
            Registrarse
          </router-link>
        </div>
        
        <!-- User Menu -->
        <div v-else class="flex items-center space-x-4">
          <router-link 
            :to="userRole === 'admin' ? '/admin/dashboard' : '/dashboard'" 
            class="text-gray-300 hover:text-white transition"
          >
            Dashboard
          </router-link>
          <button 
            @click="logout"
            class="text-gray-300 hover:text-red-400 transition"
          >
            Cerrar Sesión
          </button>
        </div>
        
        <!-- Mobile Menu Button -->
        <button 
          @click="toggleMobileMenu" 
          class="md:hidden text-gray-300 hover:text-white"
        >
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
      </div>
      
      <!-- Mobile Menu -->
      <div v-if="mobileMenuOpen" class="md:hidden py-4 border-t border-gray-800">
        <div class="flex flex-col space-y-4">
          <router-link to="/" class="text-gray-300 hover:text-white transition">
            Inicio
          </router-link>
          <a href="#features" class="text-gray-300 hover:text-white transition">
            Características
          </a>
          <a href="#plans" class="text-gray-300 hover:text-white transition">
            Planes
          </a>
          <template v-if="!isAuthenticated">
            <router-link to="/login" class="text-gray-300 hover:text-white transition">
              Iniciar Sesión
            </router-link>
            <router-link to="/register" class="text-cyan-400 hover:text-cyan-300 transition">
              Registrarse
            </router-link>
          </template>
          <template v-else>
            <router-link 
              :to="userRole === 'admin' ? '/admin/dashboard' : '/dashboard'" 
              class="text-gray-300 hover:text-white transition"
            >
              Dashboard
            </router-link>
            <button 
              @click="logout"
              class="text-left text-gray-300 hover:text-red-400 transition"
            >
              Cerrar Sesión
            </button>
          </template>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'Navbar',
  data() {
    return {
      mobileMenuOpen: false
    }
  },
  computed: {
    isAuthenticated() {
      return !!localStorage.getItem('token')
    },
    userRole() {
      return localStorage.getItem('role') || 'user'
    }
  },
  methods: {
    toggleMobileMenu() {
      this.mobileMenuOpen = !this.mobileMenuOpen
    },
    logout() {
      localStorage.removeItem('token')
      localStorage.removeItem('role')
      this.$router.push('/login')
    }
  }
}
</script>
