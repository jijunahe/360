<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');
// error_reporting(E_ALL); ini_set('display_errors', '1');
$documentroot=str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"]);
require_once($documentroot.'application/extensions/PHPMailer/class.phpmailer.php');
require_once($documentroot.'application/extensions/xls/Excel/reader.php');
require_once($documentroot.'application/extensions/class_sql_inject.php');
require_once($documentroot.'application/extensions/cipher.php');
 include($_SERVER["DOCUMENT_ROOT"].Yii::app()->baseUrl.'/application/extensions/imageResizer.php');

class Pcos extends Survey_Common_Action
{
	public $anioc=array();
 	
	function __construct($controller, $id)
    {
        parent::__construct($controller, $id);

        Yii::app()->loadHelper('database');
 		
    }
	
	public function getanexo(){
		//printVar($_POST);exit;
 		Yii::app()->cache->flush();
  		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
 		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
 		if(isset($dUsuario->id)){
			if($dUsuario->perfil==6 or $dUsuario->perfil==7 or $dUsuario->perfil==3 or $dUsuario->perfil==4){
				$danexos=Anexo::model()->findByPk((int)$_POST["id"]); 
				if(isset($danexos->id)){ 
					$f = $_GET["f"];
					header("Content-type: application/octet-stream");
					header("Content-Disposition: attachment; filename='".$danexos->nombre."'\n");
					$urlbase=$_SERVER["DOCUMENT_ROOT"];
					
					$myCipher = new \Byte\Cipher; 
					$contents = file_get_contents($urlbase.$danexos->url);
					$cifrado=$contents;
					$myCipher->setData($cifrado);
					$myCipher->setKey('4m3n0fusAB');
					$myCipher->setCipher(256);
					$myCipher->setMode('ecb');

					//DESENCRIPTAR
					$tarc=RandomString().".".$danexos->tipo;
					$texto = $myCipher->decrypt();
					echo $texto;
				}
			}
 		}
	}
	
 	 public function cargar()
    {
 		Yii::app()->cache->flush();
  		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
 		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
 		if(isset($dUsuario->id)){
			if($dUsuario->perfil==6 or $dUsuario->perfil==7 or $dUsuario->perfil==3 or $dUsuario->perfil==4){ 	
 				App()->getClientScript()->registerScriptFile(Yii::app()->baseUrl."/scripts/yav1_4_1/js/yav.js");
				App()->getClientScript()->registerScriptFile(Yii::app()->baseUrl."/scripts/yav1_4_1/js/yav-config-es.js");
				App()->getClientScript()->registerScriptFile("//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js");
				if(isset($_POST["option"])){
					$option=$_POST["option"];
 					switch($option){
						case "del":
							if($dUsuario->perfil==6 or $dUsuario->perfil==7 or $dUsuario->perfil==3 or $oRecord->uid==1){ 
								$danexos=Anexo::model()->findByPk($_POST["id"]);
								if(isset($danexos->id)){
									unlink($danexos->url);
									$danexos->delete();
									echo json_encode(array("ok","El archivo ha sido eliminado"));
								}else{
									echo json_encode(array("no","El archivo no existe"));
								}
							}
						break;
						case "validar":
							$dat = new CDbCriteria;
							$dat->condition = "idform=".(int)$_POST["idform"];
							$anexos=Anexo::model()->count($dat);
							$danexos=Anexo::model()->findAll($dat);
							$m="ok";
							$rr=array();
							if($anexos>5){
								$m="Ha superado la cantidad de archivos permitidos";
							}
							if((int)$_POST["idform"]<=0){
								$m="No existe auditoria";
								$_POST["idform"]=0;
							}else{
								foreach($danexos as $dd){
									$objs=array();
									foreach($dd as $k=>$rdata){
										$objs[$k]=$rdata;
									}
									array_push($rr,(object)$objs);
								}
							}
 							echo json_encode(array($anexos,$m,(int)$_POST["idform"],$rr));
						break;
 					}
 					exit;
 				}else{
					$urlbase=$_SERVER["DOCUMENT_ROOT"].Yii::app()->baseUrl;
					//comprobamos que sea una petición ajax
					if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
					{
 						//obtenemos el archivo a subir
						$file = $_FILES['archivo']['name'];
						$permitidos=array("jpg","gif","png","doc","docx","pdf","xls","xlsx","ppt","pptx");
						$ext=explode(".",$file);
						$ext=strtolower($ext[count($ext)-1]);
						$validar=true;
						if(!in_array($ext,$permitidos)){
							$validar=false;
						}
						//comprobamos si existe un directorio para subir el archivo
						//si no es así, lo creamos
						//comprobamos si el archivo ha subido
						if($validar==true){
							$tarch=RandomString(20).".".$ext;
							if ($file && move_uploaded_file($_FILES['archivo']['tmp_name'],$urlbase."/files/pcos/anexos/".$tarch))
							{
							   //sleep(3);//retrasamos la petición 3 segundos
							   //echo $file;//devolvemos el nombre del archivo para pintar la imagen
								$set=new Anexo();
								$set->fecha=date("Y-m-d H:i:s");
								$set->idform=(int)$_POST["idform"];
								$set->tipo=$ext;
								$eva=EvalEvaluacion::model()->findByPk((int)$_POST["idform"]);
								if((int)$eva->idorg>0){
								$set->idorg=$eva->idorg;
								}
								$set->url=Yii::app()->baseUrl."/files/pcos/anexos/".$tarch;
								$set->nombre=$file;
								$set->save();
								
								$myCipher = new \Byte\Cipher; 
								
								$contents = file_get_contents($urlbase."/files/pcos/anexos/".$tarch);
								$myCipher->setData($contents);
								$myCipher->setKey('4m3n0fusAB');
								$myCipher->setCipher(256);
								$myCipher->setMode('ecb');
								 
								$cifrado = $myCipher->encrypt();						
								
								$file = fopen($urlbase."/files/pcos/anexos/".$tarch, "w");
								fwrite($file,$cifrado);
								fclose($file);
														
								//DESENCRIPTAR
								//$myCipher->setData($cifrado);
								//$texto = $myCipher->decrypt();
								//$file = fopen($urlbase."/files/pcos/anexos/arc.pdf", "w");
								//fwrite($file,$texto);
								//fclose($file);
 							}
						}
					}else{
						throw new Exception("Error Processing Request", 1);   
					}			
					exit;
				}
			}
		}
	}	
 	
	
	
	
 	
