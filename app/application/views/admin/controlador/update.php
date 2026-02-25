<?php
/* @var $this ControladorController */
/* @var $model Controlador */

$this->breadcrumbs=array(
	'Controladors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Controlador', 'url'=>array('index')),
	array('label'=>'Create Controlador', 'url'=>array('create')),
	array('label'=>'View Controlador', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Controlador', 'url'=>array('admin')),
);
?>

<h1>Update Controlador <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>