<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
$documentroot=str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"]);
require_once($documentroot.'application/extensions/PHPMailer/class.phpmailer.php');


/*
error_reporting(E_ALL);
ini_set('display_errors', '1'); 

 /*
* LimeSurvey
* Copyright (C) 2007-2011 The LimeSurvey Project Team / Carsten Schmitz
* All rights reserved.
* License: GNU/GPL License v2 or later, see LICENSE.php
* LimeSurvey is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*
*/

/**
* Authentication Controller
*
* This controller performs authentication
*
* @package        LimeSurvey
* @subpackage    Backend
*/

$documentroot=str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"]);
require_once($documentroot.'application/extensions/PHPMailer/class.phpmailer.php');
require_once($documentroot.'application/controllers/admin/reportes.php');
 require_once($documentroot.'application/extensions/class_sql_inject.php');
 


class Authentication extends Survey_Common_Action
{
	
  	private $kp='93857366asmdmfmm';
	private $filesbi="/filesbi/cubos/";
	private $filesbideleted="/filesbi/cubos/deleted/";
	private $datasets="/filesbi/datasets/";
	private $descomprimido="/filesbi/datasets/descomprimido/";
	/*
	private $muestra=10;
  	private $limite=500;
  	private $limitemuestra=1000;
	*/
	private $muestra=10000;
  	private $limite=500000;
  	private $limitemuestra=1000000;
	
	private $filecsv;
	private $columnas;
	private $filas;
	private $filtros;
	private $campos;
	private $bi=NULL;
	
