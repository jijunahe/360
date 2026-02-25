<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 // error_reporting(E_ALL); ini_set('display_errors', '1');
$documentroot=str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"]);
require_once($documentroot.'application/extensions/PHPMailer/class.phpmailer.php');
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
 
  	function __construct($controller, $id)
    {
        parent::__construct($controller, $id);

        Yii::app()->loadHelper('database');
 		$this->kp= $this->kp.substr($this->kp,0,8);
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
  	
	public function proyecto(){
		
		
		 Yii::app()->cache->flush();
	    
		if(isset(Yii::app()->user->id)){
			if((int)Yii::app()->user->id>0){     
				$oRecord = User::model()->findByPk(Yii::app()->user->id); 
				 $aData=array();
				$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
 				$aData=$this->getLanguagetemplates();
 				$listaperfiles = AnaRol::model()->findAll();
 				
 			//	printVar($idioma);
  				$aData["usuariomodel"]=$dUsuario;
				$aData["perfilusuarior"]=$dUsuario->perfil;
				$aData["validaini"]="OK";
				$aData["imageurl"]=Yii::app()->baseUrl;
				$aData["mensaje"]="";
				$validaeditar=AnaUsuario::model()->vaidausr(false);
				$template="nuevo";
				$aData["tipoproyecto"]=AnaEncuestaTipoproyecto::model()->findAll();
				if(isset($_GET["mode"])){
					switch($_GET["mode"]){
						case "nuevo":$template="nuevo";
							//printVar($_COOKIE);
							if($_COOKIE["key"]!=""){
								
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
						
						
						break;
						case "ver":$template="ver";
						
							$dat = new CDbCriteria;
							$dat->condition = "idUsuario = '".Yii::app()->user->id."'";
							$dat->order="fechacreacion DESC";
							//printVar($dat);exit;
							$proyectos=AnaProyecto::model()->findAll($dat);	
							
							$aData["proyectos"]=$proyectos;
							//printVar($aData["proyectos"]);
						
 						break;
					}
				}
				
				if(isset($_POST["mode"])){
					switch($_POST["mode"]){
						case "ver":
							//printVar("JAJAJAAJAJAJAJ");
							
							$dat = new CDbCriteria;
							$dat->condition = "keyid = '".$_POST["keyid"]."' and idUsuario = '".Yii::app()->user->id."'";
 							//printVar($dat);exit;
							$proyecto=AnaProyecto::model()->find($dat);	
							
							if(isset($proyecto->keyid)){
								echo json_encode(array("ok",array("keyid"=>$proyecto->keyid,"nombre"=>$proyecto->nombre,"bienvenida"=>$proyecto->bienvenida,"tipoproyecto"=>$proyecto->tipoproyecto)));exit;
							}else{echo json_encode(array("no"));exit;}							
 							
						break;
						case "nuevo":
							$key=$this->generarKey();
							 
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
							$data->idUsuario=Yii::app()->user->id;
							$data->idUsuarioact=Yii::app()->user->id;
							$data->fechacreacion=date("Y-m-d H:i:s");
							$data->fechaactualizacion=date("Y-m-d H:i:s");
							$data->tipoproyecto=$_POST["tipoproyecto"];
							$data->bienvenida=$_POST["bienvenida"];
							if($_POST["clave"]!=""){
								$data->clave=$_POST["clave"];
							}
							//printVar($data);exit; 
							$data->save();
							echo json_encode(array("key"=>$key));
						break;
						case "actualizar":
							$dat = new CDbCriteria;
							$dat->condition = "keyid = '".$_POST["key"]."' and idUsuario=".(int)Yii::app()->user->id;
							//printVar($dat);exit;
 							$pro=AnaProyecto::model()->find($dat);//printVar($pro);exit; 	
							if(isset($pro->keyid)){
								$pro->nombre=$_POST["nombreproyecto"];
								$pro->clave=$_POST["clave"];
								$pro->fechaactualizacion=date("Y-m-d H:i:s");
								$pro->idUsuarioact=(int)Yii::app()->user->id;
								$pro->save(); 
								echo json_encode(array("ok"));exit;
							}else{echo json_encode(array("no"));exit;}
						break;
						case "get":
							switch($_POST["get"]){
								/**** COMPETENCIAS ****/
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
											//printVar($dat);
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
									$id="";
									if(isset($_POST["id"])){
										$id=" and id=".(int)$_POST["id"];
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
												$datos[$k]=$v;
											}
											 array_push($template,(object)$datos);
										}
										
 										echo json_encode(array("ok",$template));exit;
									}else{echo json_encode(array("no"));exit;}								
 								
								break;								
								case "actualizar_mailing":
									$id="";
									if(isset($_POST["id"])){
										$id=" and id=".(int)$_POST["id"];
									}
 									$dat = new CDbCriteria;
									$dat->condition = "keyidproyecto = '".$_POST["key"]."' ".$id; 	
 									//printVar($dat);exit;
									$tem=AnaEmailtemplate::model()->find($dat); 								
									if(isset($tem->id)){
										$tem->nombre=$_POST["nombre"];
										$tem->html=$_POST["html"];
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
										"params"=>$arrayparam
									));
									 
									printVar($dat);   
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
									$tem->keyidproyecto=$_POST["key"]; 
									$tem->fecha=date("Y-m-d H:i:s"); 
									$tem->save();
 									echo json_encode(array("ok"));exit;
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
 									$dat = new CDbCriteria;
									$dat->condition = "keyidproyecto = '".$_POST["keyproyecto"]."'  and keyid='".$_POST["keyid"]."'"; 	
 									//printVar($dat);exit;
									$escala=AnaEncuestaEscala::model()->find($dat); 
									
									if(isset($escala->keyidproyecto)){
										$escala->nombre=$_POST["nombre"];
										$escala->abreviacion=$_POST["abreviacion"];
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
									$dat->order ="apellido ASC";
									//printVar($dat);exit;
 									$participante=AnaParticipante::model()->findAll($dat);	
									if(isset($participante[0]->keyproyecto)){
										$norm=array();
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
											$norm[$k]=(object)$temporal;
										}
										
										
										$dat = new CDbCriteria;
										$dat->condition = "keyproyecto = '".$_POST["keyidproyecto"]."' and estado='S'";
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
									$dat->order ="apellido ASC";
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
								
								case "participante":
									$dat = new CDbCriteria;
									$dat->condition = "keyid = '".$_POST["key"]."'";
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
									if(isset($participante->keyproyecto)){ $participante->delete();
										 
										echo json_encode(array("ok"));exit;
									}else{echo json_encode(array("no"));exit;}
								break;
								
								/*COMPETENCIAS POR EVALUADO*/
								case "competenciasxevaluado":
									$dat = new CDbCriteria;
									$dat->condition = "keyproyecto = '".$_POST["key"]."' and retroalimentacion='S'";
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
							 //printVar($dat);exit;
							$p=AnaParticipante::model()->find($dat);
							if(isset($p->keyid)){
								$p->apellido=$_POST["apellido"];
								$p->nombre=$_POST["nombre"];
								$p->email=$_POST["email"];
								$p->clave=$_POST["clave"];
 								$p->retroalimentacion=$_POST["retroalimentacion"];
								$p->fechaactualizacion=date("Y-m-d H:i:s");
								$p->save(); 
								echo json_encode(array("ok"));exit;
							}else{
								echo json_encode(array("no"));exit;
							}
						break;
						case "agregarparticipante":
							$key=$this->generarKey();

							$dat = new CDbCriteria;
							$dat->condition = "apellido = '".$_POST["apellido"]."' and nombre ='".$_POST["nombre"]."' and keyproyecto='".$_POST["keyproyecto"]."'  ";
							//printVar($dat);exit;
							$existe=AnaParticipante::model()->find($dat);		

							if(isset($existe->apellido)){
								if($existe->apellido==$_POST["apellido"]){
								echo json_encode(array("existe"=>"SI"));
								//echo json_encode(array("key"=>$key,"existe"=>"NO"));
								exit;
								}
							}

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
							$data->jsoncompetencias='{}';
							$data->idUsuario=Yii::app()->user->id;
 							$data->fecharegistro=date("Y-m-d H:i:s");
							if($_POST["retroalimentacion"]=="S"){
								$data->retroalimentacion="S";
							}
 							if($_POST["clave"]!=""){
								$data->clave=$_POST["clave"];
							}
							//printVar($data);exit; 
							$data->save();
							echo json_encode(array("key"=>$key,"existe"=>"NO"));
 						break;
						
 					}
					exit;
				}
				
				
				
 				$this->_renderWrappedTemplate('evaluacion',$template , $aData);
			}
		}
		
		
		
		
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
  				 
			// printVar($aData);exit;
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
	
}