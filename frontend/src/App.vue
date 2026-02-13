<template>
  <!-- Admin Login/Dashboard -->
  <div v-if="showAdminInterface">
    <AdminDashboard 
      v-if="isAuthenticated" 
      :user="currentUser" 
      @logout="handleLogout"
    />
    <LoginForm 
      v-else 
      @login-success="handleLoginSuccess"
    />
  </div>

  <!-- Regular Website -->
  <div v-else>
    <Navbar
      :cartCount="cartCount"
      @resetCartCount="resetCartCount"
      @show-admin="showAdminInterface = true"
      v-if="!['Signup', 'Signin'].includes($route.name)"
    />
    <div style="min-height: 60vh">
      <router-view
        v-if="products && categories"
        :baseURL="baseURL"
        :products="products"
        :categories="categories"
        @fetchData="fetchData"
      >
      </router-view>
    </div>
    <Footer v-if="!['Signup', 'Signin'].includes($route.name)" />
  </div>
</template>

<script>
import Navbar from './components/Navbar.vue';
import Footer from './components/Footer.vue';
import LoginForm from '../components/LoginForm.vue';
import AdminDashboard from '../components/AdminDashboard.vue';
import axios from 'axios';

export default {
  data() {
    return {
      baseURL: 'http://localhost:8000/api/',
      products: null,
      categories: null,
      key: 0,
      token: null,
      cartCount: 0,
      // Admin authentication
      showAdminInterface: false,
      isAuthenticated: false,
      currentUser: null
    };
  },

  components: { 
    Footer, 
    Navbar, 
    LoginForm, 
    AdminDashboard 
  },

  async mounted() {
    // Check if user is already authenticated
    const token = localStorage.getItem('token');
    const user = localStorage.getItem('user');
    
    if (token && user) {
      try {
        this.currentUser = JSON.parse(user);
        this.isAuthenticated = true;
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        
        // Check if admin interface should be shown based on URL
        if (window.location.pathname.includes('/admin') || window.location.hash.includes('admin')) {
          this.showAdminInterface = true;
        }
      } catch (error) {
        this.clearAuth();
      }
    }

    await this.fetchData();
  },
  methods: {
    handleLoginSuccess({ user, token }) {
      this.currentUser = user;
      this.isAuthenticated = true;
      this.showAdminInterface = true;
    },

    handleLogout() {
      this.clearAuth();
      this.showAdminInterface = false;
    },

    clearAuth() {
      this.isAuthenticated = false;
      this.currentUser = null;
      localStorage.removeItem('token');
      localStorage.removeItem('user');
      delete axios.defaults.headers.common['Authorization'];
    },
    async fetchData() {
      try {
        // fetch products
        await axios
          .get(this.baseURL + 'products')
          .then((res) => (this.products = res.data))
          .catch((err) => {
            console.log('Error fetching products:', err);
            // Fallback to sample data
            this.products = this.getSampleProducts();
          });

        //fetch categories
        await axios
          .get(this.baseURL + 'categories')
          .then((res) => (this.categories = res.data))
          .catch((err) => {
            console.log('Error fetching categories:', err);
            // Fallback to sample data
            this.categories = this.getSampleCategories();
          });
      } catch (error) {
        console.log('API connection error, using sample data');
        this.products = this.getSampleProducts();
        this.categories = this.getSampleCategories();
      }

      //fetch cart items
      if (this.token) {
        await axios.get(`${this.baseURL}cart/?token=${this.token}`).then(
          (response) => {
            if (response.status == 200) {
              // update cart
              this.cartCount = Object.keys(response.data.cartItems).length;
            }
          },
          (error) => {
            console.log(error);
          }
        );
      }
    },
    resetCartCount() {
      this.cartCount = 0;
    },
    getSampleProducts() {
      return [
        {
          id: 1,
          name: "Era",
          description: "Una fascinante novela histórica que te transportará a épocas pasadas...",
          price: "32.15",
          imageURL: "https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=300&h=400&fit=crop",
          category: "Novela Histórica",
          author: "Arturo Pérez-Reverte",
          stock: 25,
          salesCount: 150
        },
        {
          id: 2,
          name: "Resistiré",
          description: "Un relato emotivo sobre la resistencia y la esperanza en tiempos difíciles...",
          price: "25.99",
          imageURL: "https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=300&h=400&fit=crop",
          category: "Drama",
          author: "Isabel Burdiel",
          stock: 18,
          salesCount: 203,
          discount: 15,
          originalPrice: "35.90"
        },
        {
          id: 3,
          name: "Ser feliz no es gratis",
          description: "Una reflexión profunda sobre la búsqueda de la felicidad en el mundo moderno...",
          price: "32.15",
          imageURL: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&h=400&fit=crop",
          category: "Autoayuda",
          author: "Rayuela Cordo",
          stock: 30,
          salesCount: 89
        },
        {
          id: 4,
          name: "El Espartano",
          description: "Una épica aventura en la antigua Grecia llena de honor y batalla...",
          price: "32.15",
          imageURL: "https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=300&h=400&fit=crop",
          category: "Ficción Histórica",
          author: "Diego Moreno",
          stock: 22,
          salesCount: 267
        },
        {
          id: 5,
          name: "Ernesto Guevara, Che",
          description: "Biografía completa del revolucionario más icónico del siglo XX...",
          price: "32.15",
          imageURL: "https://images.unsplash.com/photo-1503236823255-94609f598e71?w=300&h=400&fit=crop",
          category: "Biografía",
          author: "César Vidal",
          stock: 15,
          salesCount: 178,
          isReservation: true
        },
        {
          id: 6,
          name: "Cien años de soledad",
          description: "La obra maestra del realismo mágico latinoamericano...",
          price: "28.50",
          imageURL: "https://images.unsplash.com/photo-1512820790803-83ca734da794?w=300&h=400&fit=crop",
          category: "Clásicos",
          author: "Gabriel García Márquez",
          stock: 40,
          salesCount: 445
        },
        {
          id: 7,
          name: "La sombra del viento",
          description: "Un misterio literario ambientado en la Barcelona de posguerra...",
          price: "24.95",
          imageURL: "https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=300&h=400&fit=crop",
          category: "Misterio",
          author: "Carlos Ruiz Zafón",
          stock: 35,
          salesCount: 312,
          discount: 20,
          originalPrice: "31.19"
        },
        {
          id: 8,
          name: "El nombre del viento",
          description: "Primera entrega de la saga Crónica del Asesino de Reyes...",
          price: "29.90",
          imageURL: "https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=300&h=400&fit=crop",
          category: "Fantasía",
          author: "Patrick Rothfuss",
          stock: 28,
          salesCount: 189
        }
      ];
    },
    getSampleCategories() {
      return [
        {
          id: 1,
          name: "Novela Histórica",
          description: "Novelas ambientadas en períodos históricos",
          imageURL: "https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=300&h=200&fit=crop"
        },
        {
          id: 2,
          name: "Drama",
          description: "Historias emotivas y profundas",
          imageURL: "https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=300&h=200&fit=crop"
        },
        {
          id: 3,
          name: "Autoayuda",
          description: "Libros para el crecimiento personal",
          imageURL: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&h=200&fit=crop"
        },
        {
          id: 4,
          name: "Fantasía",
          description: "Mundos mágicos y aventuras épicas",
          imageURL: "https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=300&h=200&fit=crop"
        },
        {
          id: 5,
          name: "Biografía",
          description: "Historias de vidas extraordinarias",
          imageURL: "https://images.unsplash.com/photo-1503236823255-94609f598e71?w=300&h=200&fit=crop"
        },
        {
          id: 6,
          name: "Clásicos",
          description: "Las obras inmortales de la literatura",
          imageURL: "https://images.unsplash.com/photo-1512820790803-83ca734da794?w=300&h=200&fit=crop"
        }
      ];
    },
  },
  mounted() {
    this.token = localStorage.getItem('token');
    this.fetchData();
  },
};
</script>

<style>
html {
  overflow-y: scroll;
}
</style>
