<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|    'connectionString' Hostname, database, port and database type for 
|     the connection. Driver example: mysql. Currently supported:
|                 mysql, pgsql, mssql, sqlite, oci
|    'username' The username used to connect to the database
|    'password' The password used to connect to the database
|    'tablePrefix' You can add an optional prefix, which will be added
|                 to the table name when using the Active Record class
|
*/
// Variables de entorno para Docker (si no están definidas se usan valores por defecto)
$dbHost = getenv('DB_HOST') ? getenv('DB_HOST') : '162.243.250.47';
$dbPort = getenv('DB_PORT') ? getenv('DB_PORT') : '3306';
$dbName = getenv('DB_NAME') ? getenv('DB_NAME') : '360_produccion';
$dbUser = getenv('DB_USER') ? getenv('DB_USER') : 'apps';
$dbPassword = getenv('DB_PASSWORD') ? getenv('DB_PASSWORD') : 'j1jun4h3';
 
return array(
 'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
		  'class'=>'system.gii.GiiModule',
		  'password'=>'j1jun4h3',
		   // If removed, Gii defaults to localhost only. Edit carefully to taste.
		  'ipFilters'=>array('*','::1'),
		),
	  ),
	'components' => array(
		'db' => array(
		/*
			'connectionString' => 'mysql:host=mysql.talentracking.com;port=3306;dbname=talentracking_encuestas;',
			'emulatePrepare' => true,
			'username' => 'admin_encuestas',
			'password' => '2923815Host',
			'charset' => 'utf8',
			'tablePrefix' => 'lime_',
		*/	
		  'connectionString' => 'mysql:host='.$dbHost.';port='.$dbPort.';dbname='.$dbName.';',  
 			'emulatePrepare' => true,
			'username' => $dbUser,
			'password' => $dbPassword,
			'charset' => 'utf8',
			'tablePrefix' => 'lime_',
		),
		'request' => array(
            'enableCsrfValidation'=>false,     
            ), 
		// Uncomment the following line if you need table-based sessions
		// 'session' => array (
			// 'class' => 'system.web.CDbHttpSession',
			// 'connectionID' => 'db',
			// 'sessionTableName' => '{{sessions}}',
		// ),
		
		'urlManager' => array(
			'urlFormat' => 'path',
			'rules' => require('routes.php'),
			'showScriptName' => true,  
		),
	
	),
	// Use the following config variable to set modified optional settings copied from config-defaults.php
	'config'=>array(
	// debug: Set this to 1 if you are looking for errors. If you still get no errors after enabling this
	// then please check your error-logs - either in your hosting provider admin panel or in some /logs directory
	// on your webspace.
	// LimeSurvey developers: Set this to 2 to additionally display STRICT PHP error messages and get full access to standard templates
		'debug'=>0,
		'debugsql'=>0 // Set this to 1 to enanble sql logging, only active when debug = 2
	)
);
/* End of file config.php */
/* Location: ./application/config/config.php */