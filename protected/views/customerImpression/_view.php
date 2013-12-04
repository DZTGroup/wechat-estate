<?php
/* @var $this CustomerImpressionController */
/* @var $data CustomerImpression */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_id')); ?>:</b>
	<?php echo CHtml::encode($data->customer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_nickname')); ?>:</b>
	<?php echo CHtml::encode($data->customer_nickname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estate_id')); ?>:</b>
	<?php echo CHtml::encode($data->estate_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('impression')); ?>:</b>
	<?php echo CHtml::encode($data->impression); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('reserved_field_1')); ?>:</b>
	<?php echo CHtml::encode($data->reserved_field_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reserved_field_2')); ?>:</b>
	<?php echo CHtml::encode($data->reserved_field_2); ?>
	<br />

	*/ ?>

</div>