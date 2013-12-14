<?php
    $this->layout='';
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="white" />
    <link href="http://imgcache.gtimg.cn/lifestyle/proj-house/css/form.css" rel="stylesheet" />
    <style type="text/css">
        .mod-body-bg{background-image: url(http://imgcache.gtimg.cn/lifestyle/proj-house/img/bg-main2.jpg);}
        textarea{
            -webkit-box-sizing: border-box;
            max-height: 90px;
        }
    </style>
    <script src="js/jquery-2.0.3.min.js"></script>
    <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
</head>
<body class="mod-body-bg" style="padding: 0">
<script type="text/javascript">
    function getQueryStringRegExp(name)
    {
        var reg = new RegExp("(^|\\?|&)"+ name +"=([^&]*)(\\s|&|$)", "i");
        if (reg.test(location.href)) return unescape(RegExp.$2.replace(/\+/g, " ")); return "";
    };


    $(document).ready(function(){
        id=getQueryStringRegExp('id');
        WXAPP.Post.getDetailData(id);
        $('#current_post_id')[0].value=id
    });


</script>
<input style="display: none" id="current_post_id" value=""/>
<input id="wechat_id" style="display: none" value="翠花"/>

<div class="wrapper" id="container" style="margin-top: 50px;">
    <div id="navBar" class="mod-top-bar"><!-- 隐藏头部加上样式ui-d-n -->
        <a id="btnBack" href="?r=post/list&estate_id=1" class="mod-top-bar__back"><span class="icon-back"></span></a>
        <h2 id="titleBar" class="mod-top-bar__title">详情</h2>
    </div>
</div>
    <div id="topic_id">
    </div>
    <div id="divComments" class="mod-box">
        <div id="commentBox" class="mod-box__comment lay-flex" style="margin-bottom:0px">
            <label class="mod-box__comment-label lay-flex__item">
                <textarea id="tfComment_content" name="comment" class="ui-input mod-box__comment-input"
                          style="padding:8.5px 30px 8.5px 3px;line-height:1.5em;z-index:9" cols="30" rows="1"
                          placeholder="评论" maxlength="9999999"></textarea><!-- 当行数超过一行时，rows要等于相应的行数 -->
            </label>
            <a id="btnCClear" href="#" style="display:none;z-index:10"><span class="icon-close-small mod-box__comment-close"></span></a>
            <a id="btnComment" href="#" class="button-large button-primary" style="height: 32px">发布</a>
        </div>
        <ul id="commentList" style="padding:0;margin:0 -10px"></ul>
    </div>
</body>
<script src="js/base.js" charset="utf-8"></script>
</html>