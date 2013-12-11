<?php
/* @var $this PostController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bbsposts',
);

$this->menu=array(
	array('label'=>'Create BBSPost', 'url'=>array('create')),
	array('label'=>'Manage BBSPost', 'url'=>array('admin')),
);
?>

<h1>Bbsposts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
