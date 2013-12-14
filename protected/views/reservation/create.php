<div class="cent-auto">
    <!-- 认筹列表【【 -->
    <div class="box-table"><!-- 添加hide隐藏 -->
        <h3 class="orde-h">认筹查询</h3>

        <div class="order-lb">楼盘名称：
            <?php $this->widget('EstateListWidget', array('class_name' => 'li-hd')); ?>
            <button class="btn-cha" id="J_entity_new" type="button">添加认筹</button>
        </div>
        <div class="box-table"><!-- 添加hide隐藏 -->
            <table width="760" border="0" cellspacing="1" cellpadding="0" bgcolor="#d7d7d7" id="J_entity_table">
                <thead>
                <tr>
                    <th>认筹ID</th>
                    <th>认筹名称</th>
                    <th>楼盘名称</th>
                    <th>认筹岂止时间</th>
                    <th>提交时间</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <div id="J_entity_form" style="display: none;" data-type="reservation" data-multiple="true">
        <div class="com-min J_module" data-module="event">
            <h3>活动说明</h3>
            <div class="tipe-lb">
                <label class="blk-none">.</label>
                <span><span class="btn-cha J_upload" type="button"></span> (推荐图片尺寸：720*130；图片小于100k)</span>
                <div class="J_display">
                    <span class="info" style="color: red;"></span>
                    <img src="" class="J_field" name="img" value="">
                </div>
            </div>

            <div class="tipe-lb">
                <label><span class="red">*</span>认筹名称：</label>
                <input class="inp-tex inp-300 J_field" name="name" type="text">
            </div>
            <div class="tipe-lb">
                <label><span class="red">*</span>认筹开始时间：</label>
                <span class="calendar-ctrl">
                    <input type="text" maxlength="10" placeholder="年-月-日" name="start_date"
                           class="text-tips J_field"><span
                        class="ico-calendar"><!-- 日历图标 --></span></span>
                <select size="1" class="li-hd J_field" name="start_time">
                    <?php
                        for($i=0;$i<24;$i++){
                    ?>
                            <option value="<?php echo $i?>:00"><?php echo $i?>:00</option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="tipe-lb">
                <label><span class="red">*</span>认筹截止时间：</label>
                <span class="calendar-ctrl">
                    <input type="text" maxlength="10" placeholder="年-月-日" name="end_date" class="text-tips J_field">
                    <span class="ico-calendar"></span></span>
                <select size="1" class="li-hd J_field" name="end_time">
                    <?php
                    for($i=0;$i<24;$i++){
                        ?>
                        <option value="<?php echo $i?>:00"><?php echo $i?>:00</option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="tipe-lb">
                <label>标题：</label>
                <input class="inp-tex inp-300 J_field" name="title" type="text">
            </div>
            <div class="tipe-lb">
                <label>副标题：</label>
                <input class="inp-tex inp-300 J_field" name="subtitle" type="text">
            </div>
            <div class="tipe-lb">
                <label>详情：</label>
                <textarea placeholder="输入350个字以内" class="text-kuang J_field" name="detail" cols="" rows=""></textarea>
            </div>
            <div class="tipe-lb">
                <label><span class="red">*</span>认筹须知：</label>
                <textarea placeholer="输入350个字以内" class="text-kuang J_filed" name="notice" cols="" rows=""></textarea>
            </div>
            <div class="tipe-lb">
                <label><span class="red">*</span>用户引导提示：</label>
                <textarea class="text-kuang J_filed" name="tip" cols="" rows="" placeholder="输入50个字以内"></textarea>
            </div>
        </div>
        <div class="com-min J_module" data-module="setting">
            <h3>认筹设置</h3>

            <div class="tipe-lb"><label><span class="red">*</span>认筹类型：</label>
                <select class="J_field" name="type">
                    <option value="1">类型1</option>
                    <option value="2">类型2</option>
                    <option value="3">类型3</option>
                </select>
            </div>
        </div>
        <div class="cent-bott">
            <button class="btn-cha J_submit" type="button">完成</button>
            <button class="btn-cha J_cancel" type="button">取消</button>
        </div>
    </div>
</div>