<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * LimeSurvey
 * Copyright (C) 2007-2011 The LimeSurvey Project Team / Carsten Schmitz
 * All rights reserved.
 * License: GNU/GPL License v2 or later, see LICENSE.php
 * LimeSurvey is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 *
 */
class Index extends Survey_Common_Action
{

    public function run()
    {
        $clang = Yii::app()->lang;
         if (Yii::app()->session['loginID'])
        {  
            $aViewUrls = array('message' => array(
                'title' => $clang->gT("Logged in"),
                'message' => "Bien venido/a"
            ));
            unset(Yii::app()->session['loginID']);
 
           // $this->_renderWrappedTemplate('super', $aViewUrls);
			//$this->getController()->redirect(array('admin/bi'));
			$this->getController()->redirect(array('admin/evaluacion'));

        }
		
		/*
        elseif (count(getSurveyList(true)) == 0)
		{ 
           // $this->_renderWrappedTemplate('super', 'firststeps');
			$this->getController()->redirect(array('admin/survey/sa/index'));
		}
        else
        { 
            $this->getController()->redirect(array('admin/survey/sa/index'));
        }
		*/

    }

}
