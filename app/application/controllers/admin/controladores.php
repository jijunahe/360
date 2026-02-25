<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


class Controladores extends Survey_Common_Action
{
	function __construct($controller, $id)
	{
		parent::__construct($controller, $id);

		Yii::app()->loadHelper('database');
	}
 	
	 
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function create()
	{
		$model=new Controlador;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Controlador']))
		{
			$model->attributes=$_POST['Controlador'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
        $this->_renderWrappedTemplate('controlador','create',array(
			'model'=>$model,));
 	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function update($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Controlador']))
		{
			$model->attributes=$_POST['Controlador'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		 $this->_renderWrappedTemplate('controlador','update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function delete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function index()
	{	 
		$dataProvider=new CActiveDataProvider('Controlador');
		 $this->_renderWrappedTemplate('controlador','index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function admin()
	{
		$model=new Controlador('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Controlador']))
			$model->attributes=$_GET['Controlador'];

		 $this->_renderWrappedTemplate('controlador','admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Controlador the loaded model
	 * @throws CHttpException
	 */
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

	/**
	 * Performs the AJAX validation.
	 * @param Controlador $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='controlador-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
