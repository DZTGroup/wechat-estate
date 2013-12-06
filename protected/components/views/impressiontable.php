<table width="760" border="0" cellspacing="1" cellpadding="0" bgcolor="#d7d7d7">
    <tbody><tr>
        <th>楼盘ID</th>
        <th>楼盘名称</th>
        <th>提交时间</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    <?php
        function getStatus($s){
            $arr = array(
                '0'=>'初始化'
            );
            return $arr[$s];
        }
        forEach($model as $impression){
    ?>
        <tr>
            <td><?php echo $impression->estate_id;?></td>
            <td></td>
            <td><?php echo $impression->create_time ;?></td>
            <td><?php echo getStatus($impression->status);?></td>
            <td><a class="blue" href="javascript:;" data-id="<?php $impression->id?>">编辑</a> <a class="blue" href="javascript:;" data-id="<?php $impression->id?>">删除</a></td>
        </tr>

    <?php }?>
    </tbody>
</table>