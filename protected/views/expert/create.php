<div class="cent-auto">
    <!-- 专家点评查询【【 -->
    <div class="com-min">
        <h3>专家点评查询</h3>

        <div class="order-lb"><label>楼盘名称：</label>
            <?php $this->widget('EstateListWidget', array('class_name' => 'li-hd')); ?>
            <button class="btn-cha" id="J_entity_new" type="button">添加专家点评</button>
        </div>
    </div>
    <div class="box-table"><!-- 添加hide隐藏 -->
        <?php $this->widget('ImpressionTableWidget', array('id' => 'J_impression_table')); ?>
    </div>

    <div class="com-min" id="J_entity_form" data-type="comment" style="display: none;">
        <h3>点评设置</h3>

        <div class="J_module" data-module="expert">
            <div class="tipe-lb "><label>专家名字：</label> <input class="inp-tex inp-300 J_field" name="name" type="text">
            </div>
            <div class="tipe-lb"><label>专家头街：</label> <input class="inp-tex inp-300 J_field" name="title" type="text">(10个字以内)
            </div>
            <div class="tipe-lb"><label>专家介绍：</label> <textarea class="text-kuang J_field" name="desc" cols="" rows="">100个字以内</textarea>
            </div>
            <div class="tipe-lb"><label>点评标语：</label> <input class="inp-tex inp-300 J_field" name="c_title" type="text">(15个字以内)
            </div>
            <div class="tipe-lb"><label>点评内容：</label> <textarea class="text-kuang J_field" name="c_content" cols=""
                                                                rows="">100个字以内</textarea></div>
        </div>
        <div class="cent-bott">
            <button class="btn-cha J_submit" type="button">完成</button>
            <button class="btn-cha J_cancel" type="button">取消</button>
        </div>
    </div>

    <!-- 添加看房团 】】-->
</div>