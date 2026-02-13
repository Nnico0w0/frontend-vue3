# Dockerfile para el backend Laravel
FROM php:8.3-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    libpq-dev \
    sqlite3 \
    libsqlite3-dev \
    nginx \
    supervisor

# Limpiar caché de apt
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP
RUN docker-php-ext-install pdo pdo_pgsql pdo_sqlite zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos de composer primero para aprovechar el cache de Docker
COPY composer.json ./

# Configurar timeout de Composer y preferir dist sobre source
ENV COMPOSER_PROCESS_TIMEOUT=600 \
    COMPOSER_MEMORY_LIMIT=-1

# Instalar dependencias de PHP (esto se cachea si composer.json no cambia)
RUN composer install --no-dev --optimize-autoloader --prefer-dist --no-scripts

# Copiar el resto de archivos del proyecto
COPY . .

# Crear .env si no existe
RUN cp .env.example .env || true

# Generar clave de aplicación si no existe
RUN php artisan key:generate --no-interaction --force || true

# Optimizar configuración para producción
RUN php artisan config:cache || true && \
    php artisan route:cache || true && \
    php artisan view:cache || true

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Configurar nginx
COPY ./docker/nginx.conf /etc/nginx/sites-available/default

# Configurar supervisor
COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Exponer puerto
EXPOSE 80

# Comando de inicio
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]