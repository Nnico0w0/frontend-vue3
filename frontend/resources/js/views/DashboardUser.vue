<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Top Navigation -->
    <nav class="bg-white shadow-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex items-center">
            <router-link to="/" class="flex items-center space-x-2">
              <div class="bg-gradient-to-r from-cyan-500 to-blue-600 p-2 rounded-lg">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2zm0 6a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z"/>
                </svg>
              </div>
              <span class="text-xl font-bold text-gray-900">SBuild</span>
            </router-link>
          </div>
          
          <div class="flex items-center space-x-4">
            <span class="text-gray-700">{{ user.name }}</span>
            <button 
              @click="logout"
              class="text-gray-600 hover:text-gray-900"
            >
              Cerrar Sesión
            </button>
          </div>
        </div>
      </div>
    </nav>

    <div class="flex">
      <!-- Sidebar -->
      <aside class="w-64 bg-white min-h-screen shadow-sm">
        <nav class="p-4 space-y-2">
          <button
            @click="activeTab = 'overview'"
            :class="[
              'w-full text-left px-4 py-3 rounded-lg flex items-center space-x-3 transition',
              activeTab === 'overview' 
                ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white' 
                : 'text-gray-700 hover:bg-gray-100'
            ]"
          >
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
            </svg>
            <span>Resumen</span>
          </button>
          
          <button
            @click="activeTab = 'servers'"
            :class="[
              'w-full text-left px-4 py-3 rounded-lg flex items-center space-x-3 transition',
              activeTab === 'servers' 
                ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white' 
                : 'text-gray-700 hover:bg-gray-100'
            ]"
          >
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2zm0 6a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z"/>
            </svg>
            <span>Mis Servidores</span>
          </button>
          
          <button
            @click="activeTab = 'create'"
            :class="[
              'w-full text-left px-4 py-3 rounded-lg flex items-center space-x-3 transition',
              activeTab === 'create' 
                ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white' 
                : 'text-gray-700 hover:bg-gray-100'
            ]"
          >
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
            </svg>
            <span>Crear Servidor</span>
          </button>
          
          <button
            @click="activeTab = 'billing'"
            :class="[
              'w-full text-left px-4 py-3 rounded-lg flex items-center space-x-3 transition',
              activeTab === 'billing' 
                ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white' 
                : 'text-gray-700 hover:bg-gray-100'
            ]"
          >
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"/>
            </svg>
            <span>Facturación</span>
          </button>
          
          <button
            @click="activeTab = 'settings'"
            :class="[
              'w-full text-left px-4 py-3 rounded-lg flex items-center space-x-3 transition',
              activeTab === 'settings' 
                ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white' 
                : 'text-gray-700 hover:bg-gray-100'
            ]"
          >
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"/>
            </svg>
            <span>Configuración</span>
          </button>
        </nav>
      </aside>

      <!-- Main Content -->
      <main class="flex-1 p-8">
        <!-- Overview Tab -->
        <div v-if="activeTab === 'overview'">
          <h1 class="text-3xl font-bold text-gray-900 mb-8">Panel de Usuario</h1>
          
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-md p-6">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-500 text-sm">Servidores Activos</p>
                  <p class="text-3xl font-bold text-cyan-600">{{ servers.filter(s => s.status === 'running').length }}</p>
                </div>
                <div class="bg-cyan-100 p-3 rounded-lg">
                  <svg class="w-8 h-8 text-cyan-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2zm0 6a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z"/>
                  </svg>
                </div>
              </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-6">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-500 text-sm">Jugadores Online</p>
                  <p class="text-3xl font-bold text-green-600">{{ totalPlayers }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-lg">
                  <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                  </svg>
                </div>
              </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-6">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-500 text-sm">Gasto Mensual</p>
                  <p class="text-3xl font-bold text-blue-600">${{ monthlyBill }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg">
                  <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"/>
                  </svg>
                </div>
              </div>
            </div>
          </div>

          <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Servidores Recientes</h2>
            <div class="space-y-4">
              <div v-for="server in servers.slice(0, 3)" :key="server.id" class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center space-x-4">
                  <div class="text-2xl">{{ server.icon }}</div>
                  <div>
                    <h3 class="font-semibold text-gray-900">{{ server.name }}</h3>
                    <p class="text-sm text-gray-500">{{ server.game }} - {{ server.players }} jugadores</p>
                  </div>
                </div>
                <div class="flex items-center space-x-4">
                  <span 
                    :class="[
                      'px-3 py-1 rounded-full text-sm font-medium',
                      server.status === 'running' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'
                    ]"
                  >
                    {{ server.status === 'running' ? 'En línea' : 'Detenido' }}
                  </span>
                  <button class="text-cyan-600 hover:text-cyan-700">
                    Gestionar
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Servers Tab -->
        <div v-if="activeTab === 'servers'">
          <h1 class="text-3xl font-bold text-gray-900 mb-8">Mis Servidores</h1>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div v-for="server in servers" :key="server.id" class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
              <div class="flex items-start justify-between mb-4">
                <div class="flex items-center space-x-3">
                  <div class="text-3xl">{{ server.icon }}</div>
                  <div>
                    <h3 class="text-xl font-bold text-gray-900">{{ server.name }}</h3>
                    <p class="text-sm text-gray-500">{{ server.game }}</p>
                  </div>
                </div>
                <span 
                  :class="[
                    'px-3 py-1 rounded-full text-sm font-medium',
                    server.status === 'running' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'
                  ]"
                >
                  {{ server.status === 'running' ? 'En línea' : 'Detenido' }}
                </span>
              </div>
              
              <div class="space-y-2 mb-4">
                <div class="flex justify-between text-sm">
                  <span class="text-gray-600">IP:</span>
                  <span class="font-mono text-gray-900">{{ server.ip }}</span>
                </div>
                <div class="flex justify-between text-sm">
                  <span class="text-gray-600">Jugadores:</span>
                  <span class="text-gray-900">{{ server.players }} / {{ server.maxPlayers }}</span>
                </div>
                <div class="flex justify-between text-sm">
                  <span class="text-gray-600">RAM:</span>
                  <span class="text-gray-900">{{ server.ram }}</span>
                </div>
                <div class="flex justify-between text-sm">
                  <span class="text-gray-600">Precio:</span>
                  <span class="text-gray-900">${{ server.price }}/mes</span>
                </div>
              </div>
              
              <div class="flex space-x-2">
                <button 
                  @click="toggleServer(server)"
                  :class="[
                    'flex-1 py-2 px-4 rounded-lg font-medium transition',
                    server.status === 'running' 
                      ? 'bg-red-100 text-red-700 hover:bg-red-200' 
                      : 'bg-green-100 text-green-700 hover:bg-green-200'
                  ]"
                >
                  {{ server.status === 'running' ? 'Detener' : 'Iniciar' }}
                </button>
                <button class="flex-1 bg-gradient-to-r from-cyan-500 to-blue-600 text-white py-2 px-4 rounded-lg font-medium hover:from-cyan-600 hover:to-blue-700 transition">
                  Gestionar
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Create Server Tab -->
        <div v-if="activeTab === 'create'">
          <h1 class="text-3xl font-bold text-gray-900 mb-8">Crear Nuevo Servidor</h1>
          
          <div class="bg-white rounded-xl shadow-md p-8 max-w-2xl">
            <form @submit.prevent="createServer" class="space-y-6">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Nombre del Servidor
                </label>
                <input
                  v-model="newServer.name"
                  type="text"
                  required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-cyan-500 focus:border-cyan-500"
                  placeholder="Mi Servidor de Minecraft"
                />
              </div>
              
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Tipo de Juego
                </label>
                <select
                  v-model="newServer.game"
                  required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-cyan-500 focus:border-cyan-500"
                >
                  <option value="">Selecciona un juego</option>
                  <option value="Minecraft">Minecraft</option>
                  <option value="CS:GO">CS:GO</option>
                  <option value="Rust">Rust</option>
                  <option value="ARK">ARK: Survival Evolved</option>
                  <option value="Valheim">Valheim</option>
                </select>
              </div>
              
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Plan
                </label>
                <div class="grid grid-cols-3 gap-4">
                  <button
                    type="button"
                    @click="newServer.plan = 'starter'"
                    :class="[
                      'p-4 border-2 rounded-lg text-center transition',
                      newServer.plan === 'starter' 
                        ? 'border-cyan-500 bg-cyan-50' 
                        : 'border-gray-200 hover:border-gray-300'
                    ]"
                  >
                    <div class="font-bold text-gray-900">Starter</div>
                    <div class="text-2xl font-bold text-cyan-600">$9.99</div>
                    <div class="text-xs text-gray-500">2GB RAM</div>
                  </button>
                  
                  <button
                    type="button"
                    @click="newServer.plan = 'pro'"
                    :class="[
                      'p-4 border-2 rounded-lg text-center transition',
                      newServer.plan === 'pro' 
                        ? 'border-cyan-500 bg-cyan-50' 
                        : 'border-gray-200 hover:border-gray-300'
                    ]"
                  >
                    <div class="font-bold text-gray-900">Pro</div>
                    <div class="text-2xl font-bold text-cyan-600">$19.99</div>
                    <div class="text-xs text-gray-500">4GB RAM</div>
                  </button>
                  
                  <button
                    type="button"
                    @click="newServer.plan = 'enterprise'"
                    :class="[
                      'p-4 border-2 rounded-lg text-center transition',
                      newServer.plan === 'enterprise' 
                        ? 'border-cyan-500 bg-cyan-50' 
                        : 'border-gray-200 hover:border-gray-300'
                    ]"
                  >
                    <div class="font-bold text-gray-900">Enterprise</div>
                    <div class="text-2xl font-bold text-cyan-600">$39.99</div>
                    <div class="text-xs text-gray-500">8GB RAM</div>
                  </button>
                </div>
              </div>
              
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Ubicación del Servidor
                </label>
                <select
                  v-model="newServer.location"
                  required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-cyan-500 focus:border-cyan-500"
                >
                  <option value="">Selecciona una ubicación</option>
                  <option value="us-east">Estados Unidos - Este</option>
                  <option value="us-west">Estados Unidos - Oeste</option>
                  <option value="eu-west">Europa - Oeste</option>
                  <option value="asia-east">Asia - Este</option>
                  <option value="sa-east">Sudamérica - Este</option>
                </select>
              </div>
              
              <button
                type="submit"
                class="w-full bg-gradient-to-r from-cyan-500 to-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:from-cyan-600 hover:to-blue-700 transition"
              >
                Crear Servidor
              </button>
            </form>
          </div>
        </div>

        <!-- Billing Tab -->
        <div v-if="activeTab === 'billing'">
          <h1 class="text-3xl font-bold text-gray-900 mb-8">Facturación</h1>
          
          <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Resumen de Facturación</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
              <div>
                <p class="text-gray-500 text-sm">Próxima Factura</p>
                <p class="text-2xl font-bold text-gray-900">$19.99</p>
                <p class="text-sm text-gray-500">15 Feb 2026</p>
              </div>
              <div>
                <p class="text-gray-500 text-sm">Total Gastado</p>
                <p class="text-2xl font-bold text-gray-900">$159.92</p>
                <p class="text-sm text-gray-500">Este año</p>
              </div>
              <div>
                <p class="text-gray-500 text-sm">Método de Pago</p>
                <p class="text-2xl font-bold text-gray-900">•••• 4242</p>
                <p class="text-sm text-gray-500">Visa</p>
              </div>
            </div>
          </div>

          <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Historial de Facturas</h2>
            <div class="space-y-3">
              <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div>
                  <p class="font-semibold text-gray-900">Enero 2026</p>
                  <p class="text-sm text-gray-500">15 Ene 2026</p>
                </div>
                <div class="text-right">
                  <p class="font-bold text-gray-900">$19.99</p>
                  <button class="text-sm text-cyan-600 hover:text-cyan-700">Descargar</button>
                </div>
              </div>
              <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div>
                  <p class="font-semibold text-gray-900">Diciembre 2025</p>
                  <p class="text-sm text-gray-500">15 Dic 2025</p>
                </div>
                <div class="text-right">
                  <p class="font-bold text-gray-900">$19.99</p>
                  <button class="text-sm text-cyan-600 hover:text-cyan-700">Descargar</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Settings Tab -->
        <div v-if="activeTab === 'settings'">
          <h1 class="text-3xl font-bold text-gray-900 mb-8">Configuración de Cuenta</h1>
          
          <div class="bg-white rounded-xl shadow-md p-8 max-w-2xl">
            <form class="space-y-6">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Nombre
                </label>
                <input
                  v-model="user.name"
                  type="text"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-cyan-500 focus:border-cyan-500"
                />
              </div>
              
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Email
                </label>
                <input
                  v-model="user.email"
                  type="email"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-cyan-500 focus:border-cyan-500"
                />
              </div>
              
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Nueva Contraseña
                </label>
                <input
                  type="password"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-cyan-500 focus:border-cyan-500"
                  placeholder="Dejar en blanco para mantener actual"
                />
              </div>
              
              <button
                type="submit"
                class="bg-gradient-to-r from-cyan-500 to-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:from-cyan-600 hover:to-blue-700 transition"
              >
                Guardar Cambios
              </button>
            </form>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
