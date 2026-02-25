<?php
class MenuLeft{

	public function __construct(){
		require_once CLASS_DIR . "classAdmin.php";  //clase de usuario
		$this->mLinkLogout = 'index.php?logout';
		$this->menuLinks=array(
								array("link"=>"index.php?seccion=listAdmin","titulo"=>"Usuarios Admin"),
								array("link"=>"index.php?seccion=secciones","titulo"=>"Secciones"),
								array("link"=>"index.php?seccion=contenidos","titulo"=>"Contenidos"),
								array("link"=>"index.php?seccion=productos","titulo"=>"Productos"),
								array("link"=>"index.php?seccion=noticias","titulo"=>"Noticias"),
 								);
	}
	
	public function init(){
		$classAdmin = new Admin();
		if(isset($_GET['logout'])){
			$stateLogout = $classAdmin->processLogout();
			if($stateLogout){
				header("Location:" . $this->mLinkHome);
			}
		}
	}
	
}
?>