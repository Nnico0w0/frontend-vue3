import { createRouter, createWebHistory } from 'vue-router'

// Import page components
import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import DashboardAdmin from '../views/DashboardAdmin.vue'
import DashboardUser from '../views/DashboardUser.vue'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/register',
    name: 'Register',
    component: Register
  },
  {
    path: '/admin/dashboard',
    name: 'DashboardAdmin',
    component: DashboardAdmin,
    meta: { requiresAuth: true, role: 'admin' }
  },
  {
    path: '/dashboard',
    name: 'DashboardUser',
    component: DashboardUser,
    meta: { requiresAuth: true, role: 'user' }
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

// Navigation guard for authentication
router.beforeEach((to, from, next) => {
  const isAuthenticated = localStorage.getItem('token')
  const userRole = localStorage.getItem('role')

  if (to.meta.requiresAuth && !isAuthenticated) {
    next('/login')
  } else if (to.meta.role && userRole !== to.meta.role) {
    next('/')
  } else {
    next()
  }
})

export default router
