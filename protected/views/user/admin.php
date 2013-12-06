<?php
/* @var $this UserController */
/* @var $model User */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="header">
    <div class="com-cent">
        <div class="hd-title">微信 房产管理后台</div>
        <div class="hd-log">欢迎你<span>亲爱的<i><?php echo Yii::app()->user->getUserName();?></i>用户</span><a href="">退出</a></div>
        <ul class="hd-link">
            <li class="curr"><a href="boss.html">权限设置</a></li>
            <li><a href="property_review.html">审核</a></li>
            <li><a href="release_data.html">已发布数据</a></li>
            <li><a href="ordea_data.html">订单数据</a></li>
        </ul>
    </div>
</div>
<div style="margin-top: 20px" align="right"><button onclick="location.href='?r=user/create'">新增用户</button></div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'pass',
		'qq',
		'email',
		'phone',
		'user_type',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
