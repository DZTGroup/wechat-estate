<?php
/* @var $this UserController */
/* @var $model User */

?>

<h1>View User #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'pass',
		'qq',
		'email',
		'phone',
		'user_type',
	),
)); ?>

<div style="margin-top: 20px" align="right"><button onclick="location.href='?r=user/admin'">返回</button></div>
