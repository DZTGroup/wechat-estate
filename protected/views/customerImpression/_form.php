<?php
/* @var $this CustomerImpressionController */
/* @var $model CustomerImpression */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-impression-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'customer_id'); ?>
		<?php echo $form->textField($model,'customer_id'); ?>
		<?php echo $form->error($model,'customer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'customer_nickname'); ?>
		<?php echo $form->textField($model,'customer_nickname',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'customer_nickname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'estate_id'); ?>
		<?php echo $form->textField($model,'estate_id'); ?>
		<?php echo $form->error($model,'estate_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'impression'); ?>
		<?php echo $form->textArea($model,'impression',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'impression'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
		<?php echo $form->error($model,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reserved_field_1'); ?>
		<?php echo $form->textField($model,'reserved_field_1',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'reserved_field_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reserved_field_2'); ?>
		<?php echo $form->textField($model,'reserved_field_2',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'reserved_field_2'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->