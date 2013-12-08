<?php
/* @var $this UserController */
/* @var $model User */

?>

    <div style="margin-top: 20px" align="left">管理员列表</div>
    <div align="right"><button onclick="location.href='?r=user/create'">新增管理员</button></div>
<?php

    $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'user-grid',
    'dataProvider'=>$dataProvider_admin,
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

    <div style="margin-top: 20px" align="left">操作员列表</div>
    <div align="right"><button align="right" onclick="location.href='?r=user/create'">新增操作员</button></div>
<?php
    $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'user-grid',
    'dataProvider'=>$dataProvider_operator,
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