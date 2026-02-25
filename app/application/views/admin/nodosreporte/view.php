<?php
/* @var $this NodosreporteController */
/* @var $model Nodosreporte */

$this->breadcrumbs=array(
	'Nodosreportes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Nodosreporte', 'url'=>array('index')),
	array('label'=>'Create Nodosreporte', 'url'=>array('create')),
	array('label'=>'Update Nodosreporte', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Nodosreporte', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Nodosreporte', 'url'=>array('admin')),
);
?>

<h1>View Nodosreporte #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nodo',
		'nombre',
		'descripcion',
		'fecha',
	),
)); ?>
