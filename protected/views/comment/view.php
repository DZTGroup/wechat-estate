<?php
/* @var $this CommentController */
/* @var $model BBSComment */

$this->breadcrumbs=array(
	'Bbscomments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List BBSComment', 'url'=>array('index')),
	array('label'=>'Create BBSComment', 'url'=>array('create')),
	array('label'=>'Update BBSComment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BBSComment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BBSComment', 'url'=>array('admin')),
);
?>

<h1>View BBSComment #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'post_id',
		'content',
		'wechat_id',
		'create_time',
	),
)); ?>
