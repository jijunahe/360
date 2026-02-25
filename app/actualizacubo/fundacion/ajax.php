<?php
session_start();
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");					# Fecha en el pasado
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");		# Ultima Modificacion
header("Cache-Control: no-store, no-cache, must-revalidate");		# HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);			# HTTP/1.1
header("Pragma: no-cache");											# HTTP/1.1

require_once "db/requires.php";
//ErrorHandler::SetHandler();

$smarty = new smartyConfig();
 //printVar($_SESSION);
if($_POST['tipo']=='usuario'){
	require_once CONTENT_DIR . 'usuario.php';
	$usuario = new Usuario();

	if(!isset($_POST["op"])){
		$usuario->init();
		$smarty->assign('obj', $usuario);
		$contenido = $smarty->fetch( TEMPLATE_DIR . 'usuario.html' );
		echo $contenido;
	}else{
		$_SESSION["option"]=$_POST["op"];
		$usuario->init();
 	}
	
}
if($_POST['tipo']=='actividad'){
	require_once CONTENT_DIR . 'actividad.php';
	$actividad = new Actividad();

	if(isset($_POST["option"])){
		$actividad->init();
		
		//printVar($actividad);
		if(file_exists( TEMPLATE_DIR .$_POST["option"].'.html')){
			$smarty->assign('obj', $actividad);
			$contenido = $smarty->fetch( TEMPLATE_DIR .$_POST["option"].'.html' );
			echo $contenido;
		}
	}else{
		$_SESSION["option"]=$_POST["op"];
		$actividad->init();
 	}
	
}

if($_POST['tipo']=='modal'){

	require_once CONTENT_DIR . 'modal.php';
	$modal = new Modal();
 	$modal->init();
 }

 //printVar($_SESSION);
if($_POST['tipo']=='home'){
	require_once CONTENT_DIR . 'home.php';
	$home = new Home();
	$home->init();
	$smarty->assign('obj', $home);
	$contenido = $smarty->fetch( TEMPLATE_DIR . 'home.html' );
	echo $contenido;	
}
 //printVar($_SESSION);
if($_POST['tipo']=='invitado'){//printVar("entro");
	require_once CONTENT_DIR . 'actividad.php';
	$iunvitado = new Actividad();
	$iunvitado->init();
 	
}

if($_REQUEST['tipo']=='actualizaranking'){
	require_once CONTENT_DIR . 'actualizaranking.php';
 	$Ranking = new Actualizaranking();
	$Ranking->init();

} 





?>
