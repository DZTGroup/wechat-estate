<?php
/* @var $this CustomerImpressionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Customer Impressions',
);

$this->menu=array(
	array('label'=>'Create CustomerImpression', 'url'=>array('create')),
	array('label'=>'Manage CustomerImpression', 'url'=>array('admin')),
);
?>

<h1>Customer Impressions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
