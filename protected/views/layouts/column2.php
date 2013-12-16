<?php /* @var $this Controller */ ?>
<script src="js/jquery-2.0.3.min.js"></script>
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<?php $this->beginContent('//layouts/main'); ?>
    <div class="header">
        <div class="com-cent">
            <div class="hd-title">微信 房产管理后台</div>
            <div class="hd-log">欢迎你<span>亲爱的<i><?php echo Yii::app()->user->getUserName();?></i>用户</span><a href="?r=site/logout">退出</a></div>
            <ul class="hd-link">
                <li><a href="?r=user/admin">用户设置</a></li>
                <li><a href="?r=audit/all">审核</a></li>
                <li><a href="?r=audit/list">已发布数据</a></li>
                <li><a href="?r=audit/order">订单数据</a></li>
            </ul>
        </div>
    </div>

<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>
<script src="js/upload/swfupload.js"></script>
<script src="js/base.js" charset="utf-8"></script>
