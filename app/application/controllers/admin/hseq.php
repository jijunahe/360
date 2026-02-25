<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');
// error_reporting(E_ALL); ini_set('display_errors', '1');
$documentroot=str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"]);
require_once($documentroot.'application/extensions/PHPMailer/class.phpmailer.php');
require_once($documentroot.'application/extensions/xls/Excel/reader.php');
require_once($documentroot.'application/extensions/class_sql_inject.php');
class Hseq extends Survey_Common_Action
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
		$encuesta=447232;
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
						$this->getController()->redirect(array('/admin/hseq/simulador'));exit;
					break;	
					case "ejecutar":
						$sim = EvalSimulacionhseq::model()->findByPk((int)$_POST["id"]);
						
						 
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
											 
										}else{
 
 											if($pregunta->qid==2172){//EMPRESA
												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=$ejecutaencuesta[$idkey]->id_unidad;
											}
 											 
 											if($pregunta->qid==2173 or $pregunta->qid==2169){//SID
												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=$encuesta;
											}
  											if(  $pregunta->qid==2170){//IDUS
												$q[$encuesta."X".$pregunta->gid."X".$pregunta->qid]=$ejecutaencuesta[$idkey]->id;
											}
  											 
 											
  											if($pregunta->qid==2171){//IDESTRUCTURA
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
									shell_exec ('curl -d "id='.$IDS[0]["id"].'&sid='.(INT)$encuesta.'&no&mode=actualiza&simulacro=Y&idsimulacro='.$sim->id.'" http://'.$_SERVER["HTTP_HOST"].'/'.$dirname[1].'/actualizacubo/hseq/index.php');
 								}
 								 
								 echo json_encode(array("ok","La simulacion ha sido creada","redir"));exit;
								 
							}else{
								$mensaje='Debe crear usuario regular para esa empresa';
								echo json_encode(array("error",$mensaje)); exit;
 							}					
						 
						
						}
					break;
					case "eliminar":
						 
						$sim = EvalSimulacionhseq::model()->findByPk((int)$_POST["id"]);
						
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
 				$simulaciones = EvalSimulacionhseq::model()->findAll();
				//printVar($simulaciones);exit;
 				$aData["simulacion"]= $simulaciones;				
				$this->_renderWrappedTemplate('hseq', 'simulador', $aData);
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
 
	 
 	 
    public function encuesta()
    {  	Yii::app()->cache->flush();
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
				 
					$aData["plantilla"]=false;
					$aData["parte_a"]="";
					$aData["parte_b"]="";
					$aData["img_a"]="";
					$aData["img_b"]="";
					$aData["img_c"]="";
					$aData["img_d"]="";
   					if(file_exists("/var/www".Yii::app()->baseUrl."/files/plantillashseq/".$torgs->idorg."_a.html") and file_exists("/var/www".Yii::app()->baseUrl."/files/plantillashseq/".$torgs->idorg."_b.html"))
					{
						$aData["plantilla"]=true;
						$aData["parte_a"]="/var/www".Yii::app()->baseUrl."/files/plantillashseq/".$torgs->idorg."_a.html";
						$aData["parte_b"]="/var/www".Yii::app()->baseUrl."/files/plantillashseq/".$torgs->idorg."_b.html";
						if(file_exists("/var/www".Yii::app()->baseUrl."/files/plantillashseq/img/".$torgs->idorg."_a.jpg")){
							$aData["img_a"]=Yii::app()->baseUrl."/files/plantillashseq/img/".$torgs->idorg."_a.jpg";
 						}
						if(file_exists("/var/www".Yii::app()->baseUrl."/files/plantillashseq/img/".$torgs->idorg."_b.jpg")){
							$aData["img_b"]=Yii::app()->baseUrl."/files/plantillashseq/img/".$torgs->idorg."_b.jpg";
 						}
						if(file_exists("/var/www".Yii::app()->baseUrl."/files/plantillashseq/img/".$torgs->idorg."_c.jpg")){
							$aData["img_c"]=Yii::app()->baseUrl."/files/plantillashseq/img/".$torgs->idorg."_c.jpg";
 						}

						if(file_exists("/var/www".Yii::app()->baseUrl."/files/plantillashseq/img/".$torgs->idorg."_d.jpg")){
							$aData["img_d"]=Yii::app()->baseUrl."/files/plantillashseq/img/".$torgs->idorg."_d.jpg";
 						}

 					}
					//printVar($aData);exit;
  				 
				$dat->condition = "id=".$torgs->idorg;
				$modelorg=Organizacion::model()->find($dat);
				if(isset($modelorg->id)){
					$nombreorganizacion=$modelorg->nombre;
					$dat = new CDbCriteria;
					$dat->condition = "idorganizacion=".$modelorg->id." and (jmodulos  like '%,".$modulo->idmodulo.",%' or jmodulos  like '".$modulo->idmodulo.",%'  or jmodulos  like '%".$modulo->idmodulo."'  or jmodulos  = '".$modulo->idmodulo."' )";
					$servicio=Servicio::model()->find($dat);
					if(isset($servicio->id)){
						if((int)$servicio->demo==1){
							$query="SELECT * FROM {{cubo_751388}}";
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
			
			Yii::app()->cache->flush();
			$iduhseq="NR";
			$simplificado="N";
 			if(isset($_SESSION["encuesta_token"])){
				$dat = new CDbCriteria;
				$dat->condition = "token='".$_SESSION["encuesta_token"]."'";
				$mushseq = Ushseq::model()->find($dat);
				if(isset($mushseq->id)){
 					$iduhseq=$mushseq->id;
					$simplificado=$mushseq->simplificado;
				}
			}
			$sidid=751388;if($simplificado=="Y"){$sidid=447232;} 
  			$params=array(
							array("key"=>"EMPRESA","val"=>$torgs->idorg),
							array("key"=>"IDUS","val"=>$oRecord->iduseval),
							array("key"=>"SID","val"=>$sidid), 
							array("key"=>"IDHSEQ","val"=>$iduhseq), 
							array("key"=>"NOMBREENCUESTADOR","val"=>$dUsuario->nombres),
							array("key"=>"DOCUMENTOENCUESTADOR","val"=>$dUsuario->documento),
							array("key"=>"EMAILENCUESTADOR","val"=>$dUsuario->email));
 			$aData["urljson"]=(json_encode($params));
 			$aData["simplificado"]=$simplificado;
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
		if(isset($dUsuario->id)){  
			if($dUsuario->perfil==3 or $dUsuario->perfil==4 or $dUsuario->perfil==2){
				$organizaciones=explode(",",$dUsuario->id_unidad);
 				$idusuario=$dUsuario->id;
				$criteria = new CDbCriteria;
 				$criteria->condition = ' idorg in ('.join(",",$organizaciones).')';
				$criteria->order="idorg ASC";
				$hseqdisp=Ushseq::model()->findAll($criteria);
				
				$criteria = new CDbCriteria;
 				$criteria->condition = ' id in ('.join(",",$organizaciones).')';
				$organizaciones=Organizacion::model()->findAll($criteria);
				//printVar($hseqdisp);
				$data["hseqdisp"]=$hseqdisp;
				$data["organizaciones"]=$organizaciones;
				
				$this->_renderWrappedTemplate('hseq', 'index',$data);
			}else{
			$this->_renderWrappedTemplate('hseq', 'alerta',$data);
			}
		}else{
			$this->_renderWrappedTemplate('hseq', 'alerta',$data);
		}
    }
 	public function action(){
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
 		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
		Yii::app()->cache->flush();
		if(isset($_POST["option"]) and ($dUsuario->perfil==3 or $dUsuario->perfil==4 or $dUsuario->perfil==2)){
			$option=$_POST["option"];
			switch($option){
				case "create":
					$model=new Ushseq();
					$documentos=explode(",",$_POST['Ushseq']["documentos"]);
					unset($_POST['Ushseq']["documentos"]);
					$model->token=md5(date("Y-m-d H:i:s"));
					$model->idorg=$_POST['Ushseq']['idorg'];
					$model->attributes=$_POST['Ushseq'];
					if($_POST['Ushseq']["simplificado"]==""){
						$model->simplificado="N";
					}
					$model->fecharegistro=date("Y-m-d H:i:s");
 					$model->save();				
					if($model->id>0){
						if(count($documentos)>0){
						//	$queryc = "delete FROM {{usxhseq}} where idusheq=".$model->id;
						//	$gcrt = dbExecuteAssoc($queryc);
							$criteria = new CDbCriteria;
							$criteria->condition = ' idusheq='.$model->id;
							$test=Usxhseq::model()->findAll($criteria);
							$docs=array();
							foreach($test as $datau){
								$docs[$datau->id]=$datau->documento;
							}
  							foreach($documentos as $dato){
								$criteria = new CDbCriteria;
								$criteria->condition = ' documento="'.(int)$dato.'" and idusheq='.$model->id;
								$modelUs=Usxhseq::model()->find($criteria);
								if(!isset($modelUs->id)){
									$modelUs=new Usxhseq();
								}
 								$modelUs->documento=(int)$dato;
								$modelUs->fecha=date("Y-m-d H:i:s");
								$modelUs->idusheq=$model->id;
								$modelUs->estado='falta';
								$modelUs->save();
							}
							foreach($docs as $keyd=>$dd){
								if(!in_array($dd,$documentos)){
									$queryc = "delete FROM {{usxhseq}} where id=".$keyd;
									$gcrt = dbExecuteAssoc($queryc);
 								}
 							}
 						}
 					}
 				break;
				case "delete":
 					
					$queryc = "delete FROM {{Ushseq}} where id=".$_POST['Ushseq']["id"];
					$gcrt = dbExecuteAssoc($queryc);
					
					$queryc = "delete FROM {{usxhseq}} where idusheq=".$_POST['Ushseq']["id"];
					$gcrt = dbExecuteAssoc($queryc);

				break;
				case "update":
  					$model=Ushseq::model()->findByPk((int)$_POST['Ushseq']["id"]);
					if(isset($model->id)){
						if($model->id>0){
							$documentos=explode(",",$_POST['Ushseq']["documentos"]);
							unset($_POST['Ushseq']["documentos"]);
							$model->attributes=$_POST['Ushseq'];
							$model->fecharegistro=date("Y-m-d H:i:s");
							$model->save();				
							if($model->id>0){
								if(count($documentos)>0){
									$queryc = "delete FROM {{usxhseq}} where idusheq=".$model->id;
									$gcrt = dbExecuteAssoc($queryc);							
									foreach($documentos as $dato){
										$modelUs=new Usxhseq();
										$modelUs->documento=(int)$dato;
										$modelUs->fecha=date("Y-m-d H:i:s");
										$modelUs->idusheq=$model->id;
										$modelUs->estado='falta';
										$modelUs->save(); 
									}
								}
							}
						}
					}
 				break;
			}
		}
		
		$this->getController()->redirect(array('admin/hseq/','r'=>$error)); 
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
		
 		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
 		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
		$dat = new CDbCriteria;
		$dat->condition = "idus=".$id;
		if($dUsuario->perfil==3){
			$dat->condition = "id>0";
			$dat->group="idestrcutura";
		}
 		$idestructura="";
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
		//printVar($idestructura);
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
			//  printVar($idorg."|----|".$idpadre."|----|".$anioc);exit;	
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
			
			if(!isset($_POST["chart"])){
				$this->_renderWrappedTemplate('hseq', 'reportes', $data);
			}else{
				echo json_encode($data);exit;
 			}
		}
	}
	
	
 	
	
	
	public function reportesimplificado(){
		
		
		$jsonorg=Estructura::model()->selectorestructura("view_lime_cubo_447232","idestructura"); 
		$arrestructura=Estructura::estructurausuario(); 
		$anios=Estructura::anios($arrestructura,"view_lime_cubo_447232","idestructura","anio");
		$data["jsonorg"]=$jsonorg[0];
		$data["organizaciones"]="";
		$data["estado"]= $jsonorg[1];
		$data["anios"]= $anios;
		if(isset($jsonorg[2])){
			$data["organizaciones"]=$jsonorg[2];
			
		}
		//printVar($_SERVER["PATH_TRANSLATED"]);
 		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
 		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
 		$idusuario=NULL;
		$organizacion=NULL;
		$idpadre=NULL;
		$anioc=NULL;
		 
		if(isset($dUsuario->id)){
 			 
			$data["idestructura"]=join(",",$arrestructura);
			 
 			$data["usuario"]=$dUsuario ;
 			
			$data["token"]=$this->getTokenpentaho();
			// printVar($data["idestructura"]); 	
			if(!isset($_POST["chart"])){
				$this->_renderWrappedTemplate('hseq', 'reportesimplificado', $data);
			}else{
				echo json_encode($data);exit;
 			}
			 
		}
	}
 	
	
	
	
	public function analisisSociodemografico(){
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
			$dat->condition = "idusuario=".$dUsuario->id;
			$torgs=Usuarioxorg::model()->find($dat);
			$data["organizacion"]=$torgs;  		
 			if(!isset($_POST["chart"])){
				$data["idestructura"]=$this->getOwnerestructura($dUsuario->id);
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
			
			if(!isset($_POST["chart"])){
				$this->_renderWrappedTemplate('hseq', 'analisisSociodemografico', $data);
			}else{
				echo json_encode($data);exit;
 			}
		}
	}
 	
	
	private function error(){$this->_renderWrappedTemplate('hseq', 'error', $data);}
	
	
	
	
	
	private function surveyxestructura($idorg=NULL,$idpadre=NULL,$anio=NULL,$init=false){
		

		if($idpadre>0){
			$query=" idpadre=".$idpadre;
		}
		if($idorg>0   and $idpadre==NULL){
			$query=" idorganizacion=".$idorg." and (idpadre='' or idpadre is NULL)";
		}
		if($init==true){
			$query=" id=140";
			//$query=" id=".$idpadre; 
 		}
		if($query==" id="){
			$this->getController()->redirect(array('admin/hseq/error'));
 			exit;
		}
	 // printVar($query);
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
				// printVar($cantidad);
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
				$subq=" and anio='".$anio."'";
			}
			 
			$queryString = "
			SELECT 
			COUNT(*) as total,anio as anioc,idestructura,estructura,nivelorg
			FROM view_lime_cubo_447232
			WHERE idestructura in (".join(",",$idestructura).")".$subq." GROUP BY anio"; // printVar($queryString);exit;
 			 //printVar($queryString);
			$eguresult = dbExecuteAssoc($queryString);
			$tdatacubo = $eguresult->readAll();	
 			foreach($tdatacubo as $data){
				array_push($r,$data);
				if(!in_array($data["anioc"],$this->anioc)){
					array_push($this->anioc,$data["anioc"]);
				} 
			}
		} 
		 //printVar($r); exit; 
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