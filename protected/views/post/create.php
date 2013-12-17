<?php
$this->layout='';
?>

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
    <div style="display: none">
         <input id="wechat_id" value="翠花"/>
         <input id="estate_id" value="1"/>
    </div>
    <div class="wrapper" id="container">
        <div class="mod-top-bar" style="position:relative"><!-- 隐藏头部加上样式ui-d-n -->
            <a href="#" class="mod-top-bar__back" id="btnBack"><span class="icon-back"></span></a>
            <h2 class="mod-top-bar__title">发表新话题</h2>
            <a href="#" class="button-normal button-primary mod-top-bar__button" id="post_btnSend">发送</a>
        </div>
        <div class="mod-box ui-mt-large-x" style="margin-top: 10px">
            <div class="mod-box__form" id="bbs_post_form">
                <label>
                    <input class="mod-box__form-input"
                           type="text" id="tfTitle" placeholder="标题（最多20字）"
                           maxlength="20"/>
                </label>
                <label>
                    <textarea id="tfContent" class="mod-box__form-textarea"
                              style="min-height: 66px;" cols="30" rows="1"
                              placeholder="正文（禁止发布广告、色情等违反法律的内容）"></textarea>
                </label>
            </div>
        </div>
        <div id="paddingDiv" style="height:10px"></div>
    </div>

    <script type="text/javascript" src="js/common.js?ver=2.4.7"></script>
    </body>

    <script src="js/jquery-2.0.3.min.js"></script>
    <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="js/base.js" charset="utf-8"></script>
    </html>