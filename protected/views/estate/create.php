<div class="cent-auto" id="J_estate_table">
    <div class="box-table"><!-- 添加hide隐藏 -->
        <table width="760" border="0" cellspacing="1" cellpadding="0" bgcolor="#d7d7d7">
            <tbody>
            <tr>
                <th>楼盘名称</th>
                <th>楼盘ID</th>
                <th>提交时间</th>
                <th>操作</th>
            </tr>
            <?php forEach ($list as $row) { ?>
                <tr>
                    <td><?php echo $row->name ?></td>
                    <td><?php echo $row->id ?></td>
                    <td><?php echo $row->create_time ?></td>
                    <td><a class="blue J_edit" data-id="<?php echo $row->id ?>" href="javascript:;">编辑</a>
                        <a class="blue J_delete" data-id="<?php echo $row->id ?>" href="javascript:;">删除</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div class="but-righ ma-top">
            <button class="btn-cha J_new_estate" type="button">添加新楼盘</button>
        </div>
    </div>
    <div class="com-min J_estate_form" style="display: none;">
        <h3>楼盘信息</h3>

        <div class="tipe-lb">
            <label><span class="red">*</span>楼盘名称：</label>
            <input class="inp-tex inp-300 J_field" name="name" type="text">
        </div>
        <div class="tipe-lb">
            <label><span class="red">*</span>微信帐号：</label>
            <input class="inp-tex inp-300 J_field" name="wechat_id" type="text">
        </div>
        <div class="tipe-lb">
            <label><span class="red">*</span>APP ID：</label>
            <input class="inp-tex inp-300 J_field" name="app_id" type="text">
        </div>
        <div class="tipe-lb">
            <label><span class="red">*</span>APP KEY：</label>
            <input class="inp-tex inp-300 J_field" name="app_key" type="text">
        </div>
        <div class="cent-bott">
            <button class="btn-cha J_save" type="button">保存</button>
            <button class="btn-cha J_cancel" type="button">取消</button>
        </div>
    </div>
</div>