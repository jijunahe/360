<?php 
  	//require_once($_SERVER["DOCUMENT_ROOT"]."/pdf/fpdf.php");
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
		public $IDESTRUCTURA=NULL;
		public $IDUS=NULL;
		public $SID=NULL;
		public $EMPRESA=NULL;
		public $IDESTRUCTURA_r=NULL;
		public $IDUS_r=NULL;
		public $EMPRESA_r=NULL;
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
					$params=array("IDUS","SID","EMPRESA","IDESTRUCTURA");
					foreach($this->objTable as $v){
						$list=explode("X",$v["Field"]);
						if(isset($list[2]) ){
							if($list[0]==$this->id){
								$result=$this->bdObj->select(PREFIJO_TABLAS."questions","qid=".$list[2],"","sid,gid,qid,title,question");
								$campo=str_replace(" ","",trim($result[0]["title"]," "));
								if(in_array($campo,$params)){
									$this->{$campo}=$v["Field"];
								}
							}
						}
					}
					
				}
				
			}
 		}	
		
		public function init(){
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
 					 
					$cols.="fecharegistro varchar(10),";
 					$cols.="rangoedad varchar(50),";
					$cols.="indice varchar(10),";
					$cols.="estadoCorporal varchar(100),";
					$cols.="idAnswer int(11) DEFAULT NULL,";
					$cols.="idestructura int(11) DEFAULT NULL,";
					$cols.="estructura varchar(250) DEFAULT NULL,";
					$cols.="nivelorg varchar(250) DEFAULT NULL,";
					$cols.="idus int(11) DEFAULT NULL,";
					$cols.="empresa int(11) DEFAULT NULL,";
					$cols.="idsimulacro int(11) DEFAULT NULL,";
					$cols.="sid int(11) DEFAULT NULL,";
					$cols.="simulacro  enum('Y','N') DEFAULT 'N',";
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
				 
				// printVar($resultadoEncuesta); exit;
				$totalesEncuesta=count($resultadoEncuesta[0]);
				
				$sql = "describe ".PREFIJO_TABLAS."survey_".$this->id;
				$cols=$this->bdObj->run($sql);
				$rCols=array();
				foreach($cols as $dr){
					array_push($rCols,array($dr["Field"]=>1));
				}
				//printVar($totalesEncuesta);
				
				if($totalesEncuesta>0){
				//printVar($resultadoEncuesta[0]);exit;
					foreach($resultadoEncuesta[0]  as  $campo=>$nValor){
						if(isset($_GET["test"])){
							// printVar($campo,$nValor);exit;
						}
						$test=$this->bdObj->select(PREFIJO_TABLAS."cubo_".$this->id,"idAnswer=".$resultadoEncuesta[0]["id"],"",	"idAnswer");
						//COMPRUEBA SI REGISTRO YA FUE AGREGADO	
						//printVar($test);exit;
 						if(($resultadoEncuesta[0]["submitdate"]!="" and  !isset($test[0]["idAnswer"]))){
							//$sql ="SELECT * FROM ".PREFIJO_TABLAS."parametrizacion_encuesta where sid=".$this->id;
							//$cols=$this->bdObj->run($sql);
							list($csid,$gid,$qid)=explode("X",$campo);
							if((int)$csid==$this->id){
								$test=$this->bdObj->select(PREFIJO_TABLAS."answers","qid=".(int)$qid." and code='".$nValor."'","","answer");
								$valor=$nValor;
								if($test!=NULL){
									$info[$campo]=$test[0]["answer"];
 								}else{
									if($valor!=""){
										if($campo!="751388X41X1228" and $campo!="751388X42X1292" ){
											$valor=trim(removeAccents(utf8_encode($valor))," "); 
										}
										if($campo=="751388X41X1230"){
											$valor=number_format($valor,0);
										}
										if($campo=="751388X41X1370"){
											$valor=(int)$valor;
										}
										
										if($campo=="751388X41X1227"){
											$valor=(int)$valor;
										}
										if($campo=="751388X41X1371"){
											$valor=(int)$valor;
										}
  										$info[$campo]=$valor;
									}else{
										$info[$campo]="NR";
 										
									}
									if($campo==$this->IDESTRUCTURA){
										$this->IDESTRUCTURA_r=$valor;
									}
									if($campo==$this->IDUS){
										$this->IDUS_r=$valor;
									}
									if($campo==$this->EMPRESA){
										$this->EMPRESA_r=$valor;
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
					if(isset($_GET["test"])){
						printVar($info);
						exit;
					}
					$test2=$this->bdObj->select(PREFIJO_TABLAS."cubo_".$this->id,"idAnswer=".$this->idAnswer,"",	"idAnswer");

					
					if(!isset($test2[0]["idAnswer"])){
						
						$info["idAnswer"]=$this->idAnswer;
						$info["idestructura"]=$this->IDESTRUCTURA_r;
						$estruct=$this->bdObj->select(PREFIJO_TABLAS."estructura", " id=".$this->IDESTRUCTURA_r);
						$nivel="ORGANIZACION";
						if((int)$estruct[0]["idnivel"]>0){
							$nivelr=$this->bdObj->select(PREFIJO_TABLAS."nivel", " id=".$estruct[0]["idnivel"]);
							$nivel=$nivelr[0]["nombre"];
						}
						$info["estructura"]=$estruct[0]["nombre"];
						$info["nivelorg"]=$nivel;
						$info["idus"]=$this->IDUS_r;
						$info["empresa"]=$this->EMPRESA_r;
						$info["sid"]=$this->id;
						
						//printVar(34567);exit;
						$indice=number_format((int)$info["751388X41X1230"]/(((int)$info["751388X41X1370"]/100)*((int)$info["751388X41X1370"]/100)),2);
						
						$info["indice"]=$indice;
						$estado="";
						if($indice<19.9){
							$estado="Bajo peso";
							
						}
						
						if($indice>19.9 and $indice<=24.9){
							$estado="Peso sano";
							
						}
						
						if($indice>24.9 and $indice<=29.9){
							$estado="Sobrepeso";
							
						}
						
						if($indice>29.9 and $indice<=34.9){
							$estado="Obesidad grado I";
							
						}
						
						if($indice>34.9 and $indice<=39.9){
							$estado="Obesidad grado II";
							
						}
						
						if($indice>39.9){
							$estado="Obesidad morbida";
							
						}
						
						$estado=strtoupper($estado);
						$info["estadoCorporal"]=$estado;
						$fechanacimiento=$info["751388X41X1228"];
						$edad=$info["751388X41X1358"];
						 
						
						$rango="";	
						if((int)$edad>=18 and  (int)$edad<30 ){
							$rango="18 y 30";
						}							
						
						if((int)$edad>=30 and  (int)$edad<40 ){
							$rango="31 y 40";
						}							
						
						if((int)$edad>=40 and  (int)$edad<50 ){
							$rango="41 y 50";
						}							
						
						if((int)$edad>=50 and  (int)$edad<60 ){
							$rango="51 y 60";
						}							
						
						if((int)$edad>60 ){
							$rango="mayor a 61";
						}					
						
						$info["rangoedad"]=$rango;
						$info["751388X41Xrangoedad"]=$rango;
						$info["751388X41Xestructura"]=$info["estructura"];
						$info["submitdate"]=date("Y-m-d H:i:s");
						$exfecha=explode(" ",$info["submitdate"]);
						$info["fecharegistro"]=str_replace("-","",$exfecha[0]);
						$info["idEncuesta"]=$this->id;
						$info["encuesta"]=$nombreEncuesta[0]["surveyls_title"];
						
						
						$g=$info["751388X41X1226"];
						$genero=1;
						$diabetes=0;
						$tabaquismo=0;
						//GENERO
						$vgenero="masculino";
						$vgenero1="femenino";
						if($g=="F" ){
							$genero=2;
							$vgenero="femenino";
							$vgenero1="masculino";
						}							
						$info["token"]="NR";
						$portrabajosi='0';$portrabajono='1';
						$portrabajo="No";
						if($info["751388X42X1244"]=="Y"){
							$portrabajosi='1';$portrabajono='0';
							$portrabajo="Si";
						}
						
						$documento=(int)$info['751388X41X1227'];
						$idhseq=(int)$info['751388X41X1371'];
						
						foreach($info as $campo=>$valor){
							if($valor!=""){
								$test2=explode("X",$campo);
								if(isset($test2[2])){
									$atom=explode("S",$test2[2]);
									$tittle="NR";
									$qid="";
									if(isset($atom[1])){
										$tittle='S'.$atom[1];
										$qid=(int)$atom[0];
										$valorpregunta=$this->bdObj->select(PREFIJO_TABLAS."questions","parent_qid=".(int)$atom[0]." and title='".$tittle."'","","question");
									}else if((int)$test2[2]>0){
										$valorpregunta=$this->bdObj->select(PREFIJO_TABLAS."questions"," qid=".$test2[2]." ","","question");
										$qid=(int)$test2[2];
									}else if($test2[2]=="rangoedad" or $test2[2]=="estructura" ){
										$valorpregunta[0]["question"]=$test2[2];
										$qid=$test2[2];
									}
									if(isset($valorpregunta[0]["question"])){
										$tvalor=$valorpregunta[0]["question"];
										$estruct=$this->bdObj->select(PREFIJO_TABLAS."estructura", " id=".$this->IDESTRUCTURA_r);
										$nivel="Organizacion";
										$nomestructura=$estruct[0]["nombre"];
										if((int)$estruct[0]["idnivel"]>0){
											$nivelr=$this->bdObj->select(PREFIJO_TABLAS."nivel", " id=".$estruct[0]["idnivel"]);
											$nivel=$nivelr[0]["nombre"];
										}
										
										$datatrans["codigo"]=$test2[0]."X".$test2[1]."X".$qid;
										$valida=true;
										if($qid=="1233" and $tittle=="SQ010"){
											$valida=false;
										}
										if($valida==true){	
											if($qid=="rangoedad" or $qid=="estructura"){
												$datatrans["codigo"]=$qid;
											}
											$datatrans["valor"]=$valor;
											$datatrans["enunciado"]=$this->bdObj->getdata($tvalor);
											$datatrans["title"]=$tittle;
											$datatrans["idanswer"]=$this->idAnswer;
											$datatrans["empresa"]=$this->EMPRESA_r;
											$datatrans["idestructura"]=$this->IDESTRUCTURA_r;
											$datatrans["estructura"]=($nomestructura);
											$datatrans["nivelorg"]=utf8_encode($nivel);
											$datatrans[$vgenero]=1;
											$datatrans[$vgenero1]=0;
											$datatrans['portrabajosi']=$portrabajosi;
											$datatrans['portrabajono']=$portrabajono;
											$datatrans['portrabajo']=$portrabajo;
											$datatrans['genero']=$g;
											$sino="No";
											if($info["751388X42X1244"]=="Y"){
												$sino="Si";
											}
											$datatrans["751388X42X1244"]=$sino;
											$datatrans["submitdate"]=$resultadoEncuesta[0]["submitdate"];
											$datatrans["751388X42X1250"]=(int)$info["751388X42X1250"];
											$transformar=$this->bdObj->insert(PREFIJO_TABLAS."hseq_transformada",$datatrans );
										}
									}
									 
								}
							}
						}
						
						unset($info["751388X41Xrangoedad"]);
						foreach($info as $k=>$d){
							if($d==""){
								$info[$k]="NR";
 							}
						} 
 						$rt=$this->bdObj->insert(PREFIJO_TABLAS."cubo_".$this->id, $info);
 						
						$test=$this->bdObj->select(PREFIJO_TABLAS."usxhseq", " idusheq=".$idhseq." and documento='".$documento."'");
						if(isset($test[0]["id"])){
							$rt=$this->bdObj->update(PREFIJO_TABLAS."usxhseq", array("estado"=>"resuelto")," id=".$test[0]["id"]);
						}
					}
 					 
 					
				}
			}
 			$this->bdObj->sendTopentaho();
  		}
 		
		
	}	