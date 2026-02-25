<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(E_ALL); ini_set('display_errors', '1');
$documentroot=str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"]);
require_once($documentroot.'application/extensions/PHPMailer/class.phpmailer.php');
require_once($documentroot.'application/extensions/xls/Excel/reader.php');
require_once($documentroot.'application/extensions/class_sql_inject.php');
class Admusuario extends Survey_Common_Action
{
	
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
		$this->validarRole();

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
    public function index()
    {  
		
		$idioma=json_decode(base64_decode($_SESSION["codelang"]));
		Yii::app()->cache->flush();
		
		$oRecord = User::model()->findByPk(Yii::app()->user->id);
//printVar($oRecord);exit;		
 		$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval); 
		$validaeditar=AnaUsuario::model()->vaidausr(false);
		
		//printVar(AnaRol::model()->validarrol(5));exit;
 		if(!isset($_POST["eliminar"]) and AnaRol::model()->validarrol(5)==true){ 
		$perfiles=array( 4,5,6);
			$perfiles=array();
			$paises=array();
			$regiones=array();
			$empresas=array();
			$ciudades=array();
			if(AnaRol::model()->validarrol(5)==true){
				if($oRecord->uid==463 or $dUsuario->perfil==1){
 					$perfiles=array(2,3,4,5,6);
					$paises=AnaPais::model()->findAll();
					$ciudades=AnaCiudad::model()->findAll();
					$regiones=AnaRegion::model()->findAll();
					$empresas=AnaOrganizacion::model()->findAll();
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
			}  //printVar(AnaRol::model()->validarrol(5));exit;
			//printVar($dUsuario->perfil);exit;
			//printVar($perfiles);exit;
 			$perf = new CDbCriteria;
			$perf->condition = 'id in ('.join(',',$perfiles).') and activo="1"';
			$perf->order="idorden ASC";
			$perfr = AnaRol::model()->findAll($perf);
			$dat = new CDbCriteria;
			$dat->condition = "idUsuario = '".$dUsuario->id."'";
    			$creditos=AnaMonedaxusuario::model()->count($dat);
    			$aData["creditosdisponibles"]=$creditos;
			$aData["idioma"]=$idioma; 
 			$aData["paises"]=$paises; 
			$aData["regiones"]=$regiones; 
			$aData["ciudades"]=$ciudades; 
			$aData["usuariomodel"]=$dUsuario;
			$aData["listaperfiles"]=$perfr;
			$aData["listaempresas"]=$empresas;
 			 
			 //printVar($datos);exit;
			$empl=$this->selectEmpleadosActivos(1);
			$aData["imageurl"]=Yii::app()->baseUrl."/img/";
			$aData["empl"] =$empl[0]; 
			$aData["paginacion"] =$empl[1];
			$aData["buscar"] =$empl[1][2];
			$aData["perfilusuarior"] =$empl[1][3];
			$aData["unidadesr"] =$empl[1][4];				
			$aData["validaini"] ="NO";
			if($oRecord->uid==463){
			$aData["validaini"] ="OK"; 	
			}
			$aData["estado"] =$empl[1][5];				
			//printVar($aData);  
			$this->_renderWrappedTemplate('admusuario', 'usuarios', $aData);
		}else{
			if(Yii::app()->user->id>0){ 
			 	switch($_POST["eliminar"]){
					case "eliminar":
						if(AnaRol::model()->validarrol(2)==true){
							$role=(int)$dUsuario->perfil;
							$subq="";
							switch($role){
								case 1:$subq="  and (id<>396 and id<>".$dUsuario->id.")";
								break;
								case 2:$subq=" and id<>396 and perfil in (3,4,5,6)  and id<>".$dUsuario->id." and id_pais=".$dUsuario->id_pais;
								break;
								case 3:$subq=" and id<>396 and perfil in (5,4,6) and  id<>".$dUsuario->id." and id_region=".$dUsuario->id_region;
								break;
								case 5:$subq=" and id<>396  and perfil in (4,6) and    id<>".$dUsuario->id." and id_ciudad=".$dUsuario->id_ciudad;
								break;
								case 4:$subq=" and id<>396  and perfil in (6) and    id<>".$dUsuario->id." and id_unidad='".$dUsuario->id_unidad."'";
								break;
  							}
							 
							$datd = new CDbCriteria;
							$datd->condition = "id=".(int)$_POST["id"].$subq;
							$usuario = AnaUsuario::model()->find($datd);	
							//printVar($usuario,"id=".(int)$_POST["id"].$subq);exit; 
							$datd = new CDbCriteria;
							$datd->condition = "iduseval=".$usuario->id;
							$userr = User::model()->find($datd);
							if(isset($userr->uid)){
								$usuario->delete();
								$queryString = "DELETE FROM {{permissions}} where uid=".$userr->uid;
								$eguresult = dbExecuteAssoc($queryString);
								$userr->delete();
								echo "OK";exit;
							}else{
								if(isset($usuario->id)){
									$usuario->delete();
									echo "OK";exit;
								}else{
									echo "NO";exit;
								}
							}					
 						}else{
							echo "DENEGADO";exit;
						}
  					break;
 				} 
			}
 		}
    }
 	
