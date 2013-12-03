<?php
/* @var $this ExpertCommentController */
/* @var $data ExpertComment */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estate_id')); ?>:</b>
	<?php echo CHtml::encode($data->estate_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expert_name')); ?>:</b>
	<?php echo CHtml::encode($data->expert_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expert_title')); ?>:</b>
	<?php echo CHtml::encode($data->expert_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expert_introduction')); ?>:</b>
	<?php echo CHtml::encode($data->expert_introduction); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment_title')); ?>:</b>
	<?php echo CHtml::encode($data->comment_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment_content')); ?>:</b>
	<?php echo CHtml::encode($data->comment_content); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reserved_field_1')); ?>:</b>
	<?php echo CHtml::encode($data->reserved_field_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reserved_field_2')); ?>:</b>
	<?php echo CHtml::encode($data->reserved_field_2); ?>
	<br />

	*/ ?>

</div>