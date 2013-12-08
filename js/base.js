window.WXAPP = window.WXAPP || {};

(function () {
    var Ajax = function (url, data, success) {
        $.ajax({
            url: url,
            data: data || {},
            type: "POST",
            dataType: 'json',
            success: function (res) {
                if (res.code === 200) {
                    success.call(this, res);
                }
            },
            error: function () {
                alert('网络出错，请重试');
            }
        });
    }
    WXAPP.Ajax = Ajax;
})();

(function () {
    var Entity = {
        save: function (estate_id, type, content, callback) {
            WXAPP.Ajax('?r=entity/ajaxsave', {
                estate_id: estate_id,
                type: type,
                content: JSON.stringify(content)
            }, callback)
        }
    }

    WXAPP.Entity = Entity;
    WXAPP.EMPTY_ESTATE = -1;
})();


(function () {
    //房友印象

    var Impression = function (form) {
        this.form = form;
    };
    Impression.prototype.save = function () {
        if (!this.check()) {
            return;
        }
        var data = this.getData();
        var estate_id = data.estate_id;
        delete data.estate_id;
        WXAPP.Entity.save(estate_id, 'impression', data, function (res) {
            alert('创建成功');
            location.reload();
        });
    };
    Impression.prototype.check = function () {
        var data = this.getData();
        if (!data.estate_id || data.estate_id == WXAPP.ENPTY_ESTATE) {
            alert('请选择楼盘');
            return false;
        }
        if (!data.number) {
            alert('请填写初识总人数');
            return false;
        }
        return true;
    };
    Impression.prototype.getData = function () {
        var estate_id = this.form.find('.J_estate_list').val(),
            num = this.form.find('.J_num').val().trim(),
            impressions = this.form.find('.J_impression');
        var imp = [];
        impressions.each(function (i, item) {
            var impression = $(item).find('.J_impression_input').val().trim(),
                percent = $(item).find('.J_percent_input').val().trim();
            if (impression && percent) {
                imp.push({
                    impression: impression,
                    percent: percent
                });
            }
        });

        return {
            estate_id: estate_id,
            number: num,
            impressions: imp
        }
    }
    Impression.prototype.setData = function (data) {
        var content , estate_id;
        if (!data) {
            return;
        }
        if (data.content) {
            content = JSON.parse(data.content);
        }
        if (data.estate_id) {
            estate_id = data.estate_id;
        }
        this.form.find('.J_estate_list').val(estate_id);
        if (content) {
            this.form.find('.J_num').val(content.number || '');
            var impressions = this.form.find('.J_impression');
            content.impressions && content.impressions.length && content.impressions.forEach(function (im, i) {
                impressions.eq(i).find('.J_impression_input').val(im.impression);
                impressions.eq(i).find('.J_percent_input').val(im.percent);
            });
        }

    }

    WXAPP.Impression = Impression;
})();

(function () {
    //新增房友印象页面逻辑
    var impressionForm = $('#J_new_impression');
    if (!impressionForm.length) {
        return;
    }
    var ip = new WXAPP.Impression(impressionForm);
    impressionForm.find('.submit').click(function () {
        ip.save();
    });

    //点击新增
    $('.J_new_impression').click(function () {
        impressionForm.show();
        var selectedEstate = $(this).parent().find('.J_estate_list').val();
        if (selectedEstate != WXAPP.EMPTY_ESTATE) {
            WXAPP.Ajax('?r=entity/ajaxgetentitybyestateid', {
                estate_id: selectedEstate,
                type: "impression"
            }, function (res) {
                ip.setData(res.data);
            });
        }

    });

    //change 列表
    $('.J_new_impression').parent().find('.J_estate_list').change(function(){
        var id = $(this).val();
        WXAPP.Ajax('?r=entity/ajaxgetentitiesbyestateid',{
            estate_id:id,
            type:'impression'
        },function(res){
            var table = $('#J_impression_table tbody');
            var map = {
                0:'未审核',
                1:'已审核'
            }
            table.empty();
            res.data.forEach(function(item){
                table.append('<tr><td>'+item.estate_id+'</td><td>'+item.estate_name+'</td><td>'+item.create_time+'</td><td>'+map[item.status]+'</td><td><a class="blue J_edit" href="javascript:;" data-id="'+item.id+'">编辑</a>'+(item.status=='0'?'<a class="blue J_delete" href="javascript:;" data-id="'+item.id+'">删除</a>':'')+'</td></tr>')
            });
            table.find('.J_edit').click(function(){
                var id = $(this).attr('data-id');
                WXAPP.Ajax('?r=entity/ajaxgetentitybyid',{
                    id:id
                },function(res){
                    impressionForm.show();
                    ip.setData(res.data);
                });
            });
        });
    });
})();



