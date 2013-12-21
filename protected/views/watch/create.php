<div class="cent-auto">
    <!-- 认筹列表【【 -->
    <div class="box-table"><!-- 添加hide隐藏 -->
        <h3 class="orde-h">看房团查询</h3>

        <div class="order-lb">楼盘名称：
            <?php $this->widget('EstateListWidget', array('class_name' => 'li-hd')); ?>
            <button class="btn-cha" id="J_entity_new" type="button">添加看房团</button>
        </div>
        <div class="box-table"><!-- 添加hide隐藏 -->
            <table width="760" border="0" cellspacing="1" cellpadding="0" bgcolor="#d7d7d7" id="J_entity_table">
                <thead><tr> <th>看房团名称</th> <th>楼盘名称</th> <th>看房时间</th> <th>提交时间</th> <th>状态</th> <th>操作</th> </tr> </thead>
                <tbody></tbody>
            </table>
        </div>

    </div>
    <div id="J_watch_form" style="display: none;" data-type="group" data-multiple="true">
        <div class="com-min J_module" data-module="title_setting">
            <h3>标题设置</h3>
            <?php $this->widget('UploadWidget');?>
            <div class="tipe-lb"><label><span class="red">*</span>标题文案：</label> <input class="inp-tex inp-300 J_field" name="title" type="text"></div>
            <div class="tipe-lb"><label>期数：</label> <input class="inp-tex inp-300 J_field" name="session" type="text"></div>
        </div>
        <div class="com-min J_module" data-module="event">
            <h3>活动说明</h3>
            <div class="tipe-lb">
                <label>报名开始时间：</label>
                <span class="calendar-ctrl">
                    <input type="text" maxlength="10" placeholder="年-月-日" name="sign_start_date" class="text-tips J_field">
                    <span class="ico-calendar"></span>
                </span>
                <select size="1" class="li-hd J_field" name="sign_start_time">
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
                <label>报名截止时间：</label>
                <span class="calendar-ctrl">
                    <input type="text" maxlength="10" placeholder="年-月-日" name="sign_end_date" class="text-tips J_field">
                    <span class="ico-calendar"></span>
                </span>
                <select size="1" class="li-hd J_field" name="sign_end_time">
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
                <label>看房截止时间：</label>
                <span class="calendar-ctrl">
                    <input type="text" maxlength="10" placeholder="年-月-日" name="watch_end_date" class="text-tips J_field">
                    <span class="ico-calendar"></span>
                </span>
                <select size="1" class="li-hd J_field" name="watch_end_time">
                    <?php
                    for($i=0;$i<24;$i++){
                        ?>
                        <option value="<?php echo $i?>:00"><?php echo $i?>:00</option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="tipe-lb"><label>活动优惠：</label> <textarea class="text-kuang J_field" name="discount" cols="" rows="" placeholder="150个字以内"></textarea></div>
            <div class="tipe-lb"><label>看房须知：</label> <textarea class="text-kuang J_field" name="notice" cols="" rows="" placeholder="400个字以内"></textarea></div>
            <div class="tipe-lb"><label>看房声明：</label> <textarea class="text-kuang J_field" name="announce" cols="" rows="" placeholder="400个字以内"></textarea></div>
        </div>
        <div class="com-min J_modules " data-module="lines">
            <h3>参团线路</h3>
            <div class="J_lines">
            <div class="J_module_item">
                <div class="tipe-lb"><label>线路名称：</label> <input class="inp-tex J_field" name="name" type="text"><a class="J_del_line" href="javascript:;">删除线路</a></div>
                <div class="tipe-lb"><label>说明：</label> <textarea class="text-kuang J_field" name="tip" cols="" rows="" placeholder="500个字以内"></textarea></div>
            </div>
            </div>



        </div>
        <div class="com-min"><button class="btn-cha J_add_line" type="button">添加参团路线</button></div>

        <div class="cent-bott">
            <button class="btn-cha J_submit" type="button">完成</button>
            <button class="btn-cha J_cancel" type="button">取消</button>
        </div>
    </div>
</div>