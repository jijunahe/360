<?php

class listAdmin {

    public $DBObject = "Admin";
    public $modo = "listado";
    public $mPagination = NULL;
    public $mPage = 1;
    public $mCantidad = 10;
    public $mLista = NULL;
	public $mTextSearch = "";
	public $mErrorMessage = "";

    public function __construct() {        
		require( DB_DIR . "db.admin.php" );
		require( DB_DIR . "db.adminPerfil.php" );        
        require_once CLASS_DIR . "classAdmin.php";  //clase de usuario
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
        $classAdmin = new Admin();
		$classGeneral = new General();
		
		
		if (isset($_POST['type'])) {
			//Editamos Datos de Formulario
            if ($_POST['type'] == 'editar') {
				//Obtenemos detalle de Usuario
				$mDetalle = $classGeneral->getInstancia($this->DBObject, array('id'=>StripHtml($_POST['itemId'])));
				//Validamos que el Usuario concuerde con la session Iniciada
				if($mDetalle->id!=$_SESSION['adminUser']['id'] && $_SESSION['adminUser']['perfil']!=1){
					echo "Error, Intentelo mas tarde.";
					exit();
				}
				
				//Encrictamos Contraseñas
				$oldPass = $classAdmin->_getSaltedHash(StripHtml($_POST['oldPass']), $mDetalle->clave);
				$newPass = $classAdmin->_getSaltedHash(StripHtml($_POST['newPass']));
				
				//Validamos Contraseñan Antigua
				if($mDetalle->clave != $oldPass){
					echo "Su antigua clave no coincide.";
					exit();
				}
				
				//Reasignamos Variables para validar
				$classAdmin->id = $_POST['itemId'];
				$classAdmin->login = $_POST['login'];
				$classAdmin->email = $_POST['email'];
				$mValidateUser = $classAdmin->validateLogin();
				
				//Verificamos que no haya ningun Usuario con el mismo usuarion y email ya registrado
				if($mValidateUser==0){
					//Actualizamos los Datos					
					$stateAccion = $classGeneral->updateInstancia($this->DBObject, array('id' => StripHtml($_POST['itemId']), 'nombre' => StripHtml($_POST['nombre']), 'login' => StripHtml($_POST['login']), 'email' => StripHtml($_POST['email']), 'perfil' => StripHtml($_POST['perfil']), 'clave' => $newPass, 'email' => StripHtml($_POST['email'])));
					if ($stateAccion == 0 || $stateAccion == 1) {
						echo "Ok";
						$_SESSION['mErrorMessage'] = "Item Guardado.";
					}else{
						echo "Ocurrio un error, intentelo mas tarde.";
					}
				}
				
				exit();	
            }
			
			//Agregamos Nuevo Usuario
			if ($_POST['type'] == 'agregar') {
				
				//Encrictamos Contraseña
				$newPass = $classAdmin->_getSaltedHash(StripHtml($_POST['newPass']));
				
				//Reasignamos Variables para Agregar USuario
				$classAdmin->id = NULL;				
				$classAdmin->login = $_POST['login'];
				$classAdmin->email = $_POST['email'];
				$classAdmin->nombre = $_POST['nombre'];
				$classAdmin->perfil = $_POST['perfil'];
				$classAdmin->clave = $newPass;
				$mValidateUser = $classAdmin->validateLogin();
				
				//Verificamos que no haya ningun Usuario con el mismo usuarion y email ya registrado
				if($mValidateUser==0){
					//Insertamos los Datos
					$stateAccion = $classAdmin->addUsuario();
					if ($stateAccion == 0 || $stateAccion == 1) {
						echo "Ok";
						$_SESSION['mErrorMessage'] = "Item Guardado.";
					}else{
						echo "Ocurrio un error, intentelo mas tarde.";
					}
				}else{
					echo "El usuario o email ya se encuentran registrados.";
				}
				
				exit();	
            }
        }
		
		//Lista Perfiles de Admin
		$this->mListPerfil = $classGeneral->getRowInstancia('AdminPerfil');
		
        //Traemos datos de detalle
        if ($this->modo == "ver") {
            //Obtenemos Listado de Campos de la tabla
            $this->mDetalle = $classGeneral->getInstancia($this->DBObject, array('id'=>$_GET['item']));
            $this->mDetalle->perfilName = $classGeneral->getInstancia('AdminPerfil', array('id'=>$this->mDetalle->perfil), 'perfil');
			$this->mDetalle = Obj2ArrRecursivo($this->mDetalle);

            //Listamos los enumciados de cada campo a mostrar segun orden de los campos de la tabla

            //Eliminamos Registro
        } elseif ($this->modo == "editar") {
            //Obtenemos Listado de Campos de la tabla
            $this->mDetalle = $classGeneral->getInstancia($this->DBObject, array('id'=>$_GET['item']));
            $this->mDetalle = Obj2ArrRecursivo($this->mDetalle);
        
		//Eliminamos Registro
		} elseif ($this->modo == "eliminar"){
			$classGeneral->unSetInstancia($this->DBObject, $_GET['item']);
			echo "<script>alert('Item Eliminado'); location.href = '".str_replace("amp;", "", Seccion($_GET['seccion'], 'listado', 0, $this->mPage, $this->mTextSearch))."'</script>";
			
		//Traemos datos para el listado
		} elseif ($this->modo == "listado"){
			
			$where = "";
			if($this->mTextSearch!=""){
				$where = " login LIKE '%".utf8_decode($this->mTextSearch)."%' 
				OR nombre LIKE '%".utf8_decode($this->mTextSearch)."%' 
				OR email LIKE '%".utf8_decode($this->mTextSearch)."%'";
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
				$key->perfilName = $classGeneral->getInstancia('AdminPerfil', array('id'=>$key->idPerfil), 'perfil');
				$key->linkEditar = Seccion($_GET['seccion'], 'editar', $key->id, $this->mPage);
				$key->linkVer = Seccion($_GET['seccion'], 'ver', $key->id, $this->mPage);
				$key->linkEliminar = Seccion($_GET['seccion'], 'eliminar', $key->id, $this->mPage);
			}	
		}   
    }
}

?>