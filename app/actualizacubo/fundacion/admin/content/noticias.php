<?php

class Noticias {
    public $DBObject = "ismoProductos";
    public $modo = "listado";
    public $mPagination = NULL;
    public $mPage = 1;
    public $mCantidad = 10;
    public $mLista = NULL;
	public $mTextSearch = "";

    public function __construct() {        
		require( DB_DIR . "db.".PREFIJO_TABLAS."Seccion.php" );
 		require( DB_DIR . "db.".PREFIJO_TABLAS."Noticias.php" );
         require_once CLASS_DIR . "classAdmin.php";  //clase de usuario
         
    }
    public function init() {
		if(!isset($_POST["tipo"])){
		 $this->noticias=General::getTotalDatos(PREFIJO_TABLAS."Noticias"); 
  		}else{
			switch($_POST["opcion"]){
				case "Actualizar":
					$set=new General();
					$array=array("titulo"=>utf8_encode($_POST["titulo"]),"texto"=>$_POST["texto"],
								"visible"=>$_POST["visible"],"descripcion"=>utf8_encode($_POST["descripcion"]),"autor"=>utf8_encode($_POST["autor"]));
  					$res=$set->updateData(PREFIJO_TABLAS."Noticias",array("id"=> $_POST["id"]),$array);
					if($res){
  						echo "ok";
					}else{ echo "no";}
				break;
			
				case "Elimina":
					$set=new General();
 					$res=$set->unSetInstancia(PREFIJO_TABLAS."Noticias",$_POST["id"]);
					if($res){
 						echo "ok";
					}else{ echo "no";}
				break;
				case "Agregar":
					$set=new General();
 					$set->titulo=utf8_encode($_POST["titulo"]);
 					$set->visible=$_POST["visible"];
					$set->texto=utf8_encode($_POST["texto"]);
					$set->descripcion=utf8_encode($_POST["descripcion"]);
					$set->autor=$_POST["autor"];
    					$res=$set->setInstancia(PREFIJO_TABLAS."Noticias");
					if($res){
   						echo "ok";
					}else{ echo "no";}
				break;
 			}
 		
		}		 
    }
}

?>