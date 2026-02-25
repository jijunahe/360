<?php
class General
{
	/**
	* Se crea la tupla en la tabla dada
	* @param tabla: Nombre del DBO de la tabla
	*/
	function setInstancia($tabla, $campoExcluir = NULL){
		//DB_DataObject::debugLevel(1);
		//Crea una nueva instancia de $tabla a partir de DataObject
		$objDBO = DB_DataObject::Factory($tabla);
		
		$campos = $objDBO->table();
		unset($campos["id"]);
		unset($campos["fechaReg"]);
		if ($campoExcluir != NULL) {
			foreach ($campoExcluir as $nombre => $valor) {
				unset($campos[$valor]);
			}
		}
		//Asigna los valores
		foreach($campos as $key => $value){
			$objDBO->$key = utf8_decode($this->$key);
		}
		
		$objDBO->find();
		
		if ($objDBO->fetch()) {
			$ret = $objDBO->id;
		} else {			
			$ret = $objDBO->insert();
		}
		//printVar($insert);
		//Libera el objeto DBO
		$objDBO->free();
		
		return ($ret);
	}
	
	/**
	* Traemos total de registros de nuestra tabla
	*/
	function getTotalInstancia($tabla, $where = ''){
		//DB_DataObject::debugLevel(1);
		$objDBO = DB_DataObject::Factory($tabla);
		
		$campos = $objDBO->table();
		$contador = 0;
		$ret = false;
		
		//Si necesitamos algun condicional
		if($where != ''){
			$objDBO->whereAdd($where);
		}							
		
		$objDBO->find();		
		
		$ret = $objDBO->count();
		
		//Libera el objeto DBO
		$objDBO->free();

		return ($ret);
	}
	
	/**
	* Traemos total de registros de nuestra tabla
	*/
	function getRowInstancia($tabla, $where = '', $orden = "", $limiteInferior = -1, $limiteSuperior = -1, $join = "", $fieldData=NULL){
		//DB_DataObject::debugLevel(1);
		$objDBO = DB_DataObject::Factory($tabla);		
		$campos = $objDBO->table();
		
		$objDBO->selectAdd();
		//Creamos un String para Agregar todos los campos de la tabla
		$rowsSelect = '';
		if(is_array($fieldData)){
			$campos = $fieldData;
		}
		foreach ($campos as $key => $value) {
			$rowsSelect .= $objDBO->__table.'.'.$key.', ';
		}
		
		//Join
		if(is_array($join)){
			foreach($join as $key => $value){
				$var[$key] = DB_DataObject::Factory($value['dbObj']);
				//Separamos cada campo
				$value['rows'] = explode(',', $value['rows']);
				$value['rowsAs'] = explode(',', $value['rowsAs']);
				for($x=0;$x<count($value['rows']);$x++){
					$campos[$value['rowsAs'][$x]] = "";
					$rowsSelect .= $value['As'].'.'.$value['rows'][$x].' AS '.$value['rowsAs'][$x].', ';
				}
				$objDBO->joinAdd($var[$key], $value['type'], $value['As']);
			}
		}
		
		//Agregamos todos los campos de la tabla
		$rowsSelect = substr ($rowsSelect, 0, strlen($rowsSelect) - 2);
		$objDBO->selectAdd($rowsSelect);
				
		$contador = 0;
		$ret = false;
		
		//Si necesitamos algun condicional
		if($where != ''){
			$objDBO->whereAdd($where);
		}
		
		//Ordenamos segun Parametro
		if($orden != ""){
			$objDBO->orderBy($orden);
		}
		
		//Si existe un limit, aumenta en el condicional de la consulta
		if($limiteInferior >= 0){
			$star_item = ($limiteInferior-1)*$limiteSuperior;
			$objDBO->limit($star_item,$limiteSuperior);
			//$this->conteo = $usuarioDBO->count();
		}				
		
		$objDBO->find();
		//Asigna los valores
		while ($objDBO->fetch()) {
			foreach ($campos as $key => $value) {
				$ret[$contador]->$key = utf8_encode(stripslashes($objDBO->$key));
			}
			$contador++;
		}
		
		//printVar($ret);
		
		//Libera el objeto DBO
		$objDBO->free();

		return ($ret);
	}
	
	/**
	* Actualiza la tupla con id dado en la tabla dada
	* @param tabla: Nombre del DBO de la tabla a actualizar
	* @param id: Id del registro a actualizar
	*/
	function updateInstancia($tabla, $fields){
		//DB_DataObject::debugLevel(1);
		//Crea una nueva instancia de $tabla a partir de DataObject
		$objDBO = DB_DataObject::Factory($tabla);
		
		$campos = $objDBO->table();
		$llaves = $objDBO->keys();				
		
		foreach($llaves as $key => $value){
			$objDBO->$value = $fields[$value];	
		}
				
		$objDBO->find();
		if($objDBO->fetch()){
			//Asigna los valores
			if(is_array($fields)){
				foreach($fields as $key => $value){
					$objDBO->$key = $value;
				}
			}
			//print_r($objDBO,'class.General -> $objDBO');
			$ret = $objDBO->update();
		}else{
			if(is_array($fields)){
				foreach($fields as $key => $value){
					$objDBO->$key = $value;
				}
			}
		
			$ret = $objDBO->insert();
			$ret = false;
		}
		//Libera el objeto DBO
		$objDBO->free();
		
		return ($ret);
	}
	