	function __construct($controller, $id)
    {
        parent::__construct($controller, $id);

        //Yii::app()->loadHelper('database');
		$this->kp= $this->kp.substr($this->kp,0,8);
		//printVar($this->kp);
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

    /**
    * Show login screen and parse login data
    */
    public function documentacion()
    {  
		Yii::app()->cache->flush();
		if(isset($_SESSION['loginID'])){
			$aData["oRecord"] = User::model()->findByPk($_SESSION['loginID']); 
			$aData["usuario"] = AnaUsuario::model()->findByPk($aData["oRecord"]->iduseval);
		}
		$q='';
		if(isset($_POST["anio"])){
			if((int)$_POST["anio"]>0){
				$q=' and fecha like "%'.(int)$_POST["anio"].'-%"'; 
			}
			
		}
 		$criteria = new CDbCriteria;
		$criteria->condition = ' tipo="documentos"  and estado="si"';
		$criteria->order=" id DESC";
		$archivos=EvalArchivos::model()->findAll($criteria);
		$anios=array();
		foreach($archivos as $data){
			list($a,$m,$dh)=explode("-",$data->fecha);
			if(!isset($anios[$a])){
				$anios[$a]=$a;
			}
 		}
		$aData["anio"]=$anios;
 		$criteria = new CDbCriteria;
		$criteria->condition = ' tipo="documentos"  and estado="si"';
		$criteria->order=" id DESC";
		$aData["archivos"]=EvalArchivos::model()->findAll($criteria);
 		$this->_renderWrappedTemplate('pcos', 'documentacion', $aData);
 		 
    }	
	
    public function index()
    { //printVar(345678);exit;
		if(!isset($_GET["token"])){
			$this->iniciar();exit;
		}
  		$aData["us"]="";
		$aData["pw"]="";
		$aData["error"]="";
 		if(isset($_GET["token"])){
				$hoy=date("Y-m-d H:i:s");
				$datd = new CDbCriteria;
				$datd->condition = 'token="'.trim(trim($_GET["token"])," ").'"';
				$valida = Ushseq::model()->find($datd);
				if(isset($valida->id)){
					if($hoy>=$valida->fechainicio and $hoy<=$valida->fechafin ){
						$datd = new CDbCriteria;
						$datd->condition = 'id_unidad='.$valida->idorg.' and perfil=5';
						$datd->order = 'id DESC';
						$valida = AnaUsuario::model()->find($datd);
						if(isset($valida->id)){
							$us=$valida->alias;
							$pw=$valida->clave;
							$_SESSION["encuesta_token"]=$_GET["token"];
						}
					}else{
						if($hoy<$valida->fechainicio){
							$aData["error"]="La encuesta inicia el día ". $valida->fechainicio;
						}
						if($hoy>$valida->fechafin ){$aData["error"]="El periodo para aplicar a la encuesta finalizó ". $valida->fechafin;}
						 
					}
				}else{
					$aData["error"]="La encuesta no existe";
				}
				$aData["us"]=$us;
				$aData["pw"]=$pw;
		}	
 		
         $this->_redirectIfLoggedIn();
        
        // Make sure after first run / update the authdb plugin is registered and active
        // it can not be deactivated
		//unset($_POST[YII_CSRF_TOKEN]);
  		
        if (!class_exists('Authdb', false)) {
            $plugin = Plugin::model()->findByAttributes(array('name'=>'Authdb'));
            if (!$plugin) {
                $plugin = new Plugin();
                $plugin->name = 'Authdb';
                $plugin->active = 1;
                $plugin->save();                
                App()->getPluginManager()->loadPlugin('Authdb', $plugin->id);
            } else {
                $plugin->active = 1;
                $plugin->save();
            }
        }
		
        $beforeLogin = new PluginEvent('beforeLogin');
        $beforeLogin->set('identity', new LSUserIdentity('', ''));

        App()->getPluginManager()->dispatchEvent($beforeLogin);
        /* @var $identity LSUserIdentity */
        $identity = $beforeLogin->get('identity');
         if (!$beforeLogin->isStopped() && is_null(App()->getRequest()->getPost('login_submit')))
        {
            if (!is_null($beforeLogin->get('default'))) {
                $aData['defaultAuth'] = $beforeLogin->get('default');
            }
            $newLoginForm = new PluginEvent('newLoginForm');    
            App()->getPluginManager()->dispatchEvent($newLoginForm);
            $aData['summary'] = $this->_getSummary('logout');
            $aData['pluginContent'] = $newLoginForm->getAllContent();
             $this->_renderWrappedTemplate('authentication', 'login', $aData);
        } else {
             // Handle getting the post and populating the identity there
            $authMethod = App()->getRequest()->getPost('authMethod', $identity->plugin);
            $identity->plugin = $authMethod;

            $event = new PluginEvent('afterLoginFormSubmit');
            $event->set('identity', $identity);
            App()->getPluginManager()->dispatchEvent($event, array($authMethod));
            $identity = $event->get('identity');
			 	// Now authenticate
 			
  			$datd = new CDbCriteria;
			$datd->condition = 'usuario="'.trim(trim($_POST["user"])," ").'" and ip="'.$_SERVER["REMOTE_ADDR"].'"';
			$fallo = FalloAcceso::model()->find($datd);
  			$timeout=true;
			if(isset($fallo->id)){
				if($fallo->cantidad>=3){
					$fecha1 = date("Y-m-d H:i:s");
					$fecha2 = $fallo->fechahora;
					$minutos = ceil(abs((strtotime($fecha1) - strtotime($fecha2)) / 60));
					if ($minutos <= 10) {
						$timeout=false;
						$fallo->fechahora=date("Y-m-d H:i:s");
						$fallo->save();
					}else if ($minutos > 10){
						$fallo->delete();
						$timeout=true;
					}
				}
			}			
 			if ($identity->authenticate() and $timeout==true) 
			{
				FailedLoginAttempt::model()->deleteAttempts();
				App()->user->setState('plugin', $authMethod);
				 
				$oRecord = User::model()->findByPk(Yii::app()->session['loginID']);
				$usuario=AnaUsuario::model()->findByPk($oRecord->iduseval);
				$activo=0;
				if(isset($usuario->id)){
					$activo=$usuario->activo;
				}else if((int)$_SESSION['loginID']==1){
					$activo=1;
				} 
 				if($activo==1){	
					$_COOKIE["key"]="";
					$_COOKIE["nombre"]="";
					$_COOKIE["bienvenida"]="";
					$_COOKIE["tipoproyecto"]="";
					$_COOKIE["email"]="";
					 
					$this->getController()->_GetSessionUserRights(Yii::app()->session['loginID']);
					Yii::app()->session['just_logged_in'] = true;
					Yii::app()->session['loginsummary'] = $this->_getSummary();
					$this->_doRedirect();
				}else{
 					$this->logout();
					$message="Lo sentimos, en el momento no tiene permiso para acceder, por favor comuníquese con el administrador del sistema";
 					 
					App()->user->setFlash('loginError', $message);
					$this->getController()->redirect(array('/admin/authentication/sa/login'));					
				}

			}else{
				// Failed
				$message = $identity->errorMessage;
				$queryString = "
				TRUNCATE {{failed_login_attempts}}";
				$eguresult = dbExecuteAssoc($queryString);	
 				$datd = new CDbCriteria;
				$datd->condition = 'usuario="'.trim(trim($_POST["user"])," ").'" and ip="'.$_SERVER["REMOTE_ADDR"].'"';
				$fallo = FalloAcceso::model()->find($datd);
				if(!isset($fallo->id)){
					$set=new FalloAcceso();
					$set->usuario=trim(trim($_POST["user"])," ");
					$set->ip=$_SERVER["REMOTE_ADDR"];
					$set->fechahora=date("Y-m-d H:i:s");
					$set->cantidad=1;
					$set->save();
 				}else{
				
					$fallo->fechahora=date("Y-m-d H:i:s");
					$fallo->cantidad=((int)$fallo->cantidad+1);
					if((int)$fallo->cantidad>=3){
						$message ="Has superado la cantidad de intentos permitidos, por favor intentalo dentro de 10 minutos";
					}
					$fallo->save();
 				}				
 				if (empty($message)) {
					// If no message, return a default message
					$clang = $this->getController()->lang;
					$message = $clang->gT('Incorrect username and/or password!');
				}
				
				App()->user->setFlash('loginError', $message);
   				$this->getController()->redirect(array('/admin/authentication/sa/login'));
 				
			}
			 
			 
        }
    }
	public function prevSqlInyeccion($input,$noespace=true,$notilde=true,$nosql=true){
		//$input=mysql_real_escape_string($input);
		if($noespace==true){
			$input=str_replace(" ","",$input);
		}
		if($notilde==true){
			$input=str_replace("'","",$input);
			$input=str_replace('"',"",$input);
		}
		
		if($nosql==true){
			$sql=array("select","insert","delete","update","show","table");
			$contar=0;
			foreach($sql as $s){
				$pos=strpos (strtolower($input),$s);
				if($pos===false){
					
				}else{
					$contar++;
				}
				
			}
			if($contar>0){
				$input=false;
			}
		}
		
		 
		 
		
		
		//printVar($input);
		return $input;
	}
	
	public function generarKey($longitud=5){
		$alpha = "123QWERT4567890ABSDFSDFCDEFGHIJ9876542345KLMNOPQR123765STUVWX789904YZ";
		$code = "";
 		for($i=0;$i<$longitud;$i++){
			$code .= $alpha[rand(0, strlen($alpha)-1)];
		}
		return $code;		
 	}
	
	
	public function validar(){
		if(!isset($_SESSION["user"]["keyid"])){
			/*printVar($this->prevSqlInyeccion($_POST["user"]));
			printVar($this->prevSqlInyeccion($_POST["hashcontrol"]),$_POST["hashcontrol"]);*/
			if($this->prevSqlInyeccion($_POST["user"])!=false and $this->prevSqlInyeccion($_POST["hashcontrol"])!=false ){
				if($_POST["hashcontrol"]!=""){
					$hashcontrol=base64_decode($_POST["hashcontrol"]);
					$keyidproyecto=$this->decrypt($hashcontrol,"lindosnenes");
					$dat = new CDbCriteria(array(
						"condition"=>"email = :email and email<>''   and keyproyecto=:keyidproyecto ",
						"params"=>array(":email"=>$_POST["user"],":keyidproyecto"=>$keyidproyecto)
						)
					);//printVar($dat,$_POST["hashcontrol"]);exit;
					$participante=AnaParticipante::model()->find($dat);	
					
					if(isset($participante->keyid)){
						$clave=$this->decrypt(base64_decode($participante->clave),"lindosnenes");
						//printVar($clave,$_POST["password"]);exit;
						if($clave==$_POST["password"]){
							$validar=array("keyid","apellido","nombre","email");
							foreach($participante as $key=>$val){
								//$validar=
								if(in_array($key,$validar)){
									$_SESSION["user"][$key]=$val;
								}
							}
							$_SESSION["TOKENHASH"]=$_POST["hashcontrol"];
							$_SESSION["YIITOKEN"]=$this->generarKey(20);
							$_COOKIE["YIITOKEN"]=$_SESSION["YIITOKEN"];
							$this->homeEvaluacion();
						}else{
							App()->user->setFlash('loginError', $message);
							$this->getController()->redirect(array('/admin/authentication/evaluacion?token='.$_POST["hashcontrol"].'&error'));

						}
					}else{
						App()->user->setFlash('loginError', $message);
						$this->getController()->redirect(array('/admin/authentication/evaluacion?token='.$_POST["hashcontrol"]."&error"));
					}
				}else{
					printVar("URL NO VALIDA");exit;
					
				}
			}else{
				if($_POST["hashcontrol"]==""){printVar("URL NO VALIDA");exit;
				}
				printVar("Posible SqlInyeccion");exit;
			}		
		}else{
			$this->homeEvaluacion();
		} 
 	}
	
	public function guardarencuestatemporalmente(){
		$keyidproyecto=$_POST["keyidproyecto"];
		$keyidevaluado=$_POST["keyidp"];
		$keyidevaluador=$_SESSION["user"]["keyid"];
			 
		$dat = new CDbCriteria;
		$dat->condition = "keyidparticipante = '".$keyidevaluado."' and keyidparticipanteevaluador='".$_SESSION["user"]["keyid"]."' and keyidproyecto='".$keyidproyecto."'";
		
		$relacionparticipante=AnaEncuestaParticipanterelaciones::model()->find($dat);
		if(isset($relacionparticipante->keyid)){
			 
			$jsonrespuestas=array("respuestas"=>array(),"comentariosrespuestas"=>array(),"comentarios"=>array());
			if(isset($_POST["respuesta"])){
				$jsonrespuestas["respuestas"]=$_POST["respuesta"];
			}
			if(isset($_POST["respuestapa"])){
				$jsonrespuestas["comentarios"]=$_POST["respuestapa"];
			}
			if(isset($_POST["comentarios"])){
				$jsonrespuestas["comentariosrespuestas"]=$_POST["comentarios"];
			}
			$jsonrespuestas=json_encode($jsonrespuestas); 
			$relacionparticipante->jsonrtemp=$jsonrespuestas;
			//$relacionparticipante->estado="2";
			$relacionparticipante->fecharesuelto=date("Y-m-d H:i:s");
			$relacionparticipante->save();
			
			foreach($_POST["respuesta"] as $keyidpregunta=>$valor){
 				$dat = new CDbCriteria;
				$dat->condition = "keyidpregunta = '".$keyidpregunta."' and keyidproyecto='".$keyidproyecto."'";
				//printVar($dat);exit;
				$pcom=AnaEncuestaPreguntasxcompetenciasProyecto::model()->find($dat);				
				
				
				$dat = new CDbCriteria;
				$dat->condition = "keyidevaluado = '".$keyidevaluado."' and keyidevaluador='".$_SESSION["user"]["keyid"]."' and keyidcompetencia='".$pcom->keyidcompetencia."' and keyidproyecto='".$_POST["keyidproyecto"]."' and keyidpregunta='".$keyidpregunta."'";
				//printVar($dat);exit;
				$set=AnaEncuestaRespuestas::model()->find($dat);					
				if(!isset($set->keyid)){
					$set=new AnaEncuestaRespuestas();
					$set->keyid=$key;
				}
				$set->keyidevaluado=$keyidevaluado;
				$set->keyidevaluador=$_SESSION["user"]["keyid"];
				$set->keyidproyecto=$_POST["keyidproyecto"];
				$set->keyidcompetencia=$pcom->keyidcompetencia;
				$set->keyidpregunta=$keyidpregunta;
				$set->respuesta=$valor;
				if(isset($_POST["comentarios"][$keyidpregunta])){
				$set->comentarios=$_POST["comentarios"][$keyidpregunta];
				}
				$set->fecharegistro=date("Y-m-d H:i:s");
 				$set->save();
			}
 			
			echo json_encode(array("ok2"));
		}
		
		//printVar($_POST);exit;
	}
	public function guardarencuesta(){
		if(isset($_SESSION["user"]["keyid"])){
			if(isset($_POST["guardar"])){
				$respuesta=$_POST["respuesta"];
				$respuestapa=$_POST["respuestapa"];
				$keyidevaluado=$_POST["keyidp"];
				$keyidproyecto=$_POST["keyidproyecto"];
				
			 		 
				$dat = new CDbCriteria;
				$dat->condition = "keyidparticipante = '".$keyidevaluado."' and keyidparticipanteevaluador='".$_SESSION["user"]["keyid"]."' and keyidproyecto='".$keyidproyecto."'";
				
				$relacionparticipante=AnaEncuestaParticipanterelaciones::model()->find($dat);				
 				//printVar($relacionparticipante);exit;
				$contador2=0;
				foreach($respuesta as $keyidpregunta=>$valor){
					$key=$this->generarKey();
					 
					$dat = new CDbCriteria;
					$dat->condition = "keyid = '".$key."'";
					//printVar($dat);exit;
					$verificarkey=AnaEncuestaRespuestas::model()->find($dat);				
					 
					$dat = new CDbCriteria;
					$dat->condition = "keyidpregunta = '".$keyidpregunta."' and keyidproyecto='".$_POST["keyidproyecto"]."'";
					//printVar($dat);exit;
					$pcom=AnaEncuestaPreguntasxcompetenciasProyecto::model()->find($dat);				
					 
					
					if(isset($verificarkey->{'keyid'})){
						$bandera=false;
						$contador=6;
						while($bandera==false){
							$key=$this->generarKey($contador);
							$dat = new CDbCriteria;
							$dat->condition = "keyid = '".$key."'";
							$verificarkey=AnaEncuestaRespuestas::model()->find($dat);
							if(!isset($verificarkey->{'keyid'})){
								$bandera=true;
							}
							$contador++;
						}
					} 

					$dat = new CDbCriteria;
					$dat->condition = "keyidevaluado = '".$keyidevaluado."' and keyidevaluador='".$_SESSION["user"]["keyid"]."' and keyidcompetencia='".$pcom->keyidcompetencia."' and keyidproyecto='".$_POST["keyidproyecto"]."' and keyidpregunta='".$keyidpregunta."'";
					//printVar($dat);exit;
					$set=AnaEncuestaRespuestas::model()->find($dat);					
					if(!isset($set->keyid)){
						$set=new AnaEncuestaRespuestas();
						$set->keyid=$key;
					}
 					$set->keyidevaluado=$keyidevaluado;
 					$set->keyidevaluador=$_SESSION["user"]["keyid"];
 					$set->keyidproyecto=$_POST["keyidproyecto"];
 					$set->keyidcompetencia=$pcom->keyidcompetencia;
 					$set->keyidpregunta=$keyidpregunta;
 					$set->respuesta=$valor;
					if(isset($_POST["comentarios"][$keyidpregunta])){
 					$set->comentarios=$_POST["comentarios"][$keyidpregunta];
					}
  					$set->fecharegistro=date("Y-m-d H:i:s");
					
					$set->save();
					$contador2++;
					
				} //printVar($respuestapa );
				//exit;
				
				foreach($respuestapa as $keyidpregunta=>$valor){ 
					if(trim($valor," ")!=""){
						$key=$this->generarKey();
						 
						$dat = new CDbCriteria;
						$dat->condition = "keyid = '".$key."'";
						//printVar($dat);exit;
						$verificarkey=AnaEncuestaRespuestasAbiertas::model()->find($dat);				
						
						$dat = new CDbCriteria;
						$dat->condition = "keyidpregunta = '".$keyidpregunta."' and keyidproyecto='".$_POST["keyidproyecto"]."'";
						
						$pcom=AnaEncuestaPreguntasxcompetenciasProyecto::model()->find($dat);				
 						if(isset($verificarkey->{'keyid'})){
							$bandera=false;
							$contador=6;
							while($bandera==false){
								$key=$this->generarKey($contador);
								$dat = new CDbCriteria;
								$dat->condition = "keyid = '".$key."'";
								$verificarkey=AnaEncuestaRespuestasAbiertas::model()->find($dat);
								if(!isset($verificarkey->{'keyid'})){
									$bandera=true;
								}
								$contador++;
							}
						} 

						$dat = new CDbCriteria;
						$dat->condition = "keyidevaluado = '".$keyidevaluado."' and keyidevaluador='".$_SESSION["user"]["keyid"]."' and keyidproyecto='".$_POST["keyidproyecto"]."' and keyidpregunta='".$keyidpregunta."'";
						//printVar($dat);exit;
						$set=AnaEncuestaRespuestasAbiertas::model()->find($dat);
						if(!isset($set->keyidevaluado)){
 							$set=new AnaEncuestaRespuestasAbiertas();
							$set->keyid=$key;
						}
						$set->keyidevaluado=$keyidevaluado;
						$set->keyidevaluador=$_SESSION["user"]["keyid"];
						$set->keyidproyecto=$_POST["keyidproyecto"];
 						$set->keyidpregunta=$keyidpregunta;
						$set->respuesta=$valor;
						$set->fecharegistro=date("Y-m-d H:i:s");
						$set->save();
						$contador2++;
					}
				}
				if($contador2>0){
					
					$jsonrespuestas=array("respuestas"=>array(),"comentariosrespuestas"=>array(),"comentarios"=>array());
					if(isset($_POST["respuesta"])){
						$jsonrespuestas["respuestas"]=$respuesta;
					}
					if(isset($_POST["respuestapa"])){
						$jsonrespuestas["comentarios"]=$respuestapa;
					}
					if(isset($_POST["comentarios"])){
						$jsonrespuestas["comentariosrespuestas"]=$_POST["comentarios"];
					}
					$jsonrespuestas=json_encode($jsonrespuestas); 
					$relacionparticipante->jsonrtemp=$jsonrespuestas;					
 					
					$relacionparticipante->estado='1';
					$relacionparticipante->fecharesuelto=date("Y-m-d H:i:s");
					$relacionparticipante->save();
					echo json_encode(array("ok",$contador2));
				}else{echo json_encode(array("no",$contador2));}
				
				exit;
			 	
			}
		}
	}
	
	 
	public function encuesta(){ //printVar();exit;
		if(isset($_SESSION["user"]["keyid"])){
			$dat = new CDbCriteria;
			$dat->condition = "keyidproyecto = '".$_POST["keyidproyecto"]."'  and aplicar='1'"; 	
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

			
			
			
			$datd = new CDbCriteria;
			$datd->condition = 'keyidparticipanteevaluador="'.$_SESSION["user"]["keyid"].'"  and keyidparticipante="'.$_POST["keyid"].'"   and keyidproyecto="'.$_POST["keyidproyecto"].'"';
 			$temporales = AnaEncuestaParticipanterelaciones::model()->find($datd);
			
 			

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
				$nombre=$evaluado->nombre." ".$evaluado->apellido;
				if($proyecto->tipoproyecto!=1){
					$nombre=$evaluado->nombre;
				}
				$preguntaescala=str_replace("*",$nombre,$escala->preguntaescala);
				
				$escalaFin=array("ok",$totales,(int)$escala->rango,$tv,$preguntaescala);
			}

			$rpa=array("no");

			if(count($preguntaabierta)>0){
				$rpa=array();
				foreach($preguntaabierta as $dato){
					array_push($rpa,array($dato->enunciado,$dato->keyid));
				}
			}

			$datafin["temporales"]=json_decode($temporales->jsonrtemp);

			echo json_encode(array("ok",$datafin,$escalaFin,$rpa));exit;
		}
								
	}
		
