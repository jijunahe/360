<?php

class Contenidos {
    public $DBObject = "ismoContenido";
    public $modo = "listado";
    public $mPagination = NULL;
    public $mPage = 1;
    public $mCantidad = 10;
    public $mLista = NULL;
	public $mTextSearch = "";

    public function __construct() {        
		require( DB_DIR . "db.".PREFIJO_TABLAS."Seccion.php" );
		require( DB_DIR . "db.".PREFIJO_TABLAS."Contenido.php" );
		require( DB_DIR . "db.".PREFIJO_TABLAS."Secxcont.php" );
        require_once CLASS_DIR . "classAdmin.php";  //clase de usuario
         
    }
    public function init() {
		if(!isset($_POST["tipo"])){
		 $this->contenidos=General::getTotalDatos(PREFIJO_TABLAS."Contenido"); 
		 $this->secciones=General::getTotalDatos(PREFIJO_TABLAS."Seccion"); 
		}else{
			switch($_POST["opcion"]){
				case "Actualizar":
					$set=new General();
					$array=array("titulo"=>utf8_encode($_POST["titulo"]),"texto"=>$_POST["texto"],
								"visible"=>$_POST["visible"]);
  					$res=$set->updateData(PREFIJO_TABLAS."Contenido",array("id"=> $_POST["id"]),$array);
					if($res){
						if((Int)$_POST["idSeccion"]>0){
							$test=General::getTotalDatos(PREFIJO_TABLAS."Secxcont",array("idSeccion","id")," idSeccion='".(Int)$_POST["idSeccion"]."'");
							$array=array("idContenido"=>$_POST["id"]);
							$res=$set->updateData(PREFIJO_TABLAS."Secxcont",array("id"=> $test[0]->id),$array);
						}
 						echo "ok";
					}else{ echo "no";}
				break;
			
				case "Elimina":
					$set=new General();
 					$res=$set->unSetInstancia(PREFIJO_TABLAS."Contenido",$_POST["id"]);
					if($res){
 						echo "ok";
					}else{ echo "no";}
				break;
				case "Agregar":
					$set=new General();
					$set->titulo=utf8_encode($_POST["titulo"]);
					$set->texto=$_POST["texto"];
					$set->visible=$_POST["visible"];
 					$res=$set->setInstancia(PREFIJO_TABLAS."Contenido");
					if($res){
						if((Int)$_POST["idSeccion"]>0){
  							$set->idSeccion=(Int)$_POST["idSeccion"];
							$set->idContenido=(Int)$_POST["id"];
 							$res=$set->setInstancia(PREFIJO_TABLAS."Secxcont");
						}
  						echo "ok";
					}else{ echo "no";}
				break;
 			}
 		
		}		 
    }
}

?>