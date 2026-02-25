<?php
/* @var $this ControladorController */
/* @var $dataProvider CActiveDataProvider */
 
 printVar($this->widget);exit;
/*$this->breadcrumbs=array(
	'Controlador',
);*/

$this->menu=array(
	array('label'=>'Create Controlador', 'url'=>array('create')),
	array('label'=>'Manage Controlador', 'url'=>array('admin')),
);
?>

<h1>Controladors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
