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

    <div class="com-min" id="J_expert_form" data-type="comment" style="display: none;">
        <h3>点评设置 <button class="btn-cha J_add"  type="button" style="display: inline-block;">新增专家</button></h3>

        <div class="J_expert_holder">

        </div>

        <div class="cent-bott">
            <button class="btn-cha J_submit" type="button">完成</button>
            <button class="btn-cha J_cancel" type="button">取消</button>
        </div>
    </div>

    <!-- 添加看房团 】】-->
</div>