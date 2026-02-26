#!/bin/bash
set -e

# Directorios escribibles: tmp y upload con permisos 777 (al arrancar, por si el volumen los pisa)
APP=/var/www/html/app
mkdir -p "$APP/tmp/runtime" "$APP/tmp/assets" "$APP/upload"
chmod -R 777 "$APP/tmp" "$APP/upload"

exec apache2ctl -D FOREGROUND
