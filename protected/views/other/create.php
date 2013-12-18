<div class="cent-auto">
    <div class="com-min">
        <h3>其他</h3>

        <div class="order-lb J_other"><label>楼盘名称：</label>
            <?php $this->widget('EstateListWidget', array('class_name' => 'li-hd')); ?>
        </div>
    </div>
    <div class="box-table"><!-- 添加hide隐藏 -->
        <table width="760" border="0" cellspacing="1" cellpadding="0" bgcolor="#d7d7d7">
            <thead>
                <tr>
                    <th colspan="2">照片墙</th>
                    <th rowspan="2">论坛链接</th>
                </tr>
                <tr>
                    <th>菜单项链接</th>
                    <th>微信Message后台链接</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $list = $this->getAppids(Yii::app()->user->getUserId());
                foreach($list as $item){
            ?>
                    <tr style="display: none;" data-id="<?php echo $item['id'];?>">
                        <td>http://www.weixinfc.com/wechat-estate/index.php?r=userpicwall/list&estate_id=<?php echo $item['id'];?></td>
                        <td>http://www.weixinfc.com/wechat-estate/message.php?estate_id=<?php echo $item['id'];?></td>
                        <td>http://www.weixinfc.com/weapp/php/cgi/jump.php?eid=32&appid=<?php echo $item['app_id']; ?>&t=bbs</td>
                    </tr>
            <?php
                }
            ?>

            </tbody>
        </table>
    </div>
    <br />
    <p>请自行配置到微信MP后台</p>



    <!-- 添加看房团 】】-->
</div>