	/**
	* Trae la tupla de la tabla dada
	* @param tabla: Obtenemos los campos de la tabla
	*/
	function getFieldsTable($tabla){
		//DB_DataObject::debugLevel(1);
		//Crea una nueva instancia de $tabla a partir de DataObject
		$objDBO = DB_DataObject::Factory($tabla);
		
		$campos = $objDBO->table();				
		
		$objDBO->find();
		
		//Libera el objeto DBO
		$objDBO->free();
		

		return ($campos);
	}
	
	/**
	* Trae la tupla de la tabla dada
	* @param tabla: Nombre del DBO de la tabla
	* @param campo: arreglo con la dupla campo y valor
	*/
	function getInstancia($tabla,$campoWhere,$campoReturn=""){
		//DB_DataObject::debugLevel(5);
		//Crea una nueva instancia de $tabla a partir de DataObject
		$objDBO = DB_DataObject::Factory($tabla);
		
		$campos = $objDBO->table();
		
		if(is_array($campoWhere)){
			foreach($campoWhere as $key => $value){
				$objDBO->$key = $value;
			}
		}
		
		$objDBO->find();
		if($objDBO->fetch()){
			//Asigna los valores
			foreach($campos as $key => $value){
				$ret->$key = cambiaParaEnvio(htmlentities(stripslashes($objDBO->$key)));
			}
		}else{
			$ret = false;
		}
		
		//Libera el objeto DBO
		$objDBO->free();
		
		if($campoReturn!=""){
			return $ret->$campoReturn;
		}		

		return ($ret);
	}
	
	/**
	* Trae la tupla de la tabla dada
	* @param tabla: Nombre del DBO de la tabla
	* @param campo: arreglo con la dupla campo y valor
	*/
	function getInstanciaWhere($tabla,$campo,$where=""){
		//DB_DataObject::debugLevel(1);
		//Crea una nueva instancia de $tabla a partir de DataObject
		$objDBO = DB_DataObject::Factory($tabla);
		
		//Si necesitamos algun condicional
		if($where != ''){
			$objDBO->whereAdd($where);
		}
		
		$contador = 0;
		$objDBO->find();
		$columna = $objDBO->table();
		$ret = false;
		while ($objDBO->fetch()) {
			foreach ($columna as $key => $value) {
				$ret[$contador]->$key = cambiaParaEnvio($objDBO->$key);
			}
			$contador++;
		}
		
		//Libera el objeto DBO
		$objDBO->free();
		
		if($campo!=""){
			return $ret->$campo;
		}

		return $ret;	
	}
	
	/**
	* Borrar la tupla con id dado en la tabla dada
	* @param tabla: Nombre del DBO de la tabla donde se va a borrar
	* @param id: Id del registro a borrar
	*/
	function unSetInstancia($tabla,$id){
		//Crea una nueva instancia de $tabla a partir de DataObject
		$objDBO = DB_DataObject::Factory($tabla);
			
		$campos = $objDBO->table();
		
		if(strpos($id,',') === false){
			$objDBO->get($id);
		}else{
			$datos = split(',',$id);
			$objDBO->get($datos[0],$datos[1]);
		}
		
		
		$ret = $objDBO->delete();
		
		//Libera el objeto DBO
		$objDBO->free();
		

		return ($ret);
	}
/**
	* Borrar la tupla con id dado en la tabla dada
	* @param tabla: Nombre del DBO de la tabla donde se va a borrar
	* @param id: Id del registro a borrar
	*/
	function unSetWhereAdd($tabla,$query=NULL){
		//Crea una nueva instancia de $tabla a partir de DataObject
		$objDBO = DB_DataObject::Factory($tabla);
			
		
		$objDBO->whereAdd($query);
		$ret=$objDBO->delete(DB_DATAOBJECT_WHEREADD_ONLY);
		
		//Libera el objeto DBO
		$objDBO->free();
		

		return ($ret);
	}

	/**
	* Trae el listado de campos sin id ni fecha
	* @param tabla: Nombre del DBO de la tabla 
	*/
	function getCampos($tabla){
		//DB_DataObject::debugLevel(5);
		//Crea una nueva instancia de $tabla a partir de DataObject
		$objDBO = DB_DataObject::Factory($tabla);
		
		$campos = $objDBO->table();
		
		unset($campos["id"]);
		unset($campos["fecha"]);
		
		//Libera el objeto DBO
		$objDBO->free();
		
		return ($campos);
	}
	
