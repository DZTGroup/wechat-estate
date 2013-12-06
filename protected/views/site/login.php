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
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>

    <div class="box-tan">
        <div class="box-tan-bg">
            <div class="box-tan-cent">
                <div class="box-tan-tit "><h3>管理员登陆</h3></div>
                <div class="box-tan-nair">
                    <dl class="tan-login-dl">
                        <dt>账号：</dt>
                        <dd>
                            <?php echo $form->textField($model,'username'); ?>
                            <?php echo $form->error($model,'username'); ?>
                        </dd>
                        <dt class="login-dt">密码：</dt>
                        <dd>
                            <?php echo $form->passwordField($model,'password'); ?>
                            <?php echo $form->error($model,'password'); ?>
                        </dd>
                    </dl>

                    <p class="tan-p-denglu">
                        <input type="submit" name="button" value="" class="tan-denglu"/>
                    </p>
                </div>

            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div><!-- form -->
