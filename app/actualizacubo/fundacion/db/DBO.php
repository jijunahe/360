<?php 
if (!defined('PATH_SEPARATOR')) {
    if (defined('DIRECTORY_SEPARATOR') && DIRECTORY_SEPARATOR == "\\") {
        define('PATH_SEPARATOR', ';');
    } else {
        define('PATH_SEPARATOR', ':');
    }
}

$include_path = ini_get("include_path");

//INCLUIMOS PAQUETE DE LIBRERIA PEAR
@ini_set("include_path", $include_path.PATH_SEPARATOR."/var/www/PEAR");
//print_r($_SERVER["DOCUMENT_ROOT"]);
//@ini_set("include_path", $include_path . PATH_SEPARATOR . dirname($_SERVER["DOCUMENT_ROOT"])."/PEAR");
//@ini_set("include_path", $include_path.PATH_SEPARATOR.".../../PEAR");
//echo $_SERVER["DOCUMENT_ROOT"];exit;
require_once("DB.php");
require_once("DB/DataObject.php");

/*LOCAL*/
  
 
//
//SERVER/
$serverdb_link = '162.243.250.47';
$username_link = 'apps';
$password_link = 'j1jun4h3';
$database_link = 'climasas';
/**/

$optionsDataObject = &PEAR::getStaticProperty('DB_DataObject','options');
$optionsDataObject = array(
    'debug'			   => 0, // Permite detallar las consultas que ejecuta, tiene hasta 3 niveles de detalle
    'database'         => "mysql://".$username_link.":".$password_link."@".$serverdb_link."/".$database_link, // Configura la base de datos
    'schema_location'  => '/var/www/hseq/actenc/db',
    'class_location'   => '/var/www/hseq/actenc/db',
    'require_prefix'   => 'db/',
    'class_prefix'     => 'DataObjects_',
	'generator_no_ini' => true); 

?>