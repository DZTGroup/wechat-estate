<div class="cent-auto">
    <div class="box-table"><!-- 添加hide隐藏 -->
        <h3 class="orde-h">楼盘画册</h3>

        <div class="order-lb">楼盘名称：
            <?php $this->widget('EstateListWidget', array('class_name' => 'li-hd')); ?>
            <button class="btn-cha" id="J_entity_new" type="button">添加照片墙</button>
        </div>
        <div class="box-table">
            <table width="760" border="0" cellspacing="1" cellpadding="0" bgcolor="#d7d7d7" id="J_entity_table">
                <thead>
                <tr><th>楼盘ID</th><th>楼盘名称</th><th>提交时间</th><th>状态</th><th>操作</th></tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <div id="J_picture_form" style="display: none;" data-type="picture">
        <div class="com-min J_template" style="display:none;">
            <h3>照片墙<a href="javascript:;" class="J_delete" style="display:none;">删除该组</a></h3>
            <div class="tipe-lb">
                <label>图片组名称：</label>
                <input class="inp-tex inp-300 J_field" name="name" type="text"></div>
            <div class="tipe-lb"><label>图片组布局：</label>
                <select size="1" class="li-hd J_field" name="layout">
                    <option value="1">六宫格</option>
                </select>
            </div>
            <div class="tipe-lb">
                <label>图片组编辑：</label>
                <ul class="six-box">
                    <li>
                        <button class="btn-cha J_pic_title_btn" type="button">添加标题</button>
                        <input type="hidden" class="J_field" name="title">
                        <input type="hidden" class="J_field" name="subtitle">
                    </li>
                    <li>
                        <span class="load_btn"> <span class="btn-cha J_up"></span> </span>
                        <br>尺寸建议260*150
                        <div class="J_display">
                            <img src="" class="J_field" name="img1" value="">
                        </div>
                    </li>
                    <li>
                        <span class="load_btn"> <span class="btn-cha J_up"></span> </span>
                        <br>尺寸建议120*150
                        <div class="J_display">
                            <img src="" class="J_field" name="img2" value="">
                        </div>
                    </li>
                    <li>
                        <span class="load_btn"> <span class="btn-cha J_up"></span> </span>
                        <br>尺寸建议220*150
                        <div class="J_display">
                            <img src="" class="J_field" name="img3" value="">
                        </div>
                    </li>
                    <li>
                        <button class="btn-cha J_pic_desc_btn" type="button">添加简要</button>
                        <input type="hidden" class="J_field" name="desc">
                    </li>
                    <li>
                        <span class="load_btn"> <span class="btn-cha J_up"></span> </span>
                        <br>尺寸建议100*150
                        <div class="J_display">
                            <img src="" class="J_field" name="img4" value="">
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tipe-lb">
            <button class="btn-cha J_add_wall" type="button">新增一组照片</button>
        </div>
        <div class="cent-bott">
            <button class="btn-cha J_submit" type="button">完成</button>
            <button class="btn-cha J_cancel" type="button">取消</button>
        </div>
    </div>
</div>
<div class="box-layer" style="display: none;" id="J_title_layer">
    <div class="title"><h2>添加标题</h2></div>
    <a class="close J_cancel" href="javascript;;" title="关闭">关闭</a>

    <div class="tip-mian">
        <div class="p-shuju">
            <div class="layer-lb"><label>主标题：</label> <input class="inp-tex inp-300 J_title" name="" type="text"></div>
            <div class="layer-lb"><label>副标题：</label> <input class="inp-tex inp-300 J_subtitle" name="" type="text">
            </div>
        </div>
        <div class="but-auto"><a class="an-butn J_save" href="javascript:;" title="确认">确认</a> <a class="an-butn J_cancel"
                                                                                                 href="javascript:;"
                                                                                                 title="取消">取消</a></div>
    </div>
</div>
<div class="box-layer" style="display: none;" id="J_desc_layer">
    <div class="title"><h2>添加简述</h2></div>
    <a class="close J_cancel" href="javascript:;" title="关闭">关闭</a>

    <div class="tip-mian">
        <div class="p-shuju">
            <div class="layer-lb"><label>简述正文：</label> <textarea class="layer-100 J_text" name="" cols="" rows=""
                                                                 placeholder="100个字以内"></textarea></div>
        </div>
        <div class="but-auto"><a class="an-butn J_save" href="javascript:;" title="确认">确认</a> <a
                class="an-butn J_cancel" href="javascript:;" title="取消">取消</a></div>
    </div>
</div>
<div id="J_layer_bg" class="layer_bg" style="display: none;"></div>
