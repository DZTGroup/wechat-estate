<div class="cent-auto">
    <!-- 房友印象查询【【 -->
    <div class="com-min">
        <h3>房友印象查询</h3>
        <div class="order-lb"><label>楼盘名称：</label>
            <?php $this->widget('EstateListWidget', array('class_name' => 'li-hd')); ?>
        </div>
        <div class="order-lb">
            <label>时间选择：</label>
            <input type="text" maxlength="10" value="" name="" class="text-tips"><span class="ico-calendar"><!-- 日历图标 --></span> 到  <input type="text" maxlength="10" value="" name="" class="text-tips"><span class="ico-calendar"><!-- 日历图标 --></span>
            <button class="btn-cha J_im_search" type="button">查询</button>
        </div>
    </div>
    <!-- 房友印象查询 】】-->
    <!-- 查询列表【【 -->
    <div class="box-table"><!-- 添加hide隐藏 -->
        <table width="760" border="0" cellspacing="1" cellpadding="0" bgcolor="#d7d7d7" id="J_im_result">
            <thead><tr>
                <th>用户ID</th>
                <th>昵称</th>
                <th>印象</th>
                <th>创建时间</th>
            </tr>
            </thead>
        <tbody></tbody>
        </table>
        <div class="but-righ ma-top"><button class="btn-cha" type="button">下载数据</button></div>
    </div>
    <!-- 查询列表 】】-->
</div>