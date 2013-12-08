<div class="cent-auto">
    <!-- 认筹列表【【 -->
    <div class="box-table"><!-- 添加hide隐藏 -->
        <h3 class="orde-h">认筹查询</h3>
        <div class="order-lb">楼盘名称：
            <select size="1" class="li-hd">
                <option>请选择楼盘</option>
                <option>三个傻瓜</option>
            </select>
        </div>
        <table width="760" border="0" cellspacing="1" cellpadding="0" bgcolor="#d7d7d7">
            <tbody><tr>
                <th>认筹ID</th>
                <th>认筹名称</th>
                <th>楼盘名称</th>
                <th>认筹岂止时间</th>
                <th>提交时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            <tr>
                <td>535</td>
                <td>手法手法手法手法</td>
                <td>手法手法手法手法</td>
                <td>2012-12-1</td>
                <td>2012-12-1</td>
                <td>待审核</td>
                <td><a class="blue" href="#none">编辑</a> <a class="blue" href="#none">删除</a></td>
            </tr>
            </tbody></table>
        <div class="but-righ ma-top"><button class="btn-cha" type="button">添加新认筹</button></div>
    </div>
    <!-- 认筹列表 】】 -->
    <!-- 添加新认筹【【 -->
    <div class="com-min">
        <h3>活动说明</h3>
        <div class="tipe-lb"><label><span class="red">*</span>所属楼盘：</label>
            <select size="1" class="li-hd">
                <option>请选择楼盘</option>
                <option>0:00</option>
            </select>
        </div>
        <div class="tipe-lb"><label> .</label><button class="btn-cha" type="button">上传标题图</button> (推荐图片尺寸：720*130；图片小于100k)</div>
        <div class="tipe-lb"><label><span class="red">*</span>认筹名称：</label> <input class="inp-tex inp-300" name="" type="text"></div>
        <div class="tipe-lb"><label><span class="red">*</span>认筹开始时间：</label>
            <span class="calendar-ctrl"><input type="text" maxlength="10" value="年-月-日" name="" class="text-tips"><span class="ico-calendar"><!-- 日历图标 --></span></span>
            <select size="1" class="li-hd">
                <option>0:00</option>
                <option>0:00</option>
            </select>
        </div>
        <div class="tipe-lb"><label><span class="red">*</span>认筹截止时间：</label>
            <span class="calendar-ctrl"><input type="text" maxlength="10" value="年-月-日" name="" class="text-tips"><span class="ico-calendar"><!-- 日历图标 --></span></span>
            <select size="1" class="li-hd">
                <option>0:00</option>
                <option>0:00</option>
            </select>
        </div>
        <div class="tipe-lb"><label>标题：</label> <input class="inp-tex inp-300" name="" type="text"></div>
        <div class="tipe-lb"><label>副标题：</label> <input class="inp-tex inp-300" name="" type="text"></div>
        <div class="tipe-lb"><label>详情：</label> <textarea class="text-kuang" name="" cols="" rows="">输入350个字以内</textarea></div>
        <div class="tipe-lb"><label><span class="red">*</span>认筹须知：</label> <textarea class="text-kuang" name="" cols="" rows="">输入350个字以内</textarea></div>
        <div class="tipe-lb"><label><span class="red">*</span>用户引导提示：</label> <textarea class="text-kuang" name="" cols="" rows="">输入50个字以内</textarea></div>
    </div>
    <div class="com-min">
        <h3>认筹设置</h3>
        <div class="tipe-lb"><label><span class="red">*</span>认筹类型：</label>
            <form id="form1" name="form1" method="post" action="">
                <label class="lb-xuan"><input type="radio" name="RadioGroup1" value="单选">单选</label>
                <label class="lb-xuan"><input type="radio" name="RadioGroup1" value="单选">单选</label>
                <label class="lb-xuan"><input type="radio" name="RadioGroup1" value="单选">单选</label>
            </form>
        </div>
    </div>
    <div class="cent-bott"><button class="btn-cha" type="button">提交审核</button> <button class="btn-cha" type="button">保存草稿</button></div>
    <!-- 添加新认筹 】】 -->
</div>