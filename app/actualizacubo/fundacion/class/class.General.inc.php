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
			//$ret = $objDBO->id;
			
			$ret = $objDBO->insert();
		} else {
			//$objDBO->fecha = date("Y-m-d H:i:s");
			$ret = $objDBO->insert();
		}
		//printVar($insert);
		//Libera el objeto DBO
		$objDBO->free();
		
		return ($ret);
	}
	
	
	 
	function borrarTabla($id){   //DB_DataObject::debugLevel(1);
		$tableDB = DB_DataObject::Factory("limeCubo");
		 
		$res=$tableDB->query("TRUNCATE  TABLE lime_cubo");
	 
	//	$tableDB->free();
		return $res;
	}  
	 
	function borrarTablanormalizada($id){   //DB_DataObject::debugLevel(1);
		$tableDB = DB_DataObject::Factory("limeNormalizada".$id);
		 
		$res=$tableDB->query("TRUNCATE  TABLE lime_normalizada_".$id);
	 
	//	$tableDB->free();
		return $res;
	}  
	function borrarTabla2($id){   //DB_DataObject::debugLevel(1);
		 
		$tableLIST = DB_DataObject::Factory("limeCubo".$id);
		 
		$res2=$tableLIST->query("TRUNCATE  TABLE lime_cubo_".$id);
	//	$tableDB->free();
		return $res;
	} 	/**	/*ACTUALIZA RANKING*/
	function describeTabla($tabla){
	//DB_DataObject::debugLevel(1);
		$tableDB = DB_DataObject::Factory($tabla);
		
		$selectInner="describe ".$tabla;		
		
		$tableDB->query($selectInner);
 		//$tableDB->free();
		return $tableDB;
	} 	
	
	/**
	* Traemos total de registros de nuestra tabla
	*/
	function getTotalInstancia($tabla,$fields="", $where = ''){
		//DB_DataObject::debugLevel(1);
		$objDBO = DB_DataObject::Factory($tabla);
		
		$campos = $objDBO->table();
		$contador = 0;
		$ret = false;
		
		
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
	function getRowInstancia($tabla, $where = '', $orden = "", $limiteInferior = -1, $limiteSuperior = -1){
		//DB_DataObject::debugLevel(1);
		$objDBO = DB_DataObject::Factory($tabla);
		
		$campos = $objDBO->table();
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
	function getInstancia($tabla,$campo,$where='',$order=''){
		//DB_DataObject::debugLevel(1);
		//Crea una nueva instancia de $tabla a partir de DataObject
		$objDBO = DB_DataObject::Factory($tabla);
		
		$campos = $objDBO->table();
		
		if(is_array($campo)){
			foreach($campo as $key => $value){
				$objDBO->$key = $value;
			}
		}
		
		//Si necesitamos algun condicional
		if($where != ''){
			$objDBO->whereAdd($where);
		}
		
		//Ordenamos segun Parametro
		if($order != ""){
			$objDBO->orderBy($order);
		}
		
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
	* Trae la tupla de la tabla dada
	* @param tabla: Nombre del DBO de la tabla
	* @param campo: arreglo con la dupla campo y valor
	*/
	function getInstancia2($tabla,$campo){
		//DB_DataObject::debugLevel(5);
		//Crea una nueva instancia de $tabla a partir de DataObject
		$objDBO = DB_DataObject::Factory($tabla);
		if(is_array($campo)){
			foreach($campo as $key => $value){
				$objDBO->$key = $value;
			}
		}
		$contador = 0;
		$objDBO->find();
		$columna = $objDBO->table();
		while ($objDBO->fetch()) {
			foreach ($columna as $key => $value) {
				$ret[$contador]->$key = cambiaParaEnvio($objDBO->$key);
			}
			$contador++;
		}
		
		//Libera el objeto DBO
		$objDBO->free();

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
		
		//DB_DataObject::debugLevel(5);
		$ret = $objDBO->delete();
		
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
	
	
function sanear_string($string)
{
	$string = preg_replace('/\s+/', " ", $string);
	$string =str_replace("\r\n", " ", $string);
    $string = trim($string);
    $string = trim($string, "\x00..\x1F");

    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );

    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );

    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );

    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );

    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );

    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C',),
        $string
    );

    //Esta parte se encarga de eliminar cualquier caracter extraño
	
    $string = str_replace(
        array("\\", "¨", "º", "-", "~",
             "#", "@", "|", "!", "\"",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "`", "]",
             "+", "}", "{", "¨", "´",
             ">", "< ", ";", ",", ":",
             "."),
        '',
        $string
    );

	
	$string = preg_replace('/\s+/', " ", $string);
	$string =str_replace("\r\n", " ", $string);
    $string = trim($string);
    $string = trim($string, "\x00..\x1F");

	$string = str_replace(" ","_",$string);
	
    return $string;
}	
	
	
	
	function StripHtml($cadena){
		 // quita tags tipo html
		 $cadena=	strip_tags($cadena); 
		
		 $cadena=str_replace(",", "_",$cadena);
		 $cadena=str_replace(".", "_",$cadena);
		 $cadena=str_replace("(", "",$cadena);
		 $cadena=str_replace(")", "",$cadena);

		 $cadena=str_replace("á", "a",$cadena);
		 $cadena=str_replace("é", "e",$cadena);
		 $cadena=str_replace("í", "i",$cadena);
		 $cadena=str_replace("ó", "o",$cadena);
		 $cadena=str_replace("u", "u",$cadena);
		 $cadena=str_replace("ñ", "n",$cadena);
		 $cadena=str_replace('"', "",$cadena);
		 $cadena=str_replace("'", "",$cadena);
		 $cadena=str_replace("¿", "",$cadena);
		 $cadena=str_replace("?", "",$cadena);
		 $cadena=str_replace("!", "",$cadena);
		 $cadena=str_replace("¡", "",$cadena);
		 $cadena=str_replace(" ", "_",$cadena);
		 
		 return $cadena;
	}	
	
	
	
	function getTotalDatos($table = '',$fields = '',$conditions = '',$orden = '',$limiteInferior = -1,$limiteSuperior = -1,$groupby=""){
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
		//printVar($groupby,"groupby");
		if($groupby != ""){
			$objDBO->groupBy($groupby);
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
	function updateData($tabla, $id, $fields = '')
	{
		//DB_DataObject::debugLevel(1);
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
		
		if($objDBO->fetch()){
			if( is_array($fields) )
			{ 
				foreach($fields as $key => $value) {
					$objDBO->$key=$value;
				}
			}
			$objDBO->fecha = date("Y-m-d H:i:s");
			$objDBO->update();
			$ret = true;
		}else{
			$ret = false;
		}

		//Libera el objeto DBO
		$objDBO->free();

		return ($ret);
	}
}
?>