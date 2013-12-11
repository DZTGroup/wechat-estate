<?php
/* @var $this CommentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bbscomments',
);

$this->menu=array(
	array('label'=>'Create BBSComment', 'url'=>array('create')),
	array('label'=>'Manage BBSComment', 'url'=>array('admin')),
);
?>

<h1>Bbscomments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
