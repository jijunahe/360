<?php
 
class PromActividad
{
	/**
	* Función que retorna el id del registro que hace referencia al dia de hoy
	* @return ret: Id de la fecha de hoy
	*/
	function getIdFecha(){
		//DB_DataObject::debugLevel(1);
		//Crea una nueva instancia de PremiosLog a partir de DataObject
		$diaDBO = DB_DataObject::Factory(PREFIJO_TABLAS.'DiaConcurso');
		
    	$campos = $diaDBO->table();
		
		$diaDBO->fecha = date('Y-m-d');		
		$ret=false;
		
		$diaDBO->find();
		if($diaDBO->fetch()){
			//Asigna los valores
			$ret = $diaDBO->id;
		}else{
			$ret = false;
		}				
		
		//Libera el objeto DBO
		$diaDBO->free();
		
		return($ret);
	}
	
	/**
	* Función que retorna el número de registros que hay en el log de un premio dado
	* @return ret: Total de premios entregados
	*/
	function getNumPremiosEnt($idPremio = 0, $where = false){
		//Crea una nueva instancia de PremiosLog a partir de DataObject
		$premiosDBO = DB_DataObject::Factory(PREFIJO_TABLAS.'PremioLog');
		if($where){
			$premiosDBO->whereAdd("fechaReg BETWEEN '".date('Y-m-d')." 00:00:00' AND '".date('Y-m-d')." 23:59:59'");
		}
    	$campos = $premiosDBO->table();
		$premiosDBO->find();
		
		$premiosDBO->idPremio = $idPremio;
		$premios = array();
		$contador = 0;
		$ret=false;
		
		//Trae los registros
		$ret = $premiosDBO->count();
		
		//Libera el objeto DBO
		$premiosDBO->free();
		
		return($ret);
	}
	
	/**
	* Función que retorna todos los premios existentes en base de datos
	* @return ret: Arreglo de clases con los datos completos de los premios (probabilidad, nombre, cantidad)
	*/
	function getTotalPremios(){
		//DB_DataObject::debugLevel(1);
		//Crea una nueva instancia de Premios a partir de DataObject
		$premiosDBO = DB_DataObject::Factory(PREFIJO_TABLAS.'PremioDia');
		
    	$campos = $premiosDBO->table();
		$premiosDBO->idDia = $this->getIdFecha();
		$premios = array();
		$contador = 0;
		$ret=false;
		$ret = $premiosDBO->count();
		//Trae los registros
		$premiosDBO->find();
		
		//printVar($premios);
		
		//Libera el objeto DBO
		$premiosDBO->free();
		
		return($ret);
	}
	
	/**
	* Función que retorna todos los premios existentes en base de datos
	* @return ret: Arreglo de clases con los datos completos de los premios (probabilidad, nombre, cantidad)
	*/
	function getPremios(){
		//DB_DataObject::debugLevel(1);
		//Crea una nueva instancia de Premios a partir de DataObject
		$premiosDBO = DB_DataObject::Factory(PREFIJO_TABLAS.'PremioDia');
					
    	$campos = $premiosDBO->table();
		$premiosDBO->idDia = $this->getIdFecha();
		$premios = array();
		$contador = 0;
		$ret=false;
		
		//Trae los registros
		$premiosDBO->find();
		while($premiosDBO->fetch()){
			$ret = true;
			//Asigna los valores
			foreach($campos as $key => $value){
				$premios[$contador]->$key = $premiosDBO->$key;
			}
			$contador++;
		}
		//printVar($premios);
		
		//Libera el objeto DBO
		$premiosDBO->free();
		if($ret){
			$this->premios = $premios;
			$ret = $premios;
		}
		return($ret);
	}
	
