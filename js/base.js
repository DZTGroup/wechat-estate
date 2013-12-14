window.WXAPP = window.WXAPP || {};

//ajax
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

//Entity
(function () {
    function Entity(type, form, table, newBtn, options) {
        this.type = type;
        this.form = form;
        this.table = table;
        this.newBtn = newBtn;
        this.options = {};
        options = options || {};
        for (var op in options) {
            this.options[op] = options[op];
        }
        this.bindEvent();
        this.mode = 'insert'; // or update

    }

    Entity.prototype.bindEvent = function () {
        var self = this;
        this.newBtn.click(function () {
            var selectedEstate = $(this).parent().find('.J_estate_list').val();
            if (selectedEstate == WXAPP.EMPTY_ESTATE) {
                alert('请选择楼盘');
                return;
            }
            self.mode = 'insert';
            self.setEstateId(selectedEstate);
            self.empty();
            self.form.show();
        });
        this.newBtn.parent().find('.J_estate_list').change(function () {
            if (!self.options.multiple) {
                self.newBtn.hide();
            }
            self.form.hide();
            var id = $(this).val();
            self.setEstateId(id);
            self.fetchList();
        });
        this.form.find('.J_submit').click(function () {
            self[self.mode]();
        });
        this.form.find('.J_cancel').click(function () {
            self.form.hide();
        });

    }
    Entity.prototype.insert = function (callback) {
        if (!this.check()) {
            return;
        }
        WXAPP.Ajax('?r=entity/ajaxinsert', {
            estate_id: this.estate_id,
            type: this.type,
            content: JSON.stringify(this.getData())
        }, callback || function () {
            alert('创建成功');
            location.reload();
        });
    }
    Entity.prototype.update = function (callback) {
        if (!this.check()) {
            return;
        }
        WXAPP.Ajax('?r=entity/ajaxupdate', {
            id: this.id,
            content: JSON.stringify(this.getData())
        }, callback || function () {
            alert('修改成功');
            location.reload();
        });
    }
    Entity.prototype.check = function () {
        return true;
    }
    Entity.prototype.getData = function () {
        var data = {};
        this.form.find('.J_modules').each(function (i, module) {
            var moduleName = $(module).attr('data-module');
            data[moduleName] = [];
            $(module).find('.J_module_item').each(function (j, item) {
                var itemData = {};
                $(item).find('.J_field').each(function (k, field) {
                    itemData[$(field).attr('name')] = $(field).val();
                });
                data[moduleName].push(itemData);
            });
        });
        this.form.find(".J_module").each(function (i, module) {
            var moduleName = $(module).attr('data-module');
            data[moduleName] = {};
            $(module).find('.J_field').each(function (j, field) {
                data[moduleName][$(field).attr('name')] = $(field).val();
            });
        });
        return data;
    }
    Entity.prototype.setData = function (data) {
        var content;
        var self = this;
        if (!data) {
            return;
        }
        if (data.estate_id) {
            this.estate_id = data.estate_id;
        }
        if (data.content) {
            content = JSON.parse(data.content);
        }
        if (content) {
            this.form.find('.J_modules').each(function (i, module) {
                var moduleName = $(module).attr('data-module');
                var moduleData = content[moduleName];
                $(module).find('.J_module_item').each(function (j, item) {
                    var itemData = moduleData[j];
                    if (itemData) {
                        $(item).find('.J_field').each(function (k, field) {
                            $(field).val(itemData[$(field).attr('name')]);

                        });
                    }
                });
            });
            this.form.find('.J_module').each(function (i, module) {
                var moduleName = $(module).attr('data-module');
                var moduleData = content[moduleName];
                if (moduleData) {
                    $(module).find('.J_field').each(function (j, field) {
                        var value = moduleData[$(field).attr('name')];
                        $(field).val(value);
                        if ($(field).get(0).nodeName.toLowerCase() === "img" && value) {
                            $(field).attr('src', 'upload_files/' + self.estate_id + "/" + value);
                        }
                    });
                }

            });
        }
    }
    Entity.prototype.setEstateId = function (id) {
        this.estate_id = id;
        try {
            window.setEstateId(id);
        } catch (e) {
        }
    }
    Entity.prototype.setId = function (id) {
        this.id = id;
    }
    Entity.prototype.fetchList = function () {
        var self = this;
        WXAPP.Ajax('?r=entity/ajaxgetentitiesbyestateid', {
            estate_id: this.estate_id,
            type: this.type
        }, function (res) {
            self.renderList(res);
        });
    }
    Entity.prototype.renderList = function (res) {
        var self = this;
        self.table.empty();
        var hasUnChecked = false;
        if (!res.data.length) {
            alert('该楼盘还没有数据')
        }
        res.data.forEach(function (item) {
            if (item.status == '0') {
                hasUnChecked = true;
            }
            self.table.append(self.tableTemplate.call(self, item));
        });
        if (!hasUnChecked) {
            self.newBtn.show();
        }
        self.table.find('.J_edit').click(function () {
            self.mode = 'update';
            var id = $(this).attr('data-id');
            self.setId(id);
            WXAPP.Ajax('?r=entity/ajaxgetentitybyid', {
                id: id
            }, function (res) {
                self.form.show();
                self.setData(res.data);
            });
        });
    }
    Entity.prototype.getStatus = function (code) {
        var status = {
            0: '未审核',
            1: '已审核',
            2: '驳回',
            3: '已过期'
        }
        return status[code];

    }
    Entity.prototype.empty = function () {
        this.form.find('input').val('');
        this.form.find('textarea').val('');
    }
    Entity.prototype.tableTemplate = function (item) {
        return '<tr><td>' + item.estate_id + '</td><td>' + item.estate_name + '</td><td>' + item.create_time + '</td><td>' + this.getStatus(item.status) + '</td><td><a class="blue J_edit" href="javascript:;" data-id="' + item.id + '">编辑</a></td></tr>';
    }

    WXAPP.Entity = Entity;
    WXAPP.EMPTY_ESTATE = -1;
})();

