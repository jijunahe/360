<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$documentroot=str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"]);
require_once($documentroot.'application/extensions/PHPMailer/class.phpmailer.php');
class Encuestas extends Survey_Common_Action
{
function __construct($controller, $id)
    {
        parent::__construct($controller, $id);

        Yii::app()->loadHelper('database');
    }

    /**
    * Show users table
    */
	public function getbaterias(){
 		$dat = new CDbCriteria;
		$subq='';
		if(!isset($_POST["valida"])){
			$subq=' and idusuariocrea='.(int)$_SESSION['loginID'];
		}
		$dat->condition = 'id_unidad='.(int)$_POST["id"].$subq;
		$te = Bateria::model()->findAll($dat);
		$arr=array();
		if(isset($te[0]->id)){
			foreach($te as $datos){
				array_push($arr,array("id"=>$datos->id,"nombre"=>$datos->nombre,"q"=> 'id_unidad='.(int)$_POST["id"].$subq));
			}
 		}
		echo json_encode($arr);exit;
	}
	
 	
     public function index()
    {
 		$aData=array();
 		if(isset($_POST["option"])){
		
			switch($_POST["option"]){
				case "addtipo":
					$dat = new CDbCriteria;
					$dat->condition = 'sid='.(int)$_POST["sid"];
					$te = TipoEncuesta::model()->find($dat);
					if(!isset($te->id)){
						$dat=new TipoEncuesta();
						$dat->sid=(int)$_POST["sid"];
						$dat->idtipo=(int)$_POST["tipo"];
						$dat->fecha=date("Y-m-d H:i:s");
						$dat->save();
						
					}else{
						$te->idtipo=(int)$_POST["tipo"];
						$te->fecha=date("Y-m-d H:i:s");
						$te->save();
 					}
				
				break;
				
			}
			
			
		}
		
       
		$aData["cunive"]=$this->selecUnidadesActivas();
		$aData["imageurl"]="/bateria/img/";
		$aData["rbase"]="/bateria/";
 		$encuestas = SurveyLanguageSetting::model()->findAll();
 		$tipos = Tipo::model()->findAll(); 
		$aData["encuestas"]=$encuestas;
		$aData["tipos"]=$tipos;
		$tipoencuesta=array();
		foreach($encuestas as $values){
			$dat = new CDbCriteria;
			$dat->condition = 'sid='.$values->surveyls_survey_id;
			$te = TipoEncuesta::model()->find($dat);
			$idtipo=0;
			if(isset($te->id)){
				$idtipo=$te->idtipo;
			}
			$tipoencuesta[$values->surveyls_survey_id]=$idtipo;
 			unset($dat);
		}
		$aData["tipoencuesta"]=$tipoencuesta; 
		
 		$oRecord = User::model()->findByPk($_SESSION['loginID']);
		 
		$role=-1;
		if(isset($oRecord->iduseval)){
			$dUsuario=EvalUsuarios::model()->selectUsuarioById($oRecord->iduseval);
			if(isset($dUsuario->perfil)){
				$role=$dUsuario->perfil; 
			}
		}
 		
		if($oRecord->iduseval>0 and ($role==2 or $role==4)){
			$this->_renderWrappedTemplate('super', 'firststeps');
		}else{
			if($role==3){
				$this->_renderWrappedTemplate('encuestas', 'administrador', $aData);
			}else{
				$this->_renderWrappedTemplate('encuestas', 'index', $aData);
			}
		}
    }
	
	public function reportes(){
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
 		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
 
 		if($oRecord->users_name=="root" or $dUsuario->perfil==3 or $dUsuario->perfil==4){
 			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,"https://www.talentracking.co/user-token-session");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "apiId=3&apikey=1edf9f14dd7f29b7fed31b55594df322&email=oscar&operation=login");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			
			$server_output = curl_exec ($ch);
			$res=json_decode($server_output);
			curl_close ($ch);
			//printVar($res->token);
			$aData["token"]=$res->token;
			$aData["node"]=216;
			if(isset($_POST["node"])){
				$nodos=array(216,225,226,227,228,246);
				if(in_array((int)$_POST["node"],$nodos)){
					$aData["node"]=(int)$_POST["node"];
				}
			}
			$filtro="";
			if(isset($_POST["empresa"])){
				$validarfiltro=array("empresa","duenio","bateria");
				$filtros=array("empresa"=>"idempresaSrt","duenio"=>"uidcreadorSrt","bateria"=>"idbateriaSrt");
				$tf=array();
				$test=array();
				foreach($_POST as $key=>$values){
					if(in_array($key,$validarfiltro)){
						if(!isset($test["param".$filtros[$key]])){
							array_push($tf,"param".$filtros[$key]."=".$values);
							$test["param".$filtros[$key]]=$values;
							$_SESSION[$key]=$values;
							setcookie($key, $values, time()+3600);
						}
					}
 				}
				$filtro=join("&",$tf);
				echo json_encode(array($filtro,$_POST["node"]));exit;
				 
			}
			
