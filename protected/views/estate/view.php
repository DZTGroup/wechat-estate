<?php
/* @var $this EstateController */
/* @var $model Estate */

$this->breadcrumbs=array(
	'Estates'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Estate', 'url'=>array('index')),
	array('label'=>'Create Estate', 'url'=>array('create')),
	array('label'=>'Update Estate', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Estate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Estate', 'url'=>array('admin')),
);
?>

<h1>View Estate #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'name',
		'app_key',
		'app_id',
		'wechat_id',
		'create_time',
		'last_modify_time',
	),
)); ?>
