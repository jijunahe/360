<?php //echo "%Daniel";exit;
if (!defined('BASEPATH')) exit('No direct script access allowed');
 // error_reporting(E_ALL); ini_set('display_errors', '1');
$documentroot=str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"]);
//require_once($documentroot.'application/extensions/PHPMailer/class.phpmailer.php');
require_once($documentroot.'application/controllers/admin/reportes.php');
require_once($documentroot.'application/extensions/class_sql_inject.php');
class Empresas extends Survey_Common_Action 
{
  	private $kp='93857366asmdmfmm';
 	/*
	private $muestra=10;
  	private $limite=500;
  	private $limitemuestra=1000;
	*/
 
  	function __construct($controller, $id)
    {
        parent::__construct($controller, $id);

        Yii::app()->loadHelper('database');
 		$this->kp= $this->kp.substr($this->kp,0,8);
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
	public function generarKey($longitud=5){
		$alpha = "123QWERT4567890ABSDFSDFCDEFGHIJ9876542345KLMNOPQR123765STUVWX789904YZ";
		$code = "";
 		for($i=0;$i<$longitud;$i++){
			$code .= $alpha[rand(0, strlen($alpha)-1)];
		}
		return $code;		
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
				$participanteR=AnaParticipante::model()->findAll($dat);
				//printVar($participanteR);exit;
				$dat = new CDbCriteria;
				$dat->condition = "keyid='".$proyecto."'";
				$dataproyect=AnaProyecto::model()->find($dat);
				//printVar($participanteR);exit;
				
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
			}
		}
		return array($control,$error);
	}
	
	public function validarempresa(){ 
		Yii::app()->cache->flush();
	    
		if(isset(Yii::app()->user->id)){// printVar(AnaRol::model()->validarrol(22));exit;
			if((int)Yii::app()->user->id>0 and AnaRol::model()->validarrol(3)==true){     
				$oRecord = User::model()->findByPk(Yii::app()->user->id); 
	
					$dat = new CDbCriteria;
					$dat->condition = "nit = '".$_POST["nit"]."'";
					$tem=AnaOrganizacion::model()->find($dat);
					if(isset($tem->nit)){
						echo json_encode(array("existe"));exit;
					}else{
						echo json_encode(array("no"));exit;
					}
				
			}
		}
	
	
	}//printVar(345678);exit;
	public function nuevo(){ //printVar(345678);exit;
		Yii::app()->cache->flush();
	    
		if(isset(Yii::app()->user->id)){// printVar(AnaRol::model()->validarrol(22));exit;
			if((int)Yii::app()->user->id>0 and AnaRol::model()->validarrol(3)==true){     
				$oRecord = User::model()->findByPk(Yii::app()->user->id); 
				 $aData=array();
				$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
				$aData=$this->getLanguagetemplates();
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
					$dat->condition = 'id='.$dUsuario->id_unidad;
					$empresas=AnaOrganizacion::model()->findAll($dat);
 					
				}
				 $aData["empresa"]=array();
				 $aData["ciudad"]=array();
				 $aData["region"]=array();
 				if(isset($_POST["nit"])){
					$subq=array();
					if($oRecord->uid==463 or $dUsuario->perfil==1){
						$subq=array();
					}
					
					if($dUsuario->perfil==2){
						array_push($subq,"id_pais=".$dUsuario->id_pais);
					}
					
					if( $dUsuario->perfil==3){
						array_push($subq,"id_region=".$dUsuario->id_region);
					}
					
					if( $dUsuario->perfil==5){
						array_push($subq,"id_ciudad=".$dUsuario->id_ciudad);
					}
					if(count($subq)>0){
						$subq=' and '.join(" and ",$subq);
					}else{
						$subq='';
					}
 					$dat = new CDbCriteria;
					$dat->condition = 'id="'.$_POST["nit"].'" '.$subq;
					$set=AnaOrganizacion::model()->find($dat);
					$aData["empresa"]=$set;
					//printVar('nit="'.$_POST["nit"].'" '.$subq,$_POST["nit"]);
					$dat = new CDbCriteria;
					$dat->condition = 'id ="'.$set->id_region.'" ';
					$region=AnaRegion::model()->find($dat);
					
					$dat = new CDbCriteria;
					$dat->condition = 'id ="'.$set->id_ciudad.'"';
					$ciudad=AnaCiudad::model()->find($dat);
					$aData["ciudad"]=$ciudad;
					$aData["region"]=$region;
 					
				}
				//printVar();exit;
				 $aData["usuariomodel"]=$dUsuario;
				 $aData["empresas"]=$empresas;
				 $aData["ciudades"]=$ciudades;
				 $aData["regiones"]=$regiones;
				 $aData["paises"]=$paises;	
				if(isset($_POST["save"])){
					
					
					if(!isset($empresas->id)){
						$set=new AnaOrganizacion();
					}
					$set->nombre=$_POST["nombreempresa"];
					$set->nit=$_POST["nit"];

					$set->id_ciudad=(int)$_POST["ciudad"];
					$set->id_region=(int)$_POST["region"];
					$set->id_pais=(int)$_POST["pais"];
					$set->fechacreacion=date("Y-m-d H:i:s");
					$set->idUsuario=Yii::app()->user->id;
					$set->telefono=$_POST["telefonocontacto"];
					$set->nombrerepresentante=$_POST["nombrerepresentante"];
					$set->email=$_POST["emailresponsable"];
					$set->save();
					echo json_encode(array("ok",$set->id));exit;
				}
				App()->getClientScript()->registerScriptFile(Yii::app()->baseUrl."/scripts/yav1_4_1/js/yav.js");
				App()->getClientScript()->registerScriptFile(Yii::app()->baseUrl."/scripts/yav1_4_1/js/yav-config-es.js");
				App()->getClientScript()->registerScriptFile("//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js");

 				
				$this->_renderWrappedTemplate('empresas', 'nuevo', $aData);
			}
		}
	}
	
    public function index()
    {   Yii::app()->cache->flush();
	    
		if(isset(Yii::app()->user->id)){// printVar(AnaRol::model()->validarrol(22));exit;
			if((int)Yii::app()->user->id>0 and AnaRol::model()->validarrol(22)==true){     
				$oRecord = User::model()->findByPk(Yii::app()->user->id); 
				 $aData=array();
				$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
				$aData=$this->getLanguagetemplates();
 				$listaperfiles = AnaRol::model()->findAll();
  				 
				$dat = new CDbCriteria;
				$dat->condition = "idUsuario = '".Yii::app()->user->id."'";
				$dat->order="fechacreacion DESC";
				//printVar($dat);exit;
				$proyectos=AnaProyecto::model()->findAll($dat);	
				//$proyectos=AnaEncuesta::model()->findAll($dat); 	
							
				$aData["tproyectos"]=count($proyectos);					 
			// printVar($aData);exit;
 				$aData["usuariomodel"]=$dUsuario;
				$aData["perfilusuarior"]=$dUsuario->perfil;
				$aData["validaini"]="OK";
				$aData["imageurl"]=Yii::app()->baseUrl;
				//$validaeditar=AnaUsuario::model()->vaidausr(false);
				
 				
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
					$dat->condition = 'id='.$dUsuario->id_unidad;
					$empresas=AnaOrganizacion::model()->findAll($dat);
 					
				}
				//printVar();exit;
				
				 $aData["usuariomodel"]=$dUsuario; 
				 $aData["empresas"]=$empresas;
				 $aData["ciudades"]=$ciudades;
				 $aData["regiones"]=$regiones;
				 $aData["paises"]=$paises;
				  
				
 				
  				$this->_renderWrappedTemplate('empresas', 'index', $aData);
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
	
}