<?php
/* @var $this CommentController */
/* @var $model BBSComment */

$this->breadcrumbs=array(
	'Bbscomments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BBSComment', 'url'=>array('index')),
	array('label'=>'Create BBSComment', 'url'=>array('create')),
	array('label'=>'View BBSComment', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BBSComment', 'url'=>array('admin')),
);
?>

<h1>Update BBSComment <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>