//Entity Init
(function () {
    //Entity 页面初始化
    var form = $('#J_entity_form'),
        newBtn = $('#J_entity_new'),
        table = $('#J_entity_table tbody');
    if (!form.length) {
        return;
    }
    var entity = new WXAPP.Entity(form.attr('data-type'), form, table, newBtn, {
        multiple: form.attr('data-multiple') === "true"
    });
    if (entity.type == "reservation") {
        entity.tableTemplate = function (item) {
            var content = JSON.parse(item.content);
            return '<tr><td>' + item.id + '</td><td>' + content.event.name + '</td><td>' + item.estate_name + '</td><td>' + content.event.start_date + '-' + content.event.end_date + '</td><td>' + item.create_time + '</td><td>' + this.getStatus(item.status) + '</td><td><a class="blue J_edit" href="javascript:;" data-id="' + item.id + '">编辑</a></td></tr>';
        }
    }
    if (entity.type == "group") {
        entity.tableTemplate = function (item) {
            var content = JSON.parse(item.content);
            return '<tr><td>' + content.title_setting.title + '</td><td>' + item.estate_name + '</td><td>' + content.event.watch_end_date + '前</td><td>' + item.create_time + '</td><td>' + this.getStatus(item.status) + '</td><td><a class="blue J_edit" href="javascript:;" data-id="' + item.id + '">编辑</a></td></tr>';
        }
    }
})();

