<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');
// error_reporting(E_ALL); ini_set('display_errors', '1');
$documentroot=str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"]);
require_once($documentroot.'application/extensions/PHPMailer/class.phpmailer.php');
require_once($documentroot.'application/extensions/xls/Excel/reader.php');
require_once($documentroot.'application/extensions/class_sql_inject.php');
class Fundacion extends Survey_Common_Action
{
	public $anioc=array();
	public $id=8;
	public $sid="828616";
	function __construct($controller, $id)
    {
        parent::__construct($controller, $id);

        Yii::app()->loadHelper('database');
 		
    }
	public function encuestacorazones(){
		if(isset($_POST["option"])){
			$criteria = new CDbCriteria;
			$criteria->condition = 'sid= "828616" and estado="activo"'; 
			$criteria->order="fecharegistro DESC"; 
			$encuestas=Encuestalibreparams::model()->find($criteria);
 			if($encuestas->count()>=1){
 				echo json_encode(array("r"=>Yii::app()->baseUrl."/index.php/admin/authentication/sa/encuestalibre?token=".$encuestas->token));
 			}else{
 			 echo json_encode(array("r"=>"n"));
			}
			 
			exit; 
		}
		
		$this->_renderWrappedTemplate('fundacion', 'encuestacorazones', array("data"=>"0"));
	}
	 
 	 
    public function encuesta()
    {   
		if(isset($_SESSION['loginID'])){
 			$oRecord = User::model()->findByPk($_SESSION['loginID']); 
			$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
			
			$dat = new CDbCriteria;
			$dat->condition = "idusuario=".$oRecord->iduseval;
			$torgs=Usuarioxorg::model()->find($dat);
			
			$dat = new CDbCriteria;
			$dat->condition = "idorganizacion=".$oRecord->iduseval;
			
			$key=str_replace(Yii::app()->baseUrl."/index.php/","",$_SERVER["REQUEST_URI"]);
			$key=explode("?",$key);
			$key=$key[0];
			$dat = new CDbCriteria;
			$dat->condition = "accion='".$key."'";
			$modulo=Menuxmodulo::model()->find($dat);
			
			$demo=false;
			$modelestructura=array();
			$nombreorganizacion=NULL;
			if(isset($torgs->id)>0){
				$dat = new CDbCriteria;
				$dat->condition = "id=".$torgs->idorg;
				$modelorg=Organizacion::model()->find($dat);
				if(isset($modelorg->id)){
					$nombreorganizacion=$modelorg->nombre;
					$dat = new CDbCriteria;
					$dat->condition = "idorganizacion=".$modelorg->id." and (jmodulos  like '%,".$modulo->idmodulo.",%' or jmodulos  like '".$modulo->idmodulo.",%'  or jmodulos  like '%".$modulo->idmodulo."'  or jmodulos  = '".$modulo->idmodulo."' )";
					$servicio=Servicio::model()->find($dat);
					if(isset($servicio->id)){
						if((int)$servicio->demo==1){
							$query="SELECT * FROM {{cubo_828616}}";
							$eguresult = dbExecuteAssoc($query);
							$res = $eguresult->readAll();
							$total=count($res);
							if($total>=30){
								$demo=true;
							}
 						}
					}
					
				
					//$modelestructura=$this->organigramaempresa($modelorg->id);
					$modelestructura=$this->organigramaxusuario($modelorg->id);
					$modelestructurajson=$this->jsonorganigrama($modelorg->id);
					 
					if(count($modelestructura[0])>0){
						$cs = Yii::app()->getClientScript();
						$cs->registerScriptFile('https://www.gstatic.com/charts/loader.js');
					} 
				}
			}
			$dat = new CDbCriteria;
			$dat->condition = "id in (".$dUsuario->id_unidad.") ";
			$empresas = EvalUnidades::model()->findAll($dat);
			$arremp=array();
			$idemp=array();
			foreach($empresas as $dataemp){
				array_push($arremp,(object)array("id"=>$dataemp->id,"nombre"=>$dataemp->nombre));
				array_push($idemp,$dataemp->id);
			}
			$areasR=array();
			if(count($idemp)>0){
				$dat = new CDbCriteria;
				$dat->condition = "idunidad in (".join(",",$idemp).") ";
				$areas = EvalAreas::model()->findAll($dat);
				foreach($areas as $datar){
					array_push($areasR,(object)array("id"=>$datar->id,"nombre"=>$datar->nombre,"parentid"=>$datar->idunidad));
				}
				
			}
			
			$aData["token"]=$this->getTokenpentaho();		
			$aData["nombreorganizacion"]=$nombreorganizacion;		
			
			$aData["demo"]=$demo;
			$aData["organigrama"]=$modelestructura[0];
			$aData["organigramajson"]=$modelestructurajson[0];
			$aData["totalnodos"]=$modelestructura[1];//cantidad de nodos que pertenecen a usuario
			$aData["totalnodosjson"]=$modelestructurajson[1];//cantidad de nodos que pertenecen a usuario
			if(isset($_GET["idestructura"])){
				$aData["totalnodos"]=array((int)$_GET["idestructura"]);
			}
			$aData["idAnswer"]="";
			if(isset($_GET["idAnswer"])){
				$aData["idAnswer"]=(int)$_GET["idAnswer"];
			}
			$aData["areas"]=$areasR;
			$aData["idempresas"]=$idemp;
			$aData["objempresas"]=$arremp;
			$aData["usuario"]=$dUsuario;
			
			
			$iduhseq="NR";
			if(isset($_SESSION["encuesta_token"])){
				$dat = new CDbCriteria;
				$dat->condition = "token='".$_SESSION["encuesta_token"]."'";
				$mushseq = Ushseq::model()->find($dat);
				if(isset($mushseq->id)){
					$iduhseq=$mushseq->id;
				}
			}
  			$params=array(
							array("key"=>"EMPRESA","val"=>$torgs->idorg),
							array("key"=>"IDUS","val"=>$oRecord->iduseval),
							array("key"=>"SID","val"=>"828616"), 
							array("key"=>"IDHSEQ","val"=>$iduhseq), 
							array("key"=>"NOMBREENCUESTADOR","val"=>$dUsuario->nombres),
							array("key"=>"DOCUMENTOENCUESTADOR","val"=>$dUsuario->documento),
							array("key"=>"EMAILENCUESTADOR","val"=>$dUsuario->email));
			$aData["urljson"]=(json_encode($params));
			$random=RandomString();
			$dir=Yii::app()->baseUrl."/files/json/";
			$aData["random"]=base64_encode($dir.$random.".json");
			$fp = fopen($_SERVER["DOCUMENT_ROOT"].$dir.$random.".json", "w+");
			fputs($fp, $aData["urljson"]);
			fclose($fp);
			
			$directorio = opendir($_SERVER["DOCUMENT_ROOT"].$dir); //ruta actual
			while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
			{
				if (is_dir($archivo))//verificamos si es o no un directorio
				{
					//printVar( "[".$archivo . "]<br />"); //de ser un directorio lo envolvemos entre corchetes
				}
				else
				{
					$val=fileatime($_SERVER["DOCUMENT_ROOT"].$dir.$archivo); 
					$tiempo=date("Y-m-d H:i:s",$val);
					
					$diferencia=dirftimeminutes($tiempo,date("Y-m-d H:i:s"));
					if($diferencia>20){
						unlink($_SERVER["DOCUMENT_ROOT"].$dir.$archivo);
					}
				}
			}		
			$this->_renderWrappedTemplate('hseq', 'encuesta', $aData);
		}
		 
    }
	
