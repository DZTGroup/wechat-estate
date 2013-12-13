<div class="cent-auto">
    <!-- 房友印象管理【【 -->
    <div class="com-min J_estate_list">
        <h3>房友印象管理</h3>
        <div class="order-lb"><label>楼盘名称：</label>
            <?php $this->widget('EstateListWidget',array('class_name'=>'li-hd'));?>
            <button class="btn-cha" id="J_entity_new" type="button">添加新房友印象</button>
        </div>
    </div>
    <!-- 查询列表【【 -->
    <div class="box-table"><!-- 添加hide隐藏 -->
        <?php $this->widget('ImpressionTableWidget',array('id'=>'J_impression_table'));?>
    </div>
    <!-- 查询列表 】】-->
    <!-- 房友印象管理 】】-->
    <!-- 添加新房友印象 】】-->
    <div class="com-min" id="J_entity_form" data-type="impression" style="display: none;">
        <h3>增加楼房印象</h3>
<!--        <div class="order-lb"><label>所属楼盘：</label>-->
<!--            --><?php //$this->widget('EstateListWidget',array('class_name'=>'li-hd'));?>
<!--        </div>-->
        <div class="order-lb J_module" data-module="init">
            <label>初始总人数：</label> <input class="inp-tex inp-100 J_field" name="number" type="text">
        </div>
        <div class="J_modules" data-module="impressions">
        <?php
            $arr = array('1'=>'一', '2' => '二', '3' => '三', '4' => '四', '5' => '五', '6' => '六');
            for($i=0;$i<6;$i++){
        ?>
                <div class="order-lb J_module_item"><label>印象<?php echo $arr[$i+1]?>：</label> <input class="inp-tex inp-100 J_field" name="impression" type="text" placeholder="印象描述，四个字以内"> <input class="inp-tex inp-100 J_field" name="percent" type="text" placeholder="印象比例：20%"></div>
        <?php
            }

        ?>
        </div>

        <div class="cent-bott"><button class="btn-cha submit J_submit" type="button">完成</button> <button class="btn-cha J_cancel" type="button">取消</button></div>
        <div class="com-tu">效果图显示</div>
    </div>
    <!-- 添加新房友印象 】】-->
</div>