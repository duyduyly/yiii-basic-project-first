#!/usr/bin/env sh
set -eu

APP_ENV="${APP_ENV:-web}"

case "$APP_ENV" in
  web|admin) ;;
  *)
    echo "[entrypoint] APP_ENV must be 'web' or 'admin', got: $APP_ENV" >&2
    exit 1
    ;;
esac

DOCROOT="/var/www/html/apps/${APP_ENV}/web"
if [ ! -d "$DOCROOT" ]; then
  echo "[entrypoint] Missing document root: $DOCROOT" >&2
  exit 1
fi

cat > /etc/apache2/sites-available/000-default.conf <<EOF
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot ${DOCROOT}

    <Directory ${DOCROOT}>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^ index.php [L]

    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF

if [ ! -f /var/www/html/vendor/autoload.php ] || [ ! -d /var/www/html/vendor/bower-asset/jquery/dist ]; then
  echo "[entrypoint] vendor assets missing. Running composer install..."
  composer install --working-dir=/var/www/html --no-interaction --prefer-dist
fi

exec "$@"
