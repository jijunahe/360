<?php
	session_start();
//GENERA UN CODIGO ALEATORIO
include 'libs/phpThumb/phpthumb/ThumbLib.inc.php';
require_once 'class/class_file.php';


  function aleatorioCode($op,$limite){

 

					$str1 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
					$str2 = "1234567890";

   
						 if($op==0){
							$res= substr($str1,rand(0,25),1);
						}	
 
						if($op==1){
	 
							$res= substr($str2,rand(0,9),1);
						}	 

             return $res;
		}	
	
	
	if($_POST["tipo"]=="getImg"){
	  echo $_SESSION["imagen"].$_SESSION["extencion"];
	}else if(!empty($_FILES)){
	    echo "<pre>";
	   print_r($_FILES);
	    echo "</pre>";
		$targetFolder = 'temp'; 
	 

		
		$cad = "";
		for ($i = 0; $i < 12; $i++) {
		$cad.=aleatorioCode(rand(0, 1), 12);
		}	 
	 
	 
		$returnClassFile = ClassFile::UploadImagenFileImg("imglogo_".$_POST["count"], 'images/temp', $cad, $cad);
	 echo "<pre>";
	    print_r($returnClassFile);
	 echo "</pre>";
		if (!isset($returnClassFile['Error'])) {
				unset($_SESSION["imagen"]);	
				unset($_SESSION["extencion"]);	
					$_SESSION["imagen"] =$cad ;
 					$_SESSION["extencion"] =$returnClassFile["Ext"];
		}
	 
	 
	}
?>