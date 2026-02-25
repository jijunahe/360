<?php //echo "%Daniel";exit;
if (!defined('BASEPATH')) exit('No direct script access allowed');
 // error_reporting(E_ALL); ini_set('display_errors', '1');
$documentroot=str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"]);
//require_once($documentroot.'application/extensions/PHPMailer/class.phpmailer.php');
require_once($documentroot.'application/controllers/admin/reportes.php');
require_once($documentroot.'application/extensions/class_sql_inject.php');
class Evaluacion extends Survey_Common_Action 
{
  	private $kp='93857366asmdmfmm';
 	/*
	private $muestra=10;
  	private $limite=500;
  	private $limitemuestra=1000;
	*/
	private $proyectos=array();
	private $proyectosHeredados=array();
	private $usuarios=array();
	private $usuariosHeredados=array();
	private $creditos=array();
	private $permisos=array();
 	
  	function __construct($controller, $id)
    { 
        parent::__construct($controller, $id);

        Yii::app()->loadHelper('database');
 		$this->kp= $this->kp.substr($this->kp,0,8);  
		$this->validarRole();
    }
	
	private function encrypt($data,$key){
		$mode = MCRYPT_MODE_CBC;
		$algorithm = MCRYPT_3DES;
  		$iv = mcrypt_create_iv(mcrypt_get_iv_size($algorithm, $mode),MCRYPT_DEV_URANDOM);
 		$encrypted_data = mcrypt_encrypt($algorithm, $key, date("Y-m-d")." ".$data." ", $mode, $iv);
		$plain_text = base64_encode($encrypted_data);		
 		return $plain_text;
	}

	private function  decrypt($data,$key){
		$mode = MCRYPT_MODE_CBC;
		$algorithm = MCRYPT_3DES;
		$iv = mcrypt_create_iv(mcrypt_get_iv_size($algorithm, $mode),MCRYPT_DEV_URANDOM);
  		$encrypted_data = base64_decode($data);
		$decoded = mcrypt_decrypt($algorithm, $key, $encrypted_data, $mode, $iv);
		$decoded =trim($decoded);
		$decoded =trim($decoded," ");
		$decoded =trim($decoded,"");
 		$explode=explode(" ",$decoded);
		if(isset($explode[1])){
			unset($explode[0]);
			$explode=join(" ",$explode);
			$decoded=$explode;
		}
  		return $decoded;
 	}	
	
	public function validarRole(){
		$oRecord = User::model()->findByPk(Yii::app()->user->id); 
		$aData=array();
		$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
		$aData=$this->getLanguagetemplates();
		$listaperfiles = AnaRol::model()->findAll();
		$this->usuariosHeredados=array();
		$this->proyectosHeredados=array();
		//AnaRol::model()->validarrol();
		if($dUsuario->perfil==2 or $dUsuario->perfil==1){
 			$dat = new CDbCriteria;
			if($dUsuario->perfil==2){
				$dat->condition = 'uid_creador ="'.Yii::app()->user->id.'"';
			}else{
				$dat->condition = 'id!="1"';
			}
			$this->usuarios=AnaUsuario::model()->findAll($dat);
			if($dUsuario->perfil==2 ){
				foreach($this->usuarios as $dp){
					$dat = new CDbCriteria;
					$dat->condition = 'iduseval ="'.$dp->id.'"';
					$tu=User::model()->find($dat);
					
					$dat = new CDbCriteria;
					$dat->condition = 'uid_creador ="'.$tu->uid.'"';
					$th=AnaUsuario::model()->findAll($dat);
					
					$dat = new CDbCriteria;
					$dat->condition = 'idUsuario ="'.$tu->uid.'"';
					$ph=AnaProyecto::model()->findAll($dat);

					if(isset($th[0])){
						array_push($this->usuariosHeredados,$th);
					}
					if(isset($ph[0])){
						array_push($this->proyectosHeredados,$th);
					}
				}
 			}
			
			$dat = new CDbCriteria;
			$dat->condition = 'idUsuario ="'.Yii::app()->user->id.'" and jsonprivilegios="1"';
			$tPro=AnaEncuestaProyectoxusuario::model()->findAll($dat);
			foreach($tPro as $rpro){
				$dat = new CDbCriteria;
				$dat->condition = 'keyid ="'.$rpro->keyidproyecto.'"';
				$rpro=AnaProyecto::model()->find($dat);
				if(isset($rpro[0])){
					array_push($this->proyectosHeredados,$th);
				}
			}
			
			$dat = new CDbCriteria;
			$dat->condition = 'idUsuario ="'.Yii::app()->user->id.'"';
			$this->proyectos=AnaProyecto::model()->findAll($dat);
			
		}else{
 			$this->usuarios=array();
 			$dat = new CDbCriteria;
			$dat->condition = 'idUsuario ="'.Yii::app()->user->id.'"';
			$this->proyectos=AnaProyecto::model()->findAll($dat);
		}
	}
	
    private function getLanguagetemplates(){
		 $aData=array();
		$idlanguage=1;
		if(isset($_SESSION["language"])){
			$idlanguage=(int)$_SESSION["language"];
			if($idlanguage<1){
				$idlanguage=1;
			}
		}
		$idioma = AnaLanguage::model()->findByPk($idlanguage);
		if(isset($idioma->json)){
			$aData["idioma"]=json_decode($idioma->json);
			$_SESSION["codelang"]=base64_encode($idioma->json);
		}
		$templates = AnaTemplates::model()->findAll();

		$dat=NULL;
		if($idlanguage>0){
			$dat = new CDbCriteria;
			$dat->condition = "idlanguage = ".(int)$idlanguage;
		}
		$template=AnaTemplates::model()->findAll($dat);				
		
		if(isset($template[0])){	
			foreach($template as $data){
				$aData[$data->nombre] =$data->html;
			}
		}
		$aData["idlanguage"]=$idlanguage;	
		
		
		return $aData;
		
	}
	public function generarKey($longitud=7){
		$alpha = "123QWERT4567890ABSDFSDFCDEFGHIJ9876542345KLMNOPQR123765STUVWX789904YZ";
		$code = "";  
 		for($i=0;$i<$longitud;$i++){
			$code .= $alpha[rand(0, strlen($alpha)-1)];
		}
		return $code;		
 	}
	
