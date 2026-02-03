<template>
  <div class="min-h-screen flex flex-col bg-gray-50">
    <Navbar />
    
    <main class="flex-grow">
      <!-- Hero Section -->
      <section class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">
              Hosting de Servidores de Juegos
            </h1>
            <p class="text-xl md:text-2xl text-gray-300 mb-8 max-w-3xl mx-auto">
              Despliega tu servidor de juegos en segundos. Alto rendimiento, baja latencia y soporte 24/7.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4 mb-12">
              <router-link 
                to="/register" 
                class="bg-gradient-to-r from-cyan-500 to-blue-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:from-cyan-600 hover:to-blue-700 transition"
              >
                Comenzar Ahora
              </router-link>
              <a 
                href="#plans" 
                class="border-2 border-cyan-500 text-cyan-400 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-cyan-500 hover:text-white transition"
              >
                Ver Planes
              </a>
            </div>
            
            <!-- Game Icons -->
            <div class="flex justify-center space-x-8 text-gray-400">
              <div class="text-center">
                <div class="text-4xl mb-2">🎮</div>
                <p class="text-sm">Minecraft</p>
              </div>
              <div class="text-center">
                <div class="text-4xl mb-2">🔫</div>
                <p class="text-sm">CS:GO</p>
              </div>
              <div class="text-center">
                <div class="text-4xl mb-2">🦀</div>
                <p class="text-sm">Rust</p>
              </div>
              <div class="text-center">
                <div class="text-4xl mb-2">🏰</div>
                <p class="text-sm">ARK</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Stats Section -->
      <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
              <div class="text-4xl font-bold text-cyan-600 mb-2">99.9%</div>
              <div class="text-gray-600">Uptime</div>
            </div>
            <div>
              <div class="text-4xl font-bold text-cyan-600 mb-2">10K+</div>
              <div class="text-gray-600">Servidores Activos</div>
            </div>
            <div>
              <div class="text-4xl font-bold text-cyan-600 mb-2">24/7</div>
              <div class="text-gray-600">Soporte</div>
            </div>
            <div>
              <div class="text-4xl font-bold text-cyan-600 mb-2">&lt;20ms</div>
              <div class="text-gray-600">Latencia</div>
            </div>
          </div>
        </div>
      </section>

      <!-- Features Section -->
      <section id="features" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
              Características Principales
            </h2>
            <p class="text-xl text-gray-600">
              Todo lo que necesitas para ejecutar tu servidor de juegos
            </p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition">
              <div class="bg-gradient-to-br from-cyan-500 to-blue-600 w-16 h-16 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M13 7H7v6h6V7z"/>
                  <path fill-rule="evenodd" d="M7 2a1 1 0 012 0v1h2V2a1 1 0 112 0v1h2a2 2 0 012 2v2h1a1 1 0 110 2h-1v2h1a1 1 0 110 2h-1v2a2 2 0 01-2 2h-2v1a1 1 0 11-2 0v-1H9v1a1 1 0 11-2 0v-1H5a2 2 0 01-2-2v-2H2a1 1 0 110-2h1V9H2a1 1 0 010-2h1V5a2 2 0 012-2h2V2zM5 5h10v10H5V5z"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-2">Panel de Control Intuitivo</h3>
              <p class="text-gray-600">
                Gestiona tu servidor fácilmente con nuestro panel de control moderno y fácil de usar.
              </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition">
              <div class="bg-gradient-to-br from-cyan-500 to-blue-600 w-16 h-16 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-2">Despliegue Instantáneo</h3>
              <p class="text-gray-600">
                Tu servidor estará en línea en menos de 60 segundos. Sin complicaciones.
              </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition">
              <div class="bg-gradient-to-br from-cyan-500 to-blue-600 w-16 h-16 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-2">Soporte Experto</h3>
              <p class="text-gray-600">
                Nuestro equipo está disponible 24/7 para ayudarte con cualquier problema.
              </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition">
              <div class="bg-gradient-to-br from-cyan-500 to-blue-600 w-16 h-16 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-2">Protección DDoS</h3>
              <p class="text-gray-600">
                Mantén tu servidor seguro con nuestra protección DDoS de nivel empresarial.
              </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition">
              <div class="bg-gradient-to-br from-cyan-500 to-blue-600 w-16 h-16 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M3 12v3c0 1.657 3.134 3 7 3s7-1.343 7-3v-3c0 1.657-3.134 3-7 3s-7-1.343-7-3z"/>
                  <path d="M3 7v3c0 1.657 3.134 3 7 3s7-1.343 7-3V7c0 1.657-3.134 3-7 3S3 8.657 3 7z"/>
                  <path d="M17 5c0 1.657-3.134 3-7 3S3 6.657 3 5s3.134-3 7-3 7 1.343 7 3z"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-2">Backups Automáticos</h3>
              <p class="text-gray-600">
                Tus datos están seguros con backups automáticos diarios incluidos.
              </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition">
              <div class="bg-gradient-to-br from-cyan-500 to-blue-600 w-16 h-16 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11 4a1 1 0 10-2 0v4a1 1 0 102 0V7zm-3 1a1 1 0 10-2 0v3a1 1 0 102 0V8zM8 9a1 1 0 00-2 0v2a1 1 0 102 0V9z"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-2">Hardware Premium</h3>
              <p class="text-gray-600">
                Procesadores de última generación y NVMe SSD para el máximo rendimiento.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- Plans Section -->
      <section id="plans" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
              Planes de Hosting
            </h2>
            <p class="text-xl text-gray-600">
              Elige el plan perfecto para tu servidor
            </p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Starter Plan -->
            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition border-2 border-gray-200">
              <div class="text-center">
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Starter</h3>
                <div class="mb-6">
                  <span class="text-4xl font-bold text-cyan-600">$9.99</span>
                  <span class="text-gray-500">/mes</span>
                </div>
                
                <ul class="text-left space-y-3 mb-8">
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                    <span class="text-gray-600">2GB RAM</span>
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                    <span class="text-gray-600">20GB SSD NVMe</span>
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                    <span class="text-gray-600">Hasta 20 jugadores</span>
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                    <span class="text-gray-600">Backup diario</span>
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                    <span class="text-gray-600">Protección DDoS</span>
                  </li>
                </ul>
                
                <router-link 
                  to="/register"
                  class="block w-full py-3 px-6 rounded-lg font-semibold transition border-2 border-cyan-600 text-cyan-600 hover:bg-cyan-50"
                >
                  Elegir Plan
                </router-link>
              </div>
            </div>

            <!-- Pro Plan -->
            <div class="bg-gradient-to-br from-cyan-500 to-blue-600 rounded-2xl shadow-xl p-8 hover:shadow-2xl transition transform scale-105 relative">
              <div class="absolute top-0 right-0 bg-yellow-400 text-gray-900 px-4 py-1 rounded-bl-lg rounded-tr-lg font-semibold text-sm">
                Popular
              </div>
              <div class="text-center">
                <h3 class="text-2xl font-bold text-white mb-2">Pro</h3>
                <div class="mb-6">
                  <span class="text-4xl font-bold text-white">$19.99</span>
                  <span class="text-cyan-100">/mes</span>
                </div>
                
                <ul class="text-left space-y-3 mb-8">
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-yellow-300 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                    <span class="text-white">4GB RAM</span>
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-yellow-300 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                    <span class="text-white">50GB SSD NVMe</span>
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-yellow-300 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                    <span class="text-white">Hasta 50 jugadores</span>
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-yellow-300 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                    <span class="text-white">Backup cada 12h</span>
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-yellow-300 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                    <span class="text-white">Protección DDoS Premium</span>
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-yellow-300 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                    <span class="text-white">Soporte prioritario</span>
                  </li>
                </ul>
                
                <router-link 
                  to="/register"
                  class="block w-full py-3 px-6 rounded-lg font-semibold transition bg-white text-cyan-600 hover:bg-gray-100"
                >
                  Elegir Plan
                </router-link>
              </div>
            </div>

            <!-- Enterprise Plan -->
            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition border-2 border-gray-200">
              <div class="text-center">
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Enterprise</h3>
                <div class="mb-6">
                  <span class="text-4xl font-bold text-cyan-600">$39.99</span>
                  <span class="text-gray-500">/mes</span>
                </div>
                
                <ul class="text-left space-y-3 mb-8">
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                    <span class="text-gray-600">8GB RAM</span>
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                    <span class="text-gray-600">100GB SSD NVMe</span>
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                    <span class="text-gray-600">Jugadores ilimitados</span>
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                    <span class="text-gray-600">Backup en tiempo real</span>
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                    <span class="text-gray-600">Protección DDoS Enterprise</span>
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                    <span class="text-gray-600">IP dedicada</span>
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                    <span class="text-gray-600">Gestor de cuenta dedicado</span>
                  </li>
                </ul>
                
                <router-link 
                  to="/register"
                  class="block w-full py-3 px-6 rounded-lg font-semibold transition bg-gradient-to-r from-cyan-500 to-blue-600 text-white hover:from-cyan-600 hover:to-blue-700"
                >
                  Elegir Plan
                </router-link>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    
    <Footer />
  </div>
</template>

<script>
import Navbar from '../components/layout/Navbar.vue'
import Footer from '../components/layout/Footer.vue'

export default {
  name: 'Home',
  components: {
    Navbar,
    Footer
  }
}
</script>
