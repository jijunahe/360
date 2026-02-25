<?php
//Aqui las funciones creadas
//Creamos Funcion para Link Home

function removeAccents($str)
{
  $a = array('-','À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
  $b = array(' ','A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
  return str_replace($a, $b, $str);
}

function utf8encode($str){
	$a=array("á","é","í","ó","ú","Á","É","Í","Ó","Ú","Ñ","ñ","®");
	$b=array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&Ntilde;","&ntilde;","&reg;");
	
	return str_replace($a, $b, $str);

}
function utf8decode($str){
	$b=array("á","é","í","ó","ú","Á","É","Í","Ó","Ú","Ñ","ñ","®");
	$a=array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&Ntilde;","&ntilde;","&reg;");
	
	return str_replace($a, $b, $str);

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
?>