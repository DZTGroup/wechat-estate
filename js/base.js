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
    function Entity(type,form,table,newBtn,options){
        this.type = type;
        this.form = form;
        this.table = table;
        this.newBtn = newBtn;
        this.options = {};
        options = options || {};
        for(var op in options){
            this.options[op] = options[op];
        }
        this.bindEvent();
        this.mode = 'insert'; // or update

    }
    Entity.prototype.bindEvent = function(){
        var self = this;
        this.newBtn.click(function(){
            var selectedEstate = $(this).parent().find('.J_estate_list').val();
            if(selectedEstate==WXAPP.EMPTY_ESTATE){
                alert('请选择楼盘');
                return;
            }
            self.mode='insert';
            self.setEstateId(selectedEstate);
            //self.fetch();
            self.empty();
            self.form.show();
        });
        this.newBtn.parent().find('.J_estate_list').change(function(){
            if(!self.options.multiple){
                self.newBtn.hide();
            }
            self.form.hide();
            var id = $(this).val();
            self.setEstateId(id);
            self.fetchList();
        });
        this.form.find('.J_submit').click(function(){
            self[self.mode]();
        });
        this.form.find('.J_cancel').click(function(){
            self.form.hide();
        });

    }
    Entity.prototype.insert = function(callback){
        if(!this.check()){
            return;
        }
        WXAPP.Ajax('?r=entity/ajaxinsert', {
            estate_id: this.estate_id,
            type: this.type,
            content: JSON.stringify(this.getData())
        }, callback || function(){
            alert('创建成功');
          // location.reload();
        });
    }
    Entity.prototype.update = function(callback){
        if(!this.check()){
            return;
        }
        WXAPP.Ajax('?r=entity/ajaxupdate', {
            id:this.id,
            content: JSON.stringify(this.getData())
        }, callback || function(){
            alert('修改成功');
            // location.reload();
        });
    }
    Entity.prototype.check = function(){
        return true;
    }
    Entity.prototype.getData = function(){
        var data = {};
        this.form.find('.J_modules').each(function(i,module){
            var moduleName = $(module).attr('data-module');
            data[moduleName] = [];
            $(module).find('.J_module_item').each(function(j,item){
                var itemData = {};
                $(item).find('.J_field').each(function(k,field){
                    itemData[$(field).attr('name')] = $(field).val();
                });
                data[moduleName].push(itemData);
            });
        });
        this.form.find(".J_module").each(function(i,module){
            var moduleName = $(module).attr('data-module');
            data[moduleName] = {};
            $(module).find('.J_field').each(function(j,field){
                data[moduleName][$(field).attr('name')] = $(field).val();
            });
        });
        return data;
    }
    Entity.prototype.setData = function(data){
        var content ;
        if (!data) {
            return;
        }
        if(data.estate_id){
            this.estate_id = data.estate_id;
        }
        if (data.content) {
            content = JSON.parse(data.content);
        }
        if (content) {
            this.form.find('.J_modules').each(function(i,module){
                var moduleName = $(module).attr('data-module');
                var moduleData = content[moduleName];
                $(module).find('.J_module_item').each(function(j,item){
                    var itemData = moduleData[j];
                    if(itemData){
                        $(item).find('.J_field').each(function(k,field){
                            $(field).val(itemData[$(field).attr('name')]) ;
                        });
                    }
                });
            });
            this.form.find('.J_module').each(function(i,module){
                var moduleName = $(module).attr('data-module');
                var moduleData  = content[moduleName] ;
                if(moduleData){
                    $(module).find('.J_field').each(function(j,field){
                        $(field).val(moduleData[$(field).attr('name')]);
                    });
                }

            });
        }
    }
    Entity.prototype.setEstateId = function(id){
        this.estate_id = id;
    }
    Entity.prototype.setId = function(id){
        this.id = id;
    }
    Entity.prototype.fetchList = function(){
        var self = this;
        WXAPP.Ajax('?r=entity/ajaxgetentitiesbyestateid',{
            estate_id:this.estate_id,
            type:this.type
        },function(res){
            self.renderList(res);
        });
    }
    Entity.prototype.renderList = function(res){
        var self = this;
        self.table.empty();
        var hasUnChecked = false;
        res.data.forEach(function(item){
            if(item.status=='0'){
                hasUnChecked = true;
            }
            self.table.append(self.tableTemplate.call(self,item));
        });
        if(!hasUnChecked){
            self.newBtn.show();
        }
        self.table.find('.J_edit').click(function(){
            self.mode='update';
            var id = $(this).attr('data-id');
            self.setId(id);
            WXAPP.Ajax('?r=entity/ajaxgetentitybyid',{
                id:id
            },function(res){
                self.form.show();
                self.setData(res.data);
            });
        });
    }
    Entity.prototype.getStatus = function(code){
        var status = {
            0:'未审核',
            1:'已审核',
            2:'驳回',
            3:'已过期'
        }
        return status[code];

    }
    Entity.prototype.empty = function(){
        this.form.find('input').val('');
        this.form.find('textarea').val('');
    }
    Entity.prototype.tableTemplate = function(item){
        return '<tr><td>'+item.estate_id+'</td><td>'+item.estate_name+'</td><td>'+item.create_time+'</td><td>'+this.getStatus(item.status)+'</td><td><a class="blue J_edit" href="javascript:;" data-id="'+item.id+'">编辑</a></td></tr>';
    }

    WXAPP.Entity = Entity;
    WXAPP.EMPTY_ESTATE = -1;
})();


