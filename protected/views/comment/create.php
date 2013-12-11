<?php
/* @var $this CommentController */
/* @var $model BBSComment */

$this->breadcrumbs=array(
	'Bbscomments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BBSComment', 'url'=>array('index')),
	array('label'=>'Manage BBSComment', 'url'=>array('admin')),
);
?>

<h1>Create BBSComment</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>