	public function seguimientoreporte(){
		Yii::app()->cache->flush();
  		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
 		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
 		$idusuario=NULL;
		$organizacion=NULL;
		$idpadre=NULL;
		$anioc=NULL;
		
 		if((isset($dUsuario->id) and ($dUsuario->perfil==2 or $oRecord->uid==1 or $dUsuario->perfil==3  or $dUsuario->perfil==4)) or $oRecord->uid==1){
			
			if($dUsuario->perfil==2 or $oRecord->uid==1 or $dUsuario->perfil==3  or $dUsuario->perfil==4){
				if($dUsuario->perfil==2 or $dUsuario->perfil==4 or $dUsuario->perfil==3){
					$dat = new CDbCriteria;
					$dat->condition = "id in (".$dUsuario->id_unidad.")";
					$empresas=Organizacion::model()->findAll($dat);
				}else if($oRecord->uid==1 or $dUsuario->perfil==1 ){
					$empresas=Organizacion::model()->findAll();
				}
				$jemp=array();
				foreach($empresas as $dataemp){
					array_push($jemp,$dataemp->id);  
				}
 				if(isset($_POST["chart"])  ){
					$query=array();
					if(isset($_POST["idorg"]) and (int)$_POST["idorg"]>0){
						array_push($query,"idempresa=".(int)$_POST["idorg"]);
					}
 					if((int)$_POST["idAnswer"]>0){
						array_push($query,"idAnswer=".(int)$_POST["idAnswer"]);
					}
 					if($query[0]!=""){
 						
 						$queryString = "
						SELECT 
						*
						FROM lime_cubo_294584
						WHERE ".join(" and ",$query)."  and estado ='Y' order by id DESC"; // printVar($queryString);exit;
						$eguresult = dbExecuteAssoc($queryString);
						$tdatacubo = $eguresult->readAll();	
						$r=array();
						foreach($tdatacubo as $data){
							array_push($r,(object)$data);
							
						}						
						
						$evaluaciones=$r;
					}else{
						$q="";
  						if($dUsuario->perfil==3 or $dUsuario->perfil==4){
							$q="idempresa  in (".join(",",$jemp).")  and estado ='Y' order by id DESC";
						}else{
							$q="id>0  and estado ='Y' order by id DESC";
 						}
 						$queryString = "
						SELECT 
						*
						FROM lime_cubo_294584
						WHERE ".$q." "; // printVar($queryString);exit;
						$eguresult = dbExecuteAssoc($queryString);
						$tdatacubo = $eguresult->readAll();	
						$r=array();
						foreach($tdatacubo as $data){
							array_push($r,(object)$data);
							
						}						
 						$evaluaciones=$r;
					}
 				} 
				else{
					$q='';
					if($dUsuario->perfil==3 or $dUsuario->perfil==4){
							$q="idempresa  in (".join(",",$jemp).")   and estado ='Y' order by id DESC";
					}else{
							$q="id > 0  and estado ='Y' order by id DESC";
					}
				
					$queryString = "
					SELECT 
					*
					FROM lime_cubo_294584
					WHERE ".$q."   "; // printVar($queryString);exit;
					$eguresult = dbExecuteAssoc($queryString);
					$tdatacubo = $eguresult->readAll();	
					$r=array();
					foreach($tdatacubo as $data){
						array_push($r,(object)$data);
						
					}					
					
					$evaluaciones=$r;
				} 
				if((int)$_POST["idAnswer"]>0){
					$queryString = "
					SELECT 
					COUNT(*) as total
					FROM lime_cubo_294584
					WHERE idAnswer ='".(int)$_POST["idAnswer"]."'  and estado ='Y' "; // printVar($queryString);exit;
					$eguresult = dbExecuteAssoc($queryString);
					$tdatacubo = $eguresult->readAll();	
					$r=array();
					foreach($tdatacubo as $data){
						array_push($r,$data);
						
					}
 					$data["total"]=$r[0]["total"];
					
				} 				
 			}else{  
				$dat = new CDbCriteria;
				$dat->condition = "id in (".$dUsuario->id_unidad.")";
 				$empresas=Organizacion::model()->findAll($dat);
				if(isset($_POST["chart"])  ){
					$query=array("idus=".$dUsuario->id);
					if(isset($_POST["idorg"]) and (int)$_POST["idorg"]>0){
						array_push($query,"idempresa=".(int)$_POST["idorg"]);
					}
 					if((int)$_POST["idAnswer"]>0){
						array_push($query,"idAnswer=".(int)$_POST["idAnswer"]);
					}
					//printVar(join(" and ",$query));exit;
 					$queryString = "
					SELECT 
					*
					FROM lime_cubo_294584
					WHERE ".join(" and ",$query)."  and estado ='Y'  order byb id DESC"; // printVar($queryString);exit;
					$eguresult = dbExecuteAssoc($queryString);
					$tdatacubo = $eguresult->readAll();	
					$r=array();
					foreach($tdatacubo as $data){
						array_push($r,(object)$data);
 					}					
 					$evaluaciones=$r;
 				}else{
 					$q = " idus=".$dUsuario->id;
  					$queryString = "
					SELECT 
					*
					FROM lime_cubo_294584
					WHERE ".$q."  and estado ='Y'  order byb id DESC"; // printVar($queryString);exit;
					$eguresult = dbExecuteAssoc($queryString);
					$tdatacubo = $eguresult->readAll();	
					$r=array();
					foreach($tdatacubo as $data){
						array_push($r,(object)$data);
 					}					
					
					$evaluaciones=$r;
				}
				if((int)$_POST["idAnswer"]>0){
					$queryString = "
					SELECT 
					COUNT(*) as total
					FROM lime_cubo_294584
					WHERE idAnswer ='".(int)$_POST["idAnswer"]."'  and estado ='Y' "; // printVar($queryString);exit;
					$eguresult = dbExecuteAssoc($queryString);
					$tdatacubo = $eguresult->readAll();	
					$r=array();
					foreach($tdatacubo as $data){
						array_push($r,$data);
						
					}
 					$data["total"]=$r[0]["total"];
					
				}
 				
			}
			$objemp=array();
			foreach($empresas as $datar){
				$arrt=array();
				foreach($datar  as $k=>$v){
					$arrt[$k]=$v;
				}
				array_push($objemp,(object)$arrt);
			}
			$objeval=array();
			foreach($evaluaciones as $datar){
				$arrt=array();
				foreach($datar as $k=>$v){
					$arrt[$k]=$v;
				}
				array_push($objeval,(object)$arrt);
			}
 			
			
			$data["empresas"]= $objemp;
			$data["evaluaciones"]= $objeval;
			
  			$data["token"]=$this->getTokenpentaho();
  			$data["oRecord"]=$oRecord;
  			$data["dUsuario"]=$dUsuario;
 
			if(!isset($_POST["chart"])){ 
				$this->_renderWrappedTemplate('pcos', 'reporteseguimiento', $data);
			}else{
				echo json_encode($data);exit;
 			}
			 
		}		
  	}
	
	
  	public function seguimientoencuesta(){
		Yii::app()->cache->flush();
		if(isset($_SESSION['loginID'])){
 			$oRecord = User::model()->findByPk($_SESSION['loginID']); 
			$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
  			if($dUsuario->perfil==2 or $oRecord->uid==1 or $dUsuario->perfil==3 or $dUsuario->perfil==4){
				//$aData=$this->fevaluacion("simulacro","Simulacro"); 
				$aData["dUsuario"]=$dUsuario;
				$aData["oRecord"]=$oRecord;
 				$this->_renderWrappedTemplate('pcos', 'seguimientoepidemiologico', $aData);
			}
		}		
		
	}
	public function fevaluacion($tipo,$titulo){
		Yii::app()->cache->flush();
		$model=new EvalEvaluacion;
		$aData["model"]=$model; 
		$aData["formulario"]=$model->attributeLabels(); 
		$aData["tipo"]=$tipo;
		$rex = Yii::app()->db->createCommand("DESCRIBE {{eval_evaluacion}}");
		$res=$rex->queryAll();	
		$aData["estructura"]=$res;
		$aData["titulo"]=$titulo;
		//printVar($res);
		$aData["usuario"]=NULL; 
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
		$iduseval=0;
		if(isset($oRecord->iduseval)){
			$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
			$criteria = new CDbCriteria;
			$criteria->condition = ' id in ('.$dUsuario->id_unidad.')';
 			$empresa = Organizacion::model()->findAll($criteria);
			$aData["usuario"]=$dUsuario;
			$aData["empresas"]=$empresa;
			$iduseval=$dUsuario->id;
  		}
		 
		if(isset($_POST["EvalEncuesta"])){
			$exclude=array("id","idus","estado","fecharegistro","fechaactualizacion",'jsonsut',"jsonequipo");
			foreach($res as $data){
				if(!in_array($data["Field"],$exclude)){
					if($_POST["EvalEncuesta"][$data["Field"]]!=""){
						if($data["Field"]=="fecha"){
							list($d,$m,$a)=explode("-",$_POST["EvalEncuesta"][$data["Field"]]);
							$_POST["EvalEncuesta"][$data["Field"]]=$a."-".$m."-".$d;
						}
						$model->{$data["Field"]}=$_POST["EvalEncuesta"][$data["Field"]];
					}
				}
			}
			if($dUsuario->perfil==4){	//EL tecnico actualiza datos de la empresa
				 
				$criteria = new CDbCriteria;
				$criteria->condition = ' id = '.$model->idorg;
				$up = Organizacion::model()->find($criteria);
				if(isset($up->id)){
					$up->nombre=$model->nombreempresa;
					$up->direccion=$model->direccionempresa;
					$up->ciudad=$model->ciudaddepartamento;
					$up->nit=$model->nit;
					$up->telefono=$model->telefono;
					$up->fax=$model->fax;
					$up->representantelegal=$model->representantelegal;
					$up->docidentidadrep=$model->docrepresentante;
					$up->nombrecontacto=$model->nombrecontacto;
					$up->docidentidadcontacto=$model->doccontacto;
					$up->emailcontacto=$model->emailcontacto;
					$up->actividadeconomica=$model->actividadeconomica;
					$up->save();
				} 
				 
			
			}
			$sut=array();
			foreach($_POST["EvalEncuesta"]["sut"] as $d){
				array_push($sut,(object)array("sede"=>$d[0],"ubicacion"=>$d[1],"ntrab"=>$d[2]));
			}
			
			$dee=array();
			foreach($_POST["EvalEncuesta"]["dee"] as $d){
				array_push($dee,(object)array("nomev"=>$d[0],"doc"=>$d[1],"cargo"=>$d[2]));
			}
			
			$model->idus=$iduseval;
			$model->jsonsut=json_encode($sut);
			$model->jsonequipo=json_encode($dee);
			$model->fecharegistro=date("Y-m-d H:i:s");
			$model->fechaactualizacion=date("Y-m-d H:i:s");
 			$model->save();
			echo json_encode(array("id"=>$model->id));exit;
			
		}		
		return $aData;
	}
	
