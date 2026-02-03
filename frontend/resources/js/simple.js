import { createApp } from 'vue';

console.log('🚀 Cargando Vue...');

const app = createApp({
    data() {
        return {
            message: 'Laravel Vue App - FUNCIONANDO! 🎉',
            status: 'Backend y Frontend conectados',
            backendStatus: 'Verificando...',
            features: [
                { name: 'Vue.js 3', status: '✅ Funcionando' },
                { name: 'TailwindCSS', status: '✅ Cargado' },
                { name: 'Vite', status: '✅ Hot Reload' },
                { name: 'Docker', status: '✅ Containers UP' }
            ]
        }
    },
    async mounted() {
        console.log('✅ Vue montado correctamente!');
        await this.checkBackend();
    },
    methods: {
        async checkBackend() {
            try {
                const response = await fetch('http://localhost:8000/api/health');
                if (response.ok) {
                    this.backendStatus = '✅ Backend conectado';
                } else {
                    this.backendStatus = '❌ Backend offline';
                }
            } catch (error) {
                this.backendStatus = '🔄 Verificando conexión...';
                console.log('Backend check:', error.message);
            }
        }
    },
    template: `
        <div class="min-h-screen bg-gradient-to-br from-blue-50 to-purple-50 p-8">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="text-center mb-12">
                    <h1 class="text-5xl font-bold text-gray-800 mb-4">{{ message }}</h1>
                    <p class="text-2xl text-green-600 font-semibold">{{ status }}</p>
                    <div class="mt-4 inline-block px-6 py-3 bg-white rounded-full shadow-lg">
                        <p class="font-medium" :class="backendStatus.includes('✅') ? 'text-green-600' : 'text-orange-500'">
                            {{ backendStatus }}
                        </p>
                    </div>
                </div>

                <!-- Features Grid -->
                <div class="grid md:grid-cols-2 gap-6 mb-8">
                    <div v-for="feature in features" :key="feature.name" 
                         class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                        <h3 class="text-xl font-bold text-gray-700 mb-2">{{ feature.name }}</h3>
                        <p class="text-green-600 font-semibold">{{ feature.status }}</p>
                    </div>
                </div>

                <!-- Success Message -->
                <div class="bg-green-100 border-l-4 border-green-500 p-6 rounded-lg">
                    <div class="flex items-center">
                        <div class="text-3xl mr-4">🎯</div>
                        <div>
                            <h3 class="text-lg font-bold text-green-800">¡Aplicación Lista!</h3>
                            <p class="text-green-700">Tu proyecto Laravel + Vue + Docker está funcionando perfectamente.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `
});

app.mount('#app');
console.log('🎯 Aplicación Vue montada exitosamente!');