<?php
/* @var $this CustomerImpressionController */
/* @var $model CustomerImpression */

$this->breadcrumbs=array(
	'Customer Impressions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CustomerImpression', 'url'=>array('index')),
	array('label'=>'Create CustomerImpression', 'url'=>array('create')),
	array('label'=>'Update CustomerImpression', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CustomerImpression', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CustomerImpression', 'url'=>array('admin')),
);
?>

<h1>View CustomerImpression #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'customer_id',
		'customer_nickname',
		'estate_id',
		'impression',
		'create_time',
		'status',
		'reserved_field_1',
		'reserved_field_2',
	),
)); ?>
