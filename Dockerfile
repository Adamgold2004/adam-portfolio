FROM wordpress:cli AS wpcli
FROM wordpress:php8.3-apache

COPY --from=wpcli /usr/local/bin/wp /usr/local/bin/wp
COPY designs-ng-theme/ /opt/designs-ng-theme/
COPY deploy/wait-for-db.php /opt/deploy/wait-for-db.php
RUN mv /usr/local/bin/apache2-foreground /usr/local/bin/apache2-foreground-upstream
COPY --chmod=755 deploy/start.sh /usr/local/bin/apache2-foreground

# The official entrypoint prepares WordPress and its environment-based config,
# then invokes our bootstrap before Apache accepts public requests.
CMD ["apache2-foreground"]
