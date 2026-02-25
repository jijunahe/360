<?php
/* @var $this NodosreporteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Nodosreportes',
);

$this->menu=array(
	array('label'=>'Create Nodosreporte', 'url'=>array('create')),
	array('label'=>'Manage Nodosreporte', 'url'=>array('admin')),
);
?>

<h1>Nodosreportes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
