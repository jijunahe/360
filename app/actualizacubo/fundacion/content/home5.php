<?php

 $documentroot=str_replace("actualizacubo/fundacion/index.php","",$_SERVER["SCRIPT_FILENAME"]);
 require_once($documentroot.'/application/extensions/PHPMailer/class.phpmailer.php'); 
//require_once($_SERVER["DOCUMENT_ROOT"]."/pdf/fpdf.php");

 
class Home{
 
 
public function analisis($key,$valor){
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
			
			case "828616X28X669"://PRESION ARTERIAL
 				$resultado="<p>La hipertensi&oacute;n arterial es una enfermedad silenciosa que no da s&iacute;ntomas. La vigilancia de su propia presi&oacute;n arterial es una buena manera de cuidarse y estar atento a las se&ntilde;ales de su cuerpo. Le sugerimos que consulte con su m&eacute;dico. La Cultura del Cuidado de Corazones Responsables es una opci&oacute;n para cuidar su coraz&oacute;n. Cuidar el coraz&oacute;n es cuidar la vida.</p>";
 			break;
			case "828616X28X670":// ¿Conoces tu nivel de l&iacute;pidos (Colesterol y Triglic&eacute;ridos)?
				if($valor=="Y" or $valor=="Si"){
					$resultado="<p>Conocer de manera peri&oacute;dica, al menos cada a&ntilde;o, su nivel de sus l&iacute;pidos es una buena manera de cuidarse y estar atento a las se&ntilde;ales de su cuerpo. La dislipidemia, que es el aumento de los niveles de colesterol y triglic&eacute;ridos, es una enfermedad silenciosa que no manifiesta s&iacute;ntomas La Cultura del Cuidado de Corazones Responsables es una opci&oacute;n para cuidar su coraz&oacute;n. Cuidar el coraz&oacute;n es cuidar la vida.</p>";
 				}
				if($valor=="N" or $valor=="No"){
					$resultado="<p>cuando el colesterol y triglic&eacute;ridos se suben se produce una enfermedad conocida como dislipidemia. Esta enfermedad es silenciosa porque no presenta s&iacute;ntomas y produce una  alteraci&oacute;n del metabolismo de esos l&iacute;pidos y su consecuencia es que se adhieren a las paredes de las arterias, dificultando el paso de la sangre o incluso tapon&aacute;ndolas que es cuando se produce un infarto en el coraz&oacute;n o en el cerebro.El examen de l&iacute;pidos debe hacerse al menos una vez al a&ntilde;o y debe consultar su m&eacute;dico si est&aacute;n elevados. La Cultura del Cuidado de Corazones Responsables es una opci&oacute;n para cuidar su coraz&oacute;n. Cuidar el coraz&oacute;n es cuidar la vida.</p>";
 				}
			break;
			case "828616X28X671":// ¿Conoces tu nivel de glicemia (medida de az&uacute;car en sangre)?
				if($valor=="Y" or $valor=="Si"){
					$resultado="<p>Muy bien!. Antes de desayunar los niveles normales de glucosa  est&aacute;n entre 60 y 99 mg/dL. Si es inferior hay una hipoglucemia. Cuando se encuentra entre los 100 y 125 mg/dL hay una alteraci&oacute;n que puede ser un indicativo de una prediabetes y cuando supera los 126 mg/dL es una hiperglucemia, generalmente un indicativo de un estado diab&eacute;tico. Es importante conocer los niveles de az&uacute;car en sangre o de glicemia al menos una vez cada seis meses y si los niveles son superiores o inferiores hay que acudir de inmediato al m&eacute;dico. La Cultura del Cuidado de Corazones Responsables es una opci&oacute;n para cuidar su coraz&oacute;n. Cuidar el coraz&oacute;n es cuidar la vida.</p>";
 				}
				if($valor=="N" or $valor=="No"){
					$resultado="<p>Es importante que usted conozca sus niveles de az&uacute;car en la sangre. Antes de desayunar los niveles normales de glucosa  est&aacute;n entre 60 y 99 mg/dL. Si es inferior hay una hipoglucemia. Cuando se encuentra entre los 100 y 125 mg/dL hay una alteraci&oacute;n que puede ser un indicativo de una prediabetes y cuando supera los 126 mg/dL es una hiperglucemia, generalmente un indicativo de un estado diab&eacute;tico. Es importante conocer los niveles de az&uacute;car en sangre o de glicemia al menos una vez cada seis meses y si los niveles son superiores o inferiores hay que acudir de inmediato al m&eacute;dico. La Cultura del Cuidado de Corazones Responsables es una opci&oacute;n para cuidar su coraz&oacute;n. Cuidar el coraz&oacute;n es cuidar la vida.</p>";
 				}
			break;
			case "828616X28X672":// ¿Tomas medicamentos para enfermedades cr&oacute;nicas no trasmisibles (Coraz&oacute;n, C&aacute;ncer, diabetes, enfermedades respiratorias)?
 				$resultado="<p>Las denominadas enfermedades cr&oacute;nicas no transmisibles (ENT), son en realidad enfermedades de los estilos de vida. Infortunadamente se transmiten por conducta y comportamiento, pr&aacute;cticamente nunca se curan y hay que controlarlas por eso se llaman cr&oacute;nicas y su evoluci&oacute;n es lenta y en ocasiones silenciosa.La enfermedad del coraz&oacute;n es el primer asesino del mundo. Es una epidemia de grandes proporciones producida por los estilos de vida de las personas en la mayor&iacute;a de los casos.Cuidarse con estilos de vida que promueven el bienestar y la felicidad es la clave, pero adem&aacute;s es vital que visite a su m&eacute;dico y le consulte las se&ntilde;ales que le entrega su cuerpo. La Cultura del Cuidado de Corazones Responsables es una opci&oacute;n para cuidar su coraz&oacute;n. Cuidar el coraz&oacute;n es cuidar la vida.</p>";
 				 
			break;
			case "828616X29X673":// ¿es fumador?
 				$resultado="<p>Fumar es la primera causa de enfermedad, discapacidad y muerte evitable de la poblaci&oacute;n colombiana. </p>";
 				$resultado.="<p>El humo del cigarrillo ataca la salud del coraz&oacute;n, por esto, desde la perspectiva de Corazones Responsables, al promover de espacios libres de humo de cigarrillo, se parte de la premisa de buscar nuevos escenarios libres de humo de cigarrillo para proteger a quienes no fuman y de ninguna manera para estigmatizar, perseguir o segregar a los fumadores, respetando su decisi&oacute;n sobre fumar o no fumar y garantizando a unos y a otros, ambientes en los que puedan respirar con tranquilidad.</p>";
 				$resultado.="<p>Quienes fuman tienen un riesgo importante de padecer enfermedades, de morir prematuramente o de tener una p&eacute;sima calidad de vida en la vejez. Este riesgo es mayor cuanto m&aacute;s tabaco se consume diariamente y cuanto m&aacute;s tiempo se fuma. No obstante, y esto es muy importante, al abandonar el consumo de tabaco este riesgo se va reduciendo a medida que el tiempo pasa. Por ejemplo, el riesgo de enfermedad coronaria (infarto, angina de pecho), se normaliza al cabo de 10 a&ntilde;os de dejar de fumar.  La Cultura del Cuidado de Corazones Responsables es una opci&oacute;n para promover la cultura de los espacios libres de humo.</p>";
 			break;
			case "828616X29X676":// ¿Has participado en alguna organizaci&oacute;n, entidad o similar que te  apoye en el proceso de dejar de fumar?
 				$resultado="<p>Las empresas que promueven los espacios libres de humo  y programas de cesaci&oacute;n del h&aacute;bito del tabaquismo demuestran su compromiso con el cuidado de sus trabajadores y asumen la responsabilidad de promover escenarios saludables, donde las elecciones saludables sean posibles</p>";
 				$resultado.="<p>La Cultura del Cuidado de Corazones Responsables es una opci&oacute;n para promover la cultura de los espacios libres de humo.</p>";
  			break;
			case "828616X29X679":// ¿Alguna vez fuiste fumador?
 				$resultado="<p>Es un gran logro. Felicitaciones. El tabaquismo es una enfermedad adictiva cr&oacute;nica, curable con tratamiento adecuado y potencialmente mortal sin &eacute;l. Aunque se suele pensar que fumar depende de una decisi&oacute;n individual y tener voluntad de hacerlo, en realidad es una adicci&oacute;n porque la nicotina produce dependencia f&iacute;sica y psicol&oacute;gica en el organismo y se genera en el fumador un consumo compulsivo y adem&aacute;s de efectos psicoactivos. El fumador es un enfermo y un adicto, que requiere asistencia y atenci&oacute;n para lograr superar esta situaci&oacute;n de enfermedad.La Cultura del Cuidado de Corazones Responsables es una opci&oacute;n para promover la cultura de los espacios libres de humo.</p>";
   			break;
			case "828616X29X725"://¿Vives o trabajas en un lugar donde otros fuman y ese humo te afecta o lo tienes cerca?
 				$resultado="<p>Se considera fumador pasivo a la persona que sin fumar, inhala aire contaminado por el humo de tabaco, tambi&eacute;n se conoce como humo de segunda mano. Cuando una persona est&aacute; cerca de alguien que fuma, respira humo de segunda mano. Cada a&ntilde;o, seg&uacute;n la Organizaci&oacute;n Mundial de Salud, mueren 600 mil personas la exposici&oacute;n involuntaria al aire contaminado por humo de tabaco. Se considera que el tabaquismo pasivo es la tercera causa de muerte evitable en pa&iacute;ses desarrollados, despu&eacute;s del tabaquismo activo y el alcoholismo.</p>";
				$resultado.="<p>El humo de segunda mano es peligroso para cualquiera que lo respire. Ninguna cantidad de humo de segunda mano es inocua.</p>";
				$resultado.="<p>La Cultura del Cuidado de Corazones Responsables es una opci&oacute;n para promover la cultura de los espacios libres de humo.</p>";
 			break;
			case "828616X30X682"://¿Practicas alguna actividad f&iacute;sica? (caminar, correr, un deporte con amigos)
				if($valor=='Y' or $valor=="Si"){
					$resultado="<p>Felicidades. Las personas activas son m&aacute;s felices. Moverse genera alegr&iacute;a y bienestar. Si te mueves tu coraz&oacute;n se mueve. La Cultura del Cuidado de Corazones Responsables es una opci&oacute;n para promover la cultura del movimiento.</p>";
 				}
			
				if($valor=='N' or $valor=="No"){
					$resultado="<p>La actividad f&iacute;sica, que se convierte en medicina para el coraz&oacute;n, no es nada extremo. Se trata de moverse para contar con los tiempos m&iacute;nimos de movilidad acumulada al d&iacute;a, que se trasforman en factor protector para el coraz&oacute;n y pueda una persona convertirse en un Coraz&oacute;n Responsable. </p>";
					$resultado.="<p>Moverse, para incentivar la actividad f&iacute;sica, no es necesariamente hacer ejercicio o realizar alguna pr&aacute;ctica deportiva. Es esencial para nuestro coraz&oacute;n estar en movimiento y mucho mejor si hacemos ejercicio y practicamos alg&uacute;n deporte, pero la actividad f&iacute;sica como factor protector est&aacute; referida fundamentalmente a moverse diariamente y puede ser inclusive solo caminar todos los d&iacute;as.</p>";
					$resultado.="<p>Las conductas sedentarias enferman el coraz&oacute;n. Quienes se mueven poco generalmente comen mucho y eso crea un desequilibrio que se traducen en un coraz&oacute;n enfermo. </p>";
  				}
			
			break;
			case "828616X30X687"://¿Cuantas veces por semana realizas actividad f&iacute;sica?
				$resultado="<p>La OMS recomienda que:</p>";
				$resultado.="<p>Los ni&ntilde;os y j&oacute;venes de 5 a 17 a&ntilde;os inviertan como m&iacute;nimo 60 minutos diarios en actividades f&iacute;sicas de intensidad moderada a vigorosa.</p>";
				$resultado.="<p>Los adultos deben invertir al menos 30 minutos al d&iacute;a.</p>";
				$resultado.="<p>La actividad f&iacute;sica diaria deber&iacute;a ser, en su mayor parte, aer&oacute;bica. Convendr&iacute;a incorporar, como m&iacute;nimo tres veces por semana, actividades vigorosas que refuercen, en particular, los m&uacute;sculos y huesos.</p>";
				$resultado.="<p>Si desea tener menor informaci&oacute;n puede seguir este link Recomendamos seguir el link: <a href='http://www.who.int/dietphysicalactivity/factsheet_recommendations/es/'>http://www.who.int/dietphysicalactivity/factsheet_recommendations/es/</a> o este link <a href='http://corazonesresponsables.org/la-cultura-del-movimiento/'>http://corazonesresponsables.org/la-cultura-del-movimiento/</a> </p>";
				$resultado.="<p></p>";
			break;
			
			case "828616X31X690":
 				$resultado="<p>Para la Fundaci&oacute;n Colombiana del Coraz&oacute;n la alimentaci&oacute;n saludable es una de las claves para la buena salud del coraz&oacute;n. Una alimentaci&oacute;n variada y equilibrada, entendida como placentera, como un gusto, nunca como una medicina. Por esa raz&oacute;n la recomendaci&oacute;n para ser Corazones Responsables es aprender a alimentarse sin dietas restrictivas y sin prohibiciones, porque no existen comidas malas en s&iacute; mismas, sino h&aacute;bitos inadecuados, desequilibrios y excesos.</p>";
				$resultado.="<p>Para Corazones Responsables es de vital importancia que la alimentaci&oacute;n tenga equilibrio y balance y sus recomendaciones est&aacute;n referidas fundamentalmente a aumentar 2 elementos y bajar 3 en la alimentaci&oacute;n diaria: Aumentar la fibra y el consumo de frutas y verduras a m&iacute;nimo 5 porciones al d&iacute;a y moderar el consumo de sal y sodio, grasas y az&uacute;car. </p>";
				$resultado.="<p>Se trata por tanto de:</p><br>";
				$resultado.="<ul>";
				$resultado.="<li>Aumentar el consumo de frutas enteras, verduras frescas y cereales no procesados. 
				</li><li>Reducir el consumo de alimentos muy energ&eacute;ticos, como son los carbohidratos procesados, es decir los bizcochos y los panes de harinas refinadas y preferir los panes de grano entero o de harina integral. 
				</li><li>Moderar el consumo de grasas de origen animal como las carnes rojas, el pollo y los l&aacute;cteos. 
				</li><li>Disminuir el consumo de az&uacute;car y dulces. 
				</li><li>Bajar el consumo de sal y sodio, en particular la sal de mesa adicionada despu&eacute;s de la cocci&oacute;n. 
				</li><li>La invitaci&oacute;n concreta de Corazones Responsables es que no haga dietas restrictivas, sino que adquiera informaci&oacute;n y conocimientos para hacer de la alimentaci&oacute;n saludable un h&aacute;bito junto con un estilo de vida saludable que pueda cultivar en usted y en los ni&ntilde;os que le rodean.</li>";
				$resultado.="</ul>";	
			break;
			case "inicio":
				$resultado="<hr size='3' width='100%' align='center'>Cordial saludo. <br><br>Gracias por responder la encuesta para corazones responsables.<br>De acuerdo con tus respuestas hemos llegado a las siguientes conclusiones:<br>";
			
				$resultado.="<hr size='3' width='100%' align='center'>";
				$resultado.='<p class="MsoNormal"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;color:#1f4e79">Este informe ha sido elaborado por Talentracking®. Teléfono: (57) (1)795 4798 (57) 313 831 5284 - <a href="mailto:info@talentracking.com" target="_blank">info@talentracking.com</a> - Bogotá, Colombia. <u></u><u></u></span></p>';
				$resultado.='<p class="MsoNormal"><span lang="EN-US" style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;color:#1f4e79">Talentracking® is a Salesforce® ISV Partner.</span><span lang="EN-US"><u></u><u></u></span></p>';
			break;
 			case "final":
				$resultado="Hazte voluntario de Corazones Responsable y empieza a ser ejemplo.";
				$resultado.="<center><img src='http://talentracking.com/hseq/images/imagenfcc.jpg' /><br>Hazte voluntario y vive el ejemplo de la cultura del cuidado.<a href='http://corazonesresponsables.org/voluntarios/'> http://corazonesresponsables.org/voluntarios/</a></center>";
			break;
			
			
 		}
		return $resultado;
		
	}
  
 
 	public function init(){
		//printVar($_REQUES["set"]);
		//DB_DataObject::debugLevel(1);
	 		if(isset($_GET["limit"])){
			if($_GET["limit"]==0){General::borrarTabla2("828616");}
 	 	}
 
		//General::borrarTabla();
		$serverdb_link = '162.243.250.47';
		$username_link = 'apps';
		$password_link = 'j1jun4h3';
		$database_link = 'climasas';
		try {
			$conn = new PDO("mysql:host=".$serverdb_link.";dbname=".$database_link,$username_link,$password_link);
			// set the PDO error mode to exception
			
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 		
		}
		catch(PDOException $e)
		{
		echo $sql . "<br>" . $e->getMessage();
		}		
			
	 
 		
		

		$FLAGS=array(
						"not_null primary_key auto_increment"=>"NOT NULL AUTO_INCREMENT",
						"binary"=>"",
						"not_null"=>"NOT NULL",
						"blob"=>"",
  					);


					
		$presguntas=array();			
		
		$surveys=General::getTotalDatos(PREFIJO_TABLAS."Surveys",""," sid=828616");

 		$totalReg=count($surveys);
		$set=new General();
		$setLASTID=new General();
		$estadoEncuesta=array();
		 
		if($totalReg>0){
 
			//CREAR TABLAS
			
			
 			$contarNuevastablas=0;
			
 		//	for($i=0;$i<$totalReg;$i++){
			$i=0;
				//VALIDAR SI EXISte tABLA
				$sqlr = "SELECT COUNT(*) AS count FROM information_schema.tables  WHERE table_schema = 'climasas' AND table_name =:Nombre;";
				
				$sql = $conn->prepare($sqlr );

				$sql->execute(array('Nombre' => "lime_cubo_".$surveys[$i]->sid));

				$resultado = $sql->fetchAll();
 			
				if($resultado[0]['count']==0){	
					
					$describe=General::describeTabla(PREFIJO_TABLAS."Survey".$surveys[$i]->sid);
					//DB_DataObject::debugLevel(1);		
					$camposTabla="";
					$contador=0;
 					foreach($describe as $key=>$datos){
						$key=str_replace("_4","4", $key);
						$key=str_replace("_id","id", $key);
						$key=str_replace("_token","token", $key);
						$key=str_replace("_submitdate","submitdate", $key);
						$key=str_replace("_lastpage","lastpage", $key);
						$key=str_replace("_startlanguage","startlanguage", $key);
						$key=str_replace("_startdate","startdate", $key);
						$key=str_replace("_datestamp","datestamp", $key);
						$key=str_replace("_ipaddr","ipaddr", $key);
						$key=str_replace("_refurl","refurl", $key);
						if($key!="_DB_DataObject_version" and $key!="N" and $key!="_database_dsn" and $key!="_database_dsn_md5" and
						$key!="_database" and 
						$key!="_query" and 
						$key!="_DB_resultid" and 
						$key!="_resultFields" and 
						$key!="_link_loaded" and 
						$key!="_join" and 
						$key!="__table" and 
						$key!="_lastError" ){
							$type="varchar";
							$flags="DEFAULT NULL";
							$len=50;
							if($key=="id"){
								$type="int";
								$flags="NOT NULL AUTO_INCREMENT";
								$len=12;
							}
						
							if($key=="submitdate"){
								$type="datetime";
								$flags="";
								$len="";
							}
							if($key=="431454X14X636"){
								$type="int";
								$flags="NOT NULL";
								$len=12;
							}
						
							$TABLADESCRIBE[$contador]=(object)array("name"=>$key,"type"=>$type,"flags"=>$flags,"len"=>$len);
							$contador++;
						}
					}
	 
					// printVar($TABLADESCRIBE);exit;
					  
					 $TABLADESCRIBE=$describe->_lastError->backtrace[2][object]->_definitions[PREFIJO_TABLAS."_survey_".$surveys[$i]->sid];
 					$TOTALES=count($TABLADESCRIBE);
					
					if($TABLADESCRIBE[0]->name=="id"){
						for($ii=0;$ii<$TOTALES;$ii++){
							//foreach($TABLADESCRIBE[$ii] as $key => $value){
							$temp=explode("_",$TABLADESCRIBE[$ii]->name); 
							if(isset($temp[1])){
								$TABLADESCRIBE[$ii]->name=$temp[1];
							}
							
							
								$resultado = strpos($TABLADESCRIBE[$ii]->name,$surveys[$i]->sid);
								 
								if($resultado==0 ){
									$datosOpciones=explode("X",$TABLADESCRIBE[$ii]->name); 
									$IDENC=$datosOpciones[0];
									$IDGRUPO=$datosOpciones[1];
									$IDPREGUNTA=$datosOpciones[2];
 									$SurveyPregunta=General::getTotalDatos(PREFIJO_TABLAS."Questions",array("question")," sid=".$surveys[$i]->sid." and gid=".$IDGRUPO." and qid=".$IDPREGUNTA); 
									
									
									if($SurveyPregunta[0]->question!=""){
										$columna=General::sanear_string(strtolower (utf8_encode($SurveyPregunta[0]->question)));
										$columna=General::sanear_string(strtolower (utf8_encode($columna)));
										$columna=General::sanear_string(strtolower (utf8_decode($columna)));
										
										
										 
										$len=" ";
										if($TABLADESCRIBE[$ii]->len>0){
											$len="(".$TABLADESCRIBE[$ii]->len.")";
											
										}
										if($TABLADESCRIBE[$ii]->type=="string"){
										
											$TABLADESCRIBE[$ii]->type="varchar";
											$len="(100)";
										
										}
										if($TABLADESCRIBE[$ii]->type=="blob"){
										
											$TABLADESCRIBE[$ii]->type="text";
											$len="";
										
										}
										$flags="";
										if($TABLADESCRIBE[$ii]->flags!=""){
											$flags=" ".$FLAGS[$TABLADESCRIBE[$ii]->flags];
										
										}	
										$flags="";
										if($TABLADESCRIBE[$ii]->type=="real"){
											$TABLADESCRIBE[$ii]->type="int";
											$len="(12)";
										
										}	
										//$camposTabla.=substr($columna, 0, 30)." ".$TABLADESCRIBE[$ii]->type.$len.$flags.",\n";
										
										$camposTabla.="`".$TABLADESCRIBE[$ii]->name."` ".$TABLADESCRIBE[$ii]->type.$len.$flags.",";
 								//		printVar($SurveyPregunta[0]->question,$TABLADESCRIBE[$ii]->name);
										
									}else{
										$len=" ";
										if($TABLADESCRIBE[$ii]->len>0){
											$len="(".$TABLADESCRIBE[$ii]->len.") ";
											
										}
 										$camposTabla.=$TABLADESCRIBE[$ii]->name." ".$TABLADESCRIBE[$ii]->type.$len.$TABLADESCRIBE[$ii]->flags.",";
 									
									}
								
								}
 								 
							//}
						}
					}
					
					
					$camposTabla.="fecharegistro varchar(10),";
					$camposTabla.="rangoedad varchar(50),";
					$camposTabla.="indice varchar(10),";
					$camposTabla.="estadoCorporal varchar(100),";
					$camposTabla.="encuesta varchar(200),";
					$camposTabla.="idEncuesta varchar(20),";
					$camposTabla.="idAnswer int(12),";
					$camposTabla.="idtoken int(12),";
					$camposTabla.="referencia int(12),";
					$camposTabla.="PRIMARY KEY (`id`)";
 
					$sql = "DROP TABLE IF EXISTS lime_cubo_".$surveys[$i]->sid.";CREATE TABLE lime_cubo_".$surveys[$i]->sid." (".$camposTabla.") ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;";
					// use exec() because no results are returned
					//printVar($sql);exit;
					$conn->exec($sql);
				}	
				
		//	}	
			//SI HAY NUEVAS TABLAS, SE GENERAN MODELOS
			if($contarNuevastablas>0){	
				regenerateDataObject();	//GENERA MODELOS			
			}	
			/* printVar($describe->_lastError->backtrace[2][object]->_definitions[PREFIJO_TABLAS."_survey_".$surveys[$i]->sid]);			
				exit;	*/	
				//printVar($surveys[0]->sid);
			//for($i=0;$i<$totalReg;$i++){
			$i=0;
				//$LASTID=General::getTotalDatos(PREFIJO_TABLAS."Lastid",array("MAX(id) AS ID","lastID")," sid=".$surveys[$i]->sid);
				$LASTID=0;
				if(isset($_POST["id"])){
					$LASTID=(int)$_POST["id"];
				}
				if(isset($_GET["id"])){
					$LASTID=(int)$_GET["id"];
				}
				$NOMBREENCUESTA=General::getTotalDatos(PREFIJO_TABLAS."SurveysLanguagesettings",array("surveyls_title"),"surveyls_survey_id=".$surveys[$i]->sid); 
				  
				 //printVar($NOMBREENCUESTA);exit; 
				$QUERY="";
			//$LASTID[0]->lastID=1;
			
				if($LASTID>0){
				
					$QUERY=" id=".$LASTID;
				
				}			
				if($QUERY!=""){
					$QUERY.=" and submitdate is not NULL";
 				}else{
					$QUERY="submitdate is not NULL";
				}
			    if(!isset($_GET["limit"])){
					$DatosEncuesta=General::getTotalDatos(PREFIJO_TABLAS."Survey".$surveys[$i]->sid,"",$QUERY);
				}else{
					$DatosEncuesta=General::getTotalDatos(PREFIJO_TABLAS."Survey".$surveys[$i]->sid,"","submitdate is not NULL","",(int)$_GET["limit"],(int)$_GET["limita"]);
				}
				//$DatosEncuesta=General::getTotalDatos(PREFIJO_TABLAS."Survey".$surveys[$i]->sid);
				$totalesEncuesta=count($DatosEncuesta);
  				
 				if(($DatosEncuesta[0]->id>0 and $totalesEncuesta>0)  ){
				
 				
					$campos=General::getCampos(PREFIJO_TABLAS."Survey".$surveys[$i]->sid);
				
					for($j=0;$j<$totalesEncuesta;$j++){
						$test=General::getTotalDatos(PREFIJO_TABLAS."Cubo".$surveys[$i]->sid,array("idAnswer")," idAnswer=".$DatosEncuesta[$j]->id);
				 

						if(($DatosEncuesta[$j]->submitdate!="" and  !isset($test[0]->idAnswer)) or isset($_GET["email"])){
					
							foreach($campos as $key => $value){
							
							 //	printVar($key,"key");
								// printVar($value,"value");
							
									$resultado = strpos($key,$surveys[$i]->sid);
																				
									 
									if($resultado!==FALSE){
										$datosOpciones=explode("X",$key);
										$IDENC=$datosOpciones[0];
										$IDGRUPO=$datosOpciones[1];
										$IDPREGUNTA=$datosOpciones[2];	
										 
										 
										//$nombreGrupo=General::getTotalDatos(PREFIJO_TABLAS."Groups",array("group_name")," sid=".$surveys[$i]->sid." and gid=".$IDGRUPO);
										 
										// if($nombreGrupo[0]->group_name=="DATOS DEMOGRAFICOS"){
										//	$respuesta=General::getTotalDatos(PREFIJO_TABLAS."Answers",array("answer")," qid=".$IDPREGUNTA." and code='". $DatosEncuesta[$j]->$key."'");
										//	$set->$key =$respuesta[0]->answer;
										 
										// }else{
											$respuesta=General::getTotalDatos(PREFIJO_TABLAS."Answers",array("answer")," qid=".$IDPREGUNTA." and code='". $DatosEncuesta[$j]->$key."'");
 										if(!isset($respuesta[0]->answer)){
											$respuesta[0]->answer=0;
										}
										 
										if($respuesta[0]->answer!=""){
 											$varfin=removeAccents(utf8_encode($respuesta[0]->answer));
											if(empty($varfin) or $varfin=="" or is_null($varfin)){
												$varfin="No responde";
											}										
 											$set->$key =$varfin;
												 
 										}else{
 												 
												
												if($key=="828616X27X666"  or $key=="828616X27X659"){
													$test=(int)$DatosEncuesta[$j]->$key;
													 
													$DatosEncuesta[$j]->$key=number_format($test,0);
												}
												
												$varfin=trim(removeAccents(utf8_encode($DatosEncuesta[$j]->$key))," "); 
												if(empty($varfin) or $varfin=="" or is_null($varfin)){
 													$varfin="No responde";
												}
												if($key=="828616X27X658"){
 													$DatosEncuesta[$j]->$key=(int)$DatosEncuesta[$j]->$key;
													$varfin=(int)$DatosEncuesta[$j]->$key;
												}
												
												if($key=="828616X27X664"){
													list($a,$m)=explode(" ",$DatosEncuesta[$j]->$key);
 													$DatosEncuesta[$j]->$key=$a;
													$varfin=$DatosEncuesta[$j]->$key;
												}
												
												
 												$set->$key =$varfin; 
											}
											
										//}	 
									}else{
										$varfin=trim(removeAccents(utf8_encode($DatosEncuesta[$j]->$key))," ");
										if(empty($varfin) or $varfin=="" or is_null($varfin)){
											$varfin="No responde";
										}									
 										$set->$key =$varfin;
 									}
							}
 						 
							$indice=number_format($set->{"828616X27X666"}/(($set->{"828616X27X658"}/100)*($set->{"828616X27X658"}/100)),2);
							
							$set->indice=$indice;
							 
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
								$estado="OBESIDAD MÓRBIDA";
								
								}
							$estado=strtoupper($estado);	
							$rango="";	
							if((int)$set->{"828616X27X659"}>=18 and  (int)$set->{"828616X27X659"}<30 ){
								 $rango="18 y 30";
							}							
								
							if((int)$set->{"828616X27X659"}>=30 and  (int)$set->{"828616X27X659"}<40 ){
								 $rango="31 y 40";
							}							
								
							if((int)$set->{"828616X27X659"}>=40 and  (int)$set->{"828616X27X659"}<50 ){
								 $rango="41 y 50";
							}							
								
							if((int)$set->{"828616X27X659"}>=50 and  (int)$set->{"828616X27X659"}<60 ){
								 $rango="51 y 60";
							}							
								
							if((int)$set->{"828616X27X659"}>60 ){
								 $rango="mayor a 61";
							}							
								
								

							$set->estadoCorporal=$estado;
							
							
							
 							
							//printVar($set," SET ");
							//printVar($DatosEncuesta[$j]->id,"IDANSWERW");
							$set->rangoedad=$rango;
							$set->submitdate=$DatosEncuesta[$j]->submitdate;
							$exfecha=explode(" ",$DatosEncuesta[$j]->submitdate);
							$set->fecharegistro=str_replace("-","",$exfecha[0]);
							$set->idAnswer=$DatosEncuesta[$j]->id;
							$set->idEncuesta=$surveys[$i]->sid;
							$set->referencia=(int)$set->{"828616X27X743"};
							$set->idtoken=(int)$set->{"828616X27X1462"};
							$set->encuesta=$NOMBREENCUESTA[0]->surveyls_title;
							
							$valida=array("refurl","fecharegistro","828616X29X676","828616X29X725","828616X30X684","828616X30X685","828616X30X686","828616X31X691","828616X31X692","828616X29X680","828616X31X694","828616X29X678","idAnswer","idEncuesta","ipaddr","token","referencia","828616X29X676","828616X29X725","828616X30X684","828616X30X687","828616X31X691","828616X31X692","828616X31X694","828616X27X743","lastpage","startlanguage","startdate","datestamp","encuesta","rangoedad","ipaddr","idEncuesta","encuesta");
							$html=$this->analisis("inicio","Y")."<br><table>";
  							 
 							foreach($set as $key=>$value){
								if( !in_array($key,$valida)){
									if($value!="No responde"){
										$datosOpciones=explode("X",$key); 
										$IDENC=$datosOpciones[0];
										$IDGRUPO=$datosOpciones[1];
										$IDPREGUNTA=$datosOpciones[2];
										$SurveyPregunta=General::getTotalDatos(PREFIJO_TABLAS."Questions",array("question")," sid=".$surveys[$i]->sid." and gid=".$IDGRUPO." and qid=".$IDPREGUNTA); 
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
 										if($key=="828616X28X669"){
											$value=$value."<br>".$this->analisis("828616X28X669",$value);
										}
 										if($key=="828616X28X670"){
											$value=$value."<br>".$this->analisis("828616X28X670",$value);
										}
 										if($key=="828616X28X671"){
											$value=$value."<br>".$this->analisis("828616X28X671",$value);
										}
 										if($key=="828616X28X672"){
											$value=$value."<br>".$this->analisis("828616X28X672",$value);
										}
 										if($key=="828616X29X673"){
											$value=$value."<br>".$this->analisis("828616X29X673",$value);
										}
 										if($key=="828616X29X679" and $value=="Si" and $set->{"828616X29X673"}=="N"){
											$value=$value."<br>".$this->analisis("828616X29X679","Y");
										}
 										if($key=="828616X29X676"){
											$value=$value."<br>".$this->analisis("828616X29X676",$value);
										}
 										if($key=="828616X29X725"){
											$value=$value."<br>".$this->analisis("828616X29X725",$value);
										}
 										if($key=="828616X30X682"){
											$value=$value."<br>".$this->analisis("828616X30X682",$value);
										}
 										if($key=="828616X30X687"){
											$value=$value."<br>".$this->analisis("828616X30X687",$value);
										}
 										if($key=="828616X31X690"){
											$value=$value."<br>".$this->analisis("828616X31X690",$value);
										}
 										if($SurveyPregunta[0]->question!=""){
											$key=$SurveyPregunta[0]->question;
										}
 										if($key=="estadoCorporal"){
											$key="Estado corporal";
											$value=$value."<br>".$this->analisis("estadoCorporal",utf8encode($value));
										}
										if($key=="indice"){
											$key="Indice de masa corporal";
											$value="<li>Su &iacute;ndice de masa corporal (relaci&oacute;n peso-talla), lo ubica en ".$value;
										}
 										if($key=="idAnswer"){
											$key="C&oacute;digo de Registro";
										}
 										if($key=="submitdate"){
											$key="Fecha y hora de Registro";
										}
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
							$html.="</table>";
 							 $htmlfinal=$html;
							if($set->{"828616X27X743"}=="normal"){
								$htmlfinal=$html."<br>".$this->analisis("final","Y");
							}
							$email=$set->{"828616X27X731"};
					
							if(!isset($_GET["email"])){
								$resID=$set->setInstancia(PREFIJO_TABLAS."Cubo".$surveys[$i]->sid);
								}else{
								printVar("Envio email a ".$email);
							}					
					
							$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
							$mail->IsSMTP(); // telling the class to use SMTP
							$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
							$mail->SMTPAuth   = true;                  // enable SMTP authentication
							$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
							$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
							$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
							$mail->Username   = "info@talentracking.com";  // GMAIL username
							$mail->Password   = "talentracki";            // GMAIL password
							$mail->AddAddress($email,  iconv("UTF-8", "Windows-1252",  'Fundación Colombiana del Corazón'));
							$mail->SetFrom('info@talentracking.com',iconv("UTF-8", "Windows-1252",  'Fundación Colombiana del Corazón'));
							$mail->AddReplyTo('fgutierrez@talentracking.com',iconv("UTF-8", "Windows-1252",  'Fundación Colombiana del Corazón'));
							$mail->Subject =  ("Estos son tus resultados de la encuesta Corazones Saludables");
							$mail->MsgHTML(utf8encode($htmlfinal));
							$mail->Send();										
 							
							ini_set('default_charset','utf8');
  							$estadoEncuesta[$j]=$surveys[$i]->sid." Se gragrego";
						}
					}
					 				
 				}else{
				
					$estadoEncuesta[$i]=$surveys[$i]->sid." No se agregaron registros";
					
				}
			
			//}
 			unset($set);
			unset($setLASTID);
			//printVar($presguntas," PREGUNTAS");
			
			shell_exec ('curl -d "mode=add" http://'.$_SERVER["HTTP_HOST"].'/pentaho/');
 
			 			
			
			
			
			
 		}else{
			echo "No hay Registros para agregar";
		
		}	
			
		
		
  	}
}
?>