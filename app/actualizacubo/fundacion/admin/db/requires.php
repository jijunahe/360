<?php
	//PERMITIR SESSIONES
	session_start();
	//MOSTRAR ERRORES
	//@ini_set("display_errors","1");
	//error_reporting(E_ALL);
	
	global $prefijo;
	$prefijo = "../";
	
	if (!defined('PATH_SEPARATOR')) {
		if (defined('DIRECTORY_SEPARATOR') && DIRECTORY_SEPARATOR == "\\") {
			define('PATH_SEPARATOR', ';');
		} else {
			define('PATH_SEPARATOR', ':');
		}
	}
	
	$include_path = ini_get("include_path");	
	@ini_set("include_path", $include_path . PATH_SEPARATOR . $_SERVER["DOCUMENT_ROOT"]."/Smarty");
	require("libs/Smarty.class.php");
	
	//CARPETA PRINCIPAL DEL SITIO
	define('SITE_ROOT', dirname(dirname(__FILE__)));
	define('SERVER_ROOT',$_SERVER['DOCUMENT_ROOT']);
	//DEFINIMOS VARIABLES CON LAS DIFERENTES RUTAS DE DIRECTORIOS
	define('CONTENT_DIR', SITE_ROOT . '/content/');
	define('CLASS_DIR', SITE_ROOT . '/class/');
	define('DB_DIR', $prefijo. 'db/');
	//define('SMARTY_DIR', SITE_ROOT . '/Smarty/libs/');	
	define('TEMPLATE_DIR', CONTENT_DIR . 'templates/');
	define('COMPILE_DIR', CONTENT_DIR . 'templates_c/');	
	define('LIBS_DIR', SITE_ROOT. '/libs/');
	
	// Utilizar SSL si o no
	define('USE_SSL', 'no');
	// Puerto por defecto del servidor HTTP
	define('HTTP_SERVER_PORT', '80');
	//Directorio donde se encuentra la aplicacion
	define('VIRTUAL_LOCATION', '/coomeva/e-commerce/publication/e-admin/');
		
	// VARIABLES DE DESARROLLO
	define('IS_WARNING_FATAL', true);
	define('DEBUGGING', true);
	// TIPOS DE ERRORES QUE SE REPORTARAN
	define('ERROR_TYPES', E_ALL);


		
	define('SUFIJO', 'ismo');/*SIFIJO PARA VARIABLES DE SECION*/
	define('PREFIJO_TABLAS',"ismo");/*PREFIJO PARA LAS TABLAS*/
 

	
	
	//INCLUIMOS CLASE PARA MANEJO DE ERRORES
	require_once CLASS_DIR . "error_handler.php";	
	//INCLUIMOS ARCHIVO DE CONFIGURACION A DB
	require_once DB_DIR . "DBO.php";
	//INCLUIMOS ARCHIVO PARA AUTORIZACION IP
	require_once DB_DIR . "db.managerIp.php";
	//INCLUIMOS ARCHIVO DB GENERAL
	require_once CLASS_DIR . "classGeneralInc.php";  //clase general
	//INCLUIMOS ARCHIVO DE CONFIGURACION A SMARTY
	require_once CLASS_DIR . "smartyConfig.php";
	//INCLUIMOS ARCHIVO DE FUNCIONES CREADAS
	require_once CLASS_DIR . "functionsCustom.php";	
		
?>