    public function index()
    {   Yii::app()->cache->flush();
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
 		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
		$idusuario=NULL;
		$hseqdisp=array();
		$organizaciones=array();
		if(isset($dUsuario->id)){
			$idusuario=$dUsuario->id;
			$criteria = new CDbCriteria;
			$criteria->condition = ' idorg in ('.$dUsuario->id_unidad.') and idmodulo='.$this->id;
			$hseqdisp=Encuestalibreparams::model()->findAll($criteria);

			$criteria = new CDbCriteria;
			$criteria->condition = ' id in ('.$dUsuario->id_unidad.')';
			$organizaciones=Organizacion::model()->findAll($criteria);
			
 		}
		
		$data["hseqdisp"]=$hseqdisp;
		$data["organizaciones"]=$organizaciones;
 		
		$this->_renderWrappedTemplate('fundacion', 'index',$data);
    }
	
	public function action(){
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
 		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
		Yii::app()->cache->flush();
		if(isset($_POST["option"])){
			$option=$_POST["option"];
			switch($option){
				case "create":
					$model=new Encuestalibreparams();
					$documentos=explode(",",$_POST['Fundacion']["documentos"]);
					unset($_POST['Fundacion']["documentos"]);
					$model->token=md5(date("Y-m-d H:i:s"))."::828616"; 
					//$model->idorg=$dUsuario->id_unidad;
					$model->attributes=$_POST['Fundacion'];
					$model->fecharegistro=date("Y-m-d H:i:s");
					$model->idmodulo=$this->id;
					$model->sid=$this->sid;
 					$model->save();				
					 
 				break;
				case "update":
  					$model=Encuestalibreparams::model()->findByPk((int)$_POST['Fundacion']["id"]);
					if(isset($model->id)){
						if($model->id>0){
							$documentos=explode(",",$_POST['Fundacion']["documentos"]);
							unset($_POST['Fundacion']["documentos"]);
							$model->attributes=$_POST['Fundacion'];
							$model->fecharegistro=date("Y-m-d H:i:s");
							$model->save();				
 						}
					}
 				break;
				case "eliminar":
  					$model=Encuestalibreparams::model()->findByPk((int)$_POST['Fundacion']["id"]);
					if(isset($model->id)){
						if($model->id>0){
							 $model->delete();			
 						}
					}
 				break; 
			}
		}
		
		$this->getController()->redirect(array('admin/fundacion/','r'=>$error)); 
	}
	
	 
	
