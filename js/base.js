window.WXAPP = window.WXAPP ||{};


(function(){
    var Entity = {
        save:function(estate_id,type,content,callback){
            $.ajax({
               url:'?r=entity/ajaxsave',
               data:{
                   estate_id:estate_id,
                   type:type,
                   content:JSON.stringify(content)
               },
               type:"POST",
               dataType:'json',
               success:callback,
               error:function(){
                   alert('网络出错，请重试');
               }
            });

        }
    }

    WXAPP.Entity = Entity;
})();


(function(){
    //房友印象

    var Impression = function(form){
        this.form = form;
    };
    Impression.prototype.create = function(){
        if(!this.check()){
            return;
        }
        var data = this.getData();
        var estate_id = data.estate_id;
        delete data.estate_id;
        WXAPP.Entity.save(estate_id,'impression', data,function(){
            debugger;
        });
    };
    Impression.prototype.check = function(){
        var data = this.getData();
        if(!data.estate_id || data.estate_id==-1){
            alert('请选择楼盘');
            return false;
        }
        if(!data.number){
            alert('请填写初识总人数');
            return false;
        }
        return true;
    };
    Impression.prototype.getData = function(){
        var estate_id = this.form.find('.J_estate_list').val(),
            num = this.form.find('.J_num').val().trim(),
            impressions = this.form.find('.J_impression');
        var imp = [];
        impressions.each(function(i,item){
            var impression = $(item).find('.J_impression_input').val().trim(),
                percent = $(item).find('.J_percent_input').val().trim();
            if(impression && percent){
                imp.push({
                    impression:impression,
                    percent:percent
                });
            }
        });

        return {
            estate_id:estate_id,
            number:num,
            impressions:imp
        }
    }

    WXAPP.Impression = Impression;
})();

(function(){
    //新增房友印象页面逻辑
    var impressionForm = $('#J_new_impression');
    if(!impressionForm.length){
        return;
    }
    var ip = new WXAPP.Impression(impressionForm);
    impressionForm.find('.submit').click(function(){
        ip.create();
    });
})();

