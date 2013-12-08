<?php
/* @var $this AuditController */
/* @var $model Audit */

?>
<div class="box-menu">
    <div class="com-menu">
        <ul class="menu">
            <li class="curr"><a href="property_review.html">楼盘审核</a></li>
            <li><a href="house_review.html">看房团审核</a></li>
            <li><a href="photo_review.html">照片墙审核</a></li>
            <li><a href="expert_review.html">专家点评审核</a></li>
            <li><a href="chips_review.html">认筹审核</a></li>
        </ul>
    </div>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'audit-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'entity_id',
		'estate_id',
		'entity_type',
		'entity_status',
		'operator_id',
		/*
		'admin_id',
		'create_time',
		'last_modify_time',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
