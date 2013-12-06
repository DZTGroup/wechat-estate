<div class="cent-auto">
    <!-- 房友印象管理【【 -->
    <div class="com-min">
        <h3>房友印象管理</h3>
        <div class="order-lb"><label>楼盘名称：</label>
            <?php $this->widget('EstateListWidget',array('class_name'=>'li-hd'));?>
            <button class="btn-cha" type="button">添加新房友印象</button>
        </div>
    </div>
    <!-- 查询列表【【 -->
    <div class="box-table"><!-- 添加hide隐藏 -->
        <?php $this->widget('ImpressionTableWidget',array('estate_id'=>'-1'));?>
    </div>
    <!-- 查询列表 】】-->
    <!-- 房友印象管理 】】-->
    <!-- 添加新房友印象 】】-->
    <div class="com-min">
        <h3>增加楼房印象</h3>
        <div class="order-lb"><label>所属楼盘：</label>
            <?php $this->widget('EstateListWidget',array('class_name'=>'li-hd'));?>

        </div>
        <div class="order-lb"><label>初始总人数：</label> <input class="inp-tex inp-100" name="" type="text"></div>
        <div class="order-lb"><label>印象一：</label> <input class="inp-tex inp-100" name="" type="text" placeholder="印象描述，四个字以内"> <input class="inp-tex inp-100" name="" type="text" placeholder="印象比例：20%"></div>
        <div class="order-lb"><label>印象二：</label> <input class="inp-tex inp-100" name="" type="text" placeholder="印象描述，四个字以内"> <input class="inp-tex inp-100" name="" type="text" placeholder="印象比例：20%"></div>
        <div class="order-lb"><label>印象三：</label> <input class="inp-tex inp-100" name="" type="text" placeholder="印象描述，四个字以内"> <input class="inp-tex inp-100" name="" type="text" placeholder="印象比例：20%"></div>
        <div class="order-lb"><label>印象四：</label> <input class="inp-tex inp-100" name="" type="text" placeholder="印象描述，四个字以内"> <input class="inp-tex inp-100" name="" type="text" placeholder="印象比例：20%"></div>
        <div class="order-lb"><label>印象五：</label> <input class="inp-tex inp-100" name="" type="text" placeholder="印象描述，四个字以内"> <input class="inp-tex inp-100" name="" type="text" placeholder="印象比例：20%"></div>
        <div class="order-lb"><label>印象六：</label> <input class="inp-tex inp-100" name="" type="text" placeholder="印象描述，四个字以内"> <input class="inp-tex inp-100" name="" type="text" placeholder="印象比例：20%"></div>
        <div class="cent-bott"><button class="btn-cha" type="button">完成</button> <button class="btn-cha" type="button">取消</button></div>
        <div class="com-tu">效果图显示</div>
    </div>
    <!-- 添加新房友印象 】】-->
</div>