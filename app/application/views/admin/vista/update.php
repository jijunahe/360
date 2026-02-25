<?php
/* @var $this VistaController */
/* @var $model Vista */

$this->breadcrumbs=array(
	'Vistas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Vista', 'url'=>array('index')),
	array('label'=>'Create Vista', 'url'=>array('create')),
	array('label'=>'View Vista', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Vista', 'url'=>array('admin')),
);
?>

<h1>Update Vista <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>