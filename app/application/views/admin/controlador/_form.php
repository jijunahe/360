<?php
/* @var $this ControladorController */
/* @var $model Controlador */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'controlador-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'prefijo'); ?>
		<?php echo $form->textField($model,'prefijo',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'prefijo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'archivo'); ?>
		<?php echo $form->textField($model,'archivo',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'archivo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecharegistro'); ?>
		<?php echo $form->textField($model,'fecharegistro'); ?>
		<?php echo $form->error($model,'fecharegistro'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->