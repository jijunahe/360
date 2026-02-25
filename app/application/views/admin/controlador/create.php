<?php
/* @var $this ControladorController */
/* @var $model Controlador */

$this->breadcrumbs=array(
	'Controladors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Controlador', 'url'=>array('index')),
	array('label'=>'Manage Controlador', 'url'=>array('admin')),
);
?>

<h1>Create Controlador</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>