	public function validarPago($keyid,$tipo,$keyidevaluado=""){ 
		$oRecord = User::model()->findByPk(Yii::app()->user->id); 
 		$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
		$nexq="";
		if($keyidevaluado!=""){$nexq=" and evaluado='".$keyidevaluado."'";}
 		$dat = new CDbCriteria;
		$dat->condition = "idUsuarioOrigen = '".$dUsuario->id."' and keyidproyecto='".$keyid."' and evento='".$tipo."' ".$nexq;
  		$moneda=AnaMonedaFlujo::model()->find($dat);	//printVar($proyecto);exit;
		
		$dat = new CDbCriteria;
		$dat->condition = "keyid = '".$keyid."' ";
		$dat->order="fechacreacion DESC";
		//printVar($dat);exit;
		$proyecto=AnaProyecto::model()->find($dat);
 		
		$mesage=false;
		if(($proyecto->tipoproyecto==2 or $proyecto->tipoproyecto==3) or $keyidevaluado!="" ){
			if(isset($moneda->id)){
				$mesage=true;
			}
		}
		return $mesage;
	}
	public function pagar($keyidproyecto,$tipo,$keyidevaluado=""){
		$oRecord = User::model()->findByPk(Yii::app()->user->id); 
		$aData=array();
		$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
		$dat = new CDbCriteria;
		$dat->condition = "idUsuario = '".Yii::app()->user->id."' and keyid='".$keyidproyecto."'";
		$dat->order="fechacreacion DESC";
		// printVar($dat);exit;
		$proyecto=AnaProyecto::model()->find($dat);

		$dat = new CDbCriteria;
		$dat->condition = "nombre = '".$tipo."'";
		$costo=AnaMonedaProducto::model()->find($dat);
		//printVar($proyecto);
		if(isset($proyecto->keyid) and $this->validarPago($keyidproyecto,$tipo,$keyidevaluado)==false){
			$dat = new CDbCriteria;
			$dat->condition = "idUsuario = ".$dUsuario->id;
			$proyecto=AnaMonedaxusuario::model()->count($dat);	
			 
			if($proyecto>=$costo->costo){  
				$dat = new CDbCriteria;
				$dat->condition = "idUsuario = ".$dUsuario->id;
				$dat->limit=$costo->costo;
				$creditosM=AnaMonedaxusuario::model()->findAll($dat);	
				
				 
				$idmoneda="";
				$contador=0;
				$monedas=array();
				foreach($creditosM as $mo){
					 $idmoneda=$mo->idMoneda;
					$mui=AnaMonedaunitaria::model()->findByPk($mo->idMonedaunitaria);
					  
					if(isset($mui->id)){
						$contador++;
						$mui->asignado='0';
						$mui->save(); 
						array_push($monedas,$mo->idMonedaunitaria);
						$dat = new CDbCriteria;
						$dat->condition = "id = '".$mo->id."'";
						$cmo=AnaMonedaxusuario::model()->find($dat);	
						$cmo->delete();
						 
					}        
				} 				
				$flujo=new AnaMonedaFlujo();
				$flujo->idUsuarioOrigen=$dUsuario->id;
				$flujo->idUsuarioDestino=396;
				$flujo->idMoneda=$idmoneda;
				$flujo->keyidproyecto=$keyidproyecto;
				$flujo->creditos=$contador;
				$flujo->monedas=json_encode($monedas);
				$flujo->evaluado=$keyidevaluado;
				$flujo->evento=$tipo;
				$flujo->fecharegistro=date("Y-m-d H:i:s"); 
				$flujo->{'hash'}=hash('ripemd160',$flujo->idUsuarioOrigen."--".$flujo->idUsuarioDestino.$flujo->idMoneda.$flujo->creditos.$flujo->evento.$flujo->monedas.$flujo->keyidproyecto.$keyidevaluado);
				$flujo->save();
				return true;
				
			}else{
				return false;
			}
			
			
		}else{
			return false;
		}
 	}
 	public function creditos(){
		$oRecord = User::model()->findByPk(Yii::app()->user->id); 
		$aData=array();
		$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
		$dat = new CDbCriteria;
		$dat->condition = "idUsuario = '".Yii::app()->user->id."' and keyid='".$_POST["key"]."'";
		$dat->order="fechacreacion DESC";
		//printVar($dat);exit;
		$proyecto=AnaProyecto::model()->find($dat);	
		if($proyecto->tipoproyecto==2 or $proyecto->tipoproyecto==3){
			if(isset($proyecto->keyid) and $this->validarPago($_POST["key"],'PDF AVANZADO')==false){
				$dat = new CDbCriteria;
				$dat->condition = "idUsuario = '".$dUsuario->id."'";
				$proyecto=AnaMonedaxusuario::model()->count($dat);	
				
				$dat = new CDbCriteria;
				$dat->condition = "nombre = 'PDF AVANZADO'";
				$costo=AnaMonedaProducto::model()->find($dat);	

				 
				if($proyecto>=$costo->costo){
					$dat->limit=$costo->costo;
					$creditosM=AnaMonedaxusuario::model()->findAll($dat);	
					$idmoneda="";
					$contador=0;
					$monedas=array();
					foreach($creditosM as $mo){
						 $idmoneda=$mo->idMoneda;
						$mui=AnaMonedaunitaria::model()->findByPk($mo->id);
						if(isset($mui->id)){
							$contador++;
							$mui->asignado='0';
							$mui->save(); 
							array_push($monedas,$mo->idMonedaunitaria);
							$cmo=AnaMonedaxusuario::model()->findByPk($mo->id);	
							$cmo->delete();
							
						}    
					} 				
					$flujo=new AnaMonedaFlujo();
					$flujo->idUsuarioOrigen=$dUsuario->id;
					$flujo->idUsuarioDestino=396;
					$flujo->idMoneda=$idmoneda;
					$flujo->keyidproyecto=$_POST["key"];
					$flujo->creditos=$contador;
					$flujo->monedas=json_encode($monedas);
					$flujo->evento="Compra reprotes";
					$flujo->fecharegistro=date("Y-m-d H:i:s"); 
					$flujo->{'hash'}=hash('ripemd160',$flujo->idUsuarioOrigen."--".$flujo->idUsuarioDestino.$flujo->idMoneda.$flujo->creditos.$flujo->evento.$flujo->fecharegistro.$flujo->monedas.$flujo->keyidproyecto);
					$flujo->save();
					echo json_encode(array("ok"));  
					
				}
				
				
			}else{
				echo json_encode(array("no"));
			}
		}else{
			echo json_encode(array("ok"));
		}
	}
	public function proyecto(){
		 
 		 Yii::app()->cache->flush();
	   // $this->addEventos("ENtro","ff");
	  
		if(isset(Yii::app()->user->id)){
			if((int)Yii::app()->user->id>0){ 
				if(isset($_POST["save"]) and $this->validarPago($_POST["keyproyecto"],'PDF AVANZADO')==false){
					//CARGA MASIVA DE PARTICIPANTES  CSV
					$urlbase=$_SERVER["DOCUMENT_ROOT"].Yii::app()->baseUrl;
					//comprobamos que sea una petición ajax
					if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
					{
					 
						//obtenemos el archivo a subir
						$file = $_FILES['archivo']['name'];
					 
						//comprobamos si existe un directorio para subir el archivo
						//si no es así, lo creamos
						  
						//comprobamos si el archivo ha subido
						if ($file && move_uploaded_file($_FILES['archivo']['tmp_name'],$urlbase."/files/cargarcsv/".$file))
						{
						   sleep(3);//retrasamos la petición 3 segundos
						  // echo $file;//devolvemos el nombre del archivo para pintar la imagen
						}
					}else{
						throw new Exception("Error Processing Request", 1);   
					}					
					
					$fila = 1;
					$colsname=array();
					if (($gestor = fopen($urlbase."/files/cargarcsv/".$file, "r")) !== FALSE) {	
						$queryString="DESCRIBE {{ana_participante}}";
						$eguresult = dbExecuteAssoc($queryString);
						$res = $eguresult->readAll();
						
						$configkeys=array("apellido","nombre","email","retroalimentacion","edad","genero","antiguedad","ciudad","pais","nivelacademico","estadocivil");
						$dataobject=array();
						$genero=array("M","F");
						$colsname=array();
						$contador=1;
						$estan=array();
						$validarobligatorias=0;
						$sinPabdominal=array();						
						
						
						$errores=array();
						while (($datos = fgetcsv($gestor, 1000, $_POST["delimitador"])) !== FALSE) {
							$cantidad = count($datos);
							for ($c=0; $c < $cantidad; $c++) {
								if($contador==1){
									if(!in_array($datos[$c],$colsname)){
										array_push($colsname,$datos[$c]);
										if(in_array($datos[$c],$configkeys)){
											if(!in_array($datos[$c],$estan)){
												array_push($estan,$datos[$c]);
											}
										}else{
											array_push($errores,"<b>".$datos[$c]."</b> Columna no es válida. Únicamente se permiten los siguientes nombres de columna: edad,nivelacademico,estadocivil,antiguedad,genero,ciudad,pais,retroalimentacion");
										}	
										if(in_array($datos[$c],$obligatorias)){
											$validarobligatorias++;
										}
									}
								}else{
									$dataobject[$contador][$colsname[$c]]=$datos[$c];
								}
							}
							$contador++;
						}	
						$validarusuario=array();
						if(count($errores)>0){
							echo json_encode(array("estado"=>"error","errores"=>$errores));exit;
 						}
						/*
						printVar($validarobligatorias);
						printVar($estan);
						printVar($dataobject);exit;*/
						//printVar($dataobject);exit;
						$existeemail=array();
						foreach($dataobject as $id=>$dataset){
 							$key=$this->generarKey();

							$dat = new CDbCriteria;
							$dat->condition = "email = '".$dataset["email"]."' and keyproyecto='".$_POST["keyproyecto"]."'  ";
							//printVar($dat);exit;
							$existe=AnaParticipante::model()->find($dat);		

							if(!isset($existe->email)){
 								$dat = new CDbCriteria;
								$dat->condition = "keyid = '".$key."'";
								//printVar($dat);exit;
								$verificarkey=AnaParticipante::model()->find($dat);				
								 
								if(isset($verificarkey->{'keyid'})){
									$bandera=false;
									$contador=6;
									while($bandera==false){
										$key=$this->generarKey($contador);
										$dat = new CDbCriteria;
										$dat->condition = "keyid = '".$key."'";
										$verificarkey=AnaParticipante::model()->find($dat);
										if(!isset($verificarkey->{'keyid'})){
											$bandera=true;
										}
										$contador++;
									}
								}   

								$data = new AnaParticipante();
								$data->{'keyid'}=$key;
								$data->keyproyecto=$_POST["keyproyecto"];
								$data->nombre=$dataset["nombre"];
								$data->apellido=$dataset["apellido"];
								$data->email=$dataset["email"];
 								if(isset($dataset["edad"])){
									$data->edad=(int)$dataset["edad"];
								}

								if(isset($dataset["genero"])){
									$data->genero=(int)$dataset["genero"];
								}

								if(isset($dataset["antiguedad"])){
									$data->antiguedad=(int)$dataset["antiguedad"];
								}


								if(isset($dataset["ciudad"])){
									$data->ciudad=$dataset["ciudad"];
								}

								if(isset($dataset["pais"])){
									$data->pais=$dataset["pais"];
								}

								if(isset($dataset["nivelacademico"])){
									$data->nivelacademico=(int)$dataset["nivelacademico"];
								}

								if(isset($dataset["estadocivil"])){
									$data->estadocivil=(int)$dataset["estadocivil"];
								}

								$data->resetpassword='1';
								$data->jsoncompetencias='{}';
								$data->idUsuario=Yii::app()->user->id;
								$data->fecharegistro=date("Y-m-d H:i:s");
								if(isset($dataset["retroalimentacion"])){
									$data->retroalimentacion=$dataset["retroalimentacion"];
								}
								 
								$clave=$this->generarKey(8);
								$data->clave= base64_encode($this->encrypt( $clave,"lindosnenes"));
							 
								//printVar($data);exit; 
								$data->save();							
							}else{
								array_push($existeemail,$existe->email);
								
							}	
 							
							
						}
						
 						echo json_encode(array("estado"=>"ok",$existeemail,"existeemail"=>1));exit;
 
					}
 					exit;
				} 
 				$oRecord = User::model()->findByPk(Yii::app()->user->id); 
				 $aData=array();
				$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
 				$aData=$this->getLanguagetemplates();
 				$listaperfiles = AnaRol::model()->findAll();
				$dat = new CDbCriteria;
				$dat->condition = "idUsuario = '".$dUsuario->id."'";
				$creditos=AnaMonedaxusuario::model()->count($dat);	

 			//	printVar($idioma);
  				$aData["creditosdisponibles"]=$creditos;
  				$aData["usuariomodel"]=$dUsuario;
				$aData["perfilusuarior"]=$dUsuario->perfil;
				$aData["validaini"]="OK";
				$aData["imageurl"]=Yii::app()->baseUrl;
				$aData["mensaje"]="";
				$validaeditar=AnaUsuario::model()->vaidausr(false); 
				$template="nuevo";
				$aData["tipoproyecto"]=AnaEncuestaTipoproyecto::model()->findAll();
				//printVar($aData["tipoproyecto"]);exit;
				$aData["edad"]=AnaTipoedad::model()->findAll();	
				$aData["antiguedad"]=AnaTipoantiguedad::model()->findAll();	
				$aData["ecivil"]=AnaTipoestadocivil::model()->findAll();	
				$aData["nacademico"]=AnaTiponivelacademico::model()->findAll();					
				$aData["genero"]=AnaTipogenero::model()->findAll();	
				
				$dat = new CDbCriteria;
				$dat->condition = "estado='activo'";
				$costo=AnaMonedaProducto::model()->findAll($dat);	
				//printvar($costo[0]->costo);
				$aData["costoproyectoclima"]=$costo[0]->costo;	
				$aData["costoevaluados360"]=$costo[1]->costo;	
				$aData["costoevaluadosequipos"]=$costo[2]->costo;	
				$aData["costoPDFAV"]=$costo[3]->costo;					
				
				
 				if(isset($_GET["mode"])){
					App()->getClientScript()->registerScriptFile(Yii::app()->baseUrl."/scripts/yav1_4_1/js/yav.js");
					App()->getClientScript()->registerScriptFile(Yii::app()->baseUrl."/scripts/yav1_4_1/js/yav-config-es.js");
					App()->getClientScript()->registerScriptFile("https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js");						
 					switch($_GET["mode"]){
						case "nuevo":$template="nuevo"; 
							if((int)Yii::app()->user->id>0 and AnaRol::model()->validarrol(23)==true){      
								 //printVar(123456);								//printVar($_COOKIE);
								if($_COOKIE["key"]!="" and $_COOKIE["key"]!="undefined"){
									//printVar(1111111);
									// printVar($_COOKIE);exit;
									$dat = new CDbCriteria;
									$dat->condition = "idUsuario = '".Yii::app()->user->id."' and keyid='".$_COOKIE["key"]."'";
									$dat->order="fechacreacion DESC";
									 //printVar($dat);exit;
									$proyecto=AnaProyecto::model()->find($dat);	
									if(!isset($proyecto->keyid)){
										$aData["mensaje"]=$aData["idioma"]->denegado;
										$template="ver";
									}
								} 
								$dat = new CDbCriteria;
								$dat->condition = "estado='1' and idUsuario = '".Yii::app()->user->id."'";
								$dat->order="fechacreacion DESC";
								// printVar($dat);exit;
								$proyectos=AnaProyecto::model()->findAll($dat);	
								//$proyectos=AnaEncuesta::model()->findAll($dat); 	
								
								$aData["tproyectos"]=count($proyectos);	
								
 								
								
								$oRecord = User::model()->findByPk(Yii::app()->user->id); 
								//$aData=array();
								$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
								//$aData=$this->getLanguagetemplates();
								$listaperfiles = AnaRol::model()->findAll();
								
								if($oRecord->uid==463 or $dUsuario->perfil==1){		
									$perfiles=array(2,3,4,5,6);
									$paises=AnaPais::model()->findAll();
									$ciudades=AnaCiudad::model()->findAll();
									$regiones=AnaRegion::model()->findAll();
									$empresas=AnaOrganizacion::model()->findAll();//printVar(333444);exit; 
								}
								if( $dUsuario->perfil==2){ 	
									$perfiles=array(3,4,5,6);

									 
									$dat = new CDbCriteria;
									$dat->condition = 'id ="'.$dUsuario->id_pais.'"';
									$paises=AnaPais::model()->findAll($dat);
									 
									 
									$dat = new CDbCriteria;
									$dat->condition = 'id_pais ="'.$dUsuario->id_pais.'"';
									$regiones=AnaRegion::model()->findAll($dat);
									
									$dat = new CDbCriteria;
									$dat->condition = 'id_pais ="'.$dUsuario->id_pais.'"';
									$ciudades=AnaCiudad::model()->findAll($dat);
									 
									$dat = new CDbCriteria;
									$dat->condition = 'id_pais ="'.$dUsuario->id_pais.'"';
									$empresas=AnaOrganizacion::model()->findAll($dat);
									 
								}
								if( $dUsuario->perfil==3){
									$perfiles=array(5,4,6);
									//printVar(1);exit;
									$dat = new CDbCriteria;
									$dat->condition = 'id ="'.$dUsuario->id_pais.'"';
									$paises=AnaPais::model()->findAll($dat);
									
									$dat = new CDbCriteria;
									$dat->condition = 'id_pais ="'.$dUsuario->id_pais.'" and id="'.$dUsuario->id_region.'"';
									$regiones=AnaRegion::model()->findAll($dat);
									
									$dat = new CDbCriteria;
									$dat->condition = 'id_region ="'.$dUsuario->id_region.'" and id="'.$dUsuario->id_ciudad.'"';
									$ciudades=AnaCiudad::model()->findAll($dat);
									
									$dat = new CDbCriteria;
									$dat->condition = 'id_region ="'.$dUsuario->id_region.'" and id_ciudad="'.$dUsuario->id_ciudad.'"';
									$empresas=AnaOrganizacion::model()->findAll($dat);
									 
								}
								if( $dUsuario->perfil==5){ 
									$perfiles=array(4,6);
									
									$dat = new CDbCriteria;
									$dat->condition = 'id ="'.$dUsuario->id_pais.'"';
									$paises=AnaPais::model()->findAll($dat);
									
									$dat = new CDbCriteria;
									$dat->condition = 'id_pais ="'.$dUsuario->id_pais.'" and id="'.$dUsuario->id_region.'"';
									$regiones=AnaRegion::model()->findAll($dat);
									
									$dat = new CDbCriteria;
									$dat->condition = 'id_region ="'.$dUsuario->id_region.'" and id="'.$dUsuario->id_ciudad.'"';
									$ciudades=AnaCiudad::model()->findAll($dat);
									
									$dat = new CDbCriteria;
									$dat->condition = 'id_region ="'.$dUsuario->id_region.'" and id_ciudad="'.$dUsuario->id_ciudad.'"';
									$empresas=AnaOrganizacion::model()->findAll($dat);
									
								}
								
								if( $dUsuario->perfil==4){
									$perfiles=array(6);
									if($dUsuario->id_pais!=NULL){
									$dat = new CDbCriteria;
									$dat->condition = 'id ="'.$dUsuario->id_pais.'"';
									$paises=AnaPais::model()->findAll($dat);
									}
									if($dUsuario->id_pais!=NULL and $dUsuario->id_region!=NULL){
									$dat = new CDbCriteria;
									$dat->condition = 'id_pais ="'.$dUsuario->id_pais.'" and id="'.$dUsuario->id_region.'"';
									$regiones=AnaRegion::model()->findAll($dat);
									}
									if($dUsuario->id_ciudad!=NULL and $dUsuario->id_region!=NULL){
									$dat = new CDbCriteria;
									$dat->condition = 'id_region ="'.$dUsuario->id_region.'" and id="'.$dUsuario->id_ciudad.'"';
									$ciudades=AnaCiudad::model()->findAll($dat);
									}
									if($dUsuario->id_unidad!=NULL ){
									$dat = new CDbCriteria;
									$dat->condition = 'id='.$dUsuario->id_unidad;
									$empresas=AnaOrganizacion::model()->findAll($dat);
									}
								}
								$aData["validapago"]=false;
								if(isset($_COOKIE["key"])){
									$aData["validapago"]=$this->validarPago($_COOKIE["key"],"PDF AVANZADO");
								}
								$aData["paises"]=$paises;
								$aData["regiones"]=$regiones;
								$aData["ciudades"]=$ciudades;
								$aData["empresas"]=$empresas;
								$aData["usuariomodel"]=$dUsuario;
							}				
 
						break;
						case "ver":$template="ver";
							/*$subquery="";
							if(isset($_POST["tipo"])){
								$subquery=" and tipoproyecto=".(int)$_POST["tipo"];
							}
							$dat = new CDbCriteria;
							$dat->condition = "estado='1' and idUsuario = '".Yii::app()->user->id."'".$subquery;
							$dat->order="fechacreacion DESC";
							//printVar($dat);exit;
							//$proyectos=AnaProyecto::model()->findAll($dat);	
							$proyectos=AnaProyecto::model()->findAll($dat);*/
							$proyectos=array();
							$tproyectos=array();
							foreach($this->proyectos as $tpro){
								if(isset($_POST["tipo"])){
									if($tpro->tipoproyecto==(int)$_POST["tipo"]){
										array_push($proyectos,$tpro);
									}
								}else{
									array_push($proyectos,$tpro);
								}
								array_push($tproyectos,$tpro);

							}
							$tipos=AnaEncuestaTipoproyecto::model()->findAll();	
							
							$aData["tipos"]=$tipos;
							$aData["proyectos"]=$proyectos;
							
							if(isset($_POST["tipo"])){
								$rproyectos=array();
								foreach($proyectos as $data){
									$tempo=array();
									foreach($data as $k=>$v){
										$tempo[$k]=$v;
									}
									array_push($rproyectos, $tempo);
								}

								echo json_encode(array("ok",$rproyectos));exit;
							}
								 
							//$proyectos=AnaEncuesta::model()->findAll($dat);	
							$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
							$aData["usuariomodel"]=$dUsuario;
							$aData["tproyectos"]=count($tproyectos);
							//printVar($aData["proyectos"]);
						
 						break;
						case "catalogo":
							$template="catalogo";
														$dat = new CDbCriteria;
								$dat->condition = "estado='1' and idUsuario = '".Yii::app()->user->id."'";
								$dat->order="fechacreacion DESC";
								//printVar($dat);exit;
								$proyectos=AnaProyecto::model()->findAll($dat);	
								//$proyectos=AnaEncuesta::model()->findAll($dat);	
								$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
								$aData["usuariomodel"]=$dUsuario;
								$aData["tproyectos"]=count($proyectos);
							 				
 						break;
						
						
						case "archivos":
							$template="archivos";
 							$archivos=AnaArchivos::model()->findAll();	//printVar($biblioteca);
 							$aData["archivos"]=$archivos;
							$dat = new CDbCriteria;
								$dat->condition = "estado='1' and idUsuario = '".Yii::app()->user->id."'";
								$dat->order="fechacreacion DESC";
								//printVar($dat);exit;
								$proyectos=AnaProyecto::model()->findAll($dat);	
								//$proyectos=AnaEncuesta::model()->findAll($dat);	
								$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
								$aData["usuariomodel"]=$dUsuario;
								$aData["tproyectos"]=count($proyectos);							
 						break;						
 						
						case "guia360":
							$template="guia360";
							$dat = new CDbCriteria;
							$dat->condition = "estado='1' and idUsuario = '".Yii::app()->user->id."'";
							$dat->order="fechacreacion DESC";
							//printVar($dat);exit;
							$proyectos=AnaProyecto::model()->findAll($dat);	
							//$proyectos=AnaEncuesta::model()->findAll($dat);	
							$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
							$aData["usuariomodel"]=$dUsuario;
							$aData["tproyectos"]=count($proyectos);
 							 					
 						break;						
 						
					}
				}
				
				if(isset($_POST["mode"])){
					switch($_POST["mode"]){
						
						case "eliminarproyecto":
						if((int)Yii::app()->user->id>0 and AnaRol::model()->validarrol(19)==true){  

							$dat = new CDbCriteria;
							$dat->condition = "keyid = '".$_POST["keyid"]."'";
							//printVar($dat);exit;
							$pro=AnaProyecto::model()->find($dat);
							if(isset($pro->keyid)){
								$pro->estado="0";
								$pro->save();
								echo json_encode(array("ok"));exit;
							}
							echo json_encode(array("no"));exit;
						}
						break;
						case "ver":
						if((int)Yii::app()->user->id>0 and AnaRol::model()->validarrol(23)==true){  
							//printVar("JAJAJAAJAJAJAJ");
							
							$dat = new CDbCriteria;
							$dat->condition = "keyid = '".$_POST["keyid"]."' and idUsuario = '".Yii::app()->user->id."'";
 							//printVar($dat);exit;
							$proyecto=AnaProyecto::model()->find($dat);	
							
							if(isset($proyecto->keyid)){
								echo json_encode(array("ok",array("keyid"=>$proyecto->keyid,"email"=>$proyecto->email,"nombre"=>$proyecto->nombre,"bienvenida"=>$proyecto->bienvenida,"tipoproyecto"=>$proyecto->tipoproyecto)));exit;
							}else{echo json_encode(array("no"));exit;}							
 						}	
						break;
						case "filtrar":
						if((int)Yii::app()->user->id>0 and AnaRol::model()->validarrol(23)==true){  
							/*$subquery="";
							if(isset($_POST["tipo"])){
								$subquery=" and tipoproyecto=".(int)$_POST["tipo"];
								if((int)$_POST["tipo"]<=0){
									$subquery="";
								}
							}
							$dat = new CDbCriteria;
							$dat->condition = "estado='1' and idUsuario = '".Yii::app()->user->id."'".$subquery;
							$dat->order="fechacreacion DESC";
							//printVar($dat);exit;
							$proyectos=AnaProyecto::model()->findAll($dat);
							*/
							$proyectos=array();
							$tproyectos=array();
							foreach($this->proyectos as $tpro){
								if(isset($_POST["tipo"])){
									if($tpro->tipoproyecto==(int)$_POST["tipo"]){
										array_push($proyectos,$tpro);
									}
								}else{
									array_push($proyectos,$tpro);
								}
								array_push($tproyectos,$tpro);

							}							
							
							
							$tipos=AnaEncuestaTipoproyecto::model()->findAll();	
							
							$aData["tipos"]=$tipos;
							$aData["proyectos"]=$proyectos;
							
							if(isset($_POST["tipo"])){
								$rproyectos=array();
								foreach($proyectos as $data){
									$tempo=array();
									foreach($data as $k=>$v){
										$tempo[$k]=$v;
									}
									array_push($rproyectos, $tempo);
								}

								echo json_encode(array("ok",$rproyectos));exit;
							}
						}
						break;
						case "nuevo":
							if((int)Yii::app()->user->id>0 and AnaRol::model()->validarrol(17)==true){  
								$key=$this->generarKey();
								$tipopago=array("1"=>"360","2"=>"Clima","3"=>"Equipo");
 							//printVar($rpay);exit;
															 
								$dat = new CDbCriteria;
								$dat->condition = "keyid = '".$key."'";
								//printVar($dat);exit;
								$verificarkey=AnaProyecto::model()->find($dat);				
								 
								if(isset($verificarkey->{'keyid'})){
									$bandera=false;
									$contador=6;
									while($bandera==false){
										$key=$this->generarKey($contador);
										$dat = new CDbCriteria;
										$dat->condition = "keyid = '".$key."'";
										$verificarkey=AnaProyecto::model()->find($dat);
										if(!isset($verificarkey->{'keyid'})){
											$bandera=true;
										}
										$contador++;
									}
								}   
												
								$data = new AnaProyecto();
								$data->{'keyid'}=$key;
								$data->nombre=$_POST["nombreproyecto"];
								$data->email=$_POST["emailproyecto"];
								$data->idUsuario=Yii::app()->user->id;
								$data->idUsuarioact=Yii::app()->user->id;
								$data->fechacreacion=date("Y-m-d H:i:s");
								$data->fechaactualizacion=date("Y-m-d H:i:s");
								$data->tipoproyecto=$_POST["tipoproyecto"];
								$data->bienvenida=$_POST["bienvenida"];
								$data->id_pais=(int)$_POST["id_pais"];
								$data->id_region=(int)$_POST["id_region"];
								$data->id_empresa=$_POST["id_empresa"];
								if($_POST["clave"]!=""){
									$data->clave=$_POST["clave"];
								}
								//printVar($data);exit; 
								$data->save();
								
								
								 
								$mailing=AnaBibliotecamailing::model()->findAll();
								foreach($mailing as $datamailing){
									$data = new AnaEmailtemplate();
									$data->keyidproyecto=$key;
									$data->html=$datamailing->html;
									$data->fecha=date("Y-m-d H:i:s");
									$data->nombre=$datamailing->nombre;
									$data->save();
								}/*
								 
	error_reporting(E_ALL);
	ini_set('display_errors', '1'); */

								
								$escalas=AnaBibliotecaescalas::model()->findAll();
								foreach($escalas as $idorden=>$dataescala){
									$keyescala=$this->generarKey();
									 
									$dat = new CDbCriteria;
									$dat->condition = "keyid = '".$keyescala."'";
									//printVar($dat);exit;
									$verificarkey=AnaEncuestaEscala::model()->find($dat);				
									 
									if(isset($verificarkey->{'keyid'})){
										$bandera=false;
										$contador=6;
										while($bandera==false){
											$keyescala=$this->generarKey($contador);
											$dat = new CDbCriteria;
											$dat->condition = "keyid = '".$keyescala."'";
											$verificarkey=AnaEncuestaEscala::model()->find($dat);
											if(!isset($verificarkey->{'keyid'})){
												$bandera=true;
											}
											$contador++;
										}
									}  								
									
									$descriptor=(object)array();
									foreach(json_decode($dataescala->json) as $k=>$json){
										$descriptor->{$k}=$json;
									}
									$data = new AnaEncuestaEscala();
									$data->keyidproyecto=$key;
									$data->keyid=$keyescala;
									$data->fecharegistro=date("Y-m-d H:i:s");
									$data->nombre=$dataescala->nombre;
									$data->rango=$dataescala->rango;
									$data->jsondesccriptor=json_encode($descriptor);
									$data->idorden=$idorden;
									$data->idUsuario=(int)Yii::app()->user->id;
									$data->preguntaescala=$dataescala->preguntabase;
									$data->abreviacion=$dataescala->abreviacion;
									//printVar($data);exit;
									$data->save();
								}
								$idioma=json_decode(base64_decode($_SESSION["codelang"]));
								$relaciontemporal=AnaTempoRelacion::model()->findAll();	
								
								foreach($relaciontemporal as $id=>$datos){
									$dat = new CDbCriteria;
									$dat->condition = "keyproyecto = '".$key."' and idorigen=".$datos->id."";
									//printVar($dat);exit;
									$relxpro=AnaRelacionxproyecto::model()->find($dat);
									
									if(!isset($relxpro->idorigen)){ 
										$keyrel=$this->generarKey();
										$dat = new CDbCriteria;
										$dat->condition = "keyid = '".$keyrel."'";
										$verificarkey=AnaRelacionxproyecto::model()->find($dat);				
										if(isset($verificarkey->{'keyid'})){
											$bandera=false;
											$contador=6;
											while($bandera==false){
												$keyrel=$this->generarKey($contador);
												$dat = new CDbCriteria;
												$dat->condition = "keyid = '".$keyrel."'";
												$verificarkey=AnaRelacionxproyecto::model()->find($dat);
												if(!isset($verificarkey->{'keyid'})){
													$bandera=true;
												}
												$contador++;
											}
										}  								
										
										$set=new AnaRelacionxproyecto();
										$set->keyid=$keyrel;
										$set->nombre=$idioma->{$datos->nombre};
										$set->abreviacion=$datos->abreviado;
										$set->descripcion=$idioma->{$datos->descripcion};
										$set->keyproyecto=$key;
										$set->idUsuario=(int)Yii::app()->user->id;
										$set->idorigen=$datos->id;
										$set->estado="S";
										$set->color="#0000";
										$set->fechacreacion=date("Y-m-d H:i:s");
										$set->save();
									}
								}							
								//$rpay=$this->pagar($key,$tipopago[$_POST["tipoproyecto"]]);
								if($rpay){ 
 									echo json_encode(array("key"=>$key));exit;
								}else{   
									echo json_encode(array("error"=>"No tiene suficientes creditos"));exit;  
								}
							}
						break;
						case "editarproyecto":       
							$dat = new CDbCriteria;
							$dat->condition = "keyid = '".$_POST["key"]."' and idUsuario=".(int)Yii::app()->user->id;
							//printVar($dat);exit;
 							$pro=AnaProyecto::model()->find($dat);//printVar($pro);exit; 	
							if(isset($pro->keyid)){
								$pro->nombre=$_POST["nombreproyecto"];
								$pro->bienvenida=$_POST["bienvenida"];
								$pro->email=$_POST["email"];
								$pro->tipoproyecto=$_POST["tipoproyecto"];
								$pro->clave="123456";
								$pro->id_pais=(int)$_POST["id_pais"];
								$pro->id_region=(int)$_POST["id_region"];
 								$pro->id_empresa=$_POST["id_empresa"];
 								
								$pro->fechaactualizacion=date("Y-m-d H:i:s");
								$pro->idUsuarioact=(int)Yii::app()->user->id;
								$pro->save(); 
								echo json_encode(array("ok"));exit;
							}else{echo json_encode(array("no"));exit;}
						break;
						case "get":
							switch($_POST["get"]){
								/**** COMPETENCIAS ****/
								case "verificarevaluados":
									//printVar($_POST);exit; 
									$participantes=$_POST["participantes"];
									
									$dat = new CDbCriteria;
									$dat->condition = "keyid in ('".join("','",$participantes)."') and retroalimentacion='S'";
									 
 									$parRel=AnaParticipante::model()->findAll($dat);
									$setEvaluados=array();
									foreach($parRel as $indice=>$datac){
										array_push($setEvaluados,$datac->keyid);
										
									}										
								echo json_encode($setEvaluados);exit;
								break;   
								case "aplicarencuesta":
									$dat = new CDbCriteria;
									$dat->condition = "id in (".join(",",$_POST["competencias"]).")";
 									$competencias=AnaEncuestaCompetencia::model()->findAll($dat);//printVar($competencias);//exit; 
									$contador=0;
									foreach($competencias as $k=>$dcom){
										$dat = new CDbCriteria;
										$dat->condition = "keyidproyecto = '".$_POST["keyproyecto"]."' and idOrigen=".$dcom->id;
										//printVar($dat);exit;
										$validar=AnaEncuestaCompetenciaProyecto::model()->find($dat);
										
										if(!isset($validar->idOrigen)){	
											
											$key=$this->generarKey();
											$dat = new CDbCriteria;
											$dat->condition = "keyid = '".$key."'";
											//printVar($dat);exit;
											$verificarkey=AnaEncuestaCompetenciaProyecto::model()->find($dat);

											$dat = new CDbCriteria;
											$dat->condition = "keyidproyecto = '".$_POST["keyproyecto"]."'";
											//printVar($dat);exit;
											$totales=AnaEncuestaCompetenciaProyecto::model()->findAll($dat);				
											$idOrden=count($totales);
											
											if(isset($verificarkey->{'keyid'})){
												$bandera=false;
												$contador=6;
												while($bandera==false){
													$key=$this->generarKey($contador);
													$dat = new CDbCriteria;
													$dat->condition = "keyid = '".$key."'";
													$verificarkey=AnaEncuestaCompetenciaProyecto::model()->find($dat);
													if(!isset($verificarkey->{'keyid'})){
														$bandera=true;
													}
													$contador++;
												}
											} 											
											$set = new AnaEncuestaCompetenciaProyecto();
											$set->keyid=$key;
											$set->nombre_esp=$dcom->nombre_esp;
											$set->descripcion_esp=$dcom->descripcion_esp;
											$set->idUsuario=(int)Yii::app()->user->id;
											$set->fecharegistro=date("Y-m-d H:i:s");
											$set->keyidproyecto=$_POST["keyproyecto"];
											$set->idOrigen=$dcom->id;
											$set->idOrden=$idOrden;
											$set->save();	
											
											$dat = new CDbCriteria;
											$dat->condition = "idCompetencia = '".$dcom->id."' ";
											$pc=AnaEncuestaPreguntasxcompetencias::model()->findAll($dat);//printVar($pc);
											$kp=array();
											foreach($pc as $rpc){
												array_push($kp,$rpc->keyidpregunta);
											}
											$dat = new CDbCriteria;
											$dat->condition = "keyid in ('".join("','",$kp)."') ";//printVar( "keyid in ('".join("','",$kp)."') ");exit;
											$dat->order="idorden ASC";
											$rpreg=AnaEncuestaPregunta::model()->findAll($dat);//printVar($rpreg);exit;
											$preguntas=array();
											foreach($rpreg as $index=>$datapreg){
												$keypre=$this->generarKey();
												$dat = new CDbCriteria;
												$dat->condition = "keyid = '".$keypre."'";
												//printVar($dat);exit;
												$verificarkey=AnaEncuestaPreguntaProyecto::model()->find($dat);				
												if(isset($verificarkey->{'keyid'})){
													$bandera=false;
													$contador=6;
													while($bandera==false){
														$keypre=$this->generarKey($contador);
														$dat = new CDbCriteria;
														$dat->condition = "keyid = '".$keypre."'";
														$verificarkey=AnaEncuestaPreguntaProyecto::model()->find($dat);
														if(!isset($verificarkey->{'keyid'})){
															$bandera=true;
														}
														$contador++;
													}
												} 												
												
 												//printVar();
												$set=new AnaEncuestaPreguntaProyecto();
												$set->keyid=$keypre;
												$set->enunciado_esp=$datapreg->enunciado_esp;
												$set->keyidorigen=$datapreg->keyid;
												$set->keyidproyecto=$_POST["keyproyecto"];;
												$set->idorden=$index;
												$set->fecharegistro=date("Y-m-d H:i:s");
												$set->idUsuario=(int)Yii::app()->user->id;
												$set->save(); 
												
												$set=new AnaEncuestaPreguntasxcompetenciasProyecto();
												$set->keyidpregunta=$keypre;
												$set->keyidpreguntaorigen=$datapreg->keyid;
												$set->keyidcompetencia=$key;
												$set->idcompetenciaorigen=$dcom->id;
 												$set->keyidproyecto=$_POST["keyproyecto"];
												$set->idUsuario=(int)Yii::app()->user->id;
												$set->save(); 												
												
												
											}
 
 										}
										$contado++;
 									}
									if($contado>0){
										echo json_encode(array("ok"));exit;
										}else{echo json_encode(array("no"));exit;}
								
									
								break;
								case "bibliotecaencuestas":
									  
									$biblioteca=AnaEncuesta::model()->findAll();	//printVar($biblioteca);
									$encuestas=array();
									foreach($biblioteca as $data){
										
										$dat = new CDbCriteria;
										$dat->condition = "idEncuesta = '".$data->id."' ";
 										$competencias=AnaEncuestaCompetencia::model()->findAll($dat);//printVar($competencias);//exit; 
										$rcompetencias=array();
										foreach($competencias as $indice=>$datac){
											$dat = new CDbCriteria;
											$dat->condition = "idCompetencia = '".$datac->id."' ";
											$pc=AnaEncuestaPreguntasxcompetencias::model()->findAll($dat);//printVar($pc);
											$kp=array();
											foreach($pc as $rpc){
												array_push($kp,$rpc->keyidpregunta);
											}
											$dat = new CDbCriteria;
											$dat->condition = "keyid in ('".join("','",$kp)."') ";//printVar( "keyid in ('".join("','",$kp)."') ",$indice);
											$dat->order="idorden ASC";
											$rpreg=AnaEncuestaPregunta::model()->findAll($dat);//printVar($pro);exit;
											$preguntas=array();
											foreach($rpreg as $datapreg){
												array_push($preguntas,array("keyid"=>$datapreg->keyid,"enunciado"=>$datapreg->enunciado_esp,"idorden"=>$datapreg->idorden));
											}
											$rcompetencias[$indice]=array("preguntas"=>$preguntas,"idEncuesta"=>$datac->idEncuesta,"id"=>$datac->id,"nombre"=>$datac->nombre_esp,"descripcion"=>$datac->descripcion_esp);
										
										
										}
										
										
										
										array_push($encuestas,(object)array("nombre"=>$data->nombre,"descripcion"=>$data->descripcion,"id"=>$data->id,"competencias"=>$rcompetencias));
									}
									echo json_encode(array("ok",$encuestas));exit;	
								break;
								case "reportes":
									$dat = new CDbCriteria;
									$dat->condition = "keyproyecto = '".$_POST["key"]."'  ";
									$dat->order="nombre ASC";
									//printVar($dat);exit;
									$participante=AnaParticipante::model()->findAll($dat);	
									$rp=array();
									foreach($participante as $v){
										$obj=array();
										foreach($v as $k=>$var){
											$obj[$k]=$var;
										}
										array_push($rp,(object)$obj);
 									}
									$dat = new CDbCriteria;
									$dat->condition = "keyidproyecto = '".$_POST["key"]."'".$kcom;
									$dat->order="idOrden ASC";
									//printVar($dat);exit;
									$competencias=AnaEncuestaCompetenciaProyecto::model()->findAll($dat);										
									$comp=array();
									foreach($competencias as $v){
										$obj=array();
										foreach($v as $k=>$var){
											$obj[$k]=$var;
										}
										array_push($comp,(object)$obj);
 									}
									
 								echo json_encode(array("ok",$rp,$comp));exit;	
								break;
								case "evaluaciones_del_participante":
 									$dat = new CDbCriteria;
									$dat->condition = "keyidproyecto = '".$_POST["key"]."'   and keyidrelacion<>'NR' and keyidrelacion<>''"; 	
									$participantesrelacion=AnaEncuestaParticipanterelaciones::model()->findAll($dat);
									$tpar=array();		
											
									foreach($participantesrelacion as $parti){
										if(!in_array($parti->keyidparticipanteevaluador,$tpar)){
											array_push($tpar,$parti->keyidparticipanteevaluador);
										}
									}
								
								
									$dat = new CDbCriteria;
									$dat->condition = "keyproyecto = '".$_POST["key"]."' and keyid in ('".join("','",$tpar)."')";
									$dat->order="nombre ASC";
									//printVar($dat);exit;
									$participante=AnaParticipante::model()->findAll($dat);	
									$tipoedad=AnaTipoedad::model()->findAll();	
									$tipoantiguedad=AnaTipoantiguedad::model()->findAll();	
									$tipoestadocivil=AnaTipoestadocivil::model()->findAll();	
									$tiponivelacademico=AnaTiponivelacademico::model()->findAll();	
									if(isset($participante[0]->keyproyecto)){
										$norm=array();
										$dat = new CDbCriteria;
										$dat->condition = "keyidproyecto = '".$_POST["key"]."'   and keyidrelacion<>'NR' and keyidrelacion<>''"; 	
										$participantesrelacion=AnaEncuestaParticipanterelaciones::model()->findAll($dat); 
																							
										
										
										foreach($participante as $k=>$datos){
											/*
											$dat = new CDbCriteria;
											$dat->condition = "keyidproyecto = '".$_POST["key"]."'  and keyidparticipanteevaluador='".$datos->keyid."' and keyidrelacion<>'NR' and keyidrelacion<>''"; 	
 											$relacion=AnaEncuestaParticipanterelaciones::model()->find($dat);
											if(){	
											*/	
												
												$temporal=array();
												foreach($datos as $campo=>$valor){
													$temporal[$campo]=$valor;
												}
												$dat = new CDbCriteria;
												$dat->condition = "keyidproyecto = '".$_POST["key"]."'  and keyidparticipanteevaluador='".$datos->keyid."' and keyidrelacion<>'NR'  "; 	
												$res=AnaEncuestaParticipanterelaciones::model()->findAll($dat); 
													
												$todas=count($res);
												$temporal["todos"]=$todas;
												
												$dat = new CDbCriteria;
												$dat->condition = "keyidproyecto = '".$_POST["key"]."'  and keyidparticipanteevaluador='".$datos->keyid."' and estado='0'  and keyidrelacion<>'NR'"; 	
												$res=AnaEncuestaParticipanterelaciones::model()->findAll($dat); 
												$sinterminar=count($res);
												$temporal["sinterminar"]=$sinterminar;
												
												$dat = new CDbCriteria;
												$dat->condition = "keyidproyecto = '".$_POST["key"]."'  and keyidparticipanteevaluador='".$datos->keyid."' and estado='1'  and keyidrelacion<>'NR'"; 	
												$res=AnaEncuestaParticipanterelaciones::model()->findAll($dat); 
												$terminado=count($res);
												$temporal["terminado"]=$terminado;
												
												$dat = new CDbCriteria;
												$dat->condition = "keyidproyecto = '".$_POST["key"]."'  and keyidparticipanteevaluador='".$datos->keyid."' and estado='2'  and keyidrelacion<>'NR'"; 	
												$res=AnaEncuestaParticipanterelaciones::model()->findAll($dat); 
												$iniciado=count($res);
												$temporal["iniciado"]=$iniciado;
 												$norm[$datos->keyid]=(object)$temporal;
											//}
 											 
										}
										
										 
										$dat = new CDbCriteria;
										$dat->condition = "keyidproyecto = '".$_POST["key"]."' and (keyidrelacion<>'' and keyidrelacion<>'NR') ";
										//printVar($dat);exit;
										$evaluados=AnaEncuestaParticipanterelaciones::model()->findAll($dat);
										
										$evaluadosR=array();
										foreach($evaluados as $data){
											$dat = new CDbCriteria;
											$dat->condition = "keyproyecto = '".$_POST["key"]."' and keyid='".$data->keyidparticipante."' ";
											//printVar($dat);exit;
											$evaluado=AnaParticipante::model()->find($dat);
											
											
											$relacionlabel="";
											if($data->keyidrelacion=="autoeval"){
												$relacionlabel="Autoevaluacion";
											}else{
												$dat = new CDbCriteria;
												$dat->condition = "keyproyecto = '".$_POST["key"]."' and keyid='".$data->keyidrelacion."' ";
												//printVar($dat);exit;
												$relacion=AnaRelacionxproyecto::model()->find($dat);
												if(isset($relacion->keyid)){
													$relacionlabel=$relacion->nombre;
												}
											}
											
											$dat = new CDbCriteria;
											$dat->condition = "keyproyecto = '".$_POST["key"]."' and keyid='".$data->keyidparticipanteevaluador."' ";
											//printVar($dat);exit;
											$evaluador=AnaParticipante::model()->find($dat);
											 
											if(!isset($evaluadosR[$data->keyidparticipante][0])){
												if($evaluado->keyid!=""){
												$evaluadosR[$data->keyidparticipante][0]=array(
														"evaluado"=>array($evaluado->keyid,$evaluado->nombre." ".$evaluado->apellido),
 														"evaluador"=>array($evaluador->keyid,$evaluador->nombre." ".$evaluador->apellido),
 														"relacion"=>$relacionlabel,
														"estado"=>array($data->estado,$data->fecharesuelto)
													); 
												}
											}else{ 
												if($evaluado->keyid!=""){
												$datosred=array(
														"evaluado"=>array($evaluado->keyid,$evaluado->nombre." ".$evaluado->apellido),
														"evaluador"=>array($evaluador->keyid,$evaluador->nombre." ".$evaluador->apellido),
														"relacion"=>$relacionlabel,
														"estado"=>array($data->estado,$data->fecharesuelto)
													);
												array_push($evaluadosR[$data->keyidparticipante],$datosred); 
												}
											} 
										}
										
										 
   										echo json_encode(array("ok",$norm,$evaluadosR));exit;
									}else{echo json_encode(array("no"));exit;}								
								
								
								break;
								
								case "competencias":
								
									$options=array('normal'=>1,'notitulo'=>2,'aleatoria'=>3);
									 $dat = new CDbCriteria;
									$dat->condition = "keyid = '".$_POST["key"]."' "; 	
 									//printVar($dat);exit;
									$tipo=AnaProyecto::model()->find($dat); 								
									
									$tipoencuesta=$options[$tipo->tipoencuesta];
									$kcom="";
									if(isset($_POST["keyidcompetencia"])){
										$kcom=" and keyid='".$_POST["keyidcompetencia"]."' ";
										$_POST["key"]=$_POST["keyidproyecto"];
									}
									$dat = new CDbCriteria;
									$dat->condition = "keyidproyecto = '".$_POST["key"]."'".$kcom;
									$dat->order="idOrden ASC";
									//printVar($dat);exit;
									$competencias=AnaEncuestaCompetenciaProyecto::model()->findAll($dat);	
									if(isset($competencias[0]->keyidproyecto)){
										$norm=array();
										foreach($competencias as $k=>$datos){
											$temporal=array();
 											foreach($datos as $campo=>$valor){
												$temporal[$campo]=$valor;
											}
											$preguntas=array();
											$temporal["preguntas"]=(object)$preguntas;
											
 											$dat = new CDbCriteria;
											$dat->condition = "keyidproyecto='".$_POST["key"]."' and keyidcompetencia= '".$datos->keyid."'";
											$dat->order="idordenpregunta ASC";
 											$pregunta=AnaViewEncuestaPreguntasxcompetenciasProyecto::model()->findAll($dat);	
											//$pregunta=AnaViewEncuestaPreguntasxcompetenciasProyecto::model()->findAll();	
											//printVar($pregunta);
											if(isset($pregunta[0]->keyidproyecto)){
												foreach($pregunta as $kk=>$datap){
 													$preguntas[$kk]["enunciado"]=$datap->enunciadopregunta;
													$preguntas[$kk]["keyid"]=$datap->keyidpregunta;
													$preguntas[$kk]["idordenpregunta"]=$datap->idordenpregunta;
												}
												$temporal["preguntas"]=(object)$preguntas;
											}
											$norm[$k]=(object)$temporal;   
  											
										} //printVar($norm);
										echo json_encode(array("ok",$norm,$tipoencuesta));exit;
									}else{echo json_encode(array("no"));exit;}								
 								
								break;
								case "mailing":
									//printVar("%Daniel");
									
									$id="";
									if(isset($_POST["id"])){
										if($_POST["id"]!="NUEVOMAILING"){
											$id=" and id=".(int)$_POST["id"];
										}
									}
 									$dat = new CDbCriteria;
									$dat->condition = "keyidproyecto = '".$_POST["key"]."' ".$id; 	
 									//printVar($dat);exit;
									$templates=AnaEmailtemplate::model()->findAll($dat); 								
									if(isset($templates[0])){
										$template=array();
										foreach($templates as $data){
											$datos=array();
											foreach($data as $k=>$v){
												if($k=="participantes"){
													$v=json_decode($v);
												}
												$datos[$k]=$v;
 											}
											 array_push($template,(object)$datos);
										}
										
 										echo json_encode(array("ok",$template));exit;
									}else{echo json_encode(array("no"));exit;}								
 								
								break;	
								case "bibliotecamailing":
								
									$biblioteca=AnaBibliotecamailing::model()->findAll();
									$bio=array();
									foreach($biblioteca as $id=>$data){
										$datos=array();
										foreach($data as $k=>$d){
											$datos[$k]=$d;
										}
										array_push($bio,$datos);
									}
									echo json_encode(array("ok",$bio));exit;
								break;								
								case "actualizar_mailing":
									$id="";
									if(isset($_POST["id"])){
										if($_POST["id"]!="NUEVOMAILING"){
											$id=" and id=".(int)$_POST["id"];
										}
									}
 									$dat = new CDbCriteria;
									$dat->condition = "keyidproyecto = '".$_POST["key"]."' ".$id; 	
 									//printVar($dat);exit;
									$tem=AnaEmailtemplate::model()->find($dat); 								
									if(isset($tem->id)){
										$tem->nombre=$_POST["nombre"];
										$tem->html=$_POST["html"];
										$tem->asunto=$_POST["asunto"]; 
										if(is_array($_POST["participantes"])){
											$tem->participantes=json_encode($this->validarParticipantes($_POST["participantes"],$_POST["key"]));
										}
										$tem->save();
  										echo json_encode(array("ok"));exit;
									}else{echo json_encode(array("no"));exit;}								
 								
								break;	
								case "participantes_mailing":
									$squery="";
									$arrayparam=array(":idp"=>$_POST["key"]);
									if(isset($_POST["nombre"])){
										$nombre = addcslashes($_POST["nombre"], '%_');
										$squery.=" and nombre LIKE :nombre";
										//printVar("%fernando");
									 	$arrayparam[":nombre"]="%".$nombre."%";
									}
								
									if(isset($_POST["apellido"])){
										$apellido = addcslashes($_POST["apellido"], '%_');
										$squery.=" and apellido  LIKE :apellido";
										$arrayparam[":apellido"]="%".$apellido."%";
									}
																
									 
									$dat = new CDbCriteria(array(
										"condition"=>"keyproyecto =:idp ".$squery,
										"params"=>$arrayparam,
										"order"=>"nombre ASC"
									));
									 
									//printVar($dat);   
									$p=AnaParticipante::model()->findAll($dat); 
									
									$participantes=array();
									foreach($p as $dp){
										$dtp=array();
										$dat = new CDbCriteria;
										$dat->condition = "keyidparticipanteevaluador = '".$dp->keyid."'   "; 	
 										$tem=AnaEncuestaParticipanterelaciones::model()->findAll($dat); 
										$sinresolver=0;
										$tienerelacion=0;
										if(isset($tem[0]->keyidparticipanteevaluador)){
											$sinresolver=0;
											foreach($tem as $destados){
												if($destados->estado=="0" or $destados->estado=="2"){
													$sinresolver++;
												} 
											}
											$tienerelacion=1;
										} 
										foreach($dp as $k=>$v){
											if($k!="clave"  ){
											$dtp[$k]=$v;
											}
										}
										$estado="ok";
										if($sinresolver>0){
											$estado="Incompleto";
										}
										$dtp["estado"]=$estado;
										$dtp["tienerelacion"]=$tienerelacion;
										if(!isset($_POST["estado"])){ 
										 array_push($participantes,(object)$dtp);
										}else{
 											if((int)$_POST["estado"]==1){
												if($sinresolver==0 and $tienerelacion==1){
													array_push($participantes,(object)$dtp);
												}
											}
 											if((int)$_POST["estado"]==0){
												if($sinresolver>0 or $tienerelacion==0  ){
													array_push($participantes,(object)$dtp);
												}
											}
 											if((int)$_POST["estado"]==2){
												 
												array_push($participantes,(object)$dtp);
												 
											}
 										}
 									}
 									echo json_encode(array("ok",$participantes));exit;
 								break;								
								case "guardar_mailing":
 									$tem=new AnaEmailtemplate(); 								
									$tem->nombre=$_POST["nombre"]; 
									$tem->html=$_POST["html"];
									$tem->asunto=$_POST["asunto"]; 									
									$tem->keyidproyecto=$_POST["key"]; 
									if(is_array($_POST["participantes"])){
										$tem->participantes=json_encode($this->validarParticipantes($_POST["participantes"],$_POST["key"]));
									}else{
										$tem->participantes="[]";
									}
									$tem->fecha=date("Y-m-d H:i:s"); 
									$tem->save();
 									echo json_encode(array("ok"));exit;
 								break;
								case "enviar_mailing":
									$dat = new CDbCriteria;
									$dat->condition = "keyidproyecto = '".$_POST["key"]."' and id='".(int)$_POST["id"]."'"; 	
									//printVar($dat);exit;
									$tem=AnaEmailtemplate::model()->find($dat); 
									if(!isset($tem->id)){
										$tem=new AnaEmailtemplate(); 	
									}
									$tem->nombre=$_POST["nombre"]; 
									$tem->html=$_POST["html"]; 
									$tem->keyidproyecto=$_POST["key"]; 
									$tem->asunto=$_POST["asunto"]; 
									$participantes=array();
									if(is_array($_POST["participantes_correo"])){
										$tem->participantes=json_encode($this->validarParticipantes($_POST["participantes_correo"],$_POST["key"]));
										$participantes=$tem->participantes;
									}else{
										$tem->participantes="[]";
									}
									$tem->fecha=date("Y-m-d H:i:s"); 
									$tem->save();
									$r=$this->enviarEmail($participantes,$tem->id,$_POST["key"]);
									$tipopago=array("1"=>"360","2"=>"Clima","3"=>"Equipo");
									for($i = 0; $i<count($_POST["participantes"]);$i++){
										$this->pagar($_POST['key'],$tipopago[$_POST["tipoproyecto"]]);
									}
 									echo json_encode(array("ok",$r,$_POST,$participantes));exit;
 								break;
								case "previsualizarencuesta":
								
									$dat = new CDbCriteria;
									$dat->condition = "keyidproyecto = '".$_POST["keyidproyecto"]."'"; 	
									$dat->order ="idOrden ASC";
									//printVar($dat);exit;
									$escala=AnaEncuestaEscala::model()->find($dat); 								
								//printVar($escala);
									$dat = new CDbCriteria;
									$dat->condition = "keyidproyecto = '".$_POST["keyidproyecto"]."'"; 	
									$dat->order ="idOrden ASC";
									//printVar($dat);exit;
									$preguntaabierta=AnaEncuestaPreguntaabierta::model()->findAll($dat); 								
								//printVar($preguntaabierta);
								
								 
									$datafin=array();
									$dat = new CDbCriteria;
									$dat->condition = "keyid = '".$_POST["keyidproyecto"]."' "; 	
 									$proyecto=AnaProyecto::model()->find($dat); 
									$datafin["proyecto"]=array("keyid"=>$proyecto->keyid,"nombre"=>$proyecto->nombre,"tipoencuesta"=>$proyecto->tipoencuesta,"contexto"=>array());
									 
 									$dat = new CDbCriteria;
									$dat->condition = "keyid = '".$_POST["keyid"]."'";
									//printVar($dat);exit;
									$evaluado=AnaParticipante::model()->find($dat);	
									$datafin["evaluado"]=array("nombre"=>$evaluado->nombre,"apellido"=>$evaluado->apellido,"competencias"=>json_decode($evaluado->jsoncompetencias));
									
									
									$competenciasasignadas=array();
									foreach(json_decode($evaluado->jsoncompetencias) as $keycompetencia=>$nombre ){
										array_push($competenciasasignadas,$keycompetencia);
									}
									
									$subquery="";
									if(count($competenciasasignadas)>0){
										$subquery="  and keyid in ('".join("','",$competenciasasignadas)."')";
									}
									
									 
									 
									$dat = new CDbCriteria;
									$dat->condition = "keyidproyecto = '".$_POST["keyidproyecto"]."'".$subquery;
									//
									$competencias=AnaEncuestaCompetenciaProyecto::model()->findAll($dat);
//printVar($competencias);exit;
									$tencuesta=array();
									foreach($competencias as $k=>$data){
										
										$dat = new CDbCriteria;
										$dat->condition = "keyidcompetencia = '".$data->keyid."'";
 										$preguntas=AnaEncuestaPreguntasxcompetenciasProyecto::model()->findAll($dat);	
										//printVar($preguntas);exit;
										$rpreguntas=array();
										foreach($preguntas as $pregunta){
											$dat = new CDbCriteria;
											$dat->condition = "keyid = '".$pregunta->keyidpregunta."'";
											$tp=AnaEncuestaPreguntaProyecto::model()->find($dat);	
											
											array_push($rpreguntas,array("keyid"=>$pregunta->keyidpregunta,"enunciado"=>$tp->enunciado_esp));
											
											
										}

										$tencuesta[$k]=array("keyid"=>$data->keyid,"categoria"=>$data->nombre_esp,"descripcion"=>$data->descripcion_esp,"preguntas"=>(object)$rpreguntas);								
									}
									
									$datafin["proyecto"]["contexto"]=$tencuesta;
									//printVar($datafin["proyecto"]["contexto"]);
									
									switch($proyecto->tipoencuesta){
										case "notitulo":
 											foreach($datafin["proyecto"]["contexto"] as $id_a=>$competencias){
												 
												$datafin["proyecto"]["contexto"][$id_a]["categoria"]="NOTITLE";
												
											}
 										break;
										case "aleatoria":
											$tpreguntas=array();
											 
											foreach($datafin["proyecto"]["contexto"] as $id_a=>$competencias){
												 
												 foreach($competencias["preguntas"] as $id_c=>$pregunta){  
													array_push($tpreguntas,$pregunta);
												}
											
											}
											shuffle($tpreguntas);
											unset($datafin["proyecto"]["contexto"]);
											$datafin["proyecto"]["contexto"][0]=array("preguntas"=>$tpreguntas,"descripcion"=>"","categoria"=>"","keyid"=>"generico");
										
										
										
										break;
										case "normal":
										break;
									}
									$escalaFin=array("no");
									if(isset($escala->jsondesccriptor)){
										$totales=json_decode($escala->jsondesccriptor);
										$tv=0;
										foreach($totales as $data){
											$tv++;
										}
										
										
										$escalaFin=array("ok",$totales,(int)$escala->rango,$tv);
									}
									
									$rpa=array("no");
									
									if(count($preguntaabierta)>0){
										$rpa=array();
										foreach($preguntaabierta as $dato){
											array_push($rpa,array($dato->enunciado,$dato->keyid));
										}
									}
									
									
									
 									echo json_encode(array("ok",$datafin,$escalaFin,$rpa));exit;
								
								break;
								case "preguntas_abiertas"://AnaEncuestaPreguntaabierta
 
 
 
 

									$q="keyidproyecto = '".$_POST["key"]."'";

									if(isset($_POST["keyidescala"])){
										
										$q="keyidproyecto = '".$_POST["key"]."' and keyid='".$_POST["keyidescala"]."' ";

									}


									$dat = new CDbCriteria;
									$dat->condition = $q;
									$dat->order="idOrden ASC";
									$verificarkey=AnaEncuestaPreguntaabierta::model()->findAll($dat);
									if(isset($verificarkey[0]->keyidproyecto)){
										$norm=array();
										foreach($verificarkey as $k=>$objeto){
											$valores=array();
											foreach($objeto as $k=>$val){
 												$valores[$k]=$val;
											}
											
											array_push($norm,(object)$valores);
											
										}
										
										echo json_encode(array("ok",$norm));exit;
									}else{echo json_encode(array("no"));exit;}	 
 								
								
								break;
								case "agregarpa":
									$key=$this->generarKey();
									$dat = new CDbCriteria;
									$dat->condition = "keyid = '".$key."'";
									//printVar($dat);exit;
									$verificarkey=AnaEncuestaPreguntaabierta::model()->find($dat);

									$dat = new CDbCriteria;
									$dat->condition = "keyidproyecto = '".$_POST["key"]."'";
									//printVar($dat);exit;
									$totales=AnaEncuestaPreguntaabierta::model()->findAll($dat);				
									$idOrden=count($totales);

									if(isset($verificarkey->{'keyid'})){
										$bandera=false;
										$contador=6;
										while($bandera==false){
											$key=$this->generarKey($contador);
											$dat = new CDbCriteria;
											$dat->condition = "keyid = '".$key."'";
											$verificarkey=AnaEncuestaPreguntaabierta::model()->find($dat);
											if(!isset($verificarkey->{'keyid'})){
												$bandera=true;
											}
											$contador++;
										}
									} 											
									$set = new AnaEncuestaPreguntaabierta();
									$set->keyid=$key;
									$set->enunciado=$_POST["enunciado"];
 									$set->idUsuario=(int)Yii::app()->user->id;
									$set->fecharegistro=date("Y-m-d H:i:s");
									$set->keyidproyecto=$_POST["key"];
									$set->idOrden=$idOrden;
									$set->save();								
									echo json_encode(array("ok"));exit;
								
								break;
								case "editarpa":
									$dat = new CDbCriteria;
									$dat->condition = "keyid = '".$_POST["keyid"]."' and keyidproyecto='".$_POST["key"]."'";
									//printVar($dat);exit;
									$pa=AnaEncuestaPreguntaabierta::model()->find($dat);
									if(isset($pa->keyid)){
										$pa->enunciado=$_POST["enunciado"];
										$pa->save();
										echo json_encode(array("ok"));exit;
									}else{echo json_encode(array("no"));exit;}
								break;
								case "eliminarpa":
									$dat = new CDbCriteria;
									$dat->condition = "keyid = '".$_POST["keyid"]."' and keyidproyecto='".$_POST["key"]."'";
									//printVar($dat);exit;
									$pa=AnaEncuestaPreguntaabierta::model()->find($dat);
									if(isset($pa->keyid)){
 										$pa->delete();
										echo json_encode(array("ok"));exit;
									}else{echo json_encode(array("no"));exit;}
								break;
								/***TIPO ENCUESTA***/
								case "tipoencuesta":
								
									$options=array("normal",'normal','notitulo','aleatoria');
									 $dat = new CDbCriteria;
									$dat->condition = "keyid = '".$_POST["keyproyecto"]."' "; 	
 									//printVar($dat);exit;
									$set=AnaProyecto::model()->find($dat); 
									if(isset($set->keyid)){
										$set->tipoencuesta=$options[(int)$_POST["idtipo"]];
										$set->save();
									}

								break;
								case "editarcompetencia":
 									$dat = new CDbCriteria;
									$dat->condition = "keyidproyecto = '".$_POST["keyproyecto"]."'  and keyid='".$_POST["keyid"]."'"; 	
 									//printVar($dat);exit;
									$competencia=AnaEncuestaCompetenciaProyecto::model()->find($dat); 
									
									if(isset($competencia->keyidproyecto)){
										$competencia->nombre_esp=$_POST["nombre"];
										$competencia->descripcion_esp=$_POST["descripcion"];
										$competencia->save();
 										$preguntas=$_POST["preguntas"];
										foreach($preguntas as $k=>$data){
											if($data[0]!="Nr"){
												$dat = new CDbCriteria;
												$dat->condition = "keyid = '".$data[0]."'"; 	
												$fpregunta=AnaEncuestaPreguntaProyecto::model()->find($dat);
												if(isset($fpregunta->keyid)){
													$fpregunta->enunciado_esp=$data[1];
													$fpregunta->idorden=$k;
													$fpregunta->save();
												}
											}else{
												
 												$key=$this->generarKey();
												$dat = new CDbCriteria;
												$dat->condition = "keyid = '".$key."'";
												//printVar($dat);exit;
												$verificarkey=AnaEncuestaPreguntaProyecto::model()->find($dat);				
												if(isset($verificarkey->{'keyid'})){
													$bandera=false;
													$contador=6;
													while($bandera==false){
														$key=$this->generarKey($contador);
														$dat = new CDbCriteria;
														$dat->condition = "keyid = '".$key."'";
														$verificarkey=AnaEncuestaPreguntaProyecto::model()->find($dat);
														if(!isset($verificarkey->{'keyid'})){
															$bandera=true;
														}
														$contador++;
													}
												} 												
																								 
												$set=new AnaEncuestaPreguntaProyecto();
												$set->keyid=$key;
												$set->enunciado_esp=$data[1];
												$set->idorden=$k;
												$set->fecharegistro=date("Y-m-d H:i:s");
												$set->idUsuario=(int)Yii::app()->user->id;
												$set->keyidproyecto=$_POST["keyproyecto"];
  												$set->save(); 
												
 												$set=new AnaEncuestaPreguntasxcompetenciasProyecto();
												$set->keyidpregunta=$key;
												$set->keyidcompetencia=$_POST["keyid"];
												$set->keyidproyecto=$_POST["keyproyecto"];
												$set->idUsuario=(int)Yii::app()->user->id;
 												$set->save(); 												
 											}
										}
										echo json_encode(array("ok"));exit;
									}else{echo json_encode(array("no"));exit;}
 								break;
								case "eliminarpregunta":
 									//printVar($_POST["preguntas"]);exit;
									$dat = new CDbCriteria;
									$dat->condition = "keyidproyecto = '".$_POST["llaves"]["idproyecto"]."'  and keyidpregunta='".$_POST["llaves"]["idpregunta"]."'  and keyidcompetencia='".$_POST["llaves"]["idcompetencia"]."'"; 	
 									//printVar($dat);exit;
									$pregunta=AnaViewEncuestaPreguntasxcompetenciasProyecto::model()->find($dat); 
									
 									if(isset($pregunta->keyidproyecto)){
										$dat = new CDbCriteria;
										$dat->condition = "keyidproyecto = '".$_POST["llaves"]["idproyecto"]."'  and keyidpregunta='".$_POST["llaves"]["idpregunta"]."'  and keyidcompetencia='".$_POST["llaves"]["idcompetencia"]."'"; 	
										$relacion=AnaEncuestaPreguntasxcompetenciasProyecto::model()->find($dat); 
										//printVar($relacion);exit;
										if(isset($relacion->id)){
											$relacion->delete();
											if($_POST["eliminarcompletamente"]=="SI"){
												$dat = new CDbCriteria;
												$dat->condition = "keyidproyecto = '".$_POST["llaves"]["idproyecto"]."'  and keyid='".$_POST["llaves"]["idpregunta"]."'"; 	
												$fpregunta=AnaEncuestaPreguntaProyecto::model()->find($dat); 
												if(isset($fpregunta->keyid)){
													$fpregunta->delete();
													echo json_encode(array("okok"));exit;
												}
												//echo json_encode(array("ok"));exit;
											}else{echo json_encode(array("ok"));exit;}	
 										}else{echo json_encode(array("no"));exit;}	
 										
									}
 								
								break;
								
								
								case "ordenarcompetencias":
								
									foreach($_POST["competencias"] as $k=>$id){
										$dat = new CDbCriteria;
										$dat->condition = "keyidproyecto = '".$_POST["keyidproyecto"]."' and keyid='".$id."'"; 	
										// printVar($dat);exit;
										$competencia=AnaEncuestaCompetenciaProyecto::model()->find($dat);
										$competencia->idOrden=$k;	
										$competencia->save();
										
									}
								
								break;
								case "agregarcompetencia":
									//printVar($_POST["preguntas"]);exit;
									$dat = new CDbCriteria;
									$dat->condition = "keyidproyecto = '".$_POST["key"]."' and nombre_esp='".$_POST["nombre"]."'"; 	
									// printVar($dat);exit;
									$competencia=AnaEncuestaCompetenciaProyecto::model()->findAll($dat); 
									if(!isset($competencia[0]->keyidproyecto)){
											
										$key=$this->generarKey();
										$dat = new CDbCriteria;
										$dat->condition = "keyid = '".$key."'";
										//printVar($dat);exit;
										$verificarkey=AnaEncuestaCompetenciaProyecto::model()->find($dat);

										$dat = new CDbCriteria;
										$dat->condition = "keyidproyecto = '".$_POST["key"]."'";
										//printVar($dat);exit;
										$totales=AnaEncuestaCompetenciaProyecto::model()->findAll($dat);				
 										$idOrden=count($totales);
 										
 										if(isset($verificarkey->{'keyid'})){
											$bandera=false;
											$contador=6;
											while($bandera==false){
												$key=$this->generarKey($contador);
												$dat = new CDbCriteria;
												$dat->condition = "keyid = '".$key."'";
												$verificarkey=AnaEncuestaCompetenciaProyecto::model()->find($dat);
												if(!isset($verificarkey->{'keyid'})){
													$bandera=true;
												}
												$contador++;
											}
										} 											
 										$set = new AnaEncuestaCompetenciaProyecto();
										$set->keyid=$key;
										$set->nombre_esp=$_POST["nombre"];
										$set->descripcion_esp=$_POST["descripcion"];
										$set->idUsuario=(int)Yii::app()->user->id;
										$set->fecharegistro=date("Y-m-d H:i:s");
										$set->keyidproyecto=$_POST["key"];
										$set->idOrden=$idOrden;
										$set->save();
										if(isset($_POST["preguntas"])){
											
											foreach($_POST["preguntas"] as $idk=>$datapregutna){
												$keyp=$this->generarKey();
												$dat = new CDbCriteria;
												$dat->condition = "keyid = '".$keyp."'";
												//printVar($dat);exit;
												$verificarkey=AnaEncuestaPreguntaProyecto::model()->find($dat);	
												
												if(isset($verificarkey->{'keyid'})){
													$bandera=false;
													$contador=6;
													while($bandera==false){
														$keyp=$this->generarKey($contador);
														$dat = new CDbCriteria;
														$dat->condition = "keyid = '".$keyp."'";
														$verificarkey=AnaEncuestaPreguntaProyecto::model()->find($dat);
														if(!isset($verificarkey->{'keyid'})){
															$bandera=true;
														}
														$contador++;
													}
												}												
 												
												$set=new AnaEncuestaPreguntaProyecto();
												$set->keyid=$keyp;
												$set->idorden=$idk;
												$set->enunciado_esp=$datapregutna;
												$set->fecharegistro=date("Y-m-d H:i:s");
												$set->idUsuario=(int)Yii::app()->user->id;
												$set->keyidproyecto=$_POST["key"];
												$set->save();
												
												$set=new AnaEncuestaPreguntasxcompetenciasProyecto();
												$set->keyidpregunta=$keyp;
												$set->keyidcompetencia=$key;
												$set->keyidproyecto=$_POST["key"];
												$set->idUsuario=(int)Yii::app()->user->id;
 												$set->save();
											}
											
											
										}
										echo json_encode(array("key"=>$key,"existe"=>"NO"));exit;
									}else{echo json_encode(array("existe"=>"SI"));exit;}
 								
								break;
								/***ESCALAS**/
								case "editarescala":
 									
									$queryc = "update lime_ana_encuesta_escala set aplicar='0' where keyidproyecto = '".$_POST["keyproyecto"]."' ";
									$gcrt = dbExecuteAssoc($queryc);
									
 									$dat = new CDbCriteria;
									$dat->condition = "keyidproyecto = '".$_POST["keyproyecto"]."'  and keyid='".$_POST["keyid"]."'"; 	
 									//printVar($dat);exit;
									$escala=AnaEncuestaEscala::model()->find($dat); 
 									
									if(isset($escala->keyidproyecto)){
										$escala->nombre=$_POST["nombre"];
										$escala->abreviacion=$_POST["abreviacion"];
 										$escala->aplicar=$_POST["aplicar"];
 										$escala->preguntaescala=$_POST["preguntaescala"];
										$escala->rango=(int)$_POST["rango"];
 										$escala->idUsuario=(int)Yii::app()->user->id;
										$escala->fecharegistro=date("Y-m-d H:i:s");
  										$descriptores=$_POST["descriptores"];
										if(is_array($descriptores)){
											$descriptores=json_encode((object)$descriptores);
											$escala->jsondesccriptor=$descriptores;
										}
 										$escala->save();
										echo json_encode(array("ok"));exit;
									}else{echo json_encode(array("no"));exit;}
 								break;
								
								
								
								case "escalas":
									//$keyp=$this->generarKey($contador);
									$q="keyidproyecto = '".$_POST["key"]."'";
									
									if(isset($_POST["keyidescala"])){
										
										$q="keyidproyecto = '".$_POST["key"]."' and keyid='".$_POST["keyidescala"]."' ";
									
									}
									
									
									$dat = new CDbCriteria;
									$dat->condition = $q;
									$dat->order="idOrden ASC";
									$verificarkey=AnaEncuestaEscala::model()->findAll($dat);
									if(isset($verificarkey[0]->keyidproyecto)){
										$norm=array();
										foreach($verificarkey as $k=>$objeto){
											$valores=array();
											foreach($objeto as $k=>$val){
												
												if($k=="jsondesccriptor"){
													$val=json_decode($val);
												}
												$valores[$k]=$val;
											}
											
											array_push($norm,(object)$valores);
											
										}
										
 										echo json_encode(array("ok",$norm));exit;
									}else{echo json_encode(array("no"));exit;}		
								
								break;
								case "agregarescala":
								 // printVar($_POST);exit;
								  
								  
									$key=$this->generarKey();
									$dat = new CDbCriteria;
									$dat->condition = "keyid = '".$key."'";
									//printVar($dat);exit;
									$verificarkey=AnaEncuestaEscala::model()->find($dat);

									$dat = new CDbCriteria;
									$dat->condition = "keyidproyecto = '".$_POST["key"]."'";
									//printVar($dat);exit;
									$totales=AnaEncuestaEscala::model()->findAll($dat);				
									$idOrden=count($totales);

									if(isset($verificarkey->{'keyid'})){
										$bandera=false;
										$contador=6;
										while($bandera==false){
											$key=$this->generarKey($contador);
											$dat = new CDbCriteria;
											$dat->condition = "keyid = '".$key."'";
											$verificarkey=AnaEncuestaEscala::model()->find($dat);
											if(!isset($verificarkey->{'keyid'})){
												$bandera=true;
											}
											$contador++;
										}
									} 								  
								  
 								  
								  
									$set=new AnaEncuestaEscala();
									$set->keyid=$key;
 									$set->keyidproyecto=$_POST["key"];
									$set->idUsuario=(int)Yii::app()->user->id;
  									$set->nombre=$_POST["nombre"];
									$set->abreviacion=$_POST["abreviacion"];
									$set->preguntaescala=$_POST["preguntaescala"];
									$set->aplicar=$_POST["aplicar"];
									$set->rango=(int)$_POST["rangoescala"];
									$set->jsondesccriptor=json_encode((object)$_POST["descriptores"]);
 									$set->fecharegistro=date("Y-m-d H:i:s");
 									$set->idorden=$idOrden;									
									
									$set->save();
								  
								  
									echo json_encode(array("key"=>$key,"existe"=>"NO"));exit;
									//}else{echo json_encode(array("existe"=>"SI"));exit;}
 								break;
								
								
								
								//******ASIGNACIONES
								case "relacionasignada":
								/*
									$dat = new CDbCriteria;
									$dat->condition = "keyidproyecto = '".$_POST["keyidproyecto"]."' and keyidparticipante='".$_POST["key"]."'";
 									$asignaciones=AnaViewAsignacion::model()->findAll($dat);	
									if(isset($asignaciones[0]->keyidproyecto)){
										$norm=array();
										foreach($asignaciones as $k=>$datos){
										$temporal=array();
										foreach($datos as $campo=>$valor){
											$temporal[$campo]=$valor;
										}
										$norm[$k]=(object)$temporal;
										}										
 									echo json_encode(array("ok",$norm));exit;
									}else{
										echo json_encode(array("no"));exit;
									}
								*/
									$dat = new CDbCriteria;
									$dat->condition ="keyproyecto = '".$_POST["keyidproyecto"]."'"; 
									$dat->order ="nombre ASC";
									//printVar($dat);exit;
 									$participante=AnaParticipante::model()->findAll($dat);	
									if(isset($participante[0]->keyproyecto)){
										$norm=array();
										$tj=0;
										foreach($participante as $k=>$datos){
											$temporal=array();
 											foreach($datos as $campo=>$valor){
												$temporal[$campo]=$valor;
												if($campo=="keyid"){
  													$dat = new CDbCriteria;
													$dat->condition = "keyidparticipante = '".$_POST["key"]."' and keyidproyecto = '".$_POST["keyidproyecto"]."' and  keyidparticipanteevaluador = '".$valor."'  ";
													 
													$verificarkey=AnaEncuestaParticipanterelaciones::model()->find($dat);													
													if(isset($verificarkey->keyid)){
														$dat = new CDbCriteria;
														$dat->condition = "keyid = '".$verificarkey->keyidrelacion."'";
														$rel=AnaRelacionxproyecto::model()->find($dat);													
 														$temporal["keyidrelacion"]=$verificarkey->keyidrelacion;
 														$temporal["nombrerelacion"]=$rel->nombre." (".$rel->abreviacion.")";
													}
  												}
											}
											if($_POST["key"]==$participante[$k]->keyid){
												if(isset($norm[0])){
													$norm[$k]=$norm[0];
												}
 												$norm[0]=(object)$temporal;
 											}else{
																								
												$norm[$k]=(object)$temporal;
											}
										}
										
										
										$dat = new CDbCriteria;
										$dat->condition = "keyproyecto = '".$_POST["keyidproyecto"]."' and estado='S'";
										$dat->order="idorigen ASC";
										$relxpro=AnaRelacionxproyecto::model()->findAll($dat);	
										if(isset($relxpro[0]->keyproyecto)){
											$relacioens=array();
 											foreach($relxpro as $k=>$datos){
												$temporal=array();
												foreach($datos as $campo=>$valor){
 													$temporal[$campo]=$valor;
 												}
												$relacioens[$k]=(object)$temporal;
											}										
										 
										}else{
											echo json_encode(array("norelaciones"));exit;
										}										
 										
										echo json_encode(array("ok",$norm,$relacioens));exit;
									}else{echo json_encode(array("no"));exit;}								
								
								
								
								case "asignacion":
								break;
								case "asignaciones":
									$dat = new CDbCriteria;
									$dat->condition = "keyproyecto = '".$_POST["key"]."' and retroalimentacion='S'";
									$dat->order ="nombre ASC";
									//printVar($dat);exit;
									$participante=AnaParticipante::model()->findAll($dat);	
									if(isset($participante[0]->keyproyecto)){
										$norm=array();
										foreach($participante as $k=>$datos){
											$temporal=array();
											foreach($datos as $campo=>$valor){
												$temporal[$campo]=$valor;
											}
											$norm[$k]=(object)$temporal;
										}
										echo json_encode(array("ok",$norm));exit;
									}else{echo json_encode(array("no"));exit;}								
 								break;
								case "agregarasignacion":
									//printVar($_POST);exit;
									
									foreach($_POST["asignaciones"] as $k=>$d){
										
										$dat = new CDbCriteria;
										$dat->condition = "keyidparticipante = '".$_POST["keyidparticipante"]."' and keyidproyecto = '".$_POST["keyproyecto"]."' and  keyidparticipanteevaluador = '".$k."'  ";
										//printVar($dat);exit;
										$existe=AnaEncuestaParticipanterelaciones::model()->find($dat);	
										if(isset($existe->keyid)){
											$existe->keyidrelacion=$d;
											$existe->fecharegistro=date("Y-m-d H:i:s");
											$existe->save();
										}else{
									
									
											$keyp=$this->generarKey();
											$dat = new CDbCriteria;
											$dat->condition = "keyid = '".$keyp."'";
											//printVar($dat);exit;
											$verificarkey=AnaEncuestaParticipanterelaciones::model()->find($dat);	

											if(isset($verificarkey->{'keyid'})){
												$bandera=false;
												$contador=6;
												while($bandera==false){
													$keyp=$this->generarKey($contador);
													$dat = new CDbCriteria;
													$dat->condition = "keyid = '".$keyp."'";
													$verificarkey=AnaEncuestaParticipanterelaciones::model()->find($dat);
													if(!isset($verificarkey->{'keyid'})){
														$bandera=true;
													}
													$contador++;
												}
											}
											
											$set=new AnaEncuestaParticipanterelaciones();
											$set->keyid=$keyp;
											$set->keyidparticipante=$_POST["keyidparticipante"];
											$set->keyidproyecto=$_POST["keyproyecto"];
											$set->keyidparticipanteevaluador=$k;
											$set->keyidrelacion=$d;
											$set->fecharegistro=date("Y-m-d H:i:s");
											$set->save();
 										}
									
									}
									echo json_encode(array("ok"));exit;
 								break;
								//****RELACIONES
								case "editarrelacion":
									$dat = new CDbCriteria;
									$dat->condition = "keyid = '".$_POST["keyid"]."'    and keyproyecto='".$_POST["keyproyecto"]."'  ";
									 //printVar($dat);exit;
									$p=AnaRelacionxproyecto::model()->find($dat);
									if(isset($p->keyid)){
										$p->abreviacion=$_POST["abreviacion"];
										$p->nombre=$_POST["nombre"];
										$p->descripcion=$_POST["descripcion"];
										$p->color=$_POST["color"];
										$p->idorigen=$_POST["idorigen"];
										$p->estado="S";
										$p->fechaactualizacion=date("Y-m-d H:i:s");
										$p->save(); 
										echo json_encode(array("ok"));exit;
									}else{
										echo json_encode(array("no"));exit;
									}
								break;	

								case "eliminarrelacion":
									$dat = new CDbCriteria;
									$dat->condition = "keyid = '".$_POST["key"]."'";
									//printVar($dat);exit;
									$relacion=AnaRelacionxproyecto::model()->find($dat);	
									if(isset($relacion->keyproyecto) and $relacion->idorigen==0){ $participante->delete();
 										echo json_encode(array("ok"));exit;
									}else if($relacion->idorigen>0){$relacion->fechaactualizacion=date("Y-m-d H:i:s");$relacion->estado="N";$relacion->save();echo json_encode(array("ok"));exit;}else{echo json_encode(array("no"));exit;}
								break;								
 								
								case "agregarrelacion":
								
									$key=$this->generarKey();

									$dat = new CDbCriteria;
									$dat->condition = "nombre = '".$_POST["nombre"]."' and keyproyecto='".$_POST["keyproyecto"]."'  ";
									//printVar($dat);exit;
									$existe=AnaRelacionxproyecto::model()->find($dat);		

									if(isset($existe->nombre)){
										if($existe->nombre==$_POST["nombre"]){
										echo json_encode(array("existe"=>"SI"));
										//echo json_encode(array("key"=>$key,"existe"=>"NO"));
										exit;
										}
									}
									
									$dat = new CDbCriteria;
									$dat->condition = "keyid = '".$key."'";
									//printVar($dat);exit;
									$verificarkey=AnaRelacionxproyecto::model()->find($dat);				
									 
									if(isset($verificarkey->{'keyid'})){
										$bandera=false;
										$contador=6;
										while($bandera==false){
											$key=$this->generarKey($contador);
											$dat = new CDbCriteria;
											$dat->condition = "keyid = '".$key."'";
											$verificarkey=AnaRelacionxproyecto::model()->find($dat);
											if(!isset($verificarkey->{'keyid'})){
												$bandera=true;
											}
											$contador++;
										}
									} 								
 									$set=new AnaRelacionxproyecto();
									$set->keyid=$key;
									$set->nombre=$_POST["nombre"];
									$set->abreviacion=$_POST["abreviacion"];
									$set->descripcion=$_POST["descripcion"];
									$set->keyproyecto=$_POST["keyproyecto"];
									$set->idUsuario=(int)Yii::app()->user->id;
									$set->fechacreacion=date("Y-m-d H:i:s");
									$set->idorigen=0;
									$set->estado="S";
									$set->color=$_POST["color"];
									$set->save();
									echo json_encode(array("key"=>$key,"existe"=>"NO"));
								break;
								case "relacion":
								//printVar( "keyid = '".$_POST["key"]."' and estado='S'");exit;
									$dat = new CDbCriteria;
									$dat->condition = "keyid = '".$_POST["key"]."' and estado='S'"; 
									$dat->order="idorigen ASC";
									//printVar($dat);exit;
									$relacion=AnaRelacionxproyecto::model()->findAll($dat);	
									if(isset($relacion[0]->keyproyecto)){
										$norm=array();
										foreach($relacion as $k=>$datos){
											$temporal=array();
											foreach($datos as $campo=>$valor){
												$temporal[$campo]=$valor;
											}
											$norm=(object)$temporal;
										}
										echo json_encode(array("ok",$norm));exit;
									}else{echo json_encode(array("no"));exit;}								
 								
								break;
								
								case "relaciones":   
								
 								
									$language=1;
									if(isset($_SESSION["language"])){
										$language=(int)$_SESSION["language"];
									}
									$idioma=json_decode(base64_decode($_SESSION["codelang"]));
									
  									$relaciontemporal=AnaTempoRelacion::model()->findAll();	
									
									foreach($relaciontemporal as $id=>$datos){
										$dat = new CDbCriteria;
										$dat->condition = "keyproyecto = '".$_POST["key"]."' and idorigen=".$datos->id."";
										//printVar($dat);exit;
										$relxpro=AnaRelacionxproyecto::model()->find($dat);
										
										if(!isset($relxpro->idorigen)){ 
 											$key=$this->generarKey();
											$dat = new CDbCriteria;
											$dat->condition = "keyid = '".$key."'";
											$verificarkey=AnaRelacionxproyecto::model()->find($dat);				
											if(isset($verificarkey->{'keyid'})){
												$bandera=false;
												$contador=6;
												while($bandera==false){
													$key=$this->generarKey($contador);
													$dat = new CDbCriteria;
													$dat->condition = "keyid = '".$key."'";
													$verificarkey=AnaRelacionxproyecto::model()->find($dat);
													if(!isset($verificarkey->{'keyid'})){
														$bandera=true;
													}
													$contador++;
												}
											}  								
 											
											$set=new AnaRelacionxproyecto();
											$set->keyid=$key;
											$set->nombre=$idioma->{$datos->nombre};
											$set->abreviacion=$datos->abreviado;
											$set->descripcion=$idioma->{$datos->descripcion};
											$set->keyproyecto=$_POST["key"];
											$set->idUsuario=(int)Yii::app()->user->id;
											$set->idorigen=$datos->id;
											$set->estado="S";
											$set->color="#0000";
											$set->fechacreacion=date("Y-m-d H:i:s");
 											$set->save();
										}
									}
									
									//printVar("keyproyecto = '".$_POST["key"]."' and idorigen=".$datos->id." and idorigen<>0");exit;
									$dat = new CDbCriteria;
									$dat->condition = "keyproyecto = '".$_POST["key"]."' and estado='S'";
									$dat->order="idorigen ASC";
 									$relxpro=AnaRelacionxproyecto::model()->findAll($dat);	
									if(isset($relxpro[0]->keyproyecto)){
										$norm=array();
										foreach($relxpro as $k=>$datos){
										$temporal=array();
										foreach($datos as $campo=>$valor){
											$temporal[$campo]=$valor;
										}
										$norm[$k]=(object)$temporal;
										}										
 									echo json_encode(array("ok",$norm));exit;
									}else{
										echo json_encode(array("no"));exit;
									}
									 
								break;
								//*****¨PARTICIPANTES
								case "participantes":
									$dat = new CDbCriteria;
									$dat->condition = "keyproyecto = '".$_POST["key"]."'";
									$dat->order="nombre ASC";
									//printVar($dat);exit;
									$participante=AnaParticipante::model()->findAll($dat);	
									$tipoedad=AnaTipoedad::model()->findAll();	
									$tipoantiguedad=AnaTipoantiguedad::model()->findAll();	
									$tipoestadocivil=AnaTipoestadocivil::model()->findAll();	
									$tiponivelacademico=AnaTiponivelacademico::model()->findAll();	
									if(isset($participante[0]->keyproyecto)){
										$norm=array();
										foreach($participante as $k=>$datos){
											$temporal=array();
											foreach($datos as $campo=>$valor){
												$temporal[$campo]=$valor;
											}
											$norm[$k]=(object)$temporal;
										}
										$tipoedadr=array();
										foreach($tipoedad as $pos=>$d){
 											foreach($d as $k=>$v){
												$tipoedadr[$pos][$k]=$v;
											}
										}
										
										$tipoantiguedadr=array();
										foreach($tipoantiguedad as $pos=>$d){
 											foreach($d as $k=>$v){
												$tipoantiguedadr[$pos][$k]=$v;
											}
										}
										
										$tipoestadocivilr=array();
										foreach($tipoestadocivil as $pos=>$d){
 											foreach($d as $k=>$v){
												$tipoestadocivilr[$pos][$k]=$v;
											}
										}
										
										$tiponivelacademicor=array();
										foreach($tiponivelacademico as $pos=>$d){
 											foreach($d as $k=>$v){
												$tiponivelacademicor[$pos][$k]=$v;
											}
										}
										
										
 										echo json_encode(array("ok",$norm,array("edad"=>$tipoedadr,"antiguedad"=>$tipoantiguedadr,"ecivil"=>$tipoestadocivilr,"nacademico"=>$tiponivelacademicor)));exit;
									}else{echo json_encode(array("no"));exit;}
								break;
								
								case "participante":
									$dat = new CDbCriteria;
									$dat->condition = "keyid = '".$_POST["key"]."'";
									$dat->order="nombre ASC";
									//printVar($dat);exit;
									$participante=AnaParticipante::model()->findAll($dat);	
									if(isset($participante[0]->keyproyecto)){
										$norm=array();
										foreach($participante as $k=>$datos){
											$temporal=array();
											foreach($datos as $campo=>$valor){
												$temporal[$campo]=$valor;
											}
											$norm=(object)$temporal;
										}
										echo json_encode(array("ok",$norm));exit;
									}else{echo json_encode(array("no"));exit;}
								break;
								
								case "eliminarparticipante":
									$dat = new CDbCriteria;
									$dat->condition = "keyid = '".$_POST["key"]."'";
									//printVar($dat);exit;
									$participante=AnaParticipante::model()->find($dat);
									
									if(isset($participante->keyproyecto)){ 
									$detalles=array();
									foreach($participante as $k=>$d){
										$detalles[$k]=$d;
									}
									$detalles="Datos participante: ".json_encode($detalles);
									
									$participante->delete();
										$dat = new CDbCriteria;
										$dat->condition = "keyidparticipante = '".$_POST["key"]."'or keyidparticipanteevaluador = '".$_POST["key"]."' ";
										//printVar($dat);exit;
										$participante=AnaEncuestaParticipanterelaciones::model()->findAll($dat);
										$tempo=array();										
										foreach($participante as $data){
											$dat = new CDbCriteria;
											$dat->condition = "keyid = '".$data->keyid."' ";
											//printVar($dat);exit;
											$atom=AnaEncuestaParticipanterelaciones::model()->find($dat);
											$datahistory=array();
											foreach($atom as $k=>$d){
												$datahistory[$k]=$d;
											}
											array_push($tempo,$datahistory);
											$atom->delete();
										}
										$detalles.=" Datos Relaciones: ".json_encode($tempo);
										
										$dat = new CDbCriteria;
										$dat->condition = "keyidevaluado = '".$_POST["key"]."'or keyidevaluador = '".$_POST["key"]."' ";
										//printVar($dat);exit;
										$participante=AnaEncuestaRespuestas::model()->findAll($dat);
										$tempo=array();											
										foreach($participante as $data){
											$dat = new CDbCriteria;
											$dat->condition = "keyid = '".$data->keyid."' ";
											//printVar($dat);exit;
											$atom=AnaEncuestaRespuestas::model()->find($dat);	
											$datahistory=array();
											foreach($atom as $k=>$d){
												$datahistory[$k]=$d;
											}
											array_push($tempo,$datahistory);											
											$atom->delete();
										}
										$detalles.=" Datos Respuestas: ".json_encode($tempo);
										$dat = new CDbCriteria;
										$dat->condition =  "keyidevaluado = '".$_POST["key"]."'or keyidevaluador = '".$_POST["key"]."' ";
										//printVar($dat);exit;
										$participante=AnaEncuestaRespuestasAbiertas::model()->findAll($dat);
										$tempo=array();											
										foreach($participante as $data){
											$dat = new CDbCriteria;
											$dat->condition = "keyid = '".$data->keyid."' ";
											//printVar($dat);exit;
											$atom=AnaEncuestaRespuestasAbiertas::model()->find($dat);	
											$datahistory=array();
											foreach($atom as $k=>$d){
												$datahistory[$k]=$d;
											}
											array_push($tempo,$datahistory);	
											$atom->delete();
										}
										$detalles.=" Datos Respuestas Abiertas: ".json_encode($tempo);
										$this->addEventos("Eliminar usuario ",$detalles);
										
										
										echo json_encode(array("ok"));exit;
									}else{echo json_encode(array("no"));exit;}
								break;
								
								/*COMPETENCIAS POR EVALUADO*/
								case "competenciasxevaluado":
									$dat = new CDbCriteria;
									$dat->condition = "keyproyecto = '".$_POST["key"]."' and retroalimentacion='S'";
									$dat->order="nombre ASC";
									//printVar($dat);exit;
									$participante=AnaParticipante::model()->findAll($dat);	
									if(isset($participante[0]->keyproyecto)){
										$norm=array();
										foreach($participante as $k=>$datos){
											$temporal=array();
											foreach($datos as $campo=>$valor){
												$temporal[$campo]=$valor;
											}
											$norm[$k]=(object)$temporal;
										}
										echo json_encode(array("ok",$norm));exit;
									}else{echo json_encode(array("no"));exit;}								
 								break;
								case "competenciasdisponibles":
									$dat = new CDbCriteria;
									$dat->condition = "keyproyecto = '".$_POST["keyidproyecto"]."' and keyid='".$_POST["keyid"]."'";
									$dat->order="nombre ASC";
									//printVar($dat);exit;
									$participante=AnaParticipante::model()->findAll($dat);	
									if(isset($participante[0]->keyproyecto)){
										$norm=array();
										foreach($participante as $k=>$datos){
											$temporal=array();
											foreach($datos as $campo=>$valor){
												$temporal[$campo]=$valor;
												if($campo=="jsoncompetencias"){ 
													$competencias=array();
 													if($valor=="{}"){
														$dat = new CDbCriteria;
														$dat->condition = "keyidproyecto = '".$_POST["keyidproyecto"]."'";
														$dat->order="idorden ASC";
														$competenciast=AnaEncuestaCompetenciaProyecto::model()->findAll($dat);	
 														foreach($competenciast as $datos){
															$competencias[$datos->keyid]=$datos->nombre_esp;
														}
														 
														//printVar($competencias);exit;
													}else{
														$jsondecode=json_decode($valor);
														$kyids=array();
														foreach($jsondecode as $kc=>$n){
															array_push($kyids,$kc);
														}
														
														$dat = new CDbCriteria;
														$dat->condition = "keyidproyecto = '".$_POST["keyidproyecto"]."' and keyid in ('".join("','",$kyids)."')";
														$dat->order="idorden ASC";
														$competenciast=AnaEncuestaCompetenciaProyecto::model()->findAll($dat);	
 														foreach($competenciast as $datos){
															$competencias[$datos->keyid]=$datos->nombre_esp;
														}
 													}
													$competenciasexclude=array();
													if(count($competencias)>0){
														$jsondecode=$competencias;
														$kyids=array();
														foreach($jsondecode as $kc=>$n){
															array_push($kyids,$kc);
														}
														
														$dat = new CDbCriteria;
														$dat->condition = "keyidproyecto = '".$_POST["keyidproyecto"]."' and keyid not in ('".join("','",$kyids)."')";
														$dat->order="idorden ASC";
														$competenciast=AnaEncuestaCompetenciaProyecto::model()->findAll($dat);	
 														foreach($competenciast as $datos){
															$competenciasexclude[$datos->keyid]=$datos->nombre_esp;
														}

													}
													
													$temporal[$campo]=((object)$competencias);
													$temporal["competenciasexclude"]=((object)$competenciasexclude);
 												}
											}
											$norm[$k]=(object)$temporal;
										}
										echo json_encode(array("ok",$norm));exit;
									}else{echo json_encode(array("no"));exit;}								
								break;
								
								case "actualizarcompetenciasparticipante":
									//printVar($_POST);

									$dat = new CDbCriteria;
									$dat->condition = "keyid = '".$_POST["keyid"]."' and retroalimentacion='S'";
									//printVar($dat);exit;
									$participante=AnaParticipante::model()->find($dat);	
									if(isset($participante->keyproyecto)){
										$participante->jsoncompetencias=json_encode((object)$_POST["competencias"]);
										$participante->save();
										echo json_encode(array("ok"));exit;
									}else{
										echo json_encode(array("no"));exit;
									}							
 								break;
								
							}
						break;
						case "editarparticipante":
							$dat = new CDbCriteria;
							$dat->condition = "keyid = '".$_POST["keyid"]."'    and keyproyecto='".$_POST["keyproyecto"]."'  ";
							// printVar($_POST);exit;
							$p=AnaParticipante::model()->find($dat);
							if(isset($p->keyid) and $this->validarPago($_POST["keyproyecto"],'PDF AVANZADO')==false){
								$dat = new CDbCriteria;
								$dat->condition = "keyid<> '".$_POST["keyid"]."'    and email='".$_POST["email"]."' and keyproyecto='".$_POST["keyproyecto"]."' ";
								// printVar($_POST);exit;
								$validaremail=AnaParticipante::model()->find($dat);
								if(!isset($validaremail->keyid)){	
 									$p->apellido=$_POST["apellido"];
									$p->nombre=$_POST["nombre"];
									$p->email=$_POST["email"];
									if($_POST["clave"]!=""){
										$p->clave=base64_encode($this->encrypt( $_POST["clave"],"lindosnenes"));
									}else{
										$clave=$this->generarKey(8);
										$p->clave=base64_encode($this->encrypt($clave,"lindosnenes"));  
									}
									
									if((int)$_POST["edad"]>0){
										$p->edad=(int)$_POST["edad"];
									}
									
									if((int)$_POST["genero"]>0){
										$p->genero=(int)$_POST["genero"];
									}
									
									if((int)$_POST["antiguedad"]>0){
										$p->antiguedad=(int)$_POST["antiguedad"];
									}
									
									
									if($_POST["ciudad"]!=""){
										$p->ciudad=$_POST["ciudad"];
									}
									
									if($_POST["pais"]!=""){
										$p->pais=$_POST["pais"];
									}
									
									if((int)$_POST["nacademico"]>0){
										$p->nivelacademico=(int)$_POST["nacademico"];
									}
									
									if((int)$_POST["ecivil"]>0){
										$p->estadocivil=(int)$_POST["ecivil"];
									}
									
									
									//printVar($p);exit;
									$p->retroalimentacion=$_POST["retroalimentacion"];
									$p->fechaactualizacion=date("Y-m-d H:i:s");
									$p->save(); 
									echo json_encode(array("ok"));exit;
								}else{
									echo json_encode(array("emailexiste"));exit;
								}
							}else{
								echo json_encode(array("no"));exit;
							}
						break;
						case "agregarparticipante":
							if($this->validarPago($_POST["keyproyecto"],'PDF AVANZADO')==false){
								$key=$this->generarKey();
								//printVar($participanteR);exit;
								$dat = new CDbCriteria;
								$dat->condition = "keyid='".$_POST["keyproyecto"]."'";
								$dataproyect=AnaProyecto::model()->find($dat);
								$accede=true;
								
								if($_POST["email"]=="" and $dataproyect->tipoproyecto==1){
									$dat = new CDbCriteria;
									$dat->condition = "  email='".$_POST["email"]."'  and keyproyecto='".$_POST["keyproyecto"]."'   ";
									// printVar($_POST);exit;
									$validaremail=AnaParticipante::model()->find($dat);
									if(!isset($validaremail->keyid)){
										$accede=true;
									}else{
										$accede=false;
									}
								}if($_POST["retroalimentacion"]!="S" and   $dataproyect->tipoproyecto!=1){
									$dat = new CDbCriteria;
									$dat->condition = "  email='".$_POST["email"]."'  and keyproyecto='".$_POST["keyproyecto"]."'   ";
									// printVar($_POST);exit;
									$validaremail=AnaParticipante::model()->find($dat);
									if(!isset($validaremail->keyid)){
										$accede=true;
									}else{
										$accede=false;
									}								
								}	
								
								if($accede==true){

									$dat = new CDbCriteria;
									$dat->condition = "apellido = '".$_POST["apellido"]."' and nombre ='".$_POST["nombre"]."' and keyproyecto='".$_POST["keyproyecto"]."'  ";
									//printVar($dat);exit;
									$existe=AnaParticipante::model()->find($dat);		

									/*if(isset($existe->apellido)){
										if($existe->apellido==$_POST["apellido"]){
										echo json_encode(array("existe"=>"SI"));
										//echo json_encode(array("key"=>$key,"existe"=>"NO"));
										exit;
										}
									}*/

									$dat = new CDbCriteria;
									$dat->condition = "keyid = '".$key."'";
									//printVar($dat);exit;
									$verificarkey=AnaParticipante::model()->find($dat);				
									 
									if(isset($verificarkey->{'keyid'})){
										$bandera=false;
										$contador=6;
										while($bandera==false){
											$key=$this->generarKey($contador);
											$dat = new CDbCriteria;
											$dat->condition = "keyid = '".$key."'";
											$verificarkey=AnaParticipante::model()->find($dat);
											if(!isset($verificarkey->{'keyid'})){
												$bandera=true;
											}
											$contador++;
										}
									}   
								
									$data = new AnaParticipante();
									$data->{'keyid'}=$key;
									$data->keyproyecto=$_POST["keyproyecto"];
									$data->nombre=$_POST["nombre"];
									$data->apellido=$_POST["apellido"];
									$data->email=$_POST["email"];
									$data->usuario=$_POST["usuario"];
									if((int)$_POST["edad"]>0){
										$data->edad=(int)$_POST["edad"];
									}
									
									if((int)$_POST["genero"]>0){
										$data->genero=(int)$_POST["genero"];
									}
									
									if((int)$_POST["antiguedad"]>0){
										$data->antiguedad=(int)$_POST["antiguedad"];
									}
									
									
									if($_POST["ciudad"]!=""){
										$data->ciudad=$_POST["ciudad"];
									}
									
									if($_POST["pais"]!=""){
										$data->pais=$_POST["pais"];
									}
									
									if((int)$_POST["nacademico"]>0){
										$data->nivelacademico=(int)$_POST["nacademico"];
									}
									
									if((int)$_POST["ecivil"]>0){
										$data->estadocivil=(int)$_POST["ecivil"];
									}
									
									$data->jsoncompetencias='{}';
									$data->idUsuario=Yii::app()->user->id;
									$data->fecharegistro=date("Y-m-d H:i:s");
									if($_POST["retroalimentacion"]=="S"){
										$data->retroalimentacion="S";
									}
									if($_POST["clave"]!=""){
										$data->clave= base64_encode($this->encrypt( $_POST["clave"],"lindosnenes"));
									}else{
										$clave=$this->generarKey(8);
										$data->clave= base64_encode($this->encrypt( $clave,"lindosnenes"));
									}
									//printVar($data);exit;  
									$data->save();
									echo json_encode(array("key"=>$key,"existe"=>"NO"));
								}else{
									echo json_encode(array("key"=>"NR","existe"=>"SI"));
								}
							}else{
								echo json_encode(array("key"=>$key,"existe"=>"NOPUEDEAGREGAR"));exit;
							}
 						break;
						case "descargarreportepdfAvanzado":
						//error_reporting(E_ALL);
							//ini_set('display_errors', '0');
							$subq="";
							$evaluado="";
							$participante["nombre"]="";
							$qcompetencias="";
							if(isset($_POST["selectedcomp"])){
								$subq=" and keyidparticipante='".$_POST["keyidparticipante"]."'";$evaluado="  and keyidevaluado='".$_POST["keyidparticipante"]."'";
								$rp=AnaParticipante::model()->findByPk($_POST["keyidparticipante"]);
								$participante["nombre"]=$rp->nombre." ".$rp->apellido;
								$qcompetencias=json_decode(base64_decode($_POST["selectedcomp"]));
								$qcompetencias=" and  keyid in ('".join("','",$qcompetencias)."')";
							} //printVar($subq);exit;
							$dat = new CDbCriteria;
							$dat->condition = "keyidproyecto = '".$_POST["keyid"]."'".$subq;
							//$dat->group="keyidparticipante";
							$participantes=AnaEncuestaParticipanterelaciones::model()->findAll($dat);
							$part=array();
							foreach($participantes as $k=>$data){
								array_push($part,$data);
							}
							//	printVar($part);exit;					
							$dat = new CDbCriteria;
							 
							$dat->condition = "keyidproyecto = '".$_POST["keyid"]."' and aplicar='1'";
							//$dat->group="keyidparticipante";
							$escalas=AnaEncuestaEscala::model()->find($dat);
							$esc=array();
							foreach($escalas as $k=>$data){
								$esc[$k]=$data;
							}
							
							$dat->condition = "keyidproyecto = '".$_POST["keyid"]."' and comentarios<>'' and comentarios is not NULL ".$evaluado; 
							
							$respuestasComentarios=AnaEncuestaRespuestas::model()->findAll($dat);
							$cxp=array();
							foreach($respuestasComentarios as $rcompreg){
								if($rcompreg->comentarios!=""){
									if(!isset($cxp[$rcompreg->keyidpregunta])){
										$cxp[$rcompreg->keyidpregunta][0]=$rcompreg->comentarios;
									}else{
										array_push($cxp[$rcompreg->keyidpregunta],$rcompreg->comentarios);
									}
								}
							}
//printVar($cxp);exit;							
							 
							$dat = new CDbCriteria;
							$dat->select="nombre,keyid,id_empresa,tipoproyecto";
							$dat->condition = "keyid = '".$_POST["keyid"]."'";
							//$dat->group="keyidparticipante";
							$proyecto=AnaProyecto::model()->find($dat);
							$pro=array();
							foreach($proyecto as $k=>$data){
								if($data!=""){
									$pro[$k]=$data;
								}
							}
							
							
							$dat = new CDbCriteria; 
							$dat->condition = "keyproyecto = '".$_POST["keyid"]."' ";
							//$dat->limit="5";
							//$dat->group="keyidparticipante";
							$relaciones=AnaRelacionxproyecto::model()->findAll($dat);
							$rel=array();
							$listarel=array();
							foreach($relaciones as $index=>$data){
								//$rel[$k]=(array)$data;
								
								$temp=array();
								$listarel[$data->keyid]=$data->nombre;
								foreach($data as $label=>$val){
									$temp[$label]=utf8_encode($val);
									 if($label=="keyid"){ 
										if($data->idorigen==3){
											$val="autoeval";
										}
										$dat = new CDbCriteria; 
										$dat->condition = "keyidproyecto = '".$_POST["keyid"]."' and keyidrelacion='".$val."' ".$subq;
										$dat->limit="5";
										//$dat->group="keyidparticipante";
										$relp=AnaEncuestaParticipanterelaciones::model()->count($dat);
										$temp["total"]=$relp;
									}
								}
								$rel[$index]=$temp;	
								 
								
							 }							
							 
							uasort($rel,function ($a, $b) {
								return $b['total'] - $a['total'];
							});
							
							$tres=array();
							$limite=5;
							$ini=1;
							foreach($rel as $data){
								if($ini<=5){
									array_push($tres,$data);
								}
								$ini++;
							}
							
							$rel=$tres;
							// printVar($rel);exit;  
							 
							 
							$dat = new CDbCriteria; 
							$dat->condition = "keyidproyecto = '".$_POST["keyid"]."' ".$evaluado;
 							$rabierta=AnaEncuestaRespuestasAbiertas::model()->findAll($dat);
							$ra=array();
							foreach($rabierta as $data){
								if($data->respuesta!="" ){
									$dat = new CDbCriteria; 
									$dat->condition = "keyid = '".$data->keyidpregunta."' ";
 									$pregunta=AnaEncuestaPreguntaabierta::model()->find($dat);
									if(!isset($ra[$pregunta->enunciado])){
										$ra[$pregunta->enunciado][0]=$data->respuesta;
									}else{
										array_push($ra[$pregunta->enunciado],$data->respuesta);
									}
									
								}
							}				
							
 							$dat = new CDbCriteria; 
							$dat->condition = "keyidproyecto = '".$_POST["keyid"]."' ".$qcompetencias;
							$dat->order="idOrden ASC";
							$competencias=AnaEncuestaCompetenciaProyecto::model()->findAll($dat);
							$concomp=array();
							$pup=array();
							$aup=array();
							$rup=array();
							$pupd=array();
							$aupd=array();
							$rupd=array();
							$pressave=array();
							$promxcom=array();
							$promxpreg=array();
							$resultadoempresa=array();
							$promedioxpreguntaAvg=array();
							foreach($competencias as $k=>$v){
								
								$dat = new CDbCriteria;       
								//$dat->condition = "keyidproyecto = '".$_POST["keyid"]."' and keyidcompetencia='".$v->keyid."' ".$evaluado;
								$dat->condition = "keyidproyecto = '".$_POST["keyid"]."' and keyidcompetencia='".$v->keyid."' ";
								$respuestas=AnaEncuestaRespuestas::model()->findAll($dat);
								/* TEST
								if($v->keyid=="D492S" ){
									$acumulado=array();
									foreach($respuestas as $datares){
										if($datares->keyidevaluado!=$_POST["keyidparticipante"] and (int) $datares->respuesta>0){
										 
											array_push($acumulado,$datares->respuesta);
											 
										}
									}
									$r=array_sum($acumulado)/count($acumulado);
									printVar($r);
									exit;
								} 
								*/
 								
								$tAutoevas=array();
								$tOtros=array();
								$tSimismo=array();
								$tRelaciones=array();  
								$dat = new CDbCriteria; 
								$dat->condition = "keyidproyecto = '".$_POST["keyid"]."' and keyidcompetencia='".$v->keyid."' ";
								$tpre=AnaEncuestaPreguntasxcompetenciasProyecto::model()->count($dat);
								//$dat = new CDbCriteria; 
								//$dat->condition = "keyidproyecto = '".$_POST["keyid"]."' and keyidcompetencia='".$v->keyid."' ";
								$precom=AnaEncuestaPreguntasxcompetenciasProyecto::model()->findAll($dat);
								
								foreach($precom as $key=>$pres){
									$kpa=$pres->keyidpregunta; 
									$dat = new CDbCriteria; 
 									$dat->condition = "keyidpregunta= '".$kpa."' and keyidcompetencia='".$v->keyid."' and respuesta<>'N/A' ".$evaluado;
									$resp=AnaEncuestaRespuestas::model()->findAll($dat);
									$rx=array();
									$trel=array();
									$promedioxpregunta=array();
									foreach($resp as $datares){
										$dat = new CDbCriteria; 
										$dat->condition = "keyidparticipante= '".$datares->keyidevaluado."' and keyidparticipanteevaluador='".$datares->keyidevaluador."'";
										$rela=AnaEncuestaParticipanterelaciones::model()->find($dat);
										$nrela=(object)array("nombre"=>"Autoevaluacion");
										if($rela->keyidparticipante!=$rela->keyidparticipanteevaluador){
											$nrela=AnaRelacionxproyecto::model()->findByPk($rela->keyidrelacion);
										} 
										$nrelacion=$nrela->nombre;
										if(!isset($rx[$nrelacion])){
											$rx[$nrelacion]=$datares->respuesta;
											$trel[$nrelacion]=1;
										}else{
											$rx[$nrelacion]+=$datares->respuesta;
											$trel[$nrelacion]=$trel[$nrelacion]+1;
										}
										 
										if($nrelacion!="Autoevaluacion" and $datares->respuesta!="N/A" ){
											if(!isset($promedioxpregunta[0])){
												$promedioxpregunta[0]=$datares->respuesta;
											}else{
												array_push($promedioxpregunta,$datares->respuesta);
											}
										}
										if($datares->respuesta!="N/A"){
											 if(!isset($promedioxpreguntaAvg[$v->nombre_esp][$nrela->nombre][$datares->keyidpregunta])){
												$promedioxpreguntaAvg[$v->nombre_esp][$nrela->nombre][$datares->keyidpregunta][0]=$datares->respuesta;
											 }else{
												array_push($promedioxpreguntaAvg[$v->nombre_esp][$nrela->nombre][$datares->keyidpregunta],$datares->respuesta);
											 }											
										}
 									} 
									$promediot=0;	
								    $contadort=0;
									 
									 
									foreach($rx as $relt=>$cal){
										$rx[$relt]=$rx[$relt]/$trel[$relt]; 
										if($relt!="Autoevaluacion" and $rx[$relt]!="N/A"){
											$promediot=$promediot+$rx[$relt];
											if(!isset($promxpreg[$kpa])){
												$promxpreg[$kpa][0]=$rx[$relt];
											}else{
												array_push($promxpreg[$kpa] , $rx[$relt]);
											}
											$contadort++;
										}
									}
									
									if($contadort>0){
										$promediot=$promediot/$contadort;
									}else{
										$promediot=0;
									}
									
									if(count($promedioxpregunta)>0){
								 	//printVar(array_sum($promedioxpregunta),count($promedioxpregunta));
 										$promedioxpregunta=$this->round_up(array_sum($promedioxpregunta)/count($promedioxpregunta),2);
									}else{
										$promedioxpregunta=0;
									}
									
									ksort($rx);    
									$dat = new CDbCriteria; 
									$dat->condition = "keyid= '".$kpa."'";
									$enunciado=AnaEncuestaPreguntaProyecto::model()->find($dat);
 									if(!isset($pressave[$v->keyid])){
										$pressave[$v->keyid][0]=array(
											"enunciado"=>$enunciado->enunciado_esp,
											"respuesta"=>$rx,
											"promedio"=>$promedioxpregunta,
											"keyidpregunta"=>$kpa
										);
										
									}else{
										array_push($pressave[$v->keyid],array(
											"enunciado"=>$enunciado->enunciado_esp,
											"respuesta"=>$rx,
											"promedio"=>$promedioxpregunta,
											"keyidpregunta"=>$kpa
										));
									}   
									
								}
								//exit;
								// printVar($pressave,"press");exit;   
 								foreach($respuestas as $kr=>$vr){ 
									$dat = new CDbCriteria; 
									$dat->condition = "keyid = '".$vr->keyidpregunta."' ";
									$pregunta=AnaEncuestaPreguntaProyecto::model()->find($dat); 
									
									if($vr->respuesta!="N/A"){
										if(!isset($pupd[$pregunta->keyid])){
											$pupd[$pregunta->keyid]=array("enunciado"=>$pregunta->enunciado_esp,"competencia"=>$v->nombre_esp);
											if($vr->keyidevaluado!=$vr->keyidevaluador){
												$pup[$pregunta->keyid][0]=($vr->respuesta*100)/$esc["rango"];
											}
										}else{
											if($vr->keyidevaluado!=$vr->keyidevaluador){
												array_push($pup[$pregunta->keyid],($vr->respuesta*100)/$esc["rango"]);
											}
										}
 										if(isset($_POST["keyidparticipante"])){
											if($vr->keyidevaluado!=$vr->keyidevaluador and $vr->keyidevaluado==$_POST["keyidparticipante"]){
     
												array_push($tAutoevas,($vr->respuesta*100)/$esc["rango"]);
												if(!isset($rupd[$pregunta->keyid])){
													$rupd[$pregunta->keyid]=array("enunciado"=>$pregunta->enunciado_esp,"competencia"=>$v->nombre_esp);
													$rup[$pregunta->keyid][0]=($vr->respuesta*100)/$esc["rango"];
												}else{
													//array_push($rupd[$pregunta->keyid],array("enunciado"=>$pregunta->enunciado_esp,"competencia"=>$v->nombre_esp));
													array_push($rup[$pregunta->keyid],($vr->respuesta*100)/$esc["rango"]);
												}
  											}else if($vr->keyidevaluado==$vr->keyidevaluador and $vr->keyidevaluado==$_POST["keyidparticipante"]){
												if(!isset($aupd[$pregunta->keyid])){
													$aupd[$pregunta->keyid]=array("enunciado"=>$pregunta->enunciado_esp,"competencia"=>$v->nombre_esp);
													$aup[$pregunta->keyid][0]=($vr->respuesta*100)/$esc["rango"];
												}else{
													//array_push($aupd[$pregunta->keyid],array("enunciado"=>$pregunta->enunciado_esp,"competencia"=>$v->nombre_esp));
													array_push($aup[$pregunta->keyid],($vr->respuesta*100)/$esc["rango"]);
												}
												//array_push($resultadoempresa,($vr->respuesta*100)/$esc["rango"]);
												array_push($tSimismo,($vr->respuesta*100)/$esc["rango"]);
												if($vr->respuesta!="N/A"){
													if(isset($resultadoempresa[$v->keyid])){
 														array_push($resultadoempresa[$v->keyid],$vr->respuesta);
 													}else{
														$resultadoempresa[$v->keyid][0]=$vr->respuesta;
													}
												}
												
												
												
											}else if($vr->keyidevaluado!=$vr->keyidevaluador and /*$vr->keyidevaluado!=$_POST["keyidparticipante"] and */  (int)$vr->respuesta>0 ){
							
												
 												$dat = new CDbCriteria; 
												$dat->condition = "  keyidparticipante='".$vr->keyidevaluado."' and keyidparticipanteevaluador='".$vr->keyidevaluador."' ";
												$temrelacion=AnaEncuestaParticipanterelaciones::model()->find($dat);
												if(isset($temrelacion->keyid)){
													$dat = new CDbCriteria; 
													$dat->condition = " keyid='".$temrelacion->keyidrelacion."'";
													$relus=AnaRelacionxproyecto::model()->find($dat);
													//printVar($relus);
													if(isset($relus->keyid)){
														if(!isset($tRelaciones[$relus->nombre])){
															$tRelaciones[$relus->nombre][0]=($vr->respuesta*100)/$esc["rango"];
														}else{
															array_push($tRelaciones[$relus->nombre],($vr->respuesta*100)/$esc["rango"]);
														}
													}
												}
												if($vr->respuesta!="N/A"){
													array_push($tOtros,($vr->respuesta*100)/$esc["rango"]);
													if(!isset($promxcom[$v->keyid])){
													//	$promxcom[$v->keyid][0]=($vr->respuesta*100)/$esc["rango"];
														$promxcom[$v->keyid][0]=$vr->respuesta;
													}else{
														
														//array_push($promxcom[$v->keyid],($vr->respuesta*100)/$esc["rango"]);
														array_push($promxcom[$v->keyid],$vr->respuesta);
													}
													//printVar($promxcom[$v->keyid],$v->keyid);
												}
												if($vr->respuesta!="N/A"){
													if(isset($resultadoempresa[$v->keyid])){
 														array_push($resultadoempresa[$v->keyid],$vr->respuesta);
 													}else{
														$resultadoempresa[$v->keyid][0]=$vr->respuesta;
													}
												}
											}
											
 
										}else{
											if($vr->keyidevaluado==$vr->keyidevaluador){
												if(!isset($aupd[$pregunta->keyid])){
													$aupd[$pregunta->keyid]=array("enunciado"=>$pregunta->enunciado_esp,"competencia"=>$v->nombre_esp);
													$aup[$pregunta->keyid][0]=($vr->respuesta*100)/$esc["rango"];
												}else{
													//array_push($aupd[$pregunta->keyid],array("enunciado"=>$pregunta->enunciado_esp,"competencia"=>$v->nombre_esp));
													array_push($aup[$pregunta->keyid],($vr->respuesta*100)/$esc["rango"]);
												}
												array_push($tAutoevas,($vr->respuesta*100)/$esc["rango"]);
											}else{
							
												if(!isset($rupd[$pregunta->keyid])){
													$rupd[$pregunta->keyid]=array("enunciado"=>$pregunta->enunciado_esp,"competencia"=>$v->nombre_esp);
													$rup[$pregunta->keyid][0]=($vr->respuesta*100)/$esc["rango"];
												}else{
													//array_push($rupd[$pregunta->keyid],array("enunciado"=>$pregunta->enunciado_esp,"competencia"=>$v->nombre_esp));
													array_push($rup[$pregunta->keyid],($vr->respuesta*100)/$esc["rango"]);
												}
												$dat = new CDbCriteria; 
												$dat->condition = " keyidproyecto='".$_POST["keyid"]."' and keyidrelacion not in ('autoeval','NR') and keyidparticipante<>'".$_POST['keyidparticipante']."' and  keyidparticipanteevaluador='".$vr->keyidevaluador."' ";
												$demasparticipantes=AnaEncuestaParticipanterelaciones::model()->find($dat);
												foreach($demasparticipantes as $participante){	
													$dat = new CDbCriteria;   
													$dat->condition = "  keyidparticipante='".$participante->keyidevaluado."' and keyidparticipanteevaluador='".$participante->keyidevaluador."' ";
													$temrelacion=AnaEncuestaParticipanterelaciones::model()->find($dat);
													if(isset($temrelacion->keyid)){
														$dat = new CDbCriteria; 
														$dat->condition = " keyid='".$temrelacion->keyidrelacion."'";
														$relus=AnaRelacionxproyecto::model()->find($dat);
														//printVar($relus);
														if(isset($relus->keyid)){
															if(!isset($tRelaciones[$relus->nombre])){
																$tRelaciones[$relus->nombre][0]=($participante->respuesta*100)/$esc["rango"];
															}else{
																array_push($tRelaciones[$relus->nombre],($participante->respuesta*100)/$esc["rango"]);
															}
														}
													}
													array_push($tOtros,($participante->respuesta*100)/$esc["rango"]);
												}
												
												
											}
										}
										 
									}
								} 
								 
								// printVar($resultadoempresa);exit;
								//$tOtros=$resultadoempresa;  
								 
								if(count($tAutoevas)>0){
									$tAutoevas=array_sum($tAutoevas)/count($tAutoevas);
								}else{$tAutoevas=0;}
								if(count($tSimismo)>0){
									$tSimismo=array_sum($tSimismo)/count($tSimismo);
								}else{$tSimismo=0;}
								if(count($tOtros)>0){
									$tOtros=array_sum($tOtros)/count($tOtros);
								}else{$tOtros=0;} 
								//printVar($tOtros);exit; 
								foreach($tRelaciones as $indexr=>$ev){
									if(count($ev)>0){
										$tRelaciones[$indexr]=array_sum($ev)/count($ev);
									}else{
										$tRelaciones[$indexr]=0;
									}
								}
								
								
								
								array_push($concomp,array("keyid"=>$v->keyid,"competencia"=>$v->nombre_esp,"simismo"=>$tSimismo,"tauto"=>$tAutoevas,"totros"=>$tOtros,"dif"=>($tAutoevas-$tOtros),"descripcion"=>$v->descripcion_esp,"tpreg"=>$tpre,"resxrel"=>$tRelaciones));
							} 
							 
							$tPoomCOmpAVG=array(); 
							$tPoomRELmpAVG=array();
							$tPoomCORELmpAVG=array();
							foreach($promedioxpreguntaAvg as $compeAVG=>$datarelAVG){
								foreach($datarelAVG as $relAVG=>$califAVG ){
									
									if( $relAVG!="Autoevaluacion"){
										foreach($califAVG as $rcalAVG){
											foreach($rcalAVG as $atomcal){
												if(!isset($tPoomCOmpAVG[$compeAVG])){
													$tPoomCOmpAVG[$compeAVG][0]=$atomcal;
												}else{
													array_push($tPoomCOmpAVG[$compeAVG],$atomcal);
												}
											}
										}
									}
									foreach($califAVG as $rcalAVG){
										foreach($rcalAVG as $atomcal){
											if(!isset($tPoomRELmpAVG[$relAVG])){
												$tPoomRELmpAVG[$relAVG][0]=$atomcal;
											}else{
												array_push($tPoomRELmpAVG[$relAVG],$atomcal);
											}
											if(!isset($tPoomCORELmpAVG[$compeAVG][$relAVG])){
												$tPoomCORELmpAVG[$compeAVG][$relAVG][0]=$atomcal;
											}else{
												array_push($tPoomCORELmpAVG[$compeAVG][$relAVG],$atomcal);
											}
										}
									}
									
									
								}
							}
							
							$competenciasAVG=array();
 							foreach($tPoomCORELmpAVG as $compAVG=>$relAVG){
								foreach($relAVG as $relKey=>$cal){
									$tPoomCORELmpAVG[$compAVG][$relKey]=number_format((array_sum($cal)/count($cal)),2);
								}
								array_push($competenciasAVG,$compAVG);
							}
							asort($competenciasAVG);
							$promedioRelAVG=array();
							$relacionesAVG=array();
 							foreach($tPoomRELmpAVG as $relacionAVG=>$calAVG){
								$rcAVG=number_format((array_sum($calAVG)/count($calAVG)),2);
								$tPoomRELmpAVG[$relacionAVG]=$rcAVG; 
								 if($relacionAVG!="Autoevaluacion"){
									foreach($calAVG as $atomAVG){
										array_push($promedioRelAVG, $atomAVG);
									}
									 
									 
								 }
								array_push( $relacionesAVG, $relacionAVG);
 							}
							asort( $relacionesAVG);
 							$promedioRelAVG=number_format((array_sum($promedioRelAVG)/count($promedioRelAVG)),2);
							$tPoomRELmpAVG["promedio"]=$promedioRelAVG;
							$promedioCOAVG=array();
 							foreach($tPoomCOmpAVG as $compoAVG=>$calAVG){
									$rcAVG=number_format((array_sum($calAVG)/count($calAVG)),2);
 									$tPoomCOmpAVG[$compoAVG]=$rcAVG; 
									//if($relacionAVG!="Autoevaluacion"){
										foreach($calAVG as $atomAVG){
											array_push($promedioCOAVG, $atomAVG);
										}
										 
										 
									//}
 							}
							$promedioCOAVG=number_format((array_sum($promedioCOAVG)/count($promedioCOAVG)),2);
							$tPoomCOmpAVG["promedio"]=$promedioCOAVG;
 							   
							// printVar($concomp[0]["totros"],$concomp[0]["competencia"]);exit;
							
							foreach($pup as $kdi=>$calf){
								if(count($calf)>0){
									$pup[$kdi]=number_format((array_sum($calf)/count($calf)),3);
								}else{
									$pup[$kdi]=0;
								}
							}
 
							foreach($aup as $kdi=>$calf){
								if(count($calf)>0){
									$aup[$kdi]=number_format((array_sum($calf)/count($calf)),3);
								}else{
									$aup[$kdi]=0;
								}
							}

							foreach($rup as $kdi=>$calf){
								if(count($calf)>0){
									$rup[$kdi]=number_format((array_sum($calf)/count($calf)),3);
								}else{
									$rup[$kdi]=0;
								}
							}
  							array_multisort($pup,SORT_DESC);
							$tempo=$pup;
						    array_multisort($tempo,SORT_ASC);
							$pdw=$tempo;
							array_multisort($aup,SORT_DESC);
							$tempo=$aup;
						    array_multisort($tempo,SORT_ASC);
							$adw=$tempo;
							array_multisort($rup,SORT_DESC);
							$tempo=$rup;
						    array_multisort($tempo,SORT_ASC);
							$rdw=$tempo;
						//  printVar($rup);exit;
							//$promxcom=$resultadoempresa;
							if(count($promxcom)>0){
								
								foreach($promxcom as $kcomp=>$cal){
									$promxcom[$kcomp]=array_sum($cal)/count($cal);
								}
							}							
							if(count($promxpreg)>0){
								
								foreach($promxpreg as $kpreg=>$cal){
									$promxpreg[$kpreg]=array_sum($cal)/count($cal);
								}
							}							

 						 
							$comportamientos=array(
							"pup"=>$pup,
							"pupd"=>$pupd,
							"pdw"=>$pdw,
							 "aup"=>$aup,
							"aupd"=>$aupd,
							"adw"=>$adw,
							 "rup"=>$rup,
							"rupd"=>$rupd,
							"rdw"=>$rdw, 
							);
							 
							//printVar($pressave);exit;  					 
							$oRecord = User::model()->findByPk(Yii::app()->user->id); 
							$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
							$us=array();
							foreach($dUsuario as $k=>$data){
								$us[$k]=$data;
							}
							// printVar($pressave);exit;   
							$report["ra"]=$ra;      
							$report["participante"]=$participante["nombre"];      
							$report["rango"]=$esc["rango"];       
							$report["rel"]=$rel;
							$report["escalas"]=$esc;
							$report["competencias"]=$concomp;  
							$report["pxcom"]=$promxcom;  
							$report["pxpreg"]=$promxpreg;  
							$report["preguntasxcompetencias"]=$pressave;  
							$report["comportamientos"]=$comportamientos; 
 							
							$report["avanzado"]=array(
 												"competencias"=>$competenciasAVG,
												"relaciones"=>$relacionesAVG,
												"tpcomp"=>$tPoomCOmpAVG,
												"tprel"=>$tPoomRELmpAVG,
												"tpcorel"=>$tPoomCORELmpAVG,
												"comentarios"=>$cxp
												); 
							
							
							 
							
						$datson=json_encode(array("p"=>base64_encode(json_encode($pro)),"us"=>base64_encode(json_encode($us)),"report"=>base64_encode(json_encode($report))));
						$nombre_archivo=date("Y-m-d H-i-s").".txt";    
						 
						if($archivo = fopen($_SERVER["DOCUMENT_ROOT"].Yii::app()->baseUrl."/tmp/json/".$nombre_archivo, "a"))
						{ 
							if(fwrite($archivo, $datson))
							{
								echo json_encode(array($nombre_archivo,explode("index.php",$_SERVER["SCRIPT_NAME"])));
							}
							else
							{
								echo json_encode(array("error"));
							}
 							fclose($archivo);
						} else{
							echo json_encode(array("error al crear archivo ".$nombre_archivo));
						}
						 
						 
						 
						 
						 exit;
						break;
						case "descargarreportepdf":
							//error_reporting(E_ALL);
							//ini_set('display_errors', '0');
							$subq="";
							$evaluado="";
							$participante["nombre"]="";
							$qcompetencias="";
							if(isset($_POST["keyidparticipante"])){
								$subq=" and keyidparticipante='".$_POST["keyidparticipante"]."'";$evaluado="  and keyidevaluado='".$_POST["keyidparticipante"]."'";
								$rp=AnaParticipante::model()->findByPk($_POST["keyidparticipante"]);
								$participante["nombre"]=$rp->nombre." ".$rp->apellido;
								$qcompetencias=json_decode(base64_decode($_POST["selectedcomp"]));
								$qcompetencias=" and  keyid in ('".join("','",$qcompetencias)."')";
							} //printVar($subq);exit;
							$dat = new CDbCriteria;
							$dat->condition = "keyidproyecto = '".$_POST["keyid"]."'".$subq;
							//$dat->group="keyidparticipante";
							$participantes=AnaEncuestaParticipanterelaciones::model()->findAll($dat);
							$part=array();
							foreach($participantes as $k=>$data){
								array_push($part,$data);
							}
							
							
							$rta=array();
							$idCom=0;
							foreach($participantes as $relacion){ 
								/*$dat = new CDbCriteria;
								$dat->condition = "keyidevaluado = '".$relacion->keyidparticipante."' and  keyidevaluador = '".$relacion->keyidparticipanteevaluador."' ";
								$resultados=AnaEncuestaRespuestas::model()->find($dat);	
								 */
								$objec=json_decode($relacion->jsonrtemp);
								//$rta
								//printVar($objec);
								$trpe=array();
 								if(isset($objec->comentarios)){
									$keyidenunciados=array();
									
									foreach($objec->comentarios as $keyid=>$res){
										$dat = new CDbCriteria;
										$dat->condition = "keyid = '".$keyid."' ";
										$comentarios=AnaEncuestaPreguntaabierta::model()->find($dat);
										$keyidenunciados[$keyid]=$comentarios->enunciado;
 										if($res!="" and isset($rta[$comentarios->enunciado])){
											array_push($rta[$comentarios->enunciado],$res);
											$idCom++;
										}else if($res!="" and !isset($rta[$comentarios->enunciado])){
											$rta[$comentarios->enunciado][0]=$res;
											$idCom++;
										}
									}
									
								}
								
							}							
 							$ra=$rta;
							//	printVar($part);exit;					
							$dat = new CDbCriteria;
							 
							$dat->condition = "keyidproyecto = '".$_POST["keyid"]."' and aplicar='1'";
							//$dat->group="keyidparticipante";
							$escalas=AnaEncuestaEscala::model()->find($dat);
							$esc=array();
							foreach($escalas as $k=>$data){
								$esc[$k]=$data;
							}
							 
							$dat = new CDbCriteria;
							$dat->select="nombre,keyid,id_empresa,tipoproyecto";
							$dat->condition = "keyid = '".$_POST["keyid"]."'";
							//$dat->group="keyidparticipante";
							$proyecto=AnaProyecto::model()->find($dat);
							$pro=array();
							foreach($proyecto as $k=>$data){
								if($data!=""){
									$pro[$k]=$data;
								}
							}
							
							
							$dat = new CDbCriteria; 
							$dat->condition = "keyproyecto = '".$_POST["keyid"]."' ";
							//$dat->limit="5";
							//$dat->group="keyidparticipante";
							$relaciones=AnaRelacionxproyecto::model()->findAll($dat);
							$rel=array();
							$listarel=array();
							foreach($relaciones as $index=>$data){
								//$rel[$k]=(array)$data;
								
								$temp=array();
								$listarel[$data->keyid]=$data->nombre;
								foreach($data as $label=>$val){
									$temp[$label]=utf8_encode($val);
									 if($label=="keyid"){ 
										if($data->idorigen==3){
											$val="autoeval";
										}
										$dat = new CDbCriteria; 
										$dat->condition = "keyidproyecto = '".$_POST["keyid"]."' and keyidrelacion='".$val."' ".$subq;
										$dat->limit="5";
										//$dat->group="keyidparticipante";
										$relp=AnaEncuestaParticipanterelaciones::model()->count($dat);
										$temp["total"]=$relp;
									}
								}
								$rel[$index]=$temp;	
								 
								
							 }							
							 
							uasort($rel,function ($a, $b) {
								return $b['total'] - $a['total'];
							});
							
							$tres=array();
							$limite=5;
							$ini=1;
							foreach($rel as $data){
								if($ini<=5){
									array_push($tres,$data);
								}
								$ini++;
							}
							
							$rel=$tres;
							 //printVar($rel);exit;  
							 
							 
							$dat = new CDbCriteria; 
							$dat->condition = "keyidproyecto = '".$_POST["keyid"]."' ".$evaluado;
 							$rabierta=AnaEncuestaRespuestasAbiertas::model()->findAll($dat);
							/*$ra=array();
							
							foreach($rabierta as $data){
								if($data->respuesta!="" ){
									$dat = new CDbCriteria; 
									$dat->condition = "keyid = '".$data->keyidpregunta."' ";
 									$pregunta=AnaEncuestaPreguntaabierta::model()->find($dat);
									if(!isset($ra[$pregunta->enunciado])){
										$ra[$pregunta->enunciado][0]=$data->respuesta;
									}else{
										array_push($ra[$pregunta->enunciado],$data->respuesta);
									}
									
								}
							}*/
  							
 							$dat = new CDbCriteria; 
							$dat->condition = "keyidproyecto = '".$_POST["keyid"]."' ".$qcompetencias;
							$dat->order="idOrden ASC";
							$competencias=AnaEncuestaCompetenciaProyecto::model()->findAll($dat);
							$concomp=array();
							$pup=array();
							$aup=array();
							$rup=array();
							$pupd=array();
							$aupd=array();
							$rupd=array();
							$pressave=array();
							$promxcom=array();
							$promxpreg=array();
							$resultadoempresa=array();
							foreach($competencias as $k=>$v){
								
								$dat = new CDbCriteria;       
								//$dat->condition = "keyidproyecto = '".$_POST["keyid"]."' and keyidcompetencia='".$v->keyid."' ".$evaluado;
								$dat->condition = "keyidproyecto = '".$_POST["keyid"]."' and keyidcompetencia='".$v->keyid."' ";
								$respuestas=AnaEncuestaRespuestas::model()->findAll($dat);
								if($v->keyid=="NPA52"){// TEST
								//printVar($respuestas);exit;
								}
								/* TEST
								if($v->keyid=="D492S" ){
									$acumulado=array();
									foreach($respuestas as $datares){
										if($datares->keyidevaluado!=$_POST["keyidparticipante"] and (int) $datares->respuesta>0){
										 
											array_push($acumulado,$datares->respuesta);
											 
										}
									}
									$r=array_sum($acumulado)/count($acumulado);
									printVar($r);
									exit;
								} 
								*/
 								
								$tAutoevas=array();
								$tOtros=array();
								$tSimismo=array();
								$tRelaciones=array();  
								$dat = new CDbCriteria; 
								$dat->condition = "keyidproyecto = '".$_POST["keyid"]."' and keyidcompetencia='".$v->keyid."' ";
								$tpre=AnaEncuestaPreguntasxcompetenciasProyecto::model()->count($dat);
								//$dat = new CDbCriteria; 
								//$dat->condition = "keyidproyecto = '".$_POST["keyid"]."' and keyidcompetencia='".$v->keyid."' ";
								$precom=AnaEncuestaPreguntasxcompetenciasProyecto::model()->findAll($dat);
								
								foreach($precom as $key=>$pres){
									$kpa=$pres->keyidpregunta; 
									$dat = new CDbCriteria; 
 									$dat->condition = "keyidpregunta= '".$kpa."' and keyidcompetencia='".$v->keyid."' and respuesta<>'N/A' ".$evaluado;
									$resp=AnaEncuestaRespuestas::model()->findAll($dat);
									$rx=array();
									$trel=array();
									$promedioxpregunta=array();
									foreach($resp as $datares){
										$dat = new CDbCriteria; 
										$dat->condition = "keyidparticipante= '".$datares->keyidevaluado."' and keyidparticipanteevaluador='".$datares->keyidevaluador."'";
										$rela=AnaEncuestaParticipanterelaciones::model()->find($dat);
										$nrela=(object)array("nombre"=>"Autoevaluacion");
										if($rela->keyidparticipante!=$rela->keyidparticipanteevaluador){
											$nrela=AnaRelacionxproyecto::model()->findByPk($rela->keyidrelacion);
										} 
										$nrelacion=$nrela->nombre;
										if(!isset($rx[$nrelacion])){
											$rx[$nrelacion]=$datares->respuesta;
											$trel[$nrelacion]=1;
										}else{
											$rx[$nrelacion]+=$datares->respuesta;
											$trel[$nrelacion]=$trel[$nrelacion]+1;
										}
										 
										if($nrelacion!="Autoevaluacion" and $datares->respuesta!="N/A" ){
											if(!isset($promedioxpregunta[0])){
												$promedioxpregunta[0]=$datares->respuesta;
											}else{
												array_push($promedioxpregunta,$datares->respuesta);
											}
										}
 									} 
									$promediot=0;	
								    $contadort=0;
									 
									 
									foreach($rx as $relt=>$cal){
										$rx[$relt]=$rx[$relt]/$trel[$relt]; 
										if($relt!="Autoevaluacion" and $rx[$relt]!="N/A"){
											$promediot=$promediot+$rx[$relt];
											if(!isset($promxpreg[$kpa])){
												$promxpreg[$kpa][0]=$rx[$relt];
											}else{
												array_push($promxpreg[$kpa] , $rx[$relt]);
											}
											$contadort++;
										}
									}
									
									if($contadort>0){
										$promediot=$promediot/$contadort;
									}else{
										$promediot=0;
									}
									
									if(count($promedioxpregunta)>0){
								 	//printVar(array_sum($promedioxpregunta),count($promedioxpregunta));
 										$promedioxpregunta=$this->round_up(array_sum($promedioxpregunta)/count($promedioxpregunta),2);
									}else{
										$promedioxpregunta=0;
									}
									
									ksort($rx);    
									$dat = new CDbCriteria; 
									$dat->condition = "keyid= '".$kpa."'";
									$enunciado=AnaEncuestaPreguntaProyecto::model()->find($dat);
 									if(!isset($pressave[$v->keyid])){
										$pressave[$v->keyid][0]=array(
											"enunciado"=>$enunciado->enunciado_esp,
											"respuesta"=>$rx,
											"promedio"=>$promedioxpregunta,
											"keyidpregunta"=>$kpa
										);
										
									}else{
										array_push($pressave[$v->keyid],array(
											"enunciado"=>$enunciado->enunciado_esp,
											"respuesta"=>$rx,
											"promedio"=>$promedioxpregunta,
											"keyidpregunta"=>$kpa
										));
									}   
									
								}
								//exit;
								// printVar($pressave,"press");exit;   
 								foreach($respuestas as $kr=>$vr){ 
									$dat = new CDbCriteria; 
									$dat->condition = "keyid = '".$vr->keyidpregunta."' ";
									$pregunta=AnaEncuestaPreguntaProyecto::model()->find($dat); 
									
									if($vr->respuesta!="N/A"){
										
										if(!isset($pupd[$pregunta->keyid])){ 
										    
											$pupd[$pregunta->keyid]=array("enunciado"=>$pregunta->enunciado_esp,"competencia"=>$v->nombre_esp);
											
											if($vr->keyidevaluado!=$vr->keyidevaluador){  
												
												if(!isset($pup[$pregunta->keyid][0])){
													$pup[$pregunta->keyid][0]=(($vr->respuesta*100)/$esc["rango"]);
												}else{
 												 array_push($pup[$pregunta->keyid],(($vr->respuesta*100)/$esc["rango"]));
												}
											}  
										}else if($vr->keyidevaluado!=$vr->keyidevaluador){  
												if(!isset($pup[$pregunta->keyid][0])){
													$pup[$pregunta->keyid][0]=(($vr->respuesta*100)/$esc["rango"]);
												}else{
 												 array_push($pup[$pregunta->keyid],(($vr->respuesta*100)/$esc["rango"]));
												}
																					
										}    
 										
 										if(isset($_POST["keyidparticipante"])){
											if($vr->keyidevaluado!=$vr->keyidevaluador and $vr->keyidevaluado==$_POST["keyidparticipante"]){
     
												array_push($tAutoevas,($vr->respuesta*100)/$esc["rango"]);
												if(!isset($rupd[$pregunta->keyid])){
													$rupd[$pregunta->keyid]=array("enunciado"=>$pregunta->enunciado_esp,"competencia"=>$v->nombre_esp);
													$rup[$pregunta->keyid][0]=($vr->respuesta*100)/$esc["rango"];
												}else{
													//array_push($rupd[$pregunta->keyid],array("enunciado"=>$pregunta->enunciado_esp,"competencia"=>$v->nombre_esp));
													array_push($rup[$pregunta->keyid],($vr->respuesta*100)/$esc["rango"]);
												}
  											}else if($vr->keyidevaluado==$vr->keyidevaluador and $vr->keyidevaluado==$_POST["keyidparticipante"]){
												if(!isset($aupd[$pregunta->keyid])){
													$aupd[$pregunta->keyid]=array("enunciado"=>$pregunta->enunciado_esp,"competencia"=>$v->nombre_esp);
													if(!isset($aup[$pregunta->keyid][0])){
														$aup[$pregunta->keyid][0]=($vr->respuesta*100)/$esc["rango"];
													}else{
														array_push($aup[$pregunta->keyid],($vr->respuesta*100)/$esc["rango"]);
													}
												}else{
													//array_push($aupd[$pregunta->keyid],array("enunciado"=>$pregunta->enunciado_esp,"competencia"=>$v->nombre_esp));
													if(!isset($aup[$pregunta->keyid][0])){
														$aup[$pregunta->keyid][0]=($vr->respuesta*100)/$esc["rango"];
													}else{
														array_push($aup[$pregunta->keyid],($vr->respuesta*100)/$esc["rango"]);
													}
												}
												//array_push($resultadoempresa,($vr->respuesta*100)/$esc["rango"]);
												array_push($tSimismo,($vr->respuesta*100)/$esc["rango"]);
												if($vr->respuesta!="N/A"){
													if(isset($resultadoempresa[$v->keyid])){
 														array_push($resultadoempresa[$v->keyid],$vr->respuesta);
 													}else{
														$resultadoempresa[$v->keyid][0]=$vr->respuesta;
													}
												}
												
												
												
											}
											 if($vr->keyidevaluado!=$vr->keyidevaluador and /*$vr->keyidevaluado!=$_POST["keyidparticipante"] and */  (int)$vr->respuesta>0 ){
							
												
 												$dat = new CDbCriteria; 
												$dat->condition = "  keyidparticipante='".$vr->keyidevaluado."' and keyidparticipanteevaluador='".$vr->keyidevaluador."' ";
												$temrelacion=AnaEncuestaParticipanterelaciones::model()->find($dat);
												if(isset($temrelacion->keyid)){
													$dat = new CDbCriteria; 
													$dat->condition = " keyid='".$temrelacion->keyidrelacion."'";
													$relus=AnaRelacionxproyecto::model()->find($dat);
													//printVar($relus);
													if(isset($relus->keyid)){
														if(!isset($tRelaciones[$relus->nombre])){
															$tRelaciones[$relus->nombre][0]=($vr->respuesta*100)/$esc["rango"];
														}else{
															array_push($tRelaciones[$relus->nombre],($vr->respuesta*100)/$esc["rango"]);
														}
													}
												}
												if($vr->respuesta!="N/A"){
													array_push($tOtros,($vr->respuesta*100)/$esc["rango"]);
													if(!isset($promxcom[$v->keyid])){
													//	$promxcom[$v->keyid][0]=($vr->respuesta*100)/$esc["rango"];
														$promxcom[$v->keyid][0]=$vr->respuesta;
													}else{
														
														//array_push($promxcom[$v->keyid],($vr->respuesta*100)/$esc["rango"]);
														array_push($promxcom[$v->keyid],$vr->respuesta);
													}
													//printVar($promxcom[$v->keyid],$v->keyid);
 													if(isset($resultadoempresa[$v->keyid])){
 														array_push($resultadoempresa[$v->keyid],$vr->respuesta);
 													}else{
														$resultadoempresa[$v->keyid][0]=$vr->respuesta;
													}
												}
											}
											
 
										}else{
											if($vr->keyidevaluado==$vr->keyidevaluador){
												if(!isset($aupd[$pregunta->keyid])){
													$aupd[$pregunta->keyid]=array("enunciado"=>$pregunta->enunciado_esp,"competencia"=>$v->nombre_esp);
													$aup[$pregunta->keyid][0]=($vr->respuesta*100)/$esc["rango"];
												}else{
													//array_push($aupd[$pregunta->keyid],array("enunciado"=>$pregunta->enunciado_esp,"competencia"=>$v->nombre_esp));
													array_push($aup[$pregunta->keyid],($vr->respuesta*100)/$esc["rango"]);
												}
												array_push($tAutoevas,($vr->respuesta*100)/$esc["rango"]);
											}else{
							
												if(!isset($rupd[$pregunta->keyid])){
													$rupd[$pregunta->keyid]=array("enunciado"=>$pregunta->enunciado_esp,"competencia"=>$v->nombre_esp);
													$rup[$pregunta->keyid][0]=($vr->respuesta*100)/$esc["rango"];
												}else{
													//array_push($rupd[$pregunta->keyid],array("enunciado"=>$pregunta->enunciado_esp,"competencia"=>$v->nombre_esp));
													array_push($rup[$pregunta->keyid],($vr->respuesta*100)/$esc["rango"]);
												}
												$dat = new CDbCriteria; 
												$dat->condition = " keyidproyecto='".$_POST["keyid"]."' and keyidrelacion not in ('autoeval','NR') and keyidparticipante<>'".$_POST['keyidparticipante']."' and  keyidparticipanteevaluador='".$vr->keyidevaluador."' ";
												$demasparticipantes=AnaEncuestaParticipanterelaciones::model()->find($dat);
												foreach($demasparticipantes as $participante){	
													$dat = new CDbCriteria;   
													$dat->condition = "  keyidparticipante='".$participante->keyidevaluado."' and keyidparticipanteevaluador='".$participante->keyidevaluador."' ";
													$temrelacion=AnaEncuestaParticipanterelaciones::model()->find($dat);
													if(isset($temrelacion->keyid)){
														$dat = new CDbCriteria; 
														$dat->condition = " keyid='".$temrelacion->keyidrelacion."'";
														$relus=AnaRelacionxproyecto::model()->find($dat);
														//printVar($relus);
														if(isset($relus->keyid)){
															if(!isset($tRelaciones[$relus->nombre])){
																$tRelaciones[$relus->nombre][0]=($participante->respuesta*100)/$esc["rango"];
															}else{
																array_push($tRelaciones[$relus->nombre],($participante->respuesta*100)/$esc["rango"]);
															}
														}
													}
													array_push($tOtros,($participante->respuesta*100)/$esc["rango"]);
												}
												
												
											}
										}
										 
									}
								}
								//if($pregunta->keyid=='TECSR'){
								//printVar($pup);//exit;
								//}								
								 //exit;
								// printVar($resultadoempresa);exit;
								//$tOtros=$resultadoempresa;  
								 
								if(count($tAutoevas)>0){
									$tAutoevas=array_sum($tAutoevas)/count($tAutoevas);
								}else{$tAutoevas=0;}
								if(count($tSimismo)>0){
									$tSimismo=array_sum($tSimismo)/count($tSimismo);
								}else{$tSimismo=0;}
								if(count($tOtros)>0){
									$tOtros=array_sum($tOtros)/count($tOtros);
								}else{$tOtros=0;} 
								//printVar($tOtros);exit; 
								foreach($tRelaciones as $indexr=>$ev){
									if(count($ev)>0){
										$tRelaciones[$indexr]=array_sum($ev)/count($ev);
									}else{     
										$tRelaciones[$indexr]=0;    
									}
								}
 								array_push($concomp,array("keyid"=>$v->keyid,"competencia"=>$v->nombre_esp,"simismo"=>$tSimismo,"tauto"=>$tAutoevas,"totros"=>$tOtros,"dif"=>($tAutoevas-$tOtros),"descripcion"=>$v->descripcion_esp,"tpreg"=>$tpre,"resxrel"=>$tRelaciones));
							} 
							   
							// printVar($concomp[0]["totros"],$concomp[0]["competencia"]);exit;
							// printVar($pup);exit;
							foreach($pup as $kdi=>$calf){
								if(count($calf)>0){
									$pup[$kdi]=number_format((array_sum($calf)/count($calf)),3);
								}else{
									$pup[$kdi]=0;
								}
							}
 
							foreach($aup as $kdi=>$calf){
								if(count($calf)>0){
									$aup[$kdi]=number_format((array_sum($calf)/count($calf)),3);
								}else{
									$aup[$kdi]=0;
								}
							}

							foreach($rup as $kdi=>$calf){
								if(count($calf)>0){
									$rup[$kdi]=number_format((array_sum($calf)/count($calf)),3);
								}else{
									$rup[$kdi]=0;
								}
							}
  							array_multisort($pup,SORT_DESC);
							$tempo=$pup;
						    array_multisort($tempo,SORT_ASC);
							$pdw=$tempo;
							array_multisort($aup,SORT_DESC);
							$tempo=$aup;
						    array_multisort($tempo,SORT_ASC);
							$adw=$tempo;
							array_multisort($rup,SORT_DESC);
							$tempo=$rup;
						    array_multisort($tempo,SORT_ASC);
							$rdw=$tempo;
						//  printVar($rup);exit;
							//$promxcom=$resultadoempresa;
							if(count($promxcom)>0){
								
								foreach($promxcom as $kcomp=>$cal){
									$promxcom[$kcomp]=array_sum($cal)/count($cal);
								}
							}							
							if(count($promxpreg)>0){
								
								foreach($promxpreg as $kpreg=>$cal){
									$promxpreg[$kpreg]=array_sum($cal)/count($cal);
								}
							}							

 						 
							$comportamientos=array(
							"pup"=>$pup,
							"pupd"=>$pupd,
							"pdw"=>$pdw,
							 "aup"=>$aup,
							"aupd"=>$aupd,
							"adw"=>$adw,
							 "rup"=>$rup,
							"rupd"=>$rupd,
							"rdw"=>$rdw, 
							);
							 
							//printVar($comportamientos);exit;  					 
							$oRecord = User::model()->findByPk(Yii::app()->user->id); 
							$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
							$us=array();
							foreach($dUsuario as $k=>$data){
								$us[$k]=$data;
							}
				//printVar($rel);exit;
 							$report["ra"]=$ra;      
							$report["participante"]=$participante["nombre"];      
							$report["rango"]=$esc["rango"];       
							$report["rel"]=$rel;
							$report["escalas"]=$esc;
							$report["competencias"]=$concomp;  
							$report["pxcom"]=$promxcom;  
							$report["pxpreg"]=$promxpreg;  
							$report["preguntasxcompetencias"]=$pressave;  
							$report["comportamientos"]=$comportamientos; 
					//	printVar($report);exit;	
					 //printVar($pressave,"press");exit;   
						$datson=json_encode(array("p"=>base64_encode(json_encode($pro)),"us"=>base64_encode(json_encode($us)),"report"=>base64_encode(json_encode($report))));
						$nombre_archivo=date("Y-m-d H-i-s").".txt";    
						 
						if($archivo = fopen($_SERVER["DOCUMENT_ROOT"].Yii::app()->baseUrl."/tmp/json/".$nombre_archivo, "a"))
						{ 
							if(fwrite($archivo, $datson))
							{
								 
								echo json_encode(array($nombre_archivo,explode("index.php",$_SERVER["SCRIPT_NAME"])));
							}
							else
							{
								echo json_encode(array("error"));
							}
 							fclose($archivo);
						} else{
							echo json_encode(array("error al crear archivo ".$nombre_archivo));
						}
						 
						 
						 
						 
						 exit;
						break;
						case "descargarreporte":
//printVar(dirname(__FILE__));exit;
 /*					
error_reporting(E_ALL);
ini_set('display_errors', TRUE); 
ini_set('display_startup_errors', TRUE);					
*/					
					
					
							require_once '/var/www/Classes/PHPExcel.php';
  							$dat = new CDbCriteria;
							$dat->condition = "keyidproyecto = '".$_POST["keyid"]."' and estado='1'";
							//$dat->group="keyidparticipante";
  							$relaciones=AnaEncuestaParticipanterelaciones::model()->findAll($dat);
							//printVar($dat); exit;
							$rta=array();
							foreach($relaciones as $relacion){ 
								/*$dat = new CDbCriteria;
								$dat->condition = "keyidevaluado = '".$relacion->keyidparticipante."' and  keyidevaluador = '".$relacion->keyidparticipanteevaluador."' ";
								$resultados=AnaEncuestaRespuestas::model()->find($dat);	
								 */
								$objec=json_decode($relacion->jsonrtemp);
								//$rta
								//printVar($objec);
								$trpe=array();
 								if(isset($objec->respuestas)){
									foreach($objec->respuestas as $keyid=>$r){
										$comentario="";
										if(isset($objec->comentariosrespuestas->$keyid)){$comentario=$objec->comentariosrespuestas->$keyid;}
										$dat = new CDbCriteria;
										$dat->condition = "keyid = '".$keyid."' ";
										$pregunta=AnaEncuestaPreguntaProyecto::model()->find($dat);
										
										$dat = new CDbCriteria;
										$dat->condition = "keyidpregunta = '".$keyid."' and  keyidproyecto = '".$_POST["keyid"]."'";
										$competencia=AnaEncuestaPreguntasxcompetenciasProyecto::model()->find($dat);
										
										$dat = new CDbCriteria;
										$dat->condition = "keyid = '".$competencia->keyidcompetencia."' ";
										$competencialabel=AnaEncuestaCompetenciaProyecto::model()->find($dat);
 										$rta[$relacion->keyidparticipante][$relacion->keyidparticipanteevaluador][$competencia->keyidcompetencia][$keyid]=array("respuesta"=>$r,"comentario"=>$comentario,"idpregunta"=>$keyid,"idpregunta_origen"=>$pregunta->keyidorigen,"idcompetencia"=>$competencia->keyidcompetencia,"idcompetenciaorigen"=>$competencialabel->idOrigen);
									}
								}
									
								if(isset($objec->comentarios)){
									$keyidenunciados=array();
									foreach($objec->comentarios as $keyid=>$res){
										$dat = new CDbCriteria;
										$dat->condition = "keyid = '".$keyid."' ";
										$comentarios=AnaEncuestaPreguntaabierta::model()->find($dat);
										$keyidenunciados[$keyid]=$comentarios->enunciado;
										$rta[$relacion->keyidparticipante][$relacion->keyidparticipanteevaluador]["comentarios"][$keyid]=array("respuesta"=>$res,"codigopregunta"=>$keyid);
									}
									
								}
								
							}/*
							printVar($keyidenunciados);
							printVar($rta);
							exit;*/
							$id=0;
							
							$objPHPExcel = new PHPExcel();
							
							$date=date("Y-m-d His");
							$objPHPExcel->getProperties()->setCreator("Plataforma 360")
														 ->setLastModifiedBy("Plataforma 360")
														 ->setTitle("Office 2007 XLSX ".$date)
														 ->setSubject("Office 2007 XLSX ".$date)
														 ->setDescription("Reporte 360 ".$date)
														 ->setKeywords("office 2007 openxml php")
														 ->setCategory("reporte");							
							$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')
										  ->setSize(12);							
							$objPHPExcel->createSheet();
							$objPHPExcel->getActiveSheet()->setTitle("Resultados evaluacion");
							$objPHPExcel->setActiveSheetIndex(0);
							$celdas=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
							
							$objPHPExcel->getActiveSheet()->setCellValue("A1","ID_EVALUADO");
							$objPHPExcel->getActiveSheet()->setCellValue("B1","NOMBRE_EVALUADO");
 							$objPHPExcel->getActiveSheet()->setCellValue("C1","ID_EVALUADOR");
							$objPHPExcel->getActiveSheet()->setCellValue("D1","NOMBRE_EVALUADOR");
							$objPHPExcel->getActiveSheet()->setCellValue("E1","RELACION");
							$objPHPExcel->getActiveSheet()->setCellValue("F1","ID_COMPETENCIA");
							$objPHPExcel->getActiveSheet()->setCellValue("G1","ID_ORIGEN_COMPETENCIA");
							$objPHPExcel->getActiveSheet()->setCellValue("H1","COMPETENCIA");
							$objPHPExcel->getActiveSheet()->setCellValue("I1","CODIGO_PREGUNTA");
							$objPHPExcel->getActiveSheet()->setCellValue("J1","CODIGO_ORIGEN_PREGUNTA");
							$objPHPExcel->getActiveSheet()->setCellValue("K1","PREGUNTA");
							$objPHPExcel->getActiveSheet()->setCellValue("L1","COMENTARIOS");
							$objPHPExcel->getActiveSheet()->setCellValue("M1","CALIFICACION");
							$objPHPExcel->getActiveSheet()->setCellValue("N1","FECHAREGISTRO");
							$i=2;
							$comentariosENcuesta=array();
							foreach($rta as $keyidevaluado=>$revaluaciones){
 								$dat = new CDbCriteria;
								$dat->condition = "keyid = '".$keyidevaluado."' ";
								$participante=AnaParticipante::model()->find($dat);
								
								foreach($revaluaciones as $keyidevaluador=>$resultados){
									$dat = new CDbCriteria;
									$dat->condition = "keyid = '".$keyidevaluador."' ";
									$participanteB=AnaParticipante::model()->find($dat);

									$dat = new CDbCriteria;
									$dat->condition = "keyidparticipante = '".$keyidevaluado."' and keyidparticipanteevaluador='".$keyidevaluador."' ";
									$relaciona=AnaEncuestaParticipanterelaciones::model()->find($dat);
									$texrelacion="";
									if($relaciona->keyidrelacion=="autoeval"){
										$texrelacion="Autoevaluacion";
									}else if($relaciona->keyidrelacion=="NR" or $relaciona->keyidrelacion==""){
										$texrelacion="Sin relacion";
									}else if($relaciona->keyidrelacion!=""){
										$dat = new CDbCriteria;
										$dat->condition = "keyid = '".$relaciona->keyidrelacion."' ";
										$relacion=AnaRelacionxproyecto::model()->find($dat);
										if(isset($relacion->keyid)){
											$texrelacion=$relacion->nombre;	
										}else{
											$texrelacion="Sin relacion";	
										}										
									}
									
									foreach($resultados as $competencia=>$datosresultados){
										if($competencia!="comentarios"){
											$dat = new CDbCriteria;
											$dat->condition = "keyid = '".$competencia."' ";
											$competencialabel=AnaEncuestaCompetenciaProyecto::model()->find($dat);										
											
											foreach($datosresultados as $keyidpregunta=>$datares){
																						
												$dat = new CDbCriteria;
												$dat->condition = "keyid = '".$keyidpregunta."' and  keyidproyecto = '".$_POST["keyid"]."'";
												$pregunta=AnaEncuestaPreguntaProyecto::model()->find($dat);

											
												$objPHPExcel->getActiveSheet()->setCellValue("A".$i,$keyidevaluado);
												$objPHPExcel->getActiveSheet()->setCellValue("B".$i,$participante->nombre." ".$participante->apellido);
												$objPHPExcel->getActiveSheet()->setCellValue("C".$i,$keyidevaluador);
												$objPHPExcel->getActiveSheet()->setCellValue("D".$i,$participanteB->nombre." ".$participanteB->apellido);
												$objPHPExcel->getActiveSheet()->setCellValue("E".$i,$texrelacion);
												$objPHPExcel->getActiveSheet()->setCellValue("F".$i,$competencia);
												$objPHPExcel->getActiveSheet()->setCellValue("G".$i,$competencialabel->idOrigen);
												$objPHPExcel->getActiveSheet()->setCellValue("H".$i,$competencialabel->nombre_esp);
												$objPHPExcel->getActiveSheet()->setCellValue("I".$i,$keyidpregunta);
												$objPHPExcel->getActiveSheet()->setCellValue("J".$i,$pregunta->keyidorigen);
												$objPHPExcel->getActiveSheet()->setCellValue("K".$i,$pregunta->enunciado_esp);
												$objPHPExcel->getActiveSheet()->setCellValue("L".$i,$datares["comentario"]);
												$objPHPExcel->getActiveSheet()->setCellValue("M".$i,$datares["respuesta"]);
												$objPHPExcel->getActiveSheet()->setCellValue("N".$i,$relaciona->fecharesuelto);
												
												$i++;  
											}
										}else{
											foreach($datosresultados as $enunciado=>$datares){
												$comentariosENcuesta[$keyidevaluado][$keyidevaluador][$enunciado]=$datares["respuesta"];
											}
										}
									}
								}
								
								
								
								 
							}
 
							//printVar($comentariosENcuesta);exit;


							$objPHPExcel->createSheet();
							//$objPHPExcel->getActiveSheet()->setTitle("Comentarios");
							$objPHPExcel->setActiveSheetIndex(1);							
							
							
							$objPHPExcel->getActiveSheet()->setCellValue("A1","ID_EVALUADO");
							$objPHPExcel->getActiveSheet()->setCellValue("B1","NOMBRE_EVALUADO");
 							$objPHPExcel->getActiveSheet()->setCellValue("C1","ID_EVALUADOR");
							$objPHPExcel->getActiveSheet()->setCellValue("D1","NOMBRE_EVALUADOR");	
							$objPHPExcel->getActiveSheet()->setCellValue("E1","ENUNCIADO");	
							$objPHPExcel->getActiveSheet()->setCellValue("F1","COMENTARIO");
 							
							$i=2;							
							foreach($comentariosENcuesta as $evaluado=>$reseval){
								$dat = new CDbCriteria;
								$dat->condition = "keyid = '".$evaluado."' ";
								$evaluado=AnaParticipante::model()->find($dat);
								
								foreach($reseval as $evaluador=>$rpreguntasabiertas){
									$dat = new CDbCriteria;
									$dat->condition = "keyid = '".$evaluador."' ";
									$evaluador=AnaParticipante::model()->find($dat);
									
									foreach($rpreguntasabiertas as $keyidpregunta=>$datares){
										$objPHPExcel->getActiveSheet()->setCellValue("A".$i,$evaluado->keyid);
										$objPHPExcel->getActiveSheet()->setCellValue("B".$i,$evaluado->nombre." ".$evaluado->apellido);
										$objPHPExcel->getActiveSheet()->setCellValue("C".$i,$evaluador->keyid);
										$objPHPExcel->getActiveSheet()->setCellValue("D".$i,$evaluador->nombre." ".$evaluador->apellido);	
										$enunciado=$keyidenunciados[$keyidpregunta];
										$objPHPExcel->getActiveSheet()->setCellValue("E".$i,$enunciado);	
										$objPHPExcel->getActiveSheet()->setCellValue("F".$i,$datares);
										$i++;
									}									
								}
							}
							 
							$objPHPExcel->getActiveSheet()->setTitle("Comentarios");
							header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
							header('Content-Disposition: attachment;filename="reporte_'.$date.'.xlsx"');
							header('Cache-Control: max-age=0');
							// If you're serving to IE 9, then the following may be needed
							header('Cache-Control: max-age=1');

							// If you're serving to IE over SSL, then the following may be needed
							header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
							header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
							header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
							header ('Pragma: public'); // HTTP/1.0 
 
 
 
							$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
							//$objWriter->save("/var/www".Yii::app()->baseUrl."/files/descargas/reporte_".$date.".xlsx");							
							$objWriter->save('php://output');							
							//$this->SaveViaTempFile($objWriter);
							exit;
							 
						break;
						case "informedeavance":
 						
error_reporting(E_ALL);
ini_set('display_errors', TRUE); 
ini_set('display_startup_errors', TRUE);							
						
									require_once '/var/www/Classes/PHPExcel.php';
						
									$dat = new CDbCriteria;
									$dat->condition = "keyidproyecto = '".$_POST["key"]."'   and keyidrelacion<>'NR' and keyidrelacion<>''"; 	
									$participantesrelacion=AnaEncuestaParticipanterelaciones::model()->findAll($dat);
									$tpar=array();		
											
									foreach($participantesrelacion as $parti){
										if(!in_array($parti->keyidparticipanteevaluador,$tpar)){
											array_push($tpar,$parti->keyidparticipanteevaluador);
										}
									}
								
								
									$dat = new CDbCriteria;
									$dat->condition = "keyproyecto = '".$_POST["key"]."' and keyid in ('".join("','",$tpar)."')";									//printVar($dat);exit;
									$dat->order="nombre ASC";
									$participante=AnaParticipante::model()->findAll($dat);
									
									$tipoedad=AnaTipoedad::model()->findAll();	
									$tipoantiguedad=AnaTipoantiguedad::model()->findAll();	
									$tipoestadocivil=AnaTipoestadocivil::model()->findAll();	
									$tiponivelacademico=AnaTiponivelacademico::model()->findAll();	
									if(isset($participante[0]->keyproyecto)){
										$norm=array();
										foreach($participante as $k=>$datos){
											$temporal=array();
											foreach($datos as $campo=>$valor){
												$temporal[$campo]=$valor;
											}
											$dat = new CDbCriteria;
											$dat->condition = "keyidproyecto = '".$_POST["key"]."'  and keyidparticipanteevaluador='".$datos->keyid."' and keyidrelacion<>'NR'"; 	
 											$res=AnaEncuestaParticipanterelaciones::model()->findAll($dat); 
											$todas=count($res);
											$temporal["todos"]=$todas;
											
											$dat = new CDbCriteria;
											$dat->condition = "keyidproyecto = '".$_POST["key"]."'  and keyidparticipanteevaluador='".$datos->keyid."' and estado='0'  and keyidrelacion<>'NR'"; 	
 											$res=AnaEncuestaParticipanterelaciones::model()->findAll($dat); 
											$sinterminar=count($res);
											$temporal["sinterminar"]=$sinterminar;
											
											$dat = new CDbCriteria;
											$dat->condition = "keyidproyecto = '".$_POST["key"]."'  and keyidparticipanteevaluador='".$datos->keyid."' and estado='1'  and keyidrelacion<>'NR'"; 	
 											$res=AnaEncuestaParticipanterelaciones::model()->findAll($dat); 
											$terminado=count($res);
											$temporal["terminado"]=$terminado;
											
											$dat = new CDbCriteria;
											$dat->condition = "keyidproyecto = '".$_POST["key"]."'  and keyidparticipanteevaluador='".$datos->keyid."' and estado='2'  and keyidrelacion<>'NR'"; 	
 											$res=AnaEncuestaParticipanterelaciones::model()->findAll($dat); 
											$iniciado=count($res);
 											$temporal["iniciado"]=$iniciado;
											
											$norm[$datos->keyid]=(object)$temporal;
 											 
										}
 										
										
										$objPHPExcel = new PHPExcel();

										$date=date("Y-m-d His");
										$objPHPExcel->getProperties()->setCreator("Plataforma 360")
																	 ->setLastModifiedBy("Plataforma 360")
																	 ->setTitle("Office 2007 XLSX ".$date)
																	 ->setSubject("Office 2007 XLSX ".$date)
																	 ->setDescription("Reporte 360 ".$date)
																	 ->setKeywords("office 2007 openxml php")
																	 ->setCategory("reporte");							
										$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')
													  ->setSize(12);							
										$objPHPExcel->createSheet();
										$objPHPExcel->getActiveSheet()->setTitle("Avance");
										$objPHPExcel->setActiveSheetIndex(0);
										$celdas=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
							
										$objPHPExcel->getActiveSheet()->setCellValue("A1","Participante");
										$objPHPExcel->getActiveSheet()->setCellValue("B1","Total Encuestas resueltas");
										$objPHPExcel->getActiveSheet()->setCellValue("C1","Total Encuestas a Resolver");
										$objPHPExcel->getActiveSheet()->setCellValue("D1","Estado");
										$i=2;
										foreach($norm as $keyidevaluador=>$datos){ //printVar($datos);exit;
											$estado="Incompleto";
											if($datos->terminado==$datos->todos){
												$estado="Completado";
											}
											$objPHPExcel->getActiveSheet()->setCellValue("A".$i,$datos->nombre." ".$datos->apellido);
											$objPHPExcel->getActiveSheet()->setCellValue("B".$i,$datos->terminado);
											$objPHPExcel->getActiveSheet()->setCellValue("C".$i,$datos->todos);
											$objPHPExcel->getActiveSheet()->setCellValue("D".$i,$estado);
											$i++;
										}
 						
										header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
										header('Content-Disposition: attachment;filename="Avance_proyecto_'.$date.'.xlsx"');
										header('Cache-Control: max-age=0');
										// If you're serving to IE 9, then the following may be needed
										header('Cache-Control: max-age=1');

										// If you're serving to IE over SSL, then the following may be needed
										header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
										header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
										header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
										header ('Pragma: public'); // HTTP/1.0 
			 
			 
			 
										$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
										//$objWriter->save("/var/www".Yii::app()->baseUrl."/files/descargas/reporte_".$date.".xlsx");							
										$objWriter->save('php://output');		
										exit;										
 										
									}else{echo json_encode(array("no"));exit;}								
 								break;
								case "informedered":
									$subq="";
									if(isset($_POST["keyid"])){
										$subq=" and keyidparticipante='".$_POST["keyid"]."'";
									}
									
									$dat = new CDbCriteria;
									$dat->condition = "keyidproyecto = '".$_POST["key"]."' and (keyidrelacion<>'' and keyidrelacion<>'NR') ".$subq;
									//printVar($dat);exit;
									$evaluados=AnaEncuestaParticipanterelaciones::model()->findAll($dat);
									
									$evaluadosR=array();
									foreach($evaluados as $data){
										$dat = new CDbCriteria;
										$dat->condition = "keyproyecto = '".$_POST["key"]."' and keyid='".$data->keyidparticipante."' ";
										//printVar($dat);exit;
										$evaluado=AnaParticipante::model()->find($dat);
										
										if(isset($evaluado->keyid)){	
											$relacionlabel="";
											if($data->keyidrelacion=="autoeval"){
												$relacionlabel="Autoevaluacion";
											}else{
												$dat = new CDbCriteria;
												$dat->condition = "keyproyecto = '".$_POST["key"]."' and keyid='".$data->keyidrelacion."' ";
												//printVar($dat);exit;
												$relacion=AnaRelacionxproyecto::model()->find($dat);
												if(isset($relacion->keyid)){
													$relacionlabel=$relacion->nombre;
												}
											}
											
											$dat = new CDbCriteria;
											$dat->condition = "keyproyecto = '".$_POST["key"]."' and keyid='".$data->keyidparticipanteevaluador."' ";
											//printVar($dat);exit;
											$evaluador=AnaParticipante::model()->find($dat);
											 
											if(!isset($evaluadosR[$data->keyidparticipante][0])){ 
												$evaluadosR[$data->keyidparticipante][0]=array(
														"evaluado"=>array($evaluado->keyid,$evaluado->nombre." ".$evaluado->apellido),
														"evaluador"=>array($evaluador->keyid,$evaluador->nombre." ".$evaluador->apellido),
														"relacion"=>$relacionlabel,
														"estado"=>array($data->estado,$data->fecharesuelto)
													); 
											}else{ 
												$datosred=array(
														"evaluado"=>array($evaluado->keyid,$evaluado->nombre." ".$evaluado->apellido),
														"evaluador"=>array($evaluador->keyid,$evaluador->nombre." ".$evaluador->apellido),
														"relacion"=>$relacionlabel,
														"estado"=>array($data->estado,$data->fecharesuelto)
													);
												array_push($evaluadosR[$data->keyidparticipante],$datosred); 
											}
										}	
									}
																	
 						
									require_once '/var/www/Classes/PHPExcel.php';
									$objPHPExcel = new PHPExcel();

									$date=date("Y-m-d His");
									$objPHPExcel->getProperties()->setCreator("Plataforma 360")
																 ->setLastModifiedBy("Plataforma 360")
																 ->setTitle("Office 2007 XLSX ".$date)
																 ->setSubject("Office 2007 XLSX ".$date)
																 ->setDescription("Reporte 360 ".$date)
																 ->setKeywords("office 2007 openxml php")
																 ->setCategory("reporte");							
									$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')
												  ->setSize(12);							
									$objPHPExcel->createSheet();
									$objPHPExcel->getActiveSheet()->setTitle("Red");
									$objPHPExcel->setActiveSheetIndex(0);
									$celdas=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
						
									$objPHPExcel->getActiveSheet()->setCellValue("A1","Nombre equipo area, organización o evaluado");
									$objPHPExcel->getActiveSheet()->setCellValue("B1","Evaluador");
									$objPHPExcel->getActiveSheet()->setCellValue("C1","Relacion");
									$objPHPExcel->getActiveSheet()->setCellValue("D1","Estado");
									$i=2;							
									foreach($evaluadosR as $keyidevaluado=>$evaluadores){
										foreach($evaluadores as $idref=>$datos){
											$objPHPExcel->getActiveSheet()->setCellValue("A".$i,$datos["evaluado"][1]);
											$objPHPExcel->getActiveSheet()->setCellValue("B".$i,$datos["evaluador"][1]);
											$objPHPExcel->getActiveSheet()->setCellValue("C".$i,$datos["relacion"]);
											$estado="Sin resolver";
											if((int)$datos["estado"][0]==1){
												$estado="Resuelto el ".$datos["estado"][1];
											}
											$objPHPExcel->getActiveSheet()->setCellValue("D".$i,$estado);
											$i++;
										}
									}
								
									header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
									header('Content-Disposition: attachment;filename="red_'.$date.'.xlsx"');
									header('Cache-Control: max-age=0');
									// If you're serving to IE 9, then the following may be needed
									header('Cache-Control: max-age=1');

									// If you're serving to IE over SSL, then the following may be needed
									header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
									header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
									header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
									header ('Pragma: public'); // HTTP/1.0 



									$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
									//$objWriter->save("/var/www".Yii::app()->baseUrl."/files/descargas/reporte_".$date.".xlsx");							
									$objWriter->save('php://output');		
									exit;											
 								
								break;
						
 					}
					exit;
				}
				
				
				
 				$this->_renderWrappedTemplate('evaluacion',$template , $aData);
			}
		}
		
		
		
		
	}
	// round_up:
// rounds up a float to a specified number of decimal places
// (basically acts like ceil() but allows for decimal places)
	public function round_up ($value, $places=0) {
	  if ($places < 0) { $places = 0; }
	  $mult = pow(10, $places);
	  return ceil($value * $mult) / $mult;
	}

