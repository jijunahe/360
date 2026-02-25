<?php
/* @var $this ControladorController */
/* @var $model Controlador */

$this->breadcrumbs=array(
	'Controladors'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Controlador', 'url'=>array('index')),
	array('label'=>'Create Controlador', 'url'=>array('create')),
	array('label'=>'Update Controlador', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Controlador', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Controlador', 'url'=>array('admin')),
);
?>

<h1>View Controlador #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'prefijo',
		'archivo',
		'descripcion',
		'fecharegistro',
	),
)); ?>
