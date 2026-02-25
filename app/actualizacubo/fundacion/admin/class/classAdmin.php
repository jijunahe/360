<?php
class Admin{
	/**
     * Determina la longitud de la sal para utilizar en contrasenas desmenuzadas
     *
     * @var int the length of the password salt to use
    */
	private $_saltLength = 7;
	
	//Función para saber si el usuario está inscrito en la página
	function getAdmin(){
		//DB_DataObject::debugLevel(1);
        $this->login = StripHtml($this->login);
        $this->clave = StripHtml($this->clave);
		
		//Crea una nueva instancia de Usuario a partir de DataObject
		$userAdminDBO = DB_DataObject::Factory('Admin');
		
		$userAdminDBO->login  = $this->login;
		//$userAdminDBO->clave  = $this->clave;
		
		$userAdminDBO->find();
		$campos = $userAdminDBO->table();
		$contador = 0;
		
		while ($userAdminDBO->fetch()) {
            foreach ($campos as $key => $value) {
                $user[$contador]->$key = cambiaParaEnvio($userAdminDBO->$key);
            }
            $contador++;
        }		
		
		/*
         * Obtener el hash de la contrasena proporcionada por el usuario
         */
		 
		 //printVar($this->clave);
		// printVar($user[0]->clave);
        $hash = $this->_getSaltedHash($this->clave, $user[0]->clave);
		
		if($user[0]->clave == $hash){			
		 //if(true){			
			$_SESSION['adminUser'] = array(
										'id' => $user[0]->id,
										'perfil' => $user[0]->idPerfil,
										'login' => $user[0]->login,
										'nombre' => $user[0]->nombre,
										'email' => $user[0]->email
									 );
			$ret = true;
		}else{
			$ret = false;
		}
		//Libera el objeto DBO
		$userAdminDBO->free();		
		
		return ($ret);
	}		
	
	//Inserta en la base de datos
	function addUsuario(){
		//DB_DataObject::debugLevel(1);
		//Crea una nueva instancia de Usuario a partir de DataObject
		$usuarioDBO = DB_DataObject::Factory('Admin');
		
		$campos = $usuarioDBO->table();
		
		//Asigna los valores
		foreach($campos as $key => $value){
			if($key != "id" && $key != "fechaReg"){
				$usuarioDBO->$key = $this->$key;
			}
		}
		
		//Inserta el registro en la base de datos
		$usuarioDBO->insert();

		//Libera el objeto DBO
		$usuarioDBO->free();

		return (true);
	}
	
	//Valida User de Usuario
	function validateLogin(){
		//DB_DataObject::debugLevel(1);
        $this->login = StripHtml($this->login);
        $this->email = StripHtml($this->email);
		
		//Crea una nueva instancia de Usuario a partir de DataObject
		$usuarioDBO = DB_DataObject::Factory('Admin');
		
		$campos = $usuarioDBO->table();
		
		//Si necesitamos algun condicional	
		$where = "(login = '".$this->login."' OR email = '".$this->email."')";
		if($this->id!=NULL){
			$where .=  " AND id != '".$this->id."'";
		}
		$usuarioDBO->whereAdd($where);
		
		$total = $usuarioDBO->count();
		
		$usuarioDBO->find();
		if($usuarioDBO->fetch()){
			//Asigna los valores
			foreach($campos as $key => $value){
				$ret->$key = cambiaParaEnvio($usuarioDBO->$key);
			}
		}else{
			$ret = false;
		}
		
		//Libera el objeto DBO
		$usuarioDBO->free();
		
		return $total;
	}
	
	/**
     * Cierra la sesion del usuario
     *
     * @param variables: array asociativo con accion, valores uname y pword
     * @return mezclado TRUE si tiene exito o mensanje en caso de fallo
     */
    public function processLogout() {
        /*
         * Elimina usuario array de la sesion actual
         */
        session_destroy();
        return true;
    }

    /**
     * Genera un hash con sal a una cadena de suministro
     *
     * @param string $string que se aplica un algoritmo hash
     * @param string $salt extraer el hash a partir de aqu�
     * @return string el hash con sal
     */
    public function _getSaltedHash($string, $salt=NULL) {
        /*
         * Generar una sal sin sal, si se pasa
         */
        if ($salt == NULL) {
            $salt = substr(md5(time()), 0, $this->_saltLength);
        }

        /*
         * Extraer la sal de la cadena si se pasa una
         */ else {
            $salt = substr($salt, 0, $this->_saltLength);
        }

        /*
         * Anadir la sal a el hash y devolverlo
         */
        return $salt . sha1($salt . $string);
    }

    public function testSaltedHash($string, $salt=NULL) {
        return $this->_getSaltedHash($string, $salt);
    }	
}
?>