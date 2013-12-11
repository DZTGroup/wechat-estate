<?php
$this->layout='';
?>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'bbspost-form',
)); ?>

<div class="form">

    <!DOCTYPE html>
    <html>
    <head>
        <link href="http://imgcache.gtimg.cn/lifestyle/proj-house/css/form.css" rel="stylesheet" />
        <style type="text/css">
            .photo_container{width:92px;height:92px;overflow: hidden;display:table-cell;vertical-align:middle;float: left}
            #photo{max-width: 92px;}
            textarea{
                -webkit-box-sizing: border-box;
            }
        </style>
    </head>
    <body>
    <div class="wrapper" id="container">
        <div class="mod-top-bar" style="position:relative"><!-- 隐藏头部加上样式ui-d-n -->
            <a href="#" class="mod-top-bar__back" id="btnBack"><span class="icon-back"></span></a>
            <h2 class="mod-top-bar__title">发表新话题</h2>
            <a href="#" class="button-normal button-primary mod-top-bar__button" id="btnSend">发送</a>
        </div>
        <div class="mod-box ui-mt-large-x" style="margin-top: 10px">
            <div class="mod-box__form">
                <label>
                    <?php echo $form->textField($model,'title',array('size'=>25,'maxlength'=>25,
                        'placeholder'=>"标题（最多20字）",'style'=>"width: 268px",'class'=>"mod-box__form-input")); ?>
                </label>
                <label>
                    <?php echo $form->textField($model,'content',array('size'=>45,'maxlength'=>45,
                        'style'=>"min-height: 66px;width:280px",'placeholder'=>"正文（禁止发布广告、色情等违反法律的内容）",
                        'class'=>"mod-box__form-textarea")); ?>
                </label>
            </div>
        </div>
        <div class="mod-photo">
            <a href="#" class="button-photo" id="btnUpload" enabled="true"><span class="icon-pic-green"></span>上传配图</a>
        </div>
        <div id="paddingDiv" style="height:10px"></div>
    </div>

    <script type="text/javascript" src="js/common.js?ver=2.4.7"></script>
    </body>
    </html>

	<div class="row" style="display: none"
		<?php echo $form->labelEx($model,'wechat_id'); ?>
		<?php echo $form->textField($model,'wechat_id',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'wechat_id'); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->