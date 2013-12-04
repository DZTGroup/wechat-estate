<?php
/* @var $this CustomerImpressionController */
/* @var $model CustomerImpression */

$this->breadcrumbs=array(
	'Customer Impressions'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CustomerImpression', 'url'=>array('index')),
	array('label'=>'Create CustomerImpression', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#customer-impression-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Customer Impressions</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customer-impression-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'customer_id',
		'customer_nickname',
		'estate_id',
		'impression',
		'create_time',
		/*
		'status',
		'reserved_field_1',
		'reserved_field_2',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
