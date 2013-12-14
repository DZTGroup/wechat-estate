<?php
/* @var $this UserpicwallController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Picture Walls',
);

$this->menu=array(
	array('label'=>'Create UserPictureWall', 'url'=>array('create')),
	array('label'=>'Manage UserPictureWall', 'url'=>array('admin')),
);
?>

<h1>User Picture Walls</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
