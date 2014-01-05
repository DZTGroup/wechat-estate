<div class="cent-auto">
    <div class="com-min">
        <h3>户型管理</h3>

        <div class="order-lb"><label>楼盘名称：</label>
            <?php $this->widget('EstateListWidget', array('class_name' => 'li-hd')); ?>
            <button class="btn-cha " id="J_entity_new" type="button">新增户型简介</button>
        </div>
    </div>
    <div class="box-table">
        <?php $this->widget('ImpressionTableWidget', array('id' => 'J_intro_table')); ?>
    </div>

    <div style="display: none;" id="J_apartment_form" data-type="apartment">
        <div class="com-min ">
            <h3>楼盘户型 <button class="btn-cha J_add"  type="button" style="display: inline-block;">新增户型</button></h3>
        </div>
        <div class="com-min">
            <div class="tipe-lb"><label>户型顶图：</label>
                <div><span class="load_btn"><span class="btn-cha J_upload"></span></span>
                    <div class="J_display">
                        <img src="" class="J_field" name="top_img" width="50" height="50" value="">
                    </div>
                </div>
            </div>
            <div class="J_holder">

            </div>
        <div class="cent-bott">
            <button class="btn-cha J_submit" type="button">提交</button>
            <button class="btn-cha J_cancel" type="button">取消</button>
        </div>
    </div>
</div>
