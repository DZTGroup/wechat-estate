<?php
/* @var $this PostController */
/* @var $model BBSPost */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bbspost-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'estate_id'); ?>
		<?php echo $form->textField($model,'estate_id'); ?>
		<?php echo $form->error($model,'estate_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textField($model,'content',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'picture_url'); ?>
		<?php echo $form->textField($model,'picture_url',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'picture_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'wechat_id'); ?>
		<?php echo $form->textField($model,'wechat_id',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'wechat_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
		<?php echo $form->error($model,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pv_num'); ?>
		<?php echo $form->textField($model,'pv_num'); ?>
		<?php echo $form->error($model,'pv_num'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'praise_num'); ?>
		<?php echo $form->textField($model,'praise_num'); ?>
		<?php echo $form->error($model,'praise_num'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->