<?php 
  	//require_once($_SERVER["DOCUMENT_ROOT"]."/pdf/fpdf.php");
	require_once(CLASS_DIR."class.db.php");
	//error_reporting(E_ALL);
	//ini_set('display_errors', '1'); 
	class Action{
		public $bdObj;
		public $id=NULL;
		public $gethtml=false;
		public $idAnswer=NULL;
		public $objTable=NULL;
		public $validaTableCubo=NULL;
		public $validaTable=NULL;
  		public $SID=NULL;
		public $EMPRESA=NULL;
 		public $EMPRESA_r=NULL;
		public $eneltrabajo=array("214322X50X1405"=>0,"214322X50X1406"=>0,"214322X50X1407"=>0,"total"=>0,"resultado"=>"","preguntas"=>3);
		public $enelclimalaboral=array("214322X50X1409"=>0,"214322X50X1410"=>0,"214322X50X1411"=>0,"total"=>0,"resultado"=>"","preguntas"=>3);
		public $conmivida=array("214322X50X1413"=>0,"214322X50X1414"=>0,"214322X50X1415"=>0,"total"=>0,"resultado"=>"","preguntas"=>3);
		public $enlaorganizacion=array("214322X50X1417"=>0,"214322X50X1418"=>0,"214322X50X1419"=>0,"214322X50X1542"=>0,"total"=>0,"resultado"=>"","preguntas"=>4);
		public $preguntas=array("214322X50X1405","214322X50X1406","214322X50X1407","214322X50X1409","214322X50X1410","214322X50X1411","214322X50X1413","214322X50X1414","214322X50X1415","214322X50X1417","214322X50X1418","214322X50X1419","214322X50X1542");
		public $preguntas_key=array(
										"214322X50X1405"=>"eneltrabajo",
										"214322X50X1406"=>"eneltrabajo",
										"214322X50X1407"=>"eneltrabajo",
										"214322X50X1409"=>"enelclimalaboral",
										"214322X50X1410"=>"enelclimalaboral",
										"214322X50X1411"=>"enelclimalaboral",
										"214322X50X1413"=>"conmivida",
										"214322X50X1414"=>"conmivida",
										"214322X50X1415"=>"conmivida",
										"214322X50X1417"=>"enlaorganizacion",
										"214322X50X1418"=>"enlaorganizacion",
										"214322X50X1419"=>"enlaorganizacion",
										"214322X50X1542"=>"enlaorganizacion"
									);
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
			if(isset($_GET["gethtml"])){
				$this->gethtml=true;
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
					$params=array("EMPRESA");
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
 					$cols.="resultado varchar(100),";
 					$cols.="puntaje varchar(20),";
					
					$cols.="eneltrabajo varchar(11) DEFAULT NULL,";
					$cols.="enelclimalaboral varchar(11) DEFAULT NULL,";
					$cols.="conmivida varchar(11) DEFAULT NULL,";
					$cols.="enlaorganizacion varchar(11) DEFAULT NULL,";
					
					
					$cols.="reseneltrabajo varchar(11) DEFAULT NULL,";
					$cols.="resenelclimalaboral varchar(11) DEFAULT NULL,";
					$cols.="resconmivida varchar(11) DEFAULT NULL,";
					$cols.="resenlaorganizacion varchar(11) DEFAULT NULL,";
					
 					$cols.="empresa varchar(50) DEFAULT NULL,";
 					$cols.="idempresa int(11) DEFAULT NULL,";
 					$cols.="idtoken int(11) DEFAULT NULL,";
					$cols.="sid int(11) DEFAULT NULL,";
					$cols.="idAnswer int(11) DEFAULT NULL,";
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
				 
 				$totalesEncuesta=count($resultadoEncuesta[0]);
				
				$sql = "describe ".PREFIJO_TABLAS."survey_".$this->id;
				$cols=$this->bdObj->run($sql);
				$rCols=array();
				foreach($cols as $dr){
					array_push($rCols,array($dr["Field"]=>1));
				}
 				$test=$this->bdObj->select(PREFIJO_TABLAS."cubo_".$this->id,"idAnswer=".$resultadoEncuesta[0]["id"],"",	"idAnswer");
 				
				if(($totalesEncuesta>0  and  !isset($test[0]["idAnswer"])) or $this->gethtml==true){
					//$eneltrabajo,$enelclimalaboral, $conmivida,$enlaorganizacion
					$contador_eneltrabajo=0;
					$contador_enelclimalaboral=0;
					$contador_conmivida=0;
					$contador_enlaorganizacion=0;
					
					$acumulador_eneltrabajo=0;
					$acumulador_enelclimalaboral=0;
					$acumulador_conmivida=0;
					$acumulador_enlaorganizacion=0;

 					foreach($resultadoEncuesta[0]  as  $campo=>$nValor){
						if(isset($_GET["test"])){
							// printVar($campo,$nValor);
						}
						$test=$this->bdObj->select(PREFIJO_TABLAS."cubo_".$this->id,"idAnswer=".$resultadoEncuesta[0]["id"],"",	"idAnswer");
						//COMPRUEBA SI REGISTRO YA FUE AGREGADO	
						if((!isset($test[0]["idAnswer"]) and $this->gethtml==true)){
							$test=$this->bdObj->select(PREFIJO_TABLAS."cubo_".$this->id,"idAnswer=".$this->id,"",	"idAnswer");
							
						}
   						if(($resultadoEncuesta[0]["submitdate"]!="" and  !isset($test[0]["idAnswer"])) or $this->gethtml==true){
							//$sql ="SELECT * FROM ".PREFIJO_TABLAS."parametrizacion_encuesta where sid=".$this->id;
							//$cols=$this->bdObj->run($sql);
							list($csid,$gid,$qid)=explode("X",$campo);
							//printVar($csid,$this->id);
							if((int)$csid==$this->id){
								$test=$this->bdObj->select(PREFIJO_TABLAS."answers","qid=".(int)$qid." and code='".$nValor."'","","answer");
								$valor=$nValor;
								
								if($test!=NULL){
									$info[$campo]=$test[0]["answer"];
									
									if(in_array($campo,$this->preguntas)){
										//$eneltrabajo,$enelclimalaboral, $conmivida,$enlaorganizacion
 										$rt=number_format(((($info[$campo])/((int)$this->{$this->preguntas_key[$campo]}["preguntas"]*10))*10),6);
										 
 										if(isset($this->{$this->preguntas_key[$campo]}[$campo])){
											$this->{$this->preguntas_key[$campo]}[$campo]=$rt;
											${"acumulador_".$this->preguntas_key[$campo]}+=$this->{$this->preguntas_key[$campo]}[$campo];
											${"contador_".$this->preguntas_key[$campo]}++;
											if(${"contador_".$this->preguntas_key[$campo]}==(int)$this->{$this->preguntas_key[$campo]}["preguntas"]){
												$this->{$this->preguntas_key[$campo]}["total"]=round(${"acumulador_".$this->preguntas_key[$campo]},1,PHP_ROUND_HALF_UP);
												if($this->{$this->preguntas_key[$campo]}["total"]>=6 and $this->{$this->preguntas_key[$campo]}["total"]<=10){
													$this->{$this->preguntas_key[$campo]}["resultado"]="feliz";
												}else if($this->{$this->preguntas_key[$campo]}["total"]<=5.9){
													$this->{$this->preguntas_key[$campo]}["resultado"]="triste";
												}
											}
										} 
										 
 									}
 								}else{
									if($valor!=""){
										if($campo!="214322X50X1423" ){
											$valor=trim(removeAccents(utf8_encode($valor))," "); 
										}
										 
										if($campo=="214322X50X1421"){
											$valor=(int)$valor;
										}
 										 									
 										$info[$campo]=$valor;
									}else{
										$info[$campo]="NR";
 										
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
						//$eneltrabajo,$enelclimalaboral, $conmivida,$enlaorganizacion

						printVar($this->eneltrabajo);
						printVar($this->enelclimalaboral);
						printVar($this->conmivida);
						printVar($this->enlaorganizacion);
						exit;
					}
					$test=$this->bdObj->select(PREFIJO_TABLAS."organizacion", " id=".(int)$info["214322X50X1434"]);
					$info["idempresa"]=(int)$info["214322X50X1434"]; 
					$info["empresa"]=$test[0]["nombre"];
					
					$info["eneltrabajo"]=$this->eneltrabajo["total"];
					$info["enelclimalaboral"]=$this->enelclimalaboral["total"];
					$info["conmivida"]=$this->conmivida["total"];
 					$info["enlaorganizacion"]=$this->enlaorganizacion["total"];
					
					$info["reseneltrabajo"]=$this->eneltrabajo["resultado"];
					$info["resenelclimalaboral"]=$this->enelclimalaboral["resultado"];
					$info["resconmivida"]=$this->conmivida["resultado"];
 					$info["resenlaorganizacion"]=$this->enlaorganizacion["resultado"];
					
 					//printVar($this->eneltrabajo+$this->enelclimalaboral+$this->conmivida+$this->enlaorganizacion);
 					$info["puntaje"]=round(($this->eneltrabajo["total"]+$this->enelclimalaboral["total"]+$this->conmivida["total"]+$this->enlaorganizacion["total"])/4,1,PHP_ROUND_HALF_UP);
					//$info["idAnswer"]=
					if($info["puntaje"]<5){
						$info["resultado"]="triste";
 					}else{
						$info["resultado"]="feliz";
					}
					
					$info["idAnswer"]=$this->idAnswer;
  					$info["sid"]=$this->id;
 					$info["rangoedad"]=$info["214322X50X1423"];
 					$info["idtoken"]=(int)$info["214322X50X1461"];
					$info["submitdate"]=date("Y-m-d H:i:s");
					$exfecha=explode(" ",$info["submitdate"]);
					$info["fecharegistro"]=str_replace("-","",$exfecha[0]);
					$info["idEncuesta"]=$this->id;
					$info["encuesta"]=$nombreEncuesta[0]["surveyls_title"];
					
 					 						
 					$info["token"]="NR";
					
					$documento=(int)$info['751388X41X1227'];
					 
					$baseUrl=explode("index.php",$_SERVER["SCRIPT_NAME"]);
					$baseUrl=$baseUrl[0];
					 
					//printVar('<img  src="https://'.$_SERVER["HTTP_HOST"].$baseUrl.'mailing/feliz.png" />');
					//exit;
					
					if($this->gethtml==false){
						$rt=$this->bdObj->insert(PREFIJO_TABLAS."cubo_".$this->id, $info);
					}else if($_GET["test"]==1){
						printVar($info,"info");
						
 					}
					
					
					if($this->gethtml==false){
 					 $html=' 
						<center>
						<div style="padding:5px;background-color:#DC2A23">
							<table border="0px" style="width:90%">  
							  <tr style="height: 130px;background-color:#DC2A23">
								  <td ><center><b style="color:#fff;font-size: 28px;">Estos son tus resultados!<br>'.$info["encuesta"].'</b></center> </td>
								 <td></td>
								 <td></td>
								 <td ><center><img src="https://'.$_SERVER["HTTP_HOST"].$baseUrl.'mailing/logon.jpg" /></center></td>
							  </tr>					 
							</table>
						</div>
						</center>';
					}	
						$html.='
						<center>
						<table border="0px">  
						  
						  <tr style="height: 70px;">
							  <td colspan="3"> </td>
 						  </tr>
						  <tr style="height: 120px;">
							  <td style="width: 120px; background-color:#F8BD41;    padding: 3px;"><center><b  style="color:#fff;font-size: 25px;">CareE</b><br><b  style="color:#fff;font-size: 12px;">Tengo el control de mis emociones</b> <br><b style="color:#fff;font-size: 25px;">'.$info["eneltrabajo"].'</b></center> </td>
							  <td style="width: 120px;"></td>
							  <td style="width: 120px; background-color:#4892A7;    padding: 3px;"><center><b style="color:#fff;font-size: 25px;">CareGrow</b><br><b  style="color:#fff;font-size: 12px;">Puedo desarrollar mis fortalezas.</b> <br><b style="color:#fff;font-size: 25px;">'.$info["enlaorganizacion"].'</b></center> </td>
						  </tr>
						  <tr style="height: 120px;">
							  <td  style="width: 120px;"></td>
							  <td  style="width: 120px;background-color:#41719C;    padding: 3px;"><center><span style="color:#fff;font-size: 25px;"> <b>Índice de felicidad</b><br> <b>'.$info["puntaje"].'</b></span></center></td>
							  <td  style="width: 120px;"></td>
						  </tr>
						   <tr style="height: 120px;">
							  <td style="width: 120px;background-color:#E94649;    padding: 3px;"><center><b style="color:#fff;font-size: 25px;" >CareJob</b><br><b style="color:#fff;font-size: 12px;">Me siento muy feliz con lo que hago</b><br><b style="color:#fff;font-size: 25px;">'.$info["enelclimalaboral"].'</b> </center></td>
							  <td  style="width: 120px;"></td>
							  <td style="width: 120px;background-color:#A6A6A6;    padding: 3px;"><center><b style="color:#fff;font-size: 25px;" >CareBiz</b><br><b style="color:#fff;font-size: 12px;">Me comprometo con la organización</b><br><b style="color:#fff;font-size: 25px;">'.$info["conmivida"].'</b> </center></td>
						  </tr>
						  
						   <tr style="height: 5px;">
							  <td colspan="3"> </td>
 						  </tr>
						  </table></center>';
					if($this->gethtml==false){	 
						 $html.='<br>
						 <center> 
						 <div style="width:100%;padding:10px">
						 <table>
						   <tr  >
							<td colspan="3" style="    text-align: justify;"> <b style="font-size:16px">'; 
							
							if($info["resultado"]!="feliz"){
							//$html.='Felicitaciones!, tus niveles de bienestar se encuentran óptimos en este momento. Sin embargo, chequear algunos aspectos te ayudará a construir un plan de acción para incrementar tus niveles de felicidad. Somos seres sociales y un mejor relacionamiento te va a favorecer.';
							
$html.='Tus niveles de optimismo requieren de un mayor entrenamiento. No obstante, es positivo conocerlo y hacerlo consciente porque te abre la oportunidad de  aprender a descubrir cuáles son tus mayores fortalezas y cómo podrías aplicarlas en los cuatros aspectos que acabas de medir. Buscarle un significado a lo que haces, va a ayudarte mucho a incrementar esos niveles de Felicidad. 
 		Empieza hoy mismo a construir hábitos positivos que te permitan encontrar aprendizajes!. Entretanto, te damos un par de tips para que empieces ya mismo a gestionar tu felicidad: 
<ul><li>Haz un listado de todas las habilidades que tu consideras fuertes en ti y aplícalas en cada uno de los cuadrantes en que tienes bajos niveles.
</li><li>Socializa este test con al menos 5 personas y recibe el feedback.
</li><li>Dale una mirada a esta conferencia: <a href="https://youtu.be/HPhqZ9JBOlU">https://youtu.be/HPhqZ9JBOlU</a>
</li><li>Más tips en www.pilife.co</li></ul>';
							
							
							}else if($info["resultado"]=="feliz"){
							//$html.='La buena noticia es que gracias a la Psicología Positiva puedes entrenar tu felicidad.  Descubrir cuáles son tus mayores fortalezas y buscarle un significado a lo que haces, va a ayudarte mucho a incrementar tus niveles de felicidad. Empieza hoy mismo a construir hábitos positivos que te permitan encontrar aprendizajes.';
							
$html.='Buenísimo!, tus niveles de felicidad se encuentran óptimos en este momento. No obstante, vale la pena que le des una mirada a algunos aspectos en los que podrías potenciarte aún más. Las personas felices crean las mejores atmósferas positivas en los entornos en los que interactúan, por lo cual te recomendamos un par de tips:
<ul><li>Elige 5 personas para que les des las gracias personalmente o vía digital, por algo que hayas recibido de ellos. Conviértelo en un hábito.
</li><li>Durante 21 días elige una persona cada día y haz algo positivo por ellos. ( un abrazo, escucharlos, apoyarlos, etc. ).
</li><li>Dale una mirada a esta conferencia: <a href="https://youtu.be/HPhqZ9JBOlU">https://youtu.be/HPhqZ9JBOlU</a>
</li><li>Más tips en www.pilife.co</li></ul>';
							
							
							}
							  
						$html.='</b></td>
 						  </tr>
						  </table><div></center>
						';
					}
					if($this->gethtml==false){
						senEmail( $info,$html);
					}else{
						echo utf8_decode( $html);exit;
					}
  					
				}
			}
			if($this->gethtml==false){
 			$this->bdObj->sendTopentaho();
			}
 		}
 		
	}	