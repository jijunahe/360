<?php
/* @var $this VistaController */
/* @var $model Vista */

$this->breadcrumbs=array(
	'Vistas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Vista', 'url'=>array('index')),
	array('label'=>'Manage Vista', 'url'=>array('admin')),
);
?>

<h1>Create Vista</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>