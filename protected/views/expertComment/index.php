<?php
/* @var $this ExpertCommentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Expert Comments',
);

$this->menu=array(
	array('label'=>'Create ExpertComment', 'url'=>array('create')),
	array('label'=>'Manage ExpertComment', 'url'=>array('admin')),
);
?>

<h1>Expert Comments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
