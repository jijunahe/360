# Evaluación 360 – Docker

Proyecto Yii 1 / LimeSurvey con **PHP 5.3.10** y **MySQL 5.5**, según `DERROTERO.inf`.

## Requisitos

- Docker y Docker Compose instalados.

## Pasos para levantar el proyecto

### 1. Construir y levantar los contenedores

```bash
docker compose build
docker compose up -d db web
```

Espera unos 20–30 segundos a que MySQL esté listo (healthcheck).

### 2. Importar la base de datos (solo la primera vez)

El dump `360.2020.10.24.sql` es grande (~137 MB). La importación se hace con un contenedor auxiliar:

```bash
docker compose run --rm initdb
```

Puede tardar varios minutos. Al terminar, la base `360_produccion` quedará cargada.

### 3. Permisos de escritura (tmp y upload)

Según el DERROTERO, la aplicación necesita escribir en `tmp` y `upload`:

```bash
mkdir -p app/tmp/runtime app/tmp/assets app/upload
chmod -R 775 app/tmp app/upload
```

En Docker, el usuario del servidor suele ser `www-data`. Si ves errores de permisos al usar la app:

```bash
docker compose exec web chown -R www-data:www-data /var/www/html/app/tmp /var/www/html/app/upload
```

### 4. Acceder a la aplicación

- **Web:** http://localhost:8081/app/  
  (o la URL que redirija a `/admin` / login según tu `index.php`).
- **MySQL:** `localhost:3308` (puerto 3308 en el host para no chocar con MySQL/MariaDB local)  
  - Usuario: `evaluacion360`  
  - Contraseña: `evaluacion360_secret`  
  - Base de datos: `360_produccion`  
  - Root: `root` / `root_secret`

## Variables de entorno (contenedor `web`)

La conexión a la base se configura por variables de entorno (definidas en `docker-compose.yml`):

| Variable     | Valor por defecto en Docker |
|-------------|-----------------------------|
| `DB_HOST`   | `db`                        |
| `DB_PORT`   | `3306`                     |
| `DB_NAME`   | `360_produccion`           |
| `DB_USER`   | `evaluacion360`            |
| `DB_PASSWORD` | `evaluacion360_secret`   |

Si no se definen (por ejemplo, en producción sin Docker), la aplicación usa los valores que tenía originalmente en `application/config/config.php`.

## Estructura de servicios

- **web:** Apache + PHP 5.3.10 (Ubuntu 12.04), DocumentRoot = `app`.
- **db:** MySQL 5.5, crea la base `360_produccion` y el usuario `evaluacion360` al iniciar.
- **initdb:** Contenedor que se ejecuta una vez para importar `360.2020.10.24.sql` en `360_produccion`.

## Notas

- El servicio **reporte360** (PDF con Composer) no está incluido en este Docker; requiere otra versión de PHP y se puede montar aparte.
- Rutas como `/360/` en `app/index.php` pueden requerir que accedas con un path equivalente (por ejemplo `/app/` o el virtual host que uses).