 	public function organigramaxusuario($id){
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
 		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
		$idusuario=NULL;
		if(isset($dUsuario->id)){
			$idusuario=$dUsuario->id;
		}
  		$data["organizaiones"]=Organizacion::model()->selecOrganizaciones();
		$data["nivel"]=Nivel::model()->findAll();
 		$criteria = new CDbCriteria;
		$criteria->condition = ' idorganizacion='.$id;
		$modeler=Estructura::model()->findAll($criteria);
		$est=array();
		$usxorg=Organizacion::model()->getusuariosorganizacion($id);
		$control=array();
		foreach($usxorg as $data){
			$control[$data->id]=$data->alias;
		}
		$contador=0;
		$contarus=array();
		foreach($modeler as $datos){ 
			$htmlus="";
			
			$tnivel=Nivel::model()->findByPk($datos->idnivel);
			$allniveles=Nivel::model()->findAll();
			
			$criteria = new CDbCriteria;
			$criteria->condition = ' idestrcutura='.$datos->id;
			$tusuarios = Ownerxestructura::model()->findAll($criteria);
			$usuarios=array();
			
			$idnivel="";
			if((int)$datos->idnivel>0){
				$idnivel=$datos->idnivel."-";
			}
 
			foreach($tusuarios as $dus){
				$rtu=EvalUsuarios::model()->findByPk((int)$dus->idus);
				$htmlus.="<br>".$rtu->alias;
				array_push($usuarios,$rtu->id);
			}
 			
			$boton=" style=\"font-style:italic;padding:5px;background-color:#DDD;border:2px solid #999;\" ";
			if(in_array($idusuario,$usuarios) or $oRecord->uid==1){
				$boton=" style=\"font-style:italic;padding:5px;cursor:pointer;border:2px solid #e3ca4b;background-color:#fff7ae;\" rel=\"estruc_".$datos->id."\" ";
				array_push($contarus,$datos->id);
			}
 			$nomnivel="";
			if(isset($tnivel->id)){
				$nomnivel="<div rel=\"titulo_".$tnivel->id."-".$contador."\"><b>".$tnivel->nombre."</b></div>";
 			}
 			
 			$nivelhtml=$nomnivel;
 			$html="<div ".$boton." ><center><b>".$datos->nombre."</b></center><div style=\"clear:both\"></div><div > ".$nivelhtml."<b>Descripcción:</b><br>".$datos->descripcion."<br><b>Usuarios:".$htmlus."</div></div>";
 			
			$temporalobj=(object)array("v"=>$idnivel.$datos->id,"f"=>$html);
			
			
			
			$padrenivel=Estructura::model()->findByPk($datos->idpadre);
			
			$padrenivelt="";
			if(isset($padrenivel->idnivel)){
				$padrenivelt=$padrenivel->idnivel."-";
			}
			array_push($est,array($temporalobj,$padrenivelt.$datos->idpadre,""));
			$contador++;
		} 
 		//exit;
		return array($est,$contarus);
		//$this->_renderWrappedTemplate('estructura', 'organigramaempresa', $data);
 	}
	
