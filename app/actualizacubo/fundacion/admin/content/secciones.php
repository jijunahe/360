<?php

class Secciones {
    public $DBObject = "ismoSeccion";
    public $modo = "listado";
    public $mPagination = NULL;
    public $mPage = 1;
    public $mCantidad = 10;
    public $mLista = NULL;
	public $mTextSearch = "";

    public function __construct() {        
		require( DB_DIR . "db.".PREFIJO_TABLAS."Seccion.php" );
        require_once CLASS_DIR . "classAdmin.php";  //clase de usuario
         
    }
    public function init() {
		if(!isset($_POST["tipo"])){
		 $this->secciones=General::getTotalDatos(PREFIJO_TABLAS."Seccion"); 
		}else{
			switch($_POST["opcion"]){
				case "Actualizar":
					$set=new General();
					$array=array("titulo"=>utf8_encode($_POST["titulo"]),"idPadre"=>(Int)$_POST["idPadre"],
								"visible"=>$_POST["visible"]);
				 
					$res=$set->updateData(PREFIJO_TABLAS."Seccion",array("id"=> $_POST["id"]),$array);
					if($res){
 						echo "ok";
					}else{ echo "no";}
				break;
			
				case "Elimina":
					$set=new General();
 					$res=$set->unSetInstancia(PREFIJO_TABLAS."Seccion",$_POST["id"]);
					if($res){
 						echo "ok";
					}else{ echo "no";}
				break;
				case "Agregar":
					$set=new General();
					$set->titulo=utf8_encode($_POST["titulo"]);
					$set->idPadre=(Int)$_POST["idPadre"];
					$set->visible=$_POST["visible"];
 					$res=$set->setInstancia(PREFIJO_TABLAS."Seccion");
					if($res){
 						echo "ok";
					}else{ echo "no";}
				break;
 			}
 		
		}		 
    }
}

?>