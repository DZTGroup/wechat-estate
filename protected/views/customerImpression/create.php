<?php
/* @var $this CustomerImpressionController */
/* @var $model CustomerImpression */

$this->breadcrumbs=array(
	'Customer Impressions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CustomerImpression', 'url'=>array('index')),
	array('label'=>'Manage CustomerImpression', 'url'=>array('admin')),
);
?>

<h1>Create CustomerImpression</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>