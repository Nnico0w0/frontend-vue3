<template>
  <footer class="bg-gray-900 text-gray-300 py-12 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- Company Info -->
        <div>
          <div class="flex items-center space-x-2 mb-4">
            <div class="bg-gradient-to-r from-cyan-500 to-blue-600 p-2 rounded-lg">
              <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2zm0 6a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z"/>
              </svg>
            </div>
            <span class="text-xl font-bold text-white">SBuild</span>
          </div>
          <p class="text-sm">
            Hosting de servidores de juegos confiable y de alto rendimiento para tu comunidad.
          </p>
        </div>
        
        <!-- Quick Links -->
        <div>
          <h3 class="text-white font-semibold mb-4">Enlaces Rápidos</h3>
          <ul class="space-y-2 text-sm">
            <li>
              <router-link to="/" class="hover:text-cyan-400 transition">
                Inicio
              </router-link>
            </li>
            <li>
              <a href="#features" class="hover:text-cyan-400 transition">
                Características
              </a>
            </li>
            <li>
              <a href="#plans" class="hover:text-cyan-400 transition">
                Planes
              </a>
            </li>
          </ul>
        </div>
        
        <!-- Support -->
        <div>
          <h3 class="text-white font-semibold mb-4">Soporte</h3>
          <ul class="space-y-2 text-sm">
            <li>
              <a href="#" class="hover:text-cyan-400 transition">
                Centro de Ayuda
              </a>
            </li>
            <li>
              <a href="#" class="hover:text-cyan-400 transition">
                Documentación
              </a>
            </li>
            <li>
              <a href="#" class="hover:text-cyan-400 transition">
                Contacto
              </a>
            </li>
            <li>
              <a href="#" class="hover:text-cyan-400 transition">
                Estado del Sistema
              </a>
            </li>
          </ul>
        </div>
        
        <!-- Legal -->
        <div>
          <h3 class="text-white font-semibold mb-4">Legal</h3>
          <ul class="space-y-2 text-sm">
            <li>
              <a href="#" class="hover:text-cyan-400 transition">
                Términos de Servicio
              </a>
            </li>
            <li>
              <a href="#" class="hover:text-cyan-400 transition">
                Política de Privacidad
              </a>
            </li>
            <li>
              <a href="#" class="hover:text-cyan-400 transition">
                Política de Reembolso
              </a>
            </li>
          </ul>
        </div>
      </div>
      
      <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm">
        <p>&copy; {{ currentYear }} SBuild. Todos los derechos reservados.</p>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'Footer',
  computed: {
    currentYear() {
      return new Date().getFullYear()
    }
  }
}
</script>
