# Laravel Vue App - Dockerizada

## 🏗️ Arquitectura

Este proyecto ha sido dockerizado y separado en:

- **Frontend**: Vue.js 3 + TailwindCSS + Vite (Puerto 3000)
- **Backend**: Laravel 12 + PHP 8.3 + Nginx + JWT Authentication (Puerto 8000)
- **Base de datos**: PostgreSQL 16 (Puerto 5432)
- **Cache**: Redis 7 (Puerto 6379)
- **Administración DB**: pgAdmin 4 (Puerto 8080)

## 🚀 Inicio Rápido

### Desarrollo y Producción

```bash
# Levantar todos los servicios
docker-compose up --build -d

# Ver logs
docker-compose logs -f

# Ver logs de un servicio específico
docker-compose logs -f backend
docker-compose logs -f frontend
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
│   │   ├── Http/
│   │   │   ├── Controllers/Api/AuthController.php  # JWT Auth
│   │   │   └── Middleware/Cors.php  # Middleware CORS
│   │   └── Models/User.php      # User model con JWT
│   ├── config/
│   │   ├── auth.php             # Configuración auth + JWT guard
│   │   └── jwt.php              # Configuración JWT
│   ├── routes/
│   │   ├── web.php             # Rutas web
│   │   └── api.php             # Rutas API con JWT
│   ├── docker/                 # Configuraciones Docker
│   │   ├── nginx.conf          # Nginx producción
│   │   ├── nginx.dev.conf      # Nginx desarrollo
│   │   └── supervisord.conf    # Supervisor config
│   ├── Dockerfile              # Imagen Docker backend
│   └── .env.example            # Variables de entorno
│
├── docker-compose.yml          # Docker Compose
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
- **Autenticación**: JWT (JSON Web Tokens)
- **CORS configurado**: ✅
- **Middleware**: Cors personalizado + JWT Auth

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

### Públicos
- `GET /api/health` - Estado del backend
- `POST /api/register` - Registrar nuevo usuario
- `POST /api/login` - Iniciar sesión (devuelve JWT token)
- `GET /api/products` - Lista de productos
- `GET /api/products/{id}` - Detalle de producto
- `GET /api/products/category/{category}` - Productos por categoría

### Protegidos (requieren JWT token)
- `POST /api/logout` - Cerrar sesión
- `POST /api/refresh` - Refrescar token JWT
- `GET /api/me` - Obtener usuario autenticado
- `GET /api/user` - Obtener usuario actual

## 🛠️ Comandos Útiles

```bash
# Ver logs de un servicio específico
docker-compose logs -f frontend
docker-compose logs -f backend

# Ejecutar comandos en el backend
docker-compose exec backend php artisan migrate
docker-compose exec backend php artisan jwt:secret
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

1. **Hot reload** en frontend con Vite
2. **CORS** configurado para comunicación local
3. **Volúmenes** montados para desarrollo en tiempo real
4. **Logs** detallados para debugging
5. **JWT Authentication** para API segura

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

# JWT Authentication
JWT_SECRET=                     # Generar con: php artisan jwt:secret
JWT_ALGO=HS256
JWT_TTL=60                      # Token expira en 60 minutos
JWT_REFRESH_TTL=20160           # Refresh token expira en 2 semanas
JWT_BLACKLIST_ENABLED=true
```

## 🔐 Autenticación JWT

El backend usa JWT (JSON Web Tokens) para autenticación:

1. **Registro**: `POST /api/register` - Crea usuario y devuelve token
2. **Login**: `POST /api/login` - Autentica y devuelve token
3. **Uso**: Incluir token en header: `Authorization: Bearer {token}`
4. **Refresh**: `POST /api/refresh` - Obtener nuevo token
5. **Logout**: `POST /api/logout` - Invalidar token actual

### Ejemplo de uso:
```bash
# Login
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"user@example.com","password":"password"}'

# Usar token en request protegido
curl -X GET http://localhost:8000/api/me \
  -H "Authorization: Bearer {tu-token-jwt}"
```

## 🎯 Características Implementadas

1. ✅ Dockerización completa del stack
2. ✅ Autenticación JWT en el backend
3. ✅ Validaciones de login con mensajes de error
4. ✅ Frontend Vue.js 3 con Vite
5. ✅ Base de datos PostgreSQL 16
6. ✅ Cache con Redis 7
7. ✅ CORS configurado

## 🎯 Próximos Pasos

1. Implementar estado global con Pinia
2. Agregar tests E2E con Cypress
3. Configurar CI/CD con GitHub Actions
4. Implementar WebSockets con Laravel Broadcasting

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## 🔧 Troubleshooting

### Docker Build Network Issues

If you encounter network connectivity errors during Docker build (e.g., "Could not resolve host: github.com"), see [DOCKER_BUILD_FIX.md](./DOCKER_BUILD_FIX.md) for detailed solutions.

**Quick fixes**:
1. Build with host network: `docker-compose build --build-arg BUILDKIT_INLINE_CACHE=1`
2. Check Docker has internet access: `docker run --rm alpine ping -c 4 google.com`
3. Try building with BuildKit: `DOCKER_BUILDKIT=1 docker-compose build`
4. If all else fails, install dependencies locally first:
   ```bash
   cd backend && composer install --no-dev
   ```

### Common Issues

**Port Already in Use**:
```bash
# Check what's using the port
sudo lsof -i :8000
# Kill the process or change the port in docker-compose.yml
```

**Database Connection Errors**:
```bash
# Ensure database is running
docker-compose ps postgres
# Check database logs
docker-compose logs postgres
```

**Permission Errors**:
```bash
# Fix storage permissions
docker-compose exec backend chmod -R 775 storage bootstrap/cache
docker-compose exec backend chown -R www-data:www-data storage bootstrap/cache
```

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
