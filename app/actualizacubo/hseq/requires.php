<?php 
 	list($ip,$port,$dbname)=explode(";",$aSettings['components']["db"]['connectionString']);	
	$dbname=explode("=",$dbname);	
	$ip=explode("=",$ip);
 	session_start();
	header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');
	define('serverdb_link', $ip[1]);	//SERVER
	define('username_link', $aSettings['components']["db"]['username']);	//SERVER
	define('password_link', $aSettings['components']["db"]['password']);	//SERVER
	define('database_link', $dbname[1]);	//SERVER
	//define('VIRTUAL_LOCATION', '/facebook/nestle/colmena/publication/');
	define('SITE_ROOT', dirname(dirname(__FILE__)));
	define('CLASS_DIR', SITE_ROOT . '/hseq/class/');
	define('CONTENT_DIR', SITE_ROOT . '/hseq/aplication/');
	define('SUFIJO', 'lime');/*SIFIJO PARA VARIABLES DE SECION*/
	define('PREFIJO_TABLAS',"lime_");/*PREFIJO PARA LAS TABLAS*/
	define('PREFIJO_CUBO',"cubo_");/*PREFIJO PARA LAS TABLAS*/
?>