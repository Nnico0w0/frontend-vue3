<template>
  <div id="home">
    <!-- Page Wrapper -->
    <div id="background-div" class="page-holder bg-cover">

      <div class="container py-5">
        <header class="text-left text-white py-5">
          <h3 class="mb-4 rounded"><a href="#start-shopping" class="bg-white px-2 py-2 rounded" id="heading">Start Shopping</a></h3>
          <p id="content" class="lead mb-0 bg-dark p-1 rounded">Simple Coding Market is for educational purposes only.
            It can be used by developers to learn about developing an ecommerce application complete with backend and frontend for Web and Android</p>
        </header>
      </div>
    </div>

    <div id="start-shopping" class="container">
      <div class="row">
        <div class="col-12 text-left">
          <h2 class="pt-3">Top Categories</h2>
        </div>
      </div>
      <div class="row">
        <div v-for="index in this.category_size" :key="index" class="col-md-6 col-xl-4 col-12 pt-3  justify-content-around d-flex">
          <CategoryBox :category="categories[index-1]">
          </CategoryBox>
        </div>
      </div>
    </div>

    <!-- Nueva sección de productos destacados con carrusel -->
    <div class="featured-products-section">
      <div class="container">
        <ProductCarousel 
          title="NOVEDADES" 
          :products="featuredProducts"
          @add-to-cart="handleAddToCart"
        />
      </div>
    </div>

    <hr>
    <div class="container">
      <div class="row">
        <div class="col-12 text-left">
          <h2 class="pt-3">Top Products</h2>
        </div>
      </div>
      <div class="row">
        <div v-for="index in this.product_size" :key="index" class="col-md-6 col-xl-4 col-12 pt-3  justify-content-around d-flex">
          <ProductBox :product="products[index-1]">
          </ProductBox>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import ProductBox from "../components/Product/ProductBox";
  import ProductCarousel from "../components/Product/ProductCarousel";
  import CategoryBox from "../components/Category/CategoryBox";
  export default {
    name: 'Home',
    components : { ProductBox, ProductCarousel, CategoryBox},
    props : ["baseURL", "products", "categories"],
    data(){
      return{
        category_size:0,
        product_size:0,
        featuredProducts: []
      }
    },
    mounted(){
      this.category_size = this.categories.length;
      this.category_size = Math.min(6, this.category_size);

      this.product_size = this.products.length;
      this.product_size = Math.min(8, this.product_size);
      
      // Crear productos destacados con descuentos y ofertas especiales
      this.createFeaturedProducts();
    },
    methods: {
      createFeaturedProducts() {
        // Simular productos destacados basados en los productos existentes
        if (this.products && this.products.length > 0) {
          // Tomar los 3 productos más vendidos
          const topSelling = [...this.products]
            .sort((a, b) => (b.salesCount || 0) - (a.salesCount || 0))
            .slice(0, 3);
          
          // Agregar algunos productos adicionales con descuentos
          const otherProducts = this.products.slice(0, 7).map((product, index) => {
            const hasDiscount = index % 4 === 0; // Cada cuarto producto tiene descuento
            const isReservation = product.isReservation || index % 6 === 0; // Cada sexto producto es reserva
            const discount = hasDiscount && !product.discount ? Math.floor(Math.random() * 30) + 10 : product.discount;
            
            return {
              ...product,
              discount: discount || null,
              originalPrice: discount && !product.originalPrice ? 
                (parseFloat(product.price) * (1 + discount / 100)).toFixed(2) : product.originalPrice,
              isReservation: isReservation,
              author: product.author || this.generateRandomAuthor()
            };
          });
          
          // Combinar productos más vendidos con otros productos
          this.featuredProducts = [...topSelling, ...otherProducts.filter(p => 
            !topSelling.find(ts => ts.id === p.id)
          )].slice(0, 10);
        } else {
          // Datos de ejemplo si no hay productos
          this.featuredProducts = [
            {
              id: 1,
              name: "Era",
              author: "Arturo Pérez-Reverte",
              price: "32,15",
              originalPrice: null,
              discount: null,
              imageURL: "https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=300&h=400&fit=crop",
              isReservation: false
            },
            {
              id: 2,
              name: "Resistiré",
              author: "Isabel Burdiel",
              price: "25,99",
              originalPrice: "35,90",
              discount: 15,
              imageURL: "https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=300&h=400&fit=crop",
              isReservation: false
            },
            {
              id: 3,
              name: "Ser feliz no es gratis",
              author: "Rayuela Cordo",
              price: "32,15",
              originalPrice: null,
              discount: null,
              imageURL: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&h=400&fit=crop",
              isReservation: false
            },
            {
              id: 4,
              name: "El Espartano",
              author: "Diego Moreno",
              price: "32,15",
              originalPrice: null,
              discount: null,
              imageURL: "https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=300&h=400&fit=crop",
              isReservation: false
            },
            {
              id: 5,
              name: "Ernesto Guevara, Che",
              author: "César Vidal",
              price: "32,15",
              originalPrice: null,
              discount: null,
              imageURL: "https://images.unsplash.com/photo-1503236823255-94609f598e71?w=300&h=400&fit=crop",
              isReservation: true
            }
          ];
        }
      },
      generateRandomAuthor() {
        const authors = [
          "Isabel Allende", "Mario Vargas Llosa", "Gabriel García Márquez",
          "Arturo Pérez-Reverte", "Javier Marías", "Antonio Muñoz Molina",
          "Rosa Montero", "Julia Navarro", "Carlos Ruiz Zafón", "Laura Gallego"
        ];
        return authors[Math.floor(Math.random() * authors.length)];
      },
      handleAddToCart(product) {
        // Aquí puedes implementar la lógica para agregar al carrito
        console.log('Producto agregado al carrito:', product);
        // Emitir evento al componente padre o manejar con Vuex/store
        this.$emit('add-to-cart', product);
      }
    }
  }
</script>

<style>
  .page-holder {
    min-height: 100vh;
  }

  .bg-cover {
    background-size: cover !important;
  }

  #background-div {
    background: url(../assets/home.png)
  }

  #heading {
    text-decoration: none;
    font-family: 'Roboto', sans-serif;
    font-weight: 400;
    opacity: 0.8;
    font-family: 'Josefin Sans', sans-serif;
  }

  #content {
    opacity: 0.8;
  }

  h2 {
    font-family: 'Josefin Sans', sans-serif;
  }

  .featured-products-section {
    background: #f8f9fa;
    padding: 3rem 0;
    margin: 2rem 0;
  }

  .featured-products-section .container {
    max-width: 1200px;
  }

  /* Estilos adicionales para mejorar la apariencia */
  .section-divider {
    border: none;
    height: 1px;
    background: linear-gradient(to right, transparent, #dee2e6, transparent);
    margin: 3rem 0;
  }

  /* Animación suave para el scroll */
  html {
    scroll-behavior: smooth;
  }
</style>