			if(!isset($_POST["empresa"])){
				$conunt=explode(",",$dUsuario->id_unidad); 
			  
				$filtro="paramidempresaSrt=".(int)$conunt[0];
				 
			}
			$aData["filtro"]=$filtro;
			$aData["unidades"]=$dUsuario->id_unidad;
 			$aData["perfil"]=$dUsuario->perfil;
			$aData["username"]=$oRecord->users_name;
			$aData["uid"]=$oRecord->uid;
			$this->_renderWrappedTemplate('encuestas', 'reportes', $aData);
		}else{
			printVar("No tiene permiso para ingresar aquí");exit;
		}
		
		
		
	}
	
	function sendmail($uss,$asunto,$html=NULL){
  		$htmlfinal.='<p>Cordial saludo, '.$uss["nombres"].':</p>
		<br>
		<p>Comprometidos con nuestro recurso humano, continuamos generando estrategias y actividades de mejoramiento continuo destinadas a promover la mejor condición de salud y prevenir enfermedades en nuestros trabajadores. En el cumplimiento  de este compromiso se hace necesario conocer las distintas condiciones que podrían estar afectando su salud.</p>
		<br>
		<p>A continuación encontrará el usuario y contraseña que le permitirán acceder a cuestionarios diseñados especialmente para evaluar los riesgos psicosociales, los cuales le invitamos a diligenciar con información verídica de su condición personal. Dicha Información será manejada con cuidadosa confidencialidad.</p>
		<br>
		<p>LA INFORMACIÓN QUE USTED BRINDE ES ESTRICTAMENTE CONFIDENCIAL, LOS RESULTADOS SERÁN EXPUESTOS DE MANERA GLOBAL PARA LA ORGANIZACIÓN.</p> 
		<br>
		<p>PASOS A SEGUIR PARA DILIGENCIAR LA ENCUESTA:</p>
		<br>
		<ol>
			<li>LEER CUIDADOSAMENTE INSTRUCCIONES</li>
			<li>HACER CLIK EN EL LINK PARA INGRESAR http://talentracking.com/bateria/admin/ </li>
			<li>DIGITE EL USUARIO QUE SE LE ASIGNO:Su usuario es: <b>'.$uss["alias"].'</b></li>
			<li>DIGITE LA CONTRASEÑA QUE SE LE ASIGNO:Su contraseña es: <b>'.$uss["clave"].'</b>  </li>
			<li>VERIFICAR LOS ITEMS DEL CUESTIONARIO SELECCIONADO ESTEN TODOS DILIGENCIADOS</li>
			<li>TIENE UN TIEMPO PARA CONTESTAR EL CUESTIONARIO DE 90 MINUTOS, UNA VEZ INICIE DEBE DAR TERMINACIÓN AL MISMO.</li> 
		</ol>
 		<br>
 		<p>Atentamente,</p>
		<br>
		<br>
		<p style="font-size: 12px;">
			MR ESTRATEGIAS EN SALUD
			AVISO LEGAL: La información enviada en este mensaje es confidencial de MR ESTRATEGIAS EN SALUD SAS y está dirigida únicamente para el uso de la persona o la entidad a la cual está dirigido. Si Usted no es el destinatario, le informamos que no podrá usar, retener, imprimir, copiar, distribuir o hacer público su contenido, de hacerlo podría tener consecuencias legales como las contenidas en la Ley 1273 del 5 de Enero de 2009 y todas las que le apliquen. Si usted es el destinatario, le solicitamos mantener reserva sobre el contenido a no ser que exista una autorización explícita. Si usted ha recibido esta comunicación por error, notifíquenos inmediatamente a mrestrategiasensalud@gmail.com y elimine el mensaje. Comprometidos con el medio ambiente le sugerimos no imprimir este mail a menos que lo considere absolutamente necesario. Para mayor información visite nuestro sitio web www.estrategiasensalud.com.co
		</p>';
 		
		$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
		$mail->Username   = "info@talentracking.com";  // GMAIL username
		$mail->Password   = "talentrack";            // GMAIL password
		//$mail->AddAddress($ussurvey[0]["email"], utf8_decode("Fundación Colombiana del Corazón"));
		$mail->AddAddress($uss["email"], utf8_decode($asunto));
		$mail->SetFrom('info@talentracking.com',  utf8_decode($asunto));
		$mail->AddReplyTo('fgutierrez@talentracking.com',  utf8_decode($asunto));
		$mail->Subject =  utf8_decode("Buen día.");
		$mail->MsgHTML($htmlfinal);
		$r=$mail->Send();	
		
		return $r;
 		
	
	}
	
	
	function bateria(){
  
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
		//printVar($oRecord);
		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
		if(isset($_POST["op"])){
			$opcionbat=$_POST["op"];
			if($oRecord->iduseval>0 and ($dUsuario->perfil==2 or $dUsuario->perfil==4) and ($opcionbat!="encuestas" or $opcionbat!="us")){
				$opcionbat="NR";
			}//VERIFICACION DE PERFILES
			$mensaje="";
			switch($opcionbat){
				case "NR":
				break;
				case "eliminarencp":
					if(isset($_POST["idbateria"],$_POST["idprogramacion"])){
						$idb=(int)$_POST["idbateria"];
						$idp=(int)$_POST["idprogramacion"];
						$queryc = "UPDATE {{programacion_encuesta}} set idbateria=0 WHERE idbateria=".$idb." and iduscrea=".(int)$_SESSION["loginID"]." AND id=".$idp;
						$gcrt = dbExecuteAssoc($queryc); 
					}
				break;
				case "eliminarbateria":
					if(isset($_POST["idbateria"])){
						$idb=(int)$_POST["idbateria"];
 						$queryc = "UPDATE {{programacion_encuesta}} set idbateria=0 WHERE idbateria=".$idb." and iduscrea=".(int)$_SESSION["loginID"];
						$gcrt = dbExecuteAssoc($queryc);
						
						$idb=(int)$_POST["idbateria"];
 						$queryc = "delete from {{bateria}} WHERE id=".$idb;
						$gcrt = dbExecuteAssoc($queryc);
 					}
				break;
				case "pobmas":
					if(isset($_POST["poblacion"],$_POST["idbateria"])){
						if((int)$_POST["idbateria"]>0){
							$poblacion=explode(",",$_POST["poblacion"]);
							$validad=array();
 							foreach($poblacion as $dato){
								array_push($validad,(int)$dato);
							}
 							$dat = new CDbCriteria;
							$dat->condition = 'idbateria='.(int)$_POST["idbateria"];
							$btt = ProgramacionEncuesta::model()->findAll($dat);
							$arrtestUss=array();
 							if(isset($btt[0]->id)){
								for($i=0;$i<count($validad);$i++){
									$usuario=$validad[$i];
 									foreach($btt as $dato){
 										$dat = new CDbCriteria;
										$dat->condition = 'idProgramacion='.$dato->id.' and idUsuario='.$usuario;
										$bt = UsuarioProgramacion::model()->find($dat);
										if(!isset($bt->id)){	
											unset($set);
											$set=new UsuarioProgramacion();
											$set->idUsuario=$usuario;
											$set->idProgramacion=$dato->id;
											$set->estado=0;
											$set->fechacreacion=date("Y-m-d H:i:s");
											$set->save();
										}	
 										
										if(!isset($bt->id) and !in_array($usuario,$arrtestUss)){
 											$queryc = "SELECT * FROM {{eval_usuarios}} where id=".$usuario;
											$gcrt = dbExecuteAssoc($queryc);
											$ussurvey = $gcrt->readAll();
 											
											$uss=array("nombres"=>$ussurvey[0]["nombres"],"apellidos"=>$ussurvey[0]["apellidos"],"alias"=>$ussurvey[0]["alias"],"clave"=>$ussurvey[0]["clave"],"email"=>$ussurvey[0]["email"]);
											$this->sendmail($uss,'Batería de encuestas');
  											array_push($arrtestUss,$usuario); 						
  										}
										 
									}
									 
								} 
 							}
						}
					}
				break;
				case "addencp":
					if(isset($_POST["encuestas"],$_POST["idbateria"])){
						$encuestas=explode(",",$_POST["encuestas"]);
						$validad=array();
						foreach($encuestas as $dato){
							array_push($validad,(int)$dato);
						}
						$id=(int)$_POST["idbateria"];
						if(count($validad)>0){
							$queryc = "UPDATE {{programacion_encuesta}} set idbateria=".$id." WHERE iduscrea=".(int)$_SESSION["loginID"]." AND id in (".join(",",$validad).")";
							$gcrt = dbExecuteAssoc($queryc); 
							if($gcrt){	
								$dat = new CDbCriteria;
								$dat->condition = " iduscrea=".(int)$_SESSION["loginID"]." AND idbateria=".$id;
								$dat->order = " id ASC";
 								$bt = ProgramacionEncuesta::model()->find($dat);
								
								if(isset($bt->id)){
 									$dat = new CDbCriteria;
									$dat->condition = " idProgramacion=".$bt->id;
									$usuarios = UsuarioProgramacion::model()->findAll($dat);
									//printVar($usuarios);exit;
 									foreach($usuarios as $datos){
 										foreach($validad as $datoen){
											unset($set);
											$dat = new CDbCriteria;
											$dat->condition = " idUsuario=".$datos->idUsuario." and idProgramacion=".$datoen;
											$usuariosval = UsuarioProgramacion::model()->find($dat);
											if(!isset($usuariosval->id)){
												$set=new UsuarioProgramacion();
												$set->idUsuario=$datos->idUsuario;
												$set->idProgramacion=$datoen;
												$set->estado=0;
												$set->fechacreacion=date("Y-m-d H:i:s");
												$set->save();
											}
 										}
 									}
 								}
 							}
						}
 					}
 				break;
				case "add":
					$dat = new CDbCriteria;
					$dat->condition = 'id_unidad='.(int)$_POST["empresa"].'   and (fechaini BETWEEN "'.$_POST["fechaini"].'"  AND "'.$_POST["fechafin"].'" or fechafin BETWEEN "'.$_POST["fechaini"].'"  AND "'.$_POST["fechafin"].'") ';
					$bt = Bateria::model()->find($dat);
					if(/*!isset($bt->id)*/ $_POST["fechafin"]>$_POST["fechaini"]){
						$set=new Bateria();
						$set->nombre=trim($_POST["nombre"]," ");
						$set->fecha=date("Y-m-d H:i:s");
						$set->fechaini=$_POST["fechaini"];
						$set->fechafin=$_POST["fechafin"];
						$set->id_unidad=(int)$_POST["empresa"];
						$set->idusuariocrea=(int)$_SESSION["loginID"];
						$set->save();
						$id = $set->id;
						if(isset($_POST["encuestas"],$_POST["poblacion"]) and $id>0){
							$mensaje="La bateria ha sido creada";
							$encuestas=explode(",",$_POST["encuestas"]);
							$poblacion=explode(",",$_POST["poblacion"]);
 							$bateriastandar=array(296378,121426,993734,191739);
							$titulo=array("296378"=>"Estres","121426"=>"Formulario B","993734"=>"Formulario A","191739"=>"Extralaboral");
 							$contador=false;
							foreach($encuestas as $test){
								if($test>0){
									$contador=true;
								}
							}
							
							
							if($contador==false or ($encuestas=="" or $encuestas==NULL )){
								$encuestas=array();
								$contador=false;
								foreach($poblacion as $test){
									if($test>0){
										$contador=true;
									}
								}
								if($contador==false){
									$poblacion=NULL;
								}
							
								foreach($bateriastandar as $dato){ 
									$DATA["dependencia"]=(int)$_POST["empresa"];
									$DATA["sid"]=$dato;
									$DATA["fechaini"]=$_POST["fechaini"];
									$DATA["fechafin"]=$_POST["fechafin"];
									$DATA["descripcion"]=$titulo[$dato];
									$DATA["poblacion"]=$poblacion;
 									$sid=$this->programacion("add",$DATA,TRUE);
									
									array_push($encuestas,$sid);
								}
 							}
  							if(isset($encuestas[0]) and count($encuestas)>0){
 								if((int)$encuestas[0]>0){
								 
									$validad=array();
									foreach($encuestas as $dato){
										array_push($validad,(int)$dato);
									}
									if(count($validad)>0){
										$queryc = "UPDATE {{programacion_encuesta}} set idbateria=".$id." WHERE iduscrea=".(int)$_SESSION["loginID"]." AND id in (".join(",",$validad).")";
										$gcrt = dbExecuteAssoc($queryc); 
										if($gcrt){
											$validad=array();
											foreach($poblacion as $dato){
												array_push($validad,(int)$dato);
											}
											if(count($validad)>0){
												foreach($validad as $datou){
													foreach($encuestas as $datoep){
														unset($dat);
														$dat = new CDbCriteria;
														$dat->condition = 'idUsuario='.$datou.' and idProgramacion='.$datoep;
														$bt = UsuarioProgramacion::model()->find($dat);
														if(!isset($bt->id) and (int)$datou>0){
															unset($set);
															$set=new UsuarioProgramacion();
															$set->idUsuario=$datou;
															$set->idProgramacion=$datoep;
															$set->estado=0;
															$set->fechacreacion=date("Y-m-d H:i:s");
															$set->save();
														}
													}
													if((int)$datou>0){
														$queryc = "SELECT * FROM {{eval_usuarios}} where id=".$datoep;
														$gcrt = dbExecuteAssoc($queryc);
														$ussurvey = $gcrt->readAll();
															
														$uss=array("nombres"=>$ussurvey[0]["nombres"],"apellidos"=>$ussurvey[0]["apellidos"],"alias"=>$ussurvey[0]["alias"],"clave"=>$ussurvey[0]["clave"],"email"=>$ussurvey[0]["email"]);
														$this->sendmail($uss,'Batería de encuestas');
													}						
 												}
											}
										}
									}
								}
									
							}
						}
 					}else{
						$mensaje="El periodo de fechas ingresado para la bateria ya existe";
 					}
					 // $this->getController()->redirect(array('admin/survey/sa/view/surveyid/' . $iSurveyID));
				break;
				case "us":
					
					$usuarios=array();
					if(isset($_POST["idbateria"])){
						if((int)$_POST["idbateria"]>0){
							$dat = new CDbCriteria;
							$dat->condition = 'idbateria='.(int)$_POST["idbateria"];
							$pe = ProgramacionEncuesta::model()->findAll($dat);
							
							if(isset($pe[0]->id)){
								foreach($pe as $dato){
									$usmod = new CDbCriteria;
									$usmod->condition = 'idProgramacion='.$dato->id;
									$usmod->group = 'idUsuario';
									$tt = UsuarioProgramacion::model()->findAll($usmod);
									if(isset($tt[0]->id)){
										foreach($tt as $vd){
											array_push($usuarios,$vd->idUsuario);
										}
									}
								}
							}
						}
 					}
					$query="u.id>0 and id_unidad=".(int)$_POST["id_unidad"]." and perfil=2";
					if(isset($usuarios[0])){
						$query=" u.id not in (".join(",",$usuarios).") and id_unidad=".(int)$_POST["id_unidad"]." and perfil=2";
 					}
 					
   					$tt = EvalUsuarios::model()->selectUsuarioById(1,$query);
 					if(isset($tt->id)){
						$temp=$tt;
						unset($tt);
						$tt=array($temp);
					}
					
 					$rus=array();
					foreach($tt as $vr){
						if($vr->activo==1){
							array_push($rus,array(	"uid"=>$vr->id,
													"documento"=>$vr->documento,
													"nombres"=>$vr->nombres,
													"apellidos"=>$vr->apellidos,
													"id_unidad"=>$vr->id_unidad,
													"area"=>$vr->nom_area,
													"id_area"=>$vr->id_area,
													"id_cargo"=>$vr->id_cargo,
													));
						}
					}
				 
					$areas=EvalAreas::model()->findAll();
					$ra=array();
					foreach($areas as $datos){
						array_push($ra,array("id"=>$datos->id,"nombre"=>$datos->nombre));
					}					
					echo json_encode(array("usuarios"=>$rus,"areas"=>$ra));exit;
				
				break;
				case "encuestas":
					$query='  and (idbateria=0 OR idbateria is NULL) and id_unidad='.(int)$_POST['empresa'];
					//printVar($query);
					$dat = new CDbCriteria;
					$dat->condition = 'iduscrea='.(int)$_SESSION["loginID"].$query;
					$pe = ProgramacionEncuesta::model()->findAll($dat);
					$rpe=array();
					if(isset($pe[0]->id)){
						$i=0; 
						foreach($pe as $datos){
							unset($datamod);
							$datamod = new CDbCriteria;
							$datamod->condition = 'surveyls_survey_id='.$datos->sid;
							$datae = SurveyLanguageSetting::model()->find($datamod);					
							$rpe[$i]=(object)	array(	"id"=>$datos->id,
															"sid"=>$datos->sid,
															"encuesta"=>$datae->surveyls_title,
															"fechaini"=>$datos->fechaini,
															"fechafin"=>$datos->fechafin,
															"descripcion"=>$datos->descripcion,
													);
							$i++;
 						}
					}					
					echo json_encode($rpe);exit;
					
				break;
				
			}
			
			
		}
		
		$subq='idusuariocrea='.(int)$_SESSION["loginID"];
		if($oRecord->iduseval>0 and ($dUsuario->perfil==2 or $dUsuario->perfil==4 or $dUsuario->perfil==3)){
			if($dUsuario->perfil==2){
				$subq='id_unidad='.(int)$dUsuario->id_unidad;
			}
  			if($dUsuario->perfil==3 || $dUsuario->perfil==4){
 				$subq='id_unidad in ('.$dUsuario->id_unidad.')';
 			}
			if(isset($_POST["filtro"])){
				if($_POST["filtro"]>0){
					$subq='id_unidad='.(int)$_POST["filtro"];
				}
 			}
   		}		
		if($oRecord->uid==1){
			$subq='idusuariocrea>0';
		}
 		$dat = new CDbCriteria;
		$dat->condition =$subq;
		$bt1 = Bateria::model()->findAll($dat);
		
		$bt=array();
 		foreach($bt1 as $datab){
			$creador = User::model()->findByPk($datab->idusuariocrea); 
			$nem = EvalUnidades::model()->findByPk($datab->id_unidad);
			$datar=array(
						"id"=>$datab->id,
						"nombre"=>$datab->nombre,
						"fecha"=>$datab->fecha,
						"idusuariocrea"=>$datab->idusuariocrea,
						"creador"=>$creador->full_name,
						"id_unidad"=>$datab->id_unidad,
						"empresa"=>$nem->nombre,
						"fechaini"=>$datab->fechaini,
						"fechafin"=>$datab->fechafin,
						"fcreacion"=>$datab->fecha,
			); 
			array_push($bt,(object)$datar);
		}
 		//printVar($bt);exit;
 		$arrayb=array();
		if(isset($bt[0]->id)){
			$j=0;
			$subq=' and iduscrea='.(int)$_SESSION["loginID"];
			if($oRecord->iduseval>0 and ($dUsuario->perfil==2 or $dUsuario->perfil==4 or $dUsuario->perfil==3)){
				if($dUsuario->perfil==2){
					$subq=' and id_unidad='.(int)$dUsuario->id_unidad;
				}
 				if($dUsuario->perfil==3 || $dUsuario->perfil==4){
					$subq=' and id_unidad in ('.$dUsuario->id_unidad.')';
				}			
 			}
 			if($oRecord->uid==1){
				$subq=' and iduscrea>0';
			}
 			
 			foreach($bt as $valores){
				unset($dat);
				$dat = new CDbCriteria;
				$dat->condition = 'idbateria='.$valores->id.$subq;
				$pe = ProgramacionEncuesta::model()->findAll($dat);
  				if(isset($pe[0]->id)){
  					if(isset($enc[0]->id)){
						foreach($enc as $data){
							$usmod = new CDbCriteria;
							$usmod->condition = 'idProgramacion='.$data->id;
							$tt = UsuarioProgramacion::model()->findAll($usmod);
							
							$usmod = new CDbCriteria;
							$usmod->condition = 'idProgramacion='.$data->id." and estado='1'";
							$tt1 = UsuarioProgramacion::model()->findAll($usmod);
							
							$usmod = new CDbCriteria;
							$usmod->condition = 'idProgramacion='.$data->id." and estado='0'";
							$tt0 = UsuarioProgramacion::model()->findAll($usmod);
							array_push($datat,array("encuestados"=>count($tt),"resuelto"=>count($tt1),"restante"=>count($tt0)));
						}
					}
  					$i=0;
					foreach($pe as $datos){
						unset($datamod);
						$datamod = new CDbCriteria;
						$datamod->condition = 'surveyls_survey_id='.$datos->sid;
						$datae = SurveyLanguageSetting::model()->find($datamod);
						
						
						$usmod = new CDbCriteria;
						$usmod->condition = 'idProgramacion='.$datos->id;
						$tt = UsuarioProgramacion::model()->findAll($usmod);

						$usmod = new CDbCriteria;
						$usmod->condition = 'idProgramacion='.$datos->id." and estado='1'";
						$tt1 = UsuarioProgramacion::model()->findAll($usmod);

						$usmod = new CDbCriteria;
						$usmod->condition = 'idProgramacion='.$datos->id." and estado='0'";
						$tt0 = UsuarioProgramacion::model()->findAll($usmod);
						
 						$arrayb[$j][$i]=	array(	"id"=>$datos->id,
														"sid"=>$datos->sid,
 														"encuesta"=>$datae->surveyls_title,
														"fechaini"=>$datos->fechaini,
														"fechafin"=>$datos->fechafin,
														"descripcion"=>$datos->descripcion,
														"indicadores"=>array("encuestados"=>count($tt),"resuelto"=>count($tt1),"restante"=>count($tt0)),
												);
						$i++;
					}
 				}else{
					$arrayb[$j][0]=NUll;
 				}
				$j++;
 			}
 		}
 		 
		if($oRecord->uid==1){
 			$subquni=" > 0";
		}
 		if($dUsuario->perfil==3 || $dUsuario->perfil==4 ){
			$subquni=" in (".$dUsuario->id_unidad.")";
 		}
		$muni = new CDbCriteria;
		$muni->condition = 'id'.$subquni;
		$unidades = EvalUnidades::model()->findAll($muni);
		$ra=array();
		foreach($unidades as $datos){
			array_push($ra,array("id"=>$datos->id,"nombre"=>$datos->nombre));
		}			
 		$aData["unidades"]= $ra;
  		$aData["urlbase"]="/bateria/";
 		$aData["perfil"]=$dUsuario->perfil;
 		$aData["oRecord"]=$oRecord;
 		$aData["bateria"]=$bt;
		$aData["encprogrmas"]=$arrayb;
 		$this->_renderWrappedTemplate('encuestas', 'bateria', $aData);
	}
	
	function clasificar(){
	
		if(isset($_POST["qid"])){
			$qid=explode(",",$_POST["qid"]);
 			if($_POST["tipo"]=="01234"){
				$tipo="0";
			}
 			if($_POST["tipo"]=="43210"){
				$tipo="1";
			}
			
 			if($_POST["tipo"]=="9630"){
				$tipo="2";
			}
			
 			if($_POST["tipo"]=="6420"){
				$tipo="3";
			}
			
 			if($_POST["tipo"]=="3210"){
				$tipo="4";
			}
 			if($_POST["tipo"]=="12345"){
				$tipo="5";
				}
 			if($_POST["tipo"]=="54321"){
				$tipo="6";
			}
			
			
 			if(count($qid)>0){
				for($i=0;$i<count($qid);$i++){
					$dat = new CDbCriteria;
					$dat->condition = 'qid='.$qid[$i];
					$Rclasif = ClacificacionPregunta::model()->find($dat);
					if(!isset($Rclasif->id)){
						$set=new ClacificacionPregunta();
						$set->sid=(int)$_POST["sid"];
						$set->qid=$qid[$i];
						$set->tipocal=$tipo;
						$set->fecha=date("Y-m-d H:i:s");
						$r=$set->save();	
						unset($set);
					}else{
						$Rclasif->tipocal=$tipo;
						$Rclasif->save();
  					}
					unset($dat);
				}
 			}
 		}
 		
		$datamod = new CDbCriteria;
		$datamod->condition = 'sid='.(int)$_POST["sid"].' and type<>"X"';
		$questions = Question::model()->findAll($datamod);
		$rq=array();
		
		$i=0;
		foreach($questions as $data){
			if(	$data->question!="programacion" and 
				$data->question!="area" and 
				$data->question!="idus" and 
				$data->question!="sid"){
				$i++;
				
				$dat = new CDbCriteria;
				$dat->condition = 'qid='.$data->qid;
				$Rclasif = ClacificacionPregunta::model()->find($dat);
				$clasif="";
				if(isset($Rclasif->id)){
					$clasif=$Rclasif->tipocal;
				}
 				array_push($rq,(object)array("sid"=>$data->sid,"qid"=>$data->qid,"question"=>trim($data->question," "),"key"=>$i,"clasif"=>$clasif));
			}
			
		}
		
 		$aData["imageurl"]="/bateria/img/";
		$aData["rbase"]="/bateria/";
 		$datamod = new CDbCriteria;
		$datamod->condition = 'surveyls_survey_id='.(int)$_POST["sid"];
		$datae = SurveyLanguageSetting::model()->find($datamod);
		$aData["datae"]=$datae;
		$aData["sid"]=(int)$_POST["sid"];
  	
		$aData["preguntas"]=$rq;
        $this->_renderWrappedTemplate('encuestas', 'clacificar', $aData);
 	}
	
	function baremos(){
	
 	
		$sid=(int)$_POST["sid"];
		$aData["sid"]=$sid;
		
		
 /*error_reporting(E_ALL);
	 ini_set('display_errors', '1');*/		
		
		if(isset($_POST["op"])){
			switch($_POST["op"]){
				case "dominioadd":
 					$dim = new CDbCriteria;
					$dim->condition = 'sid='.$sid.' and dominio_id='.(int)$_POST["id"];
 					$bdom = BaremosDominios::model()->find($dim);
 					if(!isset($bdom->id)){
						$set=new BaremosDominios();
						$set->sid=$sid;
						$set->dominio_id=(int)$_POST["id"];
						$set->srrd=str_replace(" ","",str_replace(",",".",trim($_POST["srrd"])));
						$set->rb=str_replace(" ","",str_replace(",",".",trim($_POST["rb"])));
						$set->rm=str_replace(" ","",str_replace(",",".",trim($_POST["rm"])));
						$set->ra=str_replace(" ","",str_replace(",",".",trim($_POST["ra"])));
						$set->rma=str_replace(" ","",str_replace(",",".",trim($_POST["rma"])));
						$set->fecha=date("Y-m-d H:i:s");
						$set->save();
					}else{
						$bdom->sid=$sid;
 						$bdom->srrd=str_replace(" ","",str_replace(",",".",trim($_POST["srrd"])));
						$bdom->rb=str_replace(" ","",str_replace(",",".",trim($_POST["rb"])));
						$bdom->rm=str_replace(" ","",str_replace(",",".",trim($_POST["rm"])));
						$bdom->ra=str_replace(" ","",str_replace(",",".",trim($_POST["ra"])));
						$bdom->rma=str_replace(" ","",str_replace(",",".",trim($_POST["rma"])));		
						$bdom->save();
					}
				break;
				case "dimensionadd":
					$codigo=str_replace(" ","",trim($_POST["id"]," "));
 					$dim = new CDbCriteria;
					$dim->condition = 'sid='.$sid.' and codigo="'.$codigo.'"';
 					$bdom = BaremosDimensiones::model()->find($dim);
 					if(!isset($bdom->id)){
						$set=new BaremosDimensiones();
						$set->sid=$sid;
						$set->codigo=$codigo;
						$set->srrd=str_replace(" ","",str_replace(",",".",trim($_POST["srrd"])));
						$set->rb=str_replace(" ","",str_replace(",",".",trim($_POST["rb"])));
						$set->rm=str_replace(" ","",str_replace(",",".",trim($_POST["rm"])));
						$set->ra=str_replace(" ","",str_replace(",",".",trim($_POST["ra"])));
						$set->rma=str_replace(" ","",str_replace(",",".",trim($_POST["rma"])));
						$set->fecha=date("Y-m-d H:i:s");
						$set->save();
					}else{
						$bdom->sid=$sid;
 						$bdom->srrd=str_replace(" ","",str_replace(",",".",trim($_POST["srrd"])));
						$bdom->rb=str_replace(" ","",str_replace(",",".",trim($_POST["rb"])));
						$bdom->rm=str_replace(" ","",str_replace(",",".",trim($_POST["rm"])));
						$bdom->ra=str_replace(" ","",str_replace(",",".",trim($_POST["ra"])));
						$bdom->rma=str_replace(" ","",str_replace(",",".",trim($_POST["rma"])));	
						$bdom->save();
					}
				break;
			}
		}
  		
		//echo $sid;exit;
		$dim = new CDbCriteria;
		$dim->condition = 'sid='.$sid;
		$dim->group  = 'codigo,paramid';
		$dimensiones = DimensionEncuesta::model()->findAll($dim);
		$j=0;
		$rd=array();
 		
		foreach($dimensiones as $data1){

			$dom = new CDbCriteria;
			$dom->condition = 'sid='.$sid.' and codigo="'.$data1->codigo.'"';
			$bdom = BaremosDimensiones::model()->find($dom);
			$baremos=array();
			
			if(isset($bdom->id)){
				foreach($bdom as $key=>$valores){
					$baremos[$key]=$valores;
				}
 			}
 			$j++;
			array_push($rd,array("baremos"=>$baremos,"codigo"=>$data1->codigo,"idparam"=>$data1->paramid,"id"=>$data1->id,"sid"=>$data1->sid,"nombre"=>trim($data1->nombre," "),"transformacion"=>$data1->transformacion,"key"=>$j));
		}

		$dim = new CDbCriteria;
		$dim->condition = 'sid='.$sid;
 		$dominios = ParametrizacionEncuesta::model()->findAll($dim);
		 
		$j=0;
		$rdom=array();
		foreach($dominios as $data1){
			$j++;
 			$dim = new CDbCriteria;
			$dim->condition = 'sid='.$sid.' and dominio_id='.$data1->id;
			$bdom = BaremosDominios::model()->find($dim);
  			$baremos=array();
 			if(isset($bdom->id)){
				foreach($bdom as $key=>$valores){
					$baremos[$key]=$valores;
				}
 			}
 			array_push($rdom,array("baremos"=>$baremos,"id"=>$data1->id,"nombre"=>$data1->nombre));
		}
		 		

		$datamod = new CDbCriteria;
		$datamod->condition = 'surveyls_survey_id='.$sid;
		$datae = SurveyLanguageSetting::model()->find($datamod);
		
 		$aData["rd"]=$rd;
 		$aData["rdom"]=$rdom;
 		$aData["datae"]=$datae;
		
        $this->_renderWrappedTemplate('encuestas', 'baremos', $aData);
 	}
	
	function parametrizacion(){
		
 /*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
  		if(isset($_POST["op"])){
		
			switch($_POST["op"]){
				case "adddim":
					$msg="";
					$sel=explode(",",$_POST["sel"]);
					$tsel=count($sel);
					if($tsel>0){
						$codigo = '';
						$longitud=5;
						$pattern = 'acumashentej1jun4h3l1nd0sn3n3s1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ2222233331m23m4';
						$max = strlen($pattern)-1;
						for($i=0;$i < $longitud;$i++){ $codigo .= $pattern{mt_rand(0,$max)}; };
						
 						if(trim($_POST["nombre"]," ")==""){
							$msg="Por favor, ponga nombre a la dimensión";
						}else{
							for($i=0;$i<$tsel;$i++){
								$set=new DimensionEncuesta();
								$set->sid=(int)$_POST["sid"];
								$set->codigo=$codigo;
								$set->nombre=trim($_POST["nombre"]," ");
								$set->transformacion=(int)$_POST["transformacion"];
								$set->multiplicador=(int)$_POST["multiplicador"];
								$set->paramid=(int)$_POST["idparam"];
								$set->qid=(int)$sel[$i];
								$set->fecha=date("Y-m-d H:i:s");
								$r=$set->save();
								unset($set);
							}
						}
					}
				
				break;
				case "add":
  					$dim = new CDbCriteria;
					$dim->condition = 'nombre="'.trim($_POST["nombre"]," ").'" and sid='.(int)$_POST["sid"];
 					$dimensiones = ParametrizacionEncuesta::model()->find($dim);
 					if(!isset($dimensiones->nombre)){
						$set=new ParametrizacionEncuesta();
						$set->sid=(int)$_POST["sid"];
						$set->transformacion=(int)$_POST["transformacion"];
						$set->nombre=trim($_POST["nombre"]," ");
						$set->estado="0";
						$set->fecha=date("Y-m-d H:i:s");
						$r=$set->save();
					}
  				break;
				case "elimdom":
					$id=(int)$_POST["id"];
					$sid=(int)$_POST["sid"];
 					
 					if($sid>0 and $id>0){
					
						$query = 'DELETE FROM {{parametrizacion_encuesta}} where sid='.$sid.' and id='.$id;
						Yii::app()->db->createCommand($query)->execute();
 						
						$query = 'DELETE FROM {{dimension_encuesta}} where sid='.$sid.' and paramid='.$id;
						Yii::app()->db->createCommand($query)->execute();
 						
						echo json_encode(array("El dominio ha sido eliminado exitosamente junto con sus dimensiones"));exit;
 					}
					echo json_encode(array("Algo salió mal, por favir, cierre sesión e intentelo de nuevo"));exit;				
				break;
				case "dimension":
 					$sid=(int)$_POST["sid"];
					$idparam=(int)$_POST["idparam"];
					//echo $sid;exit;
  					$dim = new CDbCriteria;
					$dim->condition = 'paramid='.$idparam.' and sid='.$sid;
					$dim->group  = 'codigo,paramid';
					$dimensiones = DimensionEncuesta::model()->findAll($dim);
					$j=0;
					$rd=array();
  					foreach($dimensiones as $data1){
						$j++;
 						array_push($rd,array("idparam"=>$data1->paramid,"id"=>$data1->id,"sid"=>$data1->sid,"nombre"=>trim($data1->nombre," "),"transformacion"=>$data1->transformacion,"multiplicador"=>$data1->multiplicador,"key"=>$j));
 					}
					
 					
  					$dim2 = new CDbCriteria;
					$dim2->condition = 'sid='.$sid;
					//$dim2->condition = 'paramid='.$idparam.' and sid='.$sid;
 					$dimensiones2 = DimensionEncuesta::model()->findAll($dim2);
					$seq=array();
   					foreach($dimensiones2 as $data2){
  						array_push($seq,$data2->qid);
					}
					
					$selq="";
					$tsel=count($seq);
					if($tsel>0){
						$newsel=array();
						for($i=0;$i<$tsel;$i++){
							array_push($newsel,(int)$seq[$i]);
						}
						$selq=join(",",$newsel);
						$selq=" and qid not in (".$selq.")";
 					}
 					
					$datamod = new CDbCriteria;
					$datamod->condition = 'sid='.$sid.$selq.' and type<>"X"';
					$questions = Question::model()->findAll($datamod);
					$rq=array();
 					$i=0;
 					foreach($questions as $data){
 						if(	$data->question!="programacion" and 
							$data->question!="area" and 
							$data->question!="idus" and 
							$data->question!="sid"){
							$i++;
							array_push($rq,array("sid"=>$data->sid,"qid"=>$data->qid,"question"=>trim($data->question," "),"key"=>$i));
						}
						
					}
					
					echo json_encode(array($rq,$i,$rd,$j));exit;
				break;
				case "verpreguntas":

					$sid=(int)$_POST["sid"];
					$idparam=(int)$_POST["id"];
					//echo $sid;exit;
  					$dim = new CDbCriteria;
					$dim->condition = 'id='.$idparam.' and sid='.$sid;
					$dim->group  = 'nombre,paramid';
					$dimensiones = DimensionEncuesta::model()->find($dim);
					
  					$dim2 = new CDbCriteria;
					$dim2->condition = 'nombre="'.$dimensiones->nombre.'" and paramid='.$dimensiones->paramid;
 					$dimensiones2 = DimensionEncuesta::model()->findAll($dim2);
					
					
					$newsel=array();
					foreach($dimensiones2 as $dato){
					
						$datamod = new CDbCriteria;
						$datamod->condition = 'qid='.$dato->qid.' and type<>"X"';
						$questions = Question::model()->find($datamod);
 						if(	$questions->question!="programacion" and 
						$questions->question!="area" and 
						$questions->question!="idus" and 
						$questions->question!="sid"){					
							array_push($newsel,array("id"=>$dato->id,"tipocal"=>$dato->tipocal,"qid"=>$questions->qid,"sid"=>$questions->sid,"gid"=>$questions->gid,"question"=>trim($questions->question)));
							unset($datamod);
						}
					}
					

					echo json_encode($newsel);exit;



				break;
				
			}
			
			
			
		}



	    $aData=array();
		if(isset($_POST["idparam"])){
		$aData["idparam"]=(int)$_POST["idparam"];
		}
		if(isset($_POST["sel"])){
		$aData["sel"]=$_POST["sel"];
		}
 		$sid=$_POST["sid"];
       
		$aData["cunive"]=$this->selecUnidadesActivas();
		$aData["imageurl"]="/bateria/img/";
		$aData["rbase"]="/bateria/";
		$aData["sid"]=$sid;
		
		$datamod = new CDbCriteria;
		$datamod->condition = 'surveyls_survey_id='.$sid;
		$datae = SurveyLanguageSetting::model()->find($datamod);
		$aData["datae"]=$datae;
 		
		$datamod = new CDbCriteria;
		$datamod->condition = 'sid='.$sid;
		$parametrizacion = ParametrizacionEncuesta::model()->findAll($datamod);		
		$aData["parametrizacion"]=$parametrizacion;
		
		
		
		 
        $this->_renderWrappedTemplate('encuestas', 'parametrizacion', $aData);
		
	
	
	
	}
	
	
	function programacion($option=NULL,$POST=NULL,$function=FALSE){
//	 error_reporting(E_ALL);
//ini_set('display_errors', '1');
 		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
		//printVar($oRecord);
		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
		
		if(isset($_POST["op"])){
			$option=$_POST["op"];
		}
 		if(!isset($_POST["op"])){
			$sid=(int)$_POST["id"];
  			
			$subq=' and iduscrea='.(int)$_SESSION["loginID"];
			$subquni="";
			if($oRecord->iduseval>0 and ($dUsuario->perfil==2 or $dUsuario->perfil==4 or $dUsuario->perfil==3)){
				if($dUsuario->perfil==2){
					$subq=' and iduscrea='.(int)$_SESSION["loginID"];
				}
				if($dUsuario->perfil==4){
					$subq=' and iduscrea in ('.join(",",$arus).')';
				}
				if($dUsuario->perfil==3){
					$subq=' and id_unidad in ('.$dUsuario->id_unidad.')';
				}
			}
  			if($oRecord->uid==1){
				$subq=' and iduscrea>0';
				$subquni=" > 0";
			}
 			
			$encmod = new CDbCriteria;
			$encmod->condition = 'sid='.$sid.' '.$subq;
			$enc = ProgramacionEncuesta::model()->findAll($encmod);
			
			$datamod = new CDbCriteria;
			$datamod->condition = 'surveyls_survey_id='.$sid;
			$datae = SurveyLanguageSetting::model()->find($datamod);
			$datat=array();
			
			if($dUsuario->perfil==3 || $dUsuario->perfil==4 ){
				$subquni=" in (".$dUsuario->id_unidad.")";
				
			}
 			$muni = new CDbCriteria;
			$muni->condition = 'id'.$subquni;
			$unidades = EvalUnidades::model()->findAll($muni);
			$ra=array();
			foreach($unidades as $datos){
				array_push($ra,array("id"=>$datos->id,"nombre"=>$datos->nombre));
			}			
 			if(isset($enc[0]->id)){
				foreach($enc as $data){
					$usmod = new CDbCriteria;
					$usmod->condition = 'idProgramacion='.$data->id;
					$tt = UsuarioProgramacion::model()->findAll($usmod);
 					
					$usmod = new CDbCriteria;
					$usmod->condition = 'idProgramacion='.$data->id." and estado='1'";
					$tt1 = UsuarioProgramacion::model()->findAll($usmod);
					
					$usmod = new CDbCriteria;
					$usmod->condition = 'idProgramacion='.$data->id." and estado='0'";
					$tt0 = UsuarioProgramacion::model()->findAll($usmod);
					array_push($datat,array("encuestados"=>count($tt),"resuelto"=>count($tt1),"restante"=>count($tt0)));
				}
			}
 			
			$aData["mensaje"]="";		
			$aData["indicador"]=$datat;		
			$aData["datae"]=$datae;		
			$aData["enc"]=$enc;		
			$aData["areas"]=$ra;		
			$aData["sid"]=$sid;		
			$aData["rbase"]="/bateria/";
			$aData["imageurl"]="/bateria/img/";
		}else if($option!=NULL){
			$DATA=NULL;
			if($POST!=NULL){
				$DATA=$POST;
			}else if(isset($_POST)){
				$DATA=$_POST;
			}
 			switch($option){
				case "acfecha":
					$encmod = new CDbCriteria;
					$encmod->select="id,fechaini,fechafin";
					$encmod->condition = 'id='.$DATA["id"];
					$enc = ProgramacionEncuesta::model()->find($encmod);
					if(isset($enc->id)){
						$enc->fechaini=$_POST["fechaini"];
						$enc->fechafin=$_POST["fechafin"];
						$enc->save();
					}
 				break;
				case "add":
				//printVar($_SESSION["LSWebUser"]["__id"]);exit;
				
 					if(isset($DATA["sid"])){
						$idp=NULL;
						$encmod = new CDbCriteria;
						$encmod->condition = 'id_unidad='.$DATA["dependencia"].' and sid='.(int)$DATA["sid"].' and (fechaini >= "'.$DATA["fechaini"].'") and idbateria>0 ';
						$enc = ProgramacionEncuesta::model()->findAll($encmod);
						//printVar( ($DATA["fechaini"].">=":date("Y-m-d") and $DATA["fechafin"]>$DATA["fechaini"]));exit;
  						if(/*!isset($enc[0]->id) and ($DATA["fechaini"]>=date("Y-m-d") and*/ $DATA["fechafin"]>$DATA["fechaini"]){	 
							$set=new ProgramacionEncuesta();
							$set->sid=(int)$DATA["sid"];
							$set->fechaini=$DATA["fechaini"];
							$set->fechafin=$DATA["fechafin"];
							$set->id_unidad=(int)$DATA["dependencia"];
							$set->descripcion=$DATA["descripcion"];
							$set->iduscrea=$_SESSION["LSWebUser"]["__id"];
							$set->fechacreacion=date("Y-m-d");
							$set->fechaactualizacion=date("Y-m-d");
							$r=$set->save();
							$idp=$set->id;
							if($DATA["poblacion"]!=""){
								$poblacion=explode(",",$DATA["poblacion"]);
								$validar=array();
 								foreach($poblacion as $dato){
									array_push($validar,$dato);
								}
								unset($poblacion);
								$poblacion=$validar;
								$contact = new UsuarioProgramacion;
								if($poblacion[0]>0){
									for($nxt_id=0;$nxt_id<count($poblacion);$nxt_id++) {
										$contact->unsetAttributes();
										$contact->setIsNewRecord(true);
										$contact->idUsuario = $poblacion[$nxt_id];
										$contact->idProgramacion = $idp;
										$contact->estado = 0;
										$contact->fechacreacion =date("Y-m-d");
										$contact->fechaactualizacion =date("Y-m-d");
										$contact->save();
										
										$queryc = "SELECT * FROM {{eval_usuarios}} where id=".$poblacion[$nxt_id];
										$gcrt = dbExecuteAssoc($queryc);
										$ussurvey = $gcrt->readAll();
 										$uss=array("nombres"=>$ussurvey[0]["nombres"],"apellidos"=>$ussurvey[0]["apellidos"],"alias"=>$ussurvey[0]["alias"],"clave"=>$ussurvey[0]["clave"],"email"=>$ussurvey[0]["email"]);
										$this->sendmail($uss,'Batería de encuestas');
 										 						
									}
								}
							}
							$mensaje="La encuesta fue programada exitosamente, se le ha enviado un email a cada participante.";
  						}else{
							$mensaje="El periodo ingresado para esa &aacute;rea, ya exite en el sistema";
							$idp="EXISTE";
						}
						if($function==TRUE){
							$function=$idp;
						}else{
							$sid=(int)$DATA["sid"];
							$encmod = new CDbCriteria;
							$encmod->condition = 'sid='.$sid;
							$enc = ProgramacionEncuesta::model()->findAll($encmod);
							$datamod = new CDbCriteria;
							
							$datamod->condition = 'surveyls_survey_id='.$sid;
							$datae = SurveyLanguageSetting::model()->find($datamod);
							$datat=array();
				
							if($dUsuario->perfil==3 || $dUsuario->perfil==4 ){
								$subquni=" in (".$dUsuario->id_unidad.")";
								
							}
							if($oRecord->uid==1){
								$subq=' and iduscrea>0';
								$subquni=" > 0";
							}
							$muni = new CDbCriteria;
							$muni->condition = 'id'.$subquni;
							$unidades = EvalUnidades::model()->findAll($muni);
							$ra=array();						
							foreach($unidades as $datos){
								array_push($ra,array("id"=>$datos->id,"nombre"=>$datos->nombre));
							}			
							 
							if(isset($enc[0]->id)){
								foreach($enc as $data){
									$usmod = new CDbCriteria;
									$usmod->condition = 'idProgramacion='.$data->id;
									$tt = UsuarioProgramacion::model()->findAll($usmod);
									
									$usmod = new CDbCriteria;
									$usmod->condition = 'idProgramacion='.$data->id." and estado=1";
									$tt1 = UsuarioProgramacion::model()->findAll($usmod);
									
									$usmod = new CDbCriteria;
									$usmod->condition = 'idProgramacion='.$data->id." and estado=0";
									$tt0 = UsuarioProgramacion::model()->findAll($usmod);
									array_push($datat,array("encuestados"=>count($tt),"resuelto"=>count($tt1),"restante"=>count($tt0)));
								}
							}

							$aData["mensaje"]=$mensaje;		
							$aData["indicador"]=$datat;		
							$aData["datae"]=$datae;		
							$aData["enc"]=$enc;		
							$aData["areas"]=$ra;		
							$aData["sid"]=$sid;		
							$aData["rbase"]="/bateria/";
							$aData["imageurl"]="/bateria/img/";
						}
					}
  				break;
 				case "usprogramados":
					
					$usmod = new CDbCriteria;
					$usmod->condition = 'idProgramacion='.(int)$DATA["id"];
					$tt0 = UsuarioProgramacion::model()->findAll($usmod);

					$idus=array();
					foreach($tt0 as $data){
						array_push($idus,$data->idUsuario);
					}
					$textidus=join(",",$idus);
					$query="id>0";
					if($textidus!=""){
						$query="id NOT  IN (".$textidus.")";
					}
 					if(isset($DATA["innerif"])){
					
						switch($DATA["innerif"]){
							case "poblacion":
								$query="id IN (".$textidus.")";
							break;
							case "resuelto":
								$textidus=0;
								$usmod = new CDbCriteria;
								$usmod->condition ="idProgramacion=".$DATA["id"]." and estado='1'"; 
								$res=UsuarioProgramacion::model()->findAll($usmod);
								$temar=array();
								foreach($res as $data){
									array_push($temar,$data->idUsuario);
 								}								
								$textidus=join(",",$temar);
  								$query="id IN (".$textidus.")";
							break;
							case "restante":
								$textidus=0;
								$usmod = new CDbCriteria;
								$usmod->condition ="idProgramacion=".(int)$DATA["id"]." and estado='0'"; 
								$res=UsuarioProgramacion::model()->findAll($usmod);
 								$temar=array();
								foreach($res as $data){ 
									array_push($temar,$data->idUsuario);
 								}		
								
								$textidus=join(",",$temar);
  								$query="id IN (".$textidus.")";
							break;
							case "guardar":
							
								$idp=(int)$DATA["id"];
								if($DATA["poblar"]!=""){
									$poblacion=explode(",",$DATA["poblar"]);
									$contact = new UsuarioProgramacion;
									for($nxt_id=0;$nxt_id<count($poblacion);$nxt_id++) {
										$usmod = new CDbCriteria;
										$usmod->condition ="idProgramacion=".(int)$DATA["id"]." and idUsuario=". $poblacion[$nxt_id]; 
										$res=UsuarioProgramacion::model()->find($usmod);
										if(!isset($res[0]->idUsuario)){
											$contact->unsetAttributes();
											$contact->setIsNewRecord(true);
											$contact->idUsuario = $poblacion[$nxt_id];
											$contact->idProgramacion = $idp;
											$contact->estado = 0;
											$contact->fechacreacion =date("Y-m-d");
											$contact->fechaactualizacion =date("Y-m-d");
											$contact->save();
											
											$queryc = "SELECT * FROM {{eval_usuarios}} where id=".$poblacion[$nxt_id];
											$gcrt = dbExecuteAssoc($queryc);
											$ussurvey = $gcrt->readAll();

											$uss=array("nombres"=>$ussurvey[0]["nombres"],"apellidos"=>$ussurvey[0]["apellidos"],"alias"=>$ussurvey[0]["alias"],"clave"=>$ussurvey[0]["clave"],"email"=>$ussurvey[0]["email"]);
											$this->sendmail($uss,'Batería de encuestas');											
											
											
										}
									}
									echo json_encode(array("El proceso se ha realizado satisfactoriamente"));exit;
								}
 							break;
							case "eliminar":
							
							
								$usmod = new CDbCriteria;
								$usmod->condition ="idProgramacion=".(int)$DATA["id"]." and estado='1'"; 
								$res=UsuarioProgramacion::model()->findAll($usmod);
								if(!isset($res[0]->idProgramacion)){
 									$queryc = "delete from {{usuario_programacion}} where idProgramacion=".(int)$DATA["id"];
									$del = dbExecuteAssoc($queryc);
  
									$queryc2 = "delete from {{programacion_encuesta}} where id=".(int)$DATA["id"];
									$del = dbExecuteAssoc($queryc2);
  
									echo json_encode(array("El proceso se ha realizado satisfactoriamente"));exit;

  								}else{
									echo json_encode(array("No es posible eliminar esta programación, alguien ha resuelto esta encuesta"));exit;
 								}
								
							break;
						}
 					}
					 
 					$usmod = new CDbCriteria;
					$usmod->condition =$query." and id >0";
  					$res=EvalUsuarios::model()->findAll($usmod);
					 
					$usuarios=array();
    				$areas=EvalAreas::model()->findAll();
					$ra=array();
  					foreach($res as $dato){
						$arnom="";
						if($dato->id_area>0){
							$aream = new CDbCriteria;
							$aream->condition ="id=".$dato->id_area;
							$area=EvalAreas::model()->find($aream);
 							$arnom=$area->nombre;
						}
						array_push($ra,array("id"=>$dato->id_area,"nombre"=>$dato->id_area));
 						array_push($usuarios,array("area"=>$arnom,"documento"=>$dato->documento,"nombres"=>$dato->nombres,"id_area"=>$dato->id_area,"uid"=>$dato->id));
					}
					echo json_encode(array("usuarios"=>$usuarios,"areas"=>$ra));exit;					
 				break;
				case "uss":
					$query='id_area>0';
					if(isset($DATA["area"])){
						$query='id_area='.(int)$DATA["area"];
					}
					if(isset($DATA["dato"])){
						if($DATA["dato"]!=""){
							$query='(nombres  like "%'.trim($DATA["dato"]," ").'%" or apellidos  like "%'.trim($DATA["dato"]," ").'%" ) or documento='.(int)$DATA["dato"];
						}else if($DATA["dato"]==""){
							$query='id_area>0';
						}
					}
					$usmod = new CDbCriteria;
					$usmod->condition =$query;
 					$res=EvalUsuarios::model()->findAll($usmod);
					$usuarios=array();
					
  					$areas=EvalAreas::model()->findAll();
					$ra=array();
					foreach($areas as $datos){
						array_push($ra,array("id"=>$datos->id,"nombre"=>$datos->nombre));
					}
 					foreach($res as $dato){
						$aream = new CDbCriteria;
						$aream->condition ="id=".$dato->id_area;
						$area=EvalAreas::model()->find($aream); 
						$arnom="";
						if(isset($area->nombre)){
							$arnom=$area->nombre;
						}
						array_push($usuarios,array("area"=>$arnom,"documento"=>$dato->documento,"nombres"=>$dato->nombres." ".$dato->apellidos,"id_area"=>$dato->id_area,"uid"=>$dato->id));
					}
					echo json_encode(array("usuarios"=>$usuarios,"areas"=>$ra));exit;
 				break;
				 
 			}
 		}
		if($function==FALSE and $function!="EXISTE"){
			$this->_renderWrappedTemplate('encuestas', 'programar', $aData);
		}else if($function=="EXISTE" or (int)$function>0){
			return $function;
		}
 	}
	
	function AjaxavanceObjetivos(){
		
		switch((int)$_POST["action"]){
			case 1:
				$controlMod = new CDbCriteria;
 				$controlMod->condition = 'idPeriodo='.(int)$_POST["periodo"];
 				$trimestre = EvalTrimestre::model()->findAll($controlMod); 
				$html="<option>Seleccione un trimestre</option>";
				foreach($trimestre as $dato){
					$html.="<option value='".$dato->idTrimestre."'>";
					$html.=$dato->nombreTrimestre;
					$html.="</option>"; 
 				}
				echo $html;exit;
 			break;
			case 2:
				
				$idTrimestre=(int)$_POST["trimestre"];
				$periodo=(int)$_POST["periodo"];
				$tipoReporte=1;
				$tipoObjetivo=1;
				$imagenRojo = '<img border="0" src="/evalGenserbeta/img/bred.png" title="NO Evaluacion"/>';
				$imagenVerde = '<img border="0" src="/evalGenserbeta/img/bgre.png" title="Evaluacion" />';
				$datos = EvalUsuarios::model()->getTodosLosUsuarios();
				$html =     '<tr>';
				$html .=        '<td width="30%">';
				$html .=            '<div class="divContentBlue">';
				$html .=                '<div style="color:#666666;font-weight:bold; font-size:14px; text-align:left;padding:10px;">';
				$html .=                $tipoReporte == 1?'REPORTE DE AVANCE - CREACION DE OBJETIVOS<br/>':'REPORTE DE AVANCE - SEGUIMIENTO A OBJETIVOS<br/>';
				$html .=                '</div>';
				$html .=                '<div class="divContentWhite">';
		//        $html .=                    '<div style="color:#666666;font-weight:bold; font-size:12px; text-align:center;padding:10px;">';
				$html .=                        '<table width="100%" border="0" class="tbrepor1" cellpadding="2" cellspacing="0">';
				$html .=                    '<div style="color:#666666;font-weight:bold; font-size:12px; text-align:center;padding:10px;">';
				$html .=                            '<tr>';
				$html .=                                '<td width="5%" class="text" style="color:#1F497D;font-weight:bold;text-align:center;">';
				$html .=                                    'Activo';
				$html .=                                '</td>';
				$html .=                                '<td width="45% class="text" style="color:#1F497D;font-weight:bold;text-align:center;"">';
				$html .=                                    'Usuario';
				$html .=                                '</td>';
				$html .=                                '<td width="5% class="text" style="color:#1F497D;font-weight:bold;text-align:center;"">';
				$html .=                                $tipoReporte == 1?"Objetivos Creados":"Seguimiento Objetivos";
				$html .=                                '</td>';
				$html .=                                '<td width="15%" class="text" style="color:#1F497D;font-weight:bold;text-align:center;">';
				$html .=                                    'Pais';
				$html .=                                '</td>';
				$html .=                                '<td width="15%" class="text" style="color:#1F497D;font-weight:bold;text-align:center;">';
				$html .=                                    'Proceso';
				$html .=                                '</td>';
				$html .=                                '<td width="15%" class="text" style="color:#1F497D;font-weight:bold;text-align:center;">';
				$html .=                                    'Proyecto';
				$html .=                                '</td>';
				$html .=                            '</tr>';
				$html .=                    '</div>';
				$html .=                    '<div style="color:#666333;font-weight:normal; font-size:12px; text-align:center;padding:10px;">';
				foreach($datos as $dat) {
					$html .=                            $colorFilaTR?"<tr style='background-color: #F2F2F2'>":"<tr>";
														$colorFilaTR = !$colorFilaTR;
					if($dat->activo == 1) {
						$html .=                                '<td width="5%" class="text" style="color:#666666;font-weight:normal;text-align:center;">';
						$html .=                                    $imagenVerde;
						$html .=                                '</td>';
						$html .=                                '<td width="45%" class="text" style="color:#666666;font-weight:normal;text-align:center;">';
						$html .=                                    ($dat->nombres)." ".($dat->apellidos);
						$html .=                                '</td>';
						$html .=                                '<td width="5%" class="text" style="color:#666666;font-weight:normal;text-align:center;">';
																	 
						$html .=                                    EvalReporteobjetivo::model()->esObjetivoCreado($idTrimestre, $tipoReporte,$dat->id,$periodo)?$imagenVerde:$imagenRojo;
						$html .=                                '</td>';
						$html .=                                '<td width="15%" class="text" style="color:#666666;font-weight:normal;text-align:center;">';
						$html .=                                    ($dat->pais);
						$html .=                                '</td>';
						$html .=                                '<td width="15%" class="text" style="color:#666666;font-weight:normal;text-align:center;">';
 		
						
						$html .=                               $dat->nombre_proceso==''?"NUNGUNO":$dat->nombre_proceso;
						$html .=                                '</td>';
						$html .=                                '<td width="15%" class="text" style="color:#666666;font-weight:normal;text-align:center;">';
						
						$html .=                                $dat->nombre_proyecto==''?'NINGUNO': $dat->nombre_proyecto;
						$html .=                                '</td>';
					} else {
						$html .=                                '<td width="5%" class="text" style="color:#666666;font-weight:normal;text-align:center;">';
						$html .=                                    $imagenRojo;
						$html .=                                '</td>';
						$html .=                                '<td width="45%" class="text" style="color:#666666;font-weight:normal;text-align:center;">';
						$html .=                                    ($dat->nombres)." ".($dat->apellidos)." id usuario ".$dat->id;
						$html .=                                '</td>';
						$html .=                                '<td width="5%" class="text" style="color:#666666;font-weight:normal;text-align:center;">';
						$html .=                                    '-';
						$html .=                                '</td>';
						$html .=                                '<td width="15%" class="text" style="color:#666666;font-weight:normal;text-align:center;">';
						$html .=                                    '-';
						$html .=                                '</td>';
						$html .=                                '<td width="15%" class="text" style="color:#666666;font-weight:normal;text-align:center;">';
						$html .=                                    '-';
						$html .=                                '</td>';
						$html .=                                '<td width="15%" class="text" style="color:#666666;font-weight:normal;text-align:center;">';
						$html .=                                    '-';
						$html .=                                '</td>';
					}
				}
				$html .=                        '</table>';
				$html .=                    '</div>';
				$html .=                '</div>';
				$html .=            '</div>';
				$html .=        '</td>';
				$html .=    '</tr>';				 
				 
				 
				 echo $html;exit;
				 
				 
				 
 			break;
			
		}
		
 	}
	
	function seguimientoObjetivos(){
		
		$periodo = EvalPeriodos::model()->selectLastPeriodoActivo();
		$periodo2 = EvalPeriodos::model()->selectLastPeriodoActivo2();
		 
		
		$aData["periodo"]=$periodo;		
		$aData["periodo2"]=$periodo2;		
		$aData["rbase"]="/evalGenserbeta/";
 		$aData["imageurl"]="/evalGenserbeta/img/";
		$this->_renderWrappedTemplate('encuestas', 'seguimientoObjetivos', $aData);
 	}
	
	function AjaxseguimientoObjetivos(){
		
		switch((int)$_POST["action"]){
			case 1:
				$controlMod = new CDbCriteria;
 				$controlMod->condition = 'idPeriodo='.(int)$_POST["periodo"];
 				$trimestre = EvalTrimestre::model()->findAll($controlMod); 
				$html="<option>Seleccione un trimestre</option>";
				foreach($trimestre as $dato){
					$html.="<option value='".$dato->idTrimestre."'>";
					$html.=$dato->nombreTrimestre;
					$html.="</option>"; 
 				}
				echo $html;exit;
 			break;
			case 2:
				
				$trimestre=(int)$_POST["trimestre"];
				$periodo=(int)$_POST["periodo"];
				$tipoReporte=1;
				$tipoObjetivo=1;
				$imagenRojo = '<img border="0" src="/evalGenserbeta/img/bred.png" title="NO Evaluacion"/>';
				$imagenVerde = '<img border="0" src="/evalGenserbeta/img/bgre.png" title="Evaluacion" />';
				$datos = EvalUsuarios::model()->getTodosLosUsuarios();
				$html =     '<tr>';
				$html .=        '<td width="30%">';
				$html .=            '<div class="divContentBlue">';
				$html .=                '<div style="color:#666666;font-weight:bold; font-size:14px; text-align:left;padding:10px;">';
				$html .=                $tipoReporte == 1?'REPORTE DE AVANCE - CREACION DE OBJETIVOS<br/>':'REPORTE DE AVANCE - SEGUIMIENTO A OBJETIVOS<br/>';
				$html .=                '</div>';
				$html .=                '<div class="divContentWhite">';
		//        $html .=                    '<div style="color:#666666;font-weight:bold; font-size:12px; text-align:center;padding:10px;">';
				$html .=                        '<table width="100%" border="0" class="tbrepor1" cellpadding="2" cellspacing="0">';
				$html .=                    '<div style="color:#666666;font-weight:bold; font-size:12px; text-align:center;padding:10px;">';
				$html .=                            '<tr>';
				$html .=                                '<td width="5%" class="text" style="color:#1F497D;font-weight:bold;text-align:center;">';
				$html .=                                    'Activo';
				$html .=                                '</td>';
				$html .=                                '<td width="45% class="text" style="color:#1F497D;font-weight:bold;text-align:center;"">';
				$html .=                                    'Usuario';
				$html .=                                '</td>';
				$html .=                                '<td width="5% class="text" style="color:#1F497D;font-weight:bold;text-align:center;"">';
				$html .=                                $tipoReporte == 1?"Objetivos Creados":"Seguimiento Objetivos";
				$html .=                                '</td>';
				$html .=                                '<td width="15%" class="text" style="color:#1F497D;font-weight:bold;text-align:center;">';
				$html .=                                    'Pais';
				$html .=                                '</td>';
				$html .=                                '<td width="15%" class="text" style="color:#1F497D;font-weight:bold;text-align:center;">';
				$html .=                                    'Proceso';
				$html .=                                '</td>';
				$html .=                                '<td width="15%" class="text" style="color:#1F497D;font-weight:bold;text-align:center;">';
				$html .=                                    'Proyecto';
				$html .=                                '</td>';
				$html .=                            '</tr>';
				$html .=                    '</div>';
				$html .=                    '<div style="color:#666333;font-weight:normal; font-size:12px; text-align:center;padding:10px;">';
				foreach($datos as $dat) {
					$html .=                            $colorFilaTR?"<tr style='background-color: #F2F2F2'>":"<tr>";
														$colorFilaTR = !$colorFilaTR;
					if($dat->activo == 1) {
						$html .=                                '<td width="5%" class="text" style="color:#666666;font-weight:normal;text-align:center;">';
						$html .=                                    $imagenVerde;
						$html .=                                '</td>';
						$html .=                                '<td width="45%" class="text" style="color:#666666;font-weight:normal;text-align:center;">';
						$html .=                                    ($dat->nombres)." ".($dat->apellidos);
						$html .=                                '</td>';
						$html .=                                '<td width="5%" class="text" style="color:#666666;font-weight:normal;text-align:center;">';
																	 
						$html .=                                    EvalReporteobjetivo::model()->esObjetivoCreado($idTrimestre, $tipoReporte,$dat->id,$periodo)?$imagenVerde:$imagenRojo;
						$html .=                                '</td>';
						$html .=                                '<td width="15%" class="text" style="color:#666666;font-weight:normal;text-align:center;">';
						$html .=                                    ($dat->pais);
						$html .=                                '</td>';
						$html .=                                '<td width="15%" class="text" style="color:#666666;font-weight:normal;text-align:center;">';
 		
						
						$html .=                               $dat->nombre_proceso==''?"NUNGUNO":$dat->nombre_proceso;
						$html .=                                '</td>';
						$html .=                                '<td width="15%" class="text" style="color:#666666;font-weight:normal;text-align:center;">';
						
						$html .=                                $dat->nombre_proyecto==''?'NINGUNO': $dat->nombre_proyecto;
						$html .=                                '</td>';
					} else {
						$html .=                                '<td width="5%" class="text" style="color:#666666;font-weight:normal;text-align:center;">';
						$html .=                                    $imagenRojo;
						$html .=                                '</td>';
						$html .=                                '<td width="45%" class="text" style="color:#666666;font-weight:normal;text-align:center;">';
						$html .=                                    ($dat->nombres)." ".($dat->apellidos);
						$html .=                                '</td>';
						$html .=                                '<td width="5%" class="text" style="color:#666666;font-weight:normal;text-align:center;">';
						$html .=                                    '-';
						$html .=                                '</td>';
						$html .=                                '<td width="15%" class="text" style="color:#666666;font-weight:normal;text-align:center;">';
						$html .=                                    '-';
						$html .=                                '</td>';
						$html .=                                '<td width="15%" class="text" style="color:#666666;font-weight:normal;text-align:center;">';
						$html .=                                    '-';
						$html .=                                '</td>';
						$html .=                                '<td width="15%" class="text" style="color:#666666;font-weight:normal;text-align:center;">';
						$html .=                                    '-';
						$html .=                                '</td>';
					}
				}
				$html .=                        '</table>';
				$html .=                    '</div>';
				$html .=                '</div>';
				$html .=            '</div>';
				$html .=        '</td>';
				$html .=    '</tr>';				 
				 
				 
				 echo $html;exit;
				 
				 
				 
 			break;
			
		}
		
 	}
	
	
	function avances(){
		
		$perlas = EvalPeriodos::model()->selectLastPeriodoActivo2(); 
		$perp = EvalPeriodos::model()->selectLastPeriodoActivo();
		$perid=NULL;
		if(isset($_POST["per"])){
			if(is_numeric($_POST["per"])){$perid=(int)$_POST["per"];}
 		}
		if($perid==NULL){ 
			$per = EvalPeriodos::model()->selectPeriodoActivo();
 			if($per == NULL){
				$perid = $perp->id;
			}else{
				$perid = $per->id;
			}
		}
		 
 		$listaa = EvalUsuarios::model()->usuariosReporteEvaluar($perid); 
 		$realfalt = EvalUsuarios::model()->evaluaRealYFaltan();
		
		//printVar($listaa);
		$aData["rbase"]="/evalGenserbeta/";
		$aData["listaa"]=$listaa;
		$aData["realfalt"]=$realfalt;
		$aData["perlas"]=$perlas;
		$aData["perp"]=$perp;
		$aData["perid"]=$perid;
		$aData["per"]=$per;
		$aData["imageurl"]="/evalGenserbeta/img/";
		$this->_renderWrappedTemplate('encuestas', 'avances', $aData);
	}
	
	function CompetenciasConsolidada(){
		$aData=array();	
 		App()->getClientScript()->registerScriptFile(Yii::app()->getConfig('adminscripts')."Highcharts-2.2.0/js/highcharts.js");
		$esAdmin=Permission::model()->getanOterpermision();
		
		if($esAdmin and isset($_POST["id"])){
			$aData["idu"] = $_POST["id"];
			$aData["idp"] = $_POST["periodo"];
			$validador=true;
		}else{
			$u = new CDbCriteria;
			$u->select="iduseval";
			$u->condition = 'uid='.(int)$_SESSION["loginID"];
			$ru = User::model()->find($u); 					

			$periodo = EvalPeriodos::model()->selectLastPeriodoActivo();
			$aData["idp"]=$periodo->id;
			$aData["idu"]=$ru->iduseval;
			$validador=true;
		}
 
		if($validador){
			
			$parTec= EvalParametros::model()->selectParametroInt('idCriteriosTecnicos');
			$colors = array("#0070C0", "#C00000", "#4F6228", "#E46C0A", "#3D96AE", "#DB843D", "#92A8CD", "#A47D7C", "#B5CA92");
			$datosc =EvalUsuarios::model()->selectUsuarioById((int)$aData["idu"]);
			
			$critsComps = EvalCriterios::model()->selectTiposCriteriosOfCargo($datosc->id_cargo);
			
			$per = EvalPeriodos::model()->selectPeriodoById($aData["idp"]);
			if($per == NULL){
				$per = EvalPeriodos::model()->selectLastPeriodoActivo();
			}	
		  
			$resAutTemp = $this->selectRespuestasEvalAuto((int)$aData["idu"],(int)$aData["idp"]);
			$resAut=NULL;$resAutOb=NULL;
			if(isset($resAutTemp[0])){$resAut=$resAutTemp[0];if(isset($resAutTemp[1][1])){$resAutOb=implode(", ",$resAutTemp[1]);}else{$resAutOb=$resAutTemp[1][0];}}
	   
			$resJesTemp = $this->selectRespuestasEvalEvaluadores((int)$aData["idu"],(int)$aData["idp"],3);
			$resJes=NULL;$resJesOb=NULL;
			if(isset($resJesTemp[0])){$resJes=$resJesTemp[0];if(isset($resJesTemp[1][1])){$resJesOb=implode(", ",$resJesTemp[1]);}else{$resJesOb=$resJesTemp[1][0];}}

			$resParTemp = $this->selectRespuestasEvalEvaluadores((int)$aData["idu"],(int)$aData["idp"],2);
			$resPar=NULL;$resParOb=NULL;
			if(isset($resParTemp[0])){$resPar=$resParTemp[0];if(isset($resParTemp[1][1])){$resParOb=implode(", ",$resParTemp[1]);}else{$resParOb=$resParTemp[1][0];}}
		

			$resColTemp = $this->selectRespuestasEvalEvaluadores((int)$aData["idu"],(int)$aData["idp"],4);
			$resCol=NULL;$resColOb=NULL;
			if(isset($resColTemp[0])){$resCol=$resColTemp[0];if(isset($resColTemp[1][1])){$resColOb=implode(", ",$resColTemp[1]);}else{$resColOb=$resColTemp[1][0];}}
		// printVar($resCol);
		//exit;
		
			$tEvals = array();
			$dd = NULL; $dd->nom = "Auto"; $dd->col = "resa"; $dd->por = 0;
			$dd->obs = $resAutOb;
			array_push($tEvals, $dd);
			if(count($datosc->jefes) > 0){
				$dd = NULL; $dd->nom = "Jefe"; $dd->col = "resj"; $dd->por = 0;
				$dd->obs = $resJesOb;
				array_push($tEvals, $dd);
			}
			if(count($datosc->evals) > 0){
				$dd = NULL; $dd->nom = "Pares"; $dd->col = "resp"; $dd->por = 0;
				$dd->obs = $resParOb;
				array_push($tEvals, $dd);
			}
			if(count($datosc->colas) > 0){
				$dd = NULL; $dd->nom = "Colaboradores"; $dd->col = "resc"; $dd->por = 0;
				$dd->obs = $resColOb;
				array_push($tEvals, $dd);
			}
	 
			if(count($datosc->jefes) > 0 && count($datosc->evals) > 0 && count($datosc->colas) > 0){
				$tEvals[0]->por = 0.20;
				$tEvals[1]->por = 0.40;
				$tEvals[2]->por = 0.20;
				$tEvals[3]->por = 0.20;
			}else if(count($datosc->jefes) > 0 && count($datosc->evals) > 0){
				$tEvals[0]->por = 0.25;
				$tEvals[1]->por = 0.50;
				$tEvals[2]->por = 0.25;
			}else if(count($datosc->jefes) > 0 && count($datosc->colas) > 0){
				$tEvals[0]->por = 0.25;
				$tEvals[1]->por = 0.50;
				$tEvals[2]->por = 0.25;
			}else{
				$tEvals[0]->por = 0.40;
				$tEvals[1]->por = 0.60;
			}
			//printVar($tEvals);
			
			/*
			asignando los valores optenidos en cada indicador por cada tipo de evaluacion
			auto, jefes, pares y colaboradores
			*/
			//printVar($resAut);
				
			for($i=0; $i<count($critsComps); $i++){
				$cris = $critsComps[$i]->cris;
				$crt_id = $critsComps[$i]->crt_id;
				for($j=0; $j<count($cris); $j++){
					$inds = $cris[$j]->inds;
					$cr_id = $cris[$j]->cr_id;
					$mejo = "-1";
					$fort = "-1";
					$cris[$j]->mejo = "";
					$cris[$j]->fort = "";
					for($k=0; $k<count($inds); $k++){
						$co_id = $inds[$k]->co_id;
						$find = false;
						for($m=0; $m<count($resAut); $m++){
							$resa = $resAut[$m];
							if($resa->crt_id == $crt_id && $resa->cr_id == $cr_id && $resa->co_id == $co_id){
								$find = true;
								break;
							}
						}
						// si se encuetra la posicion se asignan las respuesttas
						if($find){
							$inds[$k]->resa = ($resAut[$m]->cal>0) ? $resAut[$m]->cal:0;
							$inds[$k]->resj =  ($resJes[$m]->cal>0) ? $resJes[$m]->cal:0;
							$inds[$k]->resp =  ($resPar[$m]->cal>0) ? $resPar[$m]->cal:0;
							$inds[$k]->resc =  ($resCol[$m]->cal>0) ? $resCol[$m]->cal:0;
							$prom = 0;
							$vaaan = 0;
							for($m=0; $m<count($tEvals); $m++){
								if($tEvals[$m]->col == "resa"){
									//$prom += $inds[$k]->resa;
									//$vaaan++;
									$prom += $inds[$k]->resa*$tEvals[$m]->por;
								}else if($tEvals[$m]->col == "resj"){
									//$prom += $inds[$k]->resj;
									//$vaaan++;
									$prom += $inds[$k]->resj*$tEvals[$m]->por;
								}else if($tEvals[$m]->col == "resp"){
									//$prom += $inds[$k]->resp;
									//$vaaan++;
									$prom += $inds[$k]->resp*$tEvals[$m]->por;
								}else if($tEvals[$m]->col == "resc" && ($crt_id*1) != $parTec){
									//$prom += $inds[$k]->resc;
									//$vaaan++;
									$prom += $inds[$k]->resc*$tEvals[$m]->por;
								}else if($tEvals[$m]->col == "resc" && ($crt_id*1) == $parTec){
									if(count($datosc->jefes) > 0 && count($datosc->evals) > 0){
										$prom = $inds[$k]->resa*0.25;
										$prom += $inds[$k]->resj*0.50;
										$prom += $inds[$k]->resp*0.25;
									}else{
										$prom = $inds[$k]->resa*0.40;
										$prom += $inds[$k]->resj*0.60;
									}
								}
							}
							/*
							if($prom > 0){
								$prom =  round ($prom / $vaaan, 2);
							}
							*/

							$inds[$k]->prom = $prom;
							$aaa = EvalComportamientos::model()->selectResumenGeneralByComportamiento($co_id, round($prom, 1));
							$strtemp = "";
							if($aaa != NULL){
								$strtemp = "<li>".$aaa."</li>";
							}
							if($prom >= 8.4){
								$fort.=" ".$strtemp;
							}else{
								$mejo.=" ".$strtemp;
							}
						}
					}
					$cris[$j]->mejo = ("");
					$cris[$j]->fort = ("");
					if(trim($mejo) != "-1"){
						$cris[$j]->mejo = str_replace("-1","",$mejo);
					}
					if(trim($fort) != "-1"){
						$cris[$j]->fort = str_replace("-1","",$fort);
					}
				}
			}		
			//printVar($parTec);
			$aData["critsComps"]=$critsComps;
			$aData["tEvals"]=$tEvals;
			$aData["parTec"]=$parTec;
			$aData["datosc"]=$datosc;
			$aData["colors"]=$colors;
			$aData["per"]=$per;
			$aData["cunive"]=$this->selecUnidadesActivas();
			$aData["imageurl"]="/evalGenserbeta/img/";
			
		 
				
			
			$this->_renderWrappedTemplate('encuestas', 'competenciasConsolidada', $aData);
		}
 	}
 	
	function CompetenciasComparativa(){
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

		$aData=array();	
 		App()->getClientScript()->registerScriptFile(Yii::app()->getConfig('adminscripts')."Highcharts-2.2.0/js/highcharts.js");

		$esAdmin=Permission::model()->getanOterpermision();
		
		if($esAdmin and isset($_POST["id"])){
			$aData["idu"] = $_POST["id"];
			$aData["idp"] = $_POST["periodo"];
			$validador=true;
		}else{
			$u = new CDbCriteria;
			$u->select="iduseval";
			$u->condition = 'uid='.(int)$_SESSION["loginID"];
			$ru = User::model()->find($u); 					

			$periodo = EvalPeriodos::model()->selectLastPeriodoActivo();
			$aData["idp"]=$periodo->id;
			$aData["idu"]=$ru->iduseval;
			$validador=true;
		}		
		 
		if($validador==true){ 
			$parTec= EvalParametros::model()->selectParametroInt('idCriteriosTecnicos');
			$colors = array("#0070C0", "#C00000", "#4F6228", "#E46C0A", "#3D96AE", "#DB843D", "#92A8CD", "#A47D7C", "#B5CA92");
			
			$datosc =EvalUsuarios::model()->selectUsuarioById((int)$aData["idu"]);
			
			$critsComps = EvalCriterios::model()->selectTiposCriteriosOfCargo($datosc->id_cargo);
			
			$per = EvalPeriodos::model()->selectPeriodoById($aData["idp"]);
			if($per == NULL){
				$per = EvalPeriodos::model()->selectLastPeriodoActivo();
			}	
		  
			$resAutTemp = $this->selectRespuestasEvalAuto((int)$aData["idu"],(int)$aData["idp"]);
			$resAut=NULL;$resAutOb=NULL;
			if(isset($resAutTemp[0])){$resAut=$resAutTemp[0];if(isset($resAutTemp[1][1])){$resAutOb=implode(", ",$resAutTemp[1]);}else{$resAutOb=$resAutTemp[1][0];}}
	  
			$resJesTemp = $this->selectRespuestasEvalEvaluadores((int)$aData["idu"],(int)$aData["idp"],3);
			$resJes=NULL;$resJesOb=NULL;
			if(isset($resJesTemp[0])){$resJes=$resJesTemp[0];if(isset($resJesTemp[1][1])){$resJesOb=implode(", ",$resJesTemp[1]);}else{$resJesOb=$resJesTemp[1][0];}}

			$resParTemp = $this->selectRespuestasEvalEvaluadores((int)$aData["idu"],(int)$aData["idp"],2);
			$resPar=NULL;$resParOb=NULL;
			if(isset($resParTemp[0])){$resPar=$resParTemp[0];if(isset($resParTemp[1][1])){$resParOb=implode(", ",$resParTemp[1]);}else{$resParOb=$resParTemp[1][0];}}
		

			$resColTemp = $this->selectRespuestasEvalEvaluadores((int)$aData["idu"],(int)$aData["idp"],4);
			$resCol=NULL;$resColOb=NULL;
			if(isset($resColTemp[0])){$resCol=$resColTemp[0];if(isset($resColTemp[1][1])){$resColOb=implode(", ",$resColTemp[1]);}else{$resColOb=$resColTemp[1][0];}}
	  
		
			$tEvals = array();
			$dd = NULL; $dd->nom = "Auto"; $dd->col = "resa"; $dd->por = 0;
			$dd->obs = $resAutOb;
			array_push($tEvals, $dd);
			if(count($datosc->jefes) > 0){
				$dd = NULL; $dd->nom = "Jefe"; $dd->col = "resj"; $dd->por = 0;
				$dd->obs = $resJesOb;
				array_push($tEvals, $dd);
			}
			if(count($datosc->evals) > 0){
				$dd = NULL; $dd->nom = "Pares"; $dd->col = "resp"; $dd->por = 0;
				$dd->obs = $resParOb;
				array_push($tEvals, $dd);
			}
			if(count($datosc->colas) > 0){
				$dd = NULL; $dd->nom = "Colaboradores"; $dd->col = "resc"; $dd->por = 0;
				$dd->obs = $resColOb;
				array_push($tEvals, $dd);
			}
	 
			if(count($datosc->jefes) > 0 && count($datosc->evals) > 0 && count($datosc->colas) > 0){
				$tEvals[0]->por = 0.20;
				$tEvals[1]->por = 0.40;
				$tEvals[2]->por = 0.20;
				$tEvals[3]->por = 0.20;
			}else if(count($datosc->jefes) > 0 && count($datosc->evals) > 0){
				$tEvals[0]->por = 0.25;
				$tEvals[1]->por = 0.50;
				$tEvals[2]->por = 0.25;
			}else if(count($datosc->jefes) > 0 && count($datosc->colas) > 0){
				$tEvals[0]->por = 0.25;
				$tEvals[1]->por = 0.50;
				$tEvals[2]->por = 0.25;
			}else{
				$tEvals[0]->por = 0.40;
				$tEvals[1]->por = 0.60;
			}
			//printVar($tEvals);
			
			/*
			asignando los valores optenidos en cada indicador por cada tipo de evaluacion
			auto, jefes, pares y colaboradores
			*/
			//printVar($resAut);
			for($i=0; $i<count($critsComps); $i++){
				$cris = $critsComps[$i]->cris;
				$crt_id = $critsComps[$i]->crt_id;
				for($j=0; $j<count($cris); $j++){
					$inds = $cris[$j]->inds;
					$cr_id = $cris[$j]->cr_id;
					$mejo = "-1";
					$fort = "-1";
					$cris[$j]->mejo = "";
					$cris[$j]->fort = "";
					for($k=0; $k<count($inds); $k++){
						$co_id = $inds[$k]->co_id;
						$find = false;
						for($m=0; $m<count($resAut); $m++){
							$resa = $resAut[$m];
							 
							if($resa->crt_id == $crt_id && $resa->cr_id == $cr_id && $resa->co_id == $co_id){
								$find = true;
							 //printVar($resa);
							 //printVar($resa->crt_id."-".$cr_id,"crt_id");
							 //printVar($resa->cr_id."-".$cr_id,"cr_id");
							 //printVar($resa->co_id."-".$co_id,"co_id");
							 //printVar("-----------------------------------");
								break;
							}
						}
						
						// si se encuetra la posicion se asignan las respuesttas
						//$find=true;
						if($find){
							$inds[$k]->resa = ($resAut[$m]->cal>0) ? $resAut[$m]->cal:0;
							$inds[$k]->resj =  ($resJes[$m]->cal>0) ? $resJes[$m]->cal:0;
							$inds[$k]->resp =  ($resPar[$m]->cal>0) ? $resPar[$m]->cal:0;
							$inds[$k]->resc =  ($resCol[$m]->cal>0) ? $resCol[$m]->cal:0;
							$prom = 0;
							$vaaan = 0;
							
							for($m=0; $m<count($tEvals); $m++){
								if($tEvals[$m]->col == "resa"){
									//$prom += $inds[$k]->resa;
									//$vaaan++;
									$prom += $inds[$k]->resa;
								}else if($tEvals[$m]->col == "resj"){
									//$prom += $inds[$k]->resj;
									//$vaaan++;
									$prom += $inds[$k]->resj*$tEvals[$m]->por;
								}else if($tEvals[$m]->col == "resp"){
									//$prom += $inds[$k]->resp;
									//$vaaan++;
									$prom += $inds[$k]->resp*$tEvals[$m]->por;
								}else if($tEvals[$m]->col == "resc" && ($crt_id*1) != $parTec){
									//$prom += $inds[$k]->resc;
									//$vaaan++;
									$prom += $inds[$k]->resc*$tEvals[$m]->por;
								}else if($tEvals[$m]->col == "resc" && ($crt_id*1) == $parTec){
									if(count($datosc->jefes) > 0 && count($datosc->evals) > 0){
										$prom = $inds[$k]->resa*0.25;
										$prom += $inds[$k]->resj*0.50;
										$prom += $inds[$k]->resp*0.25;
									}else{
										$prom = $inds[$k]->resa*0.40;
										$prom += $inds[$k]->resj*0.60;
									}
								}
							}
							/*
							if($prom > 0){
								$prom =  round ($prom / $vaaan, 2);
							}
							*/

							$inds[$k]->prom = $prom;
							$aaa = EvalComportamientos::model()->selectResumenGeneralByComportamiento($co_id, round($prom, 1));
							$strtemp = "";
							if($aaa != NULL){
								$strtemp = "<li>".$aaa."</li>";
							}
							if($prom >= 8.4){
								$fort.=" ".$strtemp;
							}else{
								$mejo.=" ".$strtemp;
							}
						}
					}
					$cris[$j]->mejo = ("");
					$cris[$j]->fort = ("");
					if(trim($mejo) != "-1"){
						$cris[$j]->mejo = str_replace("-1","",$mejo);
					}
					if(trim($fort) != "-1"){
						$cris[$j]->fort = str_replace("-1","",$fort);
					}
				}
			}		
			//printVar($parTec);
			$aData["critsComps"]=$critsComps;
			$aData["tEvals"]=$tEvals;
			$aData["parTec"]=$parTec;
			$aData["datosc"]=$datosc;
			$aData["colors"]=$colors;
			$aData["per"]=$per;
			$aData["cunive"]=$this->selecUnidadesActivas();
			$aData["imageurl"]="/evalGenserbeta/img/";
	 
			$this->_renderWrappedTemplate('encuestas', 'competenciasComparativa', $aData);
		}
 		
	}
	
	function selectRespuestasEvalEvaluadores($idu, $idp,$tipo){
		 
		 
		$controlMod = new CDbCriteria;
		$controlMod->select="id,usid,evalid,idsid,sid,fecha,submitdate,idaEncuestar,idperiodo,tipo";
		$controlMod->condition = 'idaEncuestar=:idaEncuestar and  idaEncuestar<>evalid  and idperiodo=:idperiodo and submitdate<>"" and tipo='.$tipo;
		$controlMod->params = array(':idaEncuestar' => (INT)$idu,":idperiodo"=>(int)$idp); 
 		//printVar($controlMod);exit;
		
		$REGISTROENCUESTA = EvalControl::model()->findAll($controlMod); 
 		
		
		
		$totales=count($REGISTROENCUESTA);
		$valores=array();
		for($i=0;$i<$totales;$i++){
			
			$valores[$i]=$REGISTROENCUESTA[$i]->idsid;
			
		}
		$res=NULL;
		
		if($valores[0]>0){
		 $res= $this->getDatosEncuestaEvaluadores($REGISTROENCUESTA[0]->sid,$valores);
		} 	
 		return($res); 	
		 
	}
	
	function selectRespuestasEvalAuto($idu, $idp){
		
		$controlMod = new CDbCriteria;
		$controlMod->select="id,usid,evalid,idsid,sid,fecha,submitdate,idaEncuestar,idperiodo,tipo";
		$controlMod->condition = 'evalid=:evalid and idaEncuestar=evalid and idperiodo=:idperiodo  and submitdate <>"" ';
		$controlMod->params = array(':evalid' => (INT)$idu,":idperiodo"=>(int)$idp);                        
		$REGISTROENCUESTA = EvalControl::model()->findAll($controlMod); 
 		$id=-1;
 		$sid=-1;
		$res=NULL;
		if(isset($REGISTROENCUESTA[0]->idsid)){
			$id=$REGISTROENCUESTA[0]->idsid;
			$sid=$REGISTROENCUESTA[0]->sid;
			$res= $this->getDatosEncuestaEvaluadores($sid,array(0,$id));
		}
		
 		
			
 		return($res); 	
		 
	}
 	
	 
	function getDatosEncuestaEvaluadores($sid,$idRe){
         $queryString = " show tables like 'lime_survey_".(int)$sid."'";
  		$eguresult = dbExecuteAssoc($queryString);
		$res = $eguresult->readAll();
		$sufijo="_OLD";
		 
		if(isset($res[0])){
			foreach($res[0] as $datos=>$value) {
			 
				if($value=="lime_survey_".(int)$sid){
					$sufijo="";
				}
			 
			}
		}
		//printVar($idRe);
 		$excluir=array("id","token","submitdate","lastpage","startlanguage","startdate","datestamp","ipaddr","refurl");
        $queryString = "SELECT * FROM  lime_survey_".(int)$sid.$sufijo." where id in (".implode(",", $idRe).")";
   		$eguresult = dbExecuteAssoc($queryString);
		$res = $eguresult->readAll();
		 
		$obj=array();
		$cantidad=count($res);
 		$resencu=NULL;
		//$resencu[iterador][id encuesta][id respuestas][id grupo preguntas 'CRITERIO'][id pregunta]
		$parametrizacion=array();
		
 		for($i=0;$i<$cantidad;$i++){
			$contador=1;
			$id=-1;
			$preguntas=0;
 			foreach($res[$i] as $datos=>$values) {
 				$data = NULL; 
 				if($datos=="id"){
					$id=$values;
 				} 
				if(!in_array($datos,$excluir)){
 					$COLUMNA=str_replace("SQ001","",$datos);
					$ambitoColumna=explode("X",$COLUMNA);
 					$resencu[$i][$ambitoColumna[0]][$id][$ambitoColumna[1]][$ambitoColumna[2]]=$values;
					
					
					$queryc = "SELECT
					{{eval_criterios}}.id_tipo_criterio,
					{{eval_criterios}}.id,
					{{groups}}.gid,
					{{groups}}.sid
					FROM
					{{groups}}
					INNER JOIN {{eval_criterios}} ON {{groups}}.idcriterio = {{eval_criterios}}.id
					WHERE
					{{groups}}.gid =".$ambitoColumna[1];

					$gcrt = dbExecuteAssoc($queryc);
					$resgcrt = $gcrt->readAll();
 				 
 					$parametrizacion[$ambitoColumna[2]]["crt_id"]=$resgcrt[0]["id_tipo_criterio"];
					$parametrizacion[$ambitoColumna[2]]["cr_id"]=$resgcrt[0]["gid"];
					//$parametrizacion[$ambitoColumna[2]]["gid"]=$resgcrt[0]["gid"];
					$parametrizacion[$ambitoColumna[2]]["sid"]=$resgcrt[0]["sid"];
					$parametrizacion[$ambitoColumna[2]]["co_id"]=$ambitoColumna[2];
					$preguntas++;
 					
  				}
 			}
 		}
 		unset($parametrizacion[$preguntas-1]);
		$totalRes=count($resencu);
 		$obj=array();
 		$finalobj=array();
		$contaRes=0;
 		foreach($resencu as $key1=>$nivel1){
  			foreach($nivel1 as $key2=>$nivel2){
				foreach($nivel2 as $key3=>$nivel3){
					$tgrupos=count($nivel3);
					$contadorg=0;
 					foreach($nivel3 as $key4=>$nivel4){
					    $total=0;
					    $contador=0;
  						foreach($nivel4 as $key5=>$dato){
							$total+=$dato;
 							if(is_numeric($dato) ){
								$obj[$key5]=$obj[$key5]+$dato;
 							}else{
								$obj[$key5].=$dato.", ";
  							}
							 						
							$contador++;
 						}
						$contadorg++;
 						//printVar($total/($contador*10),$contador);
					}
 				}
 			}
 			$finalobj[$contaRes]=$obj;			
			$contaRes++;
 		}
		
		$totalRes=count($finalobj);
		
 		$contado=0;
		$totalPreguntas=count($finalobj[$totalRes-1]);
		$obj=NULL;
		foreach($finalobj[$totalRes-1] as $co_id=>$valor){
 			if($contado<($totalPreguntas-1)){
				$data=NULL;
				$data->crt_id=$parametrizacion[$co_id]["crt_id"];
				$data->cr_id=$parametrizacion[$co_id]["cr_id"];
				//$data->gid=$parametrizacion[$co_id]["gid"];
				$data->sid=$parametrizacion[$co_id]["sid"];
				$data->co_id=$co_id;
				$data->cal=round($valor/$totalRes);
				$data->total=$totalRes;
				$obj[0][$contado]=$data;
			}else{
				$td=explode(",",$valor);
				unset($td[count($td)-1]);
				$obj[1]=$td;
			}
 			$contado++;
 		}
		 
 		return $obj;
  	}
	
	 
	
    public function Unidades()
    {
	
 	
		$aData=array();
       
		$aData["cunive"]=$this->selecUnidadesActivas();
		$aData["imageurl"]="/evalGenserbeta/img/";
 		 
        $this->_renderWrappedTemplate('estructura', 'Unidades', $aData);
    }
	
	
    public function Proyectos()
    {
	
 	
		$aData=array();
       
		$aData["cunive"]=$this->selecProyectos();
		$aData["imageurl"]="/evalGenserbeta/img/";
 		 
        $this->_renderWrappedTemplate('estructura', 'Proyectos', $aData);
    }
	
	public function Cargos()
    {
	
 	
		$aData=array();
        
		$aData["cunive"]=$this->selecCargos();
		$aData["unis"]=$this->selecUnidadesActivas();
		$aData["ares"]=$this->selecAreas();
		$aData["prys"]=$this->selecProyectos(); 
 		$aData["comps"]=$this->selectAllCompetenciasCriterios(); 
 		$parTec=$this->selectParametroInt('idCriteriosTecnicos'); 
 		$aData["criTec"] = $this->selectCriterioTec($parTec[0]["dataint"]); 
		 
		$aData["imageurl"]="/evalGenserbeta/img/";
 		 
        $this->_renderWrappedTemplate('estructura', 'Cargos', $aData);
    }
	function selectParametroInt($var){
		$data = -1;
        $queryString = "
		SELECT 
		dataint
		FROM {{eval_parametros}}
		WHERE nombre LIKE '".$var."'
		";
		$eguresult = dbExecuteAssoc($queryString);
		$res = $eguresult->readAll();		
  		return $res;
    }
	
	function selectCriterioTec($var){
		$data = NULL;
        $queryString = "
		SELECT 
		id,
		UPPER(nombre) nombre,
		UPPER(descripcion) descripcion
		FROM {{eval_criterios_tipos}}
		WHERE id = ".$var."
		";
		$eguresult = dbExecuteAssoc($queryString);
		$res = $eguresult->readAll();		
  		return $res;
    }	
	
	
	function selecCargos($conn){
		 
		$eguquery = "
 		SELECT
			c.id,
			UPPER(c.empresa) empresa,
			UPPER(c.nombre) nombre,
			UPPER(c.descripcion) descripcion,
			c.sid,
			c.activo,
			c.id_nivel,
			UPPER(u.nombre) unidad,
			UPPER(c.pais) pais,
			UPPER(n.nombre) nom_nivel
		FROM
		{{eval_cargos}} AS c
		INNER JOIN  {{eval_niveles}} AS n ON c.id_nivel = n.id 
		INNER JOIN  {{eval_unidades}}  AS u ON c.unidad = u.id
 		 ORDER BY c.id	
		";
		$eguresult = dbExecuteAssoc($eguquery);
		$aUserInGroupsResult = $eguresult->readAll();		
		
 		return $aUserInGroupsResult;
		
		
	}	
	
	
	 
	  function selectAllCompetenciasCriterios(){
 		$arr = array();
		 $eguquery ='SELECT  
				AA.id_ct,
				AA.nom_ct,
				AA.id_c,
				AA.nom_c,
					CONCAT("[",
						GROUP_CONCAT(
							CONCAT("{id_niv:",AA.id_niv,""),
							CONCAT(",nom_niv:\'",AA.nom_niv,"\'"),
							CONCAT(",pre_niv:",AA.pre_niv,"}")
						)
					,"]") nivs
				FROM (
					SELECT 
					ct.id id_ct ,
					UPPER(ct.nombre) nom_ct,
					c.id id_c,
					UPPER(c.nombre) nom_c,
					cb.id_nivel id_niv,
					n.nombre nom_niv,
					COUNT(*) pre_niv
					FROM lime_eval_criterios_tipos ct, lime_eval_criterios c, lime_eval_comportamientos_base cb, lime_eval_parametros p, lime_eval_niveles n
					WHERE ct.id = c.id_tipo_criterio
					AND cb.id_criterio = c.id
					AND p.dataint <> ct.id
					AND p.nombre LIKE "idCriteriosTecnicos"
					AND cb.id_nivel = n.id
					GROUP BY 
					ct.id ,
					ct.nombre ,
					c.id ,
					c.nombre ,
					cb.id_nivel,
					n.nombre
					ORDER BY ct.id, c.id, cb.id_nivel
				) AA
				GROUP BY AA.id_ct,
				AA.nom_ct,
				AA.id_c,
				AA.nom_c';
		 
 		$eguresult = dbExecuteAssoc($eguquery);
		$res = $eguresult->readAll();		
		
		foreach($res as $datos) {
			$row=(Object)$datos;
			$data = NULL;
			$data->id_ct = $row->id_ct;
			$data->nom_ct = utf8_encode($row->nom_ct);
			$data->crits = $row->crits;
			$pos = -1;
			for($i=0;$i<count($arr);$i++){
				if($arr[$i]->id_ct == $row->id_ct){
					$pos = $i;
					break;
				}
			}
			if($pos == -1){
				$data = NULL;
				$data->id_ct = $row->id_ct;
				$data->nom_ct = utf8_encode($row->nom_ct);
				$data->crits = array();
				$dato = NULL;
				$dato->id_c = $row->id_c;
				$dato->nom_c = utf8_encode($row->nom_c);
				$dato->nivs = $row->nivs;
				array_push($data->crits, $dato);
				array_push($arr, $data);
			}else{
				$dato = NULL;
				$dato->id_c = $row->id_c;
				$dato->nom_c = utf8_encode($row->nom_c);
				$dato->nivs = $row->nivs;
				array_push($arr[$pos]->crits, $dato);				
			}
		}
 		
		
 		return $arr; 
		
	}
	
	function AjaxCargos($OPS=NULL,$cris=NULL){
	
	
		if(isset($_POST) or $OPS!=NULL){
			if(isset($_POST["op"]))$op=$_POST["op"];
			if(isset($_POST["textAccion"]))$op=$_POST["textAccion"];
			if($OPS=="simular")$op=$OPS;
			
			switch($op){
				case "findTecs":
				
								
					$buscarText = $_POST["buscar"]."";
					$buscarText = trim($buscarText);
					$lasPartes = explode (" ",$buscarText);

					$j = count($lasPartes)-1;
					$der = '';
					if(count($lasPartes) == 0){
						$der = $buscarText;
					}
					for($i=0;$i<count($lasPartes);$i++){
						if($i==0){
							$der .= $lasPartes[$i];
						}else{
							$der .= '%'.$lasPartes[$i];
						}
					}
					$der = '%'.$der.'%';
		
					$datos = $this->selectCriteriosTecnios($der);
					 
					for($i=0;$i<count($datos);$i++){
						echo("<div class='linkNoLink' style='cursor:pointer' onclick='obj.addCritTec(".$datos[$i]->id.",".$datos[$i]->id_nivel.",\"".$datos[$i]->nombre."\")'>".$datos[$i]->nombre."</div>");
					}
					if(count($datos) == 0){
						echo("Lo sentimos no se encontro ninguna comportamiento que contenga el nombre de '".$_POST["buscar"]."'");
					}else{
						echo("<div class='linkNoLink' style='cursor:pointer' onclick='jQuery(\"#divTecsFinds\").html(\"\")'>Cerrar</div>");
					}			
				break;
				case "insert":
				
 				
					$par_empresa = $_POST["textEmp"];
					$par_nombre = $_POST["textNom"];
					$par_unidad = $_POST["selectUnidad"];
					$par_area = $_POST["selectArea"];
					$par_proyecto = $_POST["selectProyecto"];
					$par_pais = $_POST["textPai"];
					$par_descripcion = $_POST["textDes"];
					//$par_activo = $_POST["selectActiva"];
					$par_activo = 1;
					$par_id_nivel = 1;//$_POST["selectNivel"];
					$par_comps = $_POST["hiddenCris"];
							$existe= $this->buscarCargo( $par_empresa, $par_nombre);
						  
					if ($existe->id>0){
						$msjText = 0;
						$msjClass = "divGood";
						$msjDisplay = "block";
					}else{
						$par_res = $this->insertarCargo($par_empresa,$par_nombre,$par_descripcion,$par_activo,$par_id_nivel, $par_unidad, $par_area, $par_proyecto, $par_pais);
						$IDCARGO = getLastInsertID(" {{eval_cargos}}");
						if($par_res != 0){
 							
 							$par_res = $this->toCopyComportamientosOfCritNiv( $par_comps, $par_res);
							if($par_res){
								$msjText = 1;
								$msjClass = "divGood";
								$msjDisplay = "block";
								
							
								$QMAX="SELECT MAX(sid) AS max FROM  {{surveys}} LIMIT 1";
								$resMAX = dbExecuteAssoc($QMAX);
								$MAXIMO=0;
								foreach ($resMAX as $datos) {
									$data = NULL;
									$rowtemp=(Object)$datos;
									 
									$MAXIMO=$rowtemp->max+1;
									 
								}
								$INSERSURVEY="INSERT INTO  {{surveys}} (`sid`,`owner_id`,`admin`,`active`,`adminemail`,`anonymized`,`format`,`savetimings`,`template`,`language`,`datestamp`,`usecookie`,`allowregister`,`allowsave`,`autonumber_start`,`autoredirect`,`allowprev`,`printanswers`,`ipaddr`,`refurl`,`datecreated`,`publicstatistics`,`publicgraphs`,`listpublic`,`htmlemail`,`sendconfirmation`,`tokenanswerspersistence`,`assessments`,`usecaptcha`,`usetokens`,`bounce_email`,`tokenlength`,`showxquestions`,`showgroupinfo`,`shownoanswer`,`showqnumcode`,`bounceprocessing`,`showwelcome`,`showprogress`,`questionindex`,`navigationdelay`,`nokeyboard`,`alloweditaftercompletion`)";	 
								$INSERSURVEY.=" VALUES(".$MAXIMO.",".(INT)$_SESSION['loginID'].",'".$_SESSION['full_name']."','Y','fgutierres@talentracking.com','Y','G','Y','default','es','N','N','N','Y',2,'N','N','N','Y','Y','".date("Y-m-d")."','N','N','N','Y','Y','N','N','D','N','fgutierres@talentracking.com',15,'Y','B','Y','X','N','Y','Y',0,0,'N','N')";
								$resIS = dbExecuteAssoc($INSERSURVEY);
								
								 
								$QMAX="SELECT MAX(surveyls_survey_id) AS max,`surveyls_survey_id`,`surveyls_language`,`surveyls_title`,`surveyls_description`,`surveyls_welcometext`,`surveyls_endtext`,`surveyls_email_invite_subj`,`surveyls_email_invite`,`surveyls_email_remind_subj`,`surveyls_email_remind`,`surveyls_email_register_subj`,`surveyls_email_register`,`surveyls_email_confirm_subj`,`surveyls_email_confirm`,`surveyls_dateformat`,`surveyls_attributecaptions`,`email_admin_notification_subj`,`email_admin_notification`,`email_admin_responses_subj`,`email_admin_responses`,`surveyls_numberformat`,`attachments` FROM  {{surveys_languagesettings}} LIMIT 1";
								$resMAX = dbExecuteAssoc($QMAX);
								 
								foreach ($resMAX as $datos=>$value) {
									$data = NULL;
									$rowtemp2=(Object)$datos;
									$Query=' VALUES ( ';
									$COLS=' ( ';
									foreach($value as $rows=>$valores){
									
										if($rows!="max" and $rows!="surveyls_survey_id" and $rows!="surveyls_title" and $rows!="surveyls_description"){
										$valores=trim((str_replace('"',"'",$valores)),chr(0xC2).chr(0xA0));
										$valores=str_replace("\r\n"," ",$valores);
										$valores=str_replace("\t"," ",$valores);
										$valores=str_replace("\n"," ",$valores);
										$valores=str_replace("\r"," ",$valores);
										$valores=trim($valores,"\r\n");
										$valores=trim($valores,"\t");
										$valores=trim($valores,"\n");
										$valores=trim($valores,"\r");
											$Query.='"'.$valores.'",';
											$COLS.=$rows.",";
										}
									}
									$MAXVALUE=($value["max"]+1);
									$area=" el area de ".$par_area;
									if($par_area==""){$area=" el proyecto de ".$par_proyecto;}
									
									$Query.='"'.$MAXVALUE.'","'.$par_nombre.'","Encuesta de clima para '.$par_empresa.' en  '.$area.'")';
									$COLS.="surveyls_survey_id,surveyls_title,surveyls_description )";
									$QuieryFIN="INSERT INTO  {{surveys_languagesettings}} ".$COLS. $Query;
									$resIS2 = dbExecuteAssoc($QuieryFIN); 
								}
								
								
								$resEncuesta=$this->AjaxCargos("simular",$par_comps);
								$contado=0;
								$COLUMNAS="";
								$COLUMNASTIME="";
								foreach($resEncuesta as $keyData){
									//printVar($keyData->nombre);
									//printVar($keyData->descripcion);
									$preguntas=$keyData->preguntas;
 									 
									$QuieryGROUPS="INSERT INTO  {{groups}} (sid,group_name,group_order,description,language)";
									$QuieryGROUPS.=" VALUES (".$MAXIMO.",'".$keyData->nombre."',".$contado.",'".$keyData->descripcion."','es')";
									$resGROUPS=dbExecuteAssoc($QuieryGROUPS); 
 									 
									$idGroup = getLastInsertID(" {{groups}}");
									
									 
									$orden=0;
									$COLUMNASTIME.="`".$MAXIMO."X".$idGroup."time`  float DEFAULT NULL,";
									foreach($preguntas as $datosPReg){
 										$enunciado=$datosPReg->pregunta;
										$ayuda=$datosPReg->ayuda;
										$code=$this->generarCodigo(10);
										
										$QuieryPREGUNTAS="INSERT INTO  {{questions}} (parent_qid,sid,gid,type,title,question,preg,help,other,mandatory,question_order,language,scale_id,same_default,relevance)";
										$QuieryPREGUNTAS.=" VALUES (0,".$MAXIMO.",".$idGroup.",'B','".$code."','".$enunciado."','','".$ayuda."','N','Y',".$orden.",'es',0,0,1)";
 										$resPREGUNTAS=dbExecuteAssoc($QuieryPREGUNTAS); 
 										$idPREGUNTA = getLastInsertID(" {{questions}}");
										
 										$QuieryPREGUNTAS2="INSERT INTO  {{questions}} (parent_qid,sid,gid,type,title,question,preg,help,other,mandatory,question_order,language,scale_id,same_default,relevance)";
										$QuieryPREGUNTAS2.=" VALUES (".$idPREGUNTA.",".$MAXIMO.",".$idGroup.",'T','SQ001','Por favor, seleccione una opción','','','N','Y',1,'es',0,0,1)";
 										$resPREGUNTAS2=dbExecuteAssoc($QuieryPREGUNTAS2); 
 										$idPREGUNTA2 = getLastInsertID(" {{questions}}");
 										
										$COLUMNAS.="`".$MAXIMO."X".$idGroup."X".$idPREGUNTA."SQ001` varchar(5) DEFAULT NULL,";
										$COLUMNASTIME.="`".$MAXIMO."X".$idGroup."X".$idPREGUNTA."time`  float DEFAULT NULL,";
										$orden++; 
									}
									
									
									
									$contado++;
									 
 								}
								$code=$this->generarCodigo(10);
								$orden++;
								$enunciado="OBSERVACIONES Y COMENTARIOS Escriba aquí sus sugerencias, recomendaciones o ejemplos concretos que le permitirán a la persona evaluada mejorar en sus comportamientos";
								$QuieryPREGUNTAS="INSERT INTO  {{questions}} (parent_qid,sid,gid,type,title,question,preg,help,other,mandatory,question_order,language,scale_id,same_default,relevance)";
								$QuieryPREGUNTAS.=" VALUES (0,".$MAXIMO.",".$idGroup.",'T','".$code."','".$enunciado."','','','N','Y',".$orden.",'es',0,0,1)";
								$resPREGUNTAS=dbExecuteAssoc($QuieryPREGUNTAS); 
								$idPREGUNTA = getLastInsertID(" {{questions}}");
						 
								$COLUMNAS.="`".$MAXIMO."X".$idGroup."X".$idPREGUNTA."` text,";
								$COLUMNASTIME.="`".$MAXIMO."X".$idGroup."X".$idPREGUNTA."time`  float DEFAULT NULL,";
 								
  								$createSurvey="CREATE TABLE IF NOT EXISTS `lime_survey_".$MAXIMO."` (
												  `id` int(11) NOT NULL AUTO_INCREMENT,
												  `token` varchar(36) DEFAULT NULL,
												  `submitdate` datetime DEFAULT NULL,
												  `lastpage` int(11) DEFAULT NULL,
												  `startlanguage` varchar(20) NOT NULL,
												  `startdate` datetime NOT NULL,
												  `datestamp` datetime NOT NULL,
												  `ipaddr` text,
												  `refurl` text,
												  ".$COLUMNAS."
												  PRIMARY KEY (`id`),
												  KEY `idx_survey_token_".$MAXIMO."_".$code."` (`token`)
												) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;";
												
								$resCreate=dbExecuteAssoc($createSurvey); 
								
								$createSurveyTime="CREATE TABLE IF NOT EXISTS  `lime_survey_".$MAXIMO."_timings` (
								  `id` int(11) NOT NULL AUTO_INCREMENT,
								  `interviewtime` float DEFAULT NULL,
								  ".$COLUMNASTIME."
								  PRIMARY KEY (`id`)
								) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;";
 								$resCreateTime=dbExecuteAssoc($createSurveyTime); 
								
								$ACTUALIZACARGO="UPDATE {{eval_cargos}} set sid=".$MAXIMO." where id=".$IDCARGO;
								 
								
 								$resACTUALIZACARGO=dbExecuteAssoc($ACTUALIZACARGO); 
								
  							}else{
								$msjText = 2;
								$msjClass = "divError";
								$msjDisplay = "block";
							}			
						}else{
							$msjText = "Ocurrio un error creando el cargo";
							$msjClass = "divError";
							$msjDisplay = "block";
						}
							
					}
					$url="?msjText=".$msjText; 
					// printVar($url);
					$this->getController()->redirect(array('admin/estructura/cargos'.$url)); 
 				break;
				
				case "update":
 					$POST["nombre"]=strtoupper($_POST["textNom"]);
					$POST["empresa"]=strtoupper($_POST["textEmp"]);
					$POST["pais"]=$_POST["textPai"];
					$POST["descripcion"]=$_POST["textDes"];
					$POST["unidad"]=(Int)$_POST["selectUnidad"];
					$POST["area"]=(Int)$_POST["selectArea"];
					$POST["proyecto"]=(Int)$_POST["selectProyecto"];
					$POST["textId"]=(Int)$_POST["textId"];
					$Error=0;
					if($POST["nombre"]=="" ){$Error=1;}
					if($POST["empresa"]==""){$Error=2;}
					if($POST["pais"]==""){$Error=3;}
					if($POST["descripcion"]==""){$Error=4;}
					if($POST["area"]==""){$Error=4;}
					if($POST["unidad"]==""){$Error=7;}
					if($POST["proyecto"]==""){$Error=5;}
					if($POST["textId"]==""){$Error=6;}
 					
 					
					
 					unset($_POST); 
					if($Error==0){
						$ugid = EvalCargos::model()->updateCargos($POST,(Int)$POST["textId"]);
						//$aData["cunive"]=$this->selecAreas();
 						if($ugid=="OK"){
							$msjText = 11;
							$msjClass = "divGood";
							$msjDisplay = "block";
						}else{
						
							$msjText =22;
							$msjClass = "divError";
							$msjDisplay = "block";
						}
						
						
						
						//$this->_renderWrappedTemplate('estructura', 'Areas', $aData);
					} else{
						
						$msjText = 33;
						$msjClass = "divError";
						$msjDisplay = "block";
					
					}
					
					$url="?msjText=".$msjText;

					$this->getController()->redirect(array('admin/estructura/cargos/'.$url));  
 				break;
				case "eliminar":
				
					$RES= EvalCargos::model()->delCargo((Int)$_POST["id"]);
					unset($_POST);
					echo $RES;
 				break;
				case "simular":
					 
					if(isset($_POST["cris"]))$cris=$_POST["cris"];
					$lista = json_decode(utf8_encode(str_replace("\\","",$cris)));
					$arr=array();
					for($i=0;$i<count($lista);$i++){
						 	
						$queryString = "
									SELECT 
									cr.id cri_id, 
									UPPER(cr.nombre) cri_nombre,
									UPPER(cr.descripcion) cri_descripcion,
									cr.id_tipo_criterio cri_tipo_cri, 
									cr.id_nivel niv_id,
									UPPER(ni.nombre) niv_nombre,
									COUNT(*)
									FROM {{eval_comportamientos_base}} co, {{eval_criterios}} cr, {{eval_niveles}} ni
									WHERE cr.id = ".(int)$lista[$i]->idc."
									AND ni.id = ".(int)$lista[$i]->idn."
									AND co.id_criterio = cr.id
									AND co.id_nivel = ni.id
									GROUP BY 
									cr.id, 
									UPPER(cr.nombre),
									UPPER(cr.descripcion),
									cr.id_tipo_criterio,
									cr.id_nivel,
									UPPER(ni.nombre)
									";
							
 						/*
						 $queryString = "SELECT
										{{eval_criterios}}.id AS cri_id,
										{{eval_criterios}}.nombre AS cri_nombre,
										{{eval_criterios}}.descripcion AS cri_descripcion,
										{{eval_niveles}}.id AS niv_id,
										{{eval_niveles}}.nombre AS niv_nombre,
										Count(*) as TOTALES,
										{{eval_criterios}}.id_tipo_criterio AS cri_tipo_cri
										FROM
										{{eval_comportamientos_base}}
										INNER JOIN {{eval_criterios}} ON {{eval_comportamientos_base}}.id_criterio = {{eval_criterios}}.id
										INNER JOIN {{eval_niveles}} ON {{eval_comportamientos_base}}.id_nivel = {{eval_niveles}}.id
										where {{eval_criterios}}.id=".(Int)$lista[$i]->idc." and {{eval_niveles}}.id = ".(Int)$lista[$i]->idn."
										GROUP BY
										{{eval_criterios}}.id,
										{{eval_criterios}}.nombre,
										{{eval_criterios}}.descripcion,
										{{eval_niveles}}.id,
										{{eval_niveles}}.descripcion,
										{{eval_criterios}}.id_tipo_criterio";
								*/	 
						$res = dbExecuteAssoc($queryString);
 						 
						 
						foreach ($res as $datos) {
							$data = NULL;
							$row=(Object)$datos;
 					 	
							$data->idGrupo = $row->cri_id;
							$data->idEncuesta = 1;
							$data->nombre = utf8_encode($row->cri_nombre);
							$data->descripcion = utf8_encode($row->cri_descripcion);
							$data->orden = 1;
							$data->preguntas = $this->GetRespuestas((int)$row->cri_id, (int)$row->niv_id);
							array_push($arr, $data);							
							
							
							
							/*$data->nombre = utf8_encode($row->nombre);
							$data->descripcion = utf8_encode($row->descripcion);
							$data->pre = $row->pre;
							$data->id = $row->id;
							$data->id_nivel = $row->id_nivel;
							array_push($arr, $data);*/
						}						 
						 
						 
						 
					}

					if(isset($_POST["cris"])){
						$aData["cunive"]=$arr;
						$aData["imageurl"]="/evalGenserbeta/img/";
						$this->_renderWrappedTemplate('estructura', 'Simulador', $aData);		
					}else{
					
					
						return $arr;
					
					}	
				break;
				
			
			}
		}
	
	}
	
	function generarCodigo($longitud) {
	 $key = '';
	 $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
	 $max = strlen($pattern)-1;
	 for($i=0;$i < $longitud;$i++) $key .= $pattern[mt_rand(0,$max)];
	 return $key;
	}
	
 	function toCopyComportamientosOfCritNiv($datos, $idCargo){
		$data = json_decode(str_replace("\\","",$datos));
		$van = 0;
		for($i=0;$i<count($data);$i++){
  			$id = 0;
 			$queryString = "
			INSERT INTO {{eval_comportamientos}} (nombre, descripcion, id_cargo, id_criterio, id_nivel, activo)
			SELECT 
			nombre, descripcion, ".$idCargo.", id_criterio, id_nivel, 1
			FROM {{eval_comportamientos_base}}
			WHERE id_criterio = ".$data[$i]->idc."
			AND id_nivel = ".$data[$i]->idn."
			";	
			//printVar($queryString);
			$res = dbExecuteAssoc($queryString);
 			if($res){
				$van++;
			}
		}
		if($van == count($data)){
			return true;
		}else{
			return false;
		}
	}		
	
	
	function GetRespuestas( $idc, $idn){
        $arr = array();
        $queryString = "
		SELECT 
		co.id, 
		UPPER(co.nombre) nombre,
		UPPER(co.descripcion) descripcion,
		1 id_cargo,
		co.id_criterio,
		co.id_nivel niv_id,
		UPPER(ni.nombre) niv_nombre,
		1 activo
		FROM {{eval_comportamientos_base}} co, {{eval_niveles}} ni
		WHERE co.id_criterio = ".(Int)$idc."
		AND ni.id = ".(Int)$idn."
		AND co.id_nivel = ni.id
		ORDER BY co.id
		"; 
		 
		/*$queryString = "SELECT
			{{eval_comportamientos_base}}.id,
			UPPER({{eval_comportamientos_base}}.nombre) nombre,
			UPPER({{eval_comportamientos_base}}.descripcion) descripcion,
			1 id_cargo,
			{{eval_comportamientos_base}}.id_criterio,
			{{eval_comportamientos_base}}.id_nivel niv_id,
			UPPER({{eval_niveles}}.nombre) niv_nombre,
			1 activo
			FROM
			{{eval_comportamientos_base}}
 			INNER JOIN {{eval_niveles}} ON {{eval_comportamientos_base}}.id_nivel = {{eval_niveles}}.id
			where {{eval_comportamientos_base}}.id=".(Int)$idc." and {{eval_niveles}}.id = ".(Int)$idn."
			";
		*/
		
        $res = dbExecuteAssoc($queryString);
 		
		
		 		 
		foreach ($res as $datos) {
			$data = NULL;
			$row=(Object)$datos;
			
			$data->item = $row->id;
			$data->idGrupo = $idc;
			$data->tiporespuesta = 1;//utf8_encode($row->tiporespuesta);
			$data->pregunta = utf8_encode($row->nombre);			
			$data->ayuda = utf8_encode($row->descripcion);
			if($row->activo == 1){
				$data->borrada = "N";
			}else{
				$data->borrada = "S";
			}
			 
			$data->respuestas = $this->GetPreguntas($conn, 1);
			array_push($arr, $data);
		}
		 //printVar($arr);
		return $arr;
    }
	
	function GetPreguntas($idPregunta){
		$arr = array();
		$data = NULL; $data->item = 1; $data->valor = 1;
		array_push($arr, $data);
		$data = NULL; $data->item = 2; $data->valor = 2;
		array_push($arr, $data);
		$data = NULL; $data->item = 3; $data->valor = 3;
		array_push($arr, $data);
		$data = NULL; $data->item = 4; $data->valor = 4;
		array_push($arr, $data);
		$data = NULL; $data->item = 5; $data->valor = 5;
		array_push($arr, $data);
		$data = NULL; $data->item = 6; $data->valor = 6;
		array_push($arr, $data);
		$data = NULL; $data->item = 7; $data->valor = 7;
		array_push($arr, $data);
		$data = NULL; $data->item = 8; $data->valor = 8;
		array_push($arr, $data);
		$data = NULL; $data->item = 9; $data->valor = 9;
		array_push($arr, $data);
		$data = NULL; $data->item = 10; $data->valor = 10;
		array_push($arr, $data);
		
 		return $arr;
    }	
	
	
	
	
	function insertarCargo($empresa,$nombre,$descripcion,$activo,$id_nivel,$unidad, $area, $proyecto, $pais){
	
		
			$POST["nombre"]=strtoupper($nombre);
			$POST["empresa"]=strtoupper($empresa);
			$POST["descripcion"]=$descripcion;
			$POST["activo"]=$activo;
			$POST["id_nivel"]=(Int)$id_nivel;
			$POST["unidad"]=(Int)$unidad;
			$POST["area"]=(Int)$area;
			$POST["proyecto"]=(Int)$proyecto;
			$POST["pais"]=strtoupper($pais);
 			$Error=0;
			if($POST["nombre"]=="" ){$Error=1;}
			if($POST["empresa"]==""){$Error=2;}
			if($POST["descripcion"]==""){$Error=3;}
			if($POST["activo"]==""){$Error=4;}
			if($POST["id_nivel"]==""){$Error=5;}
			if($POST["unidad"]==""){$Error=6;}
			if($POST["area"]==""){$Error=7;}
			if($POST["proyecto"]==""){$Error=8;}
			if($POST["pais"]==""){$Error=9;}
 			
			if($POST["activa"]!=1 and $POST["activa"]!=0){$Error=5;}
			$aData=array();
			$aData["error"]=$Error;
			$aData["imageurl"]="/evalGenserbeta/img/";
			unset($_POST); 
			if($Error==0){
				$ugid = EvalCargos::model()->addCargo($POST);
				return $ugid ;
				//$aData["cunive"]=$this->selecAreas();
				//$aData["imageurl"]="/evalGenserbeta/img/";
				//$aData["error"]=0;
				// $this->getController()->redirect(array('admin/estructura/cargos'));  
				//$this->_renderWrappedTemplate('estructura', 'Areas', $aData);
			}else{
				 
				 
//$this->getController()->redirect(array('admin/estructura/cargos'));  
				//$this->_renderWrappedTemplate('estructura', 'Areas', $aData);
			}	
	
	
	
	 
	}	

	
 


	function buscarCargo($empresa,$nombre){
	
		$queryString="empresa='".$empresa."' and nombre='".$nombre."'";
 		$criteria = new CDbCriteria;
		$criteria->select="id";
		$criteria->condition = $queryString;
		
 		$eguresult = EvalCargos::model()->find($criteria);		
	   
	   
		return $eguresult;
	} 

	
	
	function selectCriteriosTecnios($name){
		$arr = array();
        $queryString = sprintf("
		SELECT 
		c.id,
		UPPER(c.nombre) nombre,
		UPPER(c.descripcion) descripcion,
		cb.id_nivel,
		COUNT(*) pre
		FROM {{eval_criterios}} c, {{eval_criterios_tipos}} ct, {{eval_parametros}} p, {{eval_comportamientos_base}} cb
		WHERE c.id_tipo_criterio = ct.id
		AND ct.id = p.dataint
		AND p.nombre LIKE 'idCriteriosTecnicos'
		AND cb.id_criterio = c.id
		AND UPPER(c.nombre) like UPPER(%s)
		GROUP BY c.id,
		UPPER(c.nombre) ,
		UPPER(c.descripcion) ,
		cb.id_nivel
		","'".$name."'");
		 
 		$eguresult = dbExecuteAssoc($queryString);
		$res = $eguresult->readAll();		
 		foreach ($res as $datos) {
			$data = NULL;
			$row=(Object)$datos;
			$data->nombre = utf8_encode($row->nombre);
			$data->descripcion = utf8_encode($row->descripcion);
			$data->pre = $row->pre;
			$data->id = $row->id;
			$data->id_nivel = $row->id_nivel;
			array_push($arr, $data);
		}
		 
		return $arr;
    }	
	
	
	
    public function Areas()
    {
	
 	
		$aData=array();
       
		$aData["cunive"]=$this->selecAreas();
		$aData["imageurl"]="/evalGenserbeta/img/";
 		 
        $this->_renderWrappedTemplate('estructura', 'Areas', $aData);
    }
	
	
	
	protected function selecAreas($id=NULL){
		 if(isset($_POST["id"])){$id=(Int)$_POST["id"];}
		$criteria = new CDbCriteria;
		$sel="id>0";
		if($id>0){
			$sel=" id=".$id;
		}
		$criteria->select = 'id,UPPER(nombre) nombre, UPPER(empresa) empresa,activa, row_date';
		$criteria->condition = $sel.' order by nombre';
 		$areas = EvalAreas::model()->findAll($criteria);		
 		return $areas;
    }
			
	
	
	protected function selecProyectos($id=NULL){
		 if(isset($_POST["id"])){$id=(Int)$_POST["id"];}
		$criteria = new CDbCriteria;
		$sel="id>0";
		if($id>0){
			$sel=" id=".$id;
		}
		$criteria->select = 'id,UPPER(nombre) nombre, UPPER(empresa) empresa,activa, row_date';
		$criteria->condition = $sel.' order by nombre';
 		$proyectos = EvalProyectos::model()->findAll($criteria);		
 		return $proyectos;
    }
			
	
				
	public function selecProyectosConsulta($id=NULL){
		 if(isset($_POST["id"])){$id=(Int)$_POST["id"];}
		$criteria = new CDbCriteria;
		$sel="id>0";
		if($id>0){
			$sel=" id=".$id;
		}
		$criteria->select = 'id,UPPER(nombre) nombre, UPPER(empresa) empresa,activa, row_date';
		$criteria->condition = $sel.' order by nombre';
 		$Proyectos = EvalProyectos::model()->findAll($criteria);	

		$res["textId"]=$Proyectos[0]->id;
 		$res["textNom"]=$Proyectos[0]->nombre;
		$res["textEmp"]=$Proyectos[0]->empresa;
		$res["selectActiva"]=$Proyectos[0]->activa;
  		 
		echo   json_encode((object)$res); exit;
     }
	
	
	
	protected function selecUnidadesActivas($id=NULL){
		 if(isset($_POST["id"])){$id=(Int)$_POST["id"];}
		$criteria = new CDbCriteria;
		$sel="id>0";
		if($id>0){
			$sel=" id=".$id;
		}
		$criteria->select = 'id,UPPER(codigo) codigo,UPPER(nombre) nombre, UPPER(empresa) empresa,activa, row_date';
		$criteria->condition = $sel.' order by nombre';
 		$unidades = EvalUnidades::model()->findAll($criteria);		
 		return $unidades;
    }
		
		
	public function selecUnidadesActivasConsulta($id=NULL){
		 if(isset($_POST["id"])){$id=(Int)$_POST["id"];}
		$criteria = new CDbCriteria;
		$sel="id>0";
		if($id>0){
			$sel=" id=".$id;
		}
		$criteria->select = 'id,UPPER(codigo) codigo,UPPER(nombre) nombre, UPPER(empresa) empresa,activa, row_date';
		$criteria->condition = $sel.' order by nombre';
 		$unidades = EvalUnidades::model()->findAll($criteria);	

		$res["textId"]=$unidades[0]->id;
		$res["textCod"]=$unidades[0]->codigo;
		$res["textNom"]=$unidades[0]->nombre;
		$res["textEmp"]=$unidades[0]->empresa;
		$res["selectActiva"]=$unidades[0]->activa;
  		 
		echo   json_encode((object)$res); exit;
     }
				
	public function selecAreasConsulta($id=NULL){
		 if(isset($_POST["id"])){$id=(Int)$_POST["id"];}
		$criteria = new CDbCriteria;
		$sel="id>0";
		if($id>0){
			$sel=" id=".$id;
		}
		$criteria->select = 'id,UPPER(nombre) nombre, UPPER(empresa) empresa,activa, row_date';
		$criteria->condition = $sel.' order by nombre';
 		$area = EvalAreas::model()->findAll($criteria);	

		$res["textId"]=$area[0]->id;
 		$res["textNom"]=$area[0]->nombre;
		$res["textEmp"]=$area[0]->empresa;
		$res["selectActiva"]=$area[0]->activa;
  		 
		echo   json_encode((object)$res); exit;
     }
	
	


	 


	
	
	function insertAreas(){
		 
       // return $id;
		 
 		$POST["nombre"]=strtoupper($_POST["textNom"]);
 		$POST["empresa"]=strtoupper($_POST["textEmp"]);
		$POST["activa"]=$_POST["selectActiva"];
 		$Error=0;
		if($POST["nombre"]=="" ){$Error=1;}
 		if($POST["empresa"]==""){$Error=3;}
		if($POST["activa"]==""){$Error=4;}
		if($POST["activa"]!=1 and $POST["activa"]!=0){$Error=5;}
		$aData=array();
		$aData["error"]=$Error;
		$aData["imageurl"]="/evalGenserbeta/img/";
		unset($_POST); 
		if($Error==0){
			$ugid = EvalAreas::model()->addArea($POST);
			
			$aData["cunive"]=$this->selecAreas();
			$aData["imageurl"]="/evalGenserbeta/img/";
			$aData["error"]=0;
			 $this->getController()->redirect(array('admin/estructura/areas'));  
			//$this->_renderWrappedTemplate('estructura', 'Areas', $aData);
		}else{
			 
			$aData["nombre"]=$_POST["textNom"];
 			$aData["empresa"]=$_POST["textEmp"];
			$aData["activa"]=$_POST["selectActiva"];
			$this->getController()->redirect(array('admin/estructura/areas'));  
			//$this->_renderWrappedTemplate('estructura', 'Areas', $aData);
		}
 	   
	}
	
	function updateAreas(){
		 
		
       // return $id;
		 
 		$POST["nombre"]=strtoupper($_POST["textNom"]);
 		$POST["empresa"]=strtoupper($_POST["textEmp"]);
		$POST["activa"]=$_POST["selectActiva"];
		$POST["textId"]=(Int)$_POST["textId"];
 		$Error=0;
		if($POST["nombre"]=="" ){$Error=1;}
 		if($POST["empresa"]==""){$Error=3;}
		if($POST["activa"]==""){$Error=4;}
		if($POST["activa"]!=1 and $POST["activa"]!=0){$Error=5;}
		$aData=array();
		$aData["error"]=$Error;
		$aData["imageurl"]="/evalGenserbeta/img/";
		unset($_POST); 
		if($Error==0){
			$ugid = EvalAreas::model()->updateArea($POST,(Int)$POST["textId"]);
 			$aData["cunive"]=$this->selecAreas();
			$aData["imageurl"]="/evalGenserbeta/img/";
			$aData["error"]=0;
			$this->getController()->redirect(array('admin/estructura/areas'));  
			//$this->_renderWrappedTemplate('estructura', 'Areas', $aData);
		}else{
			 
			$aData["nombre"]=$_POST["textNom"];
 			$aData["empresa"]=$_POST["textEmp"];
			$aData["activa"]=$_POST["selectActiva"];
			$this->getController()->redirect(array('admin/estructura/areas')); 
			//$this->_renderWrappedTemplate('estructura', 'Areas', $aData);
		}		
		
 	}	
 	
	
	 function eliminaArea(){
	 
		$ugid[0] = EvalAreas::model()->delArea((Int)$_GET["id"]);
		unset($_GET);
		echo json_encode($ugid);
		
	}
	
	
	
	 
	
	function insertProyecto(){
		 
       // return $id;
		 
 		$POST["nombre"]=strtoupper($_POST["textNom"]);
 		$POST["empresa"]=strtoupper($_POST["textEmp"]);
		$POST["activa"]=$_POST["selectActiva"];
 		$Error=0;
		if($POST["nombre"]=="" ){$Error=1;}
 		if($POST["empresa"]==""){$Error=3;}
		if($POST["activa"]==""){$Error=4;}
		if($POST["activa"]!=1 and $POST["activa"]!=0){$Error=5;}
		$aData=array();
		$aData["error"]=$Error;
		$aData["imageurl"]="/evalGenserbeta/img/";
		unset($_POST); 
		if($Error==0){
			$ugid = EvalProyectos::model()->addProyecto($POST);
			
			$aData["cunive"]=$this->selecProyectos();
			$aData["imageurl"]="/evalGenserbeta/img/";
			$aData["error"]=0;
			 $this->getController()->redirect(array('admin/estructura/Proyectos'));  
			//$this->_renderWrappedTemplate('estructura', 'Areas', $aData);
		}else{
			 
			$aData["nombre"]=$_POST["textNom"];
 			$aData["empresa"]=$_POST["textEmp"];
			$aData["activa"]=$_POST["selectActiva"];
			$this->getController()->redirect(array('admin/estructura/Proyectos'));  
			//$this->_renderWrappedTemplate('estructura', 'Areas', $aData);
		}
 	   
	}
	
	function updateProyectos(){
		 
		
       // return $id;
		 
 		$POST["nombre"]=strtoupper($_POST["textNom"]);
 		$POST["empresa"]=strtoupper($_POST["textEmp"]);
		$POST["activa"]=$_POST["selectActiva"];
		$POST["textId"]=(Int)$_POST["textId"];
 		$Error=0;
		if($POST["nombre"]=="" ){$Error=1;}
 		if($POST["empresa"]==""){$Error=3;}
		if($POST["activa"]==""){$Error=4;}
		if($POST["activa"]!=1 and $POST["activa"]!=0){$Error=5;}
		$aData=array();
		$aData["error"]=$Error;
		$aData["imageurl"]="/evalGenserbeta/img/";
		unset($_POST); 
		if($Error==0){
			$ugid = EvalProyectos::model()->updateProyecto($POST,(Int)$POST["textId"]);
 			$aData["cunive"]=$this->selecAreas();
			$aData["imageurl"]="/evalGenserbeta/img/";
			$aData["error"]=0;
			$this->getController()->redirect(array('admin/estructura/Proyectos'));  
			//$this->_renderWrappedTemplate('estructura', 'Areas', $aData);
		}else{
			$aData["nombre"]=$_POST["textNom"];
 			$aData["empresa"]=$_POST["textEmp"];
			$aData["activa"]=$_POST["selectActiva"];
			$this->getController()->redirect(array('admin/estructura/Proyectos')); 
			//$this->_renderWrappedTemplate('estructura', 'Areas', $aData);
		}		
		
 	}	
 	
 	 function eliminaProyecto(){
	 
		$ugid[0] = EvalProyectos::model()->delProyecto((Int)$_GET["id"]);
		unset($_GET);
		echo json_encode($ugid);
		
	}
	
	
	
	function insert(){
		 
       // return $id;
		 
 		$POST["nombre"]=strtoupper($_POST["textNom"]);
		$POST["codigo"]=strtoupper($_POST["textCod"]);
		$POST["empresa"]=strtoupper($_POST["textEmp"]);
		$POST["activa"]=$_POST["selectActiva"];
 		$Error=0;
		if($POST["nombre"]=="" ){$Error=1;}
		if($POST["codigo"]=="" ){$Error=2;}
		if($POST["empresa"]==""){$Error=3;}
		if($POST["activa"]==""){$Error=4;}
		if($POST["activa"]!=1 and $POST["activa"]!=0){$Error=5;}
		$aData=array();
		$aData["error"]=$Error;
		$aData["imageurl"]="/evalGenserbeta/img/";
		unset($_POST); 
		if($Error==0){
			 
			 $this->getController()->redirect(array('admin/estructura/unidades')); 
			//$this->_renderWrappedTemplate('estructura', 'index', $aData);
		}else{
			 
			$aData["nombre"]=$_POST["textNom"];
			$aData["codigo"]=$_POST["textCod"];
			$aData["empresa"]=$_POST["textEmp"];
			$aData["activa"]=$_POST["selectActiva"];
			$this->getController()->redirect(array('admin/estructura/unidades')); 
			$this->_renderWrappedTemplate('estructura', 'unidades', $aData);
		}
 	   
	}
	
	protected function eliminarUnidad($conn,$id){
		$queryString = "DELETE FROM unidades WHERE id = "+$id;
        $Result = mysql_query($queryString, $conn) or die("error en ".get_class($this)."<br><pre>".$queryString."</pre><br>".mysql_error());
        return $Result;
	}
	
	function update(){
		 
		
       // return $id;
		 
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
		$aData["imageurl"]="/evalGenserbeta/img/";
		unset($_POST); 
		if($Error==0){
			$ugid = EvalUnidades::model()->updateUnidad($POST,(Int)$POST["textId"]);
 			$aData["cunive"]=$this->selecUnidadesActivas();
			$aData["imageurl"]="/evalGenserbeta/img/";
			$aData["error"]=0;
			 
			//$this->_renderWrappedTemplate('estructura', 'index', $aData);
			$this->getController()->redirect(array('admin/estructura/unidades')); 
		}else{
			 /*
			$aData["nombre"]=$_POST["textNom"];
			$aData["codigo"]=$_POST["textCod"];
			$aData["empresa"]=$_POST["textEmp"];
			$aData["activa"]=$_POST["selectActiva"];
			$this->_renderWrappedTemplate('estructura', 'index', $aData);*/
			$this->getController()->redirect(array('admin/estructura/unidades')); 
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