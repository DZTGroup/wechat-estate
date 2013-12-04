<?php
/* @var $this ExpertCommentController */
/* @var $model ExpertComment */

$this->breadcrumbs=array(
	'Expert Comments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ExpertComment', 'url'=>array('index')),
	array('label'=>'Create ExpertComment', 'url'=>array('create')),
	array('label'=>'View ExpertComment', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ExpertComment', 'url'=>array('admin')),
);
?>

<h1>Update ExpertComment <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>