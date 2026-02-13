<template>
  <div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Admin Dashboard</h1>
        <div class="flex items-center space-x-4">
          <span class="text-gray-600">Welcome, {{ user.name }}</span>
          <button 
            @click="logout"
            class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-200"
          >
            Logout
          </button>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-6">
      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-sm">
          <h3 class="text-sm font-medium text-gray-500">Total Products</h3>
          <p class="text-3xl font-bold text-gray-900">{{ stats.total_products || 0 }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm">
          <h3 class="text-sm font-medium text-gray-500">Total Categories</h3>
          <p class="text-3xl font-bold text-gray-900">{{ stats.total_categories || 0 }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm">
          <h3 class="text-sm font-medium text-gray-500">Total Users</h3>
          <p class="text-3xl font-bold text-gray-900">{{ stats.total_users || 0 }}</p>
        </div>
      </div>

      <!-- Tabs -->
      <div class="mb-6">
        <nav class="flex space-x-1">
          <button
            v-for="tab in tabs"
            :key="tab.id"
            @click="activeTab = tab.id"
            :class="[
              'px-4 py-2 rounded-md font-medium transition duration-200',
              activeTab === tab.id 
                ? 'bg-blue-600 text-white' 
                : 'bg-white text-gray-700 hover:bg-gray-50'
            ]"
          >
            {{ tab.name }}
          </button>
        </nav>
      </div>

      <!-- Tab Content -->
      <div class="bg-white rounded-lg shadow-sm">
        <!-- Products Tab -->
        <div v-if="activeTab === 'products'" class="p-6">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800">Products Management</h2>
            <button
              @click="showAddProduct = true"
              class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-200"
            >
              Add Product
            </button>
          </div>

          <div v-if="isLoading" class="text-center py-8">
            <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
            <p class="mt-2 text-gray-600">Loading products...</p>
          </div>

          <div v-else>
            <div class="overflow-x-auto">
              <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">ID</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Name</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Price</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Category</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Stock</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Actions</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                  <tr v-for="product in products" :key="product.id">
                    <td class="px-4 py-2 text-sm text-gray-900">{{ product.id }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900">{{ product.name }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900">${{ product.price }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900">{{ product.category }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900">{{ product.stock }}</td>
                    <td class="px-4 py-2 text-sm space-x-2">
                      <button 
                        @click="editProduct(product)"
                        class="text-blue-600 hover:text-blue-800"
                      >
                        Edit
                      </button>
                      <button 
                        @click="deleteProduct(product.id)"
                        class="text-red-600 hover:text-red-800"
                      >
                        Delete
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Categories Tab -->
        <div v-if="activeTab === 'categories'" class="p-6">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800">Categories Management</h2>
            <button
              @click="showAddCategory = true"
              class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-200"
            >
              Add Category
            </button>
          </div>

          <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">ID</th>
                  <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Name</th>
                  <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Actions</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                <tr v-for="category in categories" :key="category.id">
                  <td class="px-4 py-2 text-sm text-gray-900">{{ category.id }}</td>
                  <td class="px-4 py-2 text-sm text-gray-900">{{ category.name }}</td>
                  <td class="px-4 py-2 text-sm space-x-2">
                    <button 
                      @click="editCategory(category)"
                      class="text-blue-600 hover:text-blue-800"
                    >
                      Edit
                    </button>
                    <button 
                      @click="deleteCategory(category.id)"
                      class="text-red-600 hover:text-red-800"
                    >
                      Delete
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>

    <!-- Error/Success Messages -->
    <div v-if="error" class="fixed bottom-4 right-4 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-md">
      {{ error }}
    </div>
    <div v-if="success" class="fixed bottom-4 right-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-md">
      {{ success }}
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'AdminDashboard',
  props: {
    user: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      activeTab: 'products',
      tabs: [
        { id: 'products', name: 'Products' },
        { id: 'categories', name: 'Categories' }
      ],
      stats: {},
      products: [],
      categories: [],
      isLoading: false,
      error: null,
      success: null,
      showAddProduct: false,
      showAddCategory: false
    }
  },
  async mounted() {
    await this.loadDashboardData()
  },
  methods: {
    async loadDashboardData() {
      this.isLoading = true
      try {
        // Load stats
        const statsResponse = await axios.get('http://localhost:8000/api/admin/dashboard')
        this.stats = statsResponse.data.stats

        // Load products
        const productsResponse = await axios.get('http://localhost:8000/api/admin/products')
        this.products = productsResponse.data

        // Load categories
        const categoriesResponse = await axios.get('http://localhost:8000/api/admin/categories')
        this.categories = categoriesResponse.data

      } catch (error) {
        console.error('Error loading dashboard data:', error)
        this.error = 'Failed to load dashboard data'
      } finally {
        this.isLoading = false
      }
    },
    
    async deleteProduct(productId) {
      if (!confirm('Are you sure you want to delete this product?')) return
      
      try {
        await axios.delete(`http://localhost:8000/api/admin/products/${productId}`)
        this.success = 'Product deleted successfully'
        await this.loadDashboardData()
        
        setTimeout(() => {
          this.success = null
        }, 3000)
        
      } catch (error) {
        console.error('Error deleting product:', error)
        this.error = 'Failed to delete product'
        setTimeout(() => {
          this.error = null
        }, 3000)
      }
    },

    async deleteCategory(categoryId) {
      if (!confirm('Are you sure you want to delete this category?')) return
      
      try {
        await axios.delete(`http://localhost:8000/api/admin/categories/${categoryId}`)
        this.success = 'Category deleted successfully'
        await this.loadDashboardData()
        
        setTimeout(() => {
          this.success = null
        }, 3000)
        
      } catch (error) {
        console.error('Error deleting category:', error)
        this.error = 'Failed to delete category'
        setTimeout(() => {
          this.error = null
        }, 3000)
      }
    },

    editProduct(product) {
      // TODO: Implement product editing
      console.log('Edit product:', product)
      alert('Product editing feature coming soon!')
    },

    editCategory(category) {
      // TODO: Implement category editing
      console.log('Edit category:', category)
      alert('Category editing feature coming soon!')
    },

    logout() {
      // Clear stored data
      localStorage.removeItem('token')
      localStorage.removeItem('user')
      delete axios.defaults.headers.common['Authorization']
      
      // Emit logout event
      this.$emit('logout')
    }
  }
}
</script>