//日历，图片上传
(function () {
    //日历
    $('.ico-calendar').prev().datepicker({
        dateFormat: 'yy-mm-dd'
    });

    //图片上传
    WXAPP.bindLoad = function (btns) {
        btns.each(function (i, button) {
            var id = 'J_upload' + (+new Date());
            $(button).attr('id', id);
            var infoSpan = $(button).parent().parent().find('.J_display');
            var swfu = new SWFUpload({
                upload_url: "upload_file.php",
                flash_url: "js/upload/flash/swfupload.swf",
                flash9_url: "http://www.swfupload.org/swfupload_fp9.swf",
                file_size_limit: "100 KB", //文件大小限制
                button_placeholder_id: id,
                button_width: 83,
                button_height: 31,
                button_image_url: 'img/upload.png',
                file_post_name: 'file',
                file_dialog_complete_handler: function () {
                    this.addPostParam('estate_id', window.getEstateId());
                    this.startUpload();

                    infoSpan.find('.info').html('正在上传..');
                },
                upload_progress_handler: function () {
                    //console.log(arguments);
                },
                upload_success_handler: function (file, res) {
                    res = JSON.parse(res);
                    if (res.code == 200) {
                        infoSpan.find('.info').html('上传成功!');
                        infoSpan.find('img').val(res.data.id).attr('src', res.data.src);
                    } else {
                        alert(res.data.msg);
                    }
                }
            });
        });
    }

    WXAPP.bindLoad($('.J_upload'))

    var estate_id;
    window.setEstateId = function (id) {
        estate_id = id;
    }
    window.getEstateId = function () {
        return estate_id;
    }
})();


//楼盘
(function () {
    //楼盘Class
    function Estate(form) {
        this.form = form;
    }

    Estate.prototype.save = function (id) {
        if (this.check()) {
            var data = this.getData();
            if (this.id) {
                data.id = this.id;
            }
            WXAPP.Ajax('?r=estate/ajaxsave', data, function () {
                alert('保存成功');
                location.reload();
            });
        }
    }
    Estate.prototype.check = function () {
        var data = this.getData();
        for (var key in data) {
            if (data.hasOwnProperty(key)) {
                if (!data[key]) {
                    alert('请填写' + key);
                    return false;
                }
            }
        }
        return true;
    }
    Estate.prototype.getData = function () {
        var data = {};
        this.form.find('.J_field').each(function (i, item) {
            data[$(item).attr('name')] = $(item).val();
        })
        return data;
    }
    Estate.prototype.setData = function (data) {
        this.form.find('.J_field').each(function (i, item) {
            $(item).val(data[$(item).attr('name')] || '');
        });
    }
    Estate.prototype.empty = function () {
        this.form.find('.J_field').each(function (i, item) {
            $(item).val('');
        })
    }
    Estate.prototype.setId = function (id) {
        this.id = id;
    }

    WXAPP.Estate = Estate;
})();
(function () {
    //楼盘管理
    var table = $('#J_estate_table');
    if (!table.length) {
        return;
    }

    var estate = new WXAPP.Estate($('.J_estate_form'));

    //编辑
    table.find('.J_edit').click(function () {
        var id = $(this).attr('data-id')
        WXAPP.Ajax('?r=estate/ajaxgetestatebyid', {
            id: id
        }, function (res) {
            estate.form.show();
            estate.setData(res.data);
            estate.setId(id);
        });
    });
    //删除
    table.find('.J_delete').click(function () {
        if (confirm('确定要删除该楼盘吗？删除后无法恢复！')) {
            WXAPP.Ajax('?r=estate/ajaxdelete', {
                id: $(this).attr('data-id')
            }, function (res) {
                alert('删除成功!');
                location.reload();
            });
        }
    });
    //新增
    table.find('.J_new_estate').click(function () {
        estate.empty();
        estate.setId(null);
        estate.form.show();
    });
    //保存
    estate.form.find('.J_save').click(function () {
        estate.save();
    });
    //取消
    estate.form.find('.J_cancel').click(function () {
        estate.form.hide();
    });
})();

