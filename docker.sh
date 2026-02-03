#!/bin/bash

# Scripts de conveniencia para Laravel Vue App Dockerizada

case "$1" in
    "dev")
        echo "🚀 Iniciando modo desarrollo..."
        docker-compose -f docker-compose.dev.yml up --build -d
        echo "✅ Servicios iniciados en modo detached"
        echo "🌐 Frontend: http://localhost:3000"
        echo "🔗 Backend API: http://localhost:8000"
        echo "📊 PostgreSQL: localhost:5432"
        echo ""
        echo "Para ver logs: ./docker.sh logs [servicio]"
        echo "Para detener: ./docker.sh stop"
        ;;
    "prod")
        echo "🏭 Iniciando modo producción..."
        docker-compose up --build -d
        ;;
    "stop")
        echo "🛑 Deteniendo servicios..."
        docker-compose down
        docker-compose -f docker-compose.dev.yml down
        ;;
    "logs")
        if [ -z "$2" ]; then
            docker-compose logs -f
        else
            docker-compose logs -f "$2"
        fi
        ;;
    "backend")
        echo "🔧 Ejecutando comando en backend: ${@:2}"
        docker-compose exec backend "${@:2}"
        ;;
    "frontend")
        echo "🎨 Ejecutando comando en frontend: ${@:2}"
        docker-compose exec frontend "${@:2}"
        ;;
    "migrate")
        echo "📊 Ejecutando migraciones..."
        docker-compose exec backend php artisan migrate
        ;;
    "seed")
        echo "🌱 Ejecutando seeders..."
        docker-compose exec backend php artisan db:seed
        ;;
    "test")
        echo "🧪 Ejecutando tests..."
        docker-compose exec backend php artisan test
        ;;
    "build")
        echo "🏗️ Construyendo frontend para producción..."
        docker-compose exec frontend npm run build
        ;;
    "fresh")
        echo "🧹 Instalación fresca..."
        docker-compose down -v
        docker-compose build --no-cache
        docker-compose up -d
        docker-compose exec backend php artisan key:generate
        docker-compose exec backend php artisan migrate
        ;;
    *)
        echo "📋 Comandos disponibles:"
        echo "  ./docker.sh dev       - Iniciar modo desarrollo"
        echo "  ./docker.sh prod      - Iniciar modo producción"
        echo "  ./docker.sh stop      - Detener servicios"
        echo "  ./docker.sh logs      - Ver logs (agregar nombre de servicio)"
        echo "  ./docker.sh backend   - Ejecutar comando en backend"
        echo "  ./docker.sh frontend  - Ejecutar comando en frontend"
        echo "  ./docker.sh migrate   - Ejecutar migraciones"
        echo "  ./docker.sh seed      - Ejecutar seeders"
        echo "  ./docker.sh test      - Ejecutar tests"
        echo "  ./docker.sh build     - Build de producción"
        echo "  ./docker.sh fresh     - Instalación fresca completa"
        echo ""
        echo "Ejemplos:"
        echo "  ./docker.sh backend php artisan tinker"
        echo "  ./docker.sh frontend npm install"
        echo "  ./docker.sh logs backend"
        ;;
esac