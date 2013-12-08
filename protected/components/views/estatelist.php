<select class="J_estate_list <?php echo $class_name;?>">

    <option value="-1">请选择楼盘</option>
    <?php
        forEach($model as $row){
    ?>
            <option value="<?php echo $row->id; ?>"><?php echo $row->name ?></option>
    <?php
        }
    ?>
</select>