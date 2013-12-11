<?php
/* @var $this PostController */
/* @var $data BBSPost */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estate_id')); ?>:</b>
	<?php echo CHtml::encode($data->estate_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('picture_url')); ?>:</b>
	<?php echo CHtml::encode($data->picture_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('wechat_id')); ?>:</b>
	<?php echo CHtml::encode($data->wechat_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('pv_num')); ?>:</b>
	<?php echo CHtml::encode($data->pv_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('praise_num')); ?>:</b>
	<?php echo CHtml::encode($data->praise_num); ?>
	<br />

	*/ ?>

</div>