//审批
(function () {
    AuditAdmin = {
        listAllPassedData: function () {
            WXAPP.Ajax('?r=audit/ajaxgetauditpasseddata', {

            }, function (res) {
                var table = $('#J_audit_list_all_passed_data_table tbody');
                var map = {
                    1: '审核通过',
                    'intro': '楼盘',
                    'apartment': '户型',
                    'group': '看房团',
                    'picture': '照片墙',
                    'reservation': '认筹',
                    'comment': '专家建议',
                    'impression': '用户印象'

                }
                table.empty();
                res.data.forEach(function (item) {
                    table.append('<tr><td>' + item.estate_id + '</td>' +
                        '<td>' + item.name + '</td><td>'
                        + map[item.entity_type] + '</td><td>'
                        + item.create_time + '</td><td>'
                        + map[item.entity_status]
                        + '</td><td><a class="blue J_detail" href="javascript:;" data-id="' + item.id
                        + '" entity-id="' + item.entity_id + '">详情</a>'
                        + '</td></tr>')
                });

                table.find('.J_detail').click(function () {
                    var id = $(this).attr('entity-id');
                    //location.href='?r=estate/info&id='+id;
                });
            });
        }
    }

    WXAPP.AuditAdmin = AuditAdmin;
})();

(function () {
    function successCallBack(res) {
        var table = $('#J_audit_table tbody');
        var map = {
            0: '待审核'
        }
        table.empty();
        res.data.forEach(function (item) {
            table.append('<tr><td>' + item.estate_id + '</td>' +
                '<td>' + item.name + '</td><td>'
                + item.create_time + '</td><td>'
                + item.username + '</td><td>'
                + map[item.entity_status]
                + '</td><td><a class="blue J_detail" href="javascript:;" data-id="' + item.id
                + '" entity-id="' + item.entity_id + '">详情</a>'
                + '<a class="blue J_pass" href="javascript:;" data-id="' + item.id
                + '" entity-id="' + item.entity_id
                + '" estate-id="' + item.estate_id
                + '" entity-type="' + item.entity_type + '">通过</a>'
                + '<a class="blue J_fail" href="javascript:;" data-id="' + item.id
                + '" entity-id="' + item.entity_id + '">驳回</a>'
                + '</td></tr>')
        });

        table.find('.J_details').click(function () {

        });

        table.find('.J_pass').click(function () {
            var id = $(this).attr('data-id');
            var entity_id = $(this).attr('entity-id');
            var estate_id = $(this).attr('estate-id');
            var entity_type = $(this).attr('entity-type');
            WXAPP.Ajax('?r=audit/ajaxupdateauditbyid', {
                id: id, status: 1, entity_id: entity_id, estate_id: estate_id, entity_type: entity_type
            }, function (res) {
                if (res.code == 200) {
                    location.reload();
                    alert('审核成功！');
                }
            });
        });

        table.find('.J_fail').click(function () {
            var id = $(this).attr('data-id');
            var entity_id = $(this).attr('entity-id');
            WXAPP.Ajax('?r=audit/ajaxupdateauditbyid', {
                id: id, status: 2, entity_id: entity_id
            }, function (res) {
                if (res.code == 200) {
                    location.reload();
                    alert('已驳回！');
                }
            });
        });
    }

    var Audit = {
        setImpressionData: function () {
            WXAPP.Ajax('?r=audit/ajaxgetauditdata', {
                type: 'impression'
            }, successCallBack);
        },

        setCommentData: function () {
            WXAPP.Ajax('?r=audit/ajaxgetauditdata', {
                type: 'comment'
            }, successCallBack);
        },

        setPictureWallData: function () {
            WXAPP.Ajax('?r=audit/ajaxgetauditdata', {
                type: 'picture'
            }, successCallBack);
        },

        setEstateData: function () {
            WXAPP.Ajax('?r=audit/ajaxgetauditdata', {
                type: 'intro'
            }, successCallBack);
        }
    }
    WXAPP.Audit = Audit;

    $('#J_audit').find('.J_estate_list').change(function () {
        var id = $(this).val();
        WXAPP.Ajax('?r=audit/ajaxgetauditdatabyestateid', {
            estate_id: id,
            entity_type: 'group'
        }, successCallBack);
    });
})();