	/**
	* Función que retorna si el usuario es ganador o no y hace toda la gestión correspondiente
	*/
	function getResultado($datosOportunidad){
		//Número aleatorio para la probabilidad
		$num1 = mt_rand(0, 32767)/32767;
		
		//Trae todos los premios existentes en base de datos
		$premios = $this->getPremios();
		//Total de premios
		$totalPremios = $this->getTotalPremios();
		$probAcumulada = 0;
		$keyIdPremio = 0;
		$idPremio = 0;
		for($i=0;$i<$totalPremios;$i++){
			$probPremioActual = $premios[$i]->probabilidad;
			//El número aleatorio se encuentra dentro del rango del premio actual
			if($probAcumulada < $num1){
				$probAcumulada += $probPremioActual;
				if($num1 <= $probAcumulada){
					$_SESSION['probAcumulada'] = $probAcumulada;
					//Se guarda el id del premio
					$idPremio = $premios[$i]->idPremio;
					$keyIdPremio = $i;
				}
			}
		}
		
		
		
		
		$loPremio = false;
		$ret = 0;
		
		//Se revisa el número de premios entregados
		$numPremiosEntregadosHoy = $this->getNumPremiosEnt($idPremio, true);
		$numPremiosEntregados = $this->getNumPremiosEnt($idPremio);
		if($totalPremios>0){			
			//Si aún no se han entregado todos los premios presupuestados
			$resUsuario=General::getTotalDatos(PREFIJO_TABLAS.'PremioResultado',""," idPremio=".$idPremio." and idUsuario=".$datosOportunidad->idUsuario." and idPremio<>".ID_PREMIO_MASOPS);
			//VERIFICACION DE EL ESTADO DE LA MANCHA, DEBE ESTAR EN  'N'  PARA PODER JUGAR
			$Mancha=General::getTotalDatos(PREFIJO_TABLAS.'Manchaxtextura',""," codigoMancha='".$_POST["codigoMancha"]."' and utilizado='N'");
  			if($numPremiosEntregadosHoy < $premios[$keyIdPremio]->cantidad && $idPremio!=0 && !isset($resUsuario[0]->idPremio) && isset($Mancha[0]->id) and !isset($LogMancha[0]->id)){
				
				//Crea una nueva instancia de TweetLogPremio a partir de DataObject
				$logDBO = DB_DataObject::Factory(PREFIJO_TABLAS.'PremioLog');
				
				$logDBO->idPremio = $idPremio;
				$logDBO->consecutivo = $numPremiosEntregados + 1;
				//$logDBO->fechaReg = date("Y-m-d H:i:s");
				
				//Se intenta insertar en el log del premio
				$idEntrega = $logDBO->insert();
				
				$logDBO->free();
				if($idEntrega === 0){
					//En caso de NO lograr la inserción, NO se premia al usuario
					$loPremio = false;
				}else{
					//En caso de lograr la inserción, se premia al usuario
					$loPremio = true;
				}
				//DB_DataObject::debugLevel(1);
				
				//printVar($resUsuario);exit;
				if($loPremio ){
					//Crea una nueva instancia de PremiosResultado a partir de DataObject
					$promCodActDBO = DB_DataObject::Factory(PREFIJO_TABLAS.'PremioResultado');
					
					$promCodActDBO->idOportunidad = $datosOportunidad->id;
					$promCodActDBO->idPremio = $idPremio;
					$promCodActDBO->idUsuario = $datosOportunidad->idUsuario;
					//$promCodActDBO->fechaReg = date("Y-m-d H:i:s");
					
					$promCodActDBO->insert();
					
					$promCodActDBO->free();
					
					$ret = $idPremio;
				}else{
					$ret = 0;
				}
				
			}else{
				$ret = 0;
			}
			/*ACTUALIZACION DE EL ESTADO DE LA MANCHA*/
			
			$stateAccion = General::updateData(PREFIJO_TABLAS.'Manchaxtextura', array('codigoMancha' => (String)$_POST["codigoMancha"]), array('utilizado' => 'S', 'fechaConsumo' => date('Y-m-d H:i:s')));
			
			if($stateAccion){
				$classGeneral=new General();
				$classGeneral->idUsuario = $datosOportunidad->idUsuario;
				$classGeneral->idMancha =$Mancha[0]->idMancha;
				$classGeneral->codigoMancha =$Mancha[0]->codigoMancha;
				$classGeneral->fecha =date('Y-m-d H:i:s');
				$insert = $classGeneral->setInstancia(PREFIJO_TABLAS.'Logmanchaxusuario');
			}
		}
		/*LIVERAMOS EL ARCHIVO DE CONTROL */
 		$ruta_file=SITE_ROOT."/boofer/".$_POST["codigoMancha"].".dat";
		if(file_exists($ruta_file)){
		   @unlink($ruta_file);
		}
 		return ($ret);
	}
}
?>