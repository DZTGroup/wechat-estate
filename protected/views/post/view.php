<?php
/* @var $this PostController */
/* @var $model BBSPost */

$this->breadcrumbs=array(
	'Bbsposts'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List BBSPost', 'url'=>array('index')),
	array('label'=>'Create BBSPost', 'url'=>array('create')),
	array('label'=>'Update BBSPost', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BBSPost', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BBSPost', 'url'=>array('admin')),
);
?>

<h1>View BBSPost #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'estate_id',
		'title',
		'content',
		'picture_url',
		'wechat_id',
		'create_time',
		'pv_num',
		'praise_num',
	),
)); ?>
