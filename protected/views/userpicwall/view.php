<?php
/* @var $this UserpicwallController */
/* @var $model UserPictureWall */

$this->breadcrumbs=array(
	'User Picture Walls'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserPictureWall', 'url'=>array('index')),
	array('label'=>'Create UserPictureWall', 'url'=>array('create')),
	array('label'=>'Update UserPictureWall', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserPictureWall', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserPictureWall', 'url'=>array('admin')),
);
?>

<h1>View UserPictureWall #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'estate_id',
		'wechat_id',
		'url',
		'create_time',
	),
)); ?>
