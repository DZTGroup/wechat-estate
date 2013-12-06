window.WXAPP = window.WXAPP ||{};


(function(){
    var Entity = {
        save:function(estate_id,type,content,callback){
            $.ajax({
               url:'',
               data:{
                   estate_id:estate_id,
                   type:type,
                   content:JSON.stringify(content)
               },
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
        WXAPP.Entity.save(estate_id,'impression', this.getData(),function(){

        });
    };
    Impression.prototype.check = function(){
        var data = this.getData();
        if(!data.estate_id){
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
        var estate_id = this.form.find('.J_estate_id').val(),
            num = this.form.find('.J_num').val().trim(),
            impressions = [];

        return {
            estate_id:estate_id,
            number:num,
            impressions:impressions
        }
    }
})();

