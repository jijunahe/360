<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(E_ALL); ini_set('display_errors', '1');
$documentroot=str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"]);
require_once($documentroot.'application/extensions/PHPMailer/class.phpmailer.php');
require_once($documentroot.'application/extensions/xls/Excel/reader.php');
require_once($documentroot.'application/extensions/class_sql_inject.php');
class Rcv extends Survey_Common_Action
{
	public $anioc=array();

	function __construct($controller, $id)
    {
        parent::__construct($controller, $id);

        Yii::app()->loadHelper('database');
    }
	 
	public function simulador(){
		Yii::app()->db->schema->refresh();
		Yii:: app () ->cache->flush();
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
		$mensaje="";
		$encuesta=425936;
 		if($oRecord->uid==1){
			$organizaiones=Organizacion::model()->selecOrganizaciones();
			$nivel=Nivel::model()->findAll();
			if(isset($_POST["option"])){
				$option=$_POST["option"];
				switch($option){
					case "add":
					//printVar($_POST);exit;
						$set=new EvalSimulacion();
						$set->nombre=trim($_POST["nombre"],"");
						$set->idunidad=(int)$_POST["idunidad"];
						$set->idbateria=1;
						$set->fechacreacion=date("Y-m-d H:i:s");
						$cantidad=1;
						if((int)$_POST["cantidad"]>0){
							$cantidad=(int)$_POST["cantidad"];
						}
						$set->cantidad=$cantidad;
						$set->save();
						$mensaje='La simulación ha sido creada';
						echo json_encode(array("ok",$mensaje)); 
						$this->getController()->redirect(array('/admin/rcv/simulador'));exit;
					break;	
					case "ejecutar":
						$sim = EvalSimulacion::model()->findByPk((int)$_POST["id"]);
						
						 
						if(isset($sim->id)){
							$apellidos=array("ACEVEDO","AGURTO","ALCALÁ","ALMORA","ALOSILLA","ALVA","AREVALO","ARIAS","ARROYO","ALOCEN","BAIOCCHI","BAYLÓN","BEDOYA","BEDREGAL","BEJAR","BENAVIDES","BOZA","CALLE","CARAZA","CARRERA","CARRILLO","CARRIÓN","CASAPIA","CHANCOS","CHIRINOS","CORES","CORTEZ","CRISPIN","DE","DIAZ","DUEÑAS","ESPINOZA","FERNANDEZ","FERNANDEZ","FERRO","FLORES","GAMARRA","GAMIO","GARCÍA","GONZALES","GONZALES","GONZALES","GUTIERREZ","GUZMAN","GUZMAN","HERRERA","HORRUITINER","HUAMANI","HUAPAYA","HUARCAYA","HUAYTAN","LA","LANDA","LLAJA","LLENPEN","LUJAN","MAGUIÑA","MALDONADO","MALDONADO","MALLQUI","MAMANI","MARAVI","MARTINEZ","MEDINA","MELGAREJO","MIGUEL","MORI","NUÑEZ","ORE","ORRILLO","ORRILLO","PARDAVE","PAREDES","PASTOR","PINEDO","PRADA","RIEGA","RIOS","RIOS","RIQUELME","ROA","ROBLES","RODRIGUEZ","ROJAS","ROMERO","ROSALES","ROSAS","RUIZ","SALCEDO","SALINAS","SANCHEZ","SANTA","SOLANO","TEJEDO","TENORIO","TORRES","TRUJILLO","VEGA","VELASQUEZ","VERA","VILCA","VILGOSO","YAMAWAKI","ZAMALLOA","ZAPATA","ZEGARRA","ZU","JHONG","RONDOY","NEGRÓN","HERNANDEZ","VELAZCO","CAMPOS","LOPEZ","HERNANDEZ","RAMÍREZ","BARRERA","URETA","ROJAS","CASTILLO","CANALES","TORRES","ESPEJO","SOLIS","BETANCOURT","VILLEGAS","ABANTO","SEGURA","NEIRA","VALDIVIA","MENDOZA","LACOTERA","MORENO","LOZANO","QUISPE","LOAYZA","SALINAS","ARISTISABAL","ARANA","GUZMAN","MATTA","SALAS","ROMERO","ASTETE","LOZANO","PERALTA","DEL","HUILCA","MEDINA","VELEZ","CHINAG","QUISPE","CARBAJAL","MARTINEZ","FLORES","RAYGADA","QUISPE","SAUÑE","ROSA","GINOCCHIO","TAFUR","NUÑEZ","VENEGAS","SAN","QUISPE","TINCO","CELESTINO","UCHASARA","NAVARRO","MARQUEZ","ZUTA","VIBES","HOLGADO","RAMIREZ","HUAYANAY","REYES","ORTIZ","ORTIZ","CAMACHO","JARAMILLO","PORRAS","NUÑEZ","VILCHEZ","CALLE","LIMA","LIMA","MIRANDA","YANAC","VALVERDE","FARIAS","VALDIVIA","GOMEZ","FLORES","BONIFAZ","DE","DEL","PUCCIO","ARONE","CRUZ","VARGAS","LUNA","DAVILA","GASPAR","PARODI","CARREAZO","RAMOS","SILVA","LUCERO","ALVARADO","ONAGA","VEGA","CHANG","SALCEDO","FLORES","VERA","CONTERNO","VALLE","FABIAN","YEN","SANCHEZ","CASTILLA","PINO","BENSSA","MAGUIÑO","MAN","BRITTO");
							$nombres=array("Yuli","Fernando","Oscar","DANIEL","MIGUELVICENTE","CHRISTIAN","RAUL","JORGE","VICTOR","JAVIER","ROSARIO","EFRAÍN","MARCO","CESAR","ISELA","LEONCIA","LUZ","RAMIRO","JAVIER","NELSON","CIELITO","ISABEL","GIZELLA","ESTALINS","JORGE","GUILLERMO","ZARITA","CARLOS","DORIS","MARIBEL","ANGEL","ANTONIO","ANA","ANTONIO","YULIANA","CARLOS","ESTHER","OLGA","EDWIN","ROBERTO","GLORIA","MIRIAM","ARTURO","MARLENE","ELSA","JAVIER","ELENA","CLARA","MILAGROS","GUILLERMO","LOURDES","LUIS","MARCOS","WALTER","ELBA","PEDRO","ROBERTO","ORFELINA","HECTOR","GISSELA","COSME","SANDRA","JENNY","SANTIAGO","MAGDA","MARTIN","OSCAR","CARLOS","ELIZABETH","MANUEL","CARLOS","OLGA","JOSUE","JOSUÉ","CARMEN","SANTIAGO","ARTURO","ENRIQUE","SONIA","GERARDO","FREDDY","TERESA","JUAN","GEORGINA","ROSA","ROSA","MARIA","ROSA","CARINA","CARLOS","AIDA","CELIN","VIOLETA","AUGUSTO","PEDRO","ANGEL","JOSE","ANGEL","MIGUEL","JACQUELIN","RUTH","GUILLERMO","ALEJANDRO","BLANCA","ENRIQUE","CECILIA","MARIELA","MONICA","JUAN","HILRICH","NELSON","EDUARDO","TULIO","FLOR","MARINA","ALBERTO","MERCEDES","FLORISA","AUGUSTO","CORINA","MARIA","ENRIQUE","AURORA","VICTORIA","PATRICIA","ROSAVELT","SUSAN","ARMANDO","DAVID","MERCEDES","GUILLERMO","JULIAN","ADOLFO","MONICA","MARIA","JANETH","ENRIQUE","P","ANTONIO","ALBERTO","VICTOR","ROSA","VICTOR","DAVID","ELVIS","ESPERANZA","LILIANA","JOSEFA","DE","MARIA","MAGNOLIA","JOSE","CRISTINA","MARILU","MANUEL","ALBERTO","ANGEL","NORICILA","JONATHAN","KATTY","GODOFREDO","MILAGROS","CARLOS","MARIELA","FATIMA");
							
							$dat = new CDbCriteria;
							$dat->condition = 'id_unidad='.$sim->idunidad.' and perfil=2' ;
							$ejecutaencuesta = EvalUsuarios::model()->findAll($dat);	
							//printVar($sim->cantidad );exit;
								
							// printVar(count($ejecutaencuesta) );exit;
							 
							if(count($ejecutaencuesta)>0){	
								 
								$queryc = "SELECT * FROM {{questions}} where sid=".$encuesta;
								$gcrt = dbExecuteAssoc($queryc);
								$preguntas = $gcrt->readAll();
								// printVar($preguntas);exit;
								$recurrencia=array();
								$fecharecurrencia=array(); 
								$nombrerecurrencia=array(); 
								$generorecurrencia=array(); 
								$estaturarecurrencia=array(); 
 								for($i=0;$i<=$sim->cantidad;$i++){
									$idkey=rand(0, (count($ejecutaencuesta)-1));
									$q=array();
									$validarecurrencia=rand(0, 3);
									$nrec="";
									$frec="";
									$grec="";
 									if($validarecurrencia==3 and count($recurrencia)>0){
										$keyreck=rand(0,count($recurrencia)-1);
										$crec=$recurrencia[$keyreck];
										$nrec=$nombrerecurrencia[$keyreck];
										$frec=$fecharecurrencia[$keyreck];
										$grec=$generorecurrencia[$keyreck];
										$erec=$estaturarecurrencia[$keyreck];
									}else{
										$validarecurrencia=2;
									}
  									foreach($preguntas as $pregunta){
										$pregunta=(object)$pregunta;
										$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]="";
										$queryc = "SELECT * FROM {{answers}} where qid=".$pregunta->qid;
										$gcrt = dbExecuteAssoc($queryc);
										$respuestas = $gcrt->readAll();
										//printVar($respuestas);exit; 
										if(isset($respuestas[0])){
											$rarr=array();
											foreach($respuestas as $r){
												array_push($rarr,$r["code"]);
											}
											$anskey=rand(0, (count($rarr)-1));
											$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=$rarr[$anskey];
											if($pregunta->qid==1173){
												if($q[$encuesta."X".$pregunta->gid."X1172"]=="A2"){
												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=NULL; 
												}else{
												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=$rarr[$anskey];
												}
											}
											if($pregunta->qid==1176 ){
												if($q[$encuesta."X".$pregunta->gid."X1175"]=="A2"){
													$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=NULL; 
												}else{
													$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=rand(30, 190);
												} 
											}
											  
										}else{
										
										
										
											if($pregunta->qid==1176 ){
												if($q[$encuesta."X".$pregunta->gid."X1175"]=="A2"){
													$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=NULL; 
												}else{
												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=rand(30, 190);
												} 
											}										
  											 
 											if($pregunta->qid==1155){//DOCUMENTO PACIENTE
												$documentor=(string)(int)($this->generateRandomString(10,11));
												if($validarecurrencia==3){
													$documentor=$crec;
												}else if($validarecurrencia==2){
													array_push($recurrencia,$documentor);
												}
												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=$documentor;
											}
 											if($pregunta->qid==1156){//Nombres y apellidos PACIENTE
												$nombresr=$nombres[rand(0, (count($nombres)-1))]." ".$nombres[rand(0, (count($nombres)-1))]." ".$apellidos[rand(0, (count($apellidos)-1))]." ".$apellidos[rand(0, (count($apellidos)-1))];
												if($validarecurrencia==3){
													$nombresr=$nrec;
												}else if($validarecurrencia==2){
													array_push($nombrerecurrencia,$nombresr);
												}												
												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=$nombresr;
											}
 											if($pregunta->qid==1152){//NOMBREENCUESTADOR
												 
 												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=$ejecutaencuesta[$idkey]->nombres;
											}
 											if($pregunta->qid==1151){//EMPRESA
												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=$ejecutaencuesta[$idkey]->id_unidad;
											}
 											if($pregunta->qid==1153){//DOCUMENTOENCUESTADOR
												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=$ejecutaencuesta[$idkey]->documento;
											}
 											if($pregunta->qid==1148){//SID
												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=$encuesta;
											}
  											if($pregunta->qid==1149){//IDUS
												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=$ejecutaencuesta[$idkey]->id;
											}
  											if($pregunta->qid==1154){//email encuestador
												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]="noemail@noemail.com";
											}
  											if($pregunta->qid==1158){//email PACIENTE
												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]="noemail@noemail.com";
											}
  											if($pregunta->qid==1157){//celular PACIENTE
												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=(string)(int)($this->generateRandomString(10,11));
											}
  											if($pregunta->qid==1160){//Fecha de nacimiento PACIENTE
												$y=(int)date("Y")-18;
												$anio=rand(1923, $y);
												$mes=rand(1, 2);
												$dia=rand(1, 28); 
 												$fecharec=$anio."-".$mes."-".$dia." 00:00:00";
												if($validarecurrencia==3){
													$fecharec=$frec;
													}else if($validarecurrencia==2){
													array_push($fecharecurrencia,$fecharec);
												}												
  												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=$fecharec;
											}
											if($pregunta->qid==1159){//GENERO PACIENTE
												$genero=array('F','M');
												
												$generorec=$genero[rand(0, (count($genero)-1))];
												if($validarecurrencia==3){
													$generorec=$grec;
													}else if($validarecurrencia==2){
													array_push($generorecurrencia,$generorec);
												}												
 												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=$generorec;
											}
											if($pregunta->qid==1161){//estatura PACIENTE
											
												$estaturarec=rand(150,220 );
												if($validarecurrencia==3){
													$estaturarec=$erec;
												}else if($validarecurrencia==2){
													array_push($estaturarecurrencia,$estaturarec);
												}												
											
											
 												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=$estaturarec;
											}
											if($pregunta->qid==1162){//peso PACIENTE
												 
												$string=(string)$q[$encuesta."X".$pregunta->gid."X1161"];
												$peso=(int)substr($string, 1, 2);
												/*if(rand(0,1)==1){
													if(rand(0,1)==1){
														$peso=$peso+((int)rand(0,60));
													}else{
														$peso=$peso-((int)rand(0,30));
													}
												}*/
												$peso=rand(60,190);
 												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=$peso;
											}
											if($pregunta->qid==1163){//perimetro PACIENTE
 												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=rand(40,100);
  											}
											
											if($pregunta->qid==1164){//GLISEMIA PACIENTE
 												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=rand(100,200);
  											}
											
											if($pregunta->qid==1165){//TRIGLISERIDOS PACIENTE
 												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=rand(100,500);
  											}
											 
											if($pregunta->qid==1166){//COLESTEROL PACIENTE
 												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=rand(70,200);
  											}
											if($pregunta->qid==1167){//COLESTEROL PACIENTE
 												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=rand(0,120);
  											}
 											
											if($pregunta->qid==1170){//Tension Arterial D PACIENTE
 												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=rand(0,120);
  											}
 											
 											
											if($pregunta->qid==1171){//Tension Arterial S PACIENTE
 												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=rand(0,120);
  											}
 											
  											if($pregunta->qid==1150){//IDESTRUCTURA
 												$dat = new CDbCriteria;
												$dat->condition = 'idus='.$ejecutaencuesta[$idkey]->id ;
												$estructura = Ownerxestructura::model()->findAll($dat);	
												$eskey=rand(0, (count($estructura)-1));
												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=$estructura[$eskey]->idestrcutura;
											}
										
										
										}
									} 
									 
									 
 									$y=(int)date("Y");
									$anio=rand($y-2, $y);
									$mes=rand(1, 2);
									$dia=rand(1, 28);
									$q["token"]="NR";
									$q["submitdate"]=$anio."-".$mes."-".$dia." 00:00:00";
									$q["lastpage"]="1";
									$q["startlanguage"]="es";
									$q["startdate"]=$anio."-".$mes."-".$dia." 00:00:00";
									$q["datestamp"]=$anio."-".$mes."-".$dia." 00:01:00";
									$q["ipaddr"]="NR";
									$q["refurl"]="NR";
									$q["simulacro"]="Y";
									$q["idsimulacro"]=$sim->id;
									 
									$keys=array();
									$values=array();
									foreach($q as $key=>$value){
										array_push($keys,"`".$key."`");
										array_push($values,"'".$value."'");
										
									}
									
									$INSERSURVEY="INSERT INTO  {{survey_".$encuesta."}} (".join($keys,",").")";	 
									$INSERSURVEY.=" VALUES(".join($values,",").")";
									 //printVar($INSERSURVEY);exit;
									$resIS = dbExecuteAssoc($INSERSURVEY);
									
									$queryc = "SELECT MAX(id) AS id FROM  {{survey_".$encuesta."}}";
									$gcrt = dbExecuteAssoc($queryc);
									$IDS = $gcrt->readAll();								
									$dirname=explode("/",$_SERVER["PHP_SELF"]);
									 
									//shell_exec ('curl -d "id='.$IDS.'&sid='.(INT)$encuesta.'&no&mode=actualiza&simulacro=Y&idsimulacro='.$sim->id.'" http://'.$_SERVER["HTTP_HOST"].'/'.$dirname[1].'/actualizacubo/rcv/index.php');
									shell_exec ('curl -d "id='.$IDS[0]["id"].'&sid='.(INT)$encuesta.'&no&mode=actualiza&simulacro=Y&idsimulacro='.$sim->id.'" http://'.$_SERVER["HTTP_HOST"].'/'.$dirname[1].'/actualizacubo/rcv/index.php');
 								}
 								 
								 echo json_encode(array("ok","La simulacion ha sido creada","redir"));exit;
								 
							}else{
								$mensaje='Debe crear usuario regular para esa empresa';
								echo json_encode(array("error",$mensaje)); exit;
 							}					
						 
						
						}
					break;
					case "eliminar":
						 
						$sim = EvalSimulacion::model()->findByPk((int)$_POST["id"]);
						
						if(isset($sim->id)){
							$iquery = "delete from {{survey_".$encuesta."}} where simulacro='Y' and idsimulacro=:id";
							$command = Yii::app()->db->createCommand($iquery)->bindParam(":id", $sim->id, PDO::PARAM_INT);
							$result = $command->query();
 							
							$iquery = "delete from {{cubo_".$encuesta."}} where simulacro='Y' and idsimulacro=:id";
							$command = Yii::app()->db->createCommand($iquery)->bindParam(":id", $sim->id, PDO::PARAM_INT);
							$result = $command->query();
 							
							$sim->delete();
							echo json_encode(array("ok","La simulación ha sido eliminada","redir"));exit;
						}else{
							echo json_encode(array("error","La simulación no existe","redir"));exit;
						}
						
					break;
				
				}
			}else{ 
				$aData["unidades"]=$organizaiones;
				$aData["nivel"]=$nivel;
				$aData["encuesta"]=$encuesta;
				$aData["mensaje"]= $mensaje;			
 				$simulaciones = EvalSimulacion::model()->findAll();
				//printVar($simulaciones);exit;
 				$aData["simulacion"]= $simulaciones;				
				$this->_renderWrappedTemplate('rcv', 'simulador', $aData);
			}
		}
 		//printVar();exit;
 	}
 	function generateRandomString($length = 10,$limit=0,$ini=0) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 		if($limit>0){
			$characters = '';
			if($ini==0){
				for($i=0;$i<$limit;$i++){
					$characters .=$i;
				}
			}else{
				for($i=$ini;$i<=$limit;$i++){
					$characters .=$i;
				}
			}
		}
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) { $randomString .= $characters[rand(0, $charactersLength - 1)]; } return $randomString; 
	}	
 	
	public function ctest(){
	//printVar("entro");
		$urlbase=$_SERVER["DOCUMENT_ROOT"].Yii::app()->baseUrl;
		$fila = 1;
		$colsname=array();
		$file="test.csv";
		$gestor = fopen($urlbase."/files/cargarcv/".$file, "r");
 		if ( $gestor!== FALSE) { 
 			$queryString="DESCRIBE {{survey_425936}}";
			$eguresult = dbExecuteAssoc($queryString);
			$res = $eguresult->readAll();				
 			while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
				$numero = count($datos);
				$objects=array();
				for ($c=0; $c < $numero; $c++) {
					if($fila==1){
						array_push($colsname,$datos[$c]); 
					}else{
						$valor=$datos[$c];
						if($c==6){
							$time = strtotime($datos[$c]);
							$valor = date('Y-m-d H:i:s',$time);
						}
						$objects[$colsname[$c]]=$valor;
					}
				}
				$query=" INSERT INTO {{survey_425936}} (submitdate,startdate,lastpage,startlanguage,datestamp,";
				$cols=array();
				$values=array();
				$validar=array("id","submitdate","startdate","lastpage","startlanguage","datestamp","token","ipaddr","refurl");
				foreach($res as $datos){
					if(isset($objects[$datos["Field"]]) and $datos["Field"]!="id"){
						array_push($cols,$datos["Field"]);
						array_push($values,"'".$objects[$datos["Field"]]."'");
					}else if(!in_array($datos["Field"],$validar)){
						array_push($cols,$datos["Field"]);
						array_push($values,"'A1'");
					}
				}
				$fila++;
				$query.=join(",",$cols).") VALUES ('".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."',1,'es','".date("Y-m-d H:i:s")."',".join(",",$values).")";
 				$eguresult = dbExecuteAssoc($query);
 				 
				$querymax="select max(id) as id FROM {{survey_425936}} ";
				$eguresult = dbExecuteAssoc($querymax);
				$resmax = $eguresult->readAll();
				$IDS=NULL;
				foreach($resmax as $datmax) {
					if(isset($datmax["id"])){
						$IDS=$datmax["id"];
						//printVar($IDS);
					}
				} 
 				$dirname=explode("/",$_SERVER["PHP_SELF"]);
				printVar('curl -d "id='.$IDS.'&sid=425936&mode=actualiza&no=1" http://'.$_SERVER["HTTP_HOST"].'/'.$dirname[1].'/actualizacubo/rcv/index.php',"shell");
				shell_exec ('curl -d "id='.$IDS.'&sid=425936&mode=actualiza&no=1" http://'.$_SERVER["HTTP_HOST"].'/'.$dirname[1].'/actualizacubo/rcv/index.php');
			}
			fclose($gestor);
		}		
		
 	} 
	public function cargar(){
		
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
		//printVar($oRecord);
		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
		$perfiles=array(3,4);	
 		
 		 if(in_array($dUsuario->perfil,$perfiles)){  
			if(!isset($_POST["save"])){
				App()->getClientScript()->registerScriptFile(Yii::app()->baseUrl."/scripts/yav1_4_1/js/yav.js");
				App()->getClientScript()->registerScriptFile(Yii::app()->baseUrl."/scripts/yav1_4_1/js/yav-config-es.js");
				App()->getClientScript()->registerScriptFile("//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js");
			
				$dat = new CDbCriteria;
				$dat->condition = "idusuario=".$oRecord->iduseval;
				$torgs=Usuarioxorg::model()->find($dat);	
				
				$dat = new CDbCriteria;
				$dat->condition = "idorganizacion=".$dUsuario->id_unidad." and idpadre>0";
				$areasunidades=Estructura::model()->findAll($dat);		
				$aData["usuario"]=$oRecord;
				$aData["usxorg"]=$torgs;
				$aData["estructura"]=$areasunidades;
			
				$this->_renderWrappedTemplate('rcv', 'cargar', $aData);
			}else{
 				$urlbase=$_SERVER["DOCUMENT_ROOT"].Yii::app()->baseUrl;
				//comprobamos que sea una petición ajax
				if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
				{
				 
					//obtenemos el archivo a subir
					$file = $_FILES['archivo']['name'];
				 
					//comprobamos si existe un directorio para subir el archivo
					//si no es así, lo creamos
					  
					//comprobamos si el archivo ha subido
					if ($file && move_uploaded_file($_FILES['archivo']['tmp_name'],$urlbase."/files/cargarcv/".$file))
					{
					   sleep(3);//retrasamos la petición 3 segundos
					  // echo $file;//devolvemos el nombre del archivo para pintar la imagen
					}
				}else{
					throw new Exception("Error Processing Request", 1);   
				}			
 				$fila = 1;
				$colsname=array();
				if (($gestor = fopen($urlbase."/files/cargarcv/".$file, "r")) !== FALSE) {
				
					$queryString="DESCRIBE {{survey_425936}}";
					$eguresult = dbExecuteAssoc($queryString);
					$res = $eguresult->readAll();


					$obligatorias=array("425936X35X1150","425936X35X1155","425936X35X1156","425936X35X1157","425936X35X1158","425936X35X1159","425936X35X1160","425936X35X1161","425936X35X1162","425936X35X1163","425936X35X1164","425936X35X1165","425936X35X1166","425936X35X1167","425936X35X1168","425936X35X1169","425936X35X1170","425936X35X1171","425936X35X1172","425936X35X1173","425936X35X1174","425936X35X1175","425936X35X1176");
					
					if( (int)$_POST["areas"]>0){
						unset($obligatorias[0]);
					} 					
 					
					$preguntas=array("425936X35X1168","425936X35X1169","425936X35X1172","425936X35X1174","425936X35X1175","425936X35X1178","425936X35X1179","425936X35X1180","425936X35X1181","425936X35X1182","425936X35X1183","425936X35X1184");
					$codigos=array("1"=>"A1","2"=>"A2","3"=>"A3","4"=>"A4","5"=>"A5","6"=>"A6","7"=>"A7","8"=>"A8");
					$fechas=array("submitdate","startdate","datestamp","425936X35X1160");
					$configkeys=array("425936X35X1148","425936X35X1149","425936X35X1150","425936X35X1151","425936X35X1152","425936X35X1153");
					$dataobject=array();
					$genero=array("M","F");
					$$colsname=array();
					$contador=1;
					$estan=array();
					$validarobligatorias=0;
					while (($datos = fgetcsv($gestor, 1000, $_POST["delimitador"])) !== FALSE) {
						$cantidad = count($datos);
						for ($c=0; $c < $cantidad; $c++) {
							if($contador==1){
								if(!in_array($datos[$c],$colsname)){
									array_push($colsname,$datos[$c]);
									if(in_array($datos[$c],$configkeys)){
										if(!in_array($datos[$c],$estan)){
											array_push($estan,$datos[$c]);
										}
									}	
									if(in_array($datos[$c],$obligatorias)){
 										$validarobligatorias++;
 									}
								}
							}else{
								$dataobject[$contador][$colsname[$c]]=$datos[$c];
							}
						}
						$contador++;
					}
					$errores=array();
					if($validarobligatorias!=count($obligatorias)){ 
 						array_push($errores,"No existen las columnas nesesarias para procesar la información de manera correcta. Asegurese de poner las siguientes columnas.<br> ".join(",",$obligatorias)." ");
 					}
					if(count($errores)==0){  
						$newdataobject=array();
						$tcondicioncardio="";
						foreach($dataobject as $idregistro=>$registro){
							foreach($registro as $columna=>$valor){
								if(in_array($columna,$preguntas)){
									$valortemporal=$codigos[$valor];
									if($valortemporal!=""){
										$valor=$valortemporal;
									}								
									$dataobject[$idregistro][$columna]=$valor;
								}
								if(in_array($columna,$fechas)){
									$testfecha=explode("/",$valor);
									$testfecha2=explode("-",$valor);
									if(isset($testfecha[1])){
										$testtime=explode(" ",$testfecha[2]);
										if($testfecha[1]<10){
											$testfecha[1]="0".(int)$testfecha[1];
											
										}
										if($testfecha[0]<10){
											$testfecha[0]="0".(int)$testfecha[0];
											
										}
										if(isset($testtime[1])){
											if($testtime[0]<10){
												$testtime[0]="0".(int)$testtime[0];
												
											}
											$mes=$testfecha[0];
											$dia=$testfecha[1];
											if($mes>12){
												$mes=$testfecha[1];
												$dia=$testfecha[0];
											}
											
											$valor = $testtime[0]."-".$mes."-".$dia." ".$testtime[1];
										}
										else{
											$mes=$testfecha[0];
											$dia=$testfecha[1];
											if($mes>12){
												$mes=$testfecha[1];
												$dia=$testfecha[0];
											}
											$valor = $testfecha[2]."-".$mes."-".$dia." 00:00:00";
										}
 									}else if(isset($testfecha2[1])){
										$testtime=explode(" ",$testfecha2[2]);
										if($testfecha2[1]<10){
											$testfecha2[1]="0".(int)$testfecha2[1];
											
										}										
										if($testfecha2[2]<10){
											$testfecha2[2]="0".(int)$testfecha2[2]; 
											
										}										
										
										if(!isset($testtime[1])){
											$mes=$testfecha2[1];
											$dia=$testfecha2[2];
											if($mes>12){
												$mes=$testfecha2[2];
												$dia=$testfecha2[1];
											}
  											$valor = $testfecha2[0]."-".$mes."-".$dia." 00:00:00";
 										}
									}else{
										array_push($errores,"Error en el registro <b>".$idregistro."</b> columna <b>".$columna."</b>: El formato de fechas no es válido. Asegurese de que sea de la forma AAAA-MM-DD o DD/MM/AAAA ");
									}
									$dataobject[$idregistro][$columna]=$valor;
									
								}
								if($columna=="425936X35X1161"){
									$valor=str_replace(",",".",$valor);
									if($valor<40){
										$valor=$valor*100;
									}
								}
								if($columna=="425936X35X1162"){
									$valor=str_replace(",",".",$valor);
									if($valor>=400){
										$valor=$valor/10;
									}
								}
								if($columna=="425936X35X1159"){
									if(!in_array($valor,$genero)){
										array_push($errores,"Error en el registro <b>".$idregistro."</b> columna <b>".$columna."</b>: Para género unicamente se acepta M para Masculino y F para Femenino");
									}
 								}
								
								if($columna=="425936X35X1150"){
									if((int)$_POST["areas"]>0){ 
										$dataobject[$idregistro][$columna]=(int)$_POST["areas"];
									}else{
										$querymax='select * FROM {{estructura}} where idorganizacion in ('.$dUsuario->id_unidad.') and nombre="'.$valor.'"';
										$eguresult = dbExecuteAssoc($querymax);
										$resorg = $eguresult->readAll();
										if(isset($resorg[0]["id"])){
											$dataobject[$idregistro][$columna]=$resorg[0]["id"];
										}else{
											array_push($errores,"Error en el registro <b>".$idregistro."</b> columna <b>".$columna."</b>: El nombre de area o unidad no existe en la estructura organizacional. Asegurese de que el nombre sea exactamente como lo creo en el sistema. Verificar la estructura organizacional ");
										}
									}
								}
								if($columna=="425936X35X1158"){
									$validaremail=explode("@",$valor);
									if(!isset($validaremail[1])){
										array_push($errores,"Error en el registro <b>".$idregistro."</b> columna <b>".$columna."</b>:El email no es válido ");
									}
								}
								if($columna=="425936X35X1172"){
									$tcondicioncardio=$valor;
								}
								if($columna=="425936X35X1173"){
									$varCOndicion=array(
									"HTA"=>,"1",
									"DM"=>,"2",
									"ACV"=>,"3",
									"IAM"=>,"4",
									"SCA (SD CORONARIO AGUDO)"=>,"5",
									"MS (MUERTE SUBITA)"=>,"6",
									"SM (SD METABOLICO)"=>,"7",
									"EAOP (ENFERMEDAD ARTERIAL OCLUSIVA PERIFERICA)"=>,"8",
									);
									if(!in_array((int)$valor,array(1,2,3,4,5,6,7,8,'HTA','DM','ACV','IAM','SCA (SD CORONARIO AGUDO)','MS (MUERTE SUBITA)','SM (SD METABOLICO)','EAOP (ENFERMEDAD ARTERIAL OCLUSIVA PERIFERICA)',NULL,""))){
										array_push($errores,"Error en el registro <b>".$idregistro."</b> columna <b>".$columna."</b>: El valor no es válido. Debe ser un valor entre 1 y 8: 
													1=>	HTA, 
													2=>	DM, 
													3=>	ACV, 
													4=>	IAM, 
													5=>	SCA (SD CORONARIO AGUDO), 
													6=>	MS (MUERTE SUBITA), 
													7=>	SM (SD METABOLICO), 
													8=>	EAOP (ENFERMEDAD ARTERIAL OCLUSIVA PERIFERICA)
										"); 
										
									}
									if(in_array($valor,array('HTA','DM','ACV','IAM','SCA (SD CORONARIO AGUDO)','MS (MUERTE SUBITA)','SM (SD METABOLICO)','EAOP (ENFERMEDAD ARTERIAL OCLUSIVA PERIFERICA)'))){
										$valor=$varCOndicion[$valor];
									}
									if($tcondicioncardio=="Y" or $tcondicioncardio=="A1" or strtoupper( $tcondicioncardio)=="SI"){
										if((int)$valor==0 or $valor==""){
											array_push($errores,"Error en el registro <b>".$idregistro."</b> columna <b>".$columna."</b>: El paciente evidentemente presenta condiciones cardiovasculares. Debe indicar qué condición cardiovascular padece:
													1=>	HTA, 
													2=>	DM, 
													3=>	ACV, 
													4=>	IAM, 
													5=>	SCA (SD CORONARIO AGUDO), 
													6=>	MS (MUERTE SUBITA), 
													7=>	SM (SD METABOLICO), 
													8=>	EAOP (ENFERMEDAD ARTERIAL OCLUSIVA PERIFERICA)
											"); 
	
										}
									}

 								}
								
								if($columna=="425936X35X1176" and !is_numeric($valor)){
									
									array_push($errores,"Error en el registro <b>".$idregistro."</b> columna <b>".$columna."</b>: El tiempo de actividad debe ser un número entero para determinar minutos.");
								}
								if($columna=="425936X35X1156"){
									$dataobject[$idregistro][$columna]=sanear_string(utf8_encode($valor),FALSE);
								}
								$dataobject[$idregistro][$columna]=str_replace(",",".",$dataobject[$idregistro][$columna]);
								
								if(strtoupper($dataobject[$idregistro][$columna])=="NO" or strtoupper($dataobject[$idregistro][$columna])=="N" ){
									$dataobject[$idregistro][$columna]="A2";
								}
								
								if(strtoupper($dataobject[$idregistro][$columna])=="SI" or strtoupper($dataobject[$idregistro][$columna])=="Y" ){
									$dataobject[$idregistro][$columna]="A1"; 
								}
								
								
								$newdataobject[$idregistro][$columna]="'".$dataobject[$idregistro][$columna]."'";
								

							} 
							$newdataobject[$idregistro]["lastpage"]="1";
							$newdataobject[$idregistro]["startlanguage"]="'es'";
							$newdataobject[$idregistro]["datestamp"]="'".date("Y-m-d H:i:s")."'";
							$newdataobject[$idregistro]["simulacro"]="'N'";
							$newdataobject[$idregistro]["425936X35X1148"]="'425936'";
							$newdataobject[$idregistro]["425936X35X1149"]="'".$dUsuario->id."'";
							$newdataobject[$idregistro]["425936X35X1151"]="'".$dUsuario->id_unidad."'";
							$newdataobject[$idregistro]["425936X35X1152"]="'".sanear_string(utf8_encode($dUsuario->nombres),FALSE)."'"; 
							$newdataobject[$idregistro]["425936X35X1153"]="'".$dUsuario->documento."'";
							if( (int)$_POST["areas"]>0){
								$newdataobject[$idregistro]["425936X35X1150"]="'".(int)$_POST["areas"]."'";
							} 
							if(!isset($newdataobject[$idregistro]["submitdate"])){
								$newdataobject[$idregistro]["submitdate"]="'".date("Y-m-d H:i:s")."'";
							}
						}
					}
 					fclose($gestor);
					unlink($urlbase."/files/cargarcv/".$file);
 					if(count($errores)>0){
						echo json_encode(array("estado"=>"error","errores"=>$errores));exit; 
					}
 					
					if(count($errores)==0){
						$autokeys=array();
						foreach($newdataobject as $nreg=>$atomdat){
							$keys=array();
							$valores=array();
							foreach($atomdat as $col=>$dato){
								array_push($keys,$col);
								array_push($valores,$dato);
							}
							 
							$query=" INSERT INTO {{survey_425936}} (".join(",",$keys).") VALUES (".join(",",$valores).")";
							//echo ($query)."<br>";
							//exit;
 							$eguresult = dbExecuteAssoc($query);

							$querymax="select max(id) as id FROM {{survey_425936}} ";
							$eguresult = dbExecuteAssoc($querymax);
							$resmax = $eguresult->readAll();
							$IDS=NULL;
 							if(isset($resmax[0]["id"])){
								$IDS=$resmax[0]["id"];
								array_push($autokeys,$IDS);
 							}else{
 								array_push($errores,"Error al guardar el registro <b>".$nreg."</b>. Los datos no serán cargados");
							}
 						} 
 						if(count($errores)==0){
							$dirname=explode("/",$_SERVER["PHP_SELF"]);
							$query=" INSERT INTO {{controlcarga_rcv}} (idorganizacion,idregistros,fecha,idusuario) VALUES (".$dUsuario->id_unidad.",'".json_encode($autokeys)."','".date("Y-m-d H:i:s")."',".$dUsuario->id.")";
							$eguresult = dbExecuteAssoc($query);								
							$querymax="select max(id) as id FROM {{controlcarga_rcv}} ";
							$eguresult = dbExecuteAssoc($querymax);
							$resmax = $eguresult->readAll();
 							echo json_encode(array("estado"=>"ok","idcontrol"=>$resmax[0]["id"]));							
 							foreach($autokeys as $IDSR){
								$no="&email=Y";
								if($_POST["email"]=="No"){
									$no="&email=N";
								} 
								//printVar('curl -d "id='.$IDSR.'&sid=425936&mode=add'.$no.'&rcv=1" http://'.$_SERVER["HTTP_HOST"].'/pentaho?mode=add');
 								shell_exec ('curl -d "id='.$IDSR.'&sid=425936&mode=add'.$no.'&rcv=1" http://'.$_SERVER["HTTP_HOST"].'/pentaho/index.php');
 							}
 							/*
							foreach($autokeys as $IDSR){
								$no="";
								if($_POST["email"]=="No"){
									$no="&noemail=1";
								}
 								shell_exec ('curl -d "id='.$IDSR.'&sid=425936&mode=actualiza'.$no.'" http://'.$_SERVER["HTTP_HOST"].'/'.$dirname[1].'/actualizacubo/rcv/index.php');
 							}
							*/
							exit; 
 						}else if(count($errores)>0){
							foreach($autokeys as $IDSR){ 
								$query=" DELETE FROM  {{survey_425936}} WHERE id=".$IDSR;
								$eguresult = dbExecuteAssoc($query);
								shell_exec ('curl -d "id='.$IDSR.'&sid=425936&mode=add&borrarrcv=1'.$no.'&" http://'.$_SERVER["HTTP_HOST"].'/pentaho/index.php');

							}
							echo json_encode(array("estado"=>"error","errores"=>$errores));exit; 
						}
						
						
					}
					exit;
 				}				
				exit;
 			}

		 }
		
	}
  	 
    public function usuarios()
    {   
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
		//printVar($oRecord);
		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);	
		$validaeditar=EvalUsuarios::model()->vaidausr(false);
		
		
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
 		if($validaeditar=="OK"){
			$datos=1; 
		}else{
		
			$queryc = "SELECT * FROM {{users}} where uid=".(int)$_SESSION["loginID"];
			$gcrt = dbExecuteAssoc($queryc);
			$ussurvey = $gcrt->readAll();
			$datos=array(" u.id = ".$ussurvey[0]["iduseval"],-1);
		}
		$empl=$this->selectEmpleadosActivos($datos);
 		$aData["imageurl"]=Yii::app()->baseUrl."/img/";
		$aData["empl"] =$empl[0]; 
		$aData["paginacion"] =$empl[1];
		$aData["buscar"] =$empl[1][2];
		$aData["perfilusuarior"] =$empl[1][3];
		$aData["unidadesr"] =$empl[1][4];				
		$aData["estado"] =$empl[1][5];				
		
		$this->_renderWrappedTemplate('rcv', 'usuarios', $aData);
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
	public function validaDemo($usuario){
		$demo=array(false,false);
		if($usuario->id!=220){
			$idOrg=$usuario->id_unidad;
			$org=Organizacion::model()->findByPk($idOrg);
			if($org->demo=="activo"){
				$demo=array(true,array(27,271));
 			}
		}
		return $demo;
	}
	public function reportes(){
		$data["cc"]="";
		if(isset($_SESSION["cc"])){
 			$data["cc"]=$_SESSION["cc"];
 		}
		if(isset($_POST["cc"])){
			$_SESSION["cc"]=$_POST["cc"];
			$data["cc"]=$_SESSION["cc"];
 		}
		if(isset($_POST["eliminar"])){
			if($_POST["eliminar"]==1){			
			$data["cc"]="";
				unset($_SESSION["cc"]);
			}
 		}
 		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
 		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
		//VALIDAR SI ES DEMO
		$esDemo=$this->validaDemo($dUsuario);
		//printVar($esDemo);exit;
 		$data["demo"]=false;
		
		if($esDemo[0]==true){
			$dUsuario->id=$esDemo[1][1];
			$dUsuario->id_unidad=$esDemo[1][0];
			$oRecord->iduseval=$esDemo[1][1];
			$data["demo"]=true; 
			//printVar($aData["demo"]);
   		}
		
	
		$jsonorg=Estructura::model()->selectorestructura("view_rcv","idestructura",$esDemo[0]); 
		$arrestructura=Estructura::estructurausuario($esDemo[0]);
		$anios=Estructura::anios($arrestructura,"view_rcv","idestructura","anioc2");
		$data["jsonorg"]=$jsonorg[0];
		$data["organizaciones"]="";
		$data["estado"]= $jsonorg[1];
		$data["anios"]= $anios;
		if(isset($jsonorg[2])){
			$data["organizaciones"]=$jsonorg[2];
			
		}
 		
  		$data["idestructura"]=NULL;
		$data["organizacion"]=NULL;
 		$idpadre=NULL;
		$anioc=NULL;
		
		if(isset($oRecord->iduseval)){
			$data["cc"]="";
			if(isset($_SESSION["cc"])){
				$data["cc"]=$_SESSION["cc"];
			}
			if(isset($_POST["cc"])){
				$_SESSION["cc"]=$_POST["cc"];
				$data["cc"]=$_SESSION["cc"];
			}

		
			$data["idestructura"]=join(",",$arrestructura);
			 
			$data["usuario"]=$dUsuario ;

			
		 //printVar($aData["chart"]); 
			$data["token"]=$this->getTokenpentaho();
			
			 
 			
			if(!isset($_POST["chart"])){
				$this->_renderWrappedTemplate('rcv', 'reportes', $data);
			}else{
				echo json_encode($aData);exit;
			
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
		//printVar($query);exit; 
		if($query==" id="){
			$query=" idorganizacion=".$idorg;
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
			COUNT(*) as total,anioc,idestructura,estructura,nivel
			FROM view_rcv
			WHERE idestructura in (".join(",",$idestructura).")".$subq." GROUP BY anioc";  //printVar($queryString);exit;
 			$eguresult = dbExecuteAssoc($queryString);
			$tdatacubo = $eguresult->readAll();	
 			foreach($tdatacubo as $data){
				array_push($r,$data);
				if(!in_array($data["anioc"],$this->anioc)){
					array_push($this->anioc,$data["anioc"]);
				} 
			}
		}
		 
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
 	
	public function herramienta(){
				$data["cc"]="";
		if(isset($_SESSION["cc"])){
			$data["cc"]=$_SESSION["cc"];
		}
		if(isset($_POST["cc"])){
			$_SESSION["cc"]=$_POST["cc"];
			$data["cc"]=$_SESSION["cc"];
		}
		if(isset($_POST["eliminar"])){
			if($_POST["eliminar"]==1){			
			$data["cc"]="";
				unset($_SESSION["cc"]);
			}
		}
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
		//VALIDAR SI ES DEMO
		$esDemo=$this->validaDemo($dUsuario);
		//printVar($esDemo);exit;
		$data["demo"]=false;

		if($esDemo[0]==true){
			$dUsuario->id=$esDemo[1][1];
			$dUsuario->id_unidad=$esDemo[1][0];
			$oRecord->iduseval=$esDemo[1][1];
			$data["demo"]=true; 
			//printVar($aData["demo"]);
		}


		$jsonorg=Estructura::model()->selectorestructura("view_rcv","idestructura",$esDemo[0]); 
		$arrestructura=Estructura::estructurausuario($esDemo[0]);
		$anios=Estructura::anios($arrestructura,"view_rcv","idestructura","anioc2");
		$data["jsonorg"]=$jsonorg[0];
		$data["organizaciones"]="";
		$data["estado"]= $jsonorg[1];
		$data["anios"]= $anios;
		if(isset($jsonorg[2])){
			$data["organizaciones"]=$jsonorg[2];
			
		}

		$data["idestructura"]=NULL;
		$data["organizacion"]=NULL;
		$idpadre=NULL;
		$anioc=NULL;

		if(isset($oRecord->iduseval)){
			$data["cc"]="";
			if(isset($_SESSION["cc"])){
				$data["cc"]=$_SESSION["cc"];
			}
			if(isset($_POST["cc"])){
				$_SESSION["cc"]=$_POST["cc"];
				$data["cc"]=$_SESSION["cc"];
			}


			$data["idestructura"]=join(",",$arrestructura);
			 
			$data["usuario"]=$dUsuario ;

		}	
	 //printVar($aData["chart"]); 
		$data["token"]=$this->getTokenpentaho();
		//printVar($aData);
   		$this->_renderWrappedTemplate('rcv', 'herramienta', $data);
 	}
	public function resultadosindividuales(){
		$data["cc"]="";
		if(isset($_SESSION["cc"])){
			$data["cc"]=$_SESSION["cc"];
		}
		if(isset($_POST["cc"])){
			$_SESSION["cc"]=$_POST["cc"];
			$data["cc"]=$_SESSION["cc"];
		}
		if(isset($_POST["eliminar"])){
			if($_POST["eliminar"]==1){			
			$data["cc"]="";
				unset($_SESSION["cc"]);
			}
		}
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
		//VALIDAR SI ES DEMO
		$esDemo=$this->validaDemo($dUsuario);
		//printVar($esDemo);exit;
		$data["demo"]=false;

		if($esDemo[0]==true){
			$dUsuario->id=$esDemo[1][1];
			$dUsuario->id_unidad=$esDemo[1][0];
			$oRecord->iduseval=$esDemo[1][1];
			$data["demo"]=true; 
			//printVar($aData["demo"]);
		}


		$jsonorg=Estructura::model()->selectorestructura("view_rcv","idestructura",$esDemo[0]); 
		$arrestructura=Estructura::estructurausuario($esDemo[0]);
		$anios=Estructura::anios($arrestructura,"view_rcv","idestructura","anioc2");
		$data["jsonorg"]=$jsonorg[0];
		$data["organizaciones"]="";
		$data["estado"]= $jsonorg[1];
		$data["anios"]= $anios;
		if(isset($jsonorg[2])){
			$data["organizaciones"]=$jsonorg[2];
			
		}

		$data["idestructura"]=NULL;
		$data["organizacion"]=NULL;
		$idpadre=NULL;
		$anioc=NULL;

		if(isset($oRecord->iduseval)){
			$data["cc"]="";
			if(isset($_SESSION["cc"])){
				$data["cc"]=$_SESSION["cc"];
			}
			if(isset($_POST["cc"])){
				$_SESSION["cc"]=$_POST["cc"];
				$data["cc"]=$_SESSION["cc"];
			}


			$data["idestructura"]=join(",",$arrestructura);
			 
			$data["usuario"]=$dUsuario ;

		}	
	 //printVar($aData["chart"]); 
		$data["token"]=$this->getTokenpentaho();
   		$this->_renderWrappedTemplate('rcv', 'resultadosindividuales', $data);
 	}
	public function monitoreo(){
	
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
 		if(isset($torgs->id)>0){
			$dat = new CDbCriteria;
			$dat->condition = "id=".$torgs->idorg;
 			$modelorg=Organizacion::model()->find($dat);
			if(isset($modelorg->id)){
				$dat = new CDbCriteria;
				$dat->condition = "idorganizacion=".$modelorg->id." and (jmodulos  like '%,".$modulo->idmodulo.",%' or jmodulos  like '".$modulo->idmodulo.",%'  or jmodulos  like '%".$modulo->idmodulo."'  or jmodulos  = '".$modulo->idmodulo."' )";
				$servicio=Servicio::model()->find($dat);
				if(isset($servicio->id)){
					if((int)$servicio->demo==1){
						$query="SELECT * FROM {{cubo_425936}}";
						$eguresult = dbExecuteAssoc($query);
						$res = $eguresult->readAll();
						$total=count($res);
 						if($total>=6){
							$demo=true;
 						}
						//foreach($res as $d){
							//printVar($d);
							
						//}
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
		$idorg=explode(",",$dUsuario->id_unidad);
		$dat->condition = "id in (".join(",",$idorg).") ";
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
		
		$params=array(
						array("key"=>"EMPRESA","val"=>$torgs->id),
						array("key"=>"IDUS","val"=>$oRecord->uid),
						array("key"=>"SID","val"=>"425936"),
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
		$aData["ides2"]=$this->getOwnerestructura($oRecord->iduseval);
		//printVar($aData);
   		$this->_renderWrappedTemplate('rcv', 'monitoreo', $aData);
 	}
	public function programacioncontrolmedico(){
$data["cc"]="";
		if(isset($_SESSION["cc"])){
			$data["cc"]=$_SESSION["cc"];
		}
		if(isset($_POST["cc"])){
			$_SESSION["cc"]=$_POST["cc"];
			$data["cc"]=$_SESSION["cc"];
		}
		if(isset($_POST["eliminar"])){
			if($_POST["eliminar"]==1){			
			$data["cc"]="";
				unset($_SESSION["cc"]);
			}
		}
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
		//VALIDAR SI ES DEMO
		$esDemo=$this->validaDemo($dUsuario);
		//printVar($esDemo);exit;
		$data["demo"]=false;

		if($esDemo[0]==true){
			$dUsuario->id=$esDemo[1][1];
			$dUsuario->id_unidad=$esDemo[1][0];
			$oRecord->iduseval=$esDemo[1][1];
			$data["demo"]=true; 
			//printVar($aData["demo"]);
		}


		$jsonorg=Estructura::model()->selectorestructura("view_rcv","idestructura",$esDemo[0]); 
		$arrestructura=Estructura::estructurausuario($esDemo[0]);
		$anios=Estructura::anios($arrestructura,"view_rcv","idestructura","anioc2");
		$data["jsonorg"]=$jsonorg[0];
		$data["organizaciones"]="";
		$data["estado"]= $jsonorg[1];
		$data["anios"]= $anios;
		if(isset($jsonorg[2])){
			$data["organizaciones"]=$jsonorg[2];
			
		}

		$data["idestructura"]=NULL;
		$data["organizacion"]=NULL;
		$idpadre=NULL;
		$anioc=NULL;

		if(isset($oRecord->iduseval)){
			$data["cc"]="";
			if(isset($_SESSION["cc"])){
				$data["cc"]=$_SESSION["cc"];
			}
			if(isset($_POST["cc"])){
				$_SESSION["cc"]=$_POST["cc"];
				$data["cc"]=$_SESSION["cc"];
			}


			$data["idestructura"]=join(",",$arrestructura);
			 
			$data["usuario"]=$dUsuario ;

		}	
	 //printVar($aData["chart"]); 
		$data["token"]=$this->getTokenpentaho();		//printVar($aData);
   		$this->_renderWrappedTemplate('rcv', 'programacioncontrolmedico', $data);
 	}
	public function resultadosconsolidados(){
		$data["cc"]="";
		if(isset($_SESSION["cc"])){
			$data["cc"]=$_SESSION["cc"];
		}
		if(isset($_POST["cc"])){
			$_SESSION["cc"]=$_POST["cc"];
			$data["cc"]=$_SESSION["cc"];
		}
		if(isset($_POST["eliminar"])){
			if($_POST["eliminar"]==1){			
			$data["cc"]="";
				unset($_SESSION["cc"]);
			}
		}
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
		//VALIDAR SI ES DEMO
		$esDemo=$this->validaDemo($dUsuario);
		//printVar($esDemo);exit;
		$data["demo"]=false;

		if($esDemo[0]==true){
			$dUsuario->id=$esDemo[1][1];
			$dUsuario->id_unidad=$esDemo[1][0];
			$oRecord->iduseval=$esDemo[1][1];
			$data["demo"]=true; 
			//printVar($aData["demo"]);
		}


		$jsonorg=Estructura::model()->selectorestructura("view_rcv","idestructura",$esDemo[0]); 
		$arrestructura=Estructura::estructurausuario($esDemo[0]);
		$anios=Estructura::anios($arrestructura,"view_rcv","idestructura","anioc2");
		$data["jsonorg"]=$jsonorg[0];
		$data["organizaciones"]="";
		$data["estado"]= $jsonorg[1];
		$data["anios"]= $anios;
		if(isset($jsonorg[2])){
			$data["organizaciones"]=$jsonorg[2];
			
		}

		$data["idestructura"]=NULL;
		$data["organizacion"]=NULL;
		$idpadre=NULL;
		$anioc=NULL;

		if(isset($oRecord->iduseval)){
			$data["cc"]="";
			if(isset($_SESSION["cc"])){
				$data["cc"]=$_SESSION["cc"];
			}
			if(isset($_POST["cc"])){
				$_SESSION["cc"]=$_POST["cc"];
				$data["cc"]=$_SESSION["cc"];
			}


			$data["idestructura"]=join(",",$arrestructura);
			 
			$data["usuario"]=$dUsuario ;

		}	
	 //printVar($aData["chart"]); 
		$data["token"]=$this->getTokenpentaho();
		
		$this->_renderWrappedTemplate('rcv', 'resultadosconsolidados', $data);
	}
	
	public function crear(){
 		
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
		//printVar($oRecord);
		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);	
		$validaeditar=EvalUsuarios::model()->vaidausr(false);
		$subq="";
		$usuario=NULL;
		
 		if(isset($_POST["idusuario"]) and (int)$_POST["idusuario"]>0){
			if($oRecord->uid>1 and $dUsuario->id>0){
				$subq=" and uid_creador=".$oRecord->uid;
			} 
			$dat = new CDbCriteria;
			$dat->condition = "id=".(int)$_POST["idusuario"]." ".$subq;
			$usuario = EvalUsuarios::model()->find($dat);
			$aData["usuario"]=$usuario;
 		}
 		$dat = new CDbCriteria;
 		$dat->condition = "activo='1' and id in (2,4)";
 		$perfiles = EvalPerfiles::model()->findAll($dat);
		$aData["perfiles"]=$perfiles;
		
		
		$dat = new CDbCriteria;
		$dat->condition = "id in (".$dUsuario->id_unidad.") ";
		$empresas = EvalUnidades::model()->findAll($dat);
 		
		$aData["empresas"]=$empresas;
 		if(!isset($_POST["save"])){
			App()->getClientScript()->registerScriptFile(Yii::app()->baseUrl."/scripts/yav1_4_1/js/yav.js");
			App()->getClientScript()->registerScriptFile(Yii::app()->baseUrl."/scripts/yav1_4_1/js/yav-config-es.js");
			App()->getClientScript()->registerScriptFile("//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js");
 			$this->_renderWrappedTemplate('rcv', 'crear', $aData);
		}else{
			$uid=NULL;
			if($usuario==NULL){
				$set=new EvalUsuarios();
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
				$empresas=explode(",",$_POST["empresar"]);
				$empresasusuario=explode(",",$dUsuario->id_unidad);
				if(isset($empresas[1])){
					$r=array();
					foreach($empresas as $dat){
						if(in_array($dat,$empresasusuario)){
							array_push($r,(int)$dat);
						}
					}
					$empresas=join(",",$r);
				}else{
					$empresas=(int)$empresas;
				}			
				$perfil=4;
				$perfilesusuario=array(2,4);
				if(in_array((int)$_POST["perfil"],$perfilesusuario)){
					$perfil=(int)$_POST["perfil"];
				}
 				$set->alias=$this->escape($_POST["usuario"]);
				$set->documento=$this->escape($_POST["documento"]);
				$set->email=$this->escape($_POST["email"]);
				$set->perfil=$perfil;
				$set->id_unidad=(int)$this->escape($_POST["empresar"]);
				$set->uid_creador=Yii::app()->user->id;
				$set->fecharegistro=date("Y-m-d H:i:s");
				$set->activo=1;
 				if($set->save()){
					if($uid==NULL){
						$iNewUID = User::model()->insertUserNative($set->alias,$set->clave,$set->documento,Yii::app()->session['loginID'], $set->email,$set->id);
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
						echo json_encode(array("El usuario ha sido actualizado",$set->id));
 					}
 				}else{
				echo json_encode(array("Algo salio mal"));
				}
 			}
 			 
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
		$filtro.=" and u.id_unidad in (".$dUsuario->id_unidad.")";
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
		
		$estado=-1;
		if(isset($_POST["estado"]) and (int)$_POST["estado"]>=-1){
			$estado=(int)$_POST["estado"];
			$act=(int)$_POST["estado"];
 		}
   		if(isset($_POST["buscar"]) and $_POST["buscar"]!=""){
			$sql = new sql_inject();
			$testinject=$sql->test($_POST["buscar"]);
 			if($testinject==false){
				$filtro.=" and ( u.alias like  '%".$_POST["buscar"]."%' or u.email like  '%".$_POST["buscar"]."%')";
				
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
				$datos="   ".$act[0]." or  u.activo =".$act[1];
			}else{
				$datos="  u.activo = ".$act;
			}
 		}		
  		
		$dat = new CDbCriteria;
 		$dat->select = 'id,activo,uid_creador';
		$dat->condition = str_replace("u.","",$datos).str_replace("u.","",$filtro);
		$test = EvalUsuarios::model()->findAll($dat);		
		$num_total_registros=count($test);
		
		//calculo el total de páginas
		$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
 		$arr = array();
         $queryString = "
		SELECT
		{{eval_perfiles}}.nombre AS perfil,
 		u.id AS id_user,
		u.alias as alias,
		u.clave as clave,
 		u.email as email,
		u.id_unidad as id_unidad,
		u.activo as activo,
		u.perfil AS id_perfil
		FROM
		{{eval_usuarios}} u
		INNER JOIN {{eval_perfiles}} ON u.perfil = {{eval_perfiles}}.id		
		WHERE  
		".$datos.$filtro."	
		ORDER BY u.id  
		 LIMIT ".$inicio."," . $TAMANO_PAGINA; 
		// printVar($queryString);
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
	
}