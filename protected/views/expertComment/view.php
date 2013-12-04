<?php
/* @var $this ExpertCommentController */
/* @var $model ExpertComment */

$this->breadcrumbs=array(
	'Expert Comments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ExpertComment', 'url'=>array('index')),
	array('label'=>'Create ExpertComment', 'url'=>array('create')),
	array('label'=>'Update ExpertComment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ExpertComment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ExpertComment', 'url'=>array('admin')),
);
?>

<h1>View ExpertComment #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'estate_id',
		'expert_name',
		'expert_title',
		'expert_introduction',
		'comment_title',
		'comment_content',
		'create_time',
		'status',
		'reserved_field_1',
		'reserved_field_2',
	),
)); ?>