    public function recursos()
    {  
		$this->_renderWrappedTemplate('pcos', 'recursos', array("nada"=>""));
	}
    public function documentacion()
    {  
		Yii::app()->cache->flush();
		$aData["oRecord"] = User::model()->findByPk($_SESSION['loginID']); 
		$aData["usuario"] = EvalUsuarios::model()->findByPk($aData["oRecord"]->iduseval);
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
		
 		$criteria = new CDbCriteria;
		$criteria->condition = ' tipo="documentos"  and estado="si"'.$q;
		$criteria->order=" id DESC";
		$aData["archivos"]=EvalArchivos::model()->findAll($criteria);
		$anios=array();
		foreach($archivos as $data){
			list($a,$m,$dh)=explode("-",$data->fecha);
			if(!isset($anios[$a])){
				$anios[$a]=$a;
			}
 		}
		$aData["anio"]=$anios;
 		$this->_renderWrappedTemplate('pcos', 'docspcos', $aData);
 		//$this->_renderWrappedTemplate('pcos', 'documentacion', $aData);
 		 
    }
	
    public function simulacro()
    {  Yii::app()->cache->flush();
		if(isset($_SESSION['loginID'])){
 			$oRecord = User::model()->findByPk($_SESSION['loginID']); 
			$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
  			if($dUsuario->perfil==6 or $dUsuario->perfil==7 or $oRecord->uid==1  or $dUsuario->perfil==4  or $dUsuario->perfil==3){
				$aData=$this->fevaluacion("simulacro","Simulacro");
				$aData["dUsuario"]=$dUsuario;
				$aData["oRecord"]=$oRecord; 
 				$this->_renderWrappedTemplate('pcos', 'formulario', $aData);
			}
		}
		 
    }
    public function interno()
    {  Yii::app()->cache->flush();
		if(isset($_SESSION['loginID'])){
 			$oRecord = User::model()->findByPk($_SESSION['loginID']); 
			$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
  			if($dUsuario->perfil==6 or $dUsuario->perfil==3 ){
				$aData=$this->fevaluacion("interno","Auditoría Interna");
				$this->_renderWrappedTemplate('pcos', 'formulario', $aData);
			}
		}
		 
    }
    public function externo()
    {  Yii::app()->cache->flush();
		if(isset($_SESSION['loginID'])){
 			$oRecord = User::model()->findByPk($_SESSION['loginID']); 
			$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
  			if($dUsuario->perfil==7 or $dUsuario->perfil==3){
				$aData=$this->fevaluacion("externo","Auditoría Externa");
				$this->_renderWrappedTemplate('pcos', 'formulario', $aData);
			}
		}
		 
    }
	public function filesup(){
		//$this->getController()->redirect(array('admin/hseq/','r'=>$error)); 
 		if(isset($_POST["save"])){
			$urlbase=$_SERVER["DOCUMENT_ROOT"].Yii::app()->baseUrl;
  			//comprobamos que sea una petición ajax
			
			if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
			{
				 
				//obtenemos el archivo a subir
				$file = $_FILES['archivo']['name'];
			 
				//comprobamos si existe un directorio para subir el archivo
				//si no es así, lo creamos
				$extencion=explode(".",$file);
				$extencion=strtolower($extencion[count($extencion)-1]); 
				$narch=RandomString(30).".".$extencion; 
				//comprobamos si el archivo ha subido
				$permitido=array("jpg","jpeg","png","gif","gift","pdf","doc","docx","xls","xlsx","ppt","pptx","html","htm","txt");
 				if ($file && move_uploaded_file($_FILES['archivo']['tmp_name'],$urlbase."/files/pcos/".$_POST["tipo"]."/".$narch) && in_array($extencion,$permitido))
				{
					$images=array("jpg","JPG","JPEG","jpeg","png","PNG","GIFT","gif","gift","GIF");
					if(in_array($extencion,$images)){
						//$this->optimizar($urlbase."/files/pcos/".$_POST["tipo"]."/".$narch);
					}
					$nombre = str_replace(
					array('"',"'", 'select', 'delete', 'update', 'show', 'table', '.',";"),
					array('','', '', '', '', '', '', '',''),
					strtolower($_POST["nombre"])
					); 
 					$tipo = array("gestores","empresas","documentos");
					$t="";
					if(in_array($_POST["tipo"],$tipo)){
						$t=$_POST["tipo"];
					}
					if($t!=""){
						$fini=date("Y-m-d H:i:s");
						if($_POST["fechainicio"]!=""){
							$fini=$_POST["fechainicio"];
						}
						if($_POST["fechafin"]!=""){
							$fini=$_POST["fechafin"];
						}
						
						$set = EvalArchivos::model()->findByPk((int)$_POST["id"]);
						if(isset($set->id)){
							if(file_exists($urlbase."/files/pcos/".$_POST["tipo"]."/".$set->descriptcion)){
								unlink($urlbase."/files/pcos/".$_POST["tipo"]."/".$set->descriptcion);
							} 		
							$set->nombre=ucwords(trim($nombre));
							$set->fechaini=$fini;
							if($_POST["fechafin"]!=""){
								 $set->fechafin=$_POST["fechafin"];
							}
							$set->descriptcion=$narch;
							$set->save();
							$this->getarchivos($t,false," and estado='no'");						   
						   exit;
						}else{						
						
						   $set=new EvalArchivos();
						   $set->tipo=$t;
						   $set->nombre=ucwords(trim($nombre));
						   $set->descriptcion=$narch;
						   $set->fechaini=$fini;
							if($_POST["fechafin"]!=""){
								 $set->fechafin=$_POST["fechafin"];
							}					   
						   $set->fecha=date("Y-m-d H:i:s");
						   $set->save();
							sleep(3);//retrasamos la petición 3 segundos
						}
						sleep(3);//retrasamos la petición 3 segundos
						$this->getarchivos($t,false," and estado='no'","ALL");
					}else{
						unlink($urlbase."/files/pcos/".$_POST["tipo"]."/".$narch);
					
					}exit;
				  // echo $file;//devolvemos el nombre del archivo para pintar la imagen
				}else{
				
				
					$set = EvalArchivos::model()->findByPk((int)$_POST["id"]);
					$tipo = array("gestores","empresas","documentos");
					$t="";
					if(in_array($_POST["tipo"],$tipo)){
						$t=$_POST["tipo"];
					}
					if(isset($set->id)){
						$nombre = str_replace(
						array('"',"'", 'select', 'delete', 'update', 'show', 'table', '.',";"),
						array('','', '', '', '', '', '', '',''),
						strtolower($_POST["nombre"])
						);				
						$fini=date("Y-m-d H:i:s");
						if($_POST["fechainicio"]!=""){
							$fini=$_POST["fechainicio"];
						}
						if($_POST["fechafin"]!=""){
							$fini=$_POST["fechafin"];
						}
					   $set->nombre=ucwords(trim($nombre));
					   $set->fechaini=$fini;
						if($_POST["fechafin"]!=""){
							 $set->fechafin=$_POST["fechafin"];
						}
						$set->save();
						$this->getarchivos($t,false," and estado='no'");						   
						exit;
					}				
				
				
				}
				 
			}else{
				
				 throw new Exception("Error Processing Request", 1);   
			}			
  			exit;
 		}
		if(isset($_POST["delete"])){
			
		}
		
	}
    public function gestores()
    {  	Yii::app()->cache->flush();
		if(isset($_SESSION['loginID'])){
 			$oRecord = User::model()->findByPk($_SESSION['loginID']); 
			$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
			
 			if($oRecord->uid==1){
				$aData["idorg"]=1;
				if($dUsuario->perfil==3){
					$aData["idorg"]=$dUsuario->id_unidad;
				}
				$aData["titulo"]="Gestores";
				$aData["url"]="gestores";
 				$archivos=$this->getarchivos("gestores",true," and estado='no'");
 				$aData["archivos"]=$archivos;
 				$activos=$this->getarchivos("gestores",true," and estado='si'");
 				$aData["activos"]=$activos;
				$json=$this->getarchivos("gestores",true);
 				$aData["json"]=$json[1];
				 
  				$this->_renderWrappedTemplate('pcos', 'archivos', $aData);
			}
		}
		 
    }
	
