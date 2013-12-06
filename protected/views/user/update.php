<?php
/* @var $this UserController */
/* @var $model User */

?>
    <div class="header">
        <div class="com-cent">
            <div class="hd-title">微信 房产管理后台</div>
        </div>
    </div>

<h1>修改用户信息</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>