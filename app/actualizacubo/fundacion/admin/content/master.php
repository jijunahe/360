<?php
//INICIALIZAMOS VARIBLES DE CONTENIDOS	
$content = "";
$fileView = NULL;
$urlSite = Build('');

//DEFINIMOS VARIABLES PARA LINKS
$smarty->assign('urlSite', $urlSite);
$seccion = "";
$title = "Administración Nestle Colmena";

//Header
$header = includeFile($smarty, "header");
$smarty->assign('header', $header);

//Menu Principal
$menuLeft = includeFile($smarty, "menuLeft");
//Asignamos valores a variables smarty para mostrar
$smarty->assign('menuLeft', $menuLeft);
if (isset($_SESSION['adminUser'])) {
    if (isset($_GET['seccion'])) {
	
	    switch($_GET['seccion']){
			
			/*<case>*///Seccion de Perfiles de Administradores
			case "listAdmin":
				$fileView = "listAdmin";
				$seccion = "Administradores";
			break;
			/*</case>*/
			/*<case>*///Seccion de LOGOS
			case "secciones":
				$fileView = "secciones";
				$seccion = "secciones";
			break;
			/*</case>*/
			case "contenidos":
				$fileView = "contenidos";
				$seccion = "contenidos";
			break;
			/*</case>*/
			 
			/*</case>*/
			case "productos":
				$fileView = "productos";
				$seccion = "productos";
			break;
			/*</case>*/
			 
			case "noticias":
				$fileView = "noticias";
				$seccion = "noticias";
			break;
			/*</case>*/
			 
 
			default:
				$fileView = "home";
				$seccion = "Inicio";
		}

    } else {
        $fileView = "home";
        $seccion = "Inicio";
    }
//En caso de no haber Usuario Logueado Mostrar Login
} else {
    $fileView = "login";
}
 
//Contenido
$fileInclude = includeFile($smarty, $fileView);
//Asignamos valores a variables smarty para mostrar
$smarty->assign('fileView', $fileView);
$smarty->assign('fileInclude', $fileInclude);
$smarty->assign('title', $title);
$smarty->assign('seccion', $seccion);


if ($fileInclude !== false) {
    //Mostramos la plantilla principal
    $smarty->display('master.html');
}
?>