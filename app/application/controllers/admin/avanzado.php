<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');
// error_reporting(E_ALL); ini_set('display_errors', '1');
$documentroot=str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"]);
require_once($documentroot.'application/extensions/PHPMailer/class.phpmailer.php');
require_once($documentroot.'application/extensions/xls/Excel/reader.php');
require_once($documentroot.'application/extensions/class_sql_inject.php');
require_once($documentroot.'application/extensions/cipher.php');
 include($_SERVER["DOCUMENT_ROOT"].Yii::app()->baseUrl.'/application/extensions/imageResizer.php');

class Avanzado extends Survey_Common_Action
{
	public $anioc=array(); 
 	public $roles=array(2,3,4,5,6,7);
	public $excludes=array("idsimulacro","idAnswer","sid","encuesta","idus","id","token","submitdate","lastpage","startlanguage","startdate","datestamp","ipaddr","refurl");
	function __construct($controller, $id)
    {
        parent::__construct($controller, $id);

        Yii::app()->loadHelper('database');
 		
    }
	
	 	
	
    public function index()
    { 

 
		$jsonorg=Estructura::model()->selectorestructura("lime_cubo_425936","idestructura"); 
		$arrestructura=Estructura::estructurausuario(); 
 		$data["jsonorg"]=$jsonorg[0];
		$data["organizaciones"]="";
		$data["estado"]= $jsonorg[1];
 		if(isset($jsonorg[2])){
			$data["organizaciones"]=$jsonorg[2];
			
		}
		//printVar($_SERVER["PATH_TRANSLATED"]);
 		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
 		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
 		$idusuario=NULL;
		$organizacion=NULL;
		$idpadre=NULL;
		$anioc=NULL;
		 
		if(in_array($dUsuario->perfil,$this->roles)){ 
 			 
			$data["idestructura"]=join(",",$arrestructura);
			 
 			$data["usuario"]=$dUsuario ;
 			
			$data["token"]=$this->getTokenpentaho();
			// printVar($data["idestructura"]); 
			$plantilla= 'index';
			$dimensiones=array('425936X35X1159','425936X35X1168','425936X35X1169','425936X35X1172','425936X35X1173','425936X35X1174','425936X35X1175','rangoedad','estadoCorporal','rangotrigliseridos','rangohdl','rangocolesterol','riesgom','riesgo','rangoScore','rangoglisemia');
			$criterios=array("Glicemia","Triglicéridos","Framingham modificado","Score","Colesterol hdl","Colesterol Ldl","Estado Corporal","Framingham (clásico)");
			$data["criterios"]=$criterios;
			if($dUsuario->perfil!=3){
				$data["hseqdisp"]=$hseqdisp;
				$dims=$this->getDimensiones("view_rcv",$dUsuario->id_unidad,$dimensiones); 
				$data["dimensiones"]=$dims;
				$plantilla= 'index';
			} 
			if($dUsuario->perfil==3){
				if(!isset($_GET["organizacion"])){
 					$dat = new CDbCriteria;
					$dat->condition = "id in (".$dUsuario->id_unidad.")";
					$empresas=Organizacion::model()->findAll($dat);				
					$data["empresas"]=$empresas;
					$plantilla= 'unidad';
 					 				
  				}else{
					if((int)$_GET["organizacion"]>0){
						$dims=$this->getDimensiones("view_rcv",$_GET["organizacion"],$dimensiones);
						$data["dimensiones"]=$dims;
						$plantilla= 'index';
 					}else{
						$dat = new CDbCriteria;
						$dat->condition = "id in (".$dUsuario->id_unidad.")";
						$empresas=Organizacion::model()->findAll($dat);				
						$data["empresas"]=$empresas;
						$plantilla= 'unidad'; 
					 			
 					}
				}
 			}

 			
			if(!isset($_POST["chart"])){
				$this->_renderWrappedTemplate('avanzado',$plantilla, $data);
			}else{
				echo json_encode($data);exit;
 			}
			 
		}

 		
    }
	public function getDimensiones($tabla,$unidad,$dimensiones=NULL){
		$queryString = "
		describe ".$tabla; // printVar($queryString);exit;
		$eguresult = dbExecuteAssoc($queryString);
		$tdatacubo = $eguresult->readAll();
		$cols=array();
		$validardims=FALSE;
		if($dimensiones!=NULL){$validardims=TRUE;}
		foreach($tdatacubo as $data){
			if(!in_array($data["Field"],$this->excludes) and $validardims==FALSE){
 				 
				$queryString = "
				SELECT ".$data["Field"]." FROM ".$tabla." where empresa=".$unidad." GROUP BY ".$data["Field"]." order by ".$data["Field"]." ASC"; // printVar($queryString);exit;
				$eguresult = dbExecuteAssoc($queryString);
				$respuestas = $eguresult->readAll();
				$r=array();
				foreach($respuestas as $respuesta){
					
					array_push($r,$respuesta[$data["Field"]]);
				}
 				
				$queryString = "
				select codigopregunta,question from view_preguntas where codigopregunta='".$data["Field"]."'"; // printVar($queryString);exit;
				$eguresult = dbExecuteAssoc($queryString);
				$enunciado = $eguresult->readAll();				
				$question=$data["Field"];
				if(isset($enunciado[0]['question'])){
					$question=$enunciado[0]['question'];
					
				}
				
 				array_push($cols,array($data["Field"],$question,$r));
			}else if($validardims==TRUE and in_array($data["Field"],$dimensiones)){
				
				
				$queryString = "
				SELECT ".$data["Field"]." FROM ".$tabla." where empresa=".$unidad." GROUP BY ".$data["Field"]." order by ".$data["Field"]." ASC"; // printVar($queryString);exit;
				$eguresult = dbExecuteAssoc($queryString);
				$respuestas = $eguresult->readAll();
				$r=array();
				foreach($respuestas as $respuesta){
					
					array_push($r,$respuesta[$data["Field"]]);
				}
 				
				$queryString = "
				select codigopregunta,question from view_preguntas where codigopregunta='".$data["Field"]."'"; // printVar($queryString);exit;
				$eguresult = dbExecuteAssoc($queryString);
				$enunciado = $eguresult->readAll();				
				$question=$data["Field"];
				if(isset($enunciado[0]['question'])){
					$question=$enunciado[0]['question'];
					
				}
				
 				array_push($cols,array($data["Field"],$question,$r));				
 			}
 		}
		return $cols;
	}
 	private function getTokenpentaho(){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://www.talentracking.co/user-token-session");
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "apiId=3&apikey=1edf9f14dd7f29b7fed31b55594df322&email=oscar&operation=login");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec ($ch);
		$res=json_decode($server_output);
		curl_close ($ch);
		// printVar($res->token);
		return $res->token;
		
	}
 	 
	 
    private function escape($str)
    {
        if (is_string($str)) {
            $str = $this->escape_str($str);
        }
        elseif (is_bool($str))
        {
            $str = ($str === true) ? 1 : 0;
        }
        elseif (is_null($str))
        {
            $str = 'NULL';
        }

        return $str;
    }

    private function escape_str($str, $like = FALSE)
    {
        if (is_array($str)) {
            foreach ($str as $key => $val)
            {
                $str[$key] = $this->escape_str($val, $like);
            }

            return $str;
        }

        // Escape single quotes
        $str = str_replace("'", "''", $this->remove_invisible_characters($str));

        return $str;
    }

    private function remove_invisible_characters($str, $url_encoded = TRUE)
    {
        $non_displayables = array();

        // every control character except newline (dec 10)
        // carriage return (dec 13), and horizontal tab (dec 09)

        if ($url_encoded) {
            $non_displayables[] = '/%0[0-8bcef]/'; // url encoded 00-08, 11, 12, 14, 15
            $non_displayables[] = '/%1[0-9a-f]/'; // url encoded 16-31
        }
        $non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S'; // 00-08, 11, 12, 14-31, 127
         do
        {
            $str = preg_replace($non_displayables, '', $str, -1, $count);
        } while ($count);
        return $str;
    }	
  	
    private function _getSurveyCountForUser(array $user)
    {
        return Survey::model()->countByAttributes(array('owner_id' => $user['uid']));
    }
	
	public function loadModel($id)
	{
		$model=EvalArchivos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
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