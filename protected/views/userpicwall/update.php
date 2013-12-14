<?php
/* @var $this UserpicwallController */
/* @var $model UserPictureWall */

$this->breadcrumbs=array(
	'User Picture Walls'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserPictureWall', 'url'=>array('index')),
	array('label'=>'Create UserPictureWall', 'url'=>array('create')),
	array('label'=>'View UserPictureWall', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserPictureWall', 'url'=>array('admin')),
);
?>

<h1>Update UserPictureWall <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>