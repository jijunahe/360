<?php
//Aqui las funciones creadas
//Creamos Funcion para Link Home
function Build($link='', $type = ''){
	$base = (($type == 'http' || USE_SSL == 'no') ? 'http://' : 'https://') . getenv('SERVER_NAME');
	// Puerto definido por default
	if (defined('HTTP_SERVER_PORT') && HTTP_SERVER_PORT != '80' && strpos($base, 'https') === false){
		// Agrago al path el puerto
		$base .= ':' . HTTP_SERVER_PORT;
	}
	$link = $base . VIRTUAL_LOCATION . $link;
	
	// Devuelvo el link con Escape html
	return htmlspecialchars($link, ENT_QUOTES);
}

//CAMBIO DE LINK PARA LAS SECCIONES PRICIPALES
function Seccion($seccion, $modo='listado', $item=0, $page=1, $search=''){
	$link = 'index.php?seccion='.$seccion;
	if($modo!=''){
		$link .= '&modo='.$modo;
	}
	if($item>0){
		$link .= '&item='.$item;
	}
	if($search!=''){
		$link .= '&search='.$search;
	}
	if($page>1){
		$link .= '&page='.$page;
	}
	return $link;
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
		echo "Revisar Archivo.";
		return false;		
	}				
}	

function printVar( $variable, $title = "" ){
	$var = print_r( $variable, true );
	echo "<pre style='background-color:#dddd00; border: dashed thin #000000;'><strong>[$title]</strong> $var</pre>";
}

// Limpia las variables para no permitir sql injection
function StripHtml($cadena){
	 // quita tags tipo html
	 $cadena=	strip_tags($cadena); 
	
	 $cadena=str_replace("from", "",$cadena);
	 $cadena=str_replace("database", "",$cadena);
	 $cadena=str_replace("select", "",$cadena);
	 $cadena=str_replace("delete", "",$cadena);
	 $cadena=str_replace("update", "",$cadena);
	 $cadena=str_replace("table", "",$cadena);
	 
	 $cadena=str_replace("php", "",$cadena);
	 $cadena=str_replace("PHP", "",$cadena);
	 $cadena=str_replace("cookies", "",$cadena);
	 $cadena=str_replace("COOKIES", "",$cadena);
	 $cadena=str_replace("HTTP", "",$cadena);
	 $cadena=str_replace("HTTPS", "",$cadena);
	 
	 return $cadena;
}

//Limpia una cadena para su envio a DB
function cambiaParaEnvio( $cadena ){
	//$cadena = htmlentities($cadena,ENT_NOQUOTES,"ISO8859-1");
	$cadena = utf8_encode($cadena);
	return($cadena);
}

//Funcion Para manejo de Paginacion
function pagination( $mPage, $mCantidad, $totalPag, $textSearch="" ){
	$PrimerValor = 5; //Total de Paginas a Mostrar
	$SegundoValor = 2;  //Paginas en cada lado de la pagina donde nos encontramos
	$TercerValor = 3; //Posiciones central del total de las paginas a mostrar
	$paginas = ceil($totalPag/$mCantidad); //total de paginas
	
	if( $paginas>$PrimerValor ) {
		$current_page = ($mPage);
		if( $mPage==1 ) {
			$first_page = 1;
			$last_page=$PrimerValor;
		}elseif( $current_page >= $TercerValor && $current_page <= ($paginas-$SegundoValor) ) {
			$first_page = $current_page-$SegundoValor;
			$last_page = $current_page+$SegundoValor;
		}elseif( $current_page<$TercerValor ) {
			$first_page = 1;
			$last_page = $current_page+$SegundoValor+($TercerValor-$current_page);
		}else{
			$first_page = $current_page-$SegundoValor-(($current_page+$SegundoValor)-$paginas);
			$last_page = $paginas;
		}
	}else{
		$first_page = 1;
		if($paginas==0){ $last_page = 1; }else{ $last_page = $paginas; }
	}
	//Link's de Navegacion entre paginas
	$Paginacion = '';
	for($i=$first_page;$i<($last_page+1);$i++) {
		if($mPage==$i) {
		$Paginacion .= '<strong style="color:#000;">[&nbsp;'.$i.'&nbsp;]</strong>';
		} else {
	
			$Paginacion .= '<a class="page" href="'.Seccion($_GET['seccion'],'listado',0,$i,$textSearch).'">'.$i.'</a>';
			
		}
		if( $i != $last_page ){ $Paginacion .= '&nbsp;-&nbsp;'; }
	}										
	 
	if( $mPage==1 ) { $current_page = 1; } else { $current_page = $mPage; }
	//Link´s de Primero y anterior 					
	if( $mPage>1 ) {
		$mLinkPrimero = '<a class="page" href="'.Seccion($_GET['seccion'],'listado',0,1,$textSearch).'">[&nbsp;Primero&nbsp;]</a>';
		$mLinkAtras = '<a class="page" href="'.Seccion($_GET['seccion'],'listado',0,($current_page-1),$textSearch).'">[&nbsp;Anterior&nbsp;]</a>';						
	}else{
		$mLinkPrimero = '[&nbsp;Primero&nbsp;]';
		$mLinkAtras = '[&nbsp;Anterior&nbsp;]';
	}
	//Link´s de Siguiente y ultimo
	if( $current_page < $paginas ) {										
		$mLinkUltimo = '<a class="page" href="'.Seccion($_GET['seccion'],'listado',0,$paginas,$textSearch).'">[&nbsp;Ultimo&nbsp;]</a>';
		$mLinkSiguiente = '<a class="page" href="'.Seccion($_GET['seccion'],'listado',0,($current_page+1),$textSearch).'">[&nbsp;Siguiente&nbsp;]</a>';						
	}else{
		$mLinkUltimo = '[&nbsp;Ultimo&nbsp;]';
		$mLinkSiguiente = '[&nbsp;Siguiente&nbsp;]';
	}
	
	return array("pagination"=>$Paginacion, "mLinkPrimero"=>$mLinkPrimero, "mLinkAtras"=>$mLinkAtras, "mLinkUltimo"=>$mLinkUltimo, "mLinkSiguiente"=>$mLinkSiguiente, "totalPaginas"=>$paginas);
}

//Convertir Objeto A Array
function Obj2ArrRecursivo($Objeto) {
	if (is_object ( $Objeto ))
	$Objeto = get_object_vars ( $Objeto );
	if (is_array ( $Objeto ))
	foreach ( $Objeto as $key => $value )
	$Objeto [$key] =  Obj2ArrRecursivo ( $Objeto [$key] );
	return $Objeto;
}

?>