	// round_out:
	// rounds a float away from zero to a specified number of decimal places
	public function round_out ($value, $places=0) {
	  if ($places < 0) { $places = 0; }
	  $mult = pow(10, $places);
	  return ($value >= 0 ? ceil($value * $mult):floor($value * $mult)) / $mult;
	}
	static function SaveViaTempFile($objWriter){
		$filePath = sys_get_temp_dir() . "/" . rand(0, getrandmax()) . rand(0, getrandmax()) . ".tmp";
		$objWriter->save($filePath);
		readfile($filePath);
		unlink($filePath);
	}
	public function addEventos($accion,$detalleconsulta){
										
		$key=$this->generarKey();
 
		$dat = new CDbCriteria;
		$dat->condition = "keyid = '".$key."'";
		//printVar($dat);exit;
		$verificarkey=AnaEventos::model()->find($dat);				
		 
		if(isset($verificarkey->{'keyid'})){
			$bandera=false;
			$contador=6;
			while($bandera==false){
				$key=$this->generarKey($contador);
				$dat = new CDbCriteria;
				$dat->condition = "keyid = '".$key."'";
				$verificarkey=AnaEventos::model()->find($dat);
				if(!isset($verificarkey->{'keyid'})){
					$bandera=true;
				}
				$contador++;
			}
		}										
 			
		$set=new AnaEventos();
		$set->keyid=$key;	
		$set->idUsuario=(int)Yii::app()->user->id;	
		$set->accion=$accion;   
		$set->detalleconsulta=$detalleconsulta;	
		$set->fecha=date("Y-M-d H:i:s");
		$set->save();	
										
										
	}
	public function enviarEmail($participantes,$id,$proyecto){
		$control=array();
		$error=array();
		//printVar(json_decode($participantes),$proyecto."  ".$id);exit; 
		if(isset(Yii::app()->user->id)){
			if((int)Yii::app()->user->id>0){     
				$oRecord = User::model()->findByPk(Yii::app()->user->id); 
 				$dat = new CDbCriteria;
				$dat->condition = "id = '".$id."' and keyidproyecto='".$proyecto."'";
				$tem=AnaEmailtemplate::model()->find($dat);
				$htmlbase=$tem->html;
				$config=AnaConfigmail::model()->findAll();
				$config=$config[0];
			//	printVar($participantes);
				 

				$set=new AnaMailingEnvio();
				$set->keyidproyecto=$proyecto;
				$set->keyidmailing=$id;
				$set->fechaenvio=date("Y-m-d H:i:s");
				$set->idUsuario=$oRecord->iduseval;
				$set->participantes=$participantes;
				$set->save();
				// printVar(json_decode($participantes));exit;

				$dat = new CDbCriteria;
				$dat->condition = "keyid in ('".join("','",json_decode($participantes))."') and keyproyecto='".$proyecto."'";
				$dat->order="nombre ASC";
				$participanteR=AnaParticipante::model()->findAll($dat);
				//printVar($participanteR);exit;
				$dat = new CDbCriteria;
				$dat->condition = "keyid='".$proyecto."'";
				$dataproyect=AnaProyecto::model()->find($dat);
				//printVar($participanteR);exit;
				$tipopago=array("1"=>"360","2"=>"Clima","3"=>"Equipo");
				$continuar=true;
				if($dataproyect->tipoproyecto==1 or $dataproyect->tipoproyecto==3){
					$dat = new CDbCriteria;
					$dat->condition = "keyidproyecto='".$proyecto."' and (keyidparticipante<>keyidparticipanteevaluador)";
					$participantesevaluados=AnaEncuestaParticipanterelaciones::model()->find($dat);
					//printVar($participanteR);exit;
 					$dat = new CDbCriteria;
					$dat->condition = "idUsuario = '".$oRecord->iduseval."'";
					$valcreditos=AnaMonedaxusuario::model()->count($dat);	
					$controlpago=false;
					if($valcreditos>=count($participantesevaluados)){
						
						foreach($participantesevaluados as $peval){
							//$this->pagar($proyecto,$tipopago[$dataproyect->tipoproyecto],$peval->keyidparticipante);
						}
						$controlpago=true;
 					}				
 					$continuar=$controlpago;
				}
				if($continuar==true){
					foreach($participanteR as $rPart){
						if(isset($rPart->keyid)){
							$html=$htmlbase;
							$campos=array("nombre"=>"name","apellido"=>"lastname","nombreopcional"=>"organization","email"=>"email","clave"=>"password");
							$composerd=array();
							foreach($rPart as $key=>$valor){
								if(isset($campos[$key])){
									if($key=="clave"){
										$valor=$this->decrypt(base64_decode($valor),"lindosnenes");
									}
									$html=str_replace("{{".$campos[$key]."}}",$valor,$html);
								}
								$composerd[$key]=$valor;
							}
							
							$token=base64_encode($this->encrypt($proyecto,'lindosnenes'));
							$http="http://";
							if(isset($_SERVER["HTTPS"])){
							$http="https://";
							}
							$http.=$_SERVER["HTTP_HOST"].Yii::app()->baseUrl."/index.php/admin/authentication/evaluacion?token=".$token;							
							
							$html=str_replace("{{urlsurvey}}",' <a href="'.$http.'">'.$http.'</a> ',$html);
							
							$html=str_replace("{{emailsuport}}",$dataproyect->email,$html);    
							
							$mail = new PHPMailer ();
							$mail -> IsHTML(true);
							$mail->IsSMTP();
							$mail->SMTPDebug = 0;
							$mail->SMTPAuth = true;
							$mail->SMTPSecure = $config->smtpsecure; // secure transfer enabled REQUIRED for GMail
							$mail->Host = $config->host;
							$mail->Port =  $config->port;
							$mail->Username   = $config->username;  // GMAIL username
							$mail->Password   =  $config->password; 						 
							 
							 
							
							//printVar($mail);
							//$mail -> From = $tem->nombre; 
							//$mail -> FromName =$tem->nombre;
							$mail -> setFrom ($config->username,utf8_decode($tem->nombre));
							
							if(isset($_POST["concopia"])){//$mail -> AddAddress ($_POST["concopia"]);
								if($_POST["concopia"]!=""){
									if($rPart->email==""  ){
										$mail -> AddAddress ($_POST["concopia"]);
									}else if($rPart->email!="" ){
										$mail->AddCC($_POST["concopia"]);
										$mail -> AddAddress ($rPart->email);
									}
								}else{
									$mail -> AddAddress ($rPart->email);
								}
							}else{
								$mail -> AddAddress ($rPart->email);
							}
							$mail -> Subject =utf8_decode( $tem->asunto);
							$mail -> Body = utf8_decode($html);
			   // GMAIL password
							
							//printVar($mail);exit;
							//printVar($mail->Send());
							 
							if(!$mail->Send()) {
								array_push($error,$composerd );
							}else{
									
								array_push($control,$keyid);
							} 
							//unset($mail);
						}				
					}
				}else{
					array_push($error,"No hay suficientes créditos");
				}
			}
		}
		return array($control,$error);
	}
	public function validarParticipantes($participantes,$proyecto){
		$npa=array();
		if(isset(Yii::app()->user->id)){
			if((int)Yii::app()->user->id>0){     
				$oRecord = User::model()->findByPk(Yii::app()->user->id); 
 				$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
 
				$npa=array();
				foreach($participantes as $keyid){
					$dat = new CDbCriteria;
					$dat->condition = "keyid = '".$keyid."' and keyproyecto='".$proyecto."'";
					$verificarkey=AnaParticipante::model()->find($dat);
					if(isset($verificarkey->keyid)){
						array_push($npa,$verificarkey->keyid);
					}
					
				}
			}
		}
		return $npa;
	}
	
