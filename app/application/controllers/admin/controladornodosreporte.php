<?php
	
	//  error_reporting(E_ALL);
 //ini_set('display_errors', '3');
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Controladornodosreporte extends Survey_Common_Action
{
	function __construct($controller, $id)
	{
		parent::__construct($controller, $id);

		Yii::app()->loadHelper('database');
	}

    /**
    * Show users table
    */
    public function index()
    {
 		$aData=array();
		$r=Nodosreporte::model()->findAll();
 		$aData["nodos"]=$r;
        $this->_renderWrappedTemplate('nodosreporte', 'index', $aData);
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