# Laravel Vue App - Dockerizada

## 🏗️ Arquitectura

Este proyecto ha sido dockerizado y separado en:

- **Frontend**: Vue.js 3 + TailwindCSS + Vite (Puerto 3000)
- **Backend**: Laravel 12 + PHP 8.3 + Nginx (Puerto 8000)
- **Base de datos**: PostgreSQL 16 (Puerto 5432)
- **Cache**: Redis 7 (Puerto 6379)
- **Administración DB**: pgAdmin 4 (Puerto 8080)

## 🚀 Inicio Rápido

### Desarrollo

```bash
# Levantar todos los servicios en modo desarrollo
docker-compose -f docker-compose.dev.yml up --build

# O individualmente:
docker-compose -f docker-compose.dev.yml up frontend
docker-compose -f docker-compose.dev.yml up backend
```

### Producción

```bash
# Levantar todos los servicios
docker-compose up --build -d

# Ver logs
docker-compose logs -f
```

## 📁 Estructura del Proyecto

```
laravel-vue-app/
├── frontend/                    # Vue.js App
│   ├── resources/
│   │   ├── js/
│   │   │   ├── app.js          # App Vue principal
│   │   │   └── bootstrap.js     # Configuración Axios
│   │   └── css/
│   │       └── app.css         # Estilos TailwindCSS
│   ├── index.html              # HTML base
│   ├── package.json            # Dependencias Node
│   ├── vite.config.js          # Configuración Vite
│   └── Dockerfile              # Imagen Docker frontend
│
├── backend/                     # Laravel API
│   ├── app/
│   │   └── Http/Middleware/Cors.php  # Middleware CORS
│   ├── routes/
│   │   ├── web.php             # Rutas web
│   │   └── api.php             # Rutas API
│   ├── docker/                 # Configuraciones Docker
│   │   ├── nginx.conf          # Nginx producción
│   │   ├── nginx.dev.conf      # Nginx desarrollo
│   │   └── supervisord.conf    # Supervisor config
│   ├── Dockerfile              # Imagen Docker backend (prod)
│   ├── Dockerfile.dev          # Imagen Docker backend (dev)
│   └── .env.example            # Variables de entorno
│
├── docker-compose.yml          # Docker Compose (producción)
├── docker-compose.dev.yml      # Docker Compose (desarrollo)
└── README.md                   # Esta documentación
```

## 🔧 Servicios

### Frontend (Vue.js)
- **Puerto**: 3000
- **Hot reload**: ✅
- **Proxy API**: `/api` → `http://backend:80`

### Backend (Laravel)
- **Puerto**: 8000
- **API base**: `/api`
- **CORS configurado**: ✅
- **Middleware**: Cors personalizado

### Base de Datos
- **PostgreSQL 16** en puerto 5432
- **Credenciales**:
  - Database: `laravel_db`
  - User: `laravel_user`
  - Password: `laravel_password`

### pgAdmin
- **Puerto**: 8080
- **URL**: http://localhost:8080
- **Login**: admin@admin.com / admin

## 🌐 URLs de Acceso

- **Frontend**: http://localhost:3000
- **Backend API**: http://localhost:8000/api
- **pgAdmin**: http://localhost:8080

## 📡 API Endpoints Disponibles

- `GET /api/health` - Estado del backend
- `GET /api/users` - Lista de usuarios
- `POST /api/users` - Crear usuario

## 🛠️ Comandos Útiles

```bash
# Ver logs de un servicio específico
docker-compose logs -f frontend
docker-compose logs -f backend

# Ejecutar comandos en el backend
docker-compose exec backend php artisan migrate
docker-compose exec backend php artisan key:generate
docker-compose exec backend composer install

# Ejecutar comandos en el frontend
docker-compose exec frontend npm install
docker-compose exec frontend npm run build

# Parar todos los servicios
docker-compose down

# Parar y eliminar volúmenes
docker-compose down -v

# Reconstruir imagen específica
docker-compose build frontend
docker-compose build backend
```

## 🔄 Desarrollo

El proyecto está configurado para desarrollo con:

1. **Hot reload** tanto en frontend como backend
2. **CORS** configurado para comunicación local
3. **Volúmenes** montados para desarrollo en tiempo real
4. **Logs** detallados para debugging

## 🚦 Testing

```bash
# Tests del backend
docker-compose exec backend php artisan test

# Build de producción frontend
docker-compose exec frontend npm run build
```

## 📋 Variables de Entorno

Configura las variables en `backend/.env`:

```env
# Aplicación
APP_NAME=LaravelVueApp
APP_URL=http://localhost:8000
FRONTEND_URL=http://localhost:3000

# Base de datos
DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_password
```

## 🎯 Próximos Pasos

1. Configurar autenticación JWT/Sanctum
2. Implementar estado global con Pinia
3. Agregar tests E2E con Cypress
4. Configurar CI/CD con GitHub Actions
5. Implementar WebSockets con Laravel Broadcasting

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
