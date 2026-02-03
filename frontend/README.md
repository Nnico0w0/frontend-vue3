# SBuild Frontend - Gaming Server Hosting Platform

Frontend Vue 3 application for SBuild, a gaming server hosting platform.

## 🎮 Features

- **Home Page**: Landing with features, pricing plans, and game server information
- **Authentication**: Login and registration pages with validation
- **User Dashboard**: Complete server management interface
  - View and manage game servers
  - Create new servers
  - Monitor billing and usage
  - Account settings
- **Admin Dashboard**: Administrative control panel
  - User management
  - Server monitoring
  - System statistics
  - Platform configuration

## 🛠 Tech Stack

- **Vue 3**: Composition API
- **Vue Router 4**: Client-side routing
- **Tailwind CSS 4**: Utility-first styling
- **Vite 7**: Build tool and dev server
- **Axios**: HTTP client

## 📋 Prerequisites

- Node.js 20+
- npm or yarn

## 🚀 Quick Start

### Development

```bash
# Install dependencies
npm install

# Start dev server
npm run dev

# Access at http://localhost:3000
```

### Production Build

```bash
# Build for production
npm run build

# Preview production build
npm run preview
```

### Docker

```bash
# Build and run with Docker
docker build -t sbuild-frontend .
docker run -p 3000:3000 sbuild-frontend

# Or use docker-compose
docker-compose up frontend
```

## 🔑 Demo Credentials

### User Account
- **Email**: user@sbuild.com
- **Password**: password123
- **Access**: User dashboard with server management

### Admin Account
- **Email**: admin@sbuild.com
- **Password**: admin123
- **Access**: Admin dashboard with full system control

## 📁 Project Structure

```
frontend/
├── resources/
│   ├── js/
│   │   ├── components/
│   │   │   └── layout/
│   │   │       ├── Navbar.vue
│   │   │       └── Footer.vue
│   │   ├── views/
│   │   │   ├── Home.vue
│   │   │   ├── Login.vue
│   │   │   ├── Register.vue
│   │   │   ├── DashboardUser.vue
│   │   │   └── DashboardAdmin.vue
│   │   ├── router/
│   │   │   └── index.js
│   │   └── app.js
│   └── css/
│       └── app.css
├── index.html
├── vite.config.js
├── package.json
└── Dockerfile
```

## 🎨 Pages Overview

### Public Pages
- `/` - Home page with platform information
- `/login` - User authentication
- `/register` - New account creation

### User Pages (Protected)
- `/dashboard` - User dashboard overview
  - Tabs: Overview, My Servers, Create Server, Billing, Settings

### Admin Pages (Protected, Admin Role)
- `/admin/dashboard` - Admin control panel
  - Tabs: Dashboard, Users, Servers, Statistics, Settings

## 🔗 Backend Integration

This frontend is designed to work with the Laravel backend in the `../backend` directory.

### API Endpoints (Ready for Integration)
```javascript
// Authentication
POST /api/auth/login
POST /api/auth/register
POST /api/auth/logout

// User Servers
GET /api/servers
POST /api/servers
PUT /api/servers/:id
DELETE /api/servers/:id
POST /api/servers/:id/start
POST /api/servers/:id/stop

// Admin
GET /api/admin/users
GET /api/admin/servers
GET /api/admin/statistics
```

### Environment Configuration

Create a `.env` file:
```env
VITE_API_BASE_URL=http://localhost:8000
```

## 🎯 Supported Game Servers

- 🎮 Minecraft
- 🔫 CS:GO
- 🦀 Rust
- 🏰 ARK: Survival Evolved
- ⚔️ Valheim
- And more...

## 📦 Available Plans

### Starter - $9.99/month
- 2GB RAM
- 20GB NVMe SSD
- Up to 20 players
- Daily backups
- DDoS protection

### Pro - $19.99/month
- 4GB RAM
- 50GB NVMe SSD
- Up to 50 players
- 12h backups
- Premium DDoS protection
- Priority support

### Enterprise - $39.99/month
- 8GB RAM
- 100GB NVMe SSD
- Unlimited players
- Real-time backups
- Enterprise DDoS protection
- Dedicated IP
- Account manager

## 🔐 Authentication Flow

1. User enters credentials on login page
2. Frontend sends request to backend API
3. Backend validates and returns JWT token
4. Token stored in localStorage
5. Router guards check authentication on protected routes
6. User redirected to appropriate dashboard based on role

## 🧪 Testing

```bash
# Run linter
npm run lint

# Run tests (when implemented)
npm run test
```

## 🐳 Docker

### Development
```bash
docker-compose -f docker-compose.dev.yml up frontend
```

### Production
```bash
docker-compose up frontend
```

## 📝 Notes

- Currently using demo authentication for testing
- Replace with actual API integration for production
- All forms include validation
- Mobile-responsive design
- Optimized for performance

## 🤝 Contributing

1. Create feature branch
2. Make changes
3. Test thoroughly
4. Submit pull request

## 📄 License

MIT License - see LICENSE file for details
