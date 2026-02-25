-- Ejecutar una vez: cat docker/mysql-init/fix-connections.sql | docker compose exec -T db mysql -u root -proot_secret
-- Crea root@'%', evaluacion360@'%' y admin@'%' (definer de vistas/rutinas del dump)

GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'root_secret' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON `360_produccion`.* TO 'evaluacion360'@'%' IDENTIFIED BY 'evaluacion360_secret' WITH GRANT OPTION;
-- Usuario definer de vistas/rutinas del backup (evita error 1449)
GRANT ALL PRIVILEGES ON `360_produccion`.* TO 'admin'@'%' IDENTIFIED BY 'admin_secret' WITH GRANT OPTION;
FLUSH PRIVILEGES;
