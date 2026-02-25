<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(E_ALL); ini_set('display_errors', '1');
$documentroot=str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"]);
require_once($documentroot.'application/extensions/PHPMailer/class.phpmailer.php');
require_once($documentroot.'application/extensions/xls/Excel/reader.php');
require_once($documentroot.'application/extensions/class_sql_inject.php');
class Unydos extends Survey_Common_Action
{
	public $anioc=array();

	function __construct($controller, $id)
    {
        parent::__construct($controller, $id);

        Yii::app()->loadHelper('database');
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
	
	public function diagnostico(){
		$oRecord = User::model()->findByPk($_SESSION['loginID']);
		if($oRecord->uid==412){
 			$perf = new CDbCriteria;
			$perf->condition = 'id > 0';
			$perf->group='empresa ASC';
			$empresas = Diagnostico::model()->findAll($perf);
			$aData["empresas"]=$empresas;
			$aData["token"]="";
			$aData["tokenb"]=$this->getTokenpentaho();
			if(isset($_POST["option"])){
				switch($_POST["option"]){
					case "empresa":
						$perf = new CDbCriteria;
						$perf->condition = 'empresa="'.$_POST["id"].'"';
						$perf->group='fecharegistro ASC';
 						$empresa = Diagnostico::model()->findAll($perf); 
						$aData["empresa"]=$empresa; 
					break;
					 
					case "fecha":
						$perf = new CDbCriteria;
						$perf->condition = 'empresa="'.$_POST["id"].'"';
						$perf->group='fecharegistro ASC';
 						$empresa = Diagnostico::model()->findAll($perf); 
						$aData["empresa"]=$empresa; 
					
 						$perf = new CDbCriteria;
						$perf->condition = 'id= '.$_POST["fecha"];     
 						$empresa = Diagnostico::model()->find($perf);
						$aData["empresadatos"]=$empresa;
						
 						$perf = new CDbCriteria;
						$perf->condition =  'empresa="'.$_POST["id"].'"';
						$perf->group='cluster ASC';
 						$cluster = Diagnostico::model()->findAll($perf);
						$aData["cluster"]=$cluster;
						
 						$perf = new CDbCriteria;
						$perf->condition =  'empresa="'.$_POST["id"].'"';
						$perf->group='sector ASC';
 						$cluster = Diagnostico::model()->findAll($perf);
						$aData["sector"]=$sector;
						$aData["token"]=$this->getTokenpentaho();
						$aData["tokenb"]="";
 					break;
					 
				}
				
			}
			
 			$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);	
			$validaeditar=EvalUsuarios::model()->vaidausr(false);
  			$this->_renderWrappedTemplate('unydos', 'diagnostico', $aData);
		}else{printVar("Acceso denegado");}
		
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