 	public function jsonorganigrama($id){
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
 		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
		$idusuario=NULL;
		if(isset($dUsuario->id)){
			$idusuario=$dUsuario->id;
		}
  		$data["organizaiones"]=Organizacion::model()->selecOrganizaciones();
		$data["nivel"]=Nivel::model()->findAll();
 		$criteria = new CDbCriteria;
		$criteria->condition = ' idorganizacion='.$id;
		$modeler=Estructura::model()->findAll($criteria);
		$est=array();
		$usxorg=Organizacion::model()->getusuariosorganizacion($id);
		$control=array();
		foreach($usxorg as $data){
			$control[$data->id]=$data->alias;
		}
		$contador=0;
		$contarus=array();
		foreach($modeler as $datos){ 
			$htmlus="";
			
			$tnivel=Nivel::model()->findByPk($datos->idnivel);
			$allniveles=Nivel::model()->findAll();
			
			$criteria = new CDbCriteria;
			$criteria->condition = ' idestrcutura='.$datos->id;
			$tusuarios = Ownerxestructura::model()->findAll($criteria);
			$usuarios=array();
			
			$idnivel="";
			if((int)$datos->idnivel>0){
				$idnivel=$datos->idnivel."-";
			}
 
			foreach($tusuarios as $dus){
				$rtu=EvalUsuarios::model()->findByPk((int)$dus->idus);
				$htmlus.="<br>".$rtu->alias;
				array_push($usuarios,$rtu->id);
			}
 			
			$boton=" style=\"font-style:italic;padding:5px;background-color:#DDD;border:2px solid #999;\" ";
			if(in_array($idusuario,$usuarios) or $oRecord->uid==1){
				$boton=" style=\"font-style:italic;padding:5px;cursor:pointer;border:2px solid #e3ca4b;background-color:#fff7ae;\" rel=\"estruc_".$datos->id."\" ";
				array_push($contarus,$datos->id);
			}
 			$nomnivel="";
			if(isset($tnivel->id)){
				$nomnivel=$tnivel->nombre;
 			}
 			
 			 
  			
			$temporalobj=(object)array("key"=>$datos->id,"nivel"=>$nomnivel,"nodo"=>$datos->nombre);
			
			
			
			$padrenivel=Estructura::model()->findByPk($datos->idpadre);
			
			$padrenivelt="";
			if(isset($padrenivel->idnivel)){
				$padrenivelt=$padrenivel->idnivel."-";
			}
			array_push($est,array($temporalobj,$datos->idpadre,""));
			$contador++;
		} 
 		//exit;
		return array(json_encode($est),$contarus);
		//$this->_renderWrappedTemplate('estructura', 'organigramaempresa', $data);
 	}	
 	