    public function empresas()
    {  	Yii::app()->cache->flush();
		if(isset($_SESSION['loginID'])){
 			$oRecord = User::model()->findByPk($_SESSION['loginID']); 
			$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
  			if($oRecord->uid==1){
				$aData["idorg"]=1;
				if($dUsuario->perfil==3){
					$aData["idorg"]=$dUsuario->id_unidad;
				}
				$aData["titulo"]="Empresas";
				$aData["url"]="empresas";
 				$archivos=$this->getarchivos("empresas",true," and estado='no'");
 				$aData["archivos"]=$archivos;
 				$activos=$this->getarchivos("empresas",true," and estado='si'");
 				$aData["activos"]=$activos;
				$json=$this->getarchivos("empresas",true);
 				$aData["json"]=$json[1];
 				$this->_renderWrappedTemplate('pcos', 'archivos', $aData);
			}
		}
		 
    }
	public function getarchivos($tipo,$return=false,$query="",$todos="NO"){
		$criteria = new CDbCriteria;
		$criteria->condition = ' tipo="'.$tipo.'" '.$query;
		$criteria->order=" idorg ASC";
		$archivos=EvalArchivos::model()->findAll($criteria);
		$arc=array();
		foreach($archivos as $data){
			$arc["id_".$data->id]=(object)array("estado"=>$data->estado,"id"=>$data->id,"tipo"=>$data->tipo,"idorg"=>$data->idorg,"nombre"=>$data->nombre,"descriptcion"=>$data->descriptcion,"fechaini"=>$data->fechaini,"fechafin"=>$data->fechafin,"fecha"=>$data->fecha);
 		}
		if($return==false){
			if($todos==="ALL"){
				$criteria = new CDbCriteria;
				$criteria->condition = ' tipo="'.$tipo.'" ';
				$criteria->order=" idorg ASC";
				$archivos=EvalArchivos::model()->findAll($criteria);
				$arc2=array();
				foreach($archivos as $data){
					$arc2["id_".$data->id]=(object)array("estado"=>$data->estado,"id"=>$data->id,"tipo"=>$data->tipo,"idorg"=>$data->idorg,"nombre"=>$data->nombre,"descriptcion"=>$data->descriptcion,"fechaini"=>$data->fechaini,"fechafin"=>$data->fechafin,"fecha"=>$data->fecha);
				}
				echo json_encode(array($arc,json_encode($arc2)));exit;
			}else{
				echo json_encode(array($arc,json_encode($arc)));exit;
			}
			
		}else{
			return array($arc,json_encode($arc));
		}
	}
	
