<?php
	
	//  error_reporting(E_ALL);
 //ini_set('display_errors', '3');
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Estructuraorg extends Survey_Common_Action
{
	function __construct($controller, $id)
	{
		parent::__construct($controller, $id);

		Yii::app()->loadHelper('database');
	}

    /**
    * Show users table
    */
    public function index()
    {
		/*$baseUrl = Yii::app()->baseUrl; 
		$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile($baseUrl.'/js/colorbox/jquery.colorbox-min.js');
		$cs->registerCssFile($baseUrl.'/js/colorbox/example1/colorbox.css');	
*/
        Yii::app()->cache->flush();
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 

		$aData=array();
		$criteria = new CDbCriteria;
		$criteria->condition ='tipo="client"';
		if($oRecord->uid==1){
			$aData["modulos"]=Modulo::model()->findAll($criteria);
 			$aData["model"]=Organizacion::model()->selecOrganizaciones();
		}else{
			$aData["modulos"]=NULL;
  			$aData["model"]=NULL;
		}
        $this->_renderWrappedTemplate('estructura', 'organizaciones', $aData);
    }
 	
	function generarCodigo($longitud) {
	 $key = '';
	 $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
	 $max = strlen($pattern)-1;
	 for($i=0;$i < $longitud;$i++) $key .= $pattern[mt_rand(0,$max)];
	 return $key;
	}
 	
	public function validaorg(){ 
		$r="n";
  		if((int)$_REQUEST["id"]>0){
			$criteria = new CDbCriteria;
			$criteria->condition ='idorganizacion='.$_REQUEST["id"];
			$m=Estructura::model()->find($criteria);
			if(isset($m->id)){
				$r=Yii::app()->baseUrl."/index.php/admin/estructuraorg/organigrama/?id=".$m->idorganizacion;
 			}
		}
		
		echo json_encode(array($r)); exit;
	}
	public function getusuariosorganizacion(){
		$jsonr=Organizacion::model()->getusuariosorganizacion((int)$_REQUEST["id"]);
 		echo json_encode($jsonr);exit;
	}
	
	
	
	
	
	public function estructuraorganizacional(){
	
		if(!isset($_POST["data"])){
			$oRecord = User::model()->findByPk($_SESSION['loginID']); 
			$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
			$idusuario=NULL;
			if(isset($dUsuario->id)){
				$idusuario=$dUsuario->id;
			}
			if($idusuario!=NULL){
				$jsonorg=Estructura::model()->organigramaempresa((int)$dUsuario->id_unidad);
				$data["jsonorg"]=$jsonorg;
 				$_GET["id"]=(int)$dUsuario->id_unidad;
				$data["organizaiones"]=Organizacion::model()->selecOrganizaciones((int)$dUsuario->id_unidad);
				$data["nivel"]=Nivel::model()->findAll();
				$cs = Yii::app()->getClientScript();
				$cs->registerScriptFile('https://www.gstatic.com/charts/loader.js');
				$this->_renderWrappedTemplate('rcv', 'organigrama', $data);
			}
		}else if(is_array($_POST["data"])){
		$index=array();
			// Yii::app()->cache->flush();
			$criteria = new CDbCriteria; 
			$criteria->condition = ' idorganizacion='.(int)$_POST["data"][0]["idorg"]; 
			$test = Estructura::model()->findAll($criteria);
			if(isset($test[0]->id)){
				$rid=array();
				foreach($test as $r){
					array_push($rid,$r->id);
				}
 				$queryc = "delete FROM {{ownerxestructura}} where idestrcutura in (".join(",",$rid).")";
				$gcrt = dbExecuteAssoc($queryc);						
  			}
			$totaldata=count($rid);
			$idskey=array();
 			foreach($_POST["data"] as $k=>$data){
				$tid=explode("-",$data['id']); 
				$idestructura=$tid[1]; 
				$idpadre=$data['idpadre'];
				$responsables=$data['responsables'];
				$descripcion=$data['descripcion'];
 				$criteria = new CDbCriteria;
				$criteria->condition = ' id='.(int)$idestructura;
 				$etc = Estructura::model()->find($criteria);
				if(!isset($etc->id)){
					$criteria = new CDbCriteria;
					$criteria->condition =  ' idorganizacion='.(int)$_POST["data"][0]["idorg"].' and idpadre is NULL';
					$etc = Estructura::model()->find($criteria);
 				}
				if(isset($etc->id)){
					$etc->nombre=$data["nombre"];
					$etc->descripcion=$descripcion;
					$etc->fecharegistro=date("Y-m-d H:i:s"); 
					if($etc->save()){// printVar($responsables[0]);
 						array_push($idskey,$etc->id);
						if(isset($responsables[0])){
							foreach($responsables as $kk=>$rt){
								$resp=new Ownerxestructura();
								$resp->idus=(int)$rt;
								$resp->idestrcutura=$etc->id;
								$resp->fecharegistro=$etc->fecharegistro;
								$resp->save();
							}
						}
						$index[$data['id']]=$etc->id;
					}
				}
 			}
			 
 			
			echo json_encode(array(Yii::app()->baseUrl."/index.php/admin/rcv/organigrama/?id=".(int)$_POST["data"][0]["idorg"]));
			//echo "hola";
		
		exit;
		}	
		
		
	}	
	
	
 	
	public function organigrama(){
		if(!isset($_POST["data"])){
			$jsonorg="";
			if(isset($_GET["id"])){
 				$jsonorg=Estructura::model()->organigramaempresa((int)$_GET["id"]);
			}
			$data["jsonorg"]=$jsonorg;
			$data["organizaiones"]=Organizacion::model()->selecOrganizaciones();
			//printVar($data["organizaiones"]);exit;
			$data["nivel"]=Nivel::model()->findAll();
			$cs = Yii::app()->getClientScript();
			$cs->registerScriptFile('https://www.gstatic.com/charts/loader.js');
			$this->_renderWrappedTemplate('estructura', 'organigrama', $data);
		}else if(is_array($_POST["data"])){
			$index=array();
			// Yii::app()->cache->flush();
			$criteria = new CDbCriteria;
			$criteria->condition = ' idorganizacion='.(int)$_POST["data"][0]["idorg"];
			$test = Estructura::model()->findAll($criteria);
			if(isset($test[0]->id)){
				$rid=array();
				foreach($test as $r){
					array_push($rid,$r->id);
				}
 				$queryc = "delete FROM {{ownerxestructura}} where idestrcutura in (".join(",",$rid).")";
				$gcrt = dbExecuteAssoc($queryc);						
  			}
			$totaldata=count($rid);
			$idskey=array();
 			foreach($_POST["data"] as $k=>$data){
				$tid=explode("-",$data['id']); 
				$idestructura=$tid[1]; 
				$idpadre=$data['idpadre'];
				$responsables=$data['responsables'];
				$descripcion=$data['descripcion'];
				
				$idNivel=NULL;
  				$testn=Nivel::model()->findByPk((int)$tid[0]);
 				
				if(isset($testn->id)){
					$idNivel=$testn->id;
				}
 				if($k==0){
					$idpadre=NULL;
					$idNivel=NULL;
				}else{
					$idpadre=$index[$data['idpadre']];
 				}
				
				if(($idestructura==0 or $idestructura==1 or $totaldata==0) and $idpadre==NULL){
 					$criteria = new CDbCriteria;
					$criteria->condition = ' idpadre is NULL and idorganizacion='.(int)$_POST["data"][0]["idorg"];
					$etc = Estructura::model()->find($criteria);
 					if(!isset($etc->id) or $totaldata==0 ){
						$etc=new Estructura();
					}
 				}else{
					$criteria = new CDbCriteria;
					$criteria->condition = ' id='.(int)$idestructura;
					$etc = Estructura::model()->find($criteria);
					if(!isset($etc->id) or $totaldata==0 or (isset($tid[2]) and $tid[2]=='nodo')){
						$etc=new Estructura();
					}
 				}
 				$etc->nombre=$data["nombre"];
 				$etc->idorganizacion=(int)$data["idorg"];
				$etc->idpadre=$idpadre;
				$etc->idnivel=$idNivel;
				$etc->descripcion=$descripcion;
				$etc->fecharegistro=date("Y-m-d H:i:s");
   				if($etc->save()){  //printVar($data["nombre"],$etc->id);
					array_push($idskey,$etc->id);
					if(isset($responsables[0])){
						foreach($responsables as $kk=>$rt){
							$criteria = new CDbCriteria;
							$criteria->condition = ' idus='.(int)$rt.' and idestrcutura='.$etc->id;
							$resp = Ownerxestructura::model()->find($criteria);
							if(!isset($resp->id)){
								$resp=new Ownerxestructura();
 							}
 							$resp->idus=(int)$rt;
							$resp->idestrcutura=$etc->id;
							$resp->fecharegistro=$etc->fecharegistro;
							$resp->save();
						}
 					}
					$index[$data['id']]=$etc->id;
   				}
 			}
			if($totaldata>0){
				foreach($rid as $data){
					if(!in_array($data,$idskey)){
						$queryc = "delete FROM {{estructura}} where id=".$data." and idpadre >0";
						$gcrt = dbExecuteAssoc($queryc);
   					}
				}
			}
 			
			echo json_encode(array(Yii::app()->baseUrl."/index.php/admin/estructuraorg/organigrama/?id=".(int)$_POST["data"][0]["idorg"]));
			//echo "hola";
		
		exit;
		}
	}
	
	
	
	function actionsorg(){
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
		//$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
		if(isset($_POST["option"])){
			$option=$_POST["option"];
			switch($option){
				case "create":
 					$model=new Organizacion();
					$model->attributes=$_POST['Organizacion'];
					$model->fecharegistro=date("Y-m-d H:i:s");
					$model->codigo=$this->generarCodigo(15);
					$model->save();
					$error=1;
					if($model->id>0){
						$error=0;
						if(isset($_POST["module"])){
							foreach($_POST["module"] as $data){
								$demo='0';
								if(isset($data["demo"])){
									$demo='1';
								}
 								$set=new Servicio();
								$set->nombre=$data["nombre"];
								$set->jmodulos=join(",",$data["module"]);
								$set->descripcion=$data["nombre"];
								$set->idorganizacion=$model->id;
								$set->estado="1";
								$set->demo=$demo;
								$set->fecharegistro=date("Y-m-d H:i:s");
								$set->save();
							}
						}
 					}						
 
 					$this->getController()->redirect(array('admin/estructuraorg/','r'=>$error)); 
				break;
				case "update":
					if($oRecord->uid==1){
						$model=Organizacion::model()->findByPk((int)$_POST['Organizacion']["id"]);
						$model->attributes=$_POST['Organizacion'];
						$model->save();
						$error=1;
						/*
						if($model->id>0){
							$error=0;
							$queryc = "delete FROM {{servicio}} where idorganizacion=".$model->id;
							$gcrt = dbExecuteAssoc($queryc);							
							if(isset($_POST["module"])){ 
								foreach($_POST["module"] as $data){
									$demo='0';
									if(isset($data["demo"])){
										$demo='1';
									}
									$set=new Servicio();
									$set->nombre=$data["nombre"];
									$set->jmodulos=join(",",$data["module"]);
									$set->descripcion=$data["nombre"];
									$set->idorganizacion=$model->id;
									$set->estado="1";
									$set->demo=$demo;
									$set->fecharegistro=date("Y-m-d H:i:s");
									$set->save();
								}
								 
							}						
						}
						*/
						$this->getController()->redirect(array('admin/estructuraorg/','r'=>$error));
					}
				break;
				case "delete":
					if($oRecord->uid==1){
						$model=Organizacion::model()->findByPk((int)$_POST['Organizacion']["id"]);
						$model->delete();
						$this->getController()->redirect(array('admin/estructuraorg/'));
					}
				break;
			}
		
		}
	}
	  
	
	protected function eliminarOrganizacion($conn,$id){
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
 		if($oRecord->uid==1){
			$queryString = "DELETE FROM organizacion WHERE id = "+$id;
			$Result = mysql_query($queryString, $conn) or die("error en ".get_class($this)."<br><pre>".$queryString."</pre><br>".mysql_error());
			return $Result;
		}
	}
	
	function update(){
		 
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 

       // return $id;
		if($oRecord->uid>0){	 
			$POST["nombre"]=strtoupper($_POST["textNom"]);
			$POST["codigo"]=strtoupper($_POST["textCod"]);
			$POST["empresa"]=strtoupper($_POST["textEmp"]);
			$POST["activa"]=$_POST["selectActiva"];
			$POST["textId"]=(Int)$_POST["textId"];
			$Error=0;
			if($POST["nombre"]=="" ){$Error=1;}
			if($POST["codigo"]=="" ){$Error=2;}
			if($POST["empresa"]==""){$Error=3;}
			if($POST["activa"]==""){$Error=4;}
			if($POST["activa"]!=1 and $POST["activa"]!=0){$Error=5;}
			$aData=array();
			$aData["error"]=$Error;
			$aData["imageurl"]=Yii::app()->baseUrl."img/";
			unset($_POST); 
			if($Error==0){
			
			
				$ugid = Organizacion::model()->updateUnidad($POST,(Int)$POST["textId"]);
				$aData["cunive"]=$this->selecUnidadesActivas();
				$aData["imageurl"]=Yii::app()->baseUrl."img/";
				$aData["error"]=0;
				 
				//$this->_renderWrappedTemplate('estructura', 'index', $aData);
				$this->getController()->redirect(array('admin/estructuraorg/unidades')); 
			}else{
				 /*
				$aData["nombre"]=$_POST["textNom"];
				$aData["codigo"]=$_POST["textCod"];
				$aData["empresa"]=$_POST["textEmp"];
				$aData["activa"]=$_POST["selectActiva"];
				$this->_renderWrappedTemplate('estructura', 'index', $aData);*/
				$this->getController()->redirect(array('admin/estructuraorg/unidades')); 
			}		
		}
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