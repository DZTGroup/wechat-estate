
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>微信 房产管理后台</title>
    <link rel="stylesheet" href="css/styler.css" type="text/css" />
</head>
<body>
<!-- 头部 【【-->
<div class="header">
    <div class="com-cent">
        <div class="hd-title">微信 房产管理后台</div>
        <div class="hd-log">欢迎你<span>亲爱的<em>xxx</em>用户</span><a href="#none">退出</a></div>
        <ul class="hd-link">
            <li><a href="index_min.html">首页</a></li>
            <li class="curr"><a href="property_manage.html">管理后台</a></li>
            <li><a href="data.html">数据统计</a></li>
        </ul>
    </div>
</div>
<!-- 头部 】】-->
<!-- 二级菜单【【 -->
<div class="box-menu">
    <div class="com-menu">
        <ul class="menu">
            <li><a href="property_manage.html">楼盘管理</a></li>
            <li><a href="house_manage.html">看房团管理</a></li>
            <li class="curr"><a href="#none" onmouseover="mopen('m1')" onmouseout="mclosetime()">楼盘印象管理</a>
                <ul class="menu-xia" style="visibility:hidden;" id="m1" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">
                    <li><a href="impression_inquiry.html">房友印象查询</a></li>
                    <li><a href="impression_set.html">房友印象设置</a></li>
                    <li><a href="review.html">专家点评管理</a></li>
                </ul>
            </li>
            <li><a href="order_li.html" onmouseover="mopen('m2')" onmouseout="mclosetime()">认筹管理</a>
                <ul class="menu-xia" style="visibility:hidden;" id="m2" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">
                    <li><a href="order_li.html">认筹列表</a></li>
                    <li><a href="order.html">认筹订单</a></li>
                </ul>
            </li>
            <li><a href="photo_inquiry.html" onmouseover="mopen('m3')" onmouseout="mclosetime()">照片管理</a>
                <ul class="menu-xia" style="visibility:hidden;" id="m3" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">
                    <li><a href="photo_inquiry.html">照片查询</a></li>
                    <li><a href="photo_manage.html">照片管理</a></li>
                </ul>
            </li>
            <li><a href="new.html">多页态</a></li>
        </ul>
    </div>
</div>
<!-- 二级菜单 】】 -->
<?php echo $content; ?>
<script language="javascript" src="js/xl.js" charset="utf-8"></script>
</body>
</html>

