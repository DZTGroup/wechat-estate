<?php
/* @var $this PostController */
/* @var $model BBSPost */

$this->breadcrumbs=array(
	'Bbsposts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BBSPost', 'url'=>array('index')),
	array('label'=>'Manage BBSPost', 'url'=>array('admin')),
);
?>

<h1>Create BBSPost</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>