<div class="cent-auto">
    <div class="cent-data">
        <h3>页面统计</h3>
        <div class="order-lb"><label>楼盘名称：</label>
            <?php $this->widget('EstateListWidget', array('class_name' => 'li-hd','all'=>true)); ?>
        </div>
        <div class="com-rq">
            <span class="calendar-ctrl"><input type="text" maxlength="10" placeholder="选择日期" name="" class="text-tips J_start"><span class="ico-calendar"><!-- 日历图标 --></span></span> 到
            <span class="calendar-ctrl"><input type="text" maxlength="10" placeholder="选择日期" name="" class="text-tips J_end"><span class="ico-calendar"><!-- 日历图标 --></span></span>
            <button class="btn-cha J_search_pv" type="button">查询</button>
        </div>
        <!--  页面统计表单【【 -->
        <div class="box-table">
            <table width="760" border="0" cellspacing="1" cellpadding="0" bgcolor="#d7d7d7" id="J_pv_table">
                <thead><tr>
                    <th>页面名称</th>
                    <th>访问人数</th>
                    <th>访问次数</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <!--  页面统计表单 】】 -->
    </div>
</div>