<div class="cent-auto">
    <div class="com-min">
        <h3>多业态管理</h3>

        <div class="order-lb"><label>楼盘名称：</label>
            <?php $this->widget('EstateListWidget', array('class_name' => 'li-hd')); ?>
            <button class="btn-cha" id="J_entity_new" type="button">添加多业态</button>
        </div>
    </div>
    <div class="box-table"><!-- 添加hide隐藏 -->
        <?php $this->widget('ImpressionTableWidget', array('id' => 'J_impression_table')); ?>
    </div>

    <div class="com-min" id="J_ad_form" data-type="advertise" style="display: none;">
        <div class="tipe-lb J_module J_intro" data-module="intro" >
            <div class="tipe-lb">
                <span><span class="btn-cha J_upload" type="button"></span></span>
                <div class="J_display">
                    <span class="info" style="color: red;"></span>
                    <img src="" class="J_field" name="img" value="">
                </div>
            </div>
            <div class="tipe-lb">
                <label>添加多业态标题：</label>
                <input type="text" class="J_field" name="title">
            </div>
            <div class="tipe-lb">
                <label>添加多业态简介：</label>
                <textarea class="text-kuang J_field" name="desc" cols="" rows=""></textarea>
            </div>
        </div>
        <div class="J_list">

        </div>
        <div class="J_edit_holder"></div>

        <div class="cent-bott">
            <button class="btn-cha J_add" type="button">添加业态</button>
            <button class="btn-cha J_submit" type="button">完成</button>
            <button class="btn-cha J_cancel" type="button">取消</button>
        </div>
    </div>

    <!-- 添加看房团 】】-->
</div>