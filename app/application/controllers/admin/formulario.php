<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$documentroot=str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"]);
require_once($documentroot.'application/extensions/PHPMailer/class.phpmailer.php');
require_once($documentroot.'application/extensions/xls/Excel/reader.php');
require_once($documentroot.'application/extensions/class_sql_inject.php');
class Formulario extends Survey_Common_Action
{
	function __construct($controller, $id)
    {
        parent::__construct($controller, $id);

        Yii::app()->loadHelper('database');
    }
	 public function index()
    {
		App()->getClientScript()->registerScriptFile(Yii::app()->baseUrl."/scripts/yav1_4_1/js/yav.js");
		App()->getClientScript()->registerScriptFile(Yii::app()->baseUrl."/scripts/yav1_4_1/js/yav-config-es.js");
		App()->getClientScript()->registerScriptFile("//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js");
 		$aData["estado"] =1;			
		$aData["modulo"]=Modulo::model()->findAll();
		printVar($aData["modulo"]);exit;	
 		$this->_renderWrappedTemplate('formulario', 'index', $aData);		
		
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