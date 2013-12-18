<div class="cent-auto">
    <!-- 认筹订单【【 -->
    <div class="com-min">
        <h3>订单查询</h3>
        <div class="order-lb"><label>楼盘名称：</label>
            <?php $this->widget('EstateListWidget', array('class_name' => 'li-hd')); ?>
        </div>
        <div class="order-lb"><label>时间选择：</label> <input type="text" maxlength="10" value="" name="" class="text-tips"><span class="ico-calendar"><!-- 日历图标 --></span> 到  <input type="text" maxlength="10" value="" name="" class="text-tips"><span class="ico-calendar"><!-- 日历图标 --></span></div>
        <div class="order-lb"><label>认筹期数：</label>
            <select size="1" class="li-hd">
                <option>请选择楼盘</option>
                <option>三个傻瓜</option>
            </select>
        </div>
        <div class="order-lb"><label>订单号：</label> <input class="inp-tex inp-300" name="" type="text"></div>
        <div class="order-lb"><label>姓名：</label> <input class="inp-tex inp-300" name="" type="text"></div>
        <div class="order-lb"><label>身份证号：</label> <input class="inp-tex inp-300" name="" type="text"></div>
        <div class="cent-bott"><button class="btn-cha" type="button">查询</button> <button class="btn-cha" type="button">下载</button></div>
        <!-- 认筹订单 】】-->
    </div>
</div>