    public function documentos()
    {  	Yii::app()->cache->flush();
		if(isset($_SESSION['loginID'])){
 			$oRecord = User::model()->findByPk($_SESSION['loginID']); 
			$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
 			if($dUsuario->perfil==3 or $oRecord->uid==1){
				$aData["idorg"]=1;
				if($dUsuario->perfil==3){
					$aData["idorg"]=$dUsuario->id_unidad;
				}
				$aData["titulo"]="Documentos";
				$aData["url"]="documentos";
  				$archivos=$this->getarchivos("documentos",true," and estado='no'");
 				$aData["archivos"]=$archivos;
 				$activos=$this->getarchivos("documentos",true," and estado='si'");
 				$aData["activos"]=$activos;
				$json=$this->getarchivos("documentos",true);
 				$aData["json"]=$json[1];
 				$this->_renderWrappedTemplate('pcos', 'archivos', $aData);
 			}
		}
		 
    }
	
	public function optimizar($fullName,$w=125,$h=92,$p=70){
		// IMAGEN ORIGINAL..EN ALTA RESOLUCION.
		//$fullName = '/anypath/image.jpg';
 		// OBTENER INFORMACION DE LA IMAGEN ORIGINAL.
		list($ow, $oh, $xmime) = getimagesize($fullName);
		$imageSize = filesize($fullName);
		$mime = '';
		if($xmime == 2) $mime = 'image/jpg';
		if($xmime == 3) $mime = 'image/png';
 		// LEER LA IMAGEN ORIGINAL
		$f = fopen($fullName,"r");
		$imageData = fread($f, $imageSize);
		fclose($f);
 		// HACER EL RESIZE A 160 x 120 px, con 70% de compresion JPEG  
		
		$r = new ImageResizer();
		$newImage = $r->resize($imageData, $w,$h, $p, 'jpg', $ow, $oh);
 			// EMITIR LA IMAGEN
		//header('Content-type: '.$mime);
		$fp = fopen($fullName, "w+");
		fputs($fp, $newImage);
		fclose($fp);
   	}	
	
	
	
