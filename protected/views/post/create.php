<?php
?>

<!DOCTYPE html>
    <html>
    <head>
        <link href="http://imgcache.gtimg.cn/lifestyle/proj-house/css/form.css" rel="stylesheet" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="format-detection" content="telephone=no" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="white" />
        <style type="text/css">
            .photo_container{width:92px;height:92px;overflow: hidden;display:table-cell;vertical-align:middle;float: left}
            #photo{max-width: 92px;}
            textarea{
                -webkit-box-sizing: border-box;
            }
        </style>
        <script src="js/jquery-2.0.3.min.js"></script>
        <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
    </head>
    <body>
    <script>
        function getQueryStringRegExp(name)
        {
            var reg = new RegExp("(^|\\?|&)"+ name +"=([^&]*)(\\s|&|$)", "i");
            if (reg.test(location.href)) return unescape(RegExp.$2.replace(/\+/g, " ")); return "";
        };
        $(document).ready(function(){
            //var nickname=getQueryStringRegExp('nickname');
            var eid=getQueryStringRegExp('eid');
            var appid=getQueryStringRegExp('appid');
            var openid=getQueryStringRegExp('openid');
            //var mainUrl=getQueryStringRegExp('mainUrl');

            var post_form=$('#bbs_post_form');


            $('#post_btnSend').click(function () {
                var title = post_form.find('#tfTitle').val();
                var content = post_form.find('#tfContent').val();
                WXAPP.Ajax('?r=post/ajaxcreatenewpost', {
                    estate_id: eid,wechat_id:openid,post_title:title,post_content:content
                }, function(res){
                    if(res.code==200){
                        location.href='?r=post/list&eid='+eid+'&appid='+appid+'&openid='+openid;
                    }
                });
            });

            $('#btnBack').click(function(){
                location.href='?r=post/list&eid='+eid+'&appid='+appid+'&openid='+openid;
            });
        });
    </script>
    <div class="wrapper" id="container">
        <div class="mod-top-bar" style="position:relative"><!-- 隐藏头部加上样式ui-d-n -->
            <a class="mod-top-bar__back" id="btnBack"><span class="icon-back"></span></a>
            <h2 class="mod-top-bar__title">发表新话题</h2>
            <a class="button-normal button-primary mod-top-bar__button" id="post_btnSend">发送</a>
        </div>
        <div class="mod-box ui-mt-large-x" style="margin-top: 10px">
            <div class="mod-box__form" id="bbs_post_form">
                <label>
                    <input class="mod-box__form-input" style="width: 268px"
                           type="text" id="tfTitle" placeholder="标题（最多20字）"
                           maxlength="20"/>
                </label>
                <label>
                    <textarea id="tfContent" class="mod-box__form-textarea"
                              style="min-height: 66px; width:280px" cols="30" rows="1"
                              placeholder="正文（禁止发布广告、色情等违反法律的内容）"></textarea>
                </label>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/common.js?ver=2.4.7"></script>
    </body>

    <script src="js/jquery-2.0.3.min.js"></script>
    <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="js/base.js" charset="utf-8"></script>
    </html>