	public function editar(){
		$id=(int)$_POST["id"];
		 Yii::app()->cache->flush();
		$oRecord = User::model()->findByPk(Yii::app()->user->id); 
		//printVar($oRecord);
		$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);	
		$validaeditar=AnaUsuario::model()->vaidausr(false);
		$subq="";
		if($oRecord->uid>1 and $dUsuario->id>0){
			$subq=" and uid_creador=".$oRecord->uid;
		}
		$dat = new CDbCriteria;
 		$dat->condition = "id=".$id." ".$subq;
		$usuario = AnaUsuario::model()->findAll($dat);		
 		$this->_renderWrappedTemplate('admusuario', 'editar', $aData);
	}

	
	
	

	public function perfil(){ 
 		Yii::app()->cache->flush();
		$oRecord = User::model()->findByPk(Yii::app()->user->id); 
		//printVar($oRecord);
		$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);	
		$validaeditar=AnaUsuario::model()->vaidausr(false);
		$subq="";
		$usuario=NULL;
		
		if($oRecord->uid==463 or  isset($dUsuario->id)){
 			if(isset($dUsuario->id) ){
				if($oRecord->uid>1 and $dUsuario->id>0){
					$subq=" and id_unidad in (".$dUsuario->id_unidad.") ";
				} 
 				//$subq="";
				$dat = new CDbCriteria;
				$dat->condition = "id=".$dUsuario->id." ".$subq;
				$usuario = AnaUsuario::model()->find($dat);
				$aData["usuario"]=$usuario;
			}
			//printVar($subq,$_POST["idusuario"]);
 			 
			if(!isset($_POST["save"])){
				App()->getClientScript()->registerScriptFile(Yii::app()->baseUrl."/scripts/yav1_4_1/js/yav.js");
				App()->getClientScript()->registerScriptFile(Yii::app()->baseUrl."/scripts/yav1_4_1/js/yav-config-es.js");
				App()->getClientScript()->registerScriptFile("//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js");
 				
				$this->_renderWrappedTemplate('admusuario', 'perfil', $aData);
			}else{
				$uid=NULL;
				if($usuario==NULL){
					$set=new AnaUsuario();
					$set->clave=$this->escape($_POST["password"]);
				}else if((int)$usuario->id>0){
					$set=$usuario;
					if(!empty($_POST["password"])){
						$set->clave=$this->escape($_POST["password"]);
					}
					$queryString = "
					SELECT 
					uid
					FROM {{users}}
					WHERE iduseval = ".$set->id;//printVar($queryString);exit;
					$eguresult = dbExecuteAssoc($queryString);
					$res = $eguresult->readAll();		
					foreach($res as $datos) {
						$row=(Object)$datos;
						$uid = $row->uid;
					}
				}
				if(is_object($set)){
					 
 					
 					$set->email=$this->escape($_POST["email"]);
   					$set->fecharegistro=date("Y-m-d H:i:s");
					$set->activo=1;
 					
					if($set->save()){
						//Yii::app()->cache->flush();
						 
 						if($uid==NULL){
							$iNewUID = User::model()->insertUserNative($set->alias,$set->clave,$set->documento,Yii::app()->user->id, $set->email,$set->id);
							$perfil="default";
							$entity="template";
							$perfil="superadmin";
							$entity="global";
							if($set->perfil==2 or $set->perfil==3 or $set->perfil==4 or $set->perfil==6 or $set->perfil==7){
								$perfil="default";
								$entity="template";
							}
							if((int)$iNewUID>0){
								Permission::model()->insertSomeRecords(array('uid' => (int)$iNewUID, 'permission' => $perfil, 'entity'=>$entity, 'read_p' => 1, 'entity_id'=>0));
								echo json_encode(array("El usuario ha sido creado",$set->id));
							}					
						
						}else if((int)$uid>0){
							$oRecord = User::model()->findByPk($uid);
							$oRecord->email=$set->email;
							$oRecord->full_name= $set->documento;
							$oRecord->password= hash('sha256', $set->clave);
							$uresult = $oRecord->save();
							$perfil="default";
							$entity="template";
							if(AnaUsuario::model()->vaidausr(false) and $data["par_perfil"]==1){
								$perfil="superadmin";
								$entity="global";
							}	
							$valus = new CDbCriteria;
							$valus->condition = 'uid='.$uid;
							$rus = Permission::model()->find($valus);									
							$rus->permission= $perfil;
							$rus->entity= $entity;
							$rus->save();
							echo json_encode(array("El usuario ha sido actualizado",$set->id));
						}
					}else{
					echo json_encode(array("Algo salio mal"));
					}
				}
				 
			}
		}
	}
	public function getregiones(){
		$oRecord = User::model()->findByPk(Yii::app()->user->id);
		if(isset($oRecord->uid)){
			$idpais=(int)$_POST["idpais"];
 			$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);	
			$subq["id_pais"]=$idpais;
			if((int)$dUsuario->id_pais>0){
				$subq["id_pais"]=$dUsuario ->id_pais;
			}
			if((int)$dUsuario->id_region>0){
				$subq["id"]=$dUsuario ->id_region;
			}
			$t=array();
			foreach($subq as $k=>$d){
				array_push($t,$k."=".$d);
			}
			//$dat = new CDbCriteria;
			//$dat->condition = join(" and ",$t);
			$tregiones = AnaRegion::model()->findAll();	
			$regiones=array();
			foreach($tregiones as $tempo){
				$data=array();
				foreach($tempo as $k=>$d){
					$data[$k]=$d;
				}
				array_push($regiones,$data);
			}
			echo json_encode(array("ok",$regiones));exit;
 		}else{echo json_encode(array("sesion"));exit;}
	}	
 	
	public function getciudades(){
		$oRecord = User::model()->findByPk(Yii::app()->user->id);
		if(isset($oRecord->uid)){
			$idpais=(int)$_POST["idpais"];
			$idregion=(int)$_POST["idregion"];
			$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);	
			$subq["id_pais"]=$idpais;
			$subq["id_region"]=$idregion;
			if((int)$dUsuario->id_pais>0){
				$subq["id_pais"]=$dUsuario ->id_pais;
			}
			if((int)$dUsuario->id_region>0){
				$subq["id_region"]=$dUsuario ->id_region;
			}
			if((int)$dUsuario->id_ciudad>0){
				$subq["id"]=$dUsuario ->id_ciudad;
			}
			$t=array();
			foreach($subq as $k=>$d){
				array_push($t,$k."=".$d);
			}
			$dat = new CDbCriteria;
			$dat->condition = join(" and ",$t);
			$tciudades = AnaCiudad::model()->findAll($dat);	
			$ciudades=array();
			foreach($tciudades as $tempo){
				$data=array();
				foreach($tempo as $k=>$d){
					$data[$k]=$d;
				}
 				array_push($ciudades,$data);
			}
			echo json_encode(array("ok",$ciudades));exit;
  		}else{echo json_encode(array("sesion"));exit;}
	}

	public function getpaises(){
		$oRecord = User::model()->findByPk(Yii::app()->user->id);
		if(isset($oRecord->uid)){
			$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
			$dat = new CDbCriteria;
			$dat->condition = join(" and ",$t);
			$tpaises = AnaPais::model()->findAll($dat);	
			$paises=array();
			foreach($tpaises as $tempo){
				$data=array();
				foreach($tempo as $k=>$d){
					$data[$k]=$d;
				}
 				array_push($paises,$data);
			}
			echo json_encode($paises);exit;
  		}else{echo json_encode(array("sesion"));exit;}
	}	
 	public function validarusuario(){
		$oRecord = User::model()->findByPk(Yii::app()->user->id);
		if(isset($oRecord->uid)){
			$alias=$_POST["alias"];
			$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);	
			
			
			$dat = new CDbCriteria(array(
										"condition"=>"alias = :alias  ",
										"params"=>array(":alias"=>$_POST["alias"])
										)
									);
			$usuario=AnaUsuario::model()->find($dat);
			//printVar($dat);
			if(isset($usuario->id)){
				echo json_encode(array("existe"));exit;
			}else{
				echo json_encode(array("no"));exit;
			}	
			
		}else{echo json_encode(array("sesion"));exit;}
		
		
	}
	public function getorganizaciones(){
		$oRecord = User::model()->findByPk(Yii::app()->user->id);
		if(isset($oRecord->uid)){
			$idpais=(int)$_POST["idpais"];
			$idregion=(int)$_POST["idregion"];
			$idciudad=(int)$_POST["idciudad"];
			$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);	
			$subq["id_pais"]=$idpais;
			$subq["id_region"]=$idregion;
			//$subq["id_ciudad"]=$idciudad;
			if((int)$dUsuario->id_pais>0){
				$subq["id_pais"]=$dUsuario ->id_pais;
			}
			if((int)$dUsuario->id_region>0){
				$subq["id_region"]=$dUsuario ->id_region;
			}
			if((int)$dUsuario->id_ciudad>0){
				//$subq["id_ciudad"]=$dUsuario ->id_ciudad;
			}
			if((int)$dUsuario->id_unidad>0){
				$subq["id"]=$dUsuario ->id_unidad;
			}
			$t=array();
			foreach($subq as $k=>$d){
				array_push($t,$k."=".$d);
			}
			$dat = new CDbCriteria;
			$dat->condition = join(" and ",$t);
			$torganizaciones = AnaOrganizacion::model()->findAll($dat);	
			$organizaciones=array();
			foreach($torganizaciones as $tempo){
				$data=array();
				foreach($tempo as $k=>$d){
					$data[$k]=$d;
				}
				array_push($organizaciones,$data);
			}
			echo json_encode(array("ok",$organizaciones));exit;
  		}else{echo json_encode(array("sesion"));exit;}
	}	
 	
	
	public function crear(){
		$idioma=json_decode(base64_decode($_SESSION["codelang"]));
 		Yii::app()->cache->flush();
		$oRecord = User::model()->findByPk(Yii::app()->user->id); 
		//printVar($oRecord);
		$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);	
		$validaeditar=AnaUsuario::model()->vaidausr(false);
		$subq="";
		$usuario=NULL;
		$crearusuario=array(1,2,3,5,6);
		if(AnaRol::model()->validarrol(1)==true){
			if(isset($_POST["idusuario"]) and (int)$_POST["idusuario"]>0){
				 
 				//$subq="";
				$dat = new CDbCriteria;
				$dat->condition = "id=".(int)$_POST["idusuario"]." ".$subq;
				$usuario = AnaUsuario::model()->find($dat);
				$aData["usuario"]=$usuario;
				$aData["idusuario"]=$usuario->id; 
			}
			//printVar($subq,$_POST["idusuario"]);
 			$perfiles = NULL;
			$empresas=NULL;
			// SI ES ADMINISTRADOR, TRAE ORGANIZACIONES QUE PERTENECEN AL USUARIO
			$subquery="";
   			if($dUsuario->perfil==1){
				 
				$subquery=" and id in (2,3,4,5,6)";
  				
			}
 
   			if($dUsuario->perfil==2){
				 
				//$subquery=" and id in ( 3,4,5,6)";
				$subquery=" and id in (2,3,4,5,6)";

  				
			}
 
   			if($dUsuario->perfil==3){
				 
				$subquery=" and id in (4,5,6)";
  				
			}
 
   			if($dUsuario->perfil==5){
				 
				$subquery=" and id in (4,6)";
  				
			}
   			if($dUsuario->perfil==4){
				 
				$subquery=" and id in (6)";
  				
			}
			
			
			if($oRecord->uid==463 or $dUsuario->perfil==1){
				$perfiles=array(2,3,4,5,6);
				$paises=AnaPais::model()->findAll();
				$ciudades=AnaCiudad::model()->findAll();
				$regiones=AnaRegion::model()->findAll();
				$empresas=AnaOrganizacion::model()->findAll();
			}
			if( $dUsuario->perfil==2){
				//$perfiles=array(3,4,5,6);
				$perfiles=array(2,3,4,5,6);

				$paises=AnaPais::model()->findAll();
				$ciudades=AnaCiudad::model()->findAll();
				$regiones=AnaRegion::model()->findAll();
				$empresas=AnaOrganizacion::model()->findAll();
  				if($dUsuario->id_pais){
					$dat = new CDbCriteria;
					$dat->condition = 'id ="'.$dUsuario->id_pais.'"';
					$paises=AnaPais::model()->findAll($dat);
					
					$dat = new CDbCriteria;
					$dat->condition = 'id_pais ="'.$dUsuario->id_pais.'"';
					$empresas=AnaOrganizacion::model()->findAll($dat);
					
				}
				if($dUsuario->id_region){
					$dat = new CDbCriteria;
					$dat->condition = 'id_pais ="'.$dUsuario->id_pais.'"';
					$regiones=AnaRegion::model()->findAll($dat);
 					$dat = new CDbCriteria;
					$dat->condition = 'id_region ="'.$dUsuario->id_region.'"';
					$empresas=AnaOrganizacion::model()->findAll($dat);
				}
				if($dUsuario->id_ciudad){
					$dat = new CDbCriteria;
					$dat->condition = 'id ="'.$dUsuario->id_ciudad.'"';
					$ciudades=AnaCiudad::model()->findAll($dat);
 					$dat = new CDbCriteria;
					$dat->condition = 'id_ciudad ="'.$dUsuario->id_ciudad.'"';
					$empresas=AnaOrganizacion::model()->findAll($dat);

				}
				 
				 
				 
			}
			if( $dUsuario->perfil==3){
				$perfiles=array( 4,5,6);
  				if($dUsuario->id_pais){
					$dat = new CDbCriteria;
					$dat->condition = 'id ="'.$dUsuario->id_pais.'"';
					$paises=AnaPais::model()->findAll($dat);
					
				}
				if($dUsuario->id_region){
					$dat = new CDbCriteria;
					$dat->condition = 'id_pais ="'.$dUsuario->id_pais.'" and id="'.$dUsuario->id_region.'"';
					$regiones=AnaRegion::model()->findAll($dat);
 					$dat = new CDbCriteria;
					$dat->condition = 'id_region ="'.$dUsuario->id_region.'"';
					$empresas=AnaOrganizacion::model()->findAll($dat);
					$dat = new CDbCriteria;
					$dat->condition = 'id_region ="'.$dUsuario->id_region.'" and id="'.$dUsuario->id_ciudad.'"';
					$ciudades=AnaCiudad::model()->findAll($dat);					
					
				}
				 
				 
			}			
			if( $dUsuario->perfil==5){
				$perfiles=array( 4,6);
 				if($dUsuario->id_ciudad){
					$dat = new CDbCriteria;
					$dat->condition = 'id ="'.$dUsuario->id_pais.'"';
					$paises=AnaPais::model()->findAll($dat);
					$dat = new CDbCriteria;
					$dat->condition = 'id ="'.$dUsuario->id_region.'"';
					$regiones=AnaPais::model()->findAll($dat);
					$dat = new CDbCriteria;
					$dat->condition = 'id_region ="'.$dUsuario->id_region.'" and id="'.$dUsuario->id_ciudad.'"';
					$ciudades=AnaCiudad::model()->findAll($dat);
					$dat = new CDbCriteria;
					$dat->condition = 'id_ciudad ="'.$dUsuario->id_ciudad.'"';
					$empresas=AnaOrganizacion::model()->findAll($dat);
				}
				 
			}			
			
			if( $dUsuario->perfil==4){
				$perfiles=array( 6);
 				if($dUsuario->id_unidad){
 					$dat = new CDbCriteria;
					$dat->condition = 'id ="'.$dUsuario->id_unidad.'"';
					$empresas=AnaOrganizacion::model()->findAll($dat);
				}
				 
			}			
			//printVar($empresas);
			$dat = new CDbCriteria;
			$dat->condition = "idUsuario = '".$dUsuario->id."'";
    			$creditos=AnaMonedaxusuario::model()->count($dat);
    			$aData["creditosdisponibles"]=$creditos;
			$aData["usuariomodel"]=$dUsuario; 
			$aData["paises"]=$paises; 
			$aData["regiones"]=$regiones; 
			$aData["ciudades"]=$ciudades; 			
			$aData["empresas"]=$empresas; 			
 			$dat = new CDbCriteria;
			$dat->condition = "activo='1' ".$subquery;
			$dat->order="idorden ASC";
			$perfiles = AnaRol::model()->findAll($dat);
			//printVar($perfiles);
 			$aData["idioma"]=$idioma;
			$aData["perfiles"]=$perfiles;
			
 			if(!isset($_POST["save"])){
				App()->getClientScript()->registerScriptFile(Yii::app()->baseUrl."/scripts/yav1_4_1/js/yav.js");
				App()->getClientScript()->registerScriptFile(Yii::app()->baseUrl."/scripts/yav1_4_1/js/yav-config-es.js");
				App()->getClientScript()->registerScriptFile("//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js");
				//printVar($aData["usuario"]->id_pais,$_POST["idusuario"]);exit;
 				$this->_renderWrappedTemplate('admusuario', 'crear', $aData);
			}else{
				$uid=NULL;
				if($usuario==NULL){
					$set=new AnaUsuario();
					$set->clave=$this->escape($_POST["password"]);
				}else if((int)$usuario->id>0){
					$set=$usuario;
					if(!empty($_POST["password"])){
						$set->clave=$this->escape($_POST["password"]);
					}
					$queryString = "
					SELECT 
					uid
					FROM {{users}}
					WHERE iduseval = ".$set->id;//printVar($queryString);exit;
					$eguresult = dbExecuteAssoc($queryString);
					$res = $eguresult->readAll();		
					foreach($res as $datos) {
						$row=(Object)$datos;
						$uid = $row->uid;
					}
				}
				if(is_object($set)){
					
					 
 					
					$set->nombres=$this->escape($_POST["nombres"]);
					$set->alias=$this->escape($_POST["usuario"]);
					$set->documento=$this->escape($_POST["documento"]);
					$set->email=$this->escape($_POST["email"]);
					//$set->perfil=(int)$this->escape($_POST["perfil"]); anterior al perfil en la vista
					$set->perfil=(int)$this->escape("2");
 					//$set->uid_creador=Yii::app()->user->id;
					$set->uid_creador = $dUsuario->id;
					if((int)$_POST["idorgmenuserv"]>0){
						$set->idorgmenuserv=(int)$_POST["idorgmenuserv"];
					}
					if((int)$_POST["empresar"]>0){
						$set->id_unidad=(int)$_POST["empresar"];
					}
					if((int)$_POST["pais"]>0){
						$set->id_pais=(int)$_POST["pais"];
					}
					if((int)$_POST["ciudad"]>0){
						$set->id_ciudad=(int)$_POST["ciudad"];
					}
					if((int)$_POST["region"]>0){
						$set->id_region=(int)$_POST["region"];
					}
					 
					$set->fecharegistro=date("Y-m-d H:i:s");
					$set->activo=1;
 					
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
 						if($uid==NULL){
							$iNewUID = User::model()->insertUserNative($set->alias,$set->clave,$set->documento,Yii::app()->user->id, $set->email,$set->id);
							$perfil="default";
							$entity="template";
							$perfil="superadmin";
							$entity="global";
							if($set->perfil==2 or $set->perfil==3 or $set->perfil==4 or $set->perfil==5 or $set->perfil==6){
								$perfil="default";
								$entity="template";
							}
							if((int)$iNewUID>0){
								Permission::model()->insertSomeRecords(array('uid' => (int)$iNewUID, 'permission' => $perfil, 'entity'=>$entity, 'read_p' => 1, 'entity_id'=>0));
								echo json_encode(array("El usuario ha sido creado",$set->id));
							}					
						
						}else if((int)$uid>0){
							$oRecord = User::model()->findByPk($uid);
							$oRecord->email=$set->email;
							$oRecord->users_name=$set->alias;
							$oRecord->full_name= $set->documento;
							$oRecord->password= hash('sha256', $set->clave);
							$uresult = $oRecord->save();
							$perfil="default";
							$entity="template";
							if(AnaUsuario::model()->vaidausr(false) and $data["par_perfil"]==1){
								$perfil="superadmin";
								$entity="global";
							}	
							$valus = new CDbCriteria;
							$valus->condition = 'uid='.$uid;
							$rus = Permission::model()->find($valus);									
							$rus->permission= $perfil;
							$rus->entity= $entity;
							$t=$rus->save();
							//printVar($uid);exit;
							echo json_encode(array("El usuario ha sido actualizado",$set->id));
						}
					}else{
					echo json_encode(array("Algo salio mal"));
					}
				}
				 
			}
		}else{
			printVar("No tiene permiso para esta acción");
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
 	
	function selectEmpleadosActivos($act){
 		$oRecord = User::model()->findByPk(Yii::app()->user->id); 
		//printVar($oRecord);
		$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
		$TAMANO_PAGINA = 10;
		$pagina=NULL;
		$filtro="";
 		if(isset($_POST["tamanio"]) and (int)$_POST["tamanio"]>0){
			$TAMANO_PAGINA =(int)$_POST["tamanio"];
			$pagina = (int)$_POST["pagina"];
		}
		if($oRecord->uid==463){
			$filtro=" and (u.perfil>0 )";
		}
		if( $dUsuario->perfil==2 ){
			$next=" and uid_creador=".Yii::app()->user->id."  ";
			if((int)$dUsuario->id_pais>0){
				$next.=" and id_pais=".(int)$dUsuario->id_pais;
			}
			$filtro=" and u.perfil in (3,4,5,6) ".$next;
		}
		if( $dUsuario->perfil==3 ){
			$filtro=" and u.perfil in (4,5,6) and id_region=".$dUsuario->id_region;
		}
		if( $dUsuario->perfil==5 ){
			$filtro=" and u.perfil in (4,6) and id_ciudad=".$dUsuario->id_ciudad;
		}
		if( $dUsuario->perfil==4 ){
			$filtro=" and u.perfil in (6) and id_unidad=".$dUsuario->id_unidad;
		}

		$perfilusuarior=-1;
		if(isset($_POST["perfilusuario"]) and (int)$_POST["perfilusuario"]>=-1){
			$filtro="";
			if((int)$_POST["perfilusuario"]==-1){
				if($oRecord->uid==463){
					$filtro.=" and (u.perfil>0 )";
				}
 				if( $dUsuario->perfil==2 ){
					$next=" and uid_creador=".Yii::app()->user->id."  ";
					if((int)$dUsuario->id_pais>0){
						$next.=" and id_pais=".(int)$dUsuario->id_pais;
					}
					
					$filtro.=" and u.perfil in (3,4,5,6) ".$next;
				}
 				if( $dUsuario->perfil==3 ){
					$filtro.=" and u.perfil in (4,5,6) and id_region=".$dUsuario->id_region;
				}
 				if( $dUsuario->perfil==5 ){
					$filtro.=" and u.perfil in (4,6) and id_ciudad=".$dUsuario->id_ciudad;
				}
 				if( $dUsuario->perfil==4 ){
					$filtro.=" and u.perfil in (6) and id_unidad=".$dUsuario->id_unidad;
				}
 			}
			if((int)$_POST["perfilusuario"]>0){
 				if($oRecord->uid==463){
					$filtro.=" and u.perfil=".(int)$_POST["perfilusuario"]." ";
  				}
 				if( $dUsuario->perfil==2 ){
					$next=" and uid_creador=".Yii::app()->user->id."  ";
					if((int)$dUsuario->id_pais>0){
						$next.=" and id_pais=".(int)$dUsuario->id_pais;
					}
					$filtro.=" and u.perfil in (3,4,5,6)  ".$next." and u.perfil=".(int)$_POST["perfilusuario"]." ";
				}
 				if( $dUsuario->perfil==3 ){
					$filtro.=" and u.perfil in (4,5,6) and id_region=".$dUsuario->id_region." and u.perfil=".(int)$_POST["perfilusuario"]." ";
				}
 				if( $dUsuario->perfil==5 ){
					$filtro.=" and u.perfil in (4,6) and id_ciudad=".$dUsuario->id_ciudad." and u.perfil=".(int)$_POST["perfilusuario"]." ";
				}
 				if( $dUsuario->perfil==4 ){
					$filtro.=" and u.perfil in (6) and id_unidad=".$dUsuario->id_unidad." and u.perfil=".(int)$_POST["perfilusuario"]." ";
				}
 				$perfilusuarior=(int)$_POST["perfilusuario"];
  			}
			
		}
		
		if(isset($_POST["pais"]) or isset($_POST["region"]) or isset($_POST["ciudad"]) or isset($_POST["empresar"])){
				$rango=array();
				if(isset($_POST["pais"]) and (int)$_POST["pais"]>0){
					array_push($rango,"id_pais=".(int)$_POST["pais"]);
				}
				 
				if(isset($_POST["region"])  and  (int)$_POST["region"]>0){
					array_push($rango,"id_region=".(int)$_POST["region"]);
				}
				 
				if(isset($_POST["ciudad"])  and (int)$_POST["ciudad"]>0){
					array_push($rango,"id_ciudad=".(int)$_POST["ciudad"]);
				}
 				if(isset($_POST["empresar"])  and (int)$_POST["empresar"]>0){
					array_push($rango,"id_unidad=".(int)$_POST["empresar"]);
				}
				 
				if(join(" and ",$rango)!=""){	
					if($oRecord->uid==463 or  $dUsuario->perfil==1){
						$filtro.=" and ".join(" and ",$rango);
					}
					
					if( $dUsuario->perfil==2 ){
						$next=" and uid_creador=".Yii::app()->user->id."  ";
						if((int)$dUsuario->id_pais>0){
							$next.=" and id_pais=".(int)$dUsuario->id_pais;
						}
 						$filtro.=" and u.perfil in (3,4,5,6) ".$next." and u.perfil=".(int)$_POST["perfilusuario"]." and ".join(" and ",$rango);
					}
					if( $dUsuario->perfil==3 ){
						$filtro.=" and u.perfil in (4,5,6) and id_region=".$dUsuario->id_region." and u.perfil=".(int)$_POST["perfilusuario"]." and ".join(" and ",$rango);
					}
					if( $dUsuario->perfil==5 ){
						$filtro.=" and u.perfil in (4,6) and id_ciudad=".$dUsuario->id_ciudad." and u.perfil=".(int)$_POST["perfilusuario"]." and ".join(" and ",$rango);
					}
					if( $dUsuario->perfil==4 ){
						$filtro.=" and u.perfil in (6) and id_unidad=".$dUsuario->id_unidad." and u.perfil=".(int)$_POST["perfilusuario"]." and ".join(" and ",$rango);
					}
				}
 		}
		
		//printVar($filtro,$dUsuario->perfil);exit;
		 
		$estado=-1;
		if(isset($_POST["estado"]) and (int)$_POST["estado"]>=-1){
			$estado=(int)$_POST["estado"];
			$act=(int)$_POST["estado"];
 		}
   		if(isset($_POST["buscar"]) and $_POST["buscar"]!=""){
			$sql = new sql_inject();
			$testinject=$sql->test($_POST["buscar"]);
 			if($testinject==false){
				$filtro.=" and ( u.alias like  '%".$_POST["buscar"]."%' or  u.nombres like  '%".$_POST["buscar"]."%' or u.email like  '%".$_POST["buscar"]."%')";
				
			}else{
				printVar("Intento SQL inection");
				$this->getController()->redirect(array('/admin/authentication/sa/logout'));
			}
 		}
		 
  		if ($pagina==NULL) {
		   $inicio = 0;
		   $pagina = 1;
		}else {
		   $inicio = ($pagina - 1) * $TAMANO_PAGINA;
		}
  		$datos="";
		//printVar($oRecord->uid);exit;
 		if($oRecord->uid==463){
 			if(is_array($act)){
				$datos="   ".$act[0]." or  u.activo =".$act[1];
  			}else{
				$datos="  u.activo = ".$act;
			}
		}else if(isset($dUsuario->id) and $dUsuario->perfil!=1){
 			if(is_array($act)){
				//$datos="   ".$act[0]." or  u.activo =".$act[1]." and u.uid_creador=".(int)Yii::app()->user->id;
				$datos="   ".$act[0]." or  u.activo =".$act[1];
			}else{
				//$datos="  u.activo = ".$act." and u.uid_creador=".(int)Yii::app()->user->id;
				$datos="  u.activo = ".$act;
			}
 		}		
  		//printVar($datos);exit;
		$dat = new CDbCriteria;
 		$dat->select = 'id,activo,uid_creador';
		$dat->condition = str_replace("u.","",$datos).str_replace("u.","",$filtro);
		$test = AnaUsuario::model()->findAll($dat);		
		$num_total_registros=count($test);
		//printVar($datos.$filtro);
		//calculo el total de páginas
		$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
 		$arr = array();
		
        $queryString = "
		SELECT
		{{ana_rol}}.nombre AS perfil,
 		u.id AS id_user,
 		u.nombres AS nombres,
		u.alias as alias,
		u.clave as clave,
 		u.email as email,
 		u.activo as activo,
		u.perfil AS id_perfil
		FROM
		{{ana_usuario}} u
		INNER JOIN {{ana_rol}} ON u.perfil = {{ana_rol}}.id		
		WHERE  
		".$datos.$filtro."		
		ORDER BY u.id  
		 LIMIT ".$inicio."," . $TAMANO_PAGINA; 
		 //printVar($queryString);exit;
    	$eguresult = dbExecuteAssoc($queryString);
		$res = $eguresult->readAll();		
 		foreach($res as $datos) {
			$empresas="";
			 
 			$datos["empresa"]=$empresas; 
  			array_push($arr,(Object)$datos);
		}
		
 		return array($arr,array($total_paginas,$pagina,$buscar,$perfilusuarior,$unidadesr,$act));
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

    public function gestionar(){
	Yii::app()->cache->flush();
	$idioma=json_decode(base64_decode($_SESSION["codelang"]));
	$oRecord = User::model()->findByPk(Yii::app()->user->id);
	$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
	App()->getClientScript()->registerScriptFile(Yii::app()->baseUrl."/scripts/yav1_4_1/js/yav.js");
	App()->getClientScript()->registerScriptFile(Yii::app()->baseUrl."/scripts/yav1_4_1/js/yav-config-es.js");
	App()->getClientScript()->registerScriptFile("//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js");
	$dat = new CDbCriteria;
	$dat->condition = "idUsuario = '".$dUsuario->id."'";
	$creditosdisponibles=AnaMonedaxusuario::model()->count($dat);
	$dat = new CDbCriteria;
	$dat->condition = "activo = 1";
	if($dUsuario->perfil != 1){
		$dat->condition = "activo = 1 AND uid_creador = '$dUsuario->id' " ;	
	}
	$usuarios = AnaUsuario::model()->findAll($dat);
	$usuarios_temp = array();
	foreach($usuarios as $usuario){
		array_push($usuarios_temp,$usuario->getAttributes());
	}
	$usuarios = $usuarios_temp;
	foreach($usuarios as &$usuario){
        	$dat = new CDbCriteria;
		$dat->condition = "idUsuario = '".$usuario['id']."'";
        	$creditos=AnaMonedaxusuario::model()->count($dat);
        	$usuario['creditos'] = $creditos;

   	}
	$aData["creditosdisponibles"]=$creditosdisponibles;
	$aData["idioma"]=$idioma;
	$aData["usuariomodel"]=$dUsuario;
	$aData["usuarios"] = json_encode($usuarios);
	$this->_renderWrappedTemplate('admusuario', 'gestionar', $aData);
    }

 public function historial(){
	Yii::app()->cache->flush();
	$idioma=json_decode(base64_decode($_SESSION["codelang"]));
	$oRecord = User::model()->findByPk(Yii::app()->user->id);
	$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
	App()->getClientScript()->registerScriptFile(Yii::app()->baseUrl."/scripts/yav1_4_1/js/yav.js");
	App()->getClientScript()->registerScriptFile(Yii::app()->baseUrl."/scripts/yav1_4_1/js/yav-config-es.js");
	App()->getClientScript()->registerScriptFile("//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js");
	$dat = new CDbCriteria;
	$dat->condition = "idUsuario = '".$dUsuario->id."'";
	$creditosdisponibles=AnaMonedaxusuario::model()->count($dat);
	$primer_dia = new DateTime('first day of this month');
	$primer_dia = $primer_dia->format('Y-m-d');
	$ultimo_dia = new DateTime('last day of this month');
	$ultimo_dia = $ultimo_dia->format('Y-m-d');
	$dat = new CDbCriteria;
	$dat->condition = "fecharegistro >='$primer_dia' AND fecharegistro <= '$ultimo_dia' AND evento like 'Asig%'";
	$dat->order = "fecharegistro DESC";
	$ventas = AnaMonedaFlujo::model()->findAll($dat);
	$ventas_temp = array();
	foreach($ventas as $venta){
		array_push($ventas_temp,$venta->getAttributes());
	}
	/*
	foreach($ventas_temp as &$venta){
		if(preg_match('/Asig/i', $venta['evento'])){
    			$venta['comparacion'] = true;
		}
		else{
			$venta['comparacion'] = false;
		}
		
	}

	$ventas_temp = array_filter($ventas_temp,function($value){
        				return $value['comparacion'] === true;
    			});*/
	foreach($ventas_temp as &$venta){
		$venta['usuario'] = AnaUsuario::model()->findByPk($venta['idUsuarioDestino'])->getAttributes();
	}
	if($dUsuario->perfil != 1){
		$ventas_temp = array_filter($ventas_temp,function($value) use ($dUsuario){
			return $value['usuario']['uid_creador'] == $dUsuario->id;
		});
	}
	$ventas = $ventas_temp;
	$aData["creditosdisponibles"]=$creditosdisponibles;
	$aData["idioma"]=$idioma;
	$aData["usuariomodel"]=$dUsuario;
	$aData["fechas"] = array("primer_dia_mes"=>$primer_dia,"ultimo_dia_mes"=>$ultimo_dia);
	$aData["ventas"] = json_encode($ventas);
	$this->_renderWrappedTemplate('admusuario', 'historial', $aData);


 
 }

 public function filtroFecha(){
	$fecha_inicial = $_POST['fecha_inicial'];
	$fecha_final = $_POST['fecha_final'];
	$dat = new CDbCriteria;
	$dat->condition = "fecharegistro >='$fecha_inicial' AND fecharegistro <= '$fecha_final' AND evento like 'Asig%'";
	$dat->order = "fecharegistro DESC";
	$ventas = AnaMonedaFlujo::model()->findAll($dat);
	$ventas_temp = array();
	foreach($ventas as $venta){
		array_push($ventas_temp,$venta->getAttributes());
	}
	/*foreach($ventas_temp as &$venta){
		if(preg_match('/Asig/i', $venta['evento'])){
    			$venta['comparacion'] = true;
		}
		else{
			$venta['comparacion'] = false;
		}
		
	}

	$ventas_temp = array_filter($ventas_temp,function($value){
        				return $value['comparacion'] === true;
    			});*/
	foreach($ventas_temp as &$venta){
		$venta['usuario'] = AnaUsuario::model()->findByPk($venta['idUsuarioDestino'])->getAttributes();
	}
	$ventas = $ventas_temp;
	echo json_encode($ventas);
	
	
 }

	
}