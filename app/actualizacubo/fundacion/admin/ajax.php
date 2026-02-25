<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");					# Fecha en el pasado
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");		# Ultima Modificacion
header("Cache-Control: no-store, no-cache, must-revalidate");		# HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);			# HTTP/1.1
header("Pragma: no-cache");											# HTTP/1.1

require_once "db/requires.php";
//ErrorHandler::SetHandler();

$smarty = new smartyConfig();

//Login
if($_POST['tipo']=='login'){
	require_once CONTENT_DIR . 'login.php';
	$login = new Login();
	$login->init();
}

//Administrador
if($_POST['tipo']=='userAdmin'){
	require_once CONTENT_DIR . 'listAdmin.php';
	$listAdmin = new ListAdmin();
	$listAdmin->init();	
}
 

//Manager IP
if($_POST['tipo']=='managerIp'){
	require_once CONTENT_DIR . 'managerIp.php';
	$managerIp = new ManagerIp();
	$managerIp->init();	
	if(!isset($_POST['method'])){
		$smarty->assign('obj', $managerIp);
		$contenido = $smarty->fetch( TEMPLATE_DIR . 'managerIp.html' );
		echo $contenido;
	}	
}

//Contenido Listado
if($_POST['tipo']=='secciones'){
	require_once CONTENT_DIR . 'secciones.php';
	$secciones = new Secciones();
	$secciones->init();	
}

//Contenido Listado
if($_POST['tipo']=='contenidos'){
	require_once CONTENT_DIR . 'contenidos.php';
	$contenidos = new Contenidos();
	$contenidos->init();	
}

//Contenido Listado
if($_POST['tipo']=='productos'){
	require_once CONTENT_DIR . 'productos.php';
	$productos = new Productos();
	$productos->init();	
}

//Contenido Listado
if($_POST['tipo']=='noticias'){
	require_once CONTENT_DIR . 'noticias.php';
	$noticias = new Noticias();
	$noticias->init();	
}

?>