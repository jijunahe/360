-- Usuario evaluacion360 con acceso desde cualquier host (%) y permisos completos
-- Incluye tablas, vistas (p. ej. Ana_view*) y rutinas en 360_produccion
GRANT ALL PRIVILEGES ON `360_produccion`.* TO 'evaluacion360'@'%' IDENTIFIED BY 'evaluacion360_secret' WITH GRANT OPTION;
FLUSH PRIVILEGES;
