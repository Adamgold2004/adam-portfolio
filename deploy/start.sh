#!/usr/bin/env bash
set -Eeuo pipefail

cd /var/www/html
: "${WORDPRESS_DB_HOST:?Database host is required}"
: "${WORDPRESS_ADMIN_EMAIL:?Set the WordPress administrator email in Render}"
: "${WORDPRESS_ADMIN_PASSWORD:?An initial administrator password is required}"
site_url="${WORDPRESS_SITE_URL:-${RENDER_EXTERNAL_URL:-}}"
: "${site_url:?Render external URL or WORDPRESS_SITE_URL is required}"

# wp-content lives on a disk. Refresh the theme from this deployment's image.
mkdir -p wp-content/themes/designs-ng-theme
cp -a /opt/designs-ng-theme/. wp-content/themes/designs-ng-theme/
chown -R www-data:www-data wp-content/themes/designs-ng-theme

php /opt/deploy/wait-for-db.php

if ! wp --allow-root core is-installed; then
    # Supply the password over stdin, keeping it out of command arguments/logs.
    printf '%s\n' "$WORDPRESS_ADMIN_PASSWORD" | wp --allow-root core install \
        --url="$site_url" \
        --title="Adam Studio" \
        --admin_user="${WORDPRESS_ADMIN_USER:-studio-admin}" \
        --admin_email="$WORDPRESS_ADMIN_EMAIL" \
        --skip-email \
        --prompt=admin_password
fi

wp --allow-root theme activate designs-ng-theme
# The theme's init hook seeds its pages, projects, team and services once.
wp --allow-root rewrite structure '/%postname%/' --hard
chown www-data:www-data .htaccess

exec apache2-foreground-upstream
