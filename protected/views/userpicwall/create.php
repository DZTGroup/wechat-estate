<?php
/* @var $this UserpicwallController */
/* @var $model UserPictureWall */

$this->breadcrumbs=array(
	'User Picture Walls'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserPictureWall', 'url'=>array('index')),
	array('label'=>'Manage UserPictureWall', 'url'=>array('admin')),
);
?>

<h1>Create UserPictureWall</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>