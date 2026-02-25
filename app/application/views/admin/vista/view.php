<?php
/* @var $this VistaController */
/* @var $model Vista */

$this->breadcrumbs=array(
	'Vistas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Vista', 'url'=>array('index')),
	array('label'=>'Create Vista', 'url'=>array('create')),
	array('label'=>'Update Vista', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Vista', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Vista', 'url'=>array('admin')),
);
?>

<h1>View Vista #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'archivo',
		'fecharegistro',
	),
)); ?>
