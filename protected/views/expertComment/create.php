<?php
/* @var $this ExpertCommentController */
/* @var $model ExpertComment */

$this->breadcrumbs=array(
	'Expert Comments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ExpertComment', 'url'=>array('index')),
	array('label'=>'Manage ExpertComment', 'url'=>array('admin')),
);
?>

<h1>Create ExpertComment</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>