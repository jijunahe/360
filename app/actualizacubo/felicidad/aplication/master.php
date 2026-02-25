<?php
	/*
	error_reporting(E_ALL);
	ini_set('display_errors', '1'); 
	*/
	if(isset($_GET["mode"]) or isset($_POST["mode"])){
		$mode="";
		
		if(isset($_GET["mode"])){
			$mode=$_GET["mode"];
		}else if(isset($_POST["mode"])){
			$mode=$_POST["mode"];
		}
 		if(file_exists(CONTENT_DIR.$mode.".php") and$mode!="master"){
			require_once CONTENT_DIR .$mode.'.php'; 
			$objClass = new Action();
			$objClass->init();	
 		}
	}
	
?>