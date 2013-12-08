<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

?>
<!-- 头部 【【-->
<div class="header">
    <div class="com-cent">
        <div class="hd-title">微信 房产管理后台</div>
    </div>
</div>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'password-form',
    )); ?>

    <div class="box-tan">
        <div class="box-tan-bg">
            <div class="box-tan-cent">
                <div class="box-tan-tit "><h3>修改密码</h3></div>
                <div class="box-tan-nair">
                    <dl class="tan-login-dl">
                        <dt>新密码：</dt>
                        <dd>
                            <?php echo $form->textField($model,'password'); ?>
                        </dd>
                    </dl>

                    <p class="tan-p-denglu">
                        <input type="submit" name="button" value="修改"/>
                    </p>
                </div>

            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div><!-- form -->
