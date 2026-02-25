<?php
class Sitios
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
	
}
?>