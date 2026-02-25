<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$documentroot=str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"]);
require_once($documentroot.'application/extensions/PHPMailer/class.phpmailer.php');
require_once($documentroot.'application/extensions/xls/Excel/reader.php');
require_once($documentroot.'application/extensions/class_sql_inject.php');
class Modulos extends Survey_Common_Action
{
	function __construct($controller, $id)
    {
        parent::__construct($controller, $id);

        Yii::app()->loadHelper('database');
    }
	
	public function miga(){
		//printVar($_REQUEST["location"]);
		$location=$_POST["location"];
		$queryc = "SELECT * FROM {{menuxmodulo}} where accion='".$location."'";
		$gcrt = dbExecuteAssoc($queryc);
		$action = $gcrt->readAll();
		$obj=(object)$action[0];
		$miga=array();
		 if( $obj->modulo!=""){
 			array_push($miga,$obj->modulo);
		} 
		 if((int)$obj->idmodulo>0){
			$modulo=Modulo::model()->findByPk($obj->idmodulo);
			array_push($miga,$modulo->descripcion);
		} 
 		 if((int)$obj->padreid>0){
			$padre=Menuxmodulo::model()->findByPk($obj->padreid);
			array_push($miga,$padre->descripcion);
		}
		if(!in_array($obj->descripcion,$miga)){
		 array_push($miga,$obj->descripcion);
		}
		if($miga[0]==null){
			$miga=array("Recursos PCOS","Documentos PCOS");
		}
		echo json_encode($miga); 
		exit;
	}	
	
	 public function index()
    {
		App()->getClientScript()->registerScriptFile(Yii::app()->baseUrl."/scripts/yav1_4_1/js/yav.js");
		App()->getClientScript()->registerScriptFile(Yii::app()->baseUrl."/scripts/yav1_4_1/js/yav-config-es.js");
		App()->getClientScript()->registerScriptFile("//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js");
		if(!isset($_POST["save"])){
			$this->_renderWrappedTemplate('modulos', 'index', $aData);
		}else{
			$urlbase=$_SERVER["DOCUMENT_ROOT"].Yii::app()->baseUrl;
  			//comprobamos que sea una petición ajax
			if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
			{
			 
				//obtenemos el archivo a subir
				$file = $_FILES['archivo']['name'];
			 
				//comprobamos si existe un directorio para subir el archivo
				//si no es así, lo creamos
				  
				//comprobamos si el archivo ha subido
				if ($file && move_uploaded_file($_FILES['archivo']['tmp_name'],$urlbase."/files/".$file))
				{
				   sleep(3);//retrasamos la petición 3 segundos
				   echo $file;//devolvemos el nombre del archivo para pintar la imagen
				}
			}else{
				throw new Exception("Error Processing Request", 1);   
			}			
 			
			$zip = new ZipArchive;
			if ($zip->open($urlbase."/files/".$file) === TRUE) {
				$zip->extractTo($urlbase.'/files/unzip');
				$zip->close();
 				echo("ok");
 			} else {
 				echo("field");
			}
			$carpeta=explode(".",$file);
 			$fp = fopen($urlbase."/files/unzip/".$carpeta[0]."/config.xml", "r");
			$read="";
			while(!feof($fp)) {
				$linea = fgets($fp);
				$read.=$linea;
			}
			fclose($fp);

			$rxml = new SimpleXMLElement($read);
 			printVar($rxml);
 			unlink($urlbase."/files/".$file);
 			exit;
 		}
	}
	
 	
	
    private function _getSurveyCountForUser(array $user)
    {
        return Survey::model()->countByAttributes(array('owner_id' => $user['uid']));
    }
	
    /**
    * Renders template(s) wrapped in header and footer
    *
    * @param string $sAction Current action, the folder to fetch views from
    * @param string|array $aViewUrls View url(s)
    * @param array $aData Data to be passed on. Optional.
    */
    protected function _renderWrappedTemplate($sAction = 'user', $aViewUrls = array(), $aData = array())
    {
        parent::_renderWrappedTemplate($sAction, $aViewUrls, $aData);
    }
	
	
	
}