	public function organigramaempresa($id){
 		$data["organizaiones"]=Organizacion::model()->selecOrganizaciones();
		$data["nivel"]=Nivel::model()->findAll();
		/*$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile('https://www.gstatic.com/charts/loader.js');
		*/
		$criteria = new CDbCriteria;
		$criteria->condition = ' idorganizacion='.$id;
		$modeler=Estructura::model()->findAll($criteria);
		$est=array();
		$usxorg=Organizacion::model()->getusuariosorganizacion($id);
		$control=array();
		foreach($usxorg as $data){
			$control[$data->id]=$data->alias;
		}
		$contador=0;
		foreach($modeler as $datos){ 
			$htmlus="";
			
			$tnivel=Nivel::model()->findByPk($datos->idnivel);
			$allniveles=Nivel::model()->findAll();
			
			$criteria = new CDbCriteria;
			$criteria->condition = ' idestrcutura='.$datos->id;
			$tusuarios = Ownerxestructura::model()->findAll($criteria);
			$usuarios=array();
			
			$idnivel="";
			if((int)$datos->idnivel>0){
				$idnivel=$datos->idnivel."-";
			}
 
			foreach($tusuarios as $dus){
				$rtu=EvalUsuarios::model()->findByPk((int)$dus->idus);
				$htmlus.="<br>".$rtu->alias;
				array_push($usuarios,$rtu->id);
			}
 			
			$nomnivel="";
			
			if(isset($tnivel->id)){
				$nomnivel="<div rel=\"titulo_".$tnivel->id."-".$contador."\"><b>".$tnivel->nombre."</b></div>";
 			}
 			
 			$nivelhtml=$nomnivel;
 			$html="<div style=\"font-style:italic;padding:5px\"><center><b>".$datos->nombre."</b></center><div style=\"clear:both\"></div><div style=\"border:2px solid #e3ca4b;background-color:#fff7ae;\" > ".$nivelhtml."<b>Descripcción:</b><br>".$datos->descripcion."<br><b>Usuarios:".$htmlus."</div></div>";
 			
			$temporalobj=(object)array("v"=>$idnivel.$datos->id,"f"=>$html);
			
			
			
			$padrenivel=Estructura::model()->findByPk($datos->idpadre);
			
			$padrenivelt="";
			if(isset($padrenivel->idnivel)){
				$padrenivelt=$padrenivel->idnivel."-";
			}
			array_push($est,array($temporalobj,$padrenivelt.$datos->idpadre,""));
			$contador++;
		} 
 		//exit;
		return $est;
		//$this->_renderWrappedTemplate('estructura', 'organigramaempresa', $data);
  	}
	private function getDescendientes($padres){
		$arrat=$padres;
		$total=count($arrat);
		if(count($padres)>0){
			foreach($padres as $data){
				$criteria = new CDbCriteria;
				$criteria->condition = ' idpadre='.$data;
				$estruc = Estructura::model()->findAll($criteria);
				if(isset($estruc[0]->id)){
					foreach($estruc as $dates){
						if(!in_array($dates->id,$arrat)){
							array_push($arrat,$dates->id);
						}
 					}
					if(count($arrat)>$total){
						$arrat=$this->getDescendientes($arrat);
					}
				}
			} 
		}
  		return $arrat;
	}
	private function getOwnerestructura($id){
		$idestructura="";
		$dat = new CDbCriteria;
		$dat->condition = "idus=".$id;
		$estructura=Ownerxestructura::model()->findAll($dat);
		if(isset($estructura[0]->id)){
			$arrat=array();
			foreach($estructura as $d){
				array_push($arrat,$d->idestrcutura);
			}
			if(count($arrat)>0){
				$arrat=$this->getDescendientes($arrat);
				$idestructura=join(",",$arrat);
			}
		}
		return $idestructura;
	}
	public function reportes(){
 		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
 		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
 		$idusuario=NULL;
		$organizacion=NULL;
		$idpadre=NULL;
		$anioc=NULL;
		$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile('https://www.gstatic.com/charts/loader.js');
		if(isset($dUsuario->id)){
			$dat = new CDbCriteria;
			$dat->condition = "idusuario=".$oRecord->iduseval;
			$torgs=Usuarioxorg::model()->find($dat);
			$data["organizacion"]=$torgs;		
 			if(!isset($_POST["chart"])){
				$data["idestructura"]=$this->getOwnerestructura($oRecord->iduseval);
				$first=explode(",",$data["idestructura"]);
 				$idpadre=$first[0];
				$init=true;
			}else{
				
				$init=false;
				if(isset($_POST["chart"]["idpadre"])){
					$idpadre=$_POST["chart"]["idpadre"];
				}else{
					$dat = new CDbCriteria;
					$dat->condition = "idusuario=".$oRecord->iduseval;
					$torgs=Usuarioxorg::model()->find($dat);
					$objf=(Object)array();
					foreach($torgs as $key=>$value){
						$objf->{$key}=$value;
					}
					$data["organizacion"]=$objf;
					$data["idestructura"]=$this->getOwnerestructura($oRecord->iduseval);
					$first=explode(",",$data["idestructura"]);
					$idpadre=$first[0];
					$init=true;
 				}
				$arrat=$this->getDescendientes(array($idpadre));
				$data["idestructura"]=join(",",$arrat);
				$data["paramanioc"]=$_POST["chart"]["anioc"];
				
			}	
 			$idorg=$data["organizacion"]->idorg;
 			if(isset($_POST["chart"])){
				$anioc=$_POST["chart"]["anioc"];
				$idorg=$_POST["chart"]["idorg"];
			}
			// printVar($idorg."|----|".$idpadre."|----|".$anioc);exit;	
			$data["chart"]=$this->surveyxestructura($idorg,$idpadre,$anioc,$init);		
			//printVar($data);exit;	
			$idusuario=$dUsuario->id;
			$organizacion=$dUsuario->id_unidad;
		
			$data["idestructura"]=$this->getOwnerestructura($oRecord->iduseval);
			$first=explode(",",$data["idestructura"]);
			$idpadre=$first[0];
			
			$arrat=$this->getDescendientes(array($idpadre));
			$data["idestructura"]=join(",",$arrat);
			$data["usuario"]=$dUsuario ;
			$data["idorg"]=$organizacion;
			$data["token"]=$this->getTokenpentaho();
			
			$idusuario=$dUsuario->id;
			$criteria = new CDbCriteria;
			$criteria->condition = ' idorg in ('.$dUsuario->id_unidad.') and idmodulo='.$this->id;
			$hseqdisp=Encuestalibreparams::model()->findAll($criteria);
			$data["encuestas"]=$hseqdisp;
			
			if(!isset($_POST["chart"])){
				$this->_renderWrappedTemplate('fundacion', 'reportes', $data);
			}else{
				echo json_encode($data);exit;
 			}
		}
	}
	
