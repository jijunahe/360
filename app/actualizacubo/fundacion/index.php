<?php
//@ini_set("display_errors","1");
//error_reporting(E_ALL);
require_once "db/requires.php";

// Manejador de errores
//ErrorHandler::SetHandler();
//Carga la configuracion de Smarty
$smarty = new smartyConfig();
//echo $_SESSION['login'].'pajaro'; 

  
require_once CONTENT_DIR . "master.php";

?>