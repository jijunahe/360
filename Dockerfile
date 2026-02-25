# Evaluación 360 - Yii 1 / LimeSurvey - PHP 5.3.10
# Basado en Ubuntu 12.04 (última con PHP 5.3.10 en repos)
FROM ubuntu:12.04

# Repos EOL para Ubuntu 12.04
RUN sed -i 's|archive.ubuntu.com|old-releases.ubuntu.com|g' /etc/apt/sources.list \
    && sed -i 's|security.ubuntu.com|old-releases.ubuntu.com|g' /etc/apt/sources.list

RUN apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y \
        apache2 \
        libapache2-mod-php5 \
        php5-mysql \
        php5-gd \
        php5-curl \
        php5-mcrypt \
        php5-cli \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# DocumentRoot = app (directorio principal del proyecto)
# En Ubuntu 12.04 el default es DocumentRoot /var/www (sin html)
RUN sed -ri -e 's|DocumentRoot\s+/var/www|DocumentRoot /var/www/html/app|' /etc/apache2/sites-available/default \
    && sed -ri -e 's|<Directory\s+/var/www/>|<Directory /var/www/html/app/>|' /etc/apache2/sites-available/default

# Permitir .htaccess
RUN sed -i '/<Directory \/var\/www\/html\/app\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/sites-available/default

# Directorios escribibles (DERROTERO: tmp y upload)
RUN mkdir -p /var/www/html/app/tmp/runtime /var/www/html/app/tmp/assets /var/www/html/app/upload \
    && chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2ctl", "-D", "FOREGROUND"]
