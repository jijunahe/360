<?php 
	  
    	//require_once($_SERVER["DOCUMENT_ROOT"]."/pdf/fpdf.php");
	//error_reporting(E_ALL);
	//ini_set('display_errors', '1'); 
	
	 
	require_once(CLASS_DIR."class.db.php");
	
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
		public $params=NULL;
		
		
		 
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
			$this->params=array(
			'F'=>array("RF"=>array('Log_of_age'=>2.32888,'Log_of_CT'=>1.20904,'Log_of_hdl'=>-0.70833,'Log_of_SBP'=>2.76157,'fumador'=>0.52873,'diabetes'=>0.69154),
			"MEC"=>array("a"=>-28.7,"p"=>6.23),
			"MCVNC"=>array("a"=>-30,"p"=>6.42),
			"ko"=>26.1931,
			"ko1"=>0.95012
			),
			'M'=>array("RF"=>array('Log_of_age'=>3.06117,'Log_of_CT'=>1.1237,'Log_of_hdl'=>-0.93263,'Log_of_SBP'=>1.93303,'fumador'=>0.65451,'diabetes'=>0.57367),
			"MEC"=>array("a"=>-21,"p"=>4.62),
			"MCVNC"=>array("a"=>-25.7,"p"=>5.47),
			"ko"=>23.9802,
			"ko1"=>0.88936
			)
			);
	
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
							$dato["Type"]="varchar(40)";
						}
						list($csid,$gid,$qid)=explode("X",$dato["Field"]);
						if($csid==$this->id ){
							//$cols.="valor".$dato["Field"]." int(11) DEFAULT NULL,";
						}
						$cols.=$dato["Field"]." ".$dato["Type"]." ".$null.$autoincrement.",";
						$count++;
					}
					
					$cols.="rangoScore varchar(20),";
					//$cols.="score varchar(10),";
					$cols.="mor10aniosT varchar(10),";
					$cols.="mor10aniosCo varchar(10),";
					$cols.="mor10aniosNoCo varchar(10),";
					$cols.="riesgoFramingham varchar(10),";
					$cols.="riesgom varchar(20),";
					$cols.="riesgo varchar(20),";
					$cols.="modificadoProcam varchar(10),";
					
					$cols.="fecharegistro varchar(10),";
					$cols.="edad varchar(10),";
					$cols.="rangoedad varchar(50),";
					$cols.="indice varchar(10),";
					$cols.="estadoCorporal varchar(100),";
					$cols.="idAnswer int(11) DEFAULT NULL,";
					$cols.="idestructura int(11) DEFAULT NULL,";
					$cols.="idus int(11) DEFAULT NULL,";
					$cols.="nivelorg varchar(100) DEFAULT NULL,";
					$cols.="estructura varchar(100) DEFAULT NULL,";
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
				//printVar($resultadoEncuesta); 
				$totalesEncuesta=count($resultadoEncuesta[0]);
				
				$sql = "describe ".PREFIJO_TABLAS."survey_".$this->id;
				$cols=$this->bdObj->run($sql);
				$rCols=array();
				foreach($cols as $dr){
					array_push($rCols,array($dr["Field"]=>1));
				}
				
 				if($totalesEncuesta>0){
					//printVar($resultadoEncuesta[0] );exit;
 					foreach($resultadoEncuesta[0]  as  $campo=>$nValor){  
						$test=$this->bdObj->select(PREFIJO_TABLAS."cubo_".$this->id,"idAnswer=".$resultadoEncuesta[0]["id"],"",	"idAnswer");
						$fechasubmit=$this->bdObj->select(PREFIJO_TABLAS."survey_".$this->id,"id=".$resultadoEncuesta[0]["id"],"",	"submitdate");
						//COMPRUEBA SI REGISTRO YA FUE AGREGADO									
						 if(($resultadoEncuesta[0]["submitdate"]!="" and  !isset($test[0]["idAnswer"])) or (isset($_POST["enviaremail"]) or isset($_GET["enviaremail"]))){
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
										if($campo!="425936X35X1160"){
											$valor=trim(removeAccents(utf8_encode($valor))," "); 
										}
										if($campo=="425936X35X1162"){ 
											//$valor=number_format($valor,0); 
											if($valor>=400){
												$valor=$valor/10;
											}
										}
										if($campo=="425936X35X1161"){
											if($valor<40){
												$valor=$valor*100;
											}
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
					$info["idAnswer"]=$this->idAnswer;
					$info["idestructura"]=$this->IDESTRUCTURA_r;
					$info["idus"]=$this->IDUS_r;
					$info["empresa"]=$this->EMPRESA_r;
					$info["sid"]=$this->id;
					
					$info["idestructura"]=$this->IDESTRUCTURA_r;
					$estruct=$this->bdObj->select(PREFIJO_TABLAS."estructura", " id=".$this->IDESTRUCTURA_r);
					$nivel="ORGANIZACION";
					if((int)$estruct[0]["idnivel"]>0){
						$nivelr=$this->bdObj->select(PREFIJO_TABLAS."nivel", " id=".$estruct[0]["idnivel"]);
						$nivel=$nivelr[0]["nombre"];
					}
					$info["estructura"]=$estruct[0]["nombre"];
					$info["nivelorg"]=$nivel;
 					$indice=number_format($info["425936X35X1162"]/(($info["425936X35X1161"]/100)*($info["425936X35X1161"]/100)),2);
					
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
					$fechanacimiento=$info["425936X35X1160"];
					$edad=calcularedad($info["425936X35X1160"]);
					$info["edad"]=$edad;
					
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
					$ffff=explode(" ",$resultadoEncuesta[0]["submitdate"]);
					
					$info["submitdate"]=$ffff[0];
					$info["datestamp"]=$resultadoEncuesta[0]["datestamp"];
					$exfecha=explode(" ",$info["submitdate"]);
					$info["fecharegistro"]=str_replace("-","",$exfecha[0]);
					$info["idEncuesta"]=$this->id;
					$info["encuesta"]=$nombreEncuesta[0]["surveyls_title"];
 					
					$g=$info["425936X35X1159"];
					$genero=1;
					$diabetes=0;
					$tabaquismo=0;
					//GENERO
					if($g=="F" ){
						$genero=2;
					}							
					//DIABETES
					if($info["425936X35X1174"]=="Y" ){
						$diabetes=1;
					}							
					//TABAQUISMO 
					if($info["425936X35X1168"]=="Y" ){
						$tabaquismo=1;
					}				
					
					$lnedad=$this->params[$g]["RF"]["Log_of_age"]*number_format(log ((int)$edad),30);
					$lncoltotal=$this->params[$g]["RF"]["Log_of_CT"]*number_format(log ((int)$info["425936X35X1166"]),30);
					$lnhdl=$this->params[$g]["RF"]["Log_of_hdl"]*number_format(log ((int)$info["425936X35X1167"]),30);
					//------------------------------------------------------------------- Tensi&oacute;n sist&oacute;lica
					$lntas=$this->params[$g]["RF"]["Log_of_SBP"]*number_format(log ((int)$info["425936X35X1170"]),30);
					//-------------------------------------------------------------------
					$lntabaquismo=$this->params[$g]["RF"]["fumador"]*$tabaquismo;
					$lndiabetes=$this->params[$g]["RF"]["diabetes"]*$diabetes;
					$sumatoria=$lnedad+$lncoltotal+$lnhdl+$lntas+$lntabaquismo+$lndiabetes;
					$expo=number_format(exp($sumatoria-$this->params[$g]["ko"]),30);
					$pot=number_format(1-pow($this->params[$g]["ko1"],$expo),30);
					
					$riesgoFramingham=number_format($pot*100,2);
					$modificadoProcam=number_format(( ($pot*0.75))*100,2);
					
					
					if($riesgoFramingham<=9.9){
						$riesgo="Bajo";	
					}
					if($riesgoFramingham>9.9 and $riesgoFramingham<=19.9){
						$riesgo="Moderado";	
					}
					if($riesgoFramingham>19.9 and $riesgoFramingham<=29.9){
						$riesgo="Alto";	
					}
					if($riesgoFramingham>29.9){
						$riesgo="Muy Alto";	
					}
					
					if($modificadoProcam<=9.9){
						$riesgom="Bajo";	
					}
					if($modificadoProcam>9.9 and $modificadoProcam<=19.9){
						$riesgom="Moderado";	
					}
					if($modificadoProcam>19.9 and $modificadoProcam<=29.9){
						$riesgom="Alto";	
					}
					if($modificadoProcam>29.9){
						$riesgom="Muy Alto";	
					}				
					
					$info["riesgom"]=$riesgom;
					$info["riesgo"]=$riesgo;
					$info["riesgoFramingham"]=$riesgoFramingham;
					$info["modificadoProcam"]=$modificadoProcam;
					$info["estadoCorporal"]=$estado;
					
					
					
					$CDH20=exp(-(exp($this->params[$g]["MEC"]["a"]))*(pow(((int)$edad-20),$this->params[$g]["MEC"]["p"])));
					$CDH10=exp(-(exp($this->params[$g]["MEC"]["a"]))*(pow(((int)$edad-10),$this->params[$g]["MEC"]["p"])));
					
					
					$noCDH20=exp(-(exp($this->params[$g]["MCVNC"]["a"]))*(pow(((int)$edad-20),$this->params[$g]["MCVNC"]["p"])));
					$noCDH10=exp(-(exp($this->params[$g]["MCVNC"]["a"]))*(pow(((int)$edad-10),$this->params[$g]["MCVNC"]["p"])));
					
					
					$matriz1=array('fumadorActual'=>array("M"=>0.71,"F"=>0.63,"I"=>$tabaquismo),
					'colesterol_en_mmol_litro'=>array("M"=>0.24,"F"=>0.02,"I"=>(number_format($info["425936X35X1166"],30)/37.5)),
					//----------------------------------------------------------------------------// Presi&oacute;n sist&oacute;lica
					'Presion_sistolica_en_mmHg'=>array("M"=>0.018,"F"=>0.022,"I"=>number_format($info["425936X35X1170"],30))
					//----------------------------------------------------------------------------------
					);
					
					$w=($matriz1["colesterol_en_mmol_litro"]["M"]*($matriz1["colesterol_en_mmol_litro"]["I"]-6))+($matriz1["Presion_sistolica_en_mmHg"]["M"]*($matriz1["Presion_sistolica_en_mmHg"]["I"]-120)+($matriz1["fumadorActual"]["M"]*$matriz1["fumadorActual"]["I"]));
					$w1=($matriz1["colesterol_en_mmol_litro"]["F"]*($matriz1["colesterol_en_mmol_litro"]["I"]-6))+($matriz1["Presion_sistolica_en_mmHg"]["F"]*($matriz1["Presion_sistolica_en_mmHg"]["I"]-120)+($matriz1["fumadorActual"]["F"]*$matriz1["fumadorActual"]["I"]));
					
					$wCDH1=pow($CDH20,exp($w));
					$wCDH2=pow($CDH10,exp($w));
					
					$wNoCDH1=pow($noCDH20,exp($w1));
					$wNoCDH2=pow($noCDH10,exp($w1));
					
					
					$s10ageCDH=($wCDH2/$wCDH1);
					$s10ageNoCDH=($wNoCDH2/$wNoCDH1);
					
					
					$riesgo10aniosCDH=number_format((1-$s10ageCDH)*100,3);
					$riesgo10aniosNoCDH=number_format((1-$s10ageNoCDH)*100,3);
					
					$riesgo10aniosTOTAL=$riesgo10aniosCDH+$riesgo10aniosNoCDH;
					
					if($riesgo10aniosTOTAL<=2){
						$rangoScore="Bajo";	
					}
					if($riesgo10aniosTOTAL>2 and $riesgo10aniosTOTAL<=5){
						$rangoScore="Moderado";	
					}
					
					if($riesgo10aniosTOTAL>5 and $riesgo10aniosTOTAL<=10){
						$rangoScore="Alto";	
					}
					
					if($riesgo10aniosTOTAL>10){
						$rangoScore="Critico";	
					}
					
					$info["rangoScore"]=$rangoScore;
					$info["mor10aniosT"]=$riesgo10aniosTOTAL;
					$info["mor10aniosCo"]=$riesgo10aniosCDH;
					$info["mor10aniosNoCo"]=$riesgo10aniosNoCDH;
					$info["token"]="NR";
					
					if(isset($_POST["simulacro"])){
						$info["simulacro"]="Y";
						$info["idsimulacro"]=(int)$_POST["idsimulacro"];
					}
					
					
					if(!isset($_POST["enviaremail"]) and !isset($_GET["enviaremail"])){
						$rt=$this->bdObj->insert(PREFIJO_TABLAS."cubo_".$this->id, $info);
 					}
					
					$valida=array("425936X35X1152","425936X35X1153","425936X35X1154","mor10aniosNoCo","mor10aniosT","mor10aniosCo","token","lastpage","startlanguage","startdate","datestamp","encuesta","rangoedad","idEncuesta","encuesta");
					$html="<table>";
					$objCols=(object)array(
					"idAnswer"=>"C&oacute;digo de Registro",
					"submitdate"=>"Fecha de Inscripci&oacute;n",
					"425936X35X1156"=>"Nombre y Apellidos",
					"425936X35X1155"=>"Documento de identidad",
					"425936X35X1157"=>"N&uacute;mero de celular",
					"425936X35X1159"=>"G&eacute;nero",
					"425936X35X1158"=>"Correo electr&oacute;nico",
					"425936X35X1160"=>"Fecha de nacimiento",
					"425936X35X1161"=>"Estatura en cent&iacute;metros",
					"425936X35X1162"=>"Peso en kilogramos",
					"indice"=>"Índice de masa corporal",
					"estadoCorporal"=>"Estado corporal",
					"425936X35X1163"=>"Per&iacute;metro de la cintura en cent&iacute;metros",
					"425936X35X1164"=>"Glicemia en sangre en ayunas",
					"425936X35X1165"=>"Triglic&eacute;ridos",
					"425936X35X1166"=>"COLESTEROL TOTAL",
					"425936X35X1167"=>"COLESTEROL HDL",
					"425936X35X1175"=>"¿Practicas alguna actividad f&iacute;sica?",
					"edad"=>"Edad",
					"425936X35X1168"=>"¿Eres fumador?",
					"425936X35X1169"=>"¿Sufre de hipertensi&oacute;n Arterial?",
					"425936X35X1170"=>"Tensi&oacute;n Arterial Sist&oacute;lica",
					"425936X35X1171"=>"Tensi&oacute;n Arterial Diast&oacute;lica",
					"425936X35X1178"=>"¿Alguna vez el m&eacute;dico le ha dicho que usted, tiene un problema card&iacute;aco y que por eso s&oacute;lo deber&iacute;a realizar actividad f&iacute;sica recomendada por &eacute;l?",
					"425936X35X1179"=>"¿Cu&aacute;ndo hace actividad f&iacute;sica siente dolor en el pecho?",
					"425936X35X1180"=>"¿En el &uacute;ltimo mes y estando en reposo, ha sentido dolor en el pecho?",
					"425936X35X1181"=>"¿Pierde el equilibrio por mareos o v&eacute;rtigo, o alguna vez ha perdido el conocimiento?",
					"425936X35X1182"=>"¿Tiene un problema &oacute;seo o articular que pudiera empeorar por un aumento en su actividad f&iacute;sica habitual?",
					"425936X35X1183"=>"¿Actualmente el m&eacute;dico le est&aacute; prescribiendo medicamentos (por ejemplo diur&eacute;ticos) para su presi&oacute;n arterial o para su coraz&oacute;n?",
					"425936X35X1184"=>"¿Conoce alguna otra raz&oacute;n por la cual no deber&iacute;a hacer actividad f&iacute;sica?",
					"parqu"=>"Par q & u",
					"425936X35X1172"=>"¿Presentas condiciones cardiovasculares?",
					"425936X35X1174"=>"¿Sufres de diabetes?",
					//"riesgoFramingham"=>"Riesgo Framingham",
					"riesgo"=>"Riesgo Framingham",
					"riesgom"=>"Riesgo Framingham modificado",
					//"modificadoProcam"=>"modificadoProcam",
					"rangoScore"=>"Score",
					"frecuencia"=>"Frecuencia control m&eacute;dico",
					"acciones"=>"Acciones"
					);
					$objr=array();
					$si=0;
					$no=0;
					
					foreach($objCols as $key=>$value){
						//$SurveyPregunta=trim(removeAccents(utf8_encode($value))," ");
						$SurveyPregunta=trim((($value))," ");
						$value="";
						if(isset($info[(String)$key])){
							$value=$info[(String)$key];
						}
						
						if( !in_array($key,$valida)){ 
							if($value!="No responde"){
								 
								//$SurveyPregunta=General::getTotalDatos(PREFIJO_TABLAS."Questions",array("question")," sid=".$surveys[$i]->sid." and gid=".$IDGRUPO." and qid=".$IDPREGUNTA); 
								if($value=='Y'){
									$value="Si";
								}
								
								if($value=='N'){
									$value="No";
								}
								if($value=='M'){
									$value="Masculino";
								}
								if($value=='F'){
									$value="Femenino";
								}
								if($key=="indice"){
									$value="Su &iacute;ndice de masa corporal (relaci&oacute;n peso-talla), lo ubica en ".$value;
								}
								
								if($key=="425936X35X1163"){
									$value=$value."<br>".$this->analisis("425936X35X1163",$value,$info["425936X35X1159"]);
								}
								
								
								if($key=="425936X35X1164"){
									$value=$value."<br>".$this->analisis("425936X35X1164",$value);
								}
								
								
								if($key=="425936X35X1167"){
									$value=$value."<br>".$this->analisis("425936X35X1167",$value);
								}
								
								if($key=="425936X35X1175"){
									$value=$value."<br>".$this->analisis("425936X35X1175",$value);
								}
								
								if($key=="425936X35X1168"){
									$value=$value."<br>".$this->analisis("425936X35X1168",$value);
								}
								
								if($key=="425936X35X1169"){
									$value=$value."<br>".$this->analisis("425936X35X1169",$value);
								}
								
								if($key=="425936X35X1171"){
									$value=$value."<br>".$this->analisis("425936X35X1171",$value);
								}
								
								if($key=="riesgo"){
									$value=$value."<br>".$this->analisis("riesgo",$info["riesgo"]);
								}
								
								if($key=="riesgom"){
									$value=$value."<br>".$this->analisis("riesgom",$info["riesgom"]);
								}
								if($key=="rangoScore"){ 
									$value=$info["mor10aniosT"]."<br>".$value."<br>".$this->analisis("rangoScore",$info["rangoScore"]);
								}
								
								
								if($key=="frecuencia"){
									$r=$this->analisis("control",array($info["riesgoFramingham"],$info["submitdate"]));
									$value=$r["control"];
								}
								
								
								if($key=="acciones"){
									$r=$this->analisis("control",array($info["riesgoFramingham"],$info["submitdate"]));
									$value=$r["accion"];
								}
								
								$valida2=array("425936X35X1178","425936X35X1179","425936X35X1180","425936X35X1181","425936X35X1182","425936X35X1183","425936X35X1184");
								
								if(in_array($key,$valida2)){
									if($value=="Si"){
										$si++;
									}
									if($value=="No"){
										$no++;
									}
									
								} 
								
								## ## par q, habilitar cuando lo pidan
								##if($key=="parqu"){
								##	if($si>0){
								#		$value="<br>".$this->analisis("parqu","Si");
								#		}else if($no==7){
								#		$value="<br>".$this->analisis("parqu","No");
								#	}
								#}										
								$k2=$key;
								array_push($objr,array($key=>trim((($value))," "),"pregunta"=>$SurveyPregunta));
								if($SurveyPregunta!=""){
									$key=$SurveyPregunta;
								} 
								
								if($k2!="parqu" and !in_array($k2,$valida2)){ 
									$html.="<tr>";
									$html.="<td style='border-top: 1px solid #ddd;background-color: #f1f1f1;padding: 8px;line-height: 1.42857143;vertical-align: top;'>";
									$html.=$key;
									$html.="</td>";
									$html.="<td  style='border-top: 1px solid #ddd;padding: 8px;line-height: 1.42857143;vertical-align: top;'>";
									$html.=$value;
									$html.="</td>";
									$html.="</tr>";	
								}
							}
						}
					}
					
					$html.="</table>"; 
					$html.="<div style='clear:both'></div>";
					$html.="<div style='clear:both'></div>";	
					
					  				
					if(!isset($_POST["no"])){
						if(!isset($_POST["noemail"])){
							if($info["425936X35X1154"]=="NR" or $info["425936X35X1154"]==NULL){
								$result=$this->bdObj->select("lime_organizacion","id=".$info["425936X35X1151"],"","emailcontacto");
								if($result[0]["emailcontacto"]!=NULL){
									$info["425936X35X1154"]=$result[0]["emailcontacto"];
								}
								else{
									$info["425936X35X1154"]="info@talentracking.com";
								}
							}
							senEmail( $info,$html);
							if(isset($_POST["enviaremail"]) or isset($_GET["enviaremail"])  ){
								printVar($info["425936X35X1158"],"ENVIANDO A:");
							}
						}
					} 
					 
 					
 					
				}
			}
			if(!isset($_POST["no"])){
				$this->bdObj->sendTopentaho();
			}
		} 
		
		public function analisis($key,$valor,$genero=""){
			$resultado="";
			switch($key){
				case "estadoCorporal":
				if($valor=="Bajo peso"){
						$resultado="<p>BAJO PESO: este puede ser secundario y/o sintom&aacute;tico de una enfermedad subyacente. La p&eacute;rdida de peso inexplicada requiere de un diagn&oacute;stico m&eacute;dico, por lo cual sugerimos que consulte con su m&eacute;dico. La Cultura del Cuidado de Corazones Responsables es una opci&oacute;n para mantener un peso saludable.</p>";
					}
					if($valor=="Peso sano"){
						$resultado="<p>Peso sano:  Usted se encuentra en el peso ideal. Felicitaciones. La Cultura del Cuidado de Corazones Responsables es una opci&oacute;n para mantener un peso saludable.</p>";
					}
					if($valor=="Sobrepeso"){
						$resultado='<p>Sobrepeso: El exceso de peso tiene por causa m&aacute;s com&uacute;n un exceso de grasa corporal que est&aacute; asociada al sedentarismo, pero tambi&eacute;n puede ser resultado de "exceso" de masa &oacute;sea y m&uacute;sculo (hipertrofia muscular, la cual no es una enfermedad sino algo frecuente en deportistas), o acumulaci&oacute;n de l&iacute;quidos por diversos problemas. Le sugerimos que consulte con su m&eacute;dico. La Cultura del Cuidado de Corazones Responsables es una opci&oacute;n para mantener un peso saludable.</p>';
					}
					if($valor=="Obesidad grado I" or $valor=="Obesidad grado II" or $valor=="Obesidad morbida" or $valor=="Obesidad"){
						$resultado="<p>Obesidad: es una enfermedad grave que puede generar otras enfermedades, pero que se puede prevenir. La obesidad se caracteriza por acumulaci&oacute;n excesiva de grasa en el cuerpo..Le sugerimos que consulte con su m&eacute;dico. La Cultura del Cuidado de Corazones Responsables es una opci&oacute;n para mantener un peso saludable.</p>";
					}
				break;
				
				case "425936X35X1163"://PERIMETRO CINTURA
				
					if(($genero=="M" and $valor<=90) or ($genero=="F" and $valor<=80)){
						$resultado="Excelente, Felicitaciones !!! ";
					}
				
					if(($genero=="F" and $valor>80)){
						$resultado="<p>La circunferencia abdominal ha demostrado tener una relaci&oacute;n inversa con el espacio en el interior de las peque&ntilde;as arterias que irrigan el coraz&oacute;n, cerebro y otros &oacute;rganos sensibles. Tener m&aacute;s de 80 cm en mijeres latinoamericanas aumenta el riesgo de eventos cardiovasculares.</p>";
						
					}
				
					if(($genero=="M" and $valor>90)  ){
						$resultado="<p>La circunferencia abdominal ha demostrado tener una relaci&oacute;n inversa con el espacio en el interior de las peque&ntilde;as arterias que irrigan el coraz&oacute;n, cerebro y otros &oacute;rganos sensibles. Tener m&aacute;s de 90 cm en hombres latinoamericanos aumenta el riesgo de eventos cardiovasculares.</p>";
						
					}
				
				break;
				case "425936X35X1164":// GLISEMIA
					$resultado="<br><p>Es ideal conocer sus niveles de az&uacute;car en la sangre. Antes de desayunar los niveles normales de glucosa est&aacute;n entre 60 y 99 mg/dl, si es inferior hay una hipoglucemia. Cuando se encuentra entre los 100 y 125 mg/dl hay una alteraci&oacute;n que puede ser un indicativo de una prediabetes y cuando supera los 126 mg/dl es una hiperglucemia, generalmente un indicativo de un estado diab&eacute;tico. Es importante conocer los niveles de az&uacute;car en sangre o de glicemia al menos una vez cada a&ntilde;o y si los niveles son superiores o inferiores hay que acudir de inmediato al m&eacute;dico. Pacific es una empresa saludable. La cultura del cuidado de corazones responsables es una opci&oacute;n para cuidar su coraz&oacute;n. Cuidar el coraz&oacute;n es cuidar la vida.</p>";
				break;
				 
				case "425936X35X1167":// COLESTEROL HDL
					$resultado="<br><p>Es ideal conocer sus niveles de grasas en la sangre. Cuando el colesterol y triglic&eacute;ridos se suben se produce una enfermedad conocida como dislipidemia. Esta enfermedad es silenciosa porque no presenta s&iacute;ntomas y produce una alteraci&oacute;n del metabolismo de esos l&iacute;pidos y su consecuencia es que se adhieren a las paredes de las arterias, dificultando el paso de la sangre o incluso tapon&aacute;ndolas que es cuando se produce un infarto en el coraz&oacute;n o en el cerebro. El examen de l&iacute;pidos debe hacerse al menos una vez al a&ntilde;o y debe consultar su m&eacute;dico si est&aacute;n elevados. La cultura del cuidado de corazones responsables es una opci&oacute;n para cuidar su coraz&oacute;n. Cuidar el coraz&oacute;n es cuidar la vida.</p>";
				break;
				
				case "425936X35X1175"://Practicas alguna actividad f&iacute;sica?
					if($valor=="No"){
						$resultado="Siempre hay oportunidad de iniciar, animo";
						
					}
					if($valor=="Si"){
						$resultado="Felicidades<br>";
					}
					$resultado.="<p>Las personas activas son m&aacute;s felices. Moverse genera alegr&iacute;a y bienestar. Si te mueves tu coraz&oacute;n se mueve. La cultura del cuidado de corazones responsables es una opci&oacute;n para promover la cultura del movimiento.</p>";
				break;
				
				case "425936X35X1168"://Eres fumador?
					if($valor=="No"){
						$resultado="Felicidades<br>";
						
					}
					$resultado.="<p>Fumar es la primera causa de enfermedad, discapacidad y muerte evitable de la poblaci&oacute;n colombiana. </p><p>El humo del cigarrillo ataca la salud del coraz&oacute;n, por esto, desde la perspectiva de corazones responsables, al promover de espacios libres de humo de cigarrillo, se parte de la premisa de buscar nuevos escenarios libres de humo de cigarrillo para proteger a quienes no fuman y de ninguna manera para estigmatizar, perseguir o segregar a los fumadores, respetando su decisi&oacute;n sobre fumar o no fumar y garantizando a unos y a otros, ambientes en los que puedan respirar con tranquilidad. Quienes fuman tienen un riesgo importante de padecer enfermedades, de morir prematuramente o de tener una p&eacute;sima calidad de vida en la vejez. Este riesgo es mayor cuanto m&aacute;s tabaco se consume diariamente y cuanto m&aacute;s tiempo se fuma. No obstante, y esto es muy importante, al abandonar el consumo de tabaco este riesgo se va reduciendo a medida que el tiempo pasa. Por ejemplo, el riesgo de enfermedad coronaria (infarto, angina de pecho), se normaliza al cabo de 10 a&ntilde;os de dejar de fumar. La cultura del cuidado de corazones responsables es una opci&oacute;n para promover la cultura de los espacios libres de humo.</p>";
				break;
				
				case "425936X35X1169":
					$resultado="<p>La hipertensi&oacute;n arterial es una enfermedad silenciosa que no da s&iacute;ntomas. La vigilancia de su propia presi&oacute;n arterial es una buena manera de cuidarse y estar atento a las se&ntilde;ales de su cuerpo. Le sugerimos que consulte con su m&eacute;dico. La cultura del cuidado de corazones responsables es una opci&oacute;n para cuidar su coraz&oacute;n. Cuidar el coraz&oacute;n es cuidar la vida.</p>";
				break;
				 
				case "425936X35X1178":
 					$resultado="<p>El cuestionario par-q & u  o cuestionario de aptitud f&iacute;sica, originado en canad&aacute;, pretende evaluar a una persona que iniciar&aacute; un proceso de ejercicio fisico o practica deportiva. El cuestionario tiene 7 preguntas que deben ser responidas con sinceridad. en caso que alguna sea positiva, antes de iniciar su plan debe consultar a su m&eacute;dico. </p>";
				break;
				 
				case "inicio":
					$resultado="Gracias por haber respondido nuestra encuesta “Cultura del cuidado para corazones responsables”, ahora sabr&aacute;s si el cuidado es una prioridad en tu vida.<br>De acuerdo con tus respuestas hemos llegado a las siguientes conclusiones:";
				break;
				
				case "final":
					$resultado="Esta encuesta es el inicio de un Coraz&oacute;n Responsable.<br> Si te conectas con nosotros puedes convertirte en un voluntario activo de la cultura del cuidado y ser  ejemplo para las personas que amas.";
				break;
				
				case "425936X35X1171":// PRESION DIASTOLICA
					$resultado="La tensi&oacute;n arterial (o presi&oacute;n arterial) es la fuerza que ejerce la sangre en las arterias. Su c&aacute;lculo se realiza entre el numerador que es la tensi&oacute;n arterial sist&oacute;lica y el denominador que es la diast&oacute;lica. Ambas pueden presentar elevaci&oacute;n o puede darse de manera individual, &eacute;sta condici&oacute;n genera una enfermedad conocida como hipertensi&oacute;n arterial.<br>El nivel normal se sit&uacute;a est&aacute; entre los 100-139/60-89 mm hg.<br>Es importante controles peri&oacute;dicos de la tensi&oacute;n. En caso de estar por encima de los valores mencionados, consulte a su m&eacute;dico.";
				break;
				case "riesgo":
					$resultado="Esta es una escala que nos establece la posibilidad en porcentaje de sufrir un accidente vascular cardiaco o cerebral en los pr&oacute;ximos 10 a&ntilde;os.<br>Se considera de bajo cuando es menor al 10%, medio cuando esta entre el 11 y 20% y alto en adelante.<br>Se debe consultar al m&eacute;dico si no est&aacute; en nivel bajo.";
				break;
				
				case "riesgom":
					$resultado="La modificaci&oacute;n de la escala de riesgo de Framingham se hace que sea v&aacute;lida en la poblaci&oacute;n colombiana. Muestra el riesgo de tener un evento vascular cardiaco o cerebral.<br>Se debe estar en control m&eacute;dico si es superior a 10.";
				break;
				
				
				case "rangoScore":
					$resultado="Esta es una escala que nos establece la posibilidad de morir por un accidente vascular cardiaco o cerebral en los pr&oacute;ximos 10 a&ntilde;os.<br>Se considera de bajo cuando es menor al 10%, medio cuando esta entre el 11 y 20% y alto en adelante. Se debe consultar al m&eacute;dico si no est&aacute; en nivel bajo.";
				break;
				case "parqu":
					if($valor=="Si"){
						$resultado="El cuestionario par q & u o cuestionario de aptitud f&iacute;sica, originado en Canad&aacute;, pretende evaluar a una persona que iniciara un proceso de ejercicio f&iacute;sico o pr&aacute;ctica deportiva. De acuerdo con sus respuestas encontramos no tiene ninguna restricci&oacute;n f&iacute;sica para iniciar su plan de ejercicio.";
					}
					if($valor=="No"){
						$resultado="El cuestionario par q & u o cuestionario de aptitud f&iacute;sica, originado en Canad&aacute;, pretende evaluar a una persona que iniciar&aacute; un proceso de ejercicio f&iacute;sico o pr&aacute;ctica deportiva. De acuerdo con sus respuestas encontramos no tiene ninguna restricci&oacute;n f&iacute;sica para iniciar su plan de ejercicio.";
					}
				break;
				case "control":
				
					if($valor[0]<=9.9){
						$control='Riesgo bajo control cada a&ntilde;o';
						$gDias=365;
						$accion='Mantener manejo, retroalimentar y estimular  (EVS y tratamiento)';
					}
					if($valor[0]>=10 && $valor[0]<19.9  ){
						$control='Riesgo medio control cada 6 meses';
						$gDias=183;
						$accion='Remisi&oacute;n Sistema general de salud. Suspensi&oacute;n actividad f&iacute;sica. Referir L&iacute;der SO y Gerencia M&eacute;dica Corporativa ';
					}
					if($valor[0]>=20 && $valor[0]<29.9  ){
						$control='Riesgo alto - control cada 3 meses';
						$gDias=90;
						$accion='Remisi&oacute;n Sistema general de salud. Suspensi&oacute;n actividad f&iacute;sica. Referir L&iacute;der SO y Gerencia M&eacute;dica Corporativa ';
					}
					if($valor[0]>=30 ){
						$control='Riesgo Muy alto - control mensual';
						$gDias=30;
						$accion='Remisi&oacute;n Sistema general de salud. Suspensi&oacute;n actividad f&iacute;sica. Referir L&iacute;der SO y Gerencia M&eacute;dica Corporativa. ';
					}			
				
					$fecha = $valor[1];
					$nuevafecha = strtotime ( '+'.((int)$gDias).' day' , strtotime ( $fecha ) ) ;
					$nuevafecha = date ( 'Y,F' , $nuevafecha );
					$f=explode(",",$nuevafecha);
					switch($f[1]){
						case "January":$f[1]="Enero";
						break;
						case "February":$f[1]="Febrero";
						break;
						case "March":$f[1]="Marzo";
						break;
						case "April":$f[1]="Abril";
						break;
						case "May":$f[1]="Mayo";
						break;
						case "June":$f[1]="Junio";
						break;
						case "July":$f[1]="Julio";
						break;
						case "August":$f[1]="Agosto";
						break;
						case "September":$f[1]="Septiembre";
						break;
						case "October":$f[1]="Octubre";
						break;
						case "November":$f[1]="Noviembre";
						break;
						case "December":$f[1]="Diciembre";
						break;
						
					}
					$resultado=array("control"=>$control.', pr&oacute;ximo control  en '.$f[1].' de '.$f[0].'.',"accion"=>$accion);
				break;
			}
			return $resultado;
			
		}		
		
		
		
	}	