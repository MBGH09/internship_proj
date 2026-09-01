#!/bin/sh
set -e

echo "=============================="
echo " Event Planner — Starting up"
echo "=============================="

cd /var/www/html

# Wait for MySQL to be ready (extra safety net in addition to healthcheck)
echo "→ Waiting for database connection..."
until php artisan db:show > /dev/null 2>&1; do
    echo "  Database not ready yet — retrying in 2s..."
    sleep 2
done
echo "  Database connection OK."

# Run migrations automatically
echo "→ Running migrations..."
php artisan migrate --force

# Optimise the application for production
echo "→ Optimising application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

echo "→ Launching services via Supervisor..."
exec /usr/bin/supervisord -n -c /etc/supervisor/conf.d/supervisord.conf
