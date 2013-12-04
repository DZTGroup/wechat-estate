<?php
/* @var $this ExpertCommentController */
/* @var $model ExpertComment */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'expert-comment-form',
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
		<?php echo $form->labelEx($model,'expert_name'); ?>
		<?php echo $form->textField($model,'expert_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'expert_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'expert_title'); ?>
		<?php echo $form->textField($model,'expert_title',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'expert_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'expert_introduction'); ?>
		<?php echo $form->textField($model,'expert_introduction',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'expert_introduction'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment_title'); ?>
		<?php echo $form->textField($model,'comment_title',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'comment_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment_content'); ?>
		<?php echo $form->textField($model,'comment_content',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'comment_content'); ?>
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