(function(){
    //Entity 页面初始化
    var form = $('#J_entity_form'),
        newBtn = $('#J_entity_new'),
        table = $('#J_entity_table tbody');
    var entity = new WXAPP.Entity(form.attr('data-type'),form,table ,newBtn,{
        multiple:form.attr('data-multiple')==="true"
    });
    if(entity.type=="reservation"){
        entity.tableTemplate = function(item){
            var content = JSON.parse(item.content);
            return '<tr><td>'+item.id+'</td><td>'+content.event.name+'</td><td>'+item.estate_name+'</td><td>'+content.event.start_date+'-'+content.event.end_date+'</td><td>'+item.create_time+'</td><td>'+this.getStatus(item.status)+'</td><td><a class="blue J_edit" href="javascript:;" data-id="'+item.id+'">编辑</a></td></tr>';
        }
    }
    if(entity.type=="group"){
        entity.tableTemplate = function(item){
            var content = JSON.parse(item.content);
            return '<tr><td>'+content.title_setting.title+'</td><td>'+item.estate_name+'</td><td>'+content.event.watch_end_date+'前</td><td>'+item.create_time+'</td><td>'+this.getStatus(item.status)+'</td><td><a class="blue J_edit" href="javascript:;" data-id="'+item.id+'">编辑</a></td></tr>';
        }
    }
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
                type:'intro'
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
                        +'" entity-id="'+item.entity_id
                        +'" estate-id="'+item.estate_id
                        +'" entity-type="'+item.entity_type+'">通过</a>'
                        +'<a class="blue J_fail" href="javascript:;" data-id="'+item.id
                        +'" entity-id="'+item.entity_id+'">驳回</a>'
                        +'</td></tr>')
                });
                table.find('.J_pass').click(function(){
                    var id = $(this).attr('data-id');
                    var entity_id=$(this).attr('entity-id');
                    var estate_id=$(this).attr('estate-id');
                    var entity_type=$(this).attr('entity-type');
                    WXAPP.Ajax('?r=audit/ajaxupdateauditbyid',{
                        id:id,status:1,entity_id:entity_id,estate_id:estate_id,entity_type:entity_type
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

(function(){
    $('.J_audit').find('.J_estate_list').change(function(){
        var id = $(this).val();
        WXAPP.Ajax('?r=audit/ajaxgetauditimpressionbyestateid',{
            estate_id:id,
            entity_type:'impression'
        },function(res){
            var table = $('#J_audit_table tbody');
            var map = {
                0:'未审核'
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
    });
})();

(function(){
    var AuditAdmin={
        listAllPassedData:function(){
            WXAPP.Ajax('?r=audit/ajaxgetauditpasseddata',{

            },function(res){
                var table = $('#J_audit_list_all_passed_data_table tbody');
                var map = {
                    1:'审核通过',
                    'intro':'楼盘',
                    'apartment':'户型',
                    'group':'看房团',
                    'picture':'照片墙',
                    'reservation':'认筹',
                    'comment':'专家建议'

                }
                table.empty();
                res.data.forEach(function(item){
                    table.append('<tr><td>'+item.estate_id+'</td>' +
                        '<td>'+item.name+'</td><td>'
                        +map[item.entity_type]+'</td><td>'
                        +item.create_time+'</td><td>'
                        +map[item.entity_status]
                        +'</td><td><a class="blue J_detail" href="javascript:;" data-id="'+item.id
                        +'" entity-id="'+item.entity_id+'">详情</a>'
                        +'</td></tr>')
                });
            });
        }
    }

    WXAPP.AuditAdmin=AuditAdmin;
})();

(function(){
    function successCallBack(res){
        var table = $('#J_audit_table tbody');
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
                +'" entity-id="'+item.entity_id
                +'" estate-id="'+item.estate_id
                +'" entity-type="'+item.entity_type+'">通过</a>'
                +'<a class="blue J_fail" href="javascript:;" data-id="'+item.id
                +'" entity-id="'+item.entity_id+'">驳回</a>'
                +'</td></tr>')
        });
        table.find('.J_pass').click(function(){
            var id = $(this).attr('data-id');
            var entity_id=$(this).attr('entity-id');
            var estate_id=$(this).attr('estate-id');
            var entity_type=$(this).attr('entity-type');
            WXAPP.Ajax('?r=audit/ajaxupdateauditbyid',{
                id:id,status:1,entity_id:entity_id,estate_id:estate_id,entity_type:entity_type
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
    }

    var Audit={
        setImpressionData:function(){
            WXAPP.Ajax('?r=audit/ajaxgetauditdata',{
                type:'impression'
            },successCallBack);
        },

        setCommentData:function(){
            WXAPP.Ajax('?r=audit/ajaxgetauditdata',{
                type:'comment'
            },successCallBack);
        }

    }
    WXAPP.Audit = Audit;
})();