	public function analisisestilo(){
 		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
 		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
 		$idusuario=NULL;
		$organizacion=NULL;
		$idpadre=NULL;
		$anioc=NULL;
 		if(isset($dUsuario->id)){
			$dat = new CDbCriteria;
			$dat->condition = "idusuario=".$oRecord->iduseval;
			$torgs=Usuarioxorg::model()->find($dat);
			$data["organizacion"]=$torgs;		
 			if(!isset($_POST["chart"])){
				$data["idestructura"]=$this->getOwnerestructura($oRecord->iduseval);
				$first=explode(",",$data["idestructura"]);
 				$idpadre=$first[0];
				$init=true;
			}else{
				
				$init=false;
				if(isset($_POST["chart"]["idpadre"])){
					$idpadre=$_POST["chart"]["idpadre"];
				}else{
					$dat = new CDbCriteria;
					$dat->condition = "idusuario=".$oRecord->iduseval;
					$torgs=Usuarioxorg::model()->find($dat);
					$objf=(Object)array();
					foreach($torgs as $key=>$value){
						$objf->{$key}=$value;
					}
					$data["organizacion"]=$objf;
					$data["idestructura"]=$this->getOwnerestructura($oRecord->iduseval);
					$first=explode(",",$data["idestructura"]);
					$idpadre=$first[0];
					$init=true;
 				}
				$arrat=$this->getDescendientes(array($idpadre));
				$data["idestructura"]=join(",",$arrat);
				$data["paramanioc"]=$_POST["chart"]["anioc"];
				
			}	
 			$idorg=$data["organizacion"]->idorg;
 			if(isset($_POST["chart"])){
				$anioc=$_POST["chart"]["anioc"];
				$idorg=$_POST["chart"]["idorg"];
			}
			// printVar($idorg."|----|".$idpadre."|----|".$anioc);exit;	
			$data["chart"]=$this->surveyxestructura($idorg,$idpadre,$anioc,$init);		
			//printVar($data);exit;	
			$idusuario=$dUsuario->id;
			$organizacion=$dUsuario->id_unidad;
		
			$data["idestructura"]=$this->getOwnerestructura($oRecord->iduseval);
			$first=explode(",",$data["idestructura"]);
			$idpadre=$first[0];
			
			$arrat=$this->getDescendientes(array($idpadre));
			$data["idestructura"]=join(",",$arrat);
			$data["usuario"]=$dUsuario ;
			$data["idorg"]=$organizacion;
			$data["token"]=$this->getTokenpentaho();
			
			$idusuario=$dUsuario->id;
			$criteria = new CDbCriteria;
			$criteria->condition = ' idorg in ('.$dUsuario->id_unidad.') and idmodulo='.$this->id;
			$hseqdisp=Encuestalibreparams::model()->findAll($criteria);
			$data["encuestas"]=$hseqdisp;
			
			if(!isset($_POST["chart"])){
				$this->_renderWrappedTemplate('fundacion', 'analisisestilo', $data);
			}else{
				echo json_encode($data);exit;
 			}
		}
	}
	
	
	private function surveyxestructura($idorg=NULL,$idpadre=NULL,$anio=NULL,$init=false){
		

		if($idpadre>0){
			$query=" idpadre=".$idpadre;
		}
		if($idorg>0   and $idpadre==NULL){
			$query=" idorganizacion=".$idorg." and (idpadre='' or idpadre is NULL)";
		}
		if($init==true){
			$query=" id=".$idpadre;
 		}
  		$dat = new CDbCriteria;
		$dat->condition = $query;
		$hijos=Estructura::model()->findAll($dat);
 		$r=array(array("año:Dependencia:id:Nivel","cantidad"));
		$anioc=array();
 		foreach($hijos as $hijo){
 			if($idorg>0   and $idpadre==NULL){
				$cantidad=$this->surveyxestructura(NULL,$hijo->id,$anio);
 				$r=$cantidad[0];
				$anioc=$cantidad[1];
 			}else{
				$idestructura=$this->getDescendientes(array($hijo->id));
				$cantidad=$this->countCubo($idestructura,$anio); 
 				$anioc=$cantidad[1];
				foreach($cantidad[0] as $dato){
					array_push($r,array($dato["anioc"].":".$dato["estructura"].":".$dato["idestructura"].":".$dato["nivel"],$dato["total"]));
				}
				 
				//array_push($r,array($anio,$cantidad->total));
			}
			//$this->getDescendientes($arrat);
		}
 		return array($r,$anioc);
	}
	private function countCubo($idestructura,$anio=NULL){
		$r=array();
  		if(is_array($idestructura)){
			$subq="";
			if($anio>0){
				$subq=" and anioc='".$anio."'";
			}
			 
			$queryString = "
			SELECT 
			COUNT(*) as total,anioc,idestructura,estructura,nivelorg
			FROM view_hseq
			WHERE idestructura in (".join(",",$idestructura).")".$subq." GROUP BY anioc"; // printVar($queryString);exit;
 			$eguresult = dbExecuteAssoc($queryString);
			$tdatacubo = $eguresult->readAll();	
 			foreach($tdatacubo as $data){
				array_push($r,$data);
				if(!in_array($data["anioc"],$this->anioc)){
					array_push($this->anioc,$data["anioc"]);
				} 
			}
		}
		//printVar($r); 
		return array($r,$this->anioc);
 	}
	private function getTokenpentaho(){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://www.talentracking.co/user-token-session");
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "apiId=3&apikey=1edf9f14dd7f29b7fed31b55594df322&email=oscar&operation=login");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec ($ch);
		$res=json_decode($server_output);
		curl_close ($ch);
		// printVar($res->token);
		return $res->token;
		
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