<?php 
  	//require_once($_SERVER["DOCUMENT_ROOT"]."/pdf/fpdf.php");
	//printVar(23456);exit;
	require_once(CLASS_DIR."class.db.php");
	//error_reporting(E_ALL);
	ini_set('display_errors', '0');
	class Action{
		public $bdObj;
		public $id=NULL;
		public $idAnswer=NULL;
		public $objTable=NULL;
		public $validaTableCubo=NULL;
		public $validaTable=NULL;
 		public $IDUS=NULL;
		public $SID=NULL;
		public $IDORG=NULL;
 		public $IDUS_r=NULL;
		public $IDORG_r=NULL;
		public $VISITA=NULL;
		public $VISITA_R=NULL;
		
		public $TIPO=NULL;
		public $TIPO_R=NULL;
		
		public $IDFORM=NULL;
		public $IDFORM_R=NULL;
		
		
		
 		public function __construct()
		{ 
			$this->bdObj=new db("mysql:host=".serverdb_link.";port=3306;dbname=".database_link,username_link ,password_link );
 			
			if(isset($_GET["id"])){
				$this->idAnswer=(int)$_GET["id"];
			}
			if(isset($_POST["id"])){
				$this->idAnswer=(int)$_POST["id"];
			}
			if(isset($_GET["sid"])){
				$this->id=(int)$_GET["sid"];
			}
			if(isset($_POST["sid"])){
				$this->id=(int)$_POST["sid"];
			}
			if($this->id>0 and $this->idAnswer>0){
				
				//VALIDARA SI EXISTE TABLA
				$results =$this->bdObj->select("information_schema.tables",
				"table_schema='".database_link."' AND table_name ='".PREFIJO_TABLAS."cubo_".$this->id."'",
				"",
				"COUNT(*) AS count"
				);
				$this->validaTableCubo=$results[0]["count"];
				
				$results =$this->bdObj->select("information_schema.tables",
				"table_schema='".database_link."' AND table_name ='".PREFIJO_TABLAS."survey_".$this->id."'",
				"",
				"COUNT(*) AS count"
				);
				$this->validaTable=$results[0]["count"];
				if($this->validaTable>0){		
					
					$sql = "describe ".PREFIJO_TABLAS."survey_".$this->id;
					$this->objTable=$this->bdObj->run($sql);
					$params=array("IDUS","SID","IDORG","VISITA","TIPO","IDFORM");
					foreach($this->objTable as $v){
						$list=explode("X",$v["Field"]);
						if(isset($list[2]) ){
							if($list[0]==$this->id){
								$result=$this->bdObj->select(PREFIJO_TABLAS."questions","qid=".$list[2],"","sid,gid,qid,title,question");
								$campo=str_replace(" ","",trim($result[0]["title"]," "));
								if(in_array(strtoupper($campo),$params)){
								//printVar(strtoupper($campo),$v["Field"]);
 									$this->{strtoupper($campo)}=$v["Field"];
								}
							}
						}
					}
					
				}
				
			}
 		}	
		
		public function init(){
 			$g41=array("preg1");
			$g42=array("preg2a","preg2b");
			$g43=array("preg3a","preg3b");
			
 			
			$g51=array("preg4","preg5","preg6","preg7","preg8","preg9","preg10");
			$g52=array("preg11","preg12","preg13","preg14","preg15","preg16");
			$g53=array("preg17","preg18");
			
			$g61=array("preg19","preg20","preg21","preg22","preg23","preg24","preg25");
			$g62=array("preg26","preg27","preg28","preg29","preg30",);
			$g63=array("preg31","preg32","preg33","preg34",);
			$g64=array("preg35","preg36","preg37","preg38","preg39","preg40","preg41","preg42","preg43",);
			$g65=array("preg44","preg45","preg46","preg47","preg48",);
			
			$g71=array("preg49","preg50","preg51","preg52","preg53","preg54",);
			$g72=array("preg55","preg56","preg57","preg58","preg59",);
			$g73=array("preg60","preg61","preg62","preg63","preg64","preg65","preg66","preg67","preg68","preg69","preg70","preg71","preg72",);
			
			$g81=array("preg73","preg74","preg75","preg76","preg77",);
			$g82=array("preg78","preg79","preg80","preg81","preg82","preg83","preg84","preg85","preg86","preg87","preg88",);
			
			$g91=array("preg89","preg90","preg91","preg92","preg93","preg94","preg95",);
			$g92=array("preg96","preg97","preg98",);
			$g93=array("preg99","preg100","preg101","preg102","preg103","preg104",);
			$g94=array("preg105","preg106","preg107","preg108","preg109","preg110","preg111",
			"preg112","preg113","preg114","preg115","preg116","preg117","preg118","preg119",
			"preg120","preg121","preg122");
			
			
			$g101=array("preg123","preg124","preg125","preg126","preg127","preg128",);
			$g102=array("preg129","preg130","preg131","preg132","preg133",);
			
			$gruposxsubs=array(68=>array(41,42,43),78=>array(71,72,73),89=>array(51,52,53),91=>array(61,62,63,64,65),93=>array(81,82),94=>array(91,92,93,94),95=>array(101,102));
			$grupos=array(68,78,89,91,93,94,95);
			
			if($this->validaTable>0){
				if($this->validaTableCubo==0){
					$rest=$this->objTable;	
					$cols="";
					$key="";
					$count=0;
					foreach($rest as $dato){
						$null="DEFAULT NULL";
						$autoincrement="";
						if($dato["Null"]=="NO"){
							$null="NOT NULL";
						}
						if($dato["Key"]=="PRI"){
							$key=$rest[$count]["Field"];
						}
						if($dato["Extra"]=="auto_increment"){
							$autoincrement=" AUTO_INCREMENT";
						}
						if($dato["Type"]=="varchar(5)" or $dato["Type"]=="varchar(15)"){
							$dato["Type"]="varchar(100)";
						}
						list($csid,$gid,$qid)=explode("X",$dato["Field"]);
						if($csid==$this->id ){
							//$cols.="valor".$dato["Field"]." int(11) DEFAULT NULL,";
						}
						$cols.=$dato["Field"]." ".$dato["Type"]." ".$null.$autoincrement.",";
						$count++;
					}
					$gcontrol=array();
 					foreach($gruposxsubs as $g=>$sg){
						if(!in_array($g,$gcontrol)){
							$cols.="promg".$g." varchar(10),";
							$cols.="porg".$g." varchar(10),";
							array_push($gcontrol,$g);
						}
						for($i=0;$i<count($sg);$i++){
							$cols.="promsubg".$sg[$i]." varchar(10),";
							$cols.="porsubg".$sg[$i]." varchar(10),";
						}
						
					} 					
 					$cols.="fecharegistro varchar(10),";
 					$cols.="idAnswer int(11) DEFAULT NULL,";
					$cols.="idus int(11) DEFAULT NULL,";
					$cols.="idempresa int(11) DEFAULT NULL,";
					$cols.="promediototal varchar(100) DEFAULT NULL,";
					$cols.="sid int(11) DEFAULT NULL,";
					$cols.="tipo varchar(11) DEFAULT NULL,";
					$cols.="visita varchar(11) DEFAULT NULL,";
					$cols.="idform varchar(11) DEFAULT NULL,";
 					$cols.="encuesta varchar(200) DEFAULT NULL,";
 					if($key!=""){
						$cols.="PRIMARY KEY (`".$key."`)";
					}
					$create="CREATE TABLE `".PREFIJO_TABLAS."cubo_".$this->id."`(".$cols.") ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;";
					// printVar($create);exit;
					$this->bdObj->run($create);
				}
				$nombreEncuesta=$this->bdObj->select(PREFIJO_TABLAS."surveys_languagesettings",
				"surveyls_survey_id=".$this->id,
				"",
				"surveyls_title"
				);	
				
				$QUERY="";
				if($this->idAnswer>0){
					$QUERY=" id=".$this->idAnswer;
				}			
				if($QUERY!=""){
					$QUERY.=" and submitdate is not NULL  LIMIT 0,5";
					}else{
					$QUERY=" submitdate is not NULL LIMIT 0,5";
				}	
				
				
				$resultadoEncuesta=$this->bdObj->select(PREFIJO_TABLAS."survey_".$this->id,
				$QUERY
				);
				 
				//printVar($resultadoEncuesta); 
				$totalesEncuesta=count($resultadoEncuesta[0]);
				
				$sql = "describe ".PREFIJO_TABLAS."survey_".$this->id;
				$cols=$this->bdObj->run($sql);
				$rCols=array();
				foreach($cols as $dr){
					array_push($rCols,array($dr["Field"]=>1));
				}
				
				 
				if($totalesEncuesta>0){
					$sumatoria=0;
					$contador=0;
 					$gcontrol=array();
 					foreach($gruposxsubs as $g=>$sg){
						if(!in_array($g,$gcontrol)){
							${"sumatoria_grupo_".$g}=0;
							${"array_grupo_".$g}=array();
							${"contador_grupo_".$g}=0;
							array_push($gcontrol,$g);
						}
						for($i=0;$i<count($sg);$i++){
							${"sumatoria_subgrupo_".$sg[$i]}=0;
							${"array_subgrupo_".$sg[$i]}=array();
							${"contador_subgrupo_".$sg[$i]}=0;
							//printVar(${"array_subgrupo_".$sg[$i]},"array_subgrupo_".$sg[$i]);
 						}
 					}
					$promtotal=array();
					 
					foreach($resultadoEncuesta[0]  as  $campo=>$nValor){
						if(isset($_GET["test"])){
							//printVar($campo,$nValor);
						}
						$test=$this->bdObj->select(PREFIJO_TABLAS."cubo_".$this->id,"idAnswer=".$resultadoEncuesta[0]["id"],"",	"idAnswer");
						//COMPRUEBA SI REGISTRO YA FUE AGREGADO	
 						if(($resultadoEncuesta[0]["submitdate"]!="" and  !isset($test[0]["idAnswer"]))){
						
							
  							list($csid,$gid,$qid)=explode("X",$campo);
							 
							if((int)$csid==$this->id){
								 
								$test=$this->bdObj->select(PREFIJO_TABLAS."answers","qid='".$qid."' and code='".$nValor."'","","answer");
								$valor=$nValor;
								if(is_numeric($valor)){
									$valor=$valor-1;
								}
  								if(!isset($test[0]["answer"])){ 
 									$info[$campo]=$test[0]["answer"];
 									$tempt=explode("comm",$campo);
									//printVar($tempt);
 									if(isset($tempt[1])){
										$info[$campo]=trim(removeAccents(utf8_encode($valor)));
										if($info[$campo]==""){
											$info[$campo]="NR";
										}
									}
									//printVar($campo); 
 								}else{
									if($valor!="" or $valor==0){
									   
										$qdata=$this->bdObj->select(PREFIJO_TABLAS."questions","qid=".(int)$qid);
  										$qdata=$qdata[0];
										$valor=number_format($valor,2);
										$sumatoria=number_format($sumatoria+$valor,2);
										$contador++;
   										$info[$campo]=$valor;
										
										$subgrupos=$gruposxsubs[$qdata["gid"]];
										$pregunta=$qdata["title"];
										$bandera=false;
										$ii=0;
										$t=count($subgrupos);
  										while($bandera==false){
										
											if(in_array($pregunta,${"g".$subgrupos[$ii]})){
												//printVar($subgrupos[$ii]);
												${"contador_subgrupo_".$subgrupos[$ii]}++;
												${"contador_grupo_".$qdata["gid"]}++;
												${"sumatoria_subgrupo_".$subgrupos[$ii]}=number_format(${"sumatoria_subgrupo_".$subgrupos[$ii]}+$valor,2);
												array_push(${"array_subgrupo_".$subgrupos[$ii]},number_format($valor,2));
												array_push(${"array_grupo_".$qdata["gid"]},number_format($valor,2));
												${"sumatoria_grupo_".$qdata["gid"]}=number_format(${"sumatoria_grupo_".$qdata["gid"]}+$valor,2);
												//printVar(${"sumatoria_subgrupo_".$subgrupos[$ii]},$subgrupos[$ii]);
												$bandera=true;
												
 											}
											$ii++;
											if($ii>=$t){
												$bandera=true;
											}
										}
 										array_push($promtotal,number_format($valor,2));
										 
										
									}else{
										$info[$campo]="NR";
  									}
									 
									if($campo==$this->IDUS){
 										$this->IDUS_r=$valor;
									}
									if($campo==$this->IDORG){
										$this->IDORG_r=$valor;
									}
									if($campo==$this->VISITA){
										$this->VISITA_R=$valor;
									}
									if($campo==$this->TIPO){
										$this->TIPO_R=$valor;
									}
									if($campo==$this->IDFORM){
										$this->IDFORM_R=$valor;
									}
								}
								 
							}else{
								if($campo!="id"){
									$info[$campo]=$nValor;
  								}
								if($campo=="id"){
									//
								}
							}
							 
							
							
							
							
							
						}
					} 
					 
					$test2=$this->bdObj->select(PREFIJO_TABLAS."cubo_".$this->id,"idAnswer=".$this->idAnswer,"",	"idAnswer");
					$promediototal=number_format($sumatoria/$contador);
 					if(!isset($test2[0]["idAnswer"])){
  						$gcontrol=array();
						foreach($gruposxsubs as $g=>$sg){
							if(!in_array($g,$gcontrol)){
								if(count(${"array_grupo_".$g})>0){
 								$info["promg".$g]=number_format((array_sum (${"array_grupo_".$g})/count(${"array_grupo_".$g})),2);
 								$info["porg".$g]=number_format((($info["promg".$g]*100)/3),2);
 								array_push($gcontrol,$g);
								}else{ $info["promg".$g]="DVE";}
 							}
 							for($i=0;$i<count($sg);$i++){
								if(count(${"array_subgrupo_".$sg[$i]})>0){
  								$info["promsubg".$sg[$i]]=number_format((array_sum (${"array_subgrupo_".$sg[$i]})/count(${"array_subgrupo_".$sg[$i]})),2);
 								$info["porsubg".$sg[$i]]=number_format((($info["promsubg".$sg[$i]]*100)/3),2);
								}else{
								
									$info["promsubg".$sg[$i]]="DVE";
								}
							}
							
						} 
 						$info["idAnswer"]=$this->idAnswer;
  						$info["idus"]=$resultadoEncuesta[0]["984333X68X2092"];
						$info["idempresa"]=$resultadoEncuesta[0]["984333X68X2091"];
						$info["tipo"]=$resultadoEncuesta[0]["984333X68X2093"];
						$info["visita"]=$resultadoEncuesta[0]["984333X68X2094"];
						$info["idform"]=$resultadoEncuesta[0]["984333X68X2095"];
						$info["fecharegistro"]=date("Y-m-d H:i:s");
						$info["encuesta"]="PCOS";
						$info["token"]="NR";
						$info["sid"]=$this->id;
						$info["promediototal"]=number_format((array_sum($promtotal)/count($promtotal)),2);
						$info["porcentajetotal"]=number_format((($info["promediototal"]*100)/3),2);

						if(isset($_GET["test"])){
							printVar($info);
							 exit;
						}
						foreach($info as $kk=>$data){
							if($data==""){
								$info[$kk]="NR";
							}
						}
						$rt=$this->bdObj->insert(PREFIJO_TABLAS."cubo_".$this->id, $info);
 						
						$rvista=$this->bdObj->select("view_cubo_".$this->id,"idAnswer=".$info["idAnswer"],"","*");
  						foreach($rvista[0] as $key=>$data){
							$info2["idAnswer"]=$info["idAnswer"];
							$info2["idus"]=$info["idus"];
							$info2["submitdate"]=$info["fecharegistro"];
							$info2["idempresa"]=$info["idempresa"];
							$info2["tipo"]=$info["tipo"];
							$info2["visita"]=$info["visita"];
							$info2["idform"]=$info["idform"];
 							$info2["codigo"]=$key;
							$info2["valor"]=$data;
							$info2["enunciado"]=$key;
							$info2["porcentaje"]=0;
							$info2["grupo"]="NR";
							$info2["subgrupo"]="NR";
							
							$grupo=explode("promg",$key);
 							if(isset($grupo[1])){
								$rgrupo=$this->bdObj->select(PREFIJO_TABLAS."groups","gid=".(int)$grupo[1]);
								$info2["enunciado"]= $rgrupo[0]["group_name"];
								$info2["porcentaje"]=$info["porg".$grupo[1]];
								$info2["grupo"]="promg".$grupo[1];
								$info2["subgrupo"]=$info2["grupo"];
 							}
							 
							
							$subgrupo=explode("promsubg",$key);
							if(isset($subgrupo[1])){
 
								$subg=array(
									41=>array("Requisitos Generales Del Sistema De Gestión Del Riesgo De Enfermedades Cardiovasculares Y Otras Enfermedades Crónicas No Transmisibles",68),
									42=>array("Alcance Del Sistema De Gestión Del Riesgo De Enfermedades Cardiovasculares Y Otras Enfermedades Crónicas No Transmisibles",68),
									43=>array("Partes Interesadas",68),
									51=>array("Liderazgo y Compromiso",89),
									52=>array("Política De Gestión Del Riesgo De Enfermedades Cardiovasculares Y Otras Enfermedades Crónicas No Transmisibles",89),
									53=>array("Funciones de la Organización, Responsabilidad y Autoridad",89),
									61=>array("Acciones para abordar riesgos y Oportunidades.",91),
									62=>array("Planificación para la Identificación de Factores de Peligro de Enfermedades Cardiovasculares y otras enfermedades Crónicas no Transmisibles.",91),
									63=>array("Determinación de los Requisitos Legales y Otro Reglamentarios.",91),
									64=>array("Objetivos Metas y Programas.",91),
									65=>array("Planeación de los Cambios.",91),
									71=>array("Formación, toma de consiencia y competencia.",78),
									72=>array("Comunicación, Participación y Consulta.",78),
									73=>array("Documentación.",78),
									81=>array("Implementación de Control para la Gestión del Riesgo Cardiovascular y otras enfermedades Crónicas no Transmisibles.",93),
									82=>array("Preparación y Respuesta ante Emergencias.",93),
									91=>array("Medición y Seguimiento del Desempeño.",94),
									92=>array("Evaluación del cumplimiento legal y otros.",94),
									93=>array("Auditoría Interna.",94),
									94=>array("Revisión del Sistema por la Dirección.",94),
									101=>array("Investigación de Desenlaces Intermedios y Tardíos, No Conformidades, Acciones Correctivas.",95),
									102=>array("No Conformidad y Acción Correctiva.",95),
								);
 								$info2["enunciado"]=utf8_decode($subg[(int)$subgrupo[1]][0]);
								$info2["porcentaje"]=$info["porsubg".$subgrupo[1]];
								$info2["grupo"]="promg".$subg[(int)$subgrupo[1]][1];
							}
 							
							
  							$info2["title"]=$key;
							//printVar($info2);
							$rt=$this->bdObj->insert(PREFIJO_TABLAS."pcos_transformada", $info2);
							
						}
 					}
 					
 					
				}
 			}
 			$this->bdObj->sendTopentaho();
 		}
		
 		
	}	