    public function index()
    {   
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
 		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
		$idusuario=NULL;
		$hseqdisp=array();
		if(isset($dUsuario->id)){
			$idusuario=$dUsuario->id;
			$criteria = new CDbCriteria;
			$criteria->condition = ' idorg='.$dUsuario->id_unidad;
			$hseqdisp=Ushseq::model()->findAll($criteria);
			//printVar($hseqdisp);
			
			
		}
		
		$data["hseqdisp"]=$hseqdisp;
 		
		$this->_renderWrappedTemplate('hseq', 'index',$data);
    }
	
	public function action(){
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
 		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
  		if($dUsuario->perfil==3 or $oRecord->uid==1){
 			switch($_POST["action"]){
				case "del":
					$model=$this->loadModel((int)$_POST["id"]);
  					$arch="/var/www".Yii::app()->baseUrl."/files/pcos/".$_POST["tipo"]."/".$archivos->descriptcion;
 					if(isset($model->id)){
 						$this->loadModel($model->id)->delete();
						if(file_exists($arch)){
							unlink($arch);
						}
  					}
 					$this->getarchivos($_POST["tipo"]);exit;
				break;
				case "add":
					/*
					$elementos=$this->getarchivos($_POST["tipo"],true);
					foreach($elementos[0] as $data){
						$model = EvalArchivos::model()->findByPk($data->id);
						$model->estado="no";
						$model->save();
					}
					*/
					 
					$elementos=$this->getarchivos($_POST["tipo"],true," and estado='si'");
 					$model = EvalArchivos::model()->findByPk((int)$_POST["id"]);
					$model->estado="si";
					$model->idorg=count($elementos[0])+1;
					$model->save();	exit; 			
				break;
				case "remove":
 					$model = EvalArchivos::model()->findByPk((int)$_POST["id"]);
					$model->estado="no";
					$model->idorg=0;
					$model->save();	exit; 			
 				break;
				
			}
		
		
		}	
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
		
 		if((isset($dUsuario->id) and ($dUsuario->perfil==3 or $dUsuario->perfil==2 or $dUsuario->perfil==4 or $dUsuario->perfil==6 or $dUsuario->perfil==7)) or $oRecord->uid==1){
			
			if($oRecord->uid==1 or $dUsuario->perfil==3 or $dUsuario->perfil==4  or $dUsuario->perfil==2 ){
				if($dUsuario->perfil==1){

					$empresas=Organizacion::model()->findAll();
				}else{
					$dat = new CDbCriteria;
					$dat->condition = "id in (".$dUsuario->id_unidad.")";
					$empresas=Organizacion::model()->findAll($dat);				
 				}
				$jemp=array();
				foreach($empresas as $dataemp){
					array_push($jemp,$dataemp->id);
				}
 				if(isset($_POST["chart"])  ){
					$query=array();
					if(isset($_POST["idorg"]) and (int)$_POST["idorg"]>0){
						array_push($query,"idorg=".(int)$_POST["idorg"]);
					}
					if(isset($_POST["visita"]) and $_POST["visita"]!=""){
						array_push($query,$_POST["visita"]."='Y'");
					}
					if(isset($_POST["tipo"]) and $_POST["tipo"]!=""){
						array_push($query,"tipoeval='".$_POST["tipo"]."'");
					}
					if((int)$_POST["idform"]>0){
						array_push($query,"id=".(int)$_POST["idform"]);
					}
					array_push($query,"estado='S'");  
					if($query[0]!=""){
						$dat = new CDbCriteria;
						$dat->condition = join(" and ",$query);
						$dat->order="id DESC";
						$evaluaciones=EvalEvaluacion::model()->findAll($dat);
					}else{
						$dat = new CDbCriteria;
 						if($dUsuario->perfil==1){
							$dat->condition = "id >0";
							$dat->order="id DESC";
						}else{

							$dat->condition = "idorg in (".join(",",$jemp).")";
							$dat->order="id DESC";
						}
						$evaluaciones=EvalEvaluacion::model()->findAll($dat);
					}
 				} 
				else{
					$dat = new CDbCriteria;
					if( $dUsuario->perfil==2){
 						$dat->condition = "id >0";
						$dat->order="id DESC";						
					}else{
						$dat->condition = "idorg in (".join(",",$jemp).")";
						$dat->order="id DESC";
					}
					$evaluaciones=EvalEvaluacion::model()->findAll($dat);
				} 
				if((int)$_POST["idform"]>0){
					$queryString = "
					SELECT 
					COUNT(*) as total
					FROM lime_cubo_984333
					WHERE idform ='".(int)$_POST["idform"]."'"; // printVar($queryString);exit;
					$eguresult = dbExecuteAssoc($queryString);
					$tdatacubo = $eguresult->readAll();	
					$r=array();
					foreach($tdatacubo as $data){
						array_push($r,$data);
						
					}
 					$data["total"]=$r[0]["total"];
					
				} 				
 			}else{  
				$dat = new CDbCriteria;
				$dat->condition = "id in (".$dUsuario->id_unidad.")";
 				$empresas=Organizacion::model()->findAll($dat);
				if(isset($_POST["chart"])  ){
					$query=array("idus=".$dUsuario->id);
					if(isset($_POST["idorg"]) and (int)$_POST["idorg"]>0){
						array_push($query,"idorg=".(int)$_POST["idorg"]);
					}
					if(isset($_POST["visita"]) and $_POST["visita"]!=""){
						array_push($query,$_POST["visita"]."='Y'");
					}
					if(isset($_POST["tipo"]) and $_POST["tipo"]!=""){
						 
						array_push($query,"tipoeval='".$_POST["tipo"]."'"); 
					}
					if((int)$_POST["idform"]>0){
						array_push($query,"id=".(int)$_POST["idform"]);
					}
					array_push($query,"estado='S'");
					//printVar(join(" and ",$query));exit;
   					$dat = new CDbCriteria;
					$dat->condition = join(" and ",$query) ;
					$dat->order="id DESC";
					$evaluaciones=EvalEvaluacion::model()->findAll($dat);
 				}else{
					$dat = new CDbCriteria;
					$dat->condition = " idus=".$dUsuario->id;
					$dat->order="id DESC";
					$evaluaciones=EvalEvaluacion::model()->findAll($dat);
				}
				if((int)$_POST["idform"]>0){
					$queryString = "
					SELECT 
					COUNT(*) as total
					FROM lime_cubo_984333
					WHERE idform ='".(int)$_POST["idform"]."'"; // printVar($queryString);exit;
					$eguresult = dbExecuteAssoc($queryString);
					$tdatacubo = $eguresult->readAll();	
					$r=array();
					foreach($tdatacubo as $datachecklist){
						array_push($r,$datachecklist);
						
					}
 					$data["total"]=$r[0]["total"];
					
				}
 				
			}
			$objemp=array();
			foreach($empresas as $datar){
				$arrt=array();
				foreach($datar  as $k=>$v){
					$arrt[$k]=$v;
				}
				array_push($objemp,(object)$arrt);
			}
			$objeval=array();
			foreach($evaluaciones as $datar){
				$arrt=array();
				foreach($datar as $k=>$v){
					$arrt[$k]=$v;
				}
				array_push($objeval,(object)$arrt);
			}
 			
			
			$data["empresas"]= $objemp;
			$data["evaluaciones"]= $objeval;
			
  			$data["token"]=$this->getTokenpentaho();
			
			if(!isset($_POST["chart"])){
				$this->_renderWrappedTemplate('pcos', 'reportes', $data);
			}else{
				if($_POST["resumen"]=="descargar" or $_POST["resumen"]=="accioneval"){
					$idEvaluacion=$objeval[0]->id;
					$queryString = "
					SELECT 
					*
					FROM lime_cubo_984333
					WHERE idform ='".$idEvaluacion."'"; // printVar($queryString);exit;
					$eguresult = dbExecuteAssoc($queryString);
					$tdatacubo = $eguresult->readAll();	
					$r=array();
					$contador=0;
					$validar=array("984333X68X2091","984333X68X2092","984333X68X2093","984333X68X2094","984333X68X2095");
 					
					$subgrupos=array("68"=>array('4'),
									"78"=>array('7','6','2'),
									'89'=>array('7','5','4','9','5'),
									'91'=>array('6','5','13'),
									'93'=>array('5','11'),
									'94'=>array('7','3','6','18'),
									'95'=>array('6','5'),
									);
					$csub=0;
					$controlsub=array();
 					foreach($tdatacubo[0] as $k=> $datachecklist){
						 
						$test=explode("984333X",$k);
						$test2=strpos($k,"comment");
						
						if(isset($test[1]) and $test2===false and !in_array($k,$validar)){
							$idq=explode("X",$test[1]);
							$queryString = "
							SELECT 
							*
							FROM lime_questions
							WHERE qid ='".$idq[1]."'"; // printVar($queryString);exit;
							$eguresult = dbExecuteAssoc($queryString);
							$question = $eguresult->readAll();	
 								$comentarios="";
								if(isset($tdatacubo[0][$k."comment"])){
									$comentarios=$tdatacubo[0][$k."comment"];
									if($comentarios=="NR"){
										$comentarios="";
									}
								}
 								
								$queryString = "
								SELECT 
								*
								FROM lime_groups
								WHERE gid ='".$idq[0]."'"; // printVar($queryString);exit;
								$eguresult = dbExecuteAssoc($queryString);
								$grupos = $eguresult->readAll();									
								 
								if($datachecklist!="N"){
									$datachecklist=(int)$datachecklist;
 								} 
   								$r[$contador]=(object)array("codigo"=>$k,"gid"=>$idq[0],"grupo"=>$grupos[0]['group_name'],"promedio"=>0,"cumplimiento"=>0,"pregunta"=>$question[0]["question"],"respuesta"=>$datachecklist,"comentario"=>$comentarios);
								$contador++; 
 						}
 					}
					
					if(count($r)>0){
						$tr=array();
						$acumulados=array();
						$totales=array();
						$ctcont=0;
						foreach($r as $k=>$v){
							if($v->respuesta!="N"){
								if(!isset($acumulados[$v->gid])){
									$acumulados[$v->gid]=0;
									$ctcont=0;
								}
 								$acumulados[$v->gid]=(int)$acumulados[$v->gid]+(int)$v->respuesta;
								$ctcont++;
								$totales[$v->gid]=$ctcont+1;
									//printVar($acumulados[$v->gid],$ctcont."=>".$v->gid."=>".$v->pregunta."=>".(int)$v->respuesta); 
								
							}
							
						}
						
						foreach($r as $k=>$v){
							
							//if(is_numeric($v->respuesta)){ 
								$r[$k]->promedio=$acumulados[$v->gid]/$totales[$v->gid];
								$r[$k]->cumplimiento=number_format((($acumulados[$v->gid]*100)/($totales[$v->gid]*3)),2,",","");
								
							//} 
							
							
						}
 					}
					
					$data["checklist"]=$r;
				}
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
	
	public function loadModel($id)
	{
		$model=EvalArchivos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
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