//照片墙设置
(function () {
    var descLayer = $('#J_desc_layer');
    var layerbg = $("#J_layer_bg")
    descLayer.find('.J_save').click(function () {
        descTarget.val(descLayer.find('.J_text').val());
        descLayer.hide();
        layerbg.hide();
    })
    descLayer.find('.J_cancel').click(function () {
        descLayer.hide();
        layerbg.hide();
    });
    var descTarget = null;
    $('.J_pic_desc_btn').click(function () {
        var desc = $(this).next().val();
        descTarget = $(this).next();
        descLayer.find('.J_text').val(desc);
        descLayer.show();
        layerbg.show();
    });

    var titleLayer = $('#J_title_layer');
    titleLayer.find('.J_save').click(function () {
        titleTarget.val(titleLayer.find('.J_title').val());
        subtitleTarget.val(titleLayer.find('.J_subtitle').val());
        titleLayer.hide();
        layerbg.hide();
    })
    titleLayer.find('.J_cancel').click(function () {
        titleLayer.hide();
        layerbg.hide();
    });
    var titleTarget;
    var subtitleTarget;
    $('.J_pic_title_btn').click(function () {
        var title = $(this).next().val();
        var subtitle = $(this).next().next().val();
        titleTarget = $(this).next();
        subtitleTarget = $(this).next().next();
        titleLayer.find('.J_title').val(title);
        titleLayer.find('.J_subtitle').val(subtitle);
        titleLayer.show();
        layerbg.show();
    });

})();


(function () {
    function postListSuccessCallback(res) {
        var postBody = $('#topic_id');
        res.data.forEach(function (item) {
            postBody.append('<div class="mod-box" onclick="showDetail();">'
                + '<h3 class="mod-box__title ui-mb-small">'
                + item.title + '</h3>'
                + '<div class="mod-box__time">'
                + '<span class="ui-fl-l ui-c-light">' + item.wechat_id + ' ' + item.create_time + '</span>'
                + '<span class="ui-c-light"><span class="icon-eye"></span>浏览 （11）</span></div>'
                + '<div class="mod-box__content ui-mb-medium">'
                + item.content + '</div>'
                + '<div class="mod-box__control">'
                + '<i class="icon-heart"></i></span>浏览 （11）</span>'
                + '<i class="icon-comment"></i><span>评论（1）</span>'
                + '</div>'
                + '</div>')
        });
    }

    var Post = {
        getListData: function (estate_id) {
            WXAPP.Ajax('?r=post/ajaxgetpostlist', {
                estate_id: estate_id
            }, postListSuccessCallback);
        }

    };
    WXAPP.Post = Post;


    var post_form = $('#bbs_post_form');
    var current_estate_id = $('#estate_id').val();
    var wechat_id = $('#wechat_id').val();

    $('#post_btnSend').click(function () {
        var title = post_form.find('#tfTitle').val();
        var content = post_form.find('#tfContent').val();

        WXAPP.Ajax('?r=post/ajaxpostnewpost', {
            estate_id: current_estate_id, wechat_id: wechat_id, post_title: title, post_content: content
        }, function (res) {
            if (res.code == 200) {
                location.href = '?r=post/list&estate_id=' + current_estate_id;
            }
        });
    });
})();