export default {
  name: 'DashboardUser',
  data() {
    return {
      activeTab: 'overview',
      user: JSON.parse(localStorage.getItem('user') || '{}'),
      servers: [
        {
          id: 1,
          name: 'Mi Servidor de Minecraft',
          game: 'Minecraft',
          icon: '🎮',
          status: 'running',
          ip: '192.168.1.100:25565',
          players: 15,
          maxPlayers: 50,
          ram: '4GB',
          price: 19.99
        },
        {
          id: 2,
          name: 'CS:GO Competitivo',
          game: 'CS:GO',
          icon: '🔫',
          status: 'stopped',
          ip: '192.168.1.101:27015',
          players: 0,
          maxPlayers: 20,
          ram: '2GB',
          price: 9.99
        },
        {
          id: 3,
          name: 'Rust Survival',
          game: 'Rust',
          icon: '🦀',
          status: 'running',
          ip: '192.168.1.102:28015',
          players: 8,
          maxPlayers: 20,
          ram: '4GB',
          price: 19.99
        }
      ],
      newServer: {
        name: '',
        game: '',
        plan: '',
        location: ''
      }
    }
  },
  computed: {
    totalPlayers() {
      return this.servers.reduce((sum, server) => sum + (server.status === 'running' ? server.players : 0), 0)
    },
    monthlyBill() {
      return this.servers.reduce((sum, server) => sum + server.price, 0).toFixed(2)
    }
  },
  methods: {
    logout() {
      localStorage.removeItem('token')
      localStorage.removeItem('role')
      localStorage.removeItem('user')
      this.$router.push('/login')
    },
    toggleServer(server) {
      server.status = server.status === 'running' ? 'stopped' : 'running'
      if (server.status === 'stopped') {
        server.players = 0
      }
    },
    createServer() {
      const gameIcons = {
        'Minecraft': '🎮',
        'CS:GO': '🔫',
        'Rust': '🦀',
        'ARK': '🏰',
        'Valheim': '⚔️'
      }
      
      const planPrices = {
        'starter': 9.99,
        'pro': 19.99,
        'enterprise': 39.99
      }
      
      const planRam = {
        'starter': '2GB',
        'pro': '4GB',
        'enterprise': '8GB'
      }
      
      const planPlayers = {
        'starter': 20,
        'pro': 50,
        'enterprise': 100
      }
      
      const newServerId = this.servers.length + 1
      
      this.servers.push({
        id: newServerId,
        name: this.newServer.name,
        game: this.newServer.game,
        icon: gameIcons[this.newServer.game] || '🎮',
        status: 'stopped',
        ip: `192.168.1.${100 + newServerId}:25565`,
        players: 0,
        maxPlayers: planPlayers[this.newServer.plan],
        ram: planRam[this.newServer.plan],
        price: planPrices[this.newServer.plan]
      })
      
      // Reset form
      this.newServer = {
        name: '',
        game: '',
        plan: '',
        location: ''
      }
      
      // Switch to servers tab
      this.activeTab = 'servers'
      
      alert('¡Servidor creado exitosamente!')
    }
  }
}
</script>
