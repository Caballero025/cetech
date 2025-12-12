#!/bin/sh
set -e

echo "=== INICIANDO ENTRYPOINT CETECH ==="

# 1. Cargar secrets
echo "Cargando secrets..."
APP_KEY=$(cat /run/secrets/app_key)
DB_PASSWORD=$(cat /run/secrets/db_password)

echo "APP_KEY: ${APP_KEY:0:20}..."
echo "DB_PASSWORD: cargada"

# 2. Crear .env
echo "Generando archivo .env..."
cat > .env << EOF
APP_NAME="CETech"
APP_ENV=production
APP_KEY="${APP_KEY}"
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=pgsql
DB_HOST=${DB_HOST}
DB_PORT=${DB_PORT}
DB_DATABASE=${DB_DATABASE}
DB_USERNAME=${DB_USERNAME}
REDIS_HOST=${REDIS_HOST}
REDIS_PORT=${REDIS_PORT}


SESSION_DRIVER=redis
REDIS_HOST=${REDIS_HOST}
REDIS_PORT=${REDIS_PORT}

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
LOG_CHANNEL=stderr
EOF

# 3. Configurar permisos
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# 4. Esperar servicios
echo "Esperando base de datos..."
while ! pg_isready -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USERNAME"; do
    sleep 1
done

echo "Esperando Redis..."
while ! redis-cli -h "$REDIS_HOST" -p "$REDIS_PORT" ping | grep -q "PONG"; do
    sleep 1
done

# 5. Configurar Laravel
echo "Configurando Laravel..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

php artisan migrate --force
php artisan db:seed --force

php artisan config:cache
php artisan route:cache
php artisan view:cache

# 6. Iniciar servidor
echo "=== SERVIDOR INICIADO ==="
exec php artisan serve --host=0.0.0.0 --port=8000