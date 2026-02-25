<?php
ini_set('session.gc_maxlifetime', 2000000);
ini_set('session.cookie_lifetime', 2000000);
 $prefijo="";
 // error_reporting(E_ALL);
 // ini_set('display_errors', '1');
 function regenerateDataObject()
{
    require_once 'DB/DataObject/Generator.php';
    $generator = new DB_DataObject_Generator;
    $generator->start();
}

//regenerateDataObject();	
 
 
 
include( DB_DIR . "requires.ini.php" );
 


  
 require_once CONTENT_DIR .'home5.php'; 
require_once CLASS_DIR . "class.General.inc.php";  //clase de usuario
clearstatcache();
//INICIALIZAMOS VARIBLES DE CONTENIDOS	
$content = "";

$urlSite = Build('');
 
//DEFINIMOS VARIABLES PARA LINKS





 
$title = "Encuestas";



 
$objClass = new Home();
$objClass->init();
 
 
 
$smarty->assign('obj', $objClass);
if(file_exists( CONTENT_DIR .'templates/home.html'  )){
$fileInclude = $smarty->fetch( TEMPLATE_DIR . 'home.html' );

}else{
	$fileInclude="El contenido no existe";

}



//Asignamos valores a variables smarty para mostrar
$smarty->assign('fileInclude', $fileInclude);
$smarty->assign('title', $title);
if ($fileInclude !== false) {
    //Mostramos la plantilla principal
	$smarty->display('master.html');
}


	//printVar($_REQUEST["set"]);exit;




?>