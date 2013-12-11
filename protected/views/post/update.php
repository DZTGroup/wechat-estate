<?php
/* @var $this PostController */
/* @var $model BBSPost */

$this->breadcrumbs=array(
	'Bbsposts'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BBSPost', 'url'=>array('index')),
	array('label'=>'Create BBSPost', 'url'=>array('create')),
	array('label'=>'View BBSPost', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BBSPost', 'url'=>array('admin')),
);
?>

<h1>Update BBSPost <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>