	public function actualizarparticipante(){
		if(isset($_SESSION["user"]["keyid"])){ 
 			$datd = new CDbCriteria;
			$datd->condition = 'keyid="'.$_SESSION["user"]["keyid"].'" ';
			$res=AnaParticipante::model()->find($datd);
			if(isset($res->keyid)){
				//$res->apellido=$_POST["apellido"];
				//$res->nombre=$_POST["nombre"];
				//$res->email=$_POST["email"];
				if($_POST["clave"]!="" and $_POST["clave"]!="********"){
					foreach($_POST["keys"] as $key){
						 if($key=="clave"){
							$res->clave= base64_encode($this->encrypt( $_POST["clave"],"lindosnenes")); 
						 }else{
							 $res->{$key}= (int)$_POST[$key];
						 }
					}
 					
					$res->resetpassword= '0';
					$res->save();
				} 				
 				
				echo json_encode(array("ok"));exit;
				
			}else{
				echo json_encode(array("no"));exit;
			}
 		}else{
			echo json_encode(array("login"));exit;
		}
		
	}


	public function contactenos(){
		if(isset($_SESSION["user"]["keyid"])){ 
 			
			$datd = new CDbCriteria;
			$datd->condition = 'keyid="'.$_SESSION["user"]["keyid"].'" ';
			$res=AnaParticipante::model()->find($datd);
			if(isset($res->keyid)){
				
				$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
				$mail->IsSMTP(); // telling the class to use SMTP
				$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
				$mail->SMTPAuth   = true;                  // enable SMTP authentication
				$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
				$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
				$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
				$mail->Username   = "info@talentracking.com";  // GMAIL username
				$mail->Password   = "talentracki";            // GMAIL password
				//$mail->AddAddress($ussurvey[0]["email"], utf8_decode("Fundación Colombiana del Corazón"));
				$mail->AddAddress("info@talentracking.com","SISTEMA 360 contacto". utf8_decode($_POST["asunto"]));
				$mail->SetFrom('info@talentracking.com',  utf8_decode($asunto));
				$mail->AddReplyTo($_POST["email"],"COPÏA MENSAJE ".  utf8_decode($asunto));
				$mail->Subject = utf8_decode($_POST["asunto"]);
				$mail->MsgHTML($_POST["comentario"]);
				$r=$mail->Send();				
				
 				
				
				echo json_encode(array("ok"));exit;
				
			}else{
				echo json_encode(array("no"));exit;
			}
 		}else{
			echo json_encode(array("login"));exit;
		}
		
	}


	
	public function homeEvaluacion(){ 
		if(isset($_SESSION["user"]["keyid"])){ 
			//printVar($_SESSION);
			
			$datd = new CDbCriteria;
			$datd->condition = 'keyidparticipanteevaluador="'.$_SESSION["user"]["keyid"].'"  and keyidrelacion<>"NR"  ';
 			$paraevaluar = AnaEncuestaParticipanterelaciones::model()->findAll($datd);
			//printVar($paraevaluar);
			$evaluar=array();
			$autoevaluacion=array();
			$auto=array("","autoeval");
			$datd = new CDbCriteria;
			$datd->condition = 'keyid="'.$_SESSION["user"]["keyid"].'"';
			$evaluador = AnaParticipante::model()->find($datd);
			
			if(isset($evaluador->keyid)){ 
				$datd = new CDbCriteria;
				$datd->condition = 'keyid="'.$evaluador->keyproyecto.'"';
				$proyecto = AnaProyecto::model()->find($datd);
				//printVar($proyecto);
			}
			$aData=array();
			$idioma = AnaLanguage::model()->findByPk(1); //printVar($idioma );exit;
			if(isset($idioma->json)){
			$aData["idioma"]=json_decode($idioma->json);
			$_SESSION["codelang"]=base64_encode($idioma->json);
			}
 			$estadoencuesta=array();
			foreach($paraevaluar as $data){
				$datd = new CDbCriteria;
				$datd->condition = 'keyid="'.$data->keyidrelacion.'"  ';
				$relacion = AnaRelacionxproyecto::model()->find($datd);

 				
				$datd = new CDbCriteria;
				$datd->condition = 'keyid="'.$data->keyidparticipante.'"';
 				$evaluado = AnaParticipante::model()->find($datd);
  				if(isset($evaluado->keyid)){
					$aData["keyidproyecto"]=$evaluado->keyproyecto;
					
					
					//$competencias=json_decode($evaluado->jsoncompetencias);
					$datd = new CDbCriteria;
					$datd->condition = 'keyidparticipanteevaluador="'.$_SESSION["user"]["keyid"].'"  and keyidparticipante="'.$evaluado->keyid.'" and keyidproyecto="'.$evaluado->keyproyecto.'"';
					$estado = AnaEncuestaParticipanterelaciones::model()->find($datd);
					//printVar($estado);exit;
					array_push($estadoencuesta,$estado->estado);
 					$nombre=$evaluado->nombre." ".$evaluado->apellido;
					if($proyecto->tipoproyecto!=1){
						$nombre=$evaluado->nombre;
						if($nombre==""){
							$nombre=$evaluado->apellido;
						}
						 
					} 
					$info=array("nombre"=>$nombre,"keyid"=>$evaluado->keyid,"temporales"=>json_decode($data->jsonrtemp),"estado"=>$estado->estado);
					//printVar($info);exit;
 					if(in_array($data->keyidrelacion,$auto)){
						array_push($autoevaluacion,$info);
					}else{
						if(isset($evaluar[$relacion->nombre])){ 
							array_push($evaluar[$relacion->nombre],$info);
						}else{
							$evaluar[$relacion->nombre]=array($info);
						} 
					}
				}//printVar($estadoencuesta);
			}//
			//printVar($estadoencuesta); //exit;
		
			$aData["estadoencuesta"]=$estadoencuesta;
			$aData["tipoproyecto"]=AnaEncuestaTipoproyecto::model()->findAll();
			$aData["edad"]=AnaTipoedad::model()->findAll();	
			$aData["antiguedad"]=AnaTipoantiguedad::model()->findAll();	
			$aData["ecivil"]=AnaTipoestadocivil::model()->findAll();	
			$aData["nacademico"]=AnaTiponivelacademico::model()->findAll();					
			$aData["genero"]=AnaTipogenero::model()->findAll();				 
			
			$aData["autoevaluacion"]=$autoevaluacion;
			$aData["otros"]=$evaluar;
			$aData["evaluador"]=$evaluador;
			$aData["proyecto"]=$proyecto;
			//printVar($otros);     
		 
			$this->_renderWrappedTemplate('evaluacion', 'homeeval', $aData);
		}
	}
	public function salir(){
		$this->logout(NULL,true);
	}
    public function evaluacion()
    {  	if(!isset($_POST["user"])){
			if(!isset($_SESSION["user"]["keyid"])){
				$aData=$this->getLanguagetemplates();
				$this->_renderWrappedTemplate('authentication', 'evaluacion', $aData);
			}else{
				//printVar("EVAL");
				$this->validar();
			}
		}else{
			//printVar("EVAL2");
			$this->validar();
			
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
 
	
    public function iniciar()
    { 	//printVar(111111111);
		$aData=$this->getLanguagetemplates();
 		$aData["us"]="";
		$aData["pw"]="";
		$aData["error"]="";
 		Setcookie ("key", "",0);
		Setcookie ("nombre", "",0);
		Setcookie ("bienvenida", "",0);
		Setcookie ("tipoproyecto", "",0);
		Setcookie ("email", "",0);
 		
 		if(isset($_GET["token"])){
				$hoy=date("Y-m-d H:i:s");
				$datd = new CDbCriteria;
				$datd->condition = 'token="'.trim(trim($_GET["token"])," ").'"';
				$valida = Ushseq::model()->find($datd);
				if(isset($valida->id)){
					if($hoy>=$valida->fechainicio and $hoy<=$valida->fechafin ){
						$datd = new CDbCriteria;
						$datd->condition = 'id_unidad='.$valida->idorg.' and perfil=5';
						$datd->order = 'id DESC';
						$valida = AnaUsuario::model()->find($datd);
						if(isset($valida->id)){
							$us=$valida->alias;
							$pw=$valida->clave;
							$_SESSION["encuesta_token"]=$_GET["token"];
						}
					}else{
						$aData["error"]="El periodo para aplicar a la encuesta finalizó ". $valida->fechafin;
					}
				}else{
					$aData["error"]="La encuesta no existe";
				}
				$aData["us"]=$us;
				$aData["pw"]=$pw;
		}	
 		
         $this->_redirectIfLoggedIn();
        
        // Make sure after first run / update the authdb plugin is registered and active
        // it can not be deactivated
		//unset($_POST[YII_CSRF_TOKEN]);
  		
        if (!class_exists('Authdb', false)) {
            $plugin = Plugin::model()->findByAttributes(array('name'=>'Authdb'));
            if (!$plugin) {
                $plugin = new Plugin();
                $plugin->name = 'Authdb';
                $plugin->active = 1;
                $plugin->save();                
                App()->getPluginManager()->loadPlugin('Authdb', $plugin->id);
            } else {
                $plugin->active = 1;
                $plugin->save();
            }
        }
		
        $beforeLogin = new PluginEvent('beforeLogin');
        $beforeLogin->set('identity', new LSUserIdentity('', ''));

        App()->getPluginManager()->dispatchEvent($beforeLogin);
        /* @var $identity LSUserIdentity */
        $identity = $beforeLogin->get('identity');
         if (!$beforeLogin->isStopped() && is_null(App()->getRequest()->getPost('login_submit')))
        {
            if (!is_null($beforeLogin->get('default'))) {
                $aData['defaultAuth'] = $beforeLogin->get('default');
            }
            $newLoginForm = new PluginEvent('newLoginForm');    
            App()->getPluginManager()->dispatchEvent($newLoginForm);
            $aData['summary'] = $this->_getSummary('logout');
            $aData['pluginContent'] = $newLoginForm->getAllContent();
			$datd = new CDbCriteria;
			$datd->condition = 'tipo="empresas" and estado ="si"';
			$datd->order =" idorg ASC";
 			$logemp=EvalArchivos::model()->findAll($datd);
			$aData["logemp"]=$logemp;
			$datd = new CDbCriteria;
			$datd->condition = 'tipo="gestores"  and estado ="si"';
			$datd->order =" idorg ASC";
			$logoges=EvalArchivos::model()->findAll($datd);
			$aData["logoges"]=$logoges;
			//printVar($aData["logemp"]);
 			$_SESSION["alternative"]=1;
			$this->_renderWrappedTemplate('authentication', 'iniciar', $aData);
        } else {
             // Handle getting the post and populating the identity there
            $authMethod = App()->getRequest()->getPost('authMethod', $identity->plugin);
            $identity->plugin = $authMethod;

            $event = new PluginEvent('afterLoginFormSubmit');
            $event->set('identity', $identity);
            App()->getPluginManager()->dispatchEvent($event, array($authMethod));
            $identity = $event->get('identity');
			 	// Now authenticate
 			
  			$datd = new CDbCriteria;
			$datd->condition = 'usuario="'.trim(trim($_POST["user"])," ").'" and ip="'.$_SERVER["REMOTE_ADDR"].'"';
			$fallo = FalloAcceso::model()->find($datd);
  			$timeout=true;
			if(isset($fallo->id)){
				if($fallo->cantidad>=3){
					$fecha1 = date("Y-m-d H:i:s");
					$fecha2 = $fallo->fechahora;
					$minutos = ceil(abs((strtotime($fecha1) - strtotime($fecha2)) / 60));
					if ($minutos <= 10) {
						$timeout=false;
						$fallo->fechahora=date("Y-m-d H:i:s");
						$fallo->save();
					}else if ($minutos > 10){
						$fallo->delete();
						$timeout=true;
					}
				}
			}			
 			if ($identity->authenticate() and $timeout==true) 
			{
				FailedLoginAttempt::model()->deleteAttempts();
				App()->user->setState('plugin', $authMethod);
				 
				$oRecord = User::model()->findByPk(Yii::app()->session['loginID']);
				$usuario=AnaUsuario::model()->findByPk($oRecord->iduseval);
				$activo=0;
				if(isset($usuario->id)){
					$activo=$usuario->activo;
				}else if((int)$_SESSION['loginID']==1){
					$activo=1;
				} 
 				if($activo==1){	
					$this->getController()->_GetSessionUserRights(Yii::app()->session['loginID']);
					Yii::app()->session['just_logged_in'] = true;
					Yii::app()->session['loginsummary'] = $this->_getSummary();
					$this->_doRedirect();
				}else{
 					$this->logout();
					$message="Lo sentimos, en el momento no tiene permiso para acceder, por favor comuníquese con el administrador del sistema";
 					 
					App()->user->setFlash('loginError', $message);
					$this->getController()->redirect(array('/admin/authentication/iniciar'));					
				}

			}else{
				// Failed
				$message = $identity->errorMessage;
				$queryString = "
				TRUNCATE {{failed_login_attempts}}";
				$eguresult = dbExecuteAssoc($queryString);	
 				$datd = new CDbCriteria;
				$datd->condition = 'usuario="'.trim(trim($_POST["user"])," ").'" and ip="'.$_SERVER["REMOTE_ADDR"].'"';
				$fallo = FalloAcceso::model()->find($datd);
				if(!isset($fallo->id)){
					$set=new FalloAcceso();
					$set->usuario=trim(trim($_POST["user"])," ");
					$set->ip=$_SERVER["REMOTE_ADDR"];
					$set->fechahora=date("Y-m-d H:i:s");
					$set->cantidad=1;
					$set->save();
 				}else{
				
					$fallo->fechahora=date("Y-m-d H:i:s");
					$fallo->cantidad=((int)$fallo->cantidad+1);
					if((int)$fallo->cantidad>=3){
						$message ="Has superado la cantidad de intentos permitidos, por favor intentalo dentro de 10 minutos";
					}
					$fallo->save();
 				}				
 				if (empty($message)) {
					// If no message, return a default message
					$clang = $this->getController()->lang;
					$message = $clang->gT('Incorrect username and/or password!');
				}
				
				App()->user->setFlash('loginError', $message);
   				$this->getController()->redirect(array('/admin/authentication/iniciar'));
 			}
         }
    }
 
	
	private function crearusuario($data){
 		Yii::app()->cache->flush();
		 
		$subq="";
 				
		
		$datd = new CDbCriteria;
		$datd->condition = 'alias="'.$this->escape($data["email"]).'"';
 		$test=AnaUsuario::model()->find($datd);		
  		if(!isset($test->id)){
			 
			$set=new AnaUsuario();
			$set->nombres=$this->escape($data["nombres"]);
			$set->alias=$this->escape($data["email"]);
			$set->documento=$this->escape($data["documento"]);
			$set->email=$data["email"];
			$set->perfil=4;
			$set->id_unidad=27;
			$set->uid_creador=1;
			$set->clave=RandomString(6,TRUE,TRUE,FALSE); 
			$set->fecharegistro=date("Y-m-d H:i:s");
			$set->activo=1;
			//printVar($set);exit;
			if($set->save()){
				//Yii::app()->cache->flush();
				$orgs=explode(",",$set->id_unidad);
				$dat = new CDbCriteria;
				$dat->condition = "idusuario=".$set->id;
				$ormodel = Usuarioxorg::model()->findAll($dat);

				if(isset($ormodel[0]->id)){
					$queryc = "delete FROM {{usuarioxorg}} where idusuario=".$set->id;
					$gcrt = dbExecuteAssoc($queryc);							
				}
				foreach($orgs as $data){
					$modelorg=new Usuarioxorg();
					$modelorg->idusuario=$set->id;
					$modelorg->idperfil=$set->perfil;
					$modelorg->idorg=$data;
					$modelorg->fecharegistro=date("Y-m-d H:i:s");
					$modelorg->save();
				}
				$iNewUID = User::model()->insertUserNative($set->alias,$set->clave,$set->documento,1, $set->email,$set->id);
				$perfil="default";
				$entity="template";
				$perfil="superadmin";
				$entity="global";
				if($set->perfil==2 or $set->perfil==3 or $set->perfil==4){
					$perfil="default";
					$entity="template";
				}
				if((int)$iNewUID>0){
					Permission::model()->insertSomeRecords(array('uid' => (int)$iNewUID, 'permission' => $perfil, 'entity'=>$entity, 'read_p' => 1, 'entity_id'=>0));
					//echo json_encode(array("El usuario ha sido creado, por favor revise su email",$set->id));
					 
					$this->sendmailcrear(array("alias"=>$set->alias,"clave"=>$set->clave,"nombres"=>$set->nombres,"documento"=>$set->documento,"email"=>$set->email),"Bienvenido. Tu eres un Corazón Responsable y ahora puedes acceder a nuestra plataforma PCOS!!!");
				}					
				
 			}else{
			echo json_encode(array("Algo salio mal"));
			}
		}else{
		
		
		}
 	}	
	
	
 
	
	public function getCubos($id=NULL,$query=""){
		$sql="";
		if((int)$id>0){
			$sql=" and id =".(int)$id;
		} 
		if($query!=""){
			$sql.=" and ".$query;
		}
		$dat = new CDbCriteria;
		$dat->condition = "id>0 ".$sql;
  		$cubos=AnaCubo::model()->findAll($dat);
		$newO=array();
		foreach($cubos as $k=>$v){
			$org=(object)array();
			foreach($v as $id=>$valor){
				$org->{$id}=$valor;
			}
 			array_push($newO,$org);
		}
		return $newO;
	} 
 	public  function  dashboard(){
		Yii::app()->cache->flush();
		
		 
	    
		if(isset($_GET["idr"])){
			$mensaje=array();
			if((int)$_GET["idr"]>0){ 
   				$aData["idr"]=(int)$_GET["idr"];
				$dat = new CDbCriteria;
				$dat->condition = " id=".(int)$_GET["idr"];
				$reportes=AnaReporte::model()->findAll($dat);
 				$aData["cubos"]=$this->getCubos(); 
				$aData["reportesusuario"]=$reportes; 				 
  				$this->_renderWrappedTemplate('reportes', 'dashboard', $aData);
 			}
		}
		
 	}	
 	function sendmailcrear($uss,$asunto){
		$documentroot=str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"]);
		require_once($documentroot.'application/extensions/PHPMailer/class.phpmailer.php');
		require_once($documentroot.'application/extensions/xls/Excel/reader.php');	
  		$htmlfinal.='<p>Bienvenido, '.$uss["nombres"].':</p>  
		<br>
		<p>Ahora puedes acceder a la plataforma PCOS (Programa de Certificación para Organizaciones Saludables), en esta dirección: </p>
		<br>http://bit.ly/2rkgDJR<br>
		
		<p>Allí encontrarás todos los recursos necesarios para conocer nuestro programa.</p>
		<p>Tu usuario es: <b>'.$uss["alias"].'</b></p>
		<p>Tu contraseña es: <b>'.$uss["clave"].'</b></p>
		<p>Comparte en redes sociales. Ahora soy un voluntario de Corazones Responsables. #ahorasoyuncorazonresponsable</p>
		<p>Comparte en redes sociales. Ahora soy embajador de Corazones Responsables. #ahorasoyembajadordecorazonesresponsables</p>
 		<br>
 		 ';
 		
		$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
		$mail->Username   = "info@talentracking.com";  // GMAIL username
		$mail->Password   = "talentracki";            // GMAIL password
		//$mail->AddAddress($ussurvey[0]["email"], utf8_decode("Fundación Colombiana del Corazón"));
		$mail->AddAddress($uss["email"], utf8_decode($asunto));
		$mail->SetFrom('info@talentracking.com',  utf8_decode($asunto));
		$mail->AddReplyTo('fgutierrez@talentracking.com',  utf8_decode($asunto));
		$mail->Subject =  utf8_decode("Buen día.");
		$mail->MsgHTML(utf8_decode($htmlfinal)); 
		$r=$mail->Send();	
		//printVar($uss);exit;
		return $r;
 		
	
	}	 
	
	
    public function registrar()
    {
		$baseUrl = Yii::app()->baseUrl; 
		$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile($baseUrl.'/js/colorbox/jquery.colorbox-min.js');
		$cs->registerCssFile($baseUrl.'/js/colorbox/example1/colorbox.css');	
		
		 $objus= get_class("adminusuario"); 
		
		//printVar($objus::index());
		
		Yii::app()->cache->flush();
		if(isset($_GET["r"])){
			printVar($_GET["r"]);
		}
 		$aData["modulos"]=NULL;
		$aData["model"]=NULL;
		$aData["areas"]=RegistroAreaOrganizacion::model()->findAll();
		$aData["tipos"]=RegistroTipoOrganizacion::model()->findAll();
		$this->_renderWrappedTemplate('estructura', 'registro', $aData);
    }	
 
	function actionsregistrar(){//Yii::app()->cache->flush();
 		if(isset($_POST["option"])){
			$option=$_POST["option"];
			switch($option){
				case "create":
					$datd = new CDbCriteria;
					$datd->condition = ' alias="'.$this->escape($_POST['RegistrarOrganizacion']["emailcontacto"]).'"';
					$test=AnaUsuario::model()->find($datd);
					if($test->id==null){
						$model=new RegistrarOrganizacion();
						$model->attributes=$_POST['RegistrarOrganizacion'];
						$model->fecharegistro=date("Y-m-d H:i:s");
						$model->save();
  						$this->crearusuario(array("nombres"=>$model->representantelegal,"documento"=>$model->docidentidadcontacto,"email"=>$model->emailcontacto));
					}else{$this->getController()->redirect(array('admin/authentication/error')); exit;}
					/*
					$colums=array();
					$values=array();
					
					foreach($model->attributes as $key=>$val){
						if($key!="id" and $key!="fecharegistro"){
							array_push($colums,$key);
							array_push($values,$val);
						}
					}
					
					$queryString = "
					insert into lime_registrar_organizacion (".join(",",$colums).") VALUES ('".join("','",$values)."') ";
					//$res = dbExecuteAssoc($queryString);
				//printVar($queryString);exit;
				*/
				$error="no accion";
					if($model->id>0){
						$error="guardado";
						$this->getController()->redirect(array('admin/authentication/registrado')); 
					}else{
					   echo "Error";
					}
 				break;
				 
			}
		
		}
	}	 
	
	public function registrado(){
		
		$this->_renderWrappedTemplate('estructura', 'registrado', $aData);

	}
	
	public function error(){
		
		$this->_renderWrappedTemplate('estructura', 'error', $aData);

	}
	
	
	
	public function encuestalibre(){
 		$token=trim($_GET["token"]);
		$token = str_replace(
		array("\\", "¨", "º", "-", "~",
			 "#", "@", "|", "!", "\"",
			 "·", "$", "%", "&", "/",
			 "(", ")", "?", "'", "¡",
			 "¿", "[", "^", "`", "]",
			 "+", "}", "{", "¨", "´",
			 ">", "< ", ";", ",",
			 ".", " ","=","SELECT","DELETE","select","delete",'"'),
		'',
		$token
		);	
		list($token,$sid)=explode("::",$token);
		$criteria = new CDbCriteria;
		$criteria->condition = 'token="'.$token."::".$sid.'"';
 		$felicidad=Encuestalibreparams::model()->find($criteria);
 		if(isset($felicidad->id)){
			$hoy=date("Y-m-d");
			if($hoy<=$felicidad->fechafin and $hoy>=$felicidad->fechainicio){
				$baseUrl = Yii::app()->baseUrl; 
				$cs = Yii::app()->getClientScript();
				$cs->registerCssFile($baseUrl.'/scripts/admin/colorbox/example1/colorbox.css');
				$cs->registerScriptFile($baseUrl.'/scripts/admin/colorbox/jquery.colorbox-min.js');
				$aData["sid"]=$sid;
				$aData["idtoken"]=$felicidad->id;
				$aData["dataencuesta"]=$felicidad;
				$aData["org"]= Organizacion::model()->findByPk($felicidad->idorg);
				$aData["modulo"]= Modulo::model()->findByPk($felicidad->idmodulo);
				//printVar($aData["modulo"]->prefijo);
 				$this->_renderWrappedTemplate($aData["modulo"]->prefijo, 'encuesta', $aData);
			}else{
				if($hoy>$felicidad->fechafin){
					$aData["msg"]="Esta encuesta venció el ".$felicidad->fechafin;
				}
				if($hoy<$felicidad->fechainicio){
					$aData["msg"]="Esta encuesta inicia el ".$felicidad->fechafin;
				}
				$this->_renderWrappedTemplate('admusuario', 'confirmar', $aData);

			}
		}else{
			$aData["msg"]="El token no es válido ";
			$this->_renderWrappedTemplate('admusuario', 'confirmar', $aData);
 		}
	}
	public function registro(){
		
		if(!isset($_POST["save"])){
			$token=trim($_GET["token"]);
			$token = str_replace(
			array("\\", "¨", "º", "-", "~",
				 "#", "@", "|", "!", "\"",
				 "·", "$", "%", "&", "/",
				 "(", ")", "?", "'", "¡",
				 "¿", "[", "^", "`", "]",
				 "+", "}", "{", "¨", "´",
				 ">", "< ", ";", ",", ":",
				 ".", " ","=","SELECT","DELETE","select","delete",'"'),
			'',
			$token
			);			
 			
			$dat = new CDbCriteria;
			$dat->condition = "codigo='".$token."'";
			$org = Organizacion::model()->find($dat);
 			if(isset($org->id)){
				$_SESSION["token"]=$token;
				$baseUrl = Yii::app()->baseUrl; 
				$cs = Yii::app()->getClientScript();
				
  				$cs->registerScriptFile($baseUrl."/scripts/yav1_4_1/js/yav.js");
				$cs->registerScriptFile($baseUrl."/scripts/yav1_4_1/js/yav-config-es.js");
				$cs->registerScriptFile("//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js");
 				
				$cs->registerScriptFile($baseUrl.'/js/colorbox/jquery.colorbox-min.js');
				$cs->registerCssFile($baseUrl.'/js/colorbox/example1/colorbox.css');	
 				
				$aData["org"]=$org;
				$this->_renderWrappedTemplate('admusuario', 'registro', $aData);
			}else{
				$aData["msg"]="El token no es válido";
				$this->_renderWrappedTemplate('admusuario', 'confirmar', $aData);
 			}
		}else{		
			$idperfil=2;
			if(isset($_SESSION["token"]) and $_SESSION["token"]!=""){
				$token=trim($_SESSION["token"]);
				$token = str_replace(
				array("\\", "¨", "º", "-", "~",
					 "#", "@", "|", "!", "\"",
					 "·", "$", "%", "&", "/",
					 "(", ")", "?", "'", "¡",
					 "¿", "[", "^", "`", "]",
					 "+", "}", "{", "¨", "´",
					 ">", "< ", ";", ",", ":",
					 ".", " ","=","SELECT","DELETE","select","delete",'"'),
				'',
				$token
				);			
 			
				$dat = new CDbCriteria;
				$dat->condition = "codigo='".$token."' and codigo<>'' ";
				$org = Organizacion::model()->find($dat);
				if(isset($org->id)){
					$dat = new CDbCriteria;
					$dat->condition = "documento='".$this->escape($_POST["documento"])."'";
					$user = AnaUsuario::model()->find($dat);
					if(!isset($user->id)){
						$fecha=date("Y-m-d H:i:s");
						$token=md5($fecha);
  						$set=new AnaUsuario();
						$set->clave=$this->escape($_POST["password"]);
						$set->nombres=$this->escape($_POST["nombres"]);
						$set->alias=$this->escape($_POST["usuario"]);
						$set->documento=$this->escape($_POST["documento"]);
						$set->email=$this->escape($_POST["email"]);
						$set->perfil=$idperfil;
						$set->id_unidad=$org->id;
						$set->uid_creador=1;
						$set->fecharegistro=$fecha;
						$set->activo=0;					
						$set->tokenid=$token;					
						if($set->save()){
 							$modelorg=new Usuarioxorg();
							$modelorg->idusuario=$set->id;
							$modelorg->idperfil=$set->perfil;
							$modelorg->idorg=$org->id;
							$modelorg->fecharegistro=date("Y-m-d H:i:s");
							$modelorg->save();
							
							$iNewUID = User::model()->insertUserNative($set->alias,$set->clave,$set->documento,1, $set->email,$set->id);
							$perfil="default";
							$entity="template";
							if((int)$iNewUID>0){
								Permission::model()->insertSomeRecords(array('uid' => (int)$iNewUID, 'permission' => $perfil, 'entity'=>$entity, 'read_p' => 1, 'entity_id'=>0));
								$aData["msg"]="OK";
								$documentroot=str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"]);
								require_once($documentroot.'application/extensions/PHPMailer/class.phpmailer.php');
 								
								$dat = new CDbCriteria;
								$dat->condition = "idorg=".$set->id_unidad;
								$useradmin = Usuarioxorg::model()->find($dat);

								$dat = new CDbCriteria;
								$dat->condition = "id=".$useradmin->idusuario;
								$userdataadmin = AnaUsuario::model()->find($dat);

								$dat = new CDbCriteria;
								$dat->condition = "id=".$set->id_unidad;
								$org = Organizacion::model()->find($dat);

								$html="Para confirmar su registro haga click <a href='http://www.talentracking.com".$baseUrl."/index.php/admin/authentication/confirmar?token=".$set->tokenid."'>aquí</a>.<br>";
 
								$this->senEmail( $set->email,$userdataadmin->email,$org->nombre,"Confirmación de Registro",$html);
 								
							}else{
								$aData["msg"]="El usuario no se ha creado, por favor intente más tarde. Si el error persite, por favor contacte al servicio técnico";
 							}
 						}
 					}else{
 						$aData["msg"]="existe";				
					}
 					echo json_encode(array($aData["msg"]));exit;
 				}
				
			}
 		}
		
	}
	public function confirmar(){
		$token=trim($_GET["token"]);
		$token = str_replace(
		array("\\", "¨", "º", "-", "~",
			 "#", "@", "|", "!", "\"",
			 "·", "$", "%", "&", "/",
			 "(", ")", "?", "'", "¡",
			 "¿", "[", "^", "`", "]",
			 "+", "}", "{", "¨", "´",
			 ">", "< ", ";", ",", ":",
			 ".", " ","=","SELECT","DELETE","select","delete",'"'),
		'',
		$token
		);
		$dat = new CDbCriteria;
		$dat->condition = "tokenid='".$token."' and tokenid<>''";
		$user = AnaUsuario::model()->find($dat);
		if(isset($user->id)){
 			$user->activo=1;
 			$user->tokenid=null;
			if($user->save()){
				$baseUrl = Yii::app()->baseUrl;
				$html=" click <a href='https://www.talentracking.com".$baseUrl."/admin'>aquí</a> para iniciar sesión";
 				$aData["msg"]="Su acceo ha sido activado, por favor haga".$html;
 			}else{
				$aData["msg"]="El token no es válido";
			}
 		}
		$this->_renderWrappedTemplate('admusuario', 'confirmar', $aData);
	}
	
	public function recuperar(){
		$baseUrl = Yii::app()->baseUrl; 
		if(!isset($_SESSION["user"]["keyid"]) and isset($_POST["email"]) and isset($_POST["hashcontrol"])){
			if($_POST["hashcontrol"]!=""){
				$hashcontrol=base64_decode($_POST["hashcontrol"]);
				$keyidproyecto=$this->decrypt($hashcontrol,"lindosnenes");
				$dat = new CDbCriteria(array(
				"condition"=>"email = :email and email<>''   and keyproyecto=:keyidproyecto ",
				"params"=>array(":email"=>$_POST["email"],":keyidproyecto"=>$keyidproyecto)
				)
				);
				$participante=AnaParticipante::model()->find($dat);	
				if(isset($participante->keyid)){
					$config=AnaConfigmail::model()->findAll();
					$config=$config[0];
					$mail = new PHPMailer ();
					$aData=$this->getLanguagetemplates();
					
					$campos=array("nombre"=>"name","apellido"=>"lastname","nombreopcional"=>"organization","email"=>"email","clave"=>"password");
					$composerd=array();
					$html=$aData["idioma"]->templatemailing;
					foreach($participante as $key=>$valor){
						if(isset($campos[$key])){
							if($key=="clave"){
								$valor=$this->decrypt(base64_decode($valor),"lindosnenes");
							}
							$html=str_replace("{{".$campos[$key]."}}",$valor,$html);
						}
						$composerd[$key]=$valor;
					}

					$token=$_POST["hashcontrol"];
					$http="http://";
					if(isset($_SERVER["HTTPS"])){
					$http="https://";
					}
					$http.=$_SERVER["HTTP_HOST"].Yii::app()->baseUrl."/index.php/admin/authentication/evaluacion?token=".$token;							

					$html=str_replace("{{urlsurvey}}",' <a href="'.$http.'">'.$http.'</a> ',$html);

					$html=str_replace("{{emailsuport}}",$config->username,$html);				
					
					//printVar($mail);
					//$mail -> From = $tem->nombre; 
					//$mail -> FromName =$tem->nombre;
					$mail -> setFrom ($config->username,utf8_decode($aData["idioma"]->nmailingrecuperar));
					$mail -> AddAddress ($participante->email);
					$mail -> Subject = utf8_decode($aData["idioma"]->nmailingrecuperar);
					$mail -> Body = $html;
					$mail -> IsHTML(true);
					$mail->IsSMTP();
					$mail->SMTPDebug = 0;
					$mail->SMTPAuth = true;
					$mail->SMTPSecure = $config->smtpsecure; // secure transfer enabled REQUIRED for GMail
					$mail->Host = $config->host;
					$mail->Port =  $config->port;
					$mail->Username   = $config->username;  // GMAIL username
					$mail->Password   =  $config->password;            // GMAIL password


					//printVar($mail->Send());
					if($mail->Send()) {
						$participante->resetpassword='1';$participante->save();
						echo json_encode(array("ok"));exit;
					} else{echo json_encode(array("no"));exit;}
				}else{
					echo json_encode(array("noexiste"));exit;
				}
 			}else{
				echo json_encode(array("urlnovalida"));exit;
			}
		
			
		}else{echo json_encode(array("urlnovalida"));exit;} 
 		//$this->senEmail( $email,$emailadmin,$titulo,$subject,$html);
 	}
	
	
	
	private function senEmail( $email,$emailadmin,$titulo,$subject,$html){
 		if($email!="NR"){
 			$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
			$mail->Username   = "info@talentracking.com";  // GMAIL username
			$mail->Password   = "talentracki";            // GMAIL password
			$mail->AddAddress($email,$titulo);
			$mail->SetFrom('info@talentracking.com', $titulo);
			$mail->AddReplyTo('fgutierrez@talentracking.com', 'Hseq');
			$mail->AddCC($emailadmin, $titulo);
			$mail->Subject =utf8_decode($subject);
			$html = utf8_decode($html);
			//$html = html_entity_decode($html								
			$mail->MsgHTML(($html));
			$mail->Send();
		}	 
 	}	
 	
	 private function escape($str)
    {
        if (is_string($str)) {
            $str = $this->escape_str($str);
        }
        elseif (is_bool($str))
        {
            $str = ($str === true) ? 1 : 0;
        }
        elseif (is_null($str))
        {
            $str = 'NULL';
        }

        return $str;
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
	
	

    /**
    * Logout user
    */
    public function logout($message=NULL,$avaluacion=false)
    {
		$alternative=false;
		if(isset($_SESSION["alternative"])){$alternative=true;}
		
		$token="";
		if(isset($_SESSION["TOKENHASH"])){
			$token=$_SESSION["TOKENHASH"];
		}		
        // Fetch the current user
        $plugin = App()->user->getState('plugin', null);    // Save for afterLogout, current user will be destroyed by then
                 
        /* Adding beforeLogout event */
        $beforeLogout = new PluginEvent('beforeLogout');
        App()->getPluginManager()->dispatchEvent($beforeLogout, array($plugin));

        App()->user->logout();
        App()->user->setFlash('loginmessage', gT('Logout successful.'));

        /* Adding afterLogout event */
        $event = new PluginEvent('afterLogout');
        App()->getPluginManager()->dispatchEvent($event, array($plugin));

		//printVar($token);exit;
		unset($_SESSION);
		unset($_COOKIE);
		if($message==NULL){
			if($avaluacion==true){
				$this->getController()->redirect(array('/admin/authentication/evaluacion?token='.$token));
			}
			// App()->user->setFlash('loginError', $message);
			if($alternative==true){
			$this->getController()->redirect(array('/admin/authentication/iniciar'));
			}else{
			 $this->getController()->redirect(array('/admin/authentication/sa/login'));
			}
		}
         
    }

    /**
    * Forgot Password screen
    */
    public function forgotpassword()
    {
        $this->_redirectIfLoggedIn();

        if (!Yii::app()->request->getPost('action'))
        {
            $this->_renderWrappedTemplate('authentication', 'forgotpassword');
        }
        else
        {
            $sUserName = Yii::app()->request->getPost('user');
            $sEmailAddr = Yii::app()->request->getPost('email');

            $aFields = User::model()->findAllByAttributes(array('users_name' => $sUserName, 'email' => $sEmailAddr));

            if (count($aFields) < 1)
            {
                // wrong or unknown username and/or email
                $aData['errormsg'] = $this->getController()->lang->gT('User name and/or email not found!');
                $aData['maxattempts'] = '';
                $this->_renderWrappedTemplate('authentication', 'error', $aData);
            }
            else
            {
                $aData['message'] = $this->_sendPasswordEmail($sEmailAddr, $aFields);
                $this->_renderWrappedTemplate('authentication', 'message', $aData);
            }
        }
    }

    /**
    * Send the forgot password email
    *
    * @param string $sEmailAddr
    * @param array $aFields
    */
    private function _sendPasswordEmail($sEmailAddr, $aFields)
    {
        $clang = $this->getController()->lang;
        $sFrom = Yii::app()->getConfig("siteadminname") . " <" . Yii::app()->getConfig("siteadminemail") . ">";
        $sTo = $sEmailAddr;
        $sSubject = $clang->gT('User data');
        $sNewPass = createPassword();
        $sSiteName = Yii::app()->getConfig('sitename');
        $sSiteAdminBounce = Yii::app()->getConfig('siteadminbounce');

        $username = sprintf($clang->gT('Username: %s'), $aFields[0]['users_name']);
        $email    = sprintf($clang->gT('Email: %s'), $sEmailAddr);
        $password = sprintf($clang->gT('New password: %s'), $sNewPass);

        $body   = array();
        $body[] = sprintf($clang->gT('Your user data for accessing %s'), Yii::app()->getConfig('sitename'));
        $body[] = $username;
        $body[] = $password;
        $body   = implode("\n", $body);

        if (SendEmailMessage($body, $sSubject, $sTo, $sFrom, $sSiteName, false, $sSiteAdminBounce))
        {
            User::model()->updatePassword($aFields[0]['uid'], $sNewPass);
            $sMessage = $username . '<br />' . $email . '<br /><br />' . $clang->gT('An email with your login data was sent to you.');
        }
        else
        {
            $sTmp = str_replace("{NAME}", '<strong>' . $aFields[0]['users_name'] . '</strong>', $clang->gT("Email to {NAME} ({EMAIL}) failed."));
            $sMessage = str_replace("{EMAIL}", $sEmailAddr, $sTmp) . '<br />';
        }

        return $sMessage;
    }

    /**
    * Get's the summary
    * @param string $sMethod login|logout
    * @param string $sSummary Default summary
    * @return string Summary
    */
    private function _getSummary($sMethod = 'login', $sSummary = '')
    {
        if (!empty($sSummary))
        {
            return $sSummary;
        }

        $clang = $this->getController()->lang;

        switch ($sMethod) {
            case 'logout' :
                $sSummary = $clang->gT('Please log in first.');
                break;

            case 'login' :
            default :
                $sSummary = '<br />' . sprintf($clang->gT('Welcome %s!'), Yii::app()->session['full_name']) . '<br />&nbsp;';
                if (!empty(Yii::app()->session['redirect_after_login']) && strpos(Yii::app()->session['redirect_after_login'], 'logout') === FALSE)
                {
                    Yii::app()->session['metaHeader'] = '<meta http-equiv="refresh"'
                    . ' content="1;URL=' . Yii::app()->session['redirect_after_login'] . '" />';
                    $sSummary = '<p><font size="1"><i>' . $clang->gT('Reloading screen. Please wait.') . '</i></font>';
                    unset(Yii::app()->session['redirect_after_login']);
                }
                break;
        }

        return $sSummary;
    }

    /**
    * Redirects a logged in user to the administration page
    */
    private function _redirectIfLoggedIn()
    {
        if (!Yii::app()->user->getIsGuest())
        {
            $this->getController()->redirect(array('/admin'));
        }
    }

    /**
    * Check if a user can log in
    * @return bool|array
    */
    private function _userCanLogin()
    {
        $failed_login_attempts = FailedLoginAttempt::model();
        $failed_login_attempts->cleanOutOldAttempts();

        if ($failed_login_attempts->isLockedOut())
        {
            return $this->_getAuthenticationFailedErrorMessage();
        }
        else
        {
            return true;
        }
    }

    /**
    * Redirect after login
    */
    private function _doRedirect()
    {
        $returnUrl = App()->user->getReturnUrl(array('/admin'));
        $this->getController()->redirect($returnUrl);
    }

    /**
    * Renders template(s) wrapped in header and footer
    *
    * @param string $sAction Current action, the folder to fetch views from
    * @param string|array $aViewUrls View url(s)
    * @param array $aData Data to be passed on. Optional.
    */
    protected function _renderWrappedTemplate($sAction = 'authentication', $aViewUrls = array(), $aData = array())
    {
        $aData['display']['menu_bars'] = false;
        parent::_renderWrappedTemplate($sAction, $aViewUrls, $aData);
    }

}
