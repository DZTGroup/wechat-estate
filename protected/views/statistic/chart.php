<div class="cent-auto">
    <div class="hexin-tiele">用户关注数</div>
    <div class="order-lb" style="margin-top: 20px"><label>楼盘名称：</label>
        <?php $this->widget('EstateListWidget', array('class_name' => 'li-hd','all'=>true)); ?>
    </div>
    <div style="height:500px;" id="chart">

    </div>
</div>


<script src="js/chart.js"></script>
<script src="js/jquery-2.0.3.min.js"></script>
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="js/base.js" charset="utf-8"></script>
<script>
    <?php
                date_default_timezone_set('Asia/Shanghai');
    ?>

    $('.J_estate_list').change(function(){
        debugger
        var estate_id = $('.J_estate_list').val();

        WXAPP.Ajax('?r=statistic/ajaxgetfollownum',{
            eid:estate_id
        },function(res){
            var array_data=new Array();
            var obj_data={
                name:'关注人数',
                data:{
                }
            }
            array_data.push(obj_data);

            res.data.forEach(function(item){
                obj_data.data[item.d]=parseInt(item.follow_num);
            });

            new Venus.SvgChart('chart',array_data,{
                axis:{
                    x:{
                        type:'datetime',
                        toFormat:'yyyy-MM-dd'
                    },
                    y:{

                    }
                },
                line:{
                    dotRadius:2

                },
                tooltip:function(obj){
                    return obj.x+"\n"+obj.y;

                },
                legend:{

                }
            });
        });

    });



</script>