	/**
	* Trae la tupla de la tabla dada
	* @param tabla: Nombre del DBO de la tabla
	* @param id: Id del registro a traer
	*/
	function getInstanciaCampo($tabla,$campo,$dato=''){
		//Crea una nueva instancia de $tabla a partir de DataObject
		$objDBO = DB_DataObject::Factory($tabla);
		
		$campos = $objDBO->table();
		
		$objDBO->$campo = $dato;
		
		$objDBO->find();
		if($objDBO->fetch()){
			//Asigna los valores
			foreach($campos as $key => $value){
				$ret->$key = cambiaParaEnvio($objDBO->$key);
			}
		}else{
			$ret = false;
		}
		
		//Libera el objeto DBO
		$objDBO->free();
		
		return ($ret);
	}
	
	/**
	* 
	* 
	* 
	*/
	function getSelect($table, $output, $params="", $notInField='', $notIn="", $like="") {
		//DB_DataObject::debugLevel(1);
		$objDBO = DB_DataObject::Factory($table);
		if ( $params != '' ) {
			foreach( $params as $field => $value ){
				$objDBO->$field = $value;
			}
		}
		
		if( $notInField != '' && $notIn != '' ){		
			$objDBO->whereAdd("$notInField NOT IN($notIn)");
		}
		
		if ( $like != '' ){
			$index = array_keys($like);
			$valorLike = $like[$index[0]];
			$objDBO->whereAdd("$index[0] like '%$valorLike%'");
		}
		$rows = array();
		$ret = false;

		//Trae los campos de secci�n con id recibido
		$objDBO->find();
		$contador = 0;
		while ( $objDBO->fetch() ) {
			//Asigna los valores
			for ( $i=0;$i<count($output);$i++ ) {
				//$objDBO->id
				$rows[$contador]->$output[$i] = utf8_encode($objDBO->$output[$i]);
			}
			$ret = true;
			$contador++;
		}

		//Free DBO object
		$objDBO->free();
		if($ret){
			$ret = $rows;
		}
		return($ret);
	}
	
	function getTotalDatos($table = '',$fields = '',$conditions = '',$orden = '',$limiteInferior = -1,$limiteSuperior = -1){
		//DB_DataObject::debugLevel(5);
		
		//printVar($table);
		$objDBO = DB_DataObject::Factory($table);
		
		$rows = array();
		$ret=false;
		if(is_array($conditions)){ // como arreglo asociativo
			foreach($conditions as $key => $value){
				$objDBO->$key = $value;
			}
		}else{ // como cadena
			if($conditions != ''){
				$objDBO->whereAdd($conditions);
			}
		}
		
		if(is_array($fields)){
			$objDBO->selectAdd();
			foreach($fields as $key => $value){
				$objDBO->selectAdd($value);
			}
		}else{
			$fields = $objDBO->table();
			foreach($fields as $key => $value){
				$fields[$key] = $key;
			}
			/*printVar($fields);
			$fields = array_flip($fields);
			printVar($fields);*/
		}
		
		//Si existe un limit, aumenta en el condicional de la consulta
		if($limiteInferior >= 0){
			$objDBO->limit($limiteInferior,$limiteSuperior);
			//$this->conteo = $usuarioDBO->count();
		}
		
		if($orden != ""){
			$objDBO->orderBy($orden);
		}
		
		$objDBO->find();
		$cont = 0;
		
		while($objDBO->fetch()){
			//Asigna los valores
			$rows[$cont]->id = $objDBO->id;
			if(is_array($fields)){
				foreach($fields as $key => $value){
					$posCad = strpos($value, "AS");
					if($posCad !== FALSE){
						$value = substr($value,$posCad + 3);
					}
					//$rows[$cont]->$value = cambiaParaEnvio($objDBO->$value);
					$rows[$cont]->$value = $objDBO->$value;
				}
			}
			$cont++;
			$ret = true;
		}
		
		//DB_DataObject::debugLevel(0);
		
		//Free DBO object
		$objDBO->free();
		if($ret){
			$ret = $rows;
		}
		return($ret);
	}
        
        /**
	* Actualiza la tupla con id dado en la tabla dada
	* @param tabla: Nombre del DBO de la tabla a actualizar
	* @param id: Id del registro a actualizar
	*/
	function updateData($tabla, $id, $fields = '',$where="")
	{
		// DB_DataObject::debugLevel(1);
		//Crea una nueva instancia de $tabla a partir de DataObject
		$objDBO = DB_DataObject::Factory($tabla);

		$campos = $objDBO->table();
		unset($campos["id"]);
		unset($campos["password"]);
		unset($campos["fecha"]);
		unset($campos["venta"]);

		//$objDBO->idUsuario = $id;
 
                foreach($id as $key => $value) {
                        $objDBO->$key=$value;
                 }
                
		//Asigna los valores
		$objDBO->find();	
		$ret = false;
		while($objDBO->fetch()){
			if( is_array($fields) )
			{ 
				foreach($fields as $key => $value) {
				if($key!='id'){
					$objDBO->$key=$value;
					}
				}
			}
			$objDBO->fecha = date("Y-m-d H:i:s");
			
			if($where!=""){
			$objDBO->whereAdd($where);
			
			} 
			$objDBO->update();
			 
			
			
			
			$ret = true;
		}
		
		
		//Libera el objeto DBO
		$objDBO->free();

		return ($ret);
	}
}
?>