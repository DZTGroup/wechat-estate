<?php
/**
 * Created by PhpStorm.
 * User: quanwang06
 * Date: 13-12-8
 * Time: 上午11:35
 */

?>
<script>
    WXAPP.AuditEstate.setAuditListData();
</script>
<div class="box-menu">
    <div class="com-menu">
        <ul class="menu">
            <li class="curr"><a href="?r=audit/estate">楼盘审核</a></li>
            <li><a href="?r=audit/group">看房团审核</a></li>
            <li><a href="photo_review.html">照片墙审核</a></li>
            <li><a href="expert_review.html">专家点评审核</a></li>
            <li><a href="chips_review.html">认筹审核</a></li>
        </ul>
    </div>
</div>
<div class="cent-auto" style="margin-top: 20px">
    <div class="order-lb">
        <label>楼盘名称</label>
        <?php $this->widget('EstateListWidget',array('class_name'=>'li-hd'));?>
    </div>
</div>
<div class="cent-auto">
    <!-- 管理列表表单【【 -->
    <div class="box-table"><!-- 添加hide隐藏 -->
        <table width="760" border="0" cellspacing="1" cellpadding="0" bgcolor="#d7d7d7" id="J_audit_group_table">
            <thead>
            <tr>
                <th>看房团名称</th>
                <th>楼盘名称</th>
                <th>提交时间</th>
                <th>看房时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- 管理列表表单 】】 -->
</div>