//户型管理
(function () {
    var form = $('#J_apartment_form'),
        newBtn = $('#J_entity_new'),
        table = $('#J_entity_table tbody');
    if (!form.length) {
        return;
    }
    var entity = new WXAPP.Entity(form.attr('data-type'), form, table, newBtn, {
        multiple: form.attr('data-multiple') === "true"
    });

    form.find('.J_add').click(function(){
        entity.empty();
    });

    var holder = $('.J_holder');

    var html = '<div class="J_loop">' +
        '<div class="com-min">' +
        '<h3>户型分类：<input class="J_type_name" name="type_name" ></h3>' +
        '</div><ul class="J_type_list"></ul></div>';
    var typeList1 = '<li>户型名：<span class="J_name"></span><input type="hidden"><button class="btn-cha J_edit" type="button">编辑</button></li>';

    entity.getData = function () {
        var data = [];
        holder.find('.J_loop').each(function (i, loop) {
            var typeData = {};
            typeData.type_name = $(loop).find('.J_type_name').val();
            typeData.type_list = [];
            $(loop).find('.J_type_list input[type=hidden]').each(function (i, item) {
                typeData.type_list.push(JSON.parse($(item).val()));
            });
            data.push(typeData);
        });

        return data;

    }
    function edit(data, type, cb) {
        var layer = $('<div class="box-layer" style="width:700px;">' +
            ' <div class="title"><h2>户型数据</h2></div>' +
            '<a class="close J_cancel" href="javascript:;" title="关闭">关闭</a>' +
            '<div class="tip-mian">' +
            '<div class="p-shuju">' +
            '<div class="layer-lb">' +
            '<label>户型名：</label>' +
            '<input class="inp-tex inp-300 J_field" name="name" type="text">' +
            '</div> ' +
            '<div class="layer-lb">' +
            '<label>户型分类：</label>' +
            '<input class="inp-tex inp-300 J_type" name="type" type="text">' +
            '</div>' +
            '<div class="layer-lb">' +
            '<label>户型简介：</label>' +
            '<input class="inp-tex inp-300 J_field" name="desc" type="text">' +
            '</div>' +
            '<div class="layer-lb">' +
            '<label>建筑面积：</label>' +
            '<input class="inp-tex inp-300 J_field" name="area" type="text">' +
            '</div>' +
            '<div class="layer-lb">' +
            '<label>套内面积：</label>' +
            '<input class="inp-tex inp-300 J_field" name="inner_area" type="text">' +
            '</div>' +
            '<div class="layer-lb">' +
            '<label>楼层：</label>' +
            '<input class="inp-tex inp-300 J_field" name="floors" type="text">' +
            '</div>' +
            '<div class="layer-lb">' +
            '<label>详细信息：</label>' +
            '<textarea class="layer-kuang J_field" name="detail" cols="" rows="" placeholder="100个字以内"></textarea>' +
            '</div>' +
            '</div>' +
            '<div class="lay-sctp">' +
            '<p><button class="btn-cha J_edit_type" type="button">编辑户型图</button></p>' +
            '<p><button class="btn-cha J_edit_all" type="button">编辑全景图</button></p>' +
            '(推荐图片尺寸：720*130；图片小于100k)' +
            '</div>' +
            '<div class="but-auto">' +
            '<a class="an-butn J_sure" href="javascript:;" title="确认">确认</a> ' +
            '<a class="an-butn J_cancel" href="javascript:;" title="取消">取消</a>' +
            '</div></div></div>').appendTo('body');

        if (data) {
            $('.J_field').each(function (i, item) {
                $(item).val(data['base-info'][$(item).attr('name')]);
            });
            $('.J_type').val(type);
        } else {
            data = {
                'base-info': {},
                'panoramagram': [],
                'home-plan': []
            };
            type = "";
        }

        layer.find('.J_sure').click(function () {
            var type = $('.J_type').val();
            data['base-info'] = {};
            layer.find('.J_field').each(function (i, field) {
                data['base-info'][$(field).attr('name')] = $(field).val();
            });
            if (cb) {
                cb(data, type);
            }
            alert('编辑成功，不要忘记提交');
            layer.remove();
        });
        layer.find('.J_edit_all').click(function () {
            if (data) {
                showEditPanoramagram(data.panoramagram, function (newPa) {
                    data.panoramagram = newPa;
                });
            }
        });
        layer.find('.J_edit_type').click(function () {
            if (data) {
                showEditType(data['home-plan'], function (newPa) {
                    data['home-plan'] = newPa;
                });
            }
        });
        layer.find('.J_cancel').click(function () {
            layer.remove();
        })
    }

    function showEditType(data, cb) {
        var layer = $('<div class="box-layer" style="width:700px;">' +
            ' <div class="title"><h2>户型图</h2></div>' +
            ' <a class="close J_cancel" href="javascript:;" title="关闭">关闭</a>' +
            ' <div class="tip-mian">' +
            ' <div class="p-shuju">' +
            ' </div>' +
            ' <div class="but-auto"><a class="an-butn J_add" href="javascript:;" title="添加">添加户型图</a> <a class="an-butn J_sure" href="javascript:;" title="确定">确定</a></div>' +
            ' </div> </div>').appendTo('body');
        var html = '<div class="J_item"><input class="J_field" name="name" >' +
            '<div><span class="load_btn"> <span class="btn-cha J_upload"></span></span>' +
            '<div class="J_display">' +
            '<img src="" class="J_field" name="img" value="">' +
            '</div></div>'
        '</div>';

        if (data) {
            data.forEach(function (item) {
                var list = $(html).appendTo(layer.find('.p-shuju'));
                list.find('.J_field').each(function (j, field) {
                    $(field).val(item[$(field).attr('name')]);
                    if (field.nodeName.toLowerCase() === "img") {
                        field.src = 'upload_files/' + entity.estate_id + "/" + item[$(field).attr('name')];
                    }
                });

            });
        }
        WXAPP.bindLoad(layer.find('.J_upload'));

        layer.find('.J_add').click(function () {
            var list = $(html).appendTo(layer.find('.p-shuju'));
            WXAPP.bindLoad(list.find('.J_upload'));
        });

        layer.find('.J_sure').click(function () {
            var list = [];
            layer.find('.J_item').each(function (i, item) {
                var data = {};
                $(item).find('.J_field').each(function (i, field) {
                    data[$(field).attr('name')] = $(field).val();
                });
                list.push(data);
            });
            alert('户型图修改成功');
            layer.remove();
            cb(list);
        });
        layer.find('.J_cancel').click(function () {
            layer.remove();
        })

    }

    function showEditPanoramagram(data, cb) {
        var layer = '<div class="box-layer" style="width:600px;">' +
            ' <div class="title"><h2>户型数据</h2></div>' +
            ' <a class="close J_cancel" href="javascript:;" title="关闭">关闭</a>' +
            ' <div class="tip-mian">' +
            ' <div class="p-shuju">' +
            ' </div>' +
            ' <div class="but-auto"><a class="an-butn J_add" href="javascript:;" title="添加全景">添加全景</a> <a class="an-butn J_sure" href="javascript:;" title="确定">确定</a></div>' +
            ' </div>' +
            ' </div>';
        layer = $(layer).appendTo('body');
        var html = '<div class="J_item"><div class="layer-lb"><label>全景名称：</label> <input class="inp-tex inp-300 J_field" name="name" type="text"></div>' +
            '<div class="layer-lb"><label>访问地址：</label> <input class="inp-tex inp-300 J_field" name="link" type="text"></div></div>';

        if (data) {
            data.forEach(function (dataItem) {
                var item = $(html).appendTo(layer.find('.p-shuju'));
                item.find('.J_field').each(function (i, field) {
                    $(field).val(dataItem[$(field).attr('name')]);
                });
            });
        }
        layer.find('.J_add').click(function () {
            $(html).appendTo(layer.find('.p-shuju'));
        });
        layer.find('.J_sure').click(function () {
            var Panoramagram = [];
            layer.find('.J_item').each(function (i, item) {
                var data = {};
                $(item).find('.J_field').each(function (j, field) {
                    data[$(field).attr('name')] = $(field).val();
                });
                Panoramagram.push(data);
            });
            cb(Panoramagram);
            alert('全景图编辑成功!');
            layer.remove();
        });
        layer.find('.J_cancel').click(function () {
            layer.remove();
        })

    }

    entity.setData = function (res) {
        var data = JSON.parse(res.content);
        var self = this;
        holder.empty();
        data.forEach(function (typeData) {
            var l = $(html).appendTo(holder);
            l.find('.J_type_name').val(typeData.type_name);
            typeData.type_list.forEach(function (type) {
                var list = $(typeList1).appendTo(l.find('ul'));
                list.find('.J_name').html(type['base-info'].name);
                list.find('input[type=hidden]').val(JSON.stringify(type));
                list.find('.J_edit').click(function () {
                    edit(type, typeData.type_name, function (d) {
                        list.find('input[type=hidden]').val(JSON.stringify(d));
                    });
                });
            });
        });
    }

    entity.empty = function () {
        edit(null, null, function (d, type) {
            var l = null
            holder.find(".J_loop").each(function (i, loop) {
                if ($(loop).find('.J_type_name').val() === type) {
                    l = $(loop);
                }
            });
            if (!l) {
                l = $(html).appendTo(holder);
            }
            l.find('.J_type_name').val(type);
            var list = $(typeList1).appendTo(l.find('ul'));
            list.find('.J_name').html(d['base-info'].name);
            list.find('input[type=hidden]').val(JSON.stringify(d));
            list.find('.J_edit').click(function () {
                edit(d, type, function (d) {
                    list.find('input[type=hidden]').val(JSON.stringify(d));
                });
            });
        });
    };
})();

