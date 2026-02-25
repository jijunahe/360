<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(E_ALL); ini_set('display_errors', '1');
$documentroot=str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"]);
require_once($documentroot.'application/extensions/PHPMailer/class.phpmailer.php');
require_once($documentroot.'application/extensions/xls/Excel/reader.php');
require_once($documentroot.'application/extensions/class_sql_inject.php');
class Usuarios extends Survey_Common_Action
{
	     function __construct($controller, $id)
    {
        parent::__construct($controller, $id);

        Yii::app()->loadHelper('database');
    }

	public function cargar(){
		$dir_subida ='/var/www/bateria/uploads/';
		$subname=explode(".",$_FILES['fichero_usuario']['name']);
		$index=count($subname)-1;
 		if(strtolower($subname[$index])=="xls"){
			$archivotemporal=RandomString(15,TRUE,TRUE,FALSE);
			$fichero_subido = $dir_subida . basename($archivotemporal.".xls");
  			if (move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $fichero_subido)) {
				$data = new Spreadsheet_Excel_Reader();
				$data->setOutputEncoding('CP1251');
 				$data->read($fichero_subido);
				$registros=$data->sheets[0]["numRows"];
				$columnas=$data->sheets[0]["numCols"];
				if($columnas==3){
					$obj=$data->sheets[0]["cells"];
					$arrayusu=array();
					$error="OK";
					$error2="OK";
 					foreach($obj as $key=>$datos){
						if($key>1){
 							$cedula=trim($datos[1],"");
							$nombres=trim($datos[2],"");
							$email=$this->escape($datos[3]);
 							echo  $key."). ".$cedula." ".$nombres." ".$email."<br>";
							if(!validateEmailAddress($email)){
								$error="<br>Email no valido en el registro ".$key;
							}
 							if($email==""){
								$error.="<br>Falta el dato de email en el registro ".$key;
							}
 							if($cedula==""){
								$error.="<br>Falta el dato de documento en el registro ".$key;
							}
  							if($nombres==""){
								$error.="<br>Falta el dato de nombres en el registro ".$key;
							}
							printVar($error);
 							$password=RandomString(6,TRUE,TRUE,FALSE);
							$ut=explode(" ",$nombres);
							$temp1=sanear_string($ut[0]);
							$temp1=substr($temp1, 0, 4);
							if(isset($ut[1])){
								$temp2=sanear_string($ut[1]);
								$temp2=substr($temp2, 0, 4);
								$temp1=$temp1.".".$temp2;
							} 
							$usuario=substr($temp1, 0, 8);
							$vaida=FALSE;	
							while($vaida==FALSE){
 								$test = new CDbCriteria;
								$test->condition = 'alias="'.$usuario.'"';
								$testr = EvalUsuarios::model()->find($test);
 								$ua = new CDbCriteria;
								$ua->condition = 'users_name="'.$usuario.'"';
								$uar = User::model()->find($ua);
  								if($testr->alias!=$usuario and $uar->users_name!=$usuario){
									$vaida=TRUE;
								}else{
 									$usuario=$usuario.".".RandomString(4,FALSE,TRUE,FALSE);
 								}
							}
  							if($error=="OK"){
 								$dat = new EvalUsuarios();
								$dat->documento=$this->escape($cedula);
								$dat->nombres=$this->escape($nombres);
								$dat->apellidos="NR";
								$dat->email=$email;
								$dat->id_unidad=(int)$_POST["undisp"];
								$dat->perfil=2;
								$dat->uid_creador=(int)$_SESSION['loginID'];
								$dat->alias=$usuario;
								$dat->clave=$password;
								$dat->activo=1;
								$dat->save();
								//printVar($dat);
 								if($dat->id>0){
									array_push($arrayusu,$dat->id);
									$iNewUID = User::model()->insertUser($usuario,$password,$this->escape($nombres), Yii::app()->session['loginID'], $this->escape($email),$dat->id);
									$perfil="default";
									$entity="template";
									Permission::model()->insertSomeRecords(array('uid' => $iNewUID, 'permission' => $perfil, 'entity'=>$entity, 'read_p' => 1, 'entity_id'=>0));
								}else{
									$error.="<br> ERROR Usuario ".$usuario."<br> ";
									
									$error.="Empresa ".(int)$_POST["undisp"]."<br>";
									$error.="Creador ".(int)$_SESSION['loginID']."<br>";
									$error.="Cedula ".$this->escape($cedula)."<br>";
 								}
							}	
						}
					}
					echo $error."<br>";
					echo $error2."<br>";
					if(count($arrayusu)>0){
						echo "<br><br>Agregando a Batería";
						$this->agregarpoblacion((int)$_POST["bateria"],$arrayusu,(int)$_POST["valida"]);
					}
 				} 
 				unset($fichero_subido);
				//echo "El fichero es válido y se subió con éxito.\n";
			} else {
				echo "¡Posible ataque de subida de ficheros!\n";
			}
		}
	}

	public function agregarpoblacion($idBateria,$poblacion,$enviaremail=TRUE){
 	
		if($idBateria>0){
			$poblacion=$poblacion;
			$validad=array();
			foreach($poblacion as $dato){
				array_push($validad,(int)$dato);
			}
			$dat = new CDbCriteria;
			$dat->condition = 'idbateria='.$idBateria;
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
							if($enviaremail==TRUE){
								$this->sendmail($uss,'Batería de encuestas');
							}
							array_push($arrtestUss,$usuario); 						
						}
						 
					}
					 
				} 
			}
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
	
 	
    /**
    * Show users table
    */
	public function resultado(){
		$validaini=EvalUsuarios::model()->vaidausr(false);
		$aData=array();
 		if((int)$_POST["idus"]>0 and $validaini==true){ 
			$queryc = "SELECT  * FROM {{usuario_programacion}} WHERE idUsuario=".(int)$_POST["idus"]." and  estado='1'";
 			$gcrt = dbExecuteAssoc($queryc);
			$rusp = $gcrt->readAll();
			$datosEstres=array();
			$datosAB=array();
			$sid=NULL;
			$q="";
			$entrevistador=NULL;
			if(isset($_POST["sid"])){
				$q=' and sid='.(int)$_POST["sid"];
			} 
			
			if(isset($_POST["idbateria"])){
				$q.=' and idbateria='.(int)$_POST["idbateria"];
				$dat = new CDbCriteria;
				$dat->condition = 'id='.(int)$_POST["idbateria"];
				$bateria = Bateria::model()->find($dat);

				$queryc = "SELECT  * FROM {{users}} WHERE uid=".$bateria->idusuariocrea;
				$gcrt = dbExecuteAssoc($queryc);
				$ruspu = $gcrt->readAll();
				
				if((int)$ruspu[0]["iduseval"]>0){
 					$entrevistador=EvalUsuarios::model()->selectUsuarioById($ruspu[0]["iduseval"]);
				}else{
				
					$entrevistador=(object)array(
												"nombres"=>$ruspu[0]["full_name"],
												"apellidos"=>"",
												"documento"=>$ruspu[0]["users_name"],
												"tarjetaprofesional"=>"ROOT",
												"postgrado"=>"ROOT",
												"cargo"=>"ROOT",
												"licencia"=>"ROOT",
 												);
				}
				 
			} 
			$rtipo=0;
 			foreach($rusp as $var){
				unset($dat);
 				$dat = new CDbCriteria;
				$dat->condition = 'id='.$var["idProgramacion"].$q;
				$pe = ProgramacionEncuesta::model()->find($dat);
				$sid=$pe->sid;
				
				$queryc = "SELECT  * FROM {{surveys_languagesettings}} WHERE surveyls_survey_id=".$sid;
				$gcrt = dbExecuteAssoc($queryc);
				$ps = $gcrt->readAll();		
				$ps=(object)$ps[0];				
				
				$queryc = "SELECT  * FROM {{cubo_".$sid."}} WHERE idAnswer=".$var["idAnswer"];
				$gcrt = dbExecuteAssoc($queryc);
				$rs = $gcrt->readAll();	
				
				
				$queryc = "SELECT  * FROM {{criteriotransformacion_encuesta}} WHERE sid=".$sid;
				$gcrt = dbExecuteAssoc($queryc);
				$cirteriogeneral = $gcrt->readAll();	
 				
				/*$queryc = "SELECT  * FROM {{eval_usuarios}} WHERE id=".(int)$_POST["idus"];
				$gcrt = dbExecuteAssoc($queryc);*/
				
			//	$us = $gcrt->readAll();
				$us=EvalUsuarios::model()->selectUsuarioById((int)$_POST["idus"]);
 				$keyb=0;
				if($us->idtipo==3 or $us->idtipo==4 ){
					$keyb=1;
				}
				$encuestar=(object)$rs[0];
 				 
				
				unset($dat);
				$dat = new CDbCriteria;
				$dat->condition = 'sid="'.$sid.'"';
				$tipo = TipoEncuesta::model()->find($dat);
				$rtipo=$tipo->idtipo;
				if($tipo->idtipo==3){ 
 					$total=(((floatval($encuestar->puntaje_bruto)/floatval($encuestar->dom_59_critrans))*100));
					if($total>100){$total=number_format($total,0);}
					$queryc = "SELECT  * FROM {{baremos_dominios}} WHERE sid=".$sid;
					$gcrt = dbExecuteAssoc($queryc);
					$baremos = $gcrt->readAll();
					
					$baremos=(object)$baremos[$keyb];
					
					$srrd=str_replace(" ","",str_replace(",",".",trim($baremos->srrd)));
					$srrd=explode("-",$srrd);
					$rb=str_replace(" ","",str_replace(",",".",trim($baremos->rb)));
					$rb=explode("-",$rb);
					$rm=str_replace(" ","",str_replace(",",".",trim($baremos->rm)));
					$rm=explode("-",$rm);
					$ra=str_replace(" ","",str_replace(",",".",trim($baremos->ra)));
					$ra=explode("-",$ra);
					$rma=str_replace(" ","",str_replace(",",".",trim($baremos->rma)));
					$rma=explode("-",$rma);
					if(floatval($srrd[0])<=$total and floatval($srrd[1])>=$total){
							$rbaremos="Muy Bajo";
							$color="#81F781";
					}else if(floatval($rb[0])<=$total and floatval($rb[1])>=$total){
							$rbaremos="Bajo";
							$color="#F3F781";
					}else if(floatval($rm[0])<=$total and floatval($rm[1])>=$total){
							$rbaremos="Medio";
							$color="#F7FE2E";
					}else if(floatval($ra[0])<=$total and floatval($ra[1])>=$total){
							$rbaremos="Alto";
							$color="#FAAC58";
					}else if(floatval($rma[0])<=$total and floatval($rma[1])>=$total){
							$rbaremos="Muy Alto";
							$color="#FE2E2E";
					}						
					 
					array_push($datosEstres,	
						array(array("encuesta"=>$ps->surveyls_title,"fecha"=>$encuestar->submitdate),	
							array(
								array("title"=>"Puntaje bruto","value"=>$encuestar->puntaje_bruto),
								array("title"=>"Factor transformador","value"=>$encuestar->dom_59_critrans),
								array("title"=>"Puntaje transformado","value"=>number_format($total,2)),
								array("title"=>"Nivel de Riesgo","value"=>$rbaremos),
								array("title"=>"Color","value"=>$color),
							)
						)
					);
				}
				 
				if($tipo->idtipo==2 or $tipo->idtipo==1 or $tipo->idtipo==4 or $tipo->idtipo==5){
 					
					$domres=array();
 					$dimres=array();
				
					$temporaldimes1=array();
					$temporaldimes2=array();
 					foreach($encuestar as $key=>$valor){
						 
						$valida=explode("dom_",$key);
						if(isset($valida[1])){
							
							$domres[$key]=$valor;
							list($prefijo,$id,$tipot)=explode("_",$key);
							unset($dat);
							$dat = new CDbCriteria;
							$dat->condition = 'id='.$id;
							$dat->order = 'id ASC';
 							$dominio = ParametrizacionEncuesta::model()->find($dat);
							$domres[$prefijo."_".$id."_nombre"]=$dominio->nombre;
  						}
						 
						$valida2=explode("dim_",$key);
						if(isset($valida2[1])){
							$dimres[$key]=$valor;
							list($prefijo1,$codigo1,$tipo1)=explode("_",$key);
							unset($datd);
							array_push($temporaldimes1,"'".$codigo1."'");
							$temporaldimes2[$codigo1]=array($prefijo1,$tipo1);
 							$datd = new CDbCriteria;
							$datd->condition = 'codigo="'.$codigo1.'"';
 							$dimensiones = DimensionEncuesta::model()->find($datd);	
							
							$dimres[$prefijo1."_".$codigo1."_nombre"]=$dimensiones->nombre;
							$dimres[$prefijo1."_".$codigo1."_dominio"]=$dimensiones->paramid;
							$dimres[$prefijo1."_".$codigo1."_tipo"]=$tipo1;
   						}
					}
 				
					$varfinal=array();
					unset($dat);
					$dat = new CDbCriteria;
					$dat->condition = 'sid='.$sid;
					$dominios = ParametrizacionEncuesta::model()->findAll($dat);
					
					foreach($dominios as $key=>$valor){
 						unset($datd);
						$datd = new CDbCriteria;
						$datd->condition = 'paramid='.$valor->id;
						$datd->group = 'codigo';
						$datd->order = 'id ASC';
						$dimes = DimensionEncuesta::model()->findAll($datd);
						$rdimes=array();
						foreach($dimes as $valores){
							if($dimres["dim_".$valores->codigo."_baremos"]=="Sin Riesgo o Riesgo Despreciable" or $dimres["dim_".$valores->codigo."_baremos"]=="Muy Bajo"){
								$color="#81F781";
							}else if($dimres["dim_".$valores->codigo."_baremos"]=="Riesgo Bajo"  or $dimres["dim_".$valores->codigo."_baremos"]=="Bajo"){
								$color="#F3F781";
 							}else if($dimres["dim_".$valores->codigo."_baremos"]=="Riesgo Medio"  or $dimres["dim_".$valores->codigo."_baremos"]=="Medio"){
								$color="#F7FE2E";
 							}else if($dimres["dim_".$valores->codigo."_baremos"]=="Riesgo Alto"  or $dimres["dim_".$valores->codigo."_baremos"]=="Alto"){
							
								$color="#FAAC58";
							}else if($dimres["dim_".$valores->codigo."_baremos"]=="Riesgo Muy Alto"  or $dimres["dim_".$valores->codigo."_baremos"]=="Muy Alto"){
								$color="#FE2E2E";
							}
 							array_push($rdimes,array(
											"codigo"=>$valores->codigo,
											"nombre"=>$dimres["dim_".$valores->codigo."_nombre"],
 											"totalbruto"=>$dimres["dim_".$valores->codigo."_bruto"],
 											"criterio"=>$dimres["dim_".$valores->codigo."_critrans"],
 											"puntajetransformado"=>$dimres["dim_".$valores->codigo."_trans"],
 											"baremos"=>$dimres["dim_".$valores->codigo."_baremos"],
											"color"=>$color,
											)
									);
						}
						
						if($domres["dom_".$valor->id."_baremos"]=="Sin Riesgo o Riesgo Despreciable" or $domres["dom_".$valor->id."_baremos"]=="Muy Bajo"){
							$color="#81F781";
						}else if($domres["dom_".$valor->id."_baremos"]=="Riesgo Bajo"  or $domres["dom_".$valor->id."_baremos"]=="Bajo"){
							$color="#F3F781";
						
						}else if($domres["dom_".$valor->id."_baremos"]=="Riesgo Medio"  or $domres["dom_".$valor->id."_baremos"]=="Medio"){
							$color="#F7FE2E";
						
						}else if($domres["dom_".$valor->id."_baremos"]=="Riesgo Alto"  or $domres["dom_".$valor->id."_baremos"]=="Alto"){
 							$color="#FAAC58";
						}else if($domres["dom_".$valor->id."_baremos"]=="Riesgo Muy Alto"  or $domres["dom_".$valor->id."_baremos"]=="Muy Alto"){
 							$color="#FE2E2E";
						}
  						$varfinal[$key]=array(
							"nombre"=>$valor->nombre,
							"criterio"=>$valor->transformacion,
							"transformado"=>$domres["dom_".$valor->id."_trans"],
							"bruto"=>$domres["dom_".$valor->id."_bruto"],
							"baremos"=>$domres["dom_".$valor->id."_baremos"],
							"color"=>$color,
							"id"=>$valor->id,
							"dimensiones"=>$rdimes,
							"tipo"=>$tipo->idtipo,
 						);
						 
						 
						
					}
					 
					array_push($datosAB,array(array("encuesta"=>$ps->surveyls_title,"fecha"=>$encuestar->submitdate),$varfinal));
 					
 					
					
				}
			} 
			//printVar($datosEstres);
			//printVar($datosAB);exit;
			$aData["datosAB"]=$datosAB;
			$aData["estres"]=$datosEstres;
			$aData["usuario"]=$us;
			$aData["entrevistador"]=$entrevistador;
			//printVar($datosAB);
			//exit;
  			$this->_renderWrappedTemplate('usuarios', 'resultado', $aData);					
		}
	}
    public function index()
    {   
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
		//printVar($oRecord);
		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);	
 		$aData["imageurl"]="/bateria/img/";
 		$OP=2;
 		if(isset($_POST["option"])){
		
			$OP=$_POST["option"];
		 
		}
		
		$validaini=EvalUsuarios::model()->vaidausr(false);
  		$aData["validaini"]=$validaini;
		if($OP!=10){	
			$perfiles=array(2);
			if($oRecord->uid==1 or ($dUsuario->perfil==1 or $dUsuario->perfil==3 or $dUsuario->perfil==2)){
				if($oRecord->uid==1 or $dUsuario->perfil==1){
					$unidades="all";
					$perfiles=array(2,4,1,3);
				}
				if( $dUsuario->perfil==3 or $dUsuario->perfil==2){
					$unidades=explode(",",$dUsuario->id_unidad);
					
					if($dUsuario->perfil==3){
						$perfiles=array(2,4);
					}
					if($dUsuario->perfil==2){
						$perfiles=array(2);
					}
				}
			}
 			$unit=EvalUnidades::model()->findAllunidades($unidades);
 			$perf = new CDbCriteria;
			$perf->condition = 'id in ('.join(',',$perfiles).')';
			$perfr = EvalPerfiles::model()->findAll($perf);
			$aData["listaperfiles"]=$perfr;
			$aData["listaempresas"]=$unit;
			
		}
 		switch($OP){
 			case 1: // LOS ACTIVOS
				$validaeditar=EvalUsuarios::model()->vaidausr(false);
				$aData["option"]=1;
				if($validaeditar=="OK"){
					$datos=1;
					$empl=$this->selectEmpleadosActivos($datos);
 					$aData["empl"] =$empl[0];
					//array($total_paginas,$pagina,$buscar,$perfilusuarior,$unidadesr)
					$aData["paginacion"] =$empl[1];	
					$aData["buscar"] =$empl[1][2];
					$aData["perfilusuarior"] =$empl[1][3];
					$aData["unidadesr"] =$empl[1][4];
  				}else{
					$aData["msg"] ="No tiene permisos para realizar esta acción";
				}
 				$this->_renderWrappedTemplate('usuarios', 'usuarios', $aData);
			break;
		
			case 0: //LOS INACTIVOS
				$aData["option"]=0;
				$validaeditar=EvalUsuarios::model()->vaidausr(false);
				if($validaeditar=="OK"){
					$datos=0;
					$empl=$this->selectEmpleadosActivos($datos);
					$aData["empl"] =$empl[0]; 
					$aData["paginacion"] =$empl[1];				
					$aData["buscar"] =$empl[1][2];
					$aData["perfilusuarior"] =$empl[1][3];
					$aData["unidadesr"] =$empl[1][4];					
				}else{
					$aData["msg"] ="No tiene permisos para realizar esta acción";
				} 				
				$this->_renderWrappedTemplate('usuarios', 'usuarios', $aData);
			break;
		
			case 2: //TODOS LOS ACTIVOS E INACTIVOS
				//$datos=array(1,0);
				$aData["option"]=2;
				$mensaje="";
				$estado="none";
				//printVar($unit);
				if(isset($_POST["email"])){
 					$ids=explode(",",$_POST["ids"]);
 					for($i=0;$i<count($ids);$i++){
						$id=(int)$ids[$i];
						
						if($id>=1){
							$queryc = "SELECT * FROM {{eval_usuarios}} where id=".$id;
							$gcrt = dbExecuteAssoc($queryc);
							$ussurvey = $gcrt->readAll();
							
 							$htmlfinal="Buen día<br>";
							$htmlfinal.="Este es su acceso para bateria de encuesta.<br>";
							$htmlfinal.="Usuario: ".$ussurvey[0]["alias"]."<br>";
							$htmlfinal.="Contraseña: ".$ussurvey[0]["clave"]."<br><br>";
							$htmlfinal.="<a href='talentracking.com/bateria/index.php/admin'>talentracking.com/bateria/index.php/admin</a>";
							$htmlfinal.="<br><br>Saludos,";
 							$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
							$mail->IsSMTP(); // telling the class to use SMTP
							$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
							$mail->SMTPAuth   = true;                  // enable SMTP authentication
							$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
							$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
							$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
							$mail->Username   = "info@talentracking.com";  // GMAIL username
							$mail->Password   = "talentrack";            // GMAIL password
							$mail->AddAddress($ussurvey[0]["email"], utf8_decode("Fundación Colombiana del Corazón"));
							$mail->SetFrom('info@talentracking.com',  utf8_decode('Batería de encuestas'));
							$mail->AddReplyTo('fgutierrez@talentracking.com',  utf8_decode('Batería de encuestas'));
							$mail->Subject =  utf8_decode("Buen día.");
							$mail->MsgHTML($htmlfinal);
							//$mail->Send();							
 						}
					}
					$mensaje="<b>El email con la contraseña ha sido enviado</b>";
					$estado="block";
  				}
				$aData["msjText"] = $mensaje;
				$aData["msjClass"] = "divAlert";
				$aData["msjDisplay"] = $estado;						
				$aData["unidades"] = $unit;						
				
				$validaeditar=EvalUsuarios::model()->vaidausr(false);
				
				if($validaeditar=="OK"){
 					$datos=1; 
 				}else{
				
					$queryc = "SELECT * FROM {{users}} where uid=".(int)$_SESSION["loginID"];
					$gcrt = dbExecuteAssoc($queryc);
					$ussurvey = $gcrt->readAll();
 					$datos=array(" u.id = ".$ussurvey[0]["iduseval"],-1);
 				}
				$empl=$this->selectEmpleadosActivos($datos);
				$aData["empl"] =$empl[0]; 
				$aData["paginacion"] =$empl[1];
				$aData["buscar"] =$empl[1][2];
				$aData["perfilusuarior"] =$empl[1][3];
				$aData["unidadesr"] =$empl[1][4];				
				
 				$this->_renderWrappedTemplate('usuarios', 'usuarios', $aData);
			break;
			case 3: // TRAE UN SUSUARIO
				$validaeditar=EvalUsuarios::model()->vaidausr(false);
				 
				if($validaeditar=="OK"){
					$queryString = "
					update {{eval_usuarios}} set activo=".(int)$_POST["activo"]." where id=".(int)$_POST["id"]."";
					$eguresult = dbExecuteAssoc($queryString);				 
				 echo "OK";
				}else{
					echo "NO";
				}
 			
			break;
		
			case 4: // ELIMINAR USUARIO
				$validaeditar=EvalUsuarios::model()->vaidausr(false);
				if($validaeditar=="OK"){
				
					$datd = new CDbCriteria;
					$datd->condition = 'idUsuario="'.(int)$_POST["id"].'" and estado=1';
					$usp = UsuarioProgramacion::model()->find($datd);
					 
					$ua = new CDbCriteria;
					$ua->condition = 'iduseval="'.(int)$_POST["id"].'"';
					$uar = User::model()->find($ua);
					
 					$uae = new CDbCriteria;
					$uae->condition = 'id="'.(int)$_POST["id"].'"';
					$uaer = EvalUsuarios::model()->find($uae);	
					
					if(!isset($usp->id)){
						$queryString = "
						delete from   {{eval_usuarios}} where id=".(int)$_POST["id"]."";
						$eguresult = dbExecuteAssoc($queryString);	
						if(isset($uar->uid)){
							$queryString = " DELETE from {{permissions}} WHERE uid='".$uar->uid."'";
							$eguresult = dbExecuteAssoc($queryString);	

							$queryString = " DELETE from {{users}} WHERE uid='".(int)$_POST["id"]."'";
							$eguresult = dbExecuteAssoc($queryString);	
 						}
						echo "OK";
 					}else{
 						if(isset($uar->uid)){
							$uar->password="";
							$uar->save();
							$uaer->clave="";
 						}
						echo "OK2";
 					}	
					//$eguresult = dbExecuteAssoc($queryString);	
 				 
				}else{echo "NO";}
 			
			break;
			 
 			
			case 6:// BUSCA SI UN USUARIO ESTA REPETIDO
			 
				 $res=EvalUsuarios::model()->selectAlias($_POST["account"]);
				echo  $res;
			break;
			
			
			case 7: 

				$buscarText = $_POST["account"]."";
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

				$datos = EvalUsuarios::model()->selectPersonasByName($der);
				for($i=0;$i<count($datos);$i++){
					echo("<div class='linkNoLink' onclick='obj.setJefe(".$datos[$i]->id.",\"".$datos[$i]->nombres."\")'>".$datos[$i]->nombres."</div>");
				}
				if(count($datos) == 0){
					echo("Lo sentimos no se encontro ninguna persona que contenga el nombre de '".$_POST["account"]."'");
				}
 
			break;
			
			case 8://BUSCAR COLABORADOR
 		
				$buscarText = $_POST["account"]."";
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

				$datos = EvalUsuarios::model()->selectPersonasByName($der);
				for($i=0;$i<count($datos);$i++){
				echo("<div class='linkNoLink' onclick='obj.setCola(".$datos[$i]->id.",\"".$datos[$i]->nombres."\")'>".$datos[$i]->nombres."</div>");
				}
				if(count($datos) == 0){
				echo("Lo sentimos no se encontro ninguna persona que contenga el nombre de '".$_POST["account"]."'");
				}		
 				
			break;
			
			case 9:
				$buscarText = $_POST["account"]."";
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

				$datos = EvalUsuarios::model()->selectPersonasByName($der);
				for($i=0;$i<count($datos);$i++){
					echo("<div onclick='obj.setEval(".$datos[$i]->id.",\"".$datos[$i]->nombres."\")'>".$datos[$i]->nombres."</div>");
				}
				if(count($datos) == 0){
					echo("Lo sentimos no se encontro ninguna persona que contenga el nombre de '".$_POST["account"]."'");
				}			
 			break;
			
			
			
			case 10: // VISTA EDITAR USUARIOS
				//vista guardar edicion usuario
				$validaeditar=EvalUsuarios::model()->vaidausr((int)$_POST["textId"]);
 				if($validaeditar=="OK"){	 
					$par_id = (int)$_POST["textId"];
   					$user = EvalUsuarios::model()->selectUsuarioById($par_id); 
  					if((isset($_POST["textAccion"]))){
  						$data["par_id"]=(int)$_POST["textId"];
						$data["par_nombres"]=$_POST["textNom"];
 						$data["par_apellidos"]=$_POST["textApe"];
						$data["par_genero"]=$_POST["textGenero"];
						$data["par_tipovivienda"]=$_POST["textTipovivienda"];
						$data["par_estrato"]=$_POST["textEstrato"];
						$data["par_estadocivil"]=$_POST["textEstadocivil"];
 						$data["par_documento"]=$_POST["textDoc"];
						$data["par_email"]=trim($_POST["textMail"]," ");
  						//$data["par_id_unidad"]=$_POST["selectUnidad"];
						$data["par_id_area"]=$_POST["selectAreaid"];
						if((int)$_POST["selectAreaid"]>0){
							$criteria = new CDbCriteria;
							$criteria->condition ="id=".(int)$_POST["selectAreaid"];
							$areast= EvalAreas::model()->find($criteria);
							$data["id_unidad"]=$areast->idunidad;
						}
   						$data["par_id_cargo"]=$_POST["selectCargoid"];
						$data["par_activo"] =(int)$_POST["selectActivo"];
 						$data["par_clave"]=trim($_POST["textPas"]," ");						
  						$data["par_tipocargo"]=trim($_POST["selectTipocargo"]," ");	
  						
						$data["par_fn"]=$_POST["textFn"]; 
						$data["par_nivelestudio"]=$_POST["textNivelestudio"]; 
						$data["par_lugarresidenciaactual"]=$_POST["textLugarresidenciaactual"]; 
						$data["par_personasacargo"]=$_POST["textPersonasacargo"]; 
						$data["par_lugardetrabajoactual"]=$_POST["textLugardetrabajoactual"]; 
						$data["par_anosempresa"]=$_POST["textAnosempresa"]; 
						$data["par_htrabajoemp"]=$_POST["textHtrabajoemp"]; 
						$data["par_tipocontrato"]=$_POST["selectTipocontrato"]; 
						$data["par_horasdiarias"]=$_POST["textHorasdiarias"]; 
						$data["par_tiposalario"]=$_POST["selectTiposalario"]; 
						$data["par_idprofesion"]=$_POST["textProfesion"];
  						$data["id_unidad"]=$_POST["textUnidadidentre"];
 						$data["par_cargo"]=$_POST["textProfesionentre"];
 						$data["par_postgrado"]=$_POST["textPostgrado"]; 
						$data["par_tarjetaprofesional"]=$_POST["textTarjetaprofesional"]; 
						$data["par_licencia"]=$_POST["textLicencia"]; 
						$data["par_lugarcedula"]=$_POST["textLugarcedula"]; 
 						$data["par_usr"]=trim($_POST["textUsr"]," ");
  						 
 						 
 						$continuar = true;
						$aData["msjText"] = "El usuario fue actualizado con exito.";
						$aData["msjClass"] = "divGood";
						$aData["msjDisplay"] = "block";	
  						
						$par_res=NULL;
						
						if (!validateEmailAddress($data["par_email"])) {
							$continuar = false;
							$aData["msjText"] = "El email no es valido";
							$aData["msjClass"] = "divError";
							$aData["msjDisplay"] = "block";
							
						}else{
 							//RESTRINGE LOS PERFILES
							$perfil=-1;
							if(isset($dUsuario->perfil)  ){
								if(($dUsuario->perfil==3 and in_array((int)$_POST["selectPerfil"],array(2,4))) or
									(($dUsuario->perfil==1 or $oRecord->uid==1)  and in_array((int)$_POST["selectPerfil"],array(1,2,3,4))) or
									($dUsuario->perfil==2  and in_array((int)$_POST["selectPerfil"],array(2))) or
									($dUsuario->perfil==4  and in_array((int)$_POST["selectPerfil"],array(4))) 
									){
									$perfil=(int)$_POST["selectPerfil"];
								}
								if($perfil<0){
									unset($data);
								}
							}
							if($oRecord->uid==1){
								$perfil=(int)$_POST["selectPerfil"];
								
							}
							$data["par_perfil"]=$perfil;	
							 
							if($oRecord->uid==1 or ($dUsuario->perfil==1 or $dUsuario->perfil==3 or $dUsuario->perfil==2)){
								if($oRecord->uid==1 or $dUsuario->perfil==1){
									$unidades="all";
								}
								
								if( $dUsuario->perfil==3 or $dUsuario->perfil==2){
									 
									$unidades=explode(",",$dUsuario->id_unidad);
								}
 							}	
 							$unit=EvalUnidades::model()->findAllunidades($unidades);
 							$arrun=array();
							if(isset($unit[0]->id)){	
								foreach($unit as $datos){
									array_push($arrun,$datos->id);
								}
							}
 							$tempoundad=explode(",",$data["id_unidad"]);
							$newunidad=array();
							foreach($tempoundad as $datou){
								if(in_array($datou,$arrun)){
									array_push($newunidad,(int)$datou);
								}
							}
							 
							$data["id_unidad"]=join(",",$newunidad);
							//printVar($data);exit;
 							$par_res = EvalUsuarios::model()->modificarUsuario($data);
 							unset($user);
							$user = EvalUsuarios::model()->selectUsuarioById($par_id);
							if($par_res>0){
								//$pass=hash('sha256', $par_clave);
								$continuar = true;
								$aData["msjText"] = "El usuario fue editado con exito. El usuario es ".$data["par_alias"]." y la contraseña es: ".$data["par_clave"];
								$aData["msjClass"] = "divGood";
								$aData["msjDisplay"] = "block";	
								
								$uid=0;					
								$queryString = "
								SELECT 
								uid
								FROM {{users}}
								WHERE iduseval = ".$par_id;//printVar($queryString);exit;
 								$eguresult = dbExecuteAssoc($queryString);
 								$res = $eguresult->readAll();		
								foreach($res as $datos) {
									$row=(Object)$datos;
									$uid = $row->uid;
								}							
								 
								if($uid>0){
									$oRecord = User::model()->findByPk($uid);
									$oRecord->email= $this->escape($data["par_email"]);
									$oRecord->full_name= $this->escape($data["par_nombres"]." ".$data["par_apellidos"]);
									if (!empty($data["par_clave"]))
									{
										$oRecord->password= hash('sha256', $data["par_clave"]);
									}
									$uresult = $oRecord->save(); 
									$perfil="default";
									$entity="template";
									if(EvalUsuarios::model()->vaidausr(false) and $data["par_perfil"]==1){
										$perfil="superadmin";
										$entity="global";
 									}	
  									$valus = new CDbCriteria;
									$valus->condition = 'uid='.$uid;
									$rus = Permission::model()->find($valus);									
									$rus->permission= $perfil;
									$rus->entity= $entity;
									$rus->save();
 								}else{
  									$iNewUID = User::model()->insertUser($data["par_usr"],$data["par_clave"],$data["par_nombres"], Yii::app()->session['loginID'], $this->escape($data["par_email"]),$par_res);
									$perfil="default";
									$entity="template";
 									if(EvalUsuarios::model()->vaidausr(false) and $data["par_perfil"]){
										$perfil="superadmin";
										$entity="global";
										if($data["par_perfil"]==2 or $data["par_perfil"]==3 or $data["par_perfil"]==4){
											$perfil="default";
											$entity="template";
										}
  									}
  									Permission::model()->insertSomeRecords(array('uid' => $iNewUID, 'permission' => $perfil, 'entity'=>$entity, 'read_p' => 1, 'entity_id'=>0));
 								}
							}
						}					
 						if($par_res==NULL){
							$continuar = false;
							$aData["msjText"] = "Ocurrio un error editando al usuario. ".$data["par_res"];
							$aData["msjClass"] = "divError";
							$aData["msjDisplay"] = "block";
								
						}
						
						
 					}
 					$id_unidad=$user->id_unidad;
					if(isset($_POST["id_unidad"])){
						$id_unidad=(int)$_POST["id_unidad"];
					}
 					$datos=1;
					$cars=EvalCargos::model()->selecCargosActivos($id_unidad);
 					$unis=EvalUnidades::model()->selecUnidadesActivas();
					$ares=EvalAreas::model()->selecAreasActivas($id_unidad);
					$aData["areas"] = $ares;
					$aData["cargosxarea"] = NULL;
 					if($user->id_area>0){
 						$cm = new CDbCriteria;
						$cm->condition = 'area='.$user->id_area;
						$cmr = EvalCargos::model()->findAll($cm);
						$aData["cargosxarea"] =$cmr;
					}
    				$pers=EvalPerfiles::model()->selecPerfilesActivos();
					$ne=Nivelestudios::model()->findAll();
					$tipocontrato=Tipocontrato::model()->findAll();
					$tiposalario=Tiposalario::model()->findAll();
					$profesiones=Profesion::model()->findAll();
					
					$strTemp = "";
					for($i=0;$i<count($cars);$i++){
						if($cars[$i]->id == $user->id_cargo){
							$strTemp .= "<option value='".$cars[$i]->id."' selected='selected'> ".utf8_encode(iconv("UTF-8", "Windows-1252",ucfirst($cars[$i]->nombre)))."</option>";
						}else{
							$strTemp .= "<option value='".$cars[$i]->id."'>".utf8_encode(iconv("UTF-8", "Windows-1252",ucfirst($cars[$i]->nombre)))."</option>";
						}
					}
					$aData["cars"] = $cars;

					$strTemp = "";
					for($i=0;$i<count($unis);$i++){
						if($unis[$i]->id == $user->id_unidad){
							$strTemp .= "<option value='".$unis[$i]->id."' selected='selected'>".utf8_encode(iconv("UTF-8", "Windows-1252",ucfirst($unis[$i]->nombre)))."</option>";
						}else{
							$strTemp .= "<option value='".$unis[$i]->id."'>".utf8_encode(iconv("UTF-8", "Windows-1252",ucfirst($unis[$i]->nombre)))."</option>";
						}
					}
					$aData["unis"] = $strTemp;

					$dat = new CDbCriteria;
					$dat->select = 'id_area';
					$dat->group = 'id_area';
					$area = EvalUsuarios::model()->findAll($dat);
					
 					$arr=array();
					if(count($area)>0){
						foreach($area as $dato){
							array_push($arr,$dato->id_area);
						}
					}
					
					$dat = new CDbCriteria;
					$dat->select = 'id_cargo';
					$dat->group = 'id_cargo';
					$cargos = EvalUsuarios::model()->findAll($dat);
  					$carr=array();
					if(count($cargos)>0){
						foreach($cargos as $dato){
							array_push($carr,$dato->id_cargo);
						}
					}
					
					$at=array();
					$at2=array();
					foreach ($ares as $dato){
 						array_push($at2,array($dato->id,utf8_decode($dato->nombre)));
						array_push($at,utf8_decode($dato->nombre));
					}
					$ct=array();
					$ct2=array();
					foreach ($cars as $dato){
						
						array_push($ct2,array($dato->area,utf8_decode($dato->nombre),$dato->id));
						array_push($ct,utf8_decode($dato->nombre));
					}
					
					$ut=array();
					$ut2=array();
					foreach ($unis as $dato){
						
						array_push($ut2,array($dato->id,utf8_decode($dato->nombre)));
						array_push($ut,utf8_decode($dato->nombre));
					}
					
					$aData["ares"] = array($at,$at2);
					$aData["cargos"] = array($ct,$ct2);
					$aData["unis"] = array($ut,$ut2);
 					$strTemp = "";
					for($i=0;$i<count($pers);$i++){
						if($pers[$i]->id == $user->perfil){
							$strTemp .= "<option value='".$pers[$i]->id."' selected='selected'>".utf8_encode(iconv("UTF-8", "Windows-1252",ucfirst($pers[$i]->nombre)))."</option>";
						}else{
							$strTemp .= "<option value='".$pers[$i]->id."'>".utf8_encode(iconv("UTF-8", "Windows-1252",ucfirst($pers[$i]->nombre)))."</option>";
						}
					}
					//$aData["prcs"] = $strTemp;
					$aData["pers"] = $strTemp;
					
					$strTemp = "";
					foreach($ne as $valor){
						if($valor->id == $user->idnivelestudios){
							$strTemp .= "<option value='".$valor->id."' selected='selected'>".utf8_encode(iconv("UTF-8", "Windows-1252",ucfirst($valor->nombre)))."</option>";
						}else{
							$strTemp .= "<option value='".$valor->id."'>". utf8_encode(iconv("UTF-8", "Windows-1252",ucfirst( $valor->nombre)))."</option>";
						}
					}
					//$aData["prcs"] = $strTemp;
					$aData["nivelestudios"] = $strTemp;
					
					$strTemp = "";
					foreach($tipocontrato as $valor){
						if($valor->id == $user->tipocontrato){
							$strTemp .= "<option value='".$valor->id."' selected='selected'>".utf8_encode(iconv("UTF-8", "Windows-1252",ucfirst($valor->nombre)))."</option>";
						}else{
							$strTemp .= "<option value='".$valor->id."'>".utf8_encode(iconv("UTF-8", "Windows-1252",ucfirst($valor->nombre)))."</option>";
						}
					}
					//$aData["prcs"] = $strTemp;
					$aData["tipocontrato"] = $strTemp;
 
					$strTemp = "";
					foreach($tiposalario as $valor){
						if($valor->id == $user->tiposalario){
							$strTemp .= "<option value='".$valor->id."' selected='selected'>".utf8_decode(iconv("UTF-8", "Windows-1252",ucfirst($valor->nombre)))."</option>";
						}else{
							$strTemp .= "<option value='".$valor->id."'>".utf8_decode(iconv("UTF-8", "Windows-1252",ucfirst($valor->nombre)))."</option>";
						}
					}
					//$aData["prcs"] = $strTemp;
					$aData["tiposalario"] = $strTemp;
 
					$strTemp = "";
					$prof=array();
					foreach($profesiones as $valor){
						 
						array_push($prof,ucfirst(strtolower($valor->nombre)));
					}
					
					//$aData["prcs"] = $strTemp;
					 $aData["profesiones"] = $prof;
 
					$aData["msg"]="";
 					$aData["user"] = $user;
				}else{
					$aData["msg"]=$validaeditar;
				}	
				$this->_renderWrappedTemplate('usuarios', 'editar', $aData);					
 			break;
			
			
		}
		exit;
 		
		
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
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
		//printVar($oRecord);
		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
		$TAMANO_PAGINA = 10;
		$pagina=NULL;
		$filtro="";
 		if(isset($_POST["tamanio"]) and (int)$_POST["tamanio"]>0){
			$TAMANO_PAGINA =(int)$_POST["tamanio"];
			$pagina = (int)$_POST["pagina"];
		}
		$unidadesr=-1;
		if(isset($_POST["unidades"]) and (int)$_POST["unidades"]>=-1){
			if((int)$_POST["unidades"]==-1){
				if($oRecord->uid==1){
					$filtro.=" and (u.id_unidad<>'' or u.id_unidad=''  or u.id_unidad is NULL )";
				}
				if($oRecord->uid!=1 and ( $dUsuario->perfil==3  or $dUsuario->perfil==4) and  $dUsuario->id_unidad!=""){
					$filtro.=" and u.id_unidad in (".$dUsuario->id_unidad.")";
				}
 			}
 			if((int)$_POST["unidades"]>0 and ($dUsuario->id_unidad!="" or $oRecord->uid==1)){
				$idunidad=(int)$_POST["unidades"];
				if(in_array($idunidad,explode(",",$dUsuario->id_unidad))  or $oRecord->uid==1){
					$filtro.=" and (u.id_unidad=".$idunidad."  or u.id_unidad like '%,".$idunidad."' or u.id_unidad like  '".$idunidad."%,' )";
					$unidadesr=$idunidad;
				} 
				
 			}
 		}
		
		$perfilusuarior=-1;
		if(isset($_POST["perfilusuario"]) and (int)$_POST["perfilusuario"]>=-1){
			if((int)$_POST["perfilusuario"]==-1){
				if($oRecord->uid==1){
					$filtro.=" and (u.perfil>0 )";
				}
 				if($oRecord->uid!=1 and  $dUsuario->perfil==3 ){
					$filtro.=" and u.perfil in (2,3,4)";
				}
 			}
			if((int)$_POST["perfilusuario"]>0){
 				if($oRecord->uid==1 or  $dUsuario->perfil==3 ){
					$filtro.=" and u.perfil=".(int)$_POST["perfilusuario"];
					$perfilusuarior=(int)$_POST["perfilusuario"];
 				}
 			}
			
		}
  		if(isset($_POST["buscar"]) and $_POST["buscar"]!=""){
			$sql = new sql_inject();
			$testinject=$sql->test($_POST["buscar"]);
 			if($testinject==false){
				$filtro.=" and (u.documento like  '%".$_POST["buscar"]."%' or u.nombres like  '%".$_POST["buscar"]."%' or u.email like  '%".$_POST["buscar"]."%' or u.alias like  '%".$_POST["buscar"]."%')";
				
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
		
 		if($oRecord->uid==1){
 			if(is_array($act)){
				$datos="   ".$act[0]." or  u.activo =".$act[1];
  			}else{
				$datos="  u.activo = ".$act;
			}
			}else if(isset($dUsuario->id) and $dUsuario->perfil==3){
 			if(is_array($act)){
				$datos="   ".$act[0]." or  u.activo =".$act[1]." and u.uid_creador=".(int)$_SESSION['loginID'];
			}else{
				$datos="  u.activo = ".$act." and u.uid_creador=".(int)$_SESSION['loginID'];
			}
 		}		
  		
		$dat = new CDbCriteria;
 		$dat->select = 'id,nombres,activo,uid_creador';
		$dat->condition = str_replace("u.","",$datos).str_replace("u.","",$filtro);
		$test = EvalUsuarios::model()->findAll($dat);		
		$num_total_registros=count($test);
		
		//calculo el total de páginas
		$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
 		$arr = array();
		 
        $queryString = "
		SELECT
		{{eval_perfiles}}.nombre AS perfil,
		u.nombres as nombres,
		u.id AS id_user,
		u.alias as alias,
		u.clave as clave,
		u.documento as documento,
		u.email as email,
		u.id_unidad as id_unidad,
		u.activo as activo,
		u.perfil AS id_perfil
		FROM
		{{eval_usuarios}} u
		INNER JOIN {{eval_perfiles}} ON u.perfil = {{eval_perfiles}}.id		
		WHERE  
		".$datos.$filtro."		
		ORDER BY u.nombres  
		 LIMIT ".$inicio."," . $TAMANO_PAGINA; 
		
   		$eguresult = dbExecuteAssoc($queryString);
		$res = $eguresult->readAll();		
 		foreach($res as $datos) {
			$empresas="";
			if(!empty($datos["id_unidad"])){
				$ids=explode(",",$datos["id_unidad"]);
				 
				$subqem=" id=".$ids;
				if(count($ids)>1){
					$subqem=" id in (".join(",",$ids).")";
				}else{
					$subqem=" id=".(int)$datos["id_unidad"];
 				}
  				$dat = new CDbCriteria;
				$dat->select = 'id,nombre';
				$dat->condition = $subqem;
				$empre = EvalUnidades::model()->findAll($dat);	
				$rempre=array();
				foreach($empre as $re){
					array_push($rempre,$re->nombre);
				}
				$empresas=join(",",$rempre); 
			}
 			$datos["empresa"]=$empresas; 
  			array_push($arr,(Object)$datos);
		}
 		return array($arr,array($total_paginas,$pagina,$buscar,$perfilusuarior,$unidadesr));
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