(function(){
    //楼盘Class
    function Estate(form){
        this.form = form;
    }
    Estate.prototype.save = function(id){
        if(this.check()){
            var data = this.getData();
            if(this.id){
                data.id = this.id;
            }
            WXAPP.Ajax('?r=estate/ajaxsave',data,function(){
                alert('保存成功');
                location.reload();
            });
        }
    }
    Estate.prototype.check = function(){
        var data = this.getData();
        for(var key in data){
            if(data.hasOwnProperty(key)){
                if(!data[key]){
                    alert('请填写'+key);
                    return false;
                }
            }
        }
        return true;
    }
    Estate.prototype.getData = function(){
        var data = {};
        this.form.find('.J_field').each(function(i,item){
            data[$(item).attr('name')] = $(item).val();
        })
        return data;
    }
    Estate.prototype.setData = function(data){
        this.form.find('.J_field').each(function(i,item){
            $(item).val(data[$(item).attr('name')] || '');
        });
    }
    Estate.prototype.empty = function(){
        this.form.find('.J_field').each(function(i,item){
            $(item).val('');
        })
    }
    Estate.prototype.setId = function(id){
        this.id = id;
    }

    WXAPP.Estate = Estate;
})();
(function(){
    //楼盘管理
    var table = $('#J_estate_table');
    if(!table.length){
        return ;
    }

    var estate = new WXAPP.Estate($('.J_estate_form'));

    //编辑
    table.find('.J_edit').click(function(){
        var id = $(this).attr('data-id')
        WXAPP.Ajax('?r=estate/ajaxgetestatebyid',{
            id:id
        },function(res){
            estate.form.show();
            estate.setData(res.data);
            estate.setId(id);
        });
    });
    //删除
    table.find('.J_delete').click(function(){
        if(confirm('确定要删除该楼盘吗？删除后无法恢复！')){
            WXAPP.Ajax('?r=estate/ajaxdelete',{
                id:$(this).attr('data-id')
            },function(res){
                alert('删除成功!');
                location.reload();
            });
        }
    });
    //新增
    table.find('.J_new_estate').click(function(){
        estate.empty();
        estate.setId(null);
        estate.form.show();
    });
    //保存
    estate.form.find('.J_save').click(function(){
        estate.save();
    });
    //取消
    estate.form.find('.J_cancel').click(function(){
        estate.form.hide();
    });
})();
(function(){
    var AuditEstate = {
        setAuditListData:function(){
            WXAPP.Ajax('?r=audit/ajaxgetauditestatedata',{
                type:'estate'
            },function(res){
                var table = $('#J_audit_estate_table tbody');
                var map = {
                    0:'待审核'
                }
                table.empty();
                res.data.forEach(function(item){
                    table.append('<tr><td>'+item.estate_id+'</td>' +
                        '<td>'+item.name+'</td><td>'
                        +item.create_time+'</td><td>'
                        +item.username+'</td><td>'
                        +map[item.entity_status]
                        +'</td><td><a class="blue J_detail" href="javascript:;" data-id="'+item.id
                        +'" entity-id="'+item.entity_id+'">详情</a>'
                        +'<a class="blue J_pass" href="javascript:;" data-id="'+item.id
                        +'" entity-id="'+item.entity_id+'">通过</a>'
                        +'<a class="blue J_fail" href="javascript:;" data-id="'+item.id
                        +'" entity-id="'+item.entity_id+'">驳回</a>'
                        +'</td></tr>')
                });
                table.find('.J_pass').click(function(){
                    var id = $(this).attr('data-id');
                    var entity_id=$(this).attr('entity-id');
                    WXAPP.Ajax('?r=audit/ajaxupdateauditbyid',{
                        id:id,status:1,entity_id:entity_id
                    },function(res){
                        if(res.code==200){
                            alert('审核成功！');
                        }
                    });
                });

                table.find('.J_fail').click(function(){
                    var id = $(this).attr('data-id');
                    var entity_id=$(this).attr('entity-id');
                    WXAPP.Ajax('?r=audit/ajaxupdateauditbyid',{
                        id:id,status:2,entity_id:entity_id
                    },function(res){
                        if(res.code==200){
                            alert('已驳回！');
                        }
                    });
                });
            });
        }
    };
    WXAPP.AuditEstate = AuditEstate;
})();

