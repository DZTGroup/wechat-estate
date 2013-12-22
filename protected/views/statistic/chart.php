<div class="cent-auto">
    <div class="hexin-tiele">核心数据</div>
    <div style="height:500px;" id="chart">

    </div>
</div>

<script  src="js/chart.js"></script>
<script>
    <?php
                $data = $this->getRecentView();
                date_default_timezone_set('Asia/Shanghai');
            ?>
    new Venus.SvgChart('chart',[{
        name:'pv',
        data:{
            <?php
                    forEach($data['pv'] as $row){
                        echo '"'.$row['d'].'":'.$row['pv'].',';
                    }
                ?>
        }
    },{
        name:'uv',
        data:{
            <?php
                    forEach($data['uv'] as $row){
                        echo '"'.$row['d'].'":'.$row['uv'].',';
                    }
                ?>
        }
    }],{
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

</script>