<?php
session_start();
	 header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');
  // @ini_set("display_errors","1");
 // error_reporting(E_ALL);
	// CARPETA PRINCIPAL DEL SITIO
	define('SITE_ROOT', dirname(dirname(__FILE__)));
	define('SERVER_ROOT',"/var/www");
	// DEFINIMOS VARIABLES CON LAS DIFERENTES RUTAS DE DIRECTORIOS
	define('CONTENT_DIR', SITE_ROOT . '/content/');
	define('CLASS_DIR', SITE_ROOT . '/class/');
	define('DB_DIR', SITE_ROOT . '/db/');
	define('SMARTY_DIR', SERVER_ROOT . '/Smarty/libs/'); //LOCAL
	//define('SMARTY_DIR', SITE_ROOT . './../Smarty/libs/'); //SERVER	
	define('TEMPLATE_DIR', CONTENT_DIR . 'templates/');
	define('COMPILE_DIR', CONTENT_DIR . 'templates_c/');	
	define('LIBS_DIR', SITE_ROOT. '/libs/');
	// Utilizar SSL si o no
	define('USE_SSL', 'si');
	// Puerto por defecto del servidor HTTP
	define('HTTP_SERVER_PORT', '80');
	//Directorio donde se encuentra la aplicacion
	define('VIRTUAL_LOCATION', '/fbapprb/yeii/');	//SERVER
	
 
	
	define('serverdb_link', '162.243.250.47');	//SERVER
	define('username_link', 'apps');	//SERVER
	define('password_link', 'j1jun4h3');	//SERVER
	define('database_link', 'climasas');	//SERVER
	//define('VIRTUAL_LOCATION', '/facebook/nestle/colmena/publication/');
		
		
	define('SUFIJO', 'lime');/*SIFIJO PARA VARIABLES DE SECION*/
	define('PREFIJO_TABLAS',"lime");/*PREFIJO PARA LAS TABLAS*/
 
  	
	// VARIABLES DE DESARROLLO
	define('IS_WARNING_FATAL', false);
	define('DEBUGGING', false);
	// TIPOS DE ERRORES QUE SE REPORTARAN
	define('ERROR_TYPES', E_ALL);
	//INCLUIMOS CLASE PARA MANEJO DE ERRORES
	//require_once CLASS_DIR . "error_handler.php";	
	//INCLUIMOS ARCHIVO DE CONFIGURACION A DB
	require_once DB_DIR . "DBO.php";
	//INCLUIMOS ARCHIVO DE CONFIGURACION A SMARTY
	require_once CLASS_DIR . "smartyConfig.php";
	//INCLUIMOS ARCHIVO DE FUNCIONES CREADAS
	require_once CLASS_DIR . "functionsCustom.php";
	//INCLUIMOS CLASES FACEBOOK
	//require_once CLASS_DIR . "classFacebook.php";
	
	//require_once LIBS_DIR . "facebook-php/facebook.php";	
		
?>