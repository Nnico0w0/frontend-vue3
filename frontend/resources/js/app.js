import { createApp } from 'vue'

const app = createApp({
  data() {
    return {
      message: '¡Vue está funcionando!',
      products: []
    }
  },
  async mounted() {
    console.log('Vue app montada correctamente')
    try {
      const response = await fetch('/api/products')
      const data = await response.json()
      this.products = data.data || data
      console.log('Productos cargados:', this.products)
    } catch (error) {
      console.error('Error cargando productos:', error)
    }
  },
  template: `
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
      <!-- Navigation -->
      <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-4">
          <h1 class="text-2xl font-bold text-teal-600">HostPro</h1>
        </div>
      </nav>

      <!-- Content -->
      <div class="max-w-7xl mx-auto px-4 py-20 text-center">
        <h1 class="text-5xl font-bold text-slate-900 mb-6">{{ message }}</h1>
        
        <div v-if="products.length === 0" class="text-gray-600">
          Cargando productos...
        </div>
        
        <div v-else>
          <h2 class="text-3xl font-bold text-slate-900 mb-8">Productos Disponibles</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div v-for="product in products" :key="product.id" 
                 class="bg-white rounded-lg shadow-lg p-6">
              <h3 class="text-xl font-bold text-slate-900 mb-2">{{ product.name }}</h3>
              <p class="text-2xl font-bold text-teal-600">\${{ product.price }}/mes</p>
              <p class="text-gray-600 mt-4">{{ product.description }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  `
})

app.mount('#app')
