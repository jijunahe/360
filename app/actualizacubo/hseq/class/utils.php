<?php
//Aqui las funciones creadas
//Creamos Funcion para Link Home
 require_once(dirname(__FILE__).'/PHPMailer/class.phpmailer.php');

function removeAccents($str)
{
  $a = array('-','À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'Ð', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', '?', '?', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', '?', '?', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', '?', 'O', 'o', 'O', 'o', 'O', 'o', 'Œ', 'œ', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'Š', 'š', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Ÿ', 'Z', 'z', 'Z', 'z', 'Ž', 'ž', '?', 'ƒ', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', '?', '?', '?', '?', '?', '?');
  $b = array(' ','A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
  return str_replace($a, $b, $str);
}

function explode2($c,$s){
	$d=str_split($s);
	$keys="jijunahe";
	$ar=array();
	foreach($d as $k){
		printVar($k."=".$c); 
		if($k==$c){
			$k=$keys;
		}
		array_push($ar,$k);
	}
	
	$res=$s;
	if(count($ar)>1){
		$res=join("",$ar);
		$res=explode($keys,$s);
	}
	
	return $s; 
}

function Build($link='', $type = ''){
	//$base = (($type == 'http' || USE_SSL == 'no') ? 'http://' : 'https://') . getenv('SERVER_NAME');
	// Puerto definido por default
	if (defined('HTTP_SERVER_PORT') && HTTP_SERVER_PORT != '80' && strpos($base, 'https') === false){
		// Agrago al path el puerto
		//$base .= ':' . HTTP_SERVER_PORT;
	}
	//$link = $base . VIRTUAL_LOCATION . $link;
	
	// Devuelvo el link con Escape html
	return htmlspecialchars($link, ENT_QUOTES);
}
function GetDetalle($id){
	$dato=General::getTotalDatos(PREFIJO_TABLAS."Regalo","","id=".$id);
 	echo $dato[0]->descripcion;
 }
	
//Funcion Encargada de llamar la clase php del modelo y el file de la vista
function includeFile( $smarty ,$file ){
	
	if( file_exists( CONTENT_DIR . $file . '.php' ) && file_exists( TEMPLATE_DIR . $file . '.html' ) ){
		require_once CONTENT_DIR . $file . '.php';
					
		$className = str_replace(' ', '',ucfirst(str_replace('_', ' ',$file)));
		$objClass = new $className();
		
		if (method_exists($objClass, 'init')){
			$objClass->init();
		}

		$smarty->assign('obj', $objClass);
		
		$fileInclude = $smarty->fetch( TEMPLATE_DIR . $file . '.html' );
		return $fileInclude;
			
	}else{
		return false;
		//echo "Revisar Archivo.";
	}				
}	

function printVar( $variable, $title = "" ){
	$var = print_r( $variable, true );
	echo "<pre style='background-color:#dddd00; border: dashed thin #000000;'><strong>[$title]</strong> $var</pre>";
}

function Elmodulo($valor,$mod){

	return ($valor+1)%$mod;
}
//Limpia una cadena para su envio a DB
function cambiaParaEnvio( $cadena ){
	//$cadena = htmlentities($cadena,ENT_NOQUOTES,"ISO8859-1");
	$cadena = utf8_encode($cadena);
	return($cadena);
}

//Funcion que permite reemplazar caracteres especiales
function limpiar($nombreVariable){
	/*$limpieza = array(	
						"'" => "",
						'"' => "",
						"select" => "",
						"delete" => "",
						"update" => "",
						"=" => "",
						"*" => "",
						"`" => "",
						";" => "",
						"(" => "",
						")" => ""
				);
	$nombreVariable=strtolower($nombreVariable);
	$nombreVariable = strtr($nombreVariable, $limpieza);
	$nombreVariable =strtoupper($nombreVariable);*/
	return $nombreVariable;
}
function GetURL(){
   $getURLVar = str_replace("?","",strrchr($_SERVER['HTTP_REFERER'],"?"));
        $getURLVar = str_replace("&","=",$getURLVar);
        $getURLVar = str_getcsv($getURLVar,"=");
        $i=0;
        foreach ($getURLVar as $value)
          {
            if ($i % 2)
                $value1[$i]=$value;
            else
                $value2[$i]=$value;

            $i++;
          } 
        $getURLVar =array_combine($value2,$value1);


  return   $getURLVar;
}

function calcularedad($date){
	
	$dia=date(j);
	$mes=date(n);
	$ano=date(Y);

	//fecha de nacimiento
	list($a,$m,$d)=explode("-",$date);

	$dianaz=(int)$d;
	$mesnaz=(int)$m;
	$anonaz=(int)$a;

	//si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual

	if (($mesnaz == $mes) && ($dianaz > $dia)) {
	$ano=($ano-1); }

	//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual

	if ($mesnaz > $mes) {
	$ano=($ano-1);}

	//ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad

	$edad=($ano-$anonaz);

	return $edad;	
 }
 
 
function senEmail( $info,$html){
	 
	if($info["425936X35X1158"]!="NR"){
		$emailencuestador=$info["425936X35X1154"];
		$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
		$mail->Username   = "info@talentracking.com";  // GMAIL username
		$mail->Password   = "talentrack";            // GMAIL password
		$mail->AddAddress($info["425936X35X1158"],"Hseq");
		$mail->SetFrom('info@talentracking.com', 'Hseq');
		$mail->AddReplyTo('fgutierrez@talentracking.com', 'Hseq');
		$mail->AddCC($emailencuestador, 'Hseq');
		$mail->Subject =  utf8_encode("Basados en tus repuestas estos son tus resultados de tu riesgo cardiovascular");
		$html = htmlentities($html);
		$html = html_entity_decode($html);								
		$mail->MsgHTML(($html));
		$mail->Send();
	}	 
 	 
}
?>