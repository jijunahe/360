<?php
require_once "db/requires.php";

//Autorizacion IP
$currentIP = $_SERVER['REMOTE_ADDR']; 
$classGeneral = new General();
$rowIp = $classGeneral->getRowInstancia('ManagerIp');

$ipAutorized = false;
if($rowIp){
	foreach($rowIp as $key => $value){
		if($value->ip==$currentIP){
			$ipAutorized = true;
		}
	}
}

if($ipAutorized==false){
	echo "Acceso no Autorizado.";
	unset($_SESSION);
	session_unset();
	exit();
}
//Fin Autorizacion IP

// Manejador de errores
//ErrorHandler::SetHandler();
//Carga la configuracion de Smarty
$smarty = new smartyConfig();

require_once CONTENT_DIR . "master.php";

?>