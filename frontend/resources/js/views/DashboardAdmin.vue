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
              <span class="text-xl font-bold text-gray-900">SBuild Admin</span>
            </router-link>
          </div>
          
          <div class="flex items-center space-x-4">
            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-medium">Admin</span>
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
            <span>Dashboard</span>
          </button>
          
          <button
            @click="activeTab = 'users'"
            :class="[
              'w-full text-left px-4 py-3 rounded-lg flex items-center space-x-3 transition',
              activeTab === 'users' 
                ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white' 
                : 'text-gray-700 hover:bg-gray-100'
            ]"
          >
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
            </svg>
            <span>Usuarios</span>
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
            <span>Servidores</span>
          </button>
          
          <button
            @click="activeTab = 'statistics'"
            :class="[
              'w-full text-left px-4 py-3 rounded-lg flex items-center space-x-3 transition',
              activeTab === 'statistics' 
                ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white' 
                : 'text-gray-700 hover:bg-gray-100'
            ]"
          >
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
            </svg>
            <span>Estadísticas</span>
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
          <h1 class="text-3xl font-bold text-gray-900 mb-8">Panel de Administración</h1>
          
          <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-md p-6">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-500 text-sm">Total Usuarios</p>
                  <p class="text-3xl font-bold text-cyan-600">{{ users.length }}</p>
                </div>
                <div class="bg-cyan-100 p-3 rounded-lg">
                  <svg class="w-8 h-8 text-cyan-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                  </svg>
                </div>
              </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-6">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-500 text-sm">Total Servidores</p>
                  <p class="text-3xl font-bold text-green-600">{{ allServers.length }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-lg">
                  <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2zm0 6a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z"/>
                  </svg>
                </div>
              </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-6">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-500 text-sm">Servidores Activos</p>
                  <p class="text-3xl font-bold text-blue-600">{{ activeServers }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg">
                  <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                  </svg>
                </div>
              </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-6">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-500 text-sm">Ingresos Mensuales</p>
                  <p class="text-3xl font-bold text-purple-600">${{ totalRevenue }}</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-lg">
                  <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"/>
                  </svg>
                </div>
              </div>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-xl shadow-md p-6">
              <h2 class="text-xl font-bold text-gray-900 mb-4">Actividad Reciente</h2>
              <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                  <div class="flex items-center space-x-3">
                    <div class="bg-green-100 p-2 rounded-lg">
                      <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                      </svg>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-900">Nuevo usuario registrado</p>
                      <p class="text-xs text-gray-500">hace 5 minutos</p>
                    </div>
                  </div>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                  <div class="flex items-center space-x-3">
                    <div class="bg-blue-100 p-2 rounded-lg">
                      <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2zm0 6a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z"/>
                      </svg>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-900">Servidor creado</p>
                      <p class="text-xs text-gray-500">hace 15 minutos</p>
                    </div>
                  </div>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                  <div class="flex items-center space-x-3">
                    <div class="bg-purple-100 p-2 rounded-lg">
                      <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"/>
                      </svg>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-900">Pago recibido</p>
                      <p class="text-xs text-gray-500">hace 1 hora</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
              <h2 class="text-xl font-bold text-gray-900 mb-4">Distribución de Juegos</h2>
              <div class="space-y-4">
                <div>
                  <div class="flex justify-between mb-1">
                    <span class="text-sm text-gray-600">Minecraft</span>
                    <span class="text-sm font-medium text-gray-900">45%</span>
                  </div>
                  <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-cyan-600 h-2 rounded-full" style="width: 45%"></div>
                  </div>
                </div>
                <div>
                  <div class="flex justify-between mb-1">
                    <span class="text-sm text-gray-600">CS:GO</span>
                    <span class="text-sm font-medium text-gray-900">25%</span>
                  </div>
                  <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full" style="width: 25%"></div>
                  </div>
                </div>
                <div>
                  <div class="flex justify-between mb-1">
                    <span class="text-sm text-gray-600">Rust</span>
                    <span class="text-sm font-medium text-gray-900">20%</span>
                  </div>
                  <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-green-600 h-2 rounded-full" style="width: 20%"></div>
                  </div>
                </div>
                <div>
                  <div class="flex justify-between mb-1">
                    <span class="text-sm text-gray-600">Otros</span>
                    <span class="text-sm font-medium text-gray-900">10%</span>
                  </div>
                  <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-purple-600 h-2 rounded-full" style="width: 10%"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Users Tab -->
        <div v-if="activeTab === 'users'">
          <h1 class="text-3xl font-bold text-gray-900 mb-8">Gestión de Usuarios</h1>
          
          <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Servidores</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plan</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="user in users" :key="user.id">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 h-10 w-10 bg-cyan-100 rounded-full flex items-center justify-center">
                        <span class="text-cyan-600 font-bold">{{ user.name.charAt(0) }}</span>
                      </div>
                      <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">{{ user.name }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ user.email }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ user.servers }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800">
                      {{ user.plan }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span 
                      :class="[
                        'px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full',
                        user.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                      ]"
                    >
                      {{ user.status === 'active' ? 'Activo' : 'Inactivo' }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button class="text-cyan-600 hover:text-cyan-900 mr-3">Editar</button>
                    <button class="text-red-600 hover:text-red-900">Suspender</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Servers Tab -->
        <div v-if="activeTab === 'servers'">
          <h1 class="text-3xl font-bold text-gray-900 mb-8">Gestión de Servidores</h1>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div v-for="server in allServers" :key="server.id" class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
              <div class="flex items-start justify-between mb-4">
                <div class="flex items-center space-x-3">
                  <div class="text-3xl">{{ server.icon }}</div>
                  <div>
                    <h3 class="text-xl font-bold text-gray-900">{{ server.name }}</h3>
                    <p class="text-sm text-gray-500">{{ server.owner }} - {{ server.game }}</p>
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
              </div>
              
              <div class="flex space-x-2">
                <button class="flex-1 bg-cyan-100 text-cyan-700 py-2 px-4 rounded-lg font-medium hover:bg-cyan-200 transition">
                  Ver Detalles
                </button>
                <button class="flex-1 bg-red-100 text-red-700 py-2 px-4 rounded-lg font-medium hover:bg-red-200 transition">
                  Suspender
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Statistics Tab -->
        <div v-if="activeTab === 'statistics'">
          <h1 class="text-3xl font-bold text-gray-900 mb-8">Estadísticas</h1>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-xl shadow-md p-6">
              <h2 class="text-xl font-bold text-gray-900 mb-4">Crecimiento de Usuarios</h2>
              <div class="h-64 flex items-end justify-between space-x-2">
                <div class="flex-1 bg-cyan-500 rounded-t" style="height: 40%"></div>
                <div class="flex-1 bg-cyan-500 rounded-t" style="height: 55%"></div>
                <div class="flex-1 bg-cyan-500 rounded-t" style="height: 70%"></div>
                <div class="flex-1 bg-cyan-500 rounded-t" style="height: 65%"></div>
                <div class="flex-1 bg-cyan-500 rounded-t" style="height: 80%"></div>
                <div class="flex-1 bg-cyan-500 rounded-t" style="height: 90%"></div>
                <div class="flex-1 bg-cyan-600 rounded-t" style="height: 100%"></div>
              </div>
              <div class="flex justify-between mt-2 text-xs text-gray-500">
                <span>Ene</span>
                <span>Feb</span>
                <span>Mar</span>
                <span>Abr</span>
                <span>May</span>
                <span>Jun</span>
                <span>Jul</span>
              </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
              <h2 class="text-xl font-bold text-gray-900 mb-4">Ingresos Mensuales</h2>
              <div class="h-64 flex items-end justify-between space-x-2">
                <div class="flex-1 bg-green-500 rounded-t" style="height: 45%"></div>
                <div class="flex-1 bg-green-500 rounded-t" style="height: 60%"></div>
                <div class="flex-1 bg-green-500 rounded-t" style="height: 55%"></div>
                <div class="flex-1 bg-green-500 rounded-t" style="height: 75%"></div>
                <div class="flex-1 bg-green-500 rounded-t" style="height: 70%"></div>
                <div class="flex-1 bg-green-500 rounded-t" style="height: 85%"></div>
                <div class="flex-1 bg-green-600 rounded-t" style="height: 100%"></div>
              </div>
              <div class="flex justify-between mt-2 text-xs text-gray-500">
                <span>Ene</span>
                <span>Feb</span>
                <span>Mar</span>
                <span>Abr</span>
                <span>May</span>
                <span>Jun</span>
                <span>Jul</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Settings Tab -->
        <div v-if="activeTab === 'settings'">
          <h1 class="text-3xl font-bold text-gray-900 mb-8">Configuración del Sistema</h1>
          
          <div class="bg-white rounded-xl shadow-md p-8 max-w-2xl">
            <form class="space-y-6">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Nombre de la Plataforma
                </label>
                <input
                  value="SBuild"
                  type="text"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-cyan-500 focus:border-cyan-500"
                />
              </div>
              
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Email de Soporte
                </label>
                <input
                  value="support@sbuild.com"
                  type="email"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-cyan-500 focus:border-cyan-500"
                />
              </div>
              
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Modo de Mantenimiento
                </label>
                <div class="flex items-center">
                  <input
                    type="checkbox"
                    class="h-4 w-4 text-cyan-600 focus:ring-cyan-500 border-gray-300 rounded"
                  />
                  <label class="ml-2 block text-sm text-gray-900">
                    Activar modo de mantenimiento
                  </label>
                </div>
              </div>
              
              <button
                type="submit"
                class="bg-gradient-to-r from-cyan-500 to-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:from-cyan-600 hover:to-blue-700 transition"
              >
                Guardar Configuración
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
  name: 'DashboardAdmin',
  data() {
    return {
      activeTab: 'overview',
      user: JSON.parse(localStorage.getItem('user') || '{}'),
      users: [
        { id: 1, name: 'Juan Pérez', email: 'juan@example.com', servers: 3, plan: 'Pro', status: 'active' },
        { id: 2, name: 'María García', email: 'maria@example.com', servers: 1, plan: 'Starter', status: 'active' },
        { id: 3, name: 'Carlos López', email: 'carlos@example.com', servers: 5, plan: 'Enterprise', status: 'active' },
        { id: 4, name: 'Ana Martínez', email: 'ana@example.com', servers: 2, plan: 'Pro', status: 'inactive' },
      ],
      allServers: [
        {
          id: 1,
          name: 'Minecraft Survival',
          owner: 'Juan Pérez',
          game: 'Minecraft',
          icon: '🎮',
          status: 'running',
          ip: '192.168.1.100:25565',
          players: 15,
          maxPlayers: 50,
          ram: '4GB'
        },
        {
          id: 2,
          name: 'CS:GO Competitivo',
          owner: 'María García',
          game: 'CS:GO',
          icon: '🔫',
          status: 'stopped',
          ip: '192.168.1.101:27015',
          players: 0,
          maxPlayers: 20,
          ram: '2GB'
        },
        {
          id: 3,
          name: 'Rust PvP Server',
          owner: 'Carlos López',
          game: 'Rust',
          icon: '🦀',
          status: 'running',
          ip: '192.168.1.102:28015',
          players: 32,
          maxPlayers: 100,
          ram: '8GB'
        },
        {
          id: 4,
          name: 'ARK Survival',
          owner: 'Ana Martínez',
          game: 'ARK',
          icon: '🏰',
          status: 'running',
          ip: '192.168.1.103:27015',
          players: 10,
          maxPlayers: 50,
          ram: '4GB'
        }
      ]
    }
  },
  computed: {
    activeServers() {
      return this.allServers.filter(s => s.status === 'running').length
    },
    totalRevenue() {
      // Calculate based on plans: Starter $9.99, Pro $19.99, Enterprise $39.99
      const planPrices = { 'Starter': 9.99, 'Pro': 19.99, 'Enterprise': 39.99 }
      return this.users.reduce((sum, user) => sum + (planPrices[user.plan] || 0) * user.servers, 0).toFixed(2)
    }
  },
  methods: {
    logout() {
      localStorage.removeItem('token')
      localStorage.removeItem('role')
      localStorage.removeItem('user')
      this.$router.push('/login')
    }
  }
}
</script>
