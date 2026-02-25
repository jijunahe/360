<?php
class Login{

	public function __construct(){
		require( DB_DIR . "db.admin.php" );
		require_once CLASS_DIR . "classAdmin.php";  //clase de usuario
	}
	
	public function init(){
		$classAdmin = new Admin();
		 //printVar($classAdmin->testSaltedHash('admin'));
		if(isset($_POST['usuario']) && isset($_POST['password'])){
			$classAdmin->login = utf8_decode($_POST['usuario']);
			$classAdmin->clave = utf8_decode($_POST['password']);
			$usuarioOk = $classAdmin->getAdmin();
			if($usuarioOk){
				echo 1;
			}else{
				echo 0;
			}
		}
	}
	
}
?>