    public function index()
    {   Yii::app()->cache->flush();
	    
		if(isset(Yii::app()->user->id)){
			if((int)Yii::app()->user->id>0){     
				$oRecord = User::model()->findByPk(Yii::app()->user->id); 
				 $aData=array();
				$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
				$aData=$this->getLanguagetemplates();
 				$listaperfiles = AnaRol::model()->findAll();
  				 
				$dat = new CDbCriteria;
				$dat->condition = "estado='1' and idUsuario = '".Yii::app()->user->id."'";
				$dat->order="fechacreacion DESC";
				//printVar($dat);exit;
				$proyectos=AnaProyecto::model()->findAll($dat);	
				//$proyectos=AnaEncuesta::model()->findAll($dat); 	
							
				$aData["tproyectos"]=count($proyectos);					 
			// printVar($aData);exit;
				$dat = new CDbCriteria;
				$dat->condition = "idUsuario = '".$dUsuario->id."'";
    				$creditos=AnaMonedaxusuario::model()->count($dat);
    				$aData["creditosdisponibles"]=$creditos;
 				$aData["usuariomodel"]=$dUsuario;
				$aData["perfilusuarior"]=$dUsuario->perfil;
				$aData["validaini"]="OK";
				$aData["imageurl"]=Yii::app()->baseUrl;
				$validaeditar=AnaUsuario::model()->vaidausr(false);
 				$this->_renderWrappedTemplate('evaluacion', 'index', $aData);
			}
		}
    }
	
	 