//专家点评
(function(){
    var html='<div class="J_module" data-module="expert">' +
        ' <div class="tipe-lb "><label>专家名字：</label> <input class="inp-tex inp-300 J_field" name="name" type="text">' +
        ' </div>' +
        ' <div class="tipe-lb"><label>专家头街：</label> <input class="inp-tex inp-300 J_field" name="title" type="text" placeholder="(10个字以内)">' +
        ' </div>' +
        ' <div class="tipe-lb"><label>专家介绍：</label> <textarea class="text-kuang J_field" name="desc" cols="" rows="" placeholder="100个字以内"></textarea>' +
        ' </div>' +
        ' <div class="tipe-lb"><label>点评标语：</label> <input class="inp-tex inp-300 J_field" name="c_title" type="text" placeholder="(15个字以内)">' +
        ' </div>' +
        ' <div class="tipe-lb"><label>点评内容：</label> <textarea class="text-kuang J_field" name="c_content" cols=""' +
        ' rows="" placeholder="100个字以内"></textarea></div>' +
        ' </div><hr/>'

    var form = $('#J_expert_form'),
        newBtn = $('#J_entity_new'),
        table = $('#J_entity_table tbody');
    if (!form.length) {
        return;
    }
    form.find('.J_add').click(function(){
        entity.empty();
    })
    var entity = new WXAPP.Entity(form.attr('data-type'), form, table, newBtn, {
        multiple: form.attr('data-multiple') === "true"
    });
    entity.setData = function(rs){
        if(rs){
            var data = JSON.parse(rs.content)
            data.forEach(function(expert){
                var l = $(html).appendTo(form.find('.J_expert_holder'));
                l.find('.J_field').each(function(i,field){
                    $(field).val(expert[$(field).attr('name')]);
                });
            });
        }
    }
    entity.getData = function(){
        var list = [];
        form.find('.J_module').each(function(i,module){
            var data = {};
            $(module).find('.J_field').each(function(i,field){
                data[$(field).attr('name')] = $(field).val();
            });
            list.push(data);
        });
        return list;
    }
    entity.empty = function(){
        $(html).appendTo(form.find('.J_expert_holder'));
    }
})();