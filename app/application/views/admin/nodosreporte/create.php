<?php
/* @var $this NodosreporteController */
/* @var $model Nodosreporte */

$this->breadcrumbs=array(
	'Nodosreportes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Nodosreporte', 'url'=>array('index')),
	array('label'=>'Manage Nodosreporte', 'url'=>array('admin')),
);
?>

<h1>Create Nodosreporte</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>