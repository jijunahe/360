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
					 					
 					$cols.="rangopersonal varchar(200),";
 					$cols.="fecharegistro varchar(10),";
 					$cols.="idAnswer int(11) DEFAULT NULL,";
					$cols.="idus int(11) DEFAULT NULL,";
					$cols.="idempresa int(11) DEFAULT NULL,";
 					$cols.="sid int(11) DEFAULT NULL,";
 					$cols.="estado enum('D','Y') DEFAULT 'Y' ";
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
   								if(!isset($test[0]["answer"])){ 
 									$info[$campo]=$nValor;
  								}
 							}else{
								if($campo!="id"){
									$info[$campo]=$nValor;
  								}
 							}
 						}
					} 
					 
					$test2=$this->bdObj->select(PREFIJO_TABLAS."cubo_".$this->id,"idAnswer=".$this->idAnswer,"",	"idAnswer");
  					if(!isset($test2[0]["idAnswer"])){
  						$rangopersonal="0"; 
						if($info["294584X97X2096"]>=0 and $info["294584X97X2096"]<=50){
							$rangopersonal="0 - 50";
							
						}
						if($info["294584X97X2096"]>=51 and $info["294584X97X2096"]<=100){
							
							$rangopersonal="51- 100";
						}
						if($info["294584X97X2096"]>=101 and $info["294584X97X2096"]<=150){
							$rangopersonal="101 - 150";
							
						}
						if($info["294584X97X2096"]>=151 and $info["294584X97X2096"]<=200){
							
							$rangopersonal="151 - 200";
						}
						if($info["294584X97X2096"]>=251 and $info["294584X97X2096"]<=500){
							
							$rangopersonal="251- 500";
						}
						if($info["294584X97X2096"]>=501 and $info["294584X97X2096"]<=1000){
							$rangopersonal="501- 1000";
							
						}
						if($info["294584X97X2096"]>1000){
							$rangopersonal="mayor a 1000";
							
						}
 						$info["rangopersonal"]=$rangopersonal;
 						$info["idAnswer"]=$this->idAnswer;
  						$info["idus"]=$resultadoEncuesta[0]["294584X97X2141"];
						$info["idempresa"]=$resultadoEncuesta[0]["294584X97X2140"];
						//$info["estado"]=$resultadoEncuesta[0]["294584X97X2140"];
 						$info["fecharegistro"]=date("Y-m-d H:i:s");
						$info["encuesta"]="seguimiento epidemiológico";
						$info["token"]="NR";
						$info["sid"]=$this->id;
						
						
						$fecha = $info["submitdate"];
						$nuevafecha = strtotime ( '-1 hour' , strtotime ( $fecha ) ) ;
 						$nuevafecha = date ( 'Y-m-d H:i:s' , $nuevafecha );						
 						$info["submitdate"]=$nuevafecha;
 
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
  					}
 				}
 			}
 			$this->bdObj->sendTopentaho();
 		}
		
 		
	}	