<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-md">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
          <div class="flex items-center">
            <h1 class="text-2xl font-bold text-teal-600">HostPro</h1>
          </div>
          
          <div class="flex items-center space-x-4">
            <a href="#" class="text-gray-700 hover:text-teal-600 font-medium">Iniciar Sesión</a>
            <a href="#" class="bg-teal-600 text-white px-4 py-2 rounded-lg hover:bg-teal-700 transition">Registrarse</a>
          </div>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="py-20 px-4">
      <div class="max-w-7xl mx-auto text-center">
        <h1 class="text-5xl font-bold text-slate-900 mb-6">
          Hosting Web de Alto Rendimiento
        </h1>
        <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
          Potencia tu sitio web con nuestros planes de hosting optimizados. 
          Velocidad, seguridad y soporte 24/7 garantizados.
        </p>
        
        <div class="flex justify-center space-x-4 mb-12">
          <button class="bg-teal-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-teal-700 transition">
            Ver Planes
          </button>
          <button class="border-2 border-teal-600 text-teal-600 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-teal-50 transition">
            Prueba Gratis
          </button>
        </div>
      </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-white py-16">
      <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
          <div>
            <div class="text-4xl font-bold text-teal-600 mb-2">99.9%</div>
            <div class="text-gray-600">Uptime Garantizado</div>
          </div>
          <div>
            <div class="text-4xl font-bold text-teal-600 mb-2">50K+</div>
            <div class="text-gray-600">Sitios Activos</div>
          </div>
          <div>
            <div class="text-4xl font-bold text-teal-600 mb-2">24/7</div>
            <div class="text-gray-600">Soporte Técnico</div>
          </div>
          <div>
            <div class="text-4xl font-bold text-teal-600 mb-2">< 200ms</div>
            <div class="text-gray-600">Tiempo de Respuesta</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Products Loading -->
    <section class="py-20 px-4">
      <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold text-slate-900 mb-4">
            Planes de Hosting
          </h2>
          <p class="text-xl text-gray-600">
            Elige el plan perfecto para tu proyecto
          </p>
        </div>

        <div v-if="loading" class="flex justify-center">
          <div class="animate-spin rounded-full h-32 w-32 border-b-2 border-teal-600"></div>
        </div>

        <div v-else-if="error" class="text-center">
          <p class="text-red-600">{{ error }}</p>
          <button @click="loadProducts" class="mt-4 bg-teal-600 text-white px-4 py-2 rounded">
            Reintentar
          </button>
        </div>

        <div v-else class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div 
            v-for="product in hostingProducts" 
            :key="product.id"
            class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition transform hover:scale-105"
            :class="{ 'ring-4 ring-teal-600 scale-105': product.name.includes('Profesional') }"
          >
            <div v-if="product.name.includes('Profesional')" class="text-center mb-4">
              <span class="bg-teal-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                Más Popular
              </span>
            </div>
            
            <div class="text-center">
              <h3 class="text-2xl font-bold text-slate-900 mb-2">{{ product.name }}</h3>
              <div class="mb-6">
                <span class="text-4xl font-bold text-teal-600">${{ product.price }}</span>
                <span class="text-gray-500">/mes</span>
              </div>
              
              <p class="text-gray-600 mb-8">{{ product.description }}</p>
              
              <button 
                class="w-full py-3 px-6 rounded-lg font-semibold transition"
                :class="product.name.includes('Profesional') 
                  ? 'bg-teal-600 text-white hover:bg-teal-700' 
                  : 'border-2 border-teal-600 text-teal-600 hover:bg-teal-50'"
              >
                Elegir Plan
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Home',
  data() {
    return {
      products: [],
      loading: true,
      error: null
    };
  },
  computed: {
    hostingProducts() {
      return this.products.filter(product => product.category === 'Hosting');
    }
  },
  async mounted() {
    await this.loadProducts();
  },
  methods: {
    async loadProducts() {
      this.loading = true;
      this.error = null;
      
      try {
        console.log('Cargando productos...');
        const response = await axios.get('/api/products');
        console.log('Respuesta API:', response.data);
        
        this.products = response.data.data || response.data;
        console.log('Productos cargados:', this.products);
      } catch (error) {
        console.error('Error loading products:', error);
        this.error = 'Error al cargar los productos. Inténtalo de nuevo.';
        this.products = [];
      } finally {
        this.loading = false;
      }
    }
  }
};
</script>