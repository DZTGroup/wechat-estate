<div class="cent-auto">
    <div class="com-min">
        <h3>楼盘简介管理</h3>
        <div class="order-lb"><label>楼盘名称：</label>
            <?php $this->widget('EstateListWidget',array('class_name'=>'li-hd'));?>
            <button class="btn-cha " id="J_entity_new" type="button">新增楼盘简介</button>
        </div>
    </div>
    <div class="box-table">
        <?php $this->widget('ImpressionTableWidget',array('id'=>'J_intro_table'));?>
    </div>

    <div style="display: none;" id="J_entity_form" data-type="intro">
    <div class="com-min" >
        <h3>楼盘详情顶页</h3>
        <div class="tipe-lb">
            <label class="blk-none">.</label>
            <span style="" class="btn-cha J_upload" type="button">上传标题图</span> (推荐图片尺寸：720*175；图片小于100k)</div>
    </div>
    <!--
    <div class="com-min J_module" data-module="shop_info" >
        <h3>商家联系信息</h3>
        <div class="tipe-lb"><label>姓名：</label> <input class="inp-tex inp-300 J_field" name="name" type="text"></div>
        <div class="tipe-lb"><label>QQ号：</label> <input class="inp-tex inp-300 J_field" name="qq" type="text"></div>
        <div class="tipe-lb"><label>手机：</label> <input class="inp-tex inp-300 J_field" name="mobile" type="text"></div>
    </div>
    -->
        <div class="com-min J_module" data-module="saling_info">
            <h3>楼盘简介</h3>

            <div class="tipe-lb">
                <label>正文：</label>
                <textarea class="text-kuang J_field" name="text" cols="" rows="" placeholder="500字以内"></textarea>
            </div>
        </div>
    <div class="com-min J_module" data-module="intro_info">
        <h3>项目简介</h3>
        <div class="tipe-lb">
            <label>正文：</label>
            <textarea class="text-kuang J_field" name="text" cols="" rows="" placeholder="500字以内"></textarea>
        </div>
    </div>
    <div class="com-min J_module" data-module="location_info">
        <h3>地图</h3>
        <div class="tipe-lb"><label>经度：</label> <input class="inp-tex inp-300 J_field" name="lng" type="text"></div>
        <div class="tipe-lb"><label>纬度：</label> <input class="inp-tex inp-300 J_field" name="lat" type="text"></div>
        <div class="tipe-lb"><label>地址：</label> <input class="inp-tex inp-300 J_field" name="address" type="text">
    </div>
    </div>
    <!--
    <div class="com-min">
        <h3>户型介绍</h3>
        <div class="tipe-lb"><label class="blk-none">.</label> <button class="btn-cha" type="button">上传标题图</button> (推荐图片尺寸：720*130；图片小于100k)</div>
        <div class="tipe-lb"><label class="blk-none">.</label> <button class="btn-cha" type="button">添加新户型</button></div>
    </div>
    -->
    <div class="com-min J_module" data-module="video_info">
        <h3>视频</h3>
        <div class="tipe-lb"><label>视频名称：</label> <input class="inp-tex inp-300 J_field" name="name" type="text"></div>
        <div class="tipe-lb"><label>腾讯视频链接：</label> <input class="inp-tex inp-300 J_field" name="link" type="text"></div>
        <div class="tipe-lb"><label>正文：</label> <textarea class="text-kuang J_field" name="text" cols="" rows="" placeholder="250个字以内"></textarea></div>
    </div>
    <div class="com-min" data-module="traffic_info">
        <h3>周边交通</h3>
        <div class="tipe-lb"><label>正文：</label> <textarea class="text-kuang J_field" name="text" cols="" rows="" placeholder="400个字以内"></textarea></div>
    </div>
        <!--
    <div class="com-min J_module" data-module="share_info">
        <h3>推广分享</h3>
        <div class="tipe-lb"><label>.</label> <button class="btn-cha J_upload" type="button">上传标题图</button> (推荐图片尺寸：720*130；图片小于100k)</div>
        <div class="tipe-lb"><label>分享标题：</label> <input class="inp-tex inp-300 J_field" name="title" type="text"></div>
        <div class="tipe-lb"><label>简单描述：</label> <input class="inp-tex inp-300 J_field" name="desc" type="text"></div>
        <div class="tipe-lb"><label>正文：</label> <textarea class="text-kuang J_field" name="text" cols="" rows="">250个字以内</textarea></div>
    </div>
    -->
    <div class="cent-bott"><button class="btn-cha J_submit" type="button">提交</button> <button class="btn-cha J_cancel" type="button">取消</button></div>
    </div>
</div>