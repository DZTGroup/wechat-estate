<div class="cent-auto">
    <div class="hexin-tiele">用户关注数</div>
    <div style="height:500px;" id="chart">

    </div>
</div>

<script  src="js/chart.js"></script>
<script>
    <?php
                $data = $this->getFollowNum();
                date_default_timezone_set('Asia/Shanghai');
            ?>
    new Venus.SvgChart('chart',[{
        name:'关注人数',
        data:{
            <?php
                    forEach($data['follow'] as $row){
                        echo '"'.$row['name'].'":'.$row['follow_num'].',';
                    }
                ?>
        }
    }],{
       axis:{
           x:{
               type:'string'
           },
           y:{

           }
       },
        bar:{
            dotRadius:2

        },
        tooltip:function(obj){
            return obj.x+"\n"+obj.y;

        },
        legend:{

        }
    });

</script>