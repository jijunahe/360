<?php
class ManagerIp{
	public $DBObject = "ManagerIp";
	public $mLista = NULL;
	
	public function __construct(){
	
	}
	
	public function init(){
		$classGeneral = new General();
		
		if(isset($_POST['method'])){
			//Eliminamos El Item
			if($_POST['method']=="delete"){
				$classGeneral->unSetInstancia($this->DBObject, $_POST['itemId']);
				echo "Ok";
				$_SESSION['mErrorMessage'] = "Item Eliminado.";
			}
			
			//Agregamos un Item
			if($_POST['method']=="add"){
				$classGeneral->ip = $_POST['ip'];
				$classGeneral->resumen = $_POST['resumen'];
				$stateAccion = $classGeneral->setInstancia($this->DBObject);
				if ($stateAccion) {
					echo "Ok";
					$_SESSION['mErrorMessage'] = "Item Guardado.";
				}else{
					echo "Ocurrio un error, intentelo mas tarde.";
				}
			}
		}
						
		//Traemos listado de items por pagina
		$this->mLista = $classGeneral->getRowInstancia($this->DBObject, '', 'id DESC');
		/**/
		
		foreach($this->mLista as $key){				
			//Creamos un nuevo valor
			$key->ip = stripslashes($key->ip);
		}
		/**/
	}
}
?>