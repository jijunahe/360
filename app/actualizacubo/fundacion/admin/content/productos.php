<?php

class Productos {
    public $DBObject = "ismoProductos";
    public $modo = "listado";
    public $mPagination = NULL;
    public $mPage = 1;
    public $mCantidad = 10;
    public $mLista = NULL;
	public $mTextSearch = "";

    public function __construct() {        
		require( DB_DIR . "db.".PREFIJO_TABLAS."Seccion.php" );
		require( DB_DIR . "db.".PREFIJO_TABLAS."Productos.php" );
		require( DB_DIR . "db.".PREFIJO_TABLAS."Categoriaxproducto.php" );
         require_once CLASS_DIR . "classAdmin.php";  //clase de usuario
         
    }
    public function init() {
		if(!isset($_POST["tipo"])){
		 $this->productos=General::getTotalDatos(PREFIJO_TABLAS."Productos"); 
		 $this->categorias=General::getTotalDatos(PREFIJO_TABLAS."Categoriaxproducto"); 
 		}else{
			switch($_POST["opcion"]){
				case "Actualizar":
					$set=new General();
					$array=array("titulo"=>utf8_encode($_POST["titulo"]),"texto"=>$_POST["texto"],
								"visible"=>$_POST["visible"],"descripcion"=>utf8_encode($_POST["descripcion"]),"img"=>$_POST["img"],"idCategoria"=>(Int)$_POST["idCategoria"]);
  					$res=$set->updateData(PREFIJO_TABLAS."Productos",array("id"=> $_POST["id"]),$array);
					if($res){
  						echo "ok";
					}else{ echo "no";}
				break;
			
				case "Elimina":
					$set=new General();
 					$res=$set->unSetInstancia(PREFIJO_TABLAS."Productos",$_POST["id"]);
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
					$set->img=$_POST["img"];
					$set->idCategoria=(Int)$_POST["idCategoria"];
   					$res=$set->setInstancia(PREFIJO_TABLAS."Productos");
					if($res){
   						echo "ok";
					}else{ echo "no";}
				break;
 			}
 		
		}		 
    }
}

?>