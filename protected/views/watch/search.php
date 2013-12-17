<div class="cent-auto">
    <!-- 房友印象查询【【 -->
    <div class="com-min">
        <h3>看房团查询</h3>
        <div class="order-lb"><label>楼盘名称：</label>
            <?php $this->widget('EstateListWidget', array('class_name' => 'li-hd')); ?>
        </div>
        <div class="order-lb">
            <label>看房团：</label>
            <select class="J_watch_list"></select>
            <button class="btn-cha J_watch_search" type="button">查询</button>
        </div>
    </div>
    <!-- 房友印象查询 】】-->
    <!-- 查询列表【【 -->
    <div class="box-table"><!-- 添加hide隐藏 -->
        <table width="760" border="0" cellspacing="1" cellpadding="0" bgcolor="#d7d7d7" id="J_visit_result">
            <thead><tr>
                <th>真实姓名</th>
                <th>随行人数</th>
                <th>电话</th>
                <th>路线</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <!-- 查询列表 】】-->
</div>