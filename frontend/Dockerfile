# Dockerfile para el frontend Vue.js
FROM node:20-alpine

# Establecer directorio de trabajo
WORKDIR /app

# Instalar dependencias del sistema necesarias
RUN apk add --no-cache git

# Copiar archivos de package.json
COPY package*.json ./

# Instalar dependencias
RUN npm install

# Copiar el resto de los archivos
COPY . .

# Exponer puerto
EXPOSE 8080

# Comando para desarrollo
CMD ["npm", "run", "serve", "--", "--host", "0.0.0.0", "--port", "8080"]