    private function escape_str($str, $like = FALSE)
    {
        if (is_array($str)) {
            foreach ($str as $key => $val)
            {
                $str[$key] = $this->escape_str($val, $like);
            }

            return $str;
        }

        // Escape single quotes
        $str = str_replace("'", "''", $this->remove_invisible_characters($str));

        return $str;
    }

    private function remove_invisible_characters($str, $url_encoded = TRUE)
    {
        $non_displayables = array();

        // every control character except newline (dec 10)
        // carriage return (dec 13), and horizontal tab (dec 09)

        if ($url_encoded) {
            $non_displayables[] = '/%0[0-8bcef]/'; // url encoded 00-08, 11, 12, 14, 15
            $non_displayables[] = '/%1[0-9a-f]/'; // url encoded 16-31
        }
        $non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S'; // 00-08, 11, 12, 14-31, 127
         do
        {
            $str = preg_replace($non_displayables, '', $str, -1, $count);
        } while ($count);
        return $str;
    }	
     private function _getSurveyCountForUser(array $user)
    {
        return Survey::model()->countByAttributes(array('owner_id' => $user['uid']));
    }
	
    /**
    * Renders template(s) wrapped in header and footer
    *
    * @param string $sAction Current action, the folder to fetch views from
    * @param string|array $aViewUrls View url(s)
    * @param array $aData Data to be passed on. Optional.
    */
    protected function _renderWrappedTemplate($sAction = 'user', $aViewUrls = array(), $aData = array())
    {
        parent::_renderWrappedTemplate($sAction, $aViewUrls, $aData);
    }

    public function pagarpdf(){
	Yii::app()->cache->flush();
	if(isset(Yii::app()->user->id)){
			if((int)Yii::app()->user->id>0){
				$dat = new CDbCriteria;
				$dat->condition = "keyid = '".$_POST["keyid"]."'";
				$participante = AnaParticipante::model()->find($dat);
				$status = array();
				if($participante->avanzado == 0){
					
					$participante->avanzado = 1;
					$participante->save();
					$status = array("status" => 1,"mensaje"=> "Pago Exitoso");
					$this->pagar($_POST["key"],"PDF AVANZADO");
				}else{
					$status = array("status" => 2,"mensaje" => "Participante anteriormente pagado");
				}
				
				echo json_encode($status);
				//PDF AVANZADO
			}
	}
	
    }
	
}