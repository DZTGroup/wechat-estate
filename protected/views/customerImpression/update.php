<?php
/* @var $this CustomerImpressionController */
/* @var $model CustomerImpression */

$this->breadcrumbs=array(
	'Customer Impressions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CustomerImpression', 'url'=>array('index')),
	array('label'=>'Create CustomerImpression', 'url'=>array('create')),
	array('label'=>'View CustomerImpression', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CustomerImpression', 'url'=>array('admin')),
);
?>

<h1>Update CustomerImpression <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>