<?php //echo "%Daniel";exit;
if (!defined('BASEPATH')) exit('No direct script access allowed');
 //  error_reporting(E_ALL); ini_set('display_errors', '1');
$documentroot=str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"]);
//require_once($documentroot.'application/extensions/PHPMailer/class.phpmailer.php');
require_once($documentroot.'application/controllers/admin/reportes.php');
require_once($documentroot.'application/extensions/class_sql_inject.php');
class Moneda extends Survey_Common_Action 
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
		//$this->validarRole();
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
	public function generarKey($longitud=5){
		$alpha = "123QWERT4567890ABSDFSDFCDEFGHIJ9876542345KLMNOPQR123765STUVWX789904YZ";
		$code = "";
 		for($i=0;$i<$longitud;$i++){
			$code .= $alpha[rand(0, strlen($alpha)-1)];
		}
		return $code;		
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
  				 
				/*$dat = new CDbCriteria;
				$dat->condition = "estado='1' and idUsuario = '".Yii::app()->user->id."'";
				$dat->order="fechacreacion DESC";*/
				//printVar($dat);exit;
				$monedas=AnaMoneda::model()->findAll();	
				//$proyectos=AnaEncuesta::model()->findAll($dat); 	
				if(isset($_GET["crear"])){ 
					for($i=0;$i<=$monedas[0]->cantidad;$i++){
						$modelorg=new AnaMonedaunitaria();//printVar($modelorg);exit; 
						$modelorg->idMoneda=$monedas[0]->id;
						$modelorg->keyid=$this->generarKey(15);   
  						$modelorg->fechacreacion=date("Y-m-d H:i:s");      
						$modelorg->{"hash"}=hash('ripemd160',$modelorg->keyid."--".$modelorg->idMoneda.$modelorg->fechacreacion);
						$modelorg->save();
					}
				}

				 



				
				$aData["tmonedas"]=count($monedas);					 
				$aData["monedas"]=$monedas;					 
			// printVar($aData);exit;
 				$aData["usuariomodel"]=$dUsuario;
				$aData["perfilusuarior"]=$dUsuario->perfil;
				$aData["validaini"]="OK";
				$aData["imageurl"]=Yii::app()->baseUrl;
				$validaeditar=AnaUsuario::model()->vaidausr(false);
				 
 				$this->_renderWrappedTemplate('moneda', 'ver', $aData);   
			}
		}
    }
	  
	public function asignar(){    
		  Yii::app()->cache->flush();
 		if(isset(Yii::app()->user->id)){ 
			if((int)Yii::app()->user->id>0 ){
					$oRecord = User::model()->findByPk(Yii::app()->user->id); 
					$aData=array();
					$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
					$aData=$this->getLanguagetemplates();
					$listaperfiles = AnaRol::model()->findAll(); 
				if($dUsuario->perfil==1){
					 switch($_POST["op"]){
						case "get":
							 
							$dat = new CDbCriteria;
							$dat->condition = "perfil<>1  ";
							$dUsuario = AnaUsuario::model()->findAll($dat);
							
							$dat = new CDbCriteria;
							$dat->condition = "asignado='0'  ";
							$monedas = AnaMonedaunitaria::model()->count($dat);
							$ust=array();
							foreach($dUsuario as $k=>$d){
								$ust[$k]=array($d->id,$d->nombres,$d->email);
								
							}
							 
							echo json_encode(array($monedas,$ust));exit;

						break;

						case "save":
							 
							$dat = new CDbCriteria;
							$dat->condition = "perfil<>1  ";
							$dUsuarioasg = AnaUsuario::model()->findAll($dat);
							
							$dat = new CDbCriteria;
							$dat->condition = "asignado='0'  ";
							$tmonedas = AnaMonedaunitaria::model()->count($dat); 
							if($tmonedas>=(int)$_POST["creditos"]){ 
								$dat = new CDbCriteria;
								$dat->condition = "asignado='0'  ";
								$dat->limit=((int)$_POST["creditos"]);
								$monedas = AnaMonedaunitaria::model()->findAll($dat);
								$dat = new CDbCriteria;
								$dat->condition = "email='".$_POST["email"]."'  ";
								$dUsuarioasg = AnaUsuario::model()->find($dat);
								 
								if(isset($dUsuarioasg->id)){
									  
									$contador=0;
									//printVar($monedas);exit; 
									$idmoneda="";
									foreach($monedas as $mo){
										 $idmoneda=$mo->idMoneda;
										$mui=AnaMonedaunitaria::model()->findByPk($mo->id);
 										$modelorg=new AnaMonedaxusuario();    
										$modelorg->idMoneda=$mo->idMoneda;
										$modelorg->idMonedaunitaria=$mui->id;   
										$modelorg->idUsuario=$dUsuarioasg->id;   
										$modelorg->fecharegistro=date("Y-m-d H:i:s");      
 										if($modelorg->save()){
											$contador++;
											$mui->asignado='1';
											$mui->save();  
 										} 
									} 
									
									if((int)$_POST["creditos"]==$contador){
										$flujo=new AnaMonedaFlujo();
										$flujo->idUsuarioOrigen=$dUsuario->id;
										$flujo->idUsuarioDestino=$dUsuarioasg->id;
										$flujo->idMoneda=$idmoneda;
										$flujo->creditos=$contador;
										$flujo->evento="Asignaciónn";
										$flujo->fecharegistro=date("Y-m-d H:i:s"); 
										$flujo->{'hash'}=hash('ripemd160',$flujo->idUsuarioOrigen."--".$flujo->idUsuarioDestino.$flujo->idMoneda.$flujo->creditos.$flujo->evento.$flujo->fecharegistro);
										$flujo->save();
										echo json_encode(array("ok"));exit;
									}else{
										$flujo=new AnaMonedaFlujo();
										$flujo->idUsuarioOrigen=$dUsuario->id;
										$flujo->idUsuarioDestino=$dUsuarioasg->id;
										$flujo->idMoneda=$idmoneda;
										$flujo->creditos=$contador;
										$flujo->evento="Asignaciónn";
										$flujo->fecharegistro=date("Y-m-d H:i:s"); 
										$flujo->{'hash'}=hash('ripemd160',$flujo->idUsuarioOrigen."--".$flujo->idUsuarioDestino.$flujo->idMoneda.$flujo->creditos.$flujo->evento.$flujo->fecharegistro);
										$flujo->save();
										  echo json_encode(array("error","Se asignaron ".$contador." creditos, faltaron ".((int)$_POST["creditos"]-$contador)));exit;
									}
									 
								}else{ echo json_encode(array("error","El usuario seleccionado no existe"));exit;}
							 
							}else{
								echo json_encode(array("error","No hay suficientes creditos para asignar"));exit;
							}   
 						break;							
						 				
					 }
					 

				}  
			}
		}exit;
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