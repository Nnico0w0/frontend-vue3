import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

// Crear componente Home
const Home = {
    data() {
        return {
            loading: true,
            products: [],
            heroSection: {
                title: 'HostPro - Tu Partner en Hosting',
                subtitle: 'Hosting web confiable, rápido y escalable para hacer crecer tu negocio'
            },
            stats: [
                { number: '50K+', label: 'Sitios Activos' },
                { number: '99.9%', label: 'Tiempo de Actividad' },
                { number: '24/7', label: 'Soporte' },
                { number: '15+', label: 'Años de Experiencia' }
            ]
        }
    },
    async mounted() {
        await this.loadProducts();
        this.loading = false;
    },
    methods: {
        async loadProducts() {
            try {
                const response = await fetch('http://localhost:8000/api/products');
                const data = await response.json();
                this.products = data.data || data || [];
                console.log('Productos cargados:', this.products);
            } catch (error) {
                console.error('Error loading products:', error);
                this.products = [];
            }
        },
        getHostingProducts() {
            return this.products.filter(p => p.category === 'Hosting');
        }
    }
};

// Configurar rutas
const routes = [
    { path: '/', component: Home }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

// Crear app Vue
const app = createApp({});

app.use(router);
app.mount('#app');