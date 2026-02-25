<?php 
	
$documentroot=str_replace("actenc/index.php","",$_SERVER["SCRIPT_FILENAME"]);	
require_once($documentroot.'/application/extensions/PHPMailer/class.phpmailer.php');
//require_once($_SERVER["DOCUMENT_ROOT"]."/pdf/fpdf.php");
require_once(CLASS_DIR."/class.db.php");
	error_reporting(E_ALL);
ini_set('display_errors', '1'); 
class Action{
	public $bdObj;
	public $id=214322;
	public $idRes=NULL;
	public function __construct()
	{
		$this->bdObj=new db("mysql:host=".serverdb_link.";port=3306;dbname=".database_link,username_link ,password_link );
		if(isset($_GET["id"])){
			$this->idRes=(int)$_GET["id"];
		}
		if(isset($_POST["id"])){
			$this->idRes=(int)$_POST["id"];
		}
 	}	
  	
	public function init(){
		//VALIDARA SI EXISTE TABLA
  		$results =$this->bdObj->select("information_schema.tables",
										"table_schema='".database_link."' AND table_name ='".PREFIJO_TABLAS."cubo_".$this->id."'",
										"",
										"COUNT(*) AS count"
										);
		$testable=$results[0]["count"];
		if($testable==0){
 			$sql = "describe ".PREFIJO_TABLAS."survey_".$this->id;
			$rest=$this->bdObj->run($sql);	
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
 				$cols.=$dato["Field"]." ".$dato["Type"]." ".$null.$autoincrement.",";
				$count++;
			}
 			if($key!=""){
				$cols.="PRIMARY KEY (`".$key."`)";
			}
 			$create="CREATE TABLE `".PREFIJO_TABLAS."cubo_".$this->id."`(".$cols.") ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;";
  			$this->bdObj->run($create);
 		}
   		$nombreEncuesta=$this->bdObj->select(PREFIJO_TABLAS."surveys_languagesettings",
										"surveyls_survey_id=".$this->id,
										"",
										"surveyls_title"
										);	
	
		$QUERY="";
		if($this->idRes>0){
 			$QUERY=" id=".$this->idRes;
		}			
		if($QUERY!=""){
			$QUERY.=" and submitdate is not NULL  LIMIT 0,5";
		}else{
			$QUERY=" submitdate is not NULL LIMIT 0,5";
		}	
	
	
		$resultadoEncuesta=$this->bdObj->select(PREFIJO_TABLAS."survey_".$this->id,
												$QUERY
												);
												
		$totalesEncuesta=count($resultadoEncuesta);
												
		$sql = "describe ".PREFIJO_TABLAS."survey_".$this->id;
		$cols=$this->bdObj->run($sql);
		$rCols=array();
		foreach($cols as $dr){
			array_push($rCols,array($dr["Field"]=>1));
		}
 		if($totalesEncuesta>0){
			for($i=0;$i<$totalesEncuesta;$i++){
			
				$test=$this->bdObj->select(PREFIJO_TABLAS."cubo_".$this->id,
														"idAnswer=".$resultadoEncuesta[$i]["id"],
														"",
														"idAnswer"
														);
													
				//COMPRUEBA SI REGISTRO YA FUE AGREGADO									
 				if(($resultadoEncuesta[$i]["submitdate"]!="" and  !isset($test[0]["idAnswer"]))){
					foreach($rCols as  $value){
						$testcode =false;
						foreach($value as $k=>$campo){
 							$testcode = strpos($key,$this->id);
						}
						if($testcode!==FALSE){
						
						
						
						
						
						}
					}
 					
				}
 			}
		}
												
 	
	}
}