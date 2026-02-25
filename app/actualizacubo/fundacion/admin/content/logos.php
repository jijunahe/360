<?php

class Logos {

    public $DBObject = "mdmLogo";
    public $modo = "listado";
    public $mPagination = NULL;
    public $mPage = 1;
    public $mCantidad = 10;
    public $mLista = NULL;
	public $mTextSearch = "";
	public $mErrorMessage = "";

    public function __construct() {        
		require( DB_DIR . "db.mdmLogo.php" );
		require( DB_DIR . "db.mdmLogoNivel.php" );        
        require_once CLASS_DIR . "classGeneralInc.php";  //clase de usuario
        //Pagina Actual del sitio
        if (isset($_GET['page']) && $_GET['page'] > 1) {
            $this->mPage = $_GET['page']; // $pg es la pagina actual
        }
		
		if(isset($_GET['searchText'])){
			$this->mTextSearch = ($_GET['searchText']);
		}
		
        if (!isset($_GET['seccion'])) {
            $_GET['seccion'] = '';
        }
		
		if(isset($_SESSION['mErrorMessage'])){
			//$this->mErrorMessage = $_SESSION['mErrorMessage'];
			//unset($_SESSION['mErrorMessage']);
		}
		 
        //Links de Agregar y Cancelar
		$this->mLinkAdd = Seccion($_GET['seccion'], 'agregar', 0, $this->mPage);
		$this->mLinkVolver = Seccion($_GET['seccion'], 'listado', 0, $this->mPage);

        if (isset($_GET['modo'])) {
            $this->modo = $_GET['modo'];
        }
		
		$this->mDetalle = NULL;
    }

    public function init() {
		$classGeneral = new General();
		$this->niveles = General::getTotalDatos('mdmLogoNivel');
		 
		if (isset($_POST['type'])) {
			//Editamos Datos de Formulario
            if ($_POST['type'] == 'editar') {
				//Obtenemos detalle
				
				
				$mDetalle = $classGeneral->getInstancia($this->DBObject, array('id'=>StripHtml($_POST['itemId'])));
				
				exit();	
            }
			
			//Agregamos Nuevo
			if ($_POST['type'] == 'agregar') {
 				 
 
 				exit();	
            }
			
			if ($_POST['type'] == 'subirdatos'){
				 $nombre = explode("...",$_POST['nombre']);
				 $nivel  =  explode("...",$_POST['nivel']);
				 $imagen = explode("...",$_POST['imagen']);
				 $count=(count($imagen)-1);
				 //printVar($nombre,$count);
				for($i=1;$i<$count;$i++) {
					if($imagen[$i]!='undefined'){
						$classGeneral->nombre=$nombre[$i];
						$imagenName=explode("temp/",$imagen[$i]);
						
						 if(count($imagenName)==1){
						    $imagenName=explode("logos/",$imagen[$i]);
					    }
						
							if(file_exists($imagen[$i]) and $imagen[$i]!="../images/logos/".$imagenName[1]){ 
							    $guardar = copy($imagen[$i],"../images/logos/".$imagenName[1]);
								
 								unlink($imagen[$i]);
							} 
							
					    if($_POST["update"]==0){
							$classGeneral->archivo=$imagenName[1];
							$classGeneral->idNivel=$nivel[$i];
							$res=$classGeneral->setInstancia($this->DBObject,array('dateReg'));
						}
					    if($_POST["update"]==1){
							$res=General::updateData($this->DBObject,array("id"=>$_POST["id"]), array("nombre"=>$nombre[1],"idNivel"=>$nivel[1],"archivo"=>$imagenName[1]));
						}
						
  					}
				}
				echo $res;
 				exit();	
            }
        }
		
		if ($this->modo == "editar") {
		//printVar($_POST);
            //Obtenemos Listado de Campos de la tabla
            $this->mDetalle = $classGeneral->getInstancia($this->DBObject, array('id'=>$_GET['item']));
            $this->mDetalle = Obj2ArrRecursivo($this->mDetalle);
        
		//Eliminamos Registro
		} elseif ($this->modo == "eliminar"){
			
			
			$classGeneral->unSetInstancia($this->DBObject, $_GET['item']);
			
			//$classGeneral->unSetInstancia($this->DBObject, $_GET['item']);
			
 			echo "<script>alert('Item Eliminado'); location.href = '".str_replace("amp;", "", Seccion($_GET['seccion'], 'listado', 0, $this->mPage, $this->mTextSearch))."'</script>";
			
		//Traemos datos para el listado
		} elseif ($this->modo == "listado"){
			
			$where = "";
			if($this->mTextSearch!=""){
				$where = " nombre LIKE '%".utf8_decode($this->mTextSearch)."%'";
			}
			
			//Total de Registros
			$totalReg = $classGeneral->getTotalInstancia($this->DBObject, $where);
			
			//Obtenemos en un array la paginacion
			$this->mPagination = pagination( $this->mPage, $this->mCantidad, $totalReg, $this->mTextSearch );
			
			//Traemos listado de items por pagina
			$this->mLista = $classGeneral->getRowInstancia($this->DBObject, $where, 'id DESC', $this->mPage, $this->mCantidad);
			
			if($this->mPagination['totalPaginas']<$this->mPage){
				return false;
			}
			
			foreach($this->mLista as $key){				
				//Creamos un nuevo valor
				$key->nombre = stripslashes($key->nombre);
				$key->linkEditar = Seccion($_GET['seccion'], 'editar', $key->id, $this->mPage);
				$key->linkVer = Seccion($_GET['seccion'], 'ver', $key->id, $this->mPage);
				$key->linkEliminar = Seccion($_GET['seccion'], 'eliminar', $key->id, $this->mPage);
			}	
		}   
    }
}

?>