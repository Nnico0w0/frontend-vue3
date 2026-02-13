<template>
  <div class="product-carousel">
    <div class="carousel-header">
      <h2 class="carousel-title">{{ title }}</h2>
      <div class="carousel-controls">
        <button 
          class="carousel-btn prev" 
          @click="scrollLeft"
          :disabled="currentIndex === 0"
        >
          <i class="fa fa-chevron-left"></i>
        </button>
        <button 
          class="carousel-btn next" 
          @click="scrollRight"
          :disabled="currentIndex >= maxIndex"
        >
          <i class="fa fa-chevron-right"></i>
        </button>
      </div>
    </div>
    
    <div class="carousel-container" ref="carouselContainer">
      <div 
        class="carousel-track" 
        :style="{ transform: `translateX(-${currentIndex * cardWidth}px)` }"
      >
        <div 
          v-for="product in products" 
          :key="product.id" 
          class="product-card"
        >
          <div class="product-image-container">
            <img 
              :src="product.imageURL" 
              :alt="product.name"
              class="product-image"
            />
            <div 
              v-if="product.discount" 
              class="discount-badge"
            >
              -{{ product.discount }}%
            </div>
          </div>
          
          <div class="product-info">
            <router-link 
              :to="{ name: 'ShowDetails', params: { id: product.id } }"
              class="product-title"
            >
              {{ product.name }}
            </router-link>
            
            <p class="product-author" v-if="product.author">
              {{ product.author }}
            </p>
            
            <div class="product-price">
              <span 
                v-if="product.originalPrice" 
                class="original-price"
              >
                {{ product.originalPrice }}€
              </span>
              <span class="current-price">
                {{ product.price }}€
              </span>
            </div>
            
            <div class="product-actions">
              <button 
                @click="addToCart(product)"
                class="btn btn-add-cart"
                :class="{ 'btn-reserve': product.isReservation }"
              >
                <i class="fa fa-shopping-cart"></i>
                {{ product.isReservation ? 'Reservar' : 'Añadir a la cesta' }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ProductCarousel",
  props: {
    title: {
      type: String,
      default: "Productos Destacados"
    },
    products: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      currentIndex: 0,
      cardWidth: 250,
      visibleCards: 5
    };
  },
  computed: {
    maxIndex() {
      return Math.max(0, this.products.length - this.visibleCards);
    }
  },
  mounted() {
    this.updateCardWidth();
    window.addEventListener('resize', this.updateCardWidth);
  },
  beforeUnmount() {
    window.removeEventListener('resize', this.updateCardWidth);
  },
  methods: {
    updateCardWidth() {
      if (this.$refs.carouselContainer) {
        const containerWidth = this.$refs.carouselContainer.offsetWidth;
        if (window.innerWidth >= 1200) {
          this.visibleCards = 5;
        } else if (window.innerWidth >= 992) {
          this.visibleCards = 4;
        } else if (window.innerWidth >= 768) {
          this.visibleCards = 3;
        } else if (window.innerWidth >= 576) {
          this.visibleCards = 2;
        } else {
          this.visibleCards = 1;
        }
        this.cardWidth = containerWidth / this.visibleCards;
      }
    },
    scrollLeft() {
      if (this.currentIndex > 0) {
        this.currentIndex--;
      }
    },
    scrollRight() {
      if (this.currentIndex < this.maxIndex) {
        this.currentIndex++;
      }
    },
    addToCart(product) {
      // Emit event to parent or handle cart logic
      this.$emit('add-to-cart', product);
      
      // Show success message (you can use a notification library)
      alert(`${product.name} agregado al carrito`);
    }
  }
};
</script>

<style scoped>
.product-carousel {
  margin: 2rem 0;
  padding: 0 1rem;
}

.carousel-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
}

.carousel-title {
  font-family: 'Josefin Sans', sans-serif;
  font-size: 1.8rem;
  font-weight: 600;
  color: #333;
  margin: 0;
}

.carousel-controls {
  display: flex;
  gap: 0.5rem;
}

.carousel-btn {
  width: 40px;
  height: 40px;
  border: 2px solid #ddd;
  border-radius: 50%;
  background: white;
  color: #666;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
}

.carousel-btn:hover:not(:disabled) {
  border-color: #28a745;
  color: #28a745;
  background: #f8f9fa;
}

.carousel-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.carousel-container {
  overflow: hidden;
  width: 100%;
}

.carousel-track {
  display: flex;
  transition: transform 0.3s ease;
}

.product-card {
  flex: 0 0 auto;
  width: 250px;
  margin-right: 1rem;
  background: white;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  overflow: hidden;
}

.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
}

.product-image-container {
  position: relative;
  height: 300px;
  overflow: hidden;
}

.product-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.discount-badge {
  position: absolute;
  top: 10px;
  left: 10px;
  background: #dc3545;
  color: white;
  padding: 5px 10px;
  border-radius: 20px;
  font-size: 0.8rem;
  font-weight: bold;
}

.product-info {
  padding: 1rem;
}

.product-title {
  color: #333;
  text-decoration: none;
  font-weight: 600;
  font-size: 1rem;
  display: block;
  margin-bottom: 0.5rem;
  line-height: 1.3;
}

.product-title:hover {
  color: #28a745;
}

.product-author {
  color: #666;
  font-size: 0.9rem;
  margin-bottom: 0.5rem;
}

.product-price {
  margin-bottom: 1rem;
}

.original-price {
  text-decoration: line-through;
  color: #999;
  margin-right: 0.5rem;
  font-size: 0.9rem;
}

.current-price {
  color: #28a745;
  font-weight: bold;
  font-size: 1.1rem;
}

.product-actions {
  display: flex;
  gap: 0.5rem;
}

.btn-add-cart {
  flex: 1;
  background: #28a745;
  color: white;
  border: none;
  padding: 0.7rem 1rem;
  border-radius: 5px;
  font-size: 0.9rem;
  cursor: pointer;
  transition: background 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
}

.btn-add-cart:hover {
  background: #218838;
}

.btn-reserve {
  background: #fd7e14;
}

.btn-reserve:hover {
  background: #e66c06;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .carousel-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 1rem;
  }
  
  .carousel-controls {
    align-self: flex-end;
  }
  
  .carousel-title {
    font-size: 1.5rem;
  }
  
  .product-card {
    width: 200px;
  }
  
  .product-image-container {
    height: 250px;
  }
}

@media (max-width: 576px) {
  .product-card {
    width: 180px;
  }
  
  .product-image-container {
    height: 220px;
  }
  
  .product-info {
    padding: 0.8rem;
  }
}
</style>