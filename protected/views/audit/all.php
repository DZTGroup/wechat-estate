<?php
/**
 * Created by PhpStorm.
 * User: quanwang06
 * Date: 13-12-8
 * Time: 上午11:35
 */

?>
<script>
    $(document).ready(function(){
        WXAPP.Audit.setAllAuditData();
    });
</script>

<div class="cent-auto">

    <!-- 管理列表表单【【 -->
    <div class="box-table"><!-- 添加hide隐藏 -->
        <table width="760" border="0" cellspacing="1" cellpadding="0" bgcolor="#d7d7d7" id="J_audit_table">
            <thead>
            <tr>
                <th>楼盘ID</th>
                <th>楼盘名称</th>
                <th>审核类型</th>
                <th>提交时间</th>
                <th>操作员</th>
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