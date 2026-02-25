<?php
/* @var $this NodosreporteController */
/* @var $model Nodosreporte */

$this->breadcrumbs=array(
	'Nodosreportes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Nodosreporte', 'url'=>array('index')),
	array('label'=>'Create Nodosreporte', 'url'=>array('create')),
	array('label'=>'View Nodosreporte', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Nodosreporte', 'url'=>array('admin')),
);